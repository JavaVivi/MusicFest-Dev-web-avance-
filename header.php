<!DOCTYPE html>
<html lang="fr">
	<!-- Zonne "d'Entête" commune à Toutes les pages web
		(toutes les pages web ont cette même zone "d'Entête")
	-->
	<head>
		<!-- Titre affiché dans l'Onglet des pages web -->
		<title>MusicFest</title>
		<meta charset="UTF-8"/>
		
		<!-- debut BOOTSTRAP -->
		<!-- Initialisation de "l'echelle d'affichage" des pages web -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
		<!-- fin BOOTSTRAP -->

		<!-- Connexion Paypal pour la page "paiement.php" -->
		<script
    		src="https://www.paypal.com/sdk/js?client-id=AbV0BroZ7PQ87WGx_LMZmmS94ly60_GdeJTuNd_OiLbNNmxLiOpNydXRjrreTf6RJizuUOP-uDAOfXXM"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
 		 </script>
		<!-- fichier de styles ".css" pour la forme (la mise en page) des pages web -->
		<link rel="stylesheet" type="text/css" href="styles.css" />

		<!-- Styles "specifiques" (pour les Tableaux) -->
		<style>
			table, th, td {
			 	border : 1px solid black;
			 	border-collapse: collapse;
			}
			th, td {
			 	padding: 5px;
			}
		</style>

		<!-- Initialisation de la "taille" Maximale pour l'affichage ds pages web -->
		<link rel="stylesheet" media="screen and (max-width: 768px)" href="styles.css" />
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		

		<!-- AJAX + JQuery
			Script pour utiliser Ajax et JQuery
		 -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

		<!-- Script pour "appeler" la (ou les) fonctions présentes dans le fichier "functions.js" -->
		<script type="text/javascript" src="functions.js"></script>
		<script> 
			$(document).ready(
				function(){
					$("#flip").click(function(){
						$("#show").slideToggle("slow");
			  });
			});
		</script>
	</head>
	<body>
		<header>
			<figure>
				<!--
				<p><img src="images/logo.png" alt="logo"></p>
				-->
				<!-- Affichage de l'image "logo.png" sur les page web -->
				<a href='./index.php'><img src='images/logo.png' alt='logo Music Fest' /></a>
			</figure>

			<!-- Navigateur pour naviguer sur le site (aller d'une page web à l'autre) -->
			<nav class="menu">
				<ul>
					<li><a href = "index.php">Accueil</a></li>
					<li><a href = "bestof.php">Nos meilleures ventes</a></li>
					<li><a href = "contact.php">Contact</a></li>
					<li><a href = "art_lim.php">Articles limités</a></li>
				</ul>
			</nav>
			<?php

				try{
					// CONNEXION A LA BASE DE DONNEES utilisée pour l'affichage du contenu sur les pages web

					// Sur ordinateur de l'UCP
					$base = new mysqli('devwebdb.etu','y19dwa_vcaze','A123456*','db2019dwa_vcaze','3306');

					// Sur pc de Matthieu
					// $base = new mysqli('localhost', 'root', '', 'musicfest');

					// Sur Internet
					//$base = new mysqli('localhost', 'id11916600_root', 'A123456*', 'id11916600_dwa');

					// Sur pc de Virginie
					//$base = new mysqli('localhost', 'root', '', 'dwa');
				}
				// "Message d'Erreur" en cas d'eche de la Connexion à la Bas de Données
				catch (Exception $e){
	        		die('Erreur : ' . $e->getMessage());
				}
			?>
<div class="panier">
				<!-- Affichage de l'icône du PANIER -->
				<p><img src="images/panier.png" alt="panier" ></p>
			</div>

			<!-- Affichage d'un "bouton" pour Accéder au PANIER (à page "panier.php") -->
			<div class="panier">
				<form method="POST" action="panier.php">
					<button><input type="submit" name="voir_panier" value="Voir" /></button>
				</form>
			</div>
			<hr>

			<!-- Script uitlisé par la page "contact.php" pour l'envoie des messages au(x) "responsable(s)" du site -->
			<SCRIPT LANGUAGE="javascript">
				function contact(form2) {
					// Initialisation des variables utilisées pour la fonction
					var name =document.form2.name.value;
					var contact =document.form2.input1.value;
					var message =document.form2.input2.value;

					// Test des variables (test si les variables sont NON NULL)
					if(name){
						if(contact){
							if(message){
								alert("ENVOI REUSSI");
							}
							else{
								alert("Veuillez ecrire votre MESSAGE!")
							}
						}
						else{
							alert("Veuillez choisir un CONTACT!");
						}
					}
					else{
						alert("Veuillez donner votre NOM!");
					}

					// Attriubtion des variables initialisées aux variables uitlisées pour afficher les "informations" données par l'utilisateur (sur la page "contact.php")
					/*
					document.form2.name1.value=name;
					document.form2.output1.value=contact;
					document.form2.output2.value=message;
					*/
				} 
			</SCRIPT>

			<!-- Script utilisé par la page "paiement.php" pour la Confirmation de la Commande des articles présents dans le panier -->
			<SCRIPT LANGUAGE="javascript">
				function afficher(form2) {

					/*
					var testin =document. form2.input.value;
					var testin2 =document. form2.input2.value;
					*/

					// Initialisation des variables utilisées pour la fonction
					var nom =document.form2.nom.value;
					var prenom =document.form2.prenom.value;
					var carte =document.form2.carte.value;
					var crypto =document.form2.crypto.value;
					var expiration =document.form2.expiration.value;
					var mail =document.form2.mail.value;
					
					// Test des variables (test si les variables sont NON NULL)
					if(nom){
						if(prenom){
							if(carte){
								if(crypto){
									if(expiration){
										if(mail){
											alert("ACHAT CONFIRME");
										}
										else{
											alert("Veuillez donner votre ADRESSE MAIL");
										}
									}
									else{
										alert("Veuillez donner la DATE D'EXPIRATION de votre Carte Bancaire");
									}
								}
								else{
									alert("Veuillez donner le CRYPTO CODE de votre Carte Bancaire");
								}
							}
							else{
								alert("Veuillez donner le NUMERO de votre Carte Bancaire");
							}
						}
						else{
							alert("Veuillez donner votre PRENOM");
						}
					}
					else{
						alert("Veuillez donner Votre NOM");
					}

					// Attriubtion des variables initialisées aux variables uitlisées pour afficher les "informations" données par l'utilisateur (sur la page "contact.php")
					/*
					document.form2.output.value=nom
					document.form2.output2.value=prenom
					document.form2.output3.value=carte
					document.form2.output4.value=crypto
					document.form2.output5.value=expiration
					document.form2.output6.value=mail
					*/
				} 
			</SCRIPT>
		</header>
		<!-- Zone contenant les éléments "directement" affichés sur les pages web -->
		<div class="main">
