<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@700&display=swap" rel="stylesheet">
    <link href="CSS/global.css" rel="stylesheet">
    <link href="CSS/ticket.css" rel="stylesheet">
    <title>Ticketing</title>
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
        </a>
    </div>
    <hr>
</header>

<body>
<div id = "wrapper">
    <div class = "ticketing">
        <h1 class = "title">예매 취소</h1>
        <h6 style="margin: 0.6rem 0rem 0rem 0rem">각 항목을 적어주세요.</h6>
        <hr style="margin: 1.5rem 0rem 0rem 0rem">
        <p class = "reservationNum">예매 번호 : <input type="text" name="reservationNum" style="width:500px; height: 40px; font-size: 25px;" placeholder="예) 123ABCD 또는 1234567"/></p>
        <p class = "passengerName">승객 이름 : <input type="text" name = "passengerName" style="width:500px; height: 40px; font-size: 25px;"/></p>
        <hr>
        <button style="margin: 1.5rem 0rem 0rem 0rem" name="submit" type="submit" id="contact-submit" data-submit="...Sending">취소하기</button>
        <script>
            const btn = document.getElementById('contact-submit');

            btn.addEventListener({

            })
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

                $query="";

                $cntQuery="SELECT count(*) FROM dbo.Airport";
                $result=sqlsrv_query($conn, $query);
                $cnt=sqlsrv_query($conn, $cntQuery);
                $row = sqlsrv_fetch_array($result);

                //echo '<h1>'.$row['boardingName'].'</h1>';
            ?>
        </script>

    </div>
</div>
</body>
</html>