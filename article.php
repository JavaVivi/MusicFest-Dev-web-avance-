<?php
	// Appel au fichier "d'Entête" "header.php"
	include("header.php");
?>
		<div id="article">
		<?php
			// Requête SQL pour Afficher Toutes les "informations", des Tables cd, artiste, creer et avis, telles que, le "numéro d'identification" du CD + son "numero" corresponde au "numéro d'identification" choisi (séléctionné) sur la page "index.php", le "numéro d'identification" de l'Artiste et celui de l'Avis soient "associés" au CD dont le "numéro d'identification" est affiché par la Requête SQL 
			$req = 'SELECT * FROM `cd`, `artiste`, `creer`, avis WHERE id_cd = '.$_POST['id_cd'].' AND id_artiste = no_artiste AND no_cd = '.$_POST['id_cd'].' AND avis = id';
			
			// Exécution de la Requête SQL
			$res = $base->query($req);

			
			// Affichage des "éléments" du "Résultat" de l'exécution de la Requête SQL (un par un)
			$data = $res->fetch_row();
			echo '<div class="caption"><p><img src="data:image/jpeg;base64,'.base64_encode($data['1']).'"/>';
			echo '<p> Titre : '.$data[2];
			echo '<p> Date de sortie : '.$data[3];
			echo '<p> Genre : '.$data[4];
			echo '<p> Pays  : '.$data[7];
			echo '<p> Prix : '.$data[8].' €';
			echo '<p> Notre avis : '.$data[17].' ( donné par '.$data[18].' à la date : '.$data[19].' )';
			echo "</div>";
			//var_dump($data);
			echo '<p> Groupe(s) : </p>';
			if($result = $res->num_rows == 1) {
				echo '<p> '.$data[13].' ('.$data[12].')';
				//echo '<p> Titre : '.$data[2];
			}
			else { 
				while ($data = $res->fetch_row()) {
						echo '<p> '.$data[13].' ('.$data[12].')';
				}
				
			}	
			$id_cd = $_POST['id_cd'];
			$prix = $_POST['prix'];
			//var_dump($prix);

			// Formulaire d'Affichage des "détails" trouvé dans la Base de Données, au sujet du CD choisi
			echo '<form method="POST" action="article.php">';
			echo '<input type="hidden" name="id_cd" value='.$id_cd.'>';
			echo '<input type="hidden" name="prix" value='.$prix.'>';
			echo '<p><input type="submit" name = "add_panier" value="Ajouter au panier"></p>
			</form>';

			// Ajout du CD au Panier
			if(isset(($_POST['add_panier']))) {
				$id_cd_panier = '"'.$id_cd.'"';
				$prix = $prix;
				//$p = 4;
				
				//var_dump($p);

				// Requête SQL d'Insertion de "l'article" (le CD) dans la Table "panier"
				$user_req = 'INSERT INTO panier VALUES('.$id_cd_panier.', '.$prix.', 1)';
				if (!($stmt = $base->prepare($user_req))) {
     				echo "Echec lors de la préparation : (" . $base->errno . ") " . $base->error;
				}

				// Test si "l'article" est déjà dans le Panier
				if (!$stmt->execute()) {
    				echo "<p>Article déjà ajouté au panier !</p>";
				};
				
				//echo "<p>Ajouté au panier !</p>";
				$stmt->close();
			}
		?>
		</div>
			<?php
			// Appel au fichier "de Pied de Page" "footer.php"
			include("footer.php");
			?>