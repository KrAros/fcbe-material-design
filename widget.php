<script>
	// Set the date we're counting down to
	var countDownDate = new Date("<?php echo "$mc $gc,$ac $orac:$minc:00"; ?>").getTime();
	
	// Update the count down every 1 second
	var x = setInterval(function() {
		
		// Get todays date and time
		var now = new Date().getTime();
		
		// Find the distance between now an the count down date
		var distance = countDownDate - now;
		
		// Time calculations for days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		
		// Display the result in the element with id="demo"
		document.getElementById("demo").innerHTML = days + "d " + hours + "h "
		+ minutes + "m " + seconds + "s ";
		
		// If the count down is finished, write some text
		if (distance < 0) {
			clearInterval(x);
			document.getElementById("demo").innerHTML = "EXPIRED";
		}
	}, 1000);
</script>

<style>

html, body {
  height: 100%;
}

.pin-top {
  position: relative;
}

.pin-bottom {
  position: relative;
}

.pinned {
  position: fixed !important;
  width: 252.15px;
  top: 85px !important
}


</style>

<script>
$(document).ready(function(){
  $('#wrapper').pushpin({
    top: $('#navbar').offset().top,
    bottom: $(document).height() - 922,
    offset: 0
  });
});
</script>

<?php
	
	// ##################################
	// ### ORARIO
	
	echo "<div class='col m3'>
	<div id='wrapper'>
	<div class='row'>
	<div class='col m12'>
	<div class='card indigo'>
	<div class='card-content white-text'>";
	if ($chiusura_giornata != 1) {
		echo "<span class='card-title'>Chiusura giornata</span>
		<p>$def_giorno, <b>$gc/$mc/$ac</b><br>
		Ore <b>$orac : $minc</b><br>
		Mancano ancora:
		<span id='demo'></span></p>";
	}
	else echo "La giornata &egrave; chiusa.<br>
	Non &egrave; possibile inviare la formazione.<br>
	Attendere il calcolo di giornata per poterla modificare." ;
	echo"</h4>
	</div>
	<div class='card-action'>
	<a>
	Consegna formazioni <i class='material-icons right'>alarm</i>
	</a>
	</div>
	</div>
	</div>
	</div>";
	
	// ##################################
	// SONDAGGI
	
	if (@is_file ( "$percorso_cartella_dati/sondaggio.php" )) {
		include ("$percorso_cartella_dati/sondaggio.php");
		
		if ($voti_consentiti == 0) {
			$o = "o";
		} // fine if ($voti_consentiti == 0)
		
		else {
			echo "<br/><b>Votazione ";
			$o = "a";
		} // fine else if ($voti_consentiti == 0)
		
		if ($voto_palese == "SI")
		$mess = "Pubblico</b>";
		else
		$mess = "Anonim$o</b>";
		
		echo "<div class='card'>
		<div class='card-content'>
		<span class='card-title'>Sondaggio<span style='font-size: 13px;'> - $mess</span></span>
		<hr><table class='highlight' style='width:100%' summary='sondaggi'>";
		
		if ($voti_consentiti > 1)
		echo "<center>$voti_consentiti voti consentiti</center><br/>";
		
		echo "<tr><td><b><font color='red'>$domanda</font></td></tr></b>
		<form method='post' action='./vota_sondaggio.php'>";
		$num_opzioni = count ( $opzioni );
		for($num1 = 0; $num1 < $num_opzioni; $num1 ++) {
			$opzione = $num1 + 1;
			echo "<tr><td><label><input type='radio' class='with-gap' name='voto' value='$opzione' /><span>" . $opzioni [$num1] . "</span></label><br/></td></tr>";
		} // fine for $num1
		
		echo "<tr><td>
		<button type='submit' class='btn waves-effect waves-light green' name='vota'/>Vota</button>
		
		<a class='btn waves-effect waves-light indigo right' href='./vota_sondaggio.php'>Risultati</a>
		</td></tr>
		</form>";
		echo "</td></tr></table></div></div></div>";
	} // fine if (@is_file("$percorso_cartella_dati/sondaggio.php"))
	
	echo "</div>";
?>