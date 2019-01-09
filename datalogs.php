<html>
<div class="overlay"></div>
<style>
	.overlay{
		position:fixed;
		top:0;
		z-index:1000;
		color:white;
		width:100vw;
		height:100vh;
		display:none;
	}

	.contain{
		display:none;
		z-index:10000;
		position:fixed;
		width:40vw;
		height:40vh;
		top:30vh;
		left:30vw;
		text-align:center;
		border:solid 1px;
		border-radius:5px;
		transition: height .35s ease;
		background:rgba(255,255,255,0.7);
		-webkit-box-shadow: -2px 7px 57px -1px rgba(0,0,0,0.51);
		-moz-box-shadow: -2px 7px 57px -1px rgba(0,0,0,0.51);
		box-shadow: -2px 7px 57px -1px rgba(0,0,0,0.51);
	}
	select{
		margin: 10px;
		padding: 5px;
		text-align: center;
	}
	.contain #down{
		background: #555555;
		color:white;
		margin: 10px;
		padding: 5px;
	}
	.contain #close{
		position:absolute;
		left:37vw;
		background:rgba(255,255,255,0);
		color:red;
		border:0;
		border-radius:10px;
		padding:5px;
		width:30px;
		height:30px;
		transition: background .35s ease, box-shadow .35 ease;
	}
	.contain #close:hover{
		background:rgba(255,255,255,0.6);
		box-shadow: -2px 7px 30px -1px rgba(0,0,0,0.51);
	}
	@media only screen and (max-width: 425px)  {
		.contain{
			width:100vw;
			left:0;
		}
		.contain #close{
			left:94vw;
		}
	}	
</style>
<?php

include "data.php";

$thn[]=0; $ithn = 0;
$bln[]=0; $ibln = 0;
$hri[]=0; $ihri = 0;
$dataperpage = 50;
$bDate = false;
$iGet = $_GET['args'];
$buff = $tablename[$iGet];
$result = mysqli_query($koneksi,"SELECT * FROM $buff ORDER BY no ASC");
if ($result){
	while ($row = mysqli_fetch_assoc($result)) {
		$parse = explode(' ', $row["time"]);
		$parse2 = explode('-', $parse[0]);
		if($ithn == 0 && $ibln == 0 && $ihri == 0){
			if($ithn == 0) {$thn[0] = $parse2[0]; $ithn++;}
			if($ibln == 0) {$bln[0] = $parse2[1]; $ibln++;}
			if($ihri == 0) {$hri[0] = $parse2[2]; $ihri++;}
		} else {
			if($parse2[0] != $thn[$ithn-1]){array_push($thn, $parse2[0]); $ithn++;}
			if($parse2[1] != $bln[$ibln-1]){array_push($bln, $parse2[1]); $ibln++;}
			if($parse2[2] != $hri[$ihri-1]){array_push($hri, $parse2[2]); $ihri++;}
		}
	}
} else {
	echo "Failed: Fetch assoc (line 79)";
}
$bufithn = $ithn;
$bufibln = $ibln;
$bufihri = $ihri;
$ithn2 = $ithn;
$ibln2 = $ibln;
$ihri2 = $ihri;
$sl = 1;
if(isset($_POST['submit'])){
	$hari1 = (int)$_POST['hari1'];
	$bulan1 = (int)$_POST['bulan1'];
	$tahun1 = (int)$_POST['tahun1'];
	$hari2 = (int)$_POST['hari2'];
	$bulan2 = (int)$_POST['bulan2'];
	$tahun2 = (int)$_POST['tahun2'];
	$sl = (int)$_POST['pageNation'];
	$date1 = date($tahun1.'-'.$bulan1.'-'.$hari1.' 00:00:01');
	$date2 = date($tahun2.'-'.$bulan2.'-'.$hari2.' 23:59:59');
	$count = "SELECT * FROM `$buff` WHERE `time` BETWEEN '$date1' AND '$date2'";
	$countResult = mysqli_query($koneksi,$count);
	$rowcount=mysqli_num_rows($countResult);
	$dataperpage = (int)$_POST['dataperpage'];
	$countResult = 0;
} else {
	$date1 = date('Y-m-d 00:00:00');
	$date2 = date('Y-m-d 23:59:59');
}

		

?>
<div class="selectDate" style="text-align:center;">
<form method="post">
	<select id class="selectHari" name="hari1" style="padding:2px;margin:5px;">
		<?php
			for ($i = $ihri-1; $i >= 0; $i--){
				if((int)$hri[$i] == $hari1){
					echo "<option value='$hri[$i]' selected='selected'>$hri[$i]</option>";
				} else {
					echo "<option value='$hri[$i]'>$hri[$i]</option>";
				}
			}
			
		?>
	</select>
	<select id class="selectBulan" name="bulan1" style="padding:2px;margin:5px;">
		<?php 
			for ($i = $ibln-1; $i >= 0; $i--){
				if((int)$bln[$i] == $bulan1){
					echo "<option value='$bln[$i]' selected='selected'>$bln[$i]</option>";
				} else {
					echo "<option value='$bln[$i]'>$bln[$i]</option>";
				}
			}
		?>
	</select>
	<select id class="selectTahun" name="tahun1" style="padding:2px;margin:5px;">
		<?php 
			for ($i = $ithn-1; $i >= 0; $i--){
				if((int)$thn[$i] == $bulan1){
					echo "<option value='$thn[$i]' selected='selected'>$thn[$i]</option>";
				} else {
					echo "<option value='$thn[$i]'>$thn[$i]</option>";
				}
			}
		?>
	</select>
	<a> To </a>
	<select id class="selectHari" name="hari2" style="padding:2px;margin:5px;">
		<?php 
			for ($i = $ihri2-1; $i >= 0; $i--){
				if((int)$hri[$i] == $hari2){
					echo "<option value='$hri[$i]' selected='selected'>$hri[$i]</option>";
				} else {
					echo "<option value='$hri[$i]'>$hri[$i]</option>";
				}
			}
		?>
	</select>
	<select id class="selectBulan" name="bulan2" style="padding:2px;margin:5px;">
		<?php 
			for ($i = $ibln2-1; $i >= 0; $i--){
				if((int)$bln[$i] == $bulan2){
					echo "<option value='$bln[$i]' selected='selected'>$bln[$i]</option>";
				} else {
					echo "<option value='$bln[$i]'>$bln[$i]</option>";
				}
			}
		?>
	</select>
	<select id class="selectTahun" name="tahun2" style="padding:2px;margin:5px;">
		<?php 
			for ($i = $ithn2-1; $i >= 0; $i--){
				if((int)$thn[$i] == $tahun2){
					echo "<option value='$thn[$i]' selected='selected'>$thn[$i]</option>";
				} else {
					echo "<option value='$thn[$i]'>$thn[$i]</option>";
				}
			}
		?>
	</select>
	<a>Data/hal: </a>
	<select id class="dataperpage" name="dataperpage" style="padding:2px;margin:5px;">
		<?php
			$listA = array(50,100,200);
			for ($i = 0; $i < 3; $i++){
				if($listA[$i] == $dataperpage){
					echo "<option value='$listA[$i]' selected='selected'>$listA[$i]</option>";
				} else {
					echo "<option value='$listA[$i]'>$listA[$i]</option>";
				}
			}
		?>
	</select>
	<a>Hal: </a>
	<select id class="pageNation" name="pageNation" style="padding:2px;margin:5px;">
		<?php
		$countResult = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM `$buff` WHERE `time` BETWEEN '$date1' AND '$date2'");

		$dat = mysqli_fetch_assoc($countResult);
		$rowcount= $dat['total'];
		$pg = $rowcount/$dataperpage;
		$k = 0;
		while($pg > 0){
				$pg--;
				$k++;
				if($k != $sl){
					echo "<option value='$k'>$k</option>";
				} else {
					echo "<option value='$k' selected>$k</option>";
				}
			}
		$countResult = 0;
		?>
	</select>
	
	<input type="submit" name="submit" value="Show" />
	
</form>
	<button id="buttonDownload">Download</button><br>
	
</div>
<table width="100%" border="1 solid" align="center">
	<tr bgcolor="#ff7373">
	<th width="5%" align="center">No</th>
	<th width="35%" align="center">Date & Time </th>
	<?php 
	if($iGet != 2 && $iGet != 3){
		echo "<th width=\"15%\" align='center'>Tegangan (V)</th>";
		echo "<th width=\"15%\" align=\"center\">Arus (A)</th>";
		echo "<th width=\"15%\" align=\"center\">Daya (W)</th>";
		echo "<th width=\"15%\" align=\"center\">Kondisi</th>";
	} else {
		if($iGet == 2){
			echo "<th width=\"12%\" align='center'>Tegangan (V)</th>";
			echo "<th width=\"12%\" align=\"center\">Arus (A)</th>";
			echo "<th width=\"12%\" align=\"center\">Daya (W)</th>";
			echo "<th width=\"12%\" align=\"center\">Cahaya</th>";
			echo "<th width=\"12%\" align=\"center\">Kondisi</th>";
		} 
		if($iGet == 3){
			echo "<th width=\"12%\" align='center'>Tegangan (V)</th>";
			echo "<th width=\"12%\" align=\"center\">Arus (A)</th>";
			echo "<th width=\"12%\" align=\"center\">Daya (W)</th>";
			echo "<th width=\"12%\" align=\"center\">RPM</th>";
			echo "<th width=\"12%\" align=\"center\">Kondisi</th>";
		}
	}
	?>
	</tr>
<?php
$paramWaktu =0;
$maxDatalog = $sl * $dataperpage;
$minDatalog = ($sl * $dataperpage) - ($dataperpage);
$index = $minDatalog+1;
$result = mysqli_query($koneksi,"SELECT * FROM $buff WHERE `time` BETWEEN '$date1' AND '$date2' LIMIT 1");
$strNum=0;
while ($row = mysqli_fetch_assoc($result)) {
	$strNum = $row['no']; 
}
$maxDatalog = $maxDatalog + $strNum;
$minDatalog = $minDatalog + $strNum;
$result = mysqli_query($koneksi,"SELECT * FROM $buff WHERE (`time` BETWEEN '$date1' AND '$date2') AND (no >= $minDatalog AND no < $maxDatalog)");
if($result){
	while ($row = mysqli_fetch_assoc($result)) {
		
		echo "<tr><td align='center'>";
		echo $index;
		echo "</td><td>";
		echo $row["time"];
		echo "</td><td>";
		echo $row["tegangan"];
		echo "</td><td>";
		echo $row["arus"];
		echo "</td><td>";
		echo $row["daya"];
		echo "</td>";
		if($iGet == 2){
			echo "<td>";
			echo $row["cahaya"];
			echo "</td>";
		} else if($iGet == 3){
			echo "<td>";
			echo $row["rpm"];
			echo "</td>";
		}
		$strKon;
		if($row["kondisi"]){
			$strKon = "<td align='center' style='color:white;background:green'>ON";
		} else {
			$strKon = "<td align='center' style='color:white;background:red'>OFF";
		}
		echo $strKon;
		echo "</td>";
		$index++;
		
	}
} else {
	echo "Failed: Fetch assoc (line 278)";
}


echo "</table>"

#echo json_encode($array);
?>

<div class="contain">
<button id="close">X</button>
<h1>Downloads: <?php echo strtoupper($buff); ?></h1>
	<select id="tipeS" style="display:none;">
		<?php 
			echo "<option value='$buff' selected='selected'>$buff</option>";
		?>
	</select>
	<select id="argsSelect">
		<option value="1" selected="selected">Harian</option>
		<option value="2" >Bulanan</option>
		<option value="3" >Tahunan</option>
	</select>
	<br>
	<select id="dateH">
		<?php 
			$bufihri--;
			echo "<option value='$hri[$bufihri]' selected='selected'>$hri[$bufihri]</option>";
			while($bufihri > 0){
				$bufihri--;
				echo "<option value='$hri[$bufihri]'>$hri[$bufihri]</option>";
			}
		?>
	</select>
	<select id="dateB">
		<?php 
			$bufibln--;
			echo "<option value='$bln[$bufibln]' selected='selected' >$bln[$bufibln]</option>";
			while($bufibln > 0){
				$bufibln--;
				echo "<option value='$bln[$bufibln]'>$bln[$bufibln]</option>";
			}
		?>
	</select>
	<select id="dateT">
		<?php 
			$bufithn--;
			echo "<option value='$thn[$bufithn]' selected='selected'>$thn[$bufithn]</option>";
			while($bufithn > 0){
				$bufithn--;
				echo "<option value='$thn[$bufithn]'>$thn[$bufithn]</option>";
			}
		?>
	</select>
	<br>
	
	<button id="down">Download</button>
</div>
<script language="javascript" type="text/javascript" src="js/jquery-3.1.1.js"></script>
<script>
	$("#argsSelect").change(function(){
		switch(Number($("#argsSelect").val())){
			case 1:
				$("#dateH").css("display","inline-block");
				$("#dateB").css("display","inline-block");
				$("#dateT").css("display","inline-block");
			break;
			case 2:
				$("#dateH").css("display","none");
				$("#dateB").css("display","inline-block");
				$("#dateT").css("display","inline-block");
			break;
			case 3:
				$("#dateH").css("display","none");
				$("#dateB").css("display","none");
				$("#dateT").css("display","inline-block");
			break;
			default:
			break;
		}
	});
	$("#close").click(function(){
		$(".contain").css("display","none");
		$(".overlay").css("display","none");
		
	});
	$("#buttonDownload").click(function(){
		$(".contain").css("display","block");
		$(".overlay").css("display","block");
		/*
		var har = Number($(".selectHari").val());
		var bul = Number($(".selectBulan").val());
		var tah = Number($(".selectTahun").val());
		var r = confirm("\t Downloads Datalogs \t\n \t Date : " + har +"-"+bul+"-"+tah+"\t");
		if (r == true) {
			window.location = "download.php?file=monitoring&h="+har+"&b="+bul+"&t="+tah;
		}
		*/
	});
	$("#down").click(function(){
		var tipes = $("#tipeS").val();
		var har = Number($("#dateH").val());
		var bul = Number($("#dateB").val());
		var tah = Number($("#dateT").val());
		switch(Number($("#argsSelect").val())){
			case 2:
				har = 0;
			break;
			case 3:
				har = 0;
				bul = 0;
			break;
			default:
			break;
		}
		var r = confirm("\t Downloads Datalogs "+tipes+"\t\n \t Date : " + har +"-"+bul+"-"+tah+"\t");
		if (r == true) {
			window.location = "download.php?file=monitoring&h="+har+"&b="+bul+"&t="+tah+"&s="+tipes;
		}
		
	});
</script>

</html>