<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>아냥항공 예매 | 항공편 선택</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@700&display=swap" rel="stylesheet">
    <link href="CSS/reserve_choose.css" rel="stylesheet">
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
    $boardData = $_POST["board"];
    $arriveData = $_POST["arrive"];
    $dateData = $_POST["date"];
    $personData = $_POST["count"];
    $LevelData = $_POST["level"];
    $boardingInputTime = $dateData . ' 00:00:00';
    $arrivalInputTime = date('Y-m-d H:i:s', strtotime($boardingInputTime.'+1 days'));

    // SQL Server Extension Sample Code:
    $connectionInfo = array("UID" => "wagyu", "pwd" => "a123456789!", "Database" => "airline", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:wagyu.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    $query="SELECT s.scheduleNum as schedule, bn.airportName as boardingName, bn.countryName as boardingCName, an.airportName as arrivalName, an.countryName as arrivalCName, s.boardingTime as boardingTime, s.arrivalTime as arrivalTime FROM Schedule as s, Airport as bn, Airport as an WHERE s.boardingAirportNum = bn.airportNum AND s.arrivalAirportNUM = an.airportNum AND '" . $boardData . "' = bn.airportName AND '" . $arriveData . "' = an.airportName AND s.boardingTime >= '" . $boardingInputTime . "' AND s.arrivalTime <= '" . $arrivalInputTime . "'";
    //$query = "SELECT s.scheduleNum as schedule, bn.airportName as boardingName, bn.countryName as boardingCName, an.airportName as arrivalName, an.countryName as arrivalCName, s.boardingTime as boardingTime, s.arrivalTime as arrivalTime FROM Schedule as s, Airport as bn, Airport as an WHERE s.boardingAirportNum = bn.airportNum AND s.arrivalAirportNUM = an.airportNum AND 'ICN' = bn.airportName AND 'NRT' = an.airportName AND s.boardingTime >= '2022-06-07 00:00:00' AND s.arrivalTime <= '2022-06-08 00:00:00'";
    $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query($conn, $query, $params, $options);

    $cnt = sqlsrv_num_rows($result);
?>

<header>
    <div id="topbar">
        <img id="logo" src="https://img1.daumcdn.net/thumb/R1280x0/?scode=mtistory2&fname=https%3A%2F%2Fblog.kakaocdn.net%2Fdn%2FmTY6l%2Fbtqy91YJt2z%2F8Tz79w07TkrolukN22AJQk%2Fimg.jpg" alt="아냥항공" />
        <div id="menu">
            <div class="login-btn">
                <a href="404page.html" class="btn_l"><i class="fas fa-sign-in-alt"></i>&nbsp 환영합니다</a>
            </div>
        </div>
    </div>
</header>

<body>
<div class="section">
    <div class="tpd-plan">
        <div class="tp-flight-plan">
            <div class="container-fluid">
                <!-- 편도, 왕복 -->
                <div id="node" class="crop depart" style="display: none">
                    <div class="context collapsed" data-toggle="collapse" data-target="#demo2">
                        <a role="button" tabindex="0" class="tog-cal itin-det-btn">
                            <i class="fa fa-chevron-up"></i>
                            <i class="fa fa-chevron-down"></i>
                        </a>
                        <div class="item it-1">
                            <form action="reservation_receipt.php" name="scheduleForm" id="scheduleForm" method="post">
                                <input type="text" class="_hidden" style="display: none" name="schedule_num" id="schedule_num" value="48452111">
                            </form>
                            <label class="trip-type depart">Departure</label>
                            <div class="route-dot">
                            </div>
                            <div class="airline-image">
                                <div id="kr_Airplane_time" class="df-text">1 시간 32분</div>
                                <span class="img-wrapper">
                                    <svg class="anime-airplane">
                                        <use xlink:href="#airplane"></use>
                                    </svg>
                                    <span class="top-label has-stops">No Stops</span>
                                </span>
                            </div>

                            <div class="port-seg">
                                <div class="flight-seg origin">
                                    <div id="air_boarding_time" class="time">10:30</div>
                                    <div id="air_boarding_Name" class="port">ICN</div>
                                    <div id="air_boarding_CName" class="name">Incheon</div>
                                </div>
                                <div class="flight-seg destination">
                                    <div id="air_arrival_time" class="time">01:30</div>
                                    <div id="air_arrival_Name" class="port">NRT</div>
                                    <div id="air_arrival_CName" class="name">Tokyo</div>
                                </div>
                            </div>
                        </div>
                        <div class="item it-2">
                            <div class="dr-row">
                                <span class="al-name">아냥항공</span>
                            </div>
                            <div id="kr_Title_Date1" class="take-tim">2022 06 07 화</div>
                        </div>
                    </div>
                    <div id="demo2" class="fly-wrap collapse">
                        <div class="fly-det">
                            <div class="f-item">
                                <div class="airway-title">
                                    <img class="airline-logo" src="https://w.namu.la/s/edf511d6ba2084cd6d8319decf8c36545325bd47d8a6a056aceb2860666a5484fee7a360bc6fcc04f7a01e048631327e460a58d4b12e671d7a681c8bfa6726c4673614333fcb51c47e86c77e2ec74db60f91fdb125b1c362687dca31ec7b9f5e" /> <span>아냥항공</span>
                                </div>
                                <div class="root-de">
                                    <div id="kr_between_time" class="times"> 1 시간 32분 </div>
                                    <div class="directs">
                                        <div class="itin-time">
                                            <div class="itin-lines"></div>
                                        </div>

                                        <div class="hour-sm">
                                            <div id="between_boarding_time" class="hour-time-sm">02:10</div>

                                            <div id="between_arrival_time" class="hour-time-sm">05:55</div>
                                        </div>
                                    </div>

                                    <div class="itin-target">
                                        <div id="boarding_name_label" class="tar-label">ICN Incheon</div>
                                        <div id="arrival_name_label" class="tar-label">NRT Tokyo</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="arrival-info">
                            <span id="kr_Title_Date2" class="sub-span">
                                <strong>Arrives:</strong>
                                2022 06 07 화
                            </span>
                            <span id="kr_last_Time" class="sub-span duration-info">
                                <strong>Journey duration:</strong>
                                1시간 32분
                            </span>
                        </div>
                    </div>
                </div>
                <div id="target"></div>
                <!-- -->
                <script>
                    var node = document.getElementById('node');
                    var target = document.getElementById('target');

                    <?php
                        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                            echo ("var clone = node.cloneNode(true);");
                            echo ("clone.style.display = 'block';");

                            $scheduleNum = $row['schedule'];
                            $boardingName = $row['boardingName'];
                            $arrivalName = $row['arrivalName'];
                            $boardingCName = $row['boardingCName'];
                            $arrivalCName = $row['arrivalCName'];

                            $kr_Date = date_format($row['boardingTime'], 'Y m d D');
                            $tmp1 = date_format($row['boardingTime'], 'H:i:s');
                            $tmp2 = date_format($row['arrivalTime'], 'H:i:s');
                            $kr_time = strtotime($tmp2) - strtotime($tmp1);
                            $cut_B_time = date_format($row['boardingTime'], 'H:i');
                            $cut_Atime = date_format($row['arrivalTime'], 'H:i');

                            $hour = floor($kr_time/3600);
                            $minute = $kr_time - ($hour * 3600);
                            $minute = floor($minute/ 60);
                            $kr_time = $hour . "시간 " . $minute . "분";

                            echo("clone.querySelector('#schedule_num').value = '$scheduleNum';");
                            echo("clone.querySelector('#kr_Airplane_time').innerHTML = '$kr_time';");
                            echo("clone.querySelector('#air_boarding_Name').innerHTML = '$boardingName';");
                            echo("clone.querySelector('#air_boarding_time').innerHTML = '$cut_B_time';");
                            echo("clone.querySelector('#air_boarding_Name').innerHTML = '$boardingName';");
                            echo("clone.querySelector('#air_boarding_CName').innerHTML = '$boardingCName';");
                            echo("clone.querySelector('#air_arrival_time').innerHTML = '$cut_Atime';");
                            echo("clone.querySelector('#air_arrival_Name').innerHTML = '$arrivalName';");
                            echo("clone.querySelector('#air_arrival_CName').innerHTML = '$arrivalCName';");
                            echo("clone.querySelector('#kr_Title_Date1').innerHTML = '$kr_Date';");
                            echo("clone.querySelector('#kr_between_time').innerHTML = '$kr_time';");
                            echo("clone.querySelector('#between_boarding_time').innerHTML = '$cut_B_time';");
                            echo("clone.querySelector('#between_arrival_time').innerHTML = '$cut_Atime';");
                            echo("clone.querySelector('#boarding_name_label').innerHTML = '$boardingName $boardingCName';");
                            echo("clone.querySelector('#arrival_name_label').innerHTML = '$arrivalName $arrivalCName';");
                            echo("clone.querySelector('#kr_Title_Date2').innerHTML = '$kr_Date';");
                            echo("clone.querySelector('#kr_last_Time').innerHTML = '$kr_time';");
                            echo("target.append(clone);");
                        }
                    ?>

                    target.addEventListener('click', function(event){
                        let pay = confirm("결제하시겠습니까?\n\n확인 시 결제페이지로 이동합니다.");
                        if(pay) {
                            var data = {
                                "boardingTime" : target.querySelector('#kr_Title_Date1').innerHTML,
                                "arrivalTime" : target.querySelector('#air_arrival_time').innerHTML,
                                "boardingName" : target.querySelector('#air_boarding_Name').innerHTML,
                                "boardingCName" : target.querySelector('#air_boarding_CName').innerHTML,
                                "arrivalName" : target.querySelector('#air_arrival_Name').innerHTML,
                                "arrivalCName" : target.querySelector('#air_arrival_CName').innerHTML,
                                "personData" : "<?php echo $personData; ?>",
                                "LevelData" : "<?php echo $LevelData; ?>"
                            };
                            localStorage.setItem(("data"), JSON.stringify(data));
                            document.getElementById('scheduleForm').submit();
                        }
                    });
                </script>
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" display="none">
        <symbol  id="airplane" viewBox="243.5 245.183 25 21.633">
            <g>
                <path d="M251.966,266.816h1.242l6.11-8.784l5.711,0.2c2.995-0.102,3.472-2.027,3.472-2.308
                              c0-0.281-0.63-2.184-3.472-2.157l-5.711,0.2l-6.11-8.785h-1.242l1.67,8.983l-6.535,0.229l-2.281-3.28h-0.561v3.566
                              c-0.437,0.257-0.738,0.724-0.757,1.266c-0.02,0.583,0.288,1.101,0.757,1.376v3.563h0.561l2.281-3.279l6.535,0.229L251.966,266.816z
                "/>
            </g>
        </symbol>
    </svg>
</div>

</body>
</html>