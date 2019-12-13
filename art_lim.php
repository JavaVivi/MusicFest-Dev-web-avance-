<?php
	// Appel au fichier "d'Entête" "header.php"
	include("header.php");
?>
			<!-- Zonne "Principale" de la page art_lim.php" -->
			<section class="articles">
				<!-- (Sous-)Titre de la page -->
				<h2>Articles :</h2>
				<?php
				// "Initialisation" d'une variable contenant une "Requête SQL" qui sera utilisée (plus tard) dans la page web
				$req = 'SELECT id_cd, nom, image, prix FROM cd WHERE edition_limitee = 1';
				// Exécution de la Reqête SQL, dans la Base de Données à laquelle on se connecte (voir fichier "header.php")
				$res = $base->query($req);
				?>
<!-- Début d'un Tableau -->
<table>
				<?php
				// Affichage des "éléments" du "Résultat" de l'exécution de la Requête SQL (un par un)
				while ($data = $res->fetch_row()) {
					//var_dump($data);
					echo "\t<td>\n";
						echo '<div class="caption"><p><img src="data:image/jpeg;base64,'.base64_encode($data['2']).'"/>';
						echo "<p>".$data['1']."</p>";
						echo '<form method="POST" action="article_lim.php">';
							echo '<input type="hidden" name="id_cd" value='.$data['0'].'>';
							echo '<input type="hidden" name="prix" value='.$data['3'].'>';
							echo '<td><p><input type="submit" name = "Voir" value="voir"></p>
						</form>
					</td>';
				}
				?>
				</table>
				<!-- Fin du Tableau -->
			</section>

			<?php
			// Appel au fichier "de Pied de Page" "footer.php"
			include("footer.php");
			?>