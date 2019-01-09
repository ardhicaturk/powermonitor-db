<?php
include "data.php";
$tablename = "client";
$result = mysqli_query($koneksi,"SELECT * FROM $tablename ORDER BY no DESC LIMIT 1");
$array = mysqli_fetch_assoc($result);
echo json_encode($array);
?>