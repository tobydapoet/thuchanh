<?php
session_start();
include("../../db/connect.php");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

function getName($username, $chucvu, $conn) {
    if ($chucvu == 0) {
        $table = "tbl_nhanvien";
        $select_ten = "TenNV";
    } else {
        $table = "tbl_sinhvien";
        $select_ten = "TenSV";
    }
    $sql = "SELECT $select_ten FROM $table WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row[$select_ten];
    } else {
        return "Không tìm thấy tên";
    }
}
function getImage($username, $chucvu, $conn) {
    if ($chucvu == 0) {
        $table = "tbl_nhanvien";
     
    } else {
        $table = "tbl_sinhvien";
        
    }
    $sql = "SELECT Image FROM $table WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
       
        return $row['Image'];
    } else {
        return "Không tìm thấy ảnh";
    }
}
function getLastMessage($mess_id, $conn) {
    $sql = "SELECT messages FROM tbl_messages WHERE mess_id = $mess_id ORDER BY time DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['messages'];
    } else {
        return "Chưa có tin nhắn.";
    }
}
?>

<!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Page</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .chat-item:hover .delete-chat {
            display: inline;
        }
        .delete-chat {
            display: none;
            color: red;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="chat-container" id="chatListPage">
        <header>
            <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Tìm kiếm..." onkeyup="searchChat()">

                <button id="close_chat" onclick="closea()"><i class="fas fa-search"></i></button>
            </div>
        </header>
        <main>
            <div class="chat-list">
                <?php
               $sql = "SELECT * FROM tbl_chat WHERE user_send='{$_SESSION['username']}' OR user_get='{$_SESSION['username']}'";
                //$sql = "SELECT * FROM tbl_chat WHERE user_send='ductoan' OR user_get='ductoan'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $chatWith = $row['user_send'] === $_SESSION['username'] ? $row['user_get'] : $row['user_send'];
                        $sql = "SELECT username, chucvu FROM tbl_account where username='$chatWith'";
                        $result1 = $conn->query($sql);
                        $row1 = $result1->fetch_assoc();
                        $chucvu = $row1['chucvu'];
                        $name = getName($chatWith, $chucvu, $conn);
                        $image = getImage($chatWith, $chucvu, $conn);
                        $lastMessage = getLastMessage($row['mess_id'], $conn);
                        echo "<div class='chat-item' onclick='openChat(\"{$row['mess_id']}\", \"{$name}\")'>";
                        echo "<div class='avatar'><img src='../../image/".$image."' alt='Avatar'></div>";
                        echo "<div class='chat-info'>";
                        echo "<h4>{$name} <span class='status online'></span></h4>";
                        echo "<p>{$lastMessage}</p>";
                        echo "</div>";
                        echo "<span class='delete-chat' onclick='deleteChat(event, \"{$row['mess_id']}\")'>Xóa</span>";
                        echo "</div>";
                    }
                }
                $conn->close();
                ?>
            </div>
        </main>
        <footer>
            <button class="add-chat" onclick="location.href='get_accounts.php'"><i class="fas fa-plus-circle"></i> Thêm đoạn chat</button>
        </footer>
    </div>

    <div class="chat-container" id="chatDetailPage" style="display: none;">
        <header>
            <button class="back-button" onclick="goBack()"><i class="fas fa-arrow-left">BACK</i></button>
            <h2 id="chatWithName">Tên người nhận</h2>
        </header>
        <main>
            <div class="chat-messages" id="chatMessages">
            </div>
        </main>
        <footer>
            <div class="message-input">
                <input type="text" id="messageInput" placeholder="Nhập tin nhắn...">
                <button onclick="sendMessage()"><i class="fas fa-paper-plane">Gửi</i></button>
            </div>
        </footer>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script>
        function openChat(messId, userName) {
            sessionStorage.setItem('messId', messId);
            sessionStorage.setItem('userName', userName);
            document.getElementById('chatWithName').innerText = userName;
            document.getElementById('chatListPage').style.display = 'none';
            document.getElementById('chatDetailPage').style.display = 'block';
            loadMessages(messId);
        }

        function loadMessages(messId) {

            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_messages.php?mess_id=" + messId, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('chatMessages').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        function goBack() {

            document.getElementById('chatListPage').style.display = 'block';
            document.getElementById('chatDetailPage').style.display = 'none';
        }

        function sendMessage() {
            var messId = sessionStorage.getItem('messId');
            var message = document.getElementById('messageInput').value;
            

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "send_message.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
        
                    loadMessages(messId);
                    document.getElementById('messageInput').value = '';
                }
            };
            xhr.send("mess_id=" + messId + "&message=" + encodeURIComponent(message));
        }

        function deleteChat(event, messId) {
            event.stopPropagation();
            if (confirm('Bạn có chắc muốn xóa đoạn chát này?')) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "delete_chat.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        location.reload();
                    }
                };
                xhr.send("mess_id=" + messId);
            }
        }
        function closea() {
            parent.document.getElementById("iframe_chat").style.display = "none";
        }
        function searchChat() {
    var input = document.getElementById("searchInput");
    var filter = input.value.toUpperCase();
    var chatList = document.getElementsByClassName("chat-item");

    for (var i = 0; i < chatList.length; i++) {
        var chatName = chatList[i].getElementsByClassName("chat-info")[0].getElementsByTagName("h4")[0];
        var txtValue = chatName.textContent || chatName.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            chatList[i].style.display = "";
        } else {
            chatList[i].style.display = "none";
        }
    }
}

    </script>
</body>
</html>
