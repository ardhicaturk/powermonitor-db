<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Origin: http://127.0.0.1:8000', true);
header('Access-Control-Allow-Origin: http://127.0.0.1:8000/*', true);
?>
<html>
<head>
	<header name = "Access-Control-Allow-Origin" value = "http://127.0.0.1:8000" />
	<header name = "Access-Control-Allow-Origin" value = "http://127.0.0.1:8000/*" />
	<header name = "Access-Control-Allow-Origin" value = "*" />
	<header name = "Access-Control-Allow-Header" value = "Content-Type" />
	<title>Monitoring</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <meta http-equiv="refresh" content="3" > -->
	<script language="javascript" type="text/javascript" src="js/jquery-3.1.1.js"></script>
	
	<script language="javascript" type="text/javascript" src="js/script.js"></script>
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link href="css/css/fontawesome-all.css" rel="stylesheet">
</head>
<body>
	<div class="head">
		<h1>Sistem Monitoring dan Kendali</h1>
	</div>
	<div class="frame wrap">
		<div class="grid1">
		<div id="map">
			<div class="power-grid">
				<h1 class="title">Source Power</h1>
				<div class="grid-mon">
					
				</div>
			</div>
			<div class="load-grid">
				<h1 class="title">Load</h1>
				<div class="grid-mon2">
					
				</div>
			</div>
		</div>

	</div>
		<div class="grid12">
			<div class="time">
			
				<script> 
				function getTime(){
					$(".time").empty();
					$(".time").append(new Date());
				}
				setInterval(getTime, 1000);
				</script>
			</div>
			<div class="grid21">
				<div id="debugDiv"></div>
			</div>
			<div class="grid22">
				<a href="datalog.php"><div class="button-datalog"><i class="fas fa-history fa-1x"></i> Data Log</div><a>	
				<p>*Refreshed every 10 seconds</p>
			</div>
		</div>
	</div>
	<div class='foot'>
		SPAES Research Team &copy 2018
		<div class="foot-content">
			<?php include "about.php"; ?>
		</div>
	</div>
</body>
</html>