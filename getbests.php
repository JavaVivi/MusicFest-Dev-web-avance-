<?php

	// $base = new mysqli('devwebdb.etu','y19dwa_vcaze','A123456*','db2019dwa_vcaze','3306');
	//$base = new mysqli('localhost', 'root', '', 'dwa');
	$base = new mysqli('localhost', 'root', '', 'musicfest');
	if($base->connect_error) {
	 	exit('Could not connect');
	}
	
	$req = 'SELECT nom, date_sortie, genre, pays FROM cd WHERE ? = YEAR(date_sortie) AND best_of = 1';
	$stmt = $base->prepare($req);
	$stmt->bind_param("s", $_GET['q']);
	$stmt->store_result();
	$stmt->bind_result($nom , $date, $genre, $pays);
	
	$stmt->execute();
	
	echo "<table>";
	while($data = $stmt->fetch()) {
		echo "<tr>";
		echo "<td>".$nom."</td>";
		echo "<td>".$date."</td>";
		echo "<td>".$genre."</td>";
		echo "<td>".$pays."</td>";
		echo "</tr>";
	}
	echo "</table>";

	$stmt->close();

?>