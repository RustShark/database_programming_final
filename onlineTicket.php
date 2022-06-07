<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="CSS/global.css" rel="stylesheet">
    <link href="CSS/ticket.css" rel="stylesheet">
    <link href="CSS/onlineTicket.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://kit.fontawesome.com/0f016a68f0.js" crossorigin="anonymous"></script>

    <title>OnlineTicket</title>
    <style>
        body { background-color: white; }
    </style>
</head>


<header>
    <div id="topbar">
        <a href="main.php">
            <img id="logo" src="https://img1.daumcdn.net/thumb/R1280x0/?scode=mtistory2&fname=https%3A%2F%2Fblog.kakaocdn.net%2Fdn%2FmTY6l%2Fbtqy91YJt2z%2F8Tz79w07TkrolukN22AJQk%2Fimg.jpg" alt="아냥항공" />

            <div id="menu">
                <div class="login-btn">
                    <a href="404page.html" class="btn_l"><i class="fas fa-sign-in-alt"></i>&nbsp 환영합니다</a>
                </div>
            </div>
    </div>
    <hr>
</header>

<body>

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
$passengerName = $_POST["passengerName"];

$query="SELECT p.passengerName as passengerName,
reservationNum,
reservationSeatNum,
reservationDate,
s.boardingName as boardingName,
s.arrivalName as arrivalName,
s.flightName as flightName,
reservationPrice FROM Reservation as r, Passenger as p,
(SELECT s.scheduleNum as schedule, bn.airportName as boardingName, an.airportName as arrivalName, s.flightName as flightName
FROM Schedule as s, Airport as bn, Airport as an WHERE s.boardingAirportNum = bn.airportNum AND s.arrivalAirportNUM = an.airportNum) as s
WHERE reservationNum = '$reservationNum'
AND p.passengerName = '$passengerName'
AND r.passengerNum = p.passengerNum
AND s.schedule = scheduleNum;";

$cntQuery="SELECT count(*) FROM dbo.Airport";
$result=sqlsrv_query($conn, $query);
$cnt=sqlsrv_query($conn, $cntQuery);
$row = sqlsrv_fetch_array($result);

//echo '<h1>'.$row['boardingName'].'</h1>';
?>

<div class="box">
    <ul class="left">
        <li></li>
    </ul>

    <ul class="right">
        <li></li>
    </ul>

    <div class="ticket">
        <span class="airline">Anyang Airlines</span>
        <span class="airline airlineslip">Anyang Airlines</span>
        <span class="boarding">Boarding pass</span>
        <div class="content">
            <span class="jfk"><?php if($row){ echo $row['boardingName'];} else {
                    echo '<script>alert("바른 정보를 입력하세요"); history.back(-1)</script>';
                } ?></span>
            <span class="plane"><svg clip-rule="evenodd" fill-rule="evenodd" height="60" width="60" image-rendering="optimizeQuality" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg"><g stroke="#222"><line fill="none" stroke-linecap="round" stroke-width="30" x1="300" x2="55" y1="390" y2="390"/><path d="M98 325c-9 10 10 16 25 6l311-156c24-17 35-25 42-50 2-15-46-11-78-7-15 1-34 10-42 16l-56 35 1-1-169-31c-14-3-24-5-37-1-10 5-18 10-27 18l122 72c4 3 5 7 1 9l-44 27-75-15c-10-2-18-4-28 0-8 4-14 9-20 15l74 63z" fill="#222" stroke-linejoin="round" stroke-width="10"/></g></svg></span>
            <span class="sfo"><?php echo $row['arrivalName']?></span>

            <span class="jfk jfkslip"><?php echo $row['boardingName']?></span>
            <span class="plane planeslip"><svg clip-rule="evenodd" fill-rule="evenodd" height="50" width="50" image-rendering="optimizeQuality" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg"><g stroke="#222"><line fill="none" stroke-linecap="round" stroke-width="30" x1="300" x2="55" y1="390" y2="390"/><path d="M98 325c-9 10 10 16 25 6l311-156c24-17 35-25 42-50 2-15-46-11-78-7-15 1-34 10-42 16l-56 35 1-1-169-31c-14-3-24-5-37-1-10 5-18 10-27 18l122 72c4 3 5 7 1 9l-44 27-75-15c-10-2-18-4-28 0-8 4-14 9-20 15l74 63z" fill="#222" stroke-linejoin="round" stroke-width="10"/></g></svg></span>
            <span class="sfo sfoslip"><?php echo $row['arrivalName']?></span>
            <div class="sub-content">
                <span class="watermark">DBPROJECT</span>
                <span class="name">PASSENGER NAME<br><span><?php echo $row['passengerName']?></span></span>
                <span class="flight">FLIGHT N&deg;<br><span><?php echo $row['flightName']?></span></span>
                <span class="gate">GATE<br><span>11B</span></span>
                <span class="seat">SEAT<br><span><?php echo $row['reservationSeatNum']?></span></span>
                <span class="boardingtime">BOARDING TIME<br><span><?php echo date_format($row['reservationDate'],"Y/m/d")?></span></span>

                <span class="flight flightslip">FLIGHT N&deg;<br><span><?php echo $row['flightName']?></span></span>
                <span class="seat seatslip">SEAT<br><span><?php echo $row['reservationSeatNum']?></span></span>
                <span class="name nameslip">PASSENGER NAME<br><span><span><?php echo $row['passengerName']?></span></span>
            </div>
        </div>
        <div class="barcode"></div>
        <div class="barcode slip"></div>
    </div>
</div>

<div>
    <h1 style="font-size: 50px; margin-top: 12rem; margin-left: 48rem">온라인 발권</h1>
    <h4 style="margin-top: 3rem; font-size: 20px; margin-left: 50rem">입장할 때 제시해주세요.</h4>
</div>


</body>

</html>