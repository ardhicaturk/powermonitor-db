<?php
$host = "localhost";
$user = "root";
$pass = "";
$namadb = "sulton";
$koneksi = mysqli_connect($host, $user, $pass);
if ($koneksi){
	$buka = mysqli_select_db($koneksi,$namadb);
	if (!$buka){
		$buat = mysqli_query($koneksi,"CREATE DATABASE $namadb");
		if (!$buat){
			echo ("<p align='center'>Failed to Create Database</p>");
		}
	}
} else {
		echo("<p align='center'>Cannot Connect to Server</p>");
}

$tablename = array("pln", "genset","solar", "wt", "beban1", "beban2", "beban3");

$buff = "cfg";
$tableExists = mysqli_query($koneksi,"DESCRIBE `$buff`");
if(!$tableExists){
	$sql = "CREATE TABLE $buff(
	no INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	limitbeban1 float NOT NULL,
	limitbeban2 float NOT NULL,
	limitbeban3 float NOT NULL
	)";
	$result = mysqli_query($koneksi, $sql);
	if(!$result){
		echo "ERROR: Create TABLE";
	}
}
for ($i=0; $i<7; $i++){
	$buff = $tablename[$i];
	$tableExists = mysqli_query($koneksi,"DESCRIBE `$buff`");
	if($i == 2){
		if(!$tableExists){
			$sql = "CREATE TABLE $buff(
			no INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			time datetime NOT NULL,
			tegangan float NOT NULL,
			arus float NOT NULL,
			daya float NOT NULL,
			cahaya int NOT NULL,
			kondisi int NOT NULL
			)";
			$result = mysqli_query($koneksi, $sql);
			if(!$result){
				echo "ERROR: Create TABLE";
			}
		}
	} else if ($i == 3){
		if(!$tableExists){
			$sql = "CREATE TABLE $buff(
			no INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			time datetime NOT NULL,
			tegangan float NOT NULL,
			arus float NOT NULL,
			daya float NOT NULL,
			rpm int NOT NULL,
			kondisi int NOT NULL
			)";
			$result = mysqli_query($koneksi, $sql);
			if(!$result){
				echo "ERROR: Create TABLE";
			}
		}
	} else {
		if(!$tableExists){
			$sql = "CREATE TABLE $buff(
			no INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			time datetime NOT NULL,
			tegangan float NOT NULL,
			arus float NOT NULL,
			daya float NOT NULL,
			kondisi int NOT NULL
			)";
			$result = mysqli_query($koneksi, $sql);
			if(!$result){
				echo "ERROR: Create TABLE";
			}
		}
	}
	
}

?>