var valeur=0;
function modifier(increment) {
	if(valeur >= 0) {
		valeur+=increment;
	}
	document.getElementById('text').value=valeur;
}

