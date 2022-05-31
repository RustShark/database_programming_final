<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Project</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@700&display=swap" rel="stylesheet">
    <link href="CSS/global.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://kit.fontawesome.com/0f016a68f0.js" crossorigin="anonymous"></script>
    <style type="text/css">
        a:link {
            color: white;
            text-decoration: none;
        }
        a:visited {
            color: white;
            text-decoration: none;
        }
        a:hover {
            color: white;
            text-decoration: none;
        }
    </style>
    <link rel="stylesheet" href="CSS/reservation_check_result.css">
</head>
<header>
    <div id="topbar">
        <img id="logo" src="https://img1.daumcdn.net/thumb/R1280x0/?scode=mtistory2&fname=https%3A%2F%2Fblog.kakaocdn.net%2Fdn%2FmTY6l%2Fbtqy91YJt2z%2F8Tz79w07TkrolukN22AJQk%2Fimg.jpg" alt="아냥항공" />
        <div id="menu">
            <div class="login-btn">
                <a href="404page.html" class="btn_l"><i class="fas fa-sign-in-alt"></i>&nbsp로그인</a>
            </div>
        </div>
    </div>
</header>

<body>
<div class="container">
    <form id="contact">
        <h3>예약조회</h3>
        <h4>조회에 필요한 정보를 입력하고 조회를 누르시면 예약한 항공권을 확인할 수 있습니다.</h4>
<!--<h1>안녕하세요? 예약 번호는 --><?php //echo $_POST["reservationNum"];?><!-- <br> 입니다.</h1>-->
    </form>
</div>



<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:wagyu.database.windows.net,1433; Database = airline", "wagyu", "a123456789!");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "wagyu", "pwd" => "a123456789!", "Database" => "airline", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:wagyu.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

$reservationNum = $_POST["reservationNum"]; //post로 받은 데이터 reservationNum을 변수 $reservationNum에 저장

$query="SELECT * FROM Reservation R WHERE R.reservationNum = '$reservationNum'";
$cntQuery="SELECT count(*) FROM dbo.Airport";
$result=sqlsrv_query($conn, $query);
$cnt=sqlsrv_query($conn, $cntQuery);

echo '<thead><table class="table-fill"><tr>'.
    '<th class="text-center">예매번호</th><th class="text-center">예매좌석</th><th class="text-center">가는 날</th><th class="text-center">출발지</th><th class="text-center">도착지</th><th class="text-center">가격</th>'.'</tr></thead>';
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
{
    echo '<tbody class="table-hover"><tr><td>'.$row['reservationNum'].'</td>'.
        '<td>'.$row['reservationSeatNum'].'</td>'.
        '<td>'.$row['S.boardingTime'].'</td>'.
        '<td>'.$row['S.boardingTime'].'</td>'.
        '<td>'.$row['S.arrivalTime'].'</td>'.
        '<td>'.$row['reservationPrice'].'</td></tr></tbody>';
}

?>

<!--<div class="footer">
    <div id="copy">
        <p>© Copyright 2021 RustShark - All Rights Reserved</p>
    </div>
</div>-->
</body>
</html>