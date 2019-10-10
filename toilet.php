<?php 
    include 'include/connect.php';
 ?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Toilet Health</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <script>
        window.onload = function () {
        <?php
        $tid = $_GET['tid'];
        $cdate = date('Y-m-d');
        $sql="SELECT level, dtime FROM Odour WHERE tid = '".$tid."' AND ddate ='".$cdate."'";
        $result = mysqli_query($con,$sql);
        $dataPoints = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($dataPoints,array("y" => $row['level'], "label" => $row['dtime']));    
        }
        ?>
 
        var chart1 = new CanvasJS.Chart("chartActivity", {
            title: {
                text: "Daily Updates"
            },
            axisY: {
                title: "Intensity of Odour"
            },
            data: [{
                type: "line",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart1.render();

        }
    </script>
</head>
<body>

<div class="wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Real Time Data</h4>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart" ></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Sensor Data</h4>
                                <p class="category">Intensity of Odour in ppm</p>
                            </div>
                            <div class="content">
                                <div id="chartHours" class="ct-chart">
                                    <table class="table table-hover table-striped" id="myTable">
                                        <thead>
                                            <th>Time</th>
                                            <th>Odour Intensity</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $tid = $_GET['tid'];
                                            $cdate = date('Y-m-d');
                                            $sql="SELECT level, dtime FROM Odour WHERE tid = '".$tid."' AND ddate ='".$cdate."'";
                                            $result = mysqli_query($con,$sql);
                                                while($row = mysqli_fetch_array($result)) {
                                                    echo "<tr>";    
                                                    echo "<td>" . $row['dtime']. "</td>";
                                                    echo "<td>" . $row['level']. "</td>";
                                                    echo "</tr>"; 
                                                    }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Toilet Cleaner</h4>
                                <p class="category">Bio-Data</p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart">
                                    <table align="center">
                                        <?php
                                            $sql="SELECT * FROM Cleaner, Toilet WHERE tid = '".$tid."' AND Cleaner.cid = Toilet.cid";
                                            $result = mysqli_query($con,$sql);
                                            $row = mysqli_fetch_array($result);
                                            echo "<tr align=\"center\"><td>Cleaner ID</td><td><b>" . $row['cid']. "</td></tr>";   
                                            echo "<tr align=\"center\"><td>Cleaner Name</td><td><b>" . $row['cname']. "</td></tr>";
                                            echo "<tr align=\"center\"><td>Age</td><td><b>" . $row['cage']. "</td></tr>";
                                            echo "<tr align=\"center\"><td>Address</td><td><b>" . $row['caddr']. "</td></tr>";  
                                            echo "<tr align=\"center\"><td>Phone NO.</td><td><b>" . $row['cphone']. "</td></tr>";
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

	<!--  Charts Plugin -->
<!-- 	<script src="assets/js/chartist.min.js"></script>
 -->
    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<!-- 	<script src="assets/js/demo.js"></script>

 -->
</html>
