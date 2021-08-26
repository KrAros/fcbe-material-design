{config_load file="test.conf" section="configurazione_script"}
{config_load file="torneo_1.conf"}

{if $smarty.session.valido eq 'SI'}
    {include file="header.tpl" title=#titolo_sito#}
    {include file="template.tpl"}

	{tabella_squadre()}
	
	{* Tabella calciatori *}
		
	<div class='row'>
		<div class='col m12'>			
			<table class='highlight' width='100%' cellpadding='0' cellspacing='0' align='center'>
				<tr>
					<thead>
						<th></th>
						<th>Nome</th>
						<th>Squadra</th>
						<th class='center'>Gare</th>
						<th class='center'>Medie</th>
						<th class='center'>Gol</th>
						<th class='center'>Assist</th>
						<th class='center'>Gialli</th>
						<th class='center'>Rossi</th>
						<th class='center'>Rigori</th>
						<th class='center'>Cos / Val</th>
						<th class='center'>Ultimi</th>
					</thead>
				</tr>
				
				{foreach $GiocatoriTabella as $giocatore}
				
				<tr class='$ruolo'>
					<td class='center'><b class='ruolo {$giocatore.backruolo}'>{$giocatore.ruolo}</b></td> 
					<td><a href='stat_calciatore.php?num_calciatore=$num_calciatore'>{$giocatore.nome}</a> {$giocatore.attivo}</td>
					<td>{$giocatore.squadra}</td>
					<td class='center'>{$giocatore.partite_giocate}</td>
					<td class='center'>{$giocatore.media_punti} ({$giocatore.media_giornale})</td>
					<td class='center'>{$giocatore.gol}</td>
					<td class='center'>{$giocatore.assist}</td>
					<td class='center'>{$giocatore.ammonizioni}</td>
					<td class='center'>{$giocatore.espulsioni}</td>
					<td class='center'>{$giocatore.rigori}</td>
					<td class='center'>{$giocatore.costo} / {$giocatore.valore_attuale}</td>
					<td class='center'>{$giocatore.ultimo_fantavoto} ({$giocatore.ultimo_voto})</td>
				</tr>
				
				{/foreach}
				
			</table>
		</div>
	</div>
		
	<script type='text/javascript' src='./inc/js/ordina_tabella.js'></script> {* Script ordinamento tabella *}
		
{/if} 

{include file="footer.tpl"}
