{* Layout principale *}
<div class='col m3'>

	{* Card chiusura giornata *}
	<div class='row'>
		<div class='col m12'>
			<div class='card indigo'>
				<form method='post' action='a_gestione.php'>
					<div class='card-content white-text'>
						<span class='card-title center white-text'>Consegna formazioni</span>
						<div class='evidenziato {$colorinfo} center white-text'>{$status_giornata}</div><br>
						<div class='center white-text'>Prossima chiusura giornata:</div>
						<input type='hidden' name='cambia_data' value='cambia_data' />
						<div class='input-field'>
							<i class='material-icons prefix white-text'>event</i>
							<input type='text' class='datepicker' name='datepicker' value='{$giorno_chiusura}/{$mese_chiusura}/{$anno_chiusura}'>
						</div>
						<div class='input-field'>
							<i class='material-icons prefix white-text'>alarm</i>
							<input type='text' class='timepicker' name='timepicker' value='{$ora_chiusura}:{$minuti_chiusura}'>
						</div>
					</div>
					<div class='card-action center'>
						<button type='submit' class='btn waves-effect waves-light green'/>Cambia data</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<script>
		$(document).ready(function(){
			$('.datepicker').datepicker({
				firstDay: 1,
				format: 'dd/mm/yyyy',
				defaultDate: new Date('{$mese_chiusura}/{$giorno_chiusura}/{$anno_chiusura}'),
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
				defaultTime: '{$ora_chiusura}:{$minuti_chiusura}',
			})
		});
	</script>
	
	{* Card Ultime dal forum *}
	<div class='row'>
		<div class='col m12'>
			<div class='card'>
				<div class='card-content'>
					<span class='card-title'>Le ultime dal Forum</span>
					<div class='row'>
						{$feed_rss_forum}
					</div>
				</div>
			</div>
		</div>
	</div>
		
	{* Card Statistiche sito *}
	<div class='row'>
		<div class='col m12'>
			<div class='card'>
				<div class='card-content'>
					<span class='card-title'>Statistiche sito</span>
					<div class='row'>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>