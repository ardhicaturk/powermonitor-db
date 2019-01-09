<!DOCTYPE HTML>
<html>
<head>
	<title>Monitoring Telaga</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script language="javascript" type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<link href="css/style2.css" rel="stylesheet" type="text/css">
	<link href="css/css/fontawesome-all.css" rel="stylesheet">
	<div class="head">
		<h1>Sistem Monitoring</h1>
	</div>

</head>
<body>
<div class="wrapper">
	<div class="col1">
		<div class="menu mainmenu btable">Table</div>
		<div class="menu pln">- PLN</div>
		<div class="menu genset">- Genset</div>
		<div class="menu solar">- Solar Cell</div>
		<div class="menu wt">- Wind Turbine</div>
		<div class="menu load1">- Beban 1</div>
		<div class="menu load2">- Beban 2</div>
		<div class="menu load3">- Beban 3</div>
	</div>
	<div class="col2">
	</div>
</div>
<a class="back1" href="index.php">Back</a>
</body>
<script>
	var hWin = $(window).height();
	var get = new Array("pln", "genset","solar", "wt", "load1", "load2", "load3");
	var iGet = 0;
	var bTable = true;
	$(".pln").click(function(){iGet = 0;datalog();
	$(this).css("background-color", "#a8a8b7");
	for(var i = 0; i < 7; i++){
		if(i != iGet){
			$("."+get[i]).css("background-color", "#868695");
		}
	}
	});
	$(".genset").click(function(){iGet = 1;datalog();
	$(this).css("background-color", "#a8a8b7");
	for(var i = 0; i < 7; i++){
		if(i != iGet){
			$("."+get[i]).css("background-color", "#868695");
		}
	}
	});
	$(".solar").click(function(){iGet = 2;datalog();
	$(this).css("background-color", "#a8a8b7");
	for(var i = 0; i < 7; i++){
		if(i != iGet){
			$("."+get[i]).css("background-color", "#868695");
		}
	}
	});
	$(".wt").click(function(){iGet = 3;datalog();
	$(this).css("background-color", "#a8a8b7");
	for(var i = 0; i < 7; i++){
		if(i != iGet){
			$("."+get[i]).css("background-color", "#868695");
		}
	}
	});
	$(".load1").click(function(){iGet = 4;datalog();
	$(this).css("background-color", "#a8a8b7");
	for(var i = 0; i < 7; i++){
		if(i != iGet){
			$("."+get[i]).css("background-color", "#868695");
		}
	}
	});
	$(".load2").click(function(){iGet = 5;datalog();$(this).css("background-color", "#a8a8b7");
	for(var i = 0; i < 7; i++){
		if(i != iGet){
			$("."+get[i]).css("background-color", "#868695");
		}
	}
	});
	$(".load3").click(function(){iGet = 6;datalog();
	$(this).css("background-color", "#a8a8b7");
	for(var i = 0; i < 7; i++){
		if(i != iGet){
			$("."+get[i]).css("background-color", "#868695");
		}
	}
	});
	
	function datalog(){
		if(bTable){
			$(".col2").empty();
			$(".col2").append("<iframe src='datalogs.php?args="+iGet+"' style='height:100%;width:99%;'></iframe>");
		} else {
			$(".col2").empty();
			$(".col2").append("<iframe src='chartlog.php?args="+get[iGet]+"' style='height:100%;width:99%;'></iframe>");
		}
	}
	$( document ).ready(function() {
		datalog();
		$(".back1").css("top",hWin-40);
		$(".pln").css("background-color", "#a8a8b7");
	});
	$(".bchart").click(function(){bTable=false;datalog();});
	$(".btable").click(function(){bTable=true;datalog();});
	

	
</script>
</html>