<!-- PAGE "PRINCIPALE" DU SITE WEB (page à laquelle on accède quand on "entre" sur le site web)  -->

<?php
	// Appel au fichier "d'Entête" "header.php"
	include("header.php");
?>
			<section class="recherche">
				<!-- Rerche "avancée" des différents articles présents sur le site (dans la Base de Données) -->
				<h2 id="flip">Recherche avancée (cliquez pour afficher/cacher):</h2>
				<div id="show">
					<p>Genre :</p>
					<?php
						// Requête SQL de "Selection sans doublon" dans la table "genre" de la Base de Données
						$req = 'SELECT DISTINCT genre FROM cd';
						$res = $base->query($req);
						//$data = $res->fetch_row();
					?>
<!-- Formulaire, pour la Recherche Avancée (qui renvoie vers une autre page "recherche.php") -->
					<form method ="POST" action ="recherche.php">
						<!-- "Selection" par "genre", pour la Recherche Avancée -->
						<select name="genres" size="1">';
							<?php
							// Affichage des "éléments" du "Résultat" de l'exécution de la Requête SQL (un par un)
							while($data = $res->fetch_row()) {
								echo '<option value = "'.$data[0].'">'.$data[0].'</option>';
							}
							?>
						</select>
						<!-- Bouton "de Validation" avec le mot "rechercher" affiché desssus -->
						<input type="submit" name ="rechercher2" value="rechercher"/>
					</form>
						<?php
						if((isset($_POST['genres']))) {
							echo "yes";
						}
					?>
<p>Année :</p>
					<!-- Formulaire, pour la Recherche Avancée (qui renvoie vers une autre page "recherche.php") -->
					<form method="POST" action="recherche.php">
						<!-- "Selection" par "année", pour la Recherche Avancée -->
						<select name="annee" size="1">
							<option value="2015">2015</option>
							<option value="2016">2016</option>
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
						</select>
						<!-- Bouton "de Validation" avec le mot "rechercher" affiché desssus -->
						<input type="submit" name="rechercher" value="Rechercher" />
					</form>
				</div>
			</section>
			
			<section class="articles">
				<h2>Articles :</h2>
				<?php
					// Requête SQL pour afficher les identifiant des CD, leur nom, l'image que 
					$req = 'SELECT id_cd, nom, image, prix FROM cd WHERE edition_limitee = 0';
					// Exécution de la Requête SQL
					$res = $base->query($req);
				?>
<table>
						<?php
				// Affichage des "éléments" du "Résultat" de l'exécution de la Requête SQL (un par un)
				while ($data = $res->fetch_row()) {
				//var_dump($data);
				echo '<td>';
					echo '<div class="caption"><p><img src="data:image/jpeg;base64,'.base64_encode($data['2']).'"/>';
					echo '<p>'.$data['1'].'</p>';
					// Formulaire des articles présents sur le site web (dans la Base de Données) et qui renvoie vers la page "article.php"
					echo '<form method="POST" action="article.php">';
						echo '<input type="hidden" name="id_cd" value='.$data['0'].'>';
						echo '<input type="hidden" name="prix" value='.$data['3'].'>';
					?>
				<td>
					<!-- Bouton "de Validation" avec le mot "voir" affiché desssus
						Pour aller sur la page "contenant" les différentes informations sur le CD -->
					<p><input type="submit" name = "Voir" value="voir"></p>
					</form>
				</td>
				<?php
				}
				?>
</table>
			</section>
			<?php
			// Appel au fichier "de Pied de Page" "footer.php"
			include("footer.php");
			?>