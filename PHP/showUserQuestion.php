<?php
include "./konektatu.php";

$eposta = $_SESSION['user'];

$giz = $niremysqli->query("SELECT Galdera, Zailtasuna FROM galdera WHERE PostaElektronikoa = '".$eposta."'");

echo '<table border=1> <tr> <th> GALDERA </th> <th> ZAILTASUNA
</th>';

while($row = $giz->fetch_assoc()) {
	echo "<tr>";
	echo "<td>" . $row["Galdera"] . "</td><td>" . $row["Zailtasuna"]. "</td>";
	echo "</tr>";
}
echo '</table>';

if(strlen($_SESSION['user'])==0){
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	
	echo $ip;
	$ekintza = "Galderak begiratu.";
	$sqla = "INSERT INTO ekintzak(EkintzaMota,IPa)
			VALUES('$ekintza', '$ip')";
	if (!$niremysqli->query($sqla)){
		echo "Taularen sorrerak huts egin: (" .
		$mysqli->errno . ") " . $mysqli->error;
		die('Errorea: ' . $niremysqli->error);
	}
}
else{
	$eposta = $_SESSION['user'];
	$aux = "SELECT IdKon,PostaElektronikoa FROM konexioak";
	$aux1 = $niremysqli->query($aux);
	
	while($row = $aux1->fetch_assoc()){ // taula osoa hautatu dugu bestela fetch_assoc-ek errorea ematen zuen:
										// Fatal error: Call to a member function fetch_assoc() on boolean
		if($row["PostaElektronikoa"]==$eposta){
			$lerroak = $row["IdKon"];
		}
	}
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	$ekintza = "Galdera begiratu.";
	$sqla = "INSERT INTO ekintzak(KonexioIdentitifikazioa,PostaElektronikoa,EkintzaMota,IPa)
			VALUES('$lerroak', '$eposta', '$ekintza', '$ip')";
			
	if (!$niremysqli->query($sqla)){
		echo "Taularen sorrerak huts egin: (" .
		$mysqli->errno . ") " . $mysqli->error;
		die('Errorea: ' . $niremysqli->error);
	}
}


$giz->close();
$niremysqli->close();
?>