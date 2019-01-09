<?php
$file = $_GET['file'];
$h = $_GET['h'];
$b = $_GET['b'];
$t = $_GET['t'];
$s = $_GET['s'];
function download_send_headers($filename,$s, $h, $b, $t) {
	include "data.php";
	$buff = $s;
	header('Content-Type: text/csv; charset=utf-8');
	header("Content-Disposition: attachment; filename=$h-$b-$t.csv");

	$output = fopen('php://output', 'w');

	// output the column headings
	fputcsv($output, array('No', 'Date & Time', 'Tegangan', 'Arus', 'Daya', 'Kondisi'));
	$rows = mysqli_query($koneksi,"SELECT no,time,tegangan,arus,daya,kondisi FROM $buff");
	// loop over the rows, outputting them
	$index = 1;
	while ($row = mysqli_fetch_assoc($rows)) {
		$parse = explode(' ', $row["time"]);
		$parse2 = explode('-', $parse[0]);
		if((int)$h == 0 && (int)$b == 0){
			if((int)$t == (int)$parse2[0]){
				fputcsv($output, array($index,$row['time'],$row['tegangan'],$row['arus'],$row['daya'],$row['kondisi']));
				$index++;
			}
		} else if ((int)$h == 0){
			if((int)$b == (int)$parse2[1] && (int)$t == (int)$parse2[0]){
				fputcsv($output, array($index,$row['time'],$row['tegangan'],$row['arus'],$row['daya'],$row['kondisi']));
				$index++;
			}
		} else {
			if((int)$h == (int)$parse2[2] && (int)$b == (int)$parse2[1] && (int)$t == (int)$parse2[0]){
				fputcsv($output, array($index,$row['time'],$row['tegangan'],$row['arus'],$row['daya'],$row['kondisi']));
				$index++;
			}
		}			

	}
	fclose($output);
	//echo $output;
}
download_send_headers($file,$s, $h, $b, $t);
?>