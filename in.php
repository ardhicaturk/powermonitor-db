<?php
include "data.php";

$tablename = "client";
$tableExists = mysqli_query($koneksi,"DESCRIBE `$tablename`");

if(!$tableExists){
	$sql = "CREATE TABLE $tablename(
    no INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    time datetime NOT NULL,
	temp float NOT NULL,
	do float NOT NULL,
    ph float NOT NULL,
	ntu float NOT NULL
	)";
	$result = mysqli_query($koneksi, $sql);
	if(!$result){
		echo "ERROR: Create TABLE";
	}
}
date_default_timezone_set("Asia/Jakarta");
$date = date('Y-m-d H:i:s');
if (isset($_GET['temp']) && isset($_GET['do']) && isset($_GET['ph']) && isset($_GET['ntu'])){
	$temp =  $_GET['temp'];
	$do =  $_GET['do'];
	$ph =  $_GET['ph'];
	$ntu =  $_GET['ntu'];
	$perintah= "INSERT INTO $tablename (time,temp,do,ph,ntu) VALUES ('$date','$temp','$do','$ph','$ntu')";
} else if(isset($_POST['temp']) && isset($_POST['do']) && isset($_POST['ph']) && isset($_POST['ntu'])){
	$temp =  $_POST['temp'];
	$do =  $_POST['do'];
	$ph =  $_POST['ph'];
	$ntu =  $_POST['ntu'];
	$perintah= "INSERT INTO $tablename (time,temp,do,ph,ntu) VALUES ('$date','$temp','$do','$ph','$ntu')";
} else {
	$perintah= "INSERT INTO $tablename (time) VALUES ('$date')";
}

$hasil=mysqli_query($koneksi,$perintah);
?>