<!-- Pied de Page avec des "détails" au sujet de la page web -->
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
	</body>
</html>