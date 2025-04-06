var money = new Array(6).fill(0);
var cash_dien, cash_nuoc, cash_phong, cash_cpkhac;
var nb_Date = new Date();
var month = nb_Date.getMonth() + 1;
var year = nb_Date.getFullYear() + 1;



function load_data_view() {
    var ctx1 = document.getElementById('monthlyRevenueChart').getContext('2d');
    var monthlyRevenueChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Tháng ' + (month - 5), 'Tháng ' + (month - 4), 'Tháng ' + (month - 3), 'Tháng ' + (month - 2), 'Tháng ' + (month - 1), 'Tháng ' + (month)],
            datasets: [{
                label: 'Doanh thu',
                data: [money[5], money[4], money[3], money[2], money[1], money[0]],
                backgroundColor: '#3498db',
                borderWidth: 1
            }]

        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    var ctx2 = document.getElementById('annualRevenueChart').getContext('2d');
    var annualRevenueChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Tiền điện', 'Tiền nước', 'Tiền phòng', 'chi phí khác'],
            datasets: [{
                label: 'Tiền vnđ',
                data: [cash_dien, cash_nuoc, cash_phong, cash_cpkhac],
                backgroundColor: ['#f39c12', '#e74c3c', '#2ecc71', '#9b59b6'],
                borderWidth: 0.1,

            }]
        },
        options: {
            responsive: false,
            with: '440px',
            height: '440px',
            maintainAspectRatio: true
        }
    });
};

function load_data() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'thongkecore.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            document.getElementById('nb_rooms').innerHTML = data.total_room;
            document.getElementById('nb_staff').innerHTML = data.total_staff;
            document.getElementById('nb_electric').innerHTML = data.total_electric;
            document.getElementById('nb_water').innerHTML = data.total_water;
            document.getElementById('nb_student').innerHTML = data.total_student;
            document.getElementById('nb_boy').innerHTML = data.total_boy;
            document.getElementById('nb_girl').innerHTML = data.total_girl;
            document.getElementById('nb_bill').innerHTML = data.total_bill;
            document.getElementById('nb_contract').innerHTML = data.total_contract;
            cash_dien = data.cash_dien;
            cash_nuoc = data.cash_nuoc;
            cash_phong = data.cash_phong;
            cash_cpkhac = data.cash_cpkhac;


            for (var i = 0; i < data.month_data.length; i++) {
                money[i] = data.month_data[i].TongTien;
            }

            load_data_view();
        }
    }
    xhr.send();
};
window.onload = function() {
    load_data();
}