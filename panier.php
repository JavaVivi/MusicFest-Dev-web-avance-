<?php
	// Appel au fichier "d'Entête" "header.php"
	include("header.php");
?>
<?php		
			// Requête SQL pour afficher Tous les "éléments" des Tables "panier" et "cd", tel que le numéro "d'identification" de l'article dans le Panier (dans la table "cd") soit le même que celui de l'Article dans la Table "cd", présentes dans la Base de Données
			$req = 'SELECT * FROM panier, cd WHERE panier.id=cd.id_cd';

			// Exécution de la Requête SQL
			$res2 = $base->query($req);
			
			// Affichage des "éléments" du "Résultat" de l'exécution de la Requête SQL (un par un)
			while ($data = $res2->fetch_row()) {
				//var_dump($data);
				echo '<p>'.$data['5'].' x '.$data['2'].' '.$data['1'].'€</p>';
			}
			?> <br>
			<!-- Formulaire, pour Confirmer la "Demande d'Achat", qui renvoie vers la page "paiement.php" -->
			<form method="POST" action="paiement.php">
				<!-- Bouton "de Validation" pour Valider la Commande et qui envoie vers la page "paiement.php" -->
				<button><input type="submit" name="pay" value="Commander" /></button>
			</form>
				<?php
				// Appel au fichier "de Pied de Page" "footer.php"
				include("footer.php");
				?>