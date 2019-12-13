<?php
	// Appel au fichier "d'Entête" "header.php"
	include("header.php");
?>
<?php
	// Si une année a bien été choisie, la page se connecte à la Base de Donnée
	if((isset($_POST['annee']))) {
		try{
			// Sur Ordinateur de l'UCP
			// $base = new mysqli('devwebdb.etu','y19dwa_vcaze','A123456*','db2019dwa_vcaze','3306');
			
			// Sur pc de Virginie
		  	// $base = new mysqli('localhost', 'root', '', 'dwa');

			// Sur pc de Matthieu
			$base = new mysqli('localhost', 'root', '', 'musicfest');

			// Sur Internet
			// $base = new mysqli('localhost', 'id11916600_root', 'A123456*', 'id11916600_dwa');
		}
		// "Message d'Erreur" en cas d'eche de la Connexion à la Bas de Données
		catch (Exception $e){
       		die('Erreur : ' . $e->getMessage());
		}

		// Requête SQL pour Afficher le nom, la Date de Sortie, le Genre, le Pays d'Origine et le Prix des différents CD, dont la "Date de Sortie" correspondant à la date choisie sur la page "index.php"
		$req = 'SELECT nom, date_sortie, genre, pays, prix FROM cd WHERE ? = YEAR(date_sortie)';

		// Préparation de l'Exécution de la Requête SQL
		$stmt = $base->prepare($req);
		$stmt->bind_param('s', $_POST['annee']);

		// Exécution de la Requête SQL
		$stmt->execute();

		// "Conservation" du Résultat de l'Exécution de la Requête SQL
		$stmt->store_result();

		// "Association" des différents éléments du Résultat de la Requête SQL à des "noms"
		$stmt->bind_result($nom , $date, $genre, $pays, $prix);
?>
	   		<p> Résultats de la recherche : </p> <br>
	   		<table>
				<?php
				// Affichage des "éléments" du "Résultat" de l'exécution de la Requête SQL (un par un)
				while($data = $stmt->fetch()) {
					echo "\t<tr>";
					echo "<td>".$nom."</td>";
					echo "<td>".$date."</td>";
					echo "<td>".$genre."</td>";
					echo "<td>".$pays."</td>";
					echo "</tr>";
				}
			echo "</table>";
		}

		// (Même chose les "genres")
		if((isset($_POST['genres']))) {
			try{
		   		// $base = new mysqli('devwebdb.etu','y19dwa_vcaze','A123456*','db2019dwa_vcaze','3306');
				//$base = new mysqli('localhost', 'root', '', 'dwa');
				$base = new mysqli('localhost', 'root', '', 'musicfest');
			}

			// "Message d'Erreur" en cas d'eche de la Connexion à la Bas de Données
			catch (Exception $e){
		        die('Erreur : ' . $e->getMessage());
			}

			// Requête SQL pour Afficher le nom, la Date de Sortie, le Genre, le Pays d'Origine et le Prix des différents CD, dont le "Genre" correspondant au genre choisi sur la page "index.php"
			$req = 'SELECT nom, date_sortie, genre, pays, prix FROM cd WHERE ? = genre';
			
			// Préparation de l'Exécution de la Requête SQL
			$stmt = $base->prepare($req);
			$stmt->bind_param('s', $_POST['genres']);

			// Exécution de la Requête SQL
			$stmt->execute();

			// "Conservation" du Résultat de l'Exécution la Requête SQL
			$stmt->store_result();

			// "Association" des différents éléments du Résultat de la Requête SQL à des "noms"
			$stmt->bind_result($nom , $date, $genre, $pays, $prix);
	
		   echo "<p> Résultats de la recherche : </p>";		
			echo "<table>";
				// Affichage des "éléments" du "Résultat" de l'exécution de la Requête SQL (un par un)
				while($data = $stmt->fetch()) {
					echo "<tr>\n";
					echo "<td>".$nom."</td>";
					echo "<td>".$date."</td>";
					echo "<td>".$genre."</td>";
					echo "<td>".$pays."</td>";
					?>
					</tr>
					<?php
				}
				?>
			</table>
			<?php	
		}
		$stmt->close();
	?> <br>
				<?php
				// Appel au fichier "de Pied de Page" "footer.php"
				include("footer.php");
				?>