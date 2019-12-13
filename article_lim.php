<?php
	include('header.php');
?>
	<!--
	<div class="main">
		</header>
	-->
		<div id="article">
		<?php
			$req = 'SELECT * FROM `cd`, `artiste`, `creer`, avis WHERE id_cd = '.$_POST['id_cd'].' AND id_artiste = no_artiste AND no_cd = '.$_POST['id_cd'].' AND avis = id';
			$res = $base->query($req);
			$data = $res->fetch_row();
			echo '<div class="caption"><p><img src="data:image/jpeg;base64,'.base64_encode($data['1']).'"/>';
			echo '<p> Titre : '.$data[2].'</p>';
			echo '<p> Date de sortie : '.$data[3];
			echo '<p> Genre : '.$data[4];
			echo '<p> Pays  : '.$data[7];
			echo '<p> Prix : '.$data[8].' €';
			
			if($data[6] >= 1) {
				echo '<p>Quantité restante : '.$data[6];
			}
			else {
				echo "<p>Rupture de stock.</p>";
			}
			echo '<p> Notre avis : '.$data[17].' ( donné par '.$data[18].' à la date : '.$data[19].' )';
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
			
			?>

			<?php
			$id_cd = $_POST['id_cd'];
			$prix = $_POST['prix'];
			
			//var_dump($data[6]);
			echo '<form method="POST" action="article_lim.php">';
				echo '<input type="hidden" name="id_cd" value='.$id_cd.'>';
				echo '<input type="hidden" name="prix" value='.$prix.'>';
				echo '<p><input type="submit" id = "add" name = "add_panier" value="Ajouter au panier"></p>
			</form>';
			
			if(isset(($_POST['add_panier']))) {
				$id_cd_panier = '"'.$id_cd.'"';
				$prix = $prix;
				//$p = 4;
				$new_quantite = $data[6] - 1;
				//var_dump($data[6]);

				$user_req = 'INSERT INTO panier VALUES('.$id_cd_panier.', '.$prix.', 1)';
				//$alter = 'UPDATE cd SET quantite = '.$new_quantite.' WHERE id_cd = '.$id_cd_panier;
				if (!($stmt = $base->prepare($user_req))) {
     				echo "Echec lors de la préparation : (" . $base->errno . ") " . $base->error;
				}
				else {
					$alter = 'UPDATE cd SET quantite = '.$new_quantite.' WHERE id_cd = '.$id_cd_panier;
					if (!($stmt2 = $base->prepare($alter))) {
     					echo "Echec lors de la préparation : (" . $base->errno . ") " . $base->error;
     				}
				}
					
				if ($stmt->execute()) {
    				$stmt2 ->execute();
				} 
				if (!$stmt->execute()) {
    				echo "<p>Article déjà ajouté au panier !</p>";
				} 
				if (!$stmt2->execute()) {
    					echo "<p>Rupture de stock.</p>";
				}
				
				echo "<script>";
				echo "$(document).ready(function(){";
				echo "$('#add').css('display', 'none')";
				echo "});";
				echo "</script>";
			
				//echo "<p>Ajouté au panier !</p>";
				$stmt->close();
				}
			?>
		</div>
		
			<footer>
				<p id="presentation"></p>
				<script>
					var myObj, x;
					myObj = { message: "Site crée par CAZE Virginie et SAUVAGEOT Matthieu, dans le cadre du projet de Dev Web Avancé."};
					x = myObj.message;
					document.getElementById("presentation").innerHTML = x;
				</script>
				<?php
					date_default_timezone_set('UTC');
					echo date('l jS \of F Y');
				?> <br>
			</footer>
			</div>
		</div>
	</body>
</html>