<?php
	// Appel au fichier "d'Entête" "header.php"
	include("header.php");
?>

				<?php
					// Requête SQL pour afficher Tous les "éléments" des Tables "panier" et "cd", tel que le numéro "d'identification" de l'article dans le Panier (dans la table "cd") soit le même que celui de l'Article dans la Table "cd", présentes dans la Base de Données
					$req = 'SELECT * FROM panier, cd WHERE panier.id=cd.id_cd';

					// Exécution de la Requête SQL
					$res2 = $base->query($req);

					// Initialisation d'une Variable pour Conter le Prix Total des Articles présents dans le Panier
					$total=0;
					
					// Affichage des "éléments" du "Résultat" de l'exécution de la Requête SQL (un par un)
					while ($data = $res2->fetch_row()) {
						//var_dump($data);
						echo '<p>'.$data['5'].' x '.$data['2'].' '.$data['1'].'€</p>';
						$total+=$data['11'];
					}
				?>

				<!-- Formulaire JAVA pour Confirmer la Commande des Articles mis dans le Panier -->
				<FORM NAME="form2"> 
					NOM* : <INPUT TYPE="text" NAME="nom" VALUE=""><BR> 
					Prenom* : <INPUT TYPE="text" NAME="prenom" VALUE=""><BR> 
					Numéro de la Carte* : <INPUT TYPE="text" NAME="carte" VALUE=""><BR> 
					Crypto Code de la Carte* : <INPUT TYPE="text" NAME="crypto" VALUE=""><BR> 
					Date d'Expiration de la Carte* : <INPUT TYPE="text" NAME="expiration" VALUE=""><BR>
					@ mail : <INPUT TYPE="text" NAME="mail" VALUE=""><BR>
					<p style="font-weight: bold;">Montant Total :  <?php echo "".$total." €"; ?></p>
					<p style="font-weight: bolder;">(*): Important</p>

       				<!-- Bouton "de Validation" qui envoie les informations données à la fonction "afficher(form2)" (voir fichier "header.php")
       				-->	
					<INPUT TYPE="button" NAME="bouton" VALUE="Confirmer" onClick="afficher(form2)"><BR>

					<!-- Affichage des "informations" données sur le Formulaire -->

					<!--
					Nom donné: <INPUT TYPE="text" NAME="output" VALUE=""> <BR>
					Prenom donné: <INPUT TYPE="text" NAME="output2" VALUE=""> <BR>
					Numéro de Carte donné: <INPUT TYPE="text" NAME="output3" VALUE=""> <BR>
					Crypto Code donné: <INPUT TYPE="text" NAME="output4" VALUE=""> <BR>
					Date d'Expiration donnée: <INPUT TYPE="text" NAME="output5" VALUE=""> <BR>
					@ mail donnée: <INPUT TYPE="text" NAME="output6" VALUE="">
					-->

				</FORM>
				
				<div id="paypal-button-container"></div>
				<script>paypal.Buttons().render('#paypal-button-container');</script>
		<script>
		  	paypal.Buttons({
		    createOrder: function(data, actions) {
		      // This function sets up the details of the transaction, including the amount and line item details.
		      return actions.order.create({
		        purchase_units: [{
		          amount: {
		            value: '0.01'
		          }
		        }]
		      });
		    }
		  }).render('#paypal-button-container');
		 
		    onApprove: function(data, actions) {
		      return actions.order.capture().then(function(details) {
		        alert('Transaction completed by ' + details.payer.name.given_name);
		        // Call your server to save the transaction
		        return fetch('/paypal-transaction-complete', {
		          method: 'post',
		          headers: {
		            'content-type': 'application/json'
		          },
		          body: JSON.stringify({
		            orderID: data.orderID
		          })
		        });
		      });
		    }
		  }).render('#paypal-button-container');
		</script>
		
		
		<a href='paiement.php?del=true'>Vider le panier</a>

		<script type="text/javascript">
   			function Message() {
       			var msg="Achat Confirmé";
       			console.log(msg)
       			alert(msg);
   			}
		</script>
	
				<?php
				// Requête SQL pour Supprimer les Articles présents le panier, après la Confirmation du Paiement
				$delete = 'DELETE FROM panier';
				
				// Exécution de la Requête SQL
				$result = $base->query($delete);
				?>

				<p id="presentation"></p>
				<script>
					var myObj, x;
					myObj = { message: "Site crée par CAZE Virginie et SAUVAGEOT Matthieu, dans le cadre du projet de Dev Web Avancé."};
					x = myObj.message;
					document.getElementById("presentation").innerHTML = x;
				</script>
				<?php
				// Appel au fichier "de Pied de Page" "footer.php"
				include("footer.php");
				?>