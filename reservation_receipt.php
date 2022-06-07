<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>아냥항공 예매완료</title>
    <link href="CSS/reservation_receit.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://kit.fontawesome.com/0f016a68f0.js" crossorigin="anonymous"></script>
</head>

<?php
    date_default_timezone_set('Asia/Seoul');

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
?>

<body>

<main class="ticket-system">
    <div class="top">
        <h1 class="title">잠시만 기다려주세요, 당신의 티켓이 출력되고 있습니다. </h1>
        <div class="printer" />
    </div>
    <div class="receipts-wrapper">
        <div class="receipts">
            <div class="receipt">
                <svg class="airliner-logo" viewBox="0 0 403 94" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="1.414">
                    <img id="logo" src="https://img1.daumcdn.net/thumb/R1280x0/?scode=mtistory2&fname=https%3A%2F%2Fblog.kakaocdn.net%2Fdn%2FmTY6l%2Fbtqy91YJt2z%2F8Tz79w07TkrolukN22AJQk%2Fimg.jpg" alt="아냥항공" />
                </svg>
                <div class="route">
                    <h2 id="from_id">NYC</h2>
                    <svg class="plane-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 510 510">
                        <path fill="#5497e9" d="M497.25 357v-51l-204-127.5V38.25C293.25 17.85 275.4 0 255 0s-38.25 17.85-38.25 38.25V178.5L12.75 306v51l204-63.75V433.5l-51 38.25V510L255 484.5l89.25 25.5v-38.25l-51-38.25V293.25l204 63.75z"/>
                    </svg>
                    <h2 id="to_id">ATL</h2>
                </div>
                <div class="details">
                    <div class="item">
                        <span>탑승자</span>
                        <h3 id="passenger">69Pixels</h3>
                    </div>
                    <div class="item">
                        <span>항공기 번호</span>
                        <h3 id="plane_num">US6969</h3>
                    </div>
                    <div class="item">
                        <span>결제 금액</span>
                        <h3 id="price">690000</h3>
                    </div>
                    <div class="item">
                        <span>출발 날짜</span>
                        <h3 id="departure_time">08/26/2018 15:33</h3>
                    </div>
                    <div class="item">
                        <span>출발 시간</span>
                        <h3 id="arrival_time">15:03</h3>
                    </div>
                    <div class="item">
                        <span>수하물</span>
                        <h3 id="luggage">휴대 가능 수하물</h3>
                    </div>
                    <div class="item">
                        <span>좌석 등급</span>
                        <h3 id="seat_num">비즈니스</h3>
                    </div>
                </div>
            </div>
            <div class="receipt qr-code">
                <svg class="qr" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29.938 29.938">
                    <path d="M7.129 15.683h1.427v1.427h1.426v1.426H2.853V17.11h1.426v-2.853h2.853v1.426h-.003zm18.535 12.83h1.424v-1.426h-1.424v1.426zM8.555 15.683h1.426v-1.426H8.555v1.426zm19.957 12.83h1.427v-1.426h-1.427v1.426zm-17.104 1.425h2.85v-1.426h-2.85v1.426zm12.829 0v-1.426H22.81v1.426h1.427zm-5.702 0h1.426v-2.852h-1.426v2.852zM7.129 11.406v1.426h4.277v-1.426H7.129zm-1.424 1.425v-1.426H2.852v2.852h1.426v-1.426h1.427zm4.276-2.852H.002V.001h9.979v9.978zM8.555 1.427H1.426v7.127h7.129V1.427zm-5.703 25.66h4.276V22.81H2.852v4.277zm14.256-1.427v1.427h1.428V25.66h-1.428zM7.129 2.853H2.853v4.275h4.276V2.853zM29.938.001V9.98h-9.979V.001h9.979zm-1.426 1.426h-7.127v7.127h7.127V1.427zM0 19.957h9.98v9.979H0v-9.979zm1.427 8.556h7.129v-7.129H1.427v7.129zm0-17.107H0v7.129h1.427v-7.129zm18.532 7.127v1.424h1.426v-1.424h-1.426zm-4.277 5.703V22.81h-1.425v1.427h-2.85v2.853h2.85v1.426h1.425v-2.853h1.427v-1.426h-1.427v-.001zM11.408 5.704h2.85V4.276h-2.85v1.428zm11.403 11.405h2.854v1.426h1.425v-4.276h-1.425v-2.853h-1.428v4.277h-4.274v1.427h1.426v1.426h1.426V17.11h-.004zm1.426 4.275H22.81v-1.427h-1.426v2.853h-4.276v1.427h2.854v2.853h1.426v1.426h1.426v-2.853h5.701v-1.426h-4.276v-2.853h-.002zm0 0h1.428v-2.851h-1.428v2.851zm-11.405 0v-1.427h1.424v-1.424h1.425v-1.426h1.427v-2.853h4.276v-2.853h-1.426v1.426h-1.426V7.125h-1.426V4.272h1.426V0h-1.426v2.852H15.68V0h-4.276v2.852h1.426V1.426h1.424v2.85h1.426v4.277h1.426v1.426H15.68v2.852h-1.426V9.979H12.83V8.554h-1.426v2.852h1.426v1.426h-1.426v4.278h1.426v-2.853h1.424v2.853H12.83v1.426h-1.426v4.274h2.85v-1.426h-1.422zm15.68 1.426v-1.426h-2.85v1.426h2.85zM27.086 2.853h-4.275v4.275h4.275V2.853zM15.682 21.384h2.854v-1.427h-1.428v-1.424h-1.427v2.851zm2.853-2.851v-1.426h-1.428v1.426h1.428zm8.551-5.702h2.853v-1.426h-2.853v1.426zm1.426 11.405h1.427V22.81h-1.427v1.426zm0-8.553h1.427v-1.426h-1.427v1.426zm-12.83-7.129h-1.425V9.98h1.425V8.554z"/>
                </svg>
                <div class="description">
                    <h2> 아냥 항공 </h2>
                    <p>승무원에게 QR코드를 보여주세요 </p>
                </div>
            </div>
        </div>
        <script>
            const data = JSON.parse(localStorage.getItem("data"));
            const boardingName = data.boardingName;
            const arrivalName = data.arrivalName;
            const boardingTime = data.boardingTime;
            const arrivalTime = data.arrivalTime;
            const level = data.LevelData;

            <?php
                $scheduleNum = $_POST["schedule_num"];

                $query="SELECT flightName, price FROM Schedule WHERE '" . $scheduleNum . "' = scheduleNum";
                $result = sqlsrv_query($conn, $query);

                $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                $id = $_COOKIE['id'];
            ?>

            const flightNum = '<?php echo $row["flightName"]; ?>';

            const person = '<?php echo $id; ?>';

            document.querySelector("#from_id").innerHTML = boardingName;
            document.querySelector("#to_id").innerHTML = arrivalName;
            document.querySelector("#passenger").innerHTML = person;
            document.querySelector("#plane_num").innerHTML = flightNum;
            document.querySelector("#departure_time").innerHTML = boardingTime;
            document.querySelector("#arrival_time").innerHTML = arrivalTime;
            document.querySelector("#price").innerHTML = <?php echo $row["price"] ?>;
            document.querySelector("#seat_num").innerHTML = level;

            <?php
                $reservationDate = date('Y-m-d');
                $query="INSERT INTO Reservation VALUES ('R1132342', '" . $reservationDate . "', '" . $row['price'] . "', '112233', '101A', '" . $scheduleNum . "')";
                $result = sqlsrv_query($conn, $query);
            ?>

        </script>
    </div>
</main>

</body>

</html>