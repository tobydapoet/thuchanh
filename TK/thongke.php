<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Ký túc xá</title>
    <link rel="stylesheet" href="thongke.css?v=<?php echo time()?>">
    <script src="thongke.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="dashboard">
        <div class="container-thongke">
            <div class="row" id="row-header">
                <div class="col">
                    <div class="box">
                        <label>Tổng phòng</label>
                        <p id="nb_rooms">0 phòng</p>
                    </div>
                </div>
                <div class="col">
                    <div class="box">
                        <label>Tổng nhân viên</label>
                        <p id="nb_staff">0 nhân viên</p>
                    </div>
                </div>
                <div class="col">
                    <div class="box">
                        <label>Tổng số điện</label>
                        <p id="nb_electric">0 kWh</p>
                    </div>
                </div>
                <div class="col">
                    <div class="box">
                        <label>Tổng số nước</label>
                        <p id="nb_water">0 m<sup>3</sup></p>
                    </div>
                </div>
            </div>
            <div class="row" id="row-chart">
                <div class="col" id="chart-container">
                    <div class="box" >
                        <h2>Doanh thu theo tháng</h2>
                        <canvas id="monthlyRevenueChart" ></canvas>
                    </div>
                </div>
                <div class="col-3" id="chart-container">
                    <div class="box" id="chart-circle">
                        <h2>Dịch vụ</h2>
                        <div><canvas id="annualRevenueChart" style="width: 120%"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="row" id="row-footer">
                <div class="col">
                    <div class="box">
                        <label>Số lượng sinh viên</label>
                        <p id="nb_student">0 sinh viên</p>
                    </div>
                </div>
                <div class="col">
                    <div class="box">
                        <label>Số lượng sinh viên nam</label>
                        <p id="nb_boy">0 sinh viên</p>
                    </div>
                </div>
                <div class="col">
                    <div class="box">
                        <label>Số lượng sinh viên nữ</label>
                        <p id="nb_girl">0 sinh viên</p>
                    </div>
                </div>
                <div class="col">
                    <div class="box">
                        <label>Số lượng hóa đơn</label>
                        <p id="nb_bill">0 hóa đơn</p>
                    </div>
                </div>
                <div class="col">
                    <div class="box">
                        <label>Số lượng hợp đồng</label>
                        <p id="nb_contract">0 hợp đồng</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>