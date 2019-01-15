<?php
	echo "<div class='col m3'>";
	
	#######################
	##### Chiusura giornata
	
	echo "<div class='card indigo'>
	<div class='card-content'>";
	if (@is_file($percorso_cartella_dati."/chiusura_giornata.txt")) { $colorinfo = "red"; $status_giornata = "Giornata Chiusa"; }
	else { $colorinfo = "green"; $status_giornata = "Giornata Aperta";}
	
	$data_chigio = @file($percorso_cartella_dati."/data_chigio.txt");
	$ac = substr($data_chigio[0],0,4);
	$mc = substr($data_chigio[0],4,2);
	$gc = substr($data_chigio[0],6,2);
	$orac = substr($data_chigio[0],8,2);
	$minc = substr($data_chigio[0],10,2);
	
	$tabella_chigio = "<span class='card-title white-text'>Consegna formazioni</span>
	<div class='evidenziato $colorinfo center white-text'>$status_giornata</div><br>
	<div class='center white-text'>Prossima chiusura giornata:</div>";
	
	$tabella_chigio .= "<form method='post' action='a_gestione.php'>
	<input type='hidden' name='cambia_data' value='cambia_data' />

	<div class='input-field'>
	<i class='material-icons prefix white-text'>event</i>
	<input type='text' class='datepicker' name='datepicker' value='$gc/$mc/$ac'>
	</div>
	<div class='input-field'>
	<i class='material-icons prefix white-text'>alarm</i>
	<input type='text' class='timepicker' name='timepicker' value='$orac:$minc'>
	</div>
	</div>";
	
	echo $tabella_chigio;
	
	echo "<div class='card-action center'>
	
	<button type='submit' class='btn waves-effect waves-light green'/>Cambia data</button>
	</form>
	
	</div>
	</div>
	<br>";
	
	echo "</div>";
?>
<script>
	$(document).ready(function(){
		$('.datepicker').datepicker({
		    firstDay: 1,
			format: 'dd/mm/yyyy',
			defaultDate: new Date('<?php echo "$mc/$gc/$ac"; ?>'),
			setDefaultDate: true,
			i18n: {
                months: ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"],
                monthsShort: ["Gen", "Feb", "Mar", "Apr", "Mag", "Giu", "Lug", "Ago", "Set", "Ott", "Nov", "Dic"],
                weekdays: ["Domenica","Lunedi", "Martedi", "Mercoledi", "Giovedi", "Venerdi", "Sabato"],
                weekdaysShort: ["Dom","Lun", "Mar", "Mer", "Gio", "Ven", "Sab"],
                weekdaysAbbrev: ["D","L", "M", "M", "G", "V", "S"]
            }
		})
	});
	
	$(document).ready(function(){
		$('.timepicker').timepicker({
			twelveHour: false,
			defaultTime: '<?php echo "$orac:$minc"; ?>',
		})
	});
</script>