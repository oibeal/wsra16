<?php
$niremysqli = new mysqli("mysql.hostinger.es", "u513906433_obeas", "oier0886", "u513906433_quiz");
$giz = $niremysqli->query("SELECT * FROM erabiltzailea");
echo '<table border=1> <tr> <th> IZENA </th> <th> ABIZENA1
</th> <th> ABIZENA2 </th> <th> EPOSTA </th> <th> SEXUA </th> <th> TELEFONOA </th> <th> ESPEZIALITATEA </th> <th> INTERESAK </th> </tr> ';

while($row = $giz->fetch_object()) {
	echo '<tr><td>'.$row->Izena.'</td> <td>'.$row->Abizena1.'</td> <td>'.$row->Abizena2.'</td> <td>'.$row->PostaElektronikoa.
	'</td> <td>'.$row->Sexua.'</td> <td>'.$row->TelefonoZbkia.'</td> <td>'.$row->Espezialitatea.'</td> <td>'.$row->Interesak.'</td> </tr>';
}
echo '</table>';
$giz->close();
$niremysqli->close();
?>	