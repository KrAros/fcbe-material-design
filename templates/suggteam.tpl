{config_load file="test.conf" section="configurazione_script"}
{config_load file="torneo_1.conf"}

{if $smarty.session.valido eq 'SI'}
    {include file="header.tpl" title=#titolo_sito#}
    {include file="template.tpl"}

	{tabella_squadre()}
	
	{* Form selezione intervallo di giornate e modulo *}
	
	<div class='row'>
		<div class='col m6 center'>
			<form method='post' action='suggteam.php'>
				<input type='hidden' name='dif' value='{$dif}'>
				<input type='hidden' name='cen' value='{$cen}'>
				<input type='hidden' name='att' value='{$att}'>
				Seleziona l'intervallo tra le giornate per la generazione delle statistiche: 
				<select name='range' onChange='this.form.submit()' {$numero_giornate|@count}>
					{html_options values=$numero_giornate output=$numero_giornate selected=$range}
				</select>
			</form>
		</div>
		
		<div class='col m6 center'>Cambia il modulo:</b><br><br>
			<a href='./suggteam.php?dif=3&amp;cen=5&amp;att=2&amp;range={$range}'><b>3 - 5 - 2</b></a> /
			<a href='./suggteam.php?dif=3&amp;cen=4&amp;att=3&amp;range={$range}'><b>3 - 4 - 3</b></a> /
			<a href='./suggteam.php?dif=4&amp;cen=3&amp;att=3&amp;range={$range}'><b>4 - 3 - 3</b></a> /
			<a href='./suggteam.php?dif=4&amp;cen=4&amp;att=2&amp;range={$range}'><b>4 - 4 - 2</b></a> /
			<a href='./suggteam.php?dif=4&amp;cen=5&amp;att=1&amp;range={$range}'><b>4 - 5 - 1</b></a> /
			<a href='./suggteam.php?dif=5&amp;cen=4&amp;att=1&amp;range={$range}'><b>5 - 4 - 1</b></a>
		</div>
	</div>
	
	{* Tabella calciatori *}
		
	<div class='row'>
		<div class='col m12'>			
			<table width='100%' cellpadding='10' class='responsive-table highlight' >
				<tr>
					<thead>
						<th></th>
						<th>Nome</th>
						<th>Squadra</th>
						<th>Partite</th>
						<th>Media Voto</th>
						<th>Media FantaVoto</th>
						<th>Gol</th>
						<th>Assist</th>
						<th>Rigori</th>
						<th>Gialli</th>
						<th>Rossi</th>
					</thead>
				</tr>
			
				{foreach $GiocatoriTabella as $giocatore}
			
				<tr class='{$giocatore.ruolo}'>
					<td class='center'><b class='ruolo {$giocatore.backruolo}'>{$giocatore.ruolo}</b></td> 
					<td>{$giocatore.nome}</td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_{$giocatore.squadra}.gif'><a href='tab_squadre.php?vedi_squadra={$giocatore.squadra}'>{$giocatore.squadra}</a></td>
					<td class='center'>{$giocatore.partite_giocate}</td>
					<td class='center'>{$giocatore.media_giornale}</td>
					<td class='center'>{$giocatore.media_punti}</td>
					<td class='center'>{$giocatore.gol}</td>
					<td class='center'>{$giocatore.assist}</td>
					<td class='center'>{$giocatore.rigori}</td>
					<td class='center'>{$giocatore.ammonizioni}</td>
					<td class='center'>{$giocatore.espulsioni}</td>
				</tr>
		
				{/foreach}
				
			</table>
		</div>
	</div>
		
	<script type='text/javascript' src='./inc/js/ordina_tabella.js'></script> {* Script ordinamento tabella *}
		
{/if} 

{include file="footer.tpl"}
