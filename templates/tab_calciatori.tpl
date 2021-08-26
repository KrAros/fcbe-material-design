{config_load file="test.conf" section="configurazione_script"}
{config_load file="torneo_1.conf"}

{if $smarty.session.valido eq 'SI'}
    {include file="header.tpl" title=#titolo_sito#}
    {include file="template.tpl"}

	{tabella_squadre()}
	
	{* Filtri ruoli e ricerca calciatore *}
	
	<div class='row'>
		<div class='col m6 center'>
			<label>Filtra per ruolo:</label>
			<div class='switch' style='padding-top: 10px;'>
				<label>
					<input id='switch_portieri' type='checkbox' checked>
					<span class='lever portieri'></span>
				</label>
				<label>
					<input id='switch_difensori' type='checkbox' checked>
					<span class='lever difensori'></span>
				</label>
				<label>
					<input id='switch_centrocampisti' type='checkbox' checked>
					<span class='lever centrocampisti'></span>
				</label>
				<label>
					<input id='switch_attaccanti' type='checkbox' checked>
					<span class='lever attaccanti'></span>
				</label>
			</div>
		</div>
		<div class='col m6 center'>
			<label>Cerca giocatore:</label>
			<div class='input-field' style='margin: 0;'>
				<input type='text' id='search'></input>
			</div>
		</div>
	</div>
	
	{* Tabella calciatori *}
		
	<div class='row'>
		<div class='col m12'>			
			<table class='sortable responsive-table highlight' style='width:100%' cellpadding='10' cellspacing='0' id='t1'>
				<tr>
					<thead>
						<th></th>
						<th>Calciatore</th>
						<th>Squadra</th>
						<th class='center'>Presenze</th>
						<th class='center'>Media Voto</th>
						<th class='center'>Media FantaVoto</th>
						<th class='center'>Quotazione</th>
						<th>Operazioni</th>
					</thead>
				</tr>
		
				{foreach $GiocatoriTabella as $giocatore}

				<tr class='{$giocatore.ruolo}'>
					<td class='center' style='padding: 15px;'><span class='ruolo {$giocatore.backruolo}'>{$giocatore.ruolo}</span></td>
					<td>{$giocatore.nome} {$giocatore.$info}</td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_{$giocatore.squadra}.gif'><a href='tab_squadre.php?vedi_squadra={$giocatore.squadra}'>{$giocatore.squadra}</a></td>
					<td class='center'>{$giocatore.partite_giocate}</td>
					<td class='center'>{$giocatore.media_giornale}</td>
					<td class='center'>{$giocatore.media_punti}</td>
					<td class='center'>{$giocatore.valore}</td>
					<td class='center'>{$giocatore.azione}</td>
				</tr>
				
				{/foreach}
				
			</table>
		</div>
	</div>
		
	<script type='text/javascript' src='./inc/js/ordina_tabella.js'></script> {* Script ordinamento tabella *}
		
{/if} 

{include file="footer.tpl"}
