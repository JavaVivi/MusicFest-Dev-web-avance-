<?php
	// Appel au fichier "d'Entête" "header.php"
	include("header.php");
?>
		<!--
		<style>
		table, th, td {
		 	border : 1px solid black;
		 	border-collapse: collapse;
		}
		th, td {
		 	padding: 5px;
		}
	</style>
-->
		<!-- Page de 'Nos Meileures ventes" -->
		<p>Nos CDs les plus vendus par date :</p>

		<!-- Mise en place d'un Formulaire pour afficher les meilleurs offres en fonction l'année choisie dans la Liste Déroulante -->
		<form method="GET" action="">

			<!-- Utilisation de Ajax pour afficher les résultat de la sélection de l'année
				(sans changer de page ou même actualliser la page en cour)
			-->
			<select name="annee" size="1" onchange="showBests(this.value)">
			<!-- Liste Déroulante -->
			<option value="2012">2012</option>
			<option value="2013">2013</option>
			<option value="2014">2014</option>
			<option value="2015">2015</option>
			<option value="2016">2016</option>
			<option value="2017">2017</option>
			<option value="2018">2018</option>
			<option value="2019">2019</option>
			</select>
		</form>

		<div id="txtHint">Les infos seront affichées ici.</div>
			<script>
				function showBests(str) {
	  				var xhttp;
					if (str == "") {
					 	document.getElementById("txtHint").innerHTML = "";
   						return;
					}
	  				xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
   						if (this.readyState == 4 && this.status == 200) {
   							document.getElementById("txtHint").innerHTML = this.responseText;
   						}
					};
		 			xhttp.open("GET", "getbests.php?q="+str, true);
					xhttp.send();
				}
			</script>
			<?php
			// Appel au fichier "de Pied de Page" "footer.php"
			include("footer.php");
			?>