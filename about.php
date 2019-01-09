<?php
include "data.php";
$tableExists = mysqli_query($koneksi,"DESCRIBE `cfg`");
if(!$tableExists){
		$sql = "CREATE TABLE cfg(
		no INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		limitbeban1 float NOT NULL,
		limitbeban2 float NOT NULL,
		limitbeban3 float NOT NULL
		)";
		$result = mysqli_query($koneksi, $sql);
		if(!$result){
			echo "ERROR: Create TABLE";
		}
		$sql = "INSERT INTO cfg (limitbeban1,limitbeban2,limitbeban3) VALUES (1.8, 1.8, 1.8)";
		$result = mysqli_query($koneksi, $sql);
	}
if(isset($_POST['submit'])){
	$lmt1 = (float)$_POST['inBeban1'];
	$lmt2 = (float)$_POST['inBeban2'];
	$lmt3 = (float)$_POST['inBeban3'];
	$result = mysqli_query($koneksi,"UPDATE cfg SET limitbeban1=$lmt1, limitbeban2=$lmt2, limitbeban3=$lmt3 WHERE no=1");
	$result = mysqli_query($koneksi,"SELECT * FROM cfg ORDER BY no ASC");
	$row = mysqli_fetch_assoc($result);
} else {
	$result = mysqli_query($koneksi,"SELECT * FROM cfg ORDER BY no ASC");
	$row = mysqli_fetch_assoc($result);
}

?>
<html>
    <h2>Config Beban: </h2>
	<form method="post">
	<label for='inBeban1' style='display:block;'>Limit Beban 1:</label>
	<input type='text' name='inBeban1' id='inBeban1' size='10' style='text-align: right; ' value='<?php echo $row['limitbeban1']; ?>' /><a>A</a>
	<label for='inBeban2' style='display:block;'>Limit Beban 2:</label>
	<input type='text' name='inBeban2' id='inBeban1' size='10' style='text-align: right; ' value='<?php echo $row['limitbeban2']; ?>' /><a>A</a>
	<label for='inBeban3' style='display:block;'>Limit Beban 3:</label>
	<input type='text' name='inBeban3' id='inBeban1' size='10' style='text-align: right; ' value='<?php echo $row['limitbeban3']; ?>' /><a>A</a>
	<br><br><input type="submit" name="submit" value="Save" />
	</form>
</html>