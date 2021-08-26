{config_load file="test.conf" section="configurazione_script"}
{config_load file="torneo_1.conf"}

{if $smarty.session.valido eq 'SI'}
    {include file="header.tpl" title=#titolo_sito#}
    {include file="template.tpl"}
	
	{* Form selezione info *}
		
	<div class='row'>
		<div class='col m12'>			
			<div class='row'>
				<div class='col m4 center'>
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
				<form id='form1' action='' method='post'>
					<div class='col m4 center'>
						<label>Seleziona squadra:</label>
						<div class='input-field col m12 right' style='margin-top: 0;'>
							<select id='squadr' name='squadr' onchange='selectChanged(this)'>";	
								<option value='tutte'>Tutte</option>
								{$team}
							</select>
						</div>
					</div>
					<div class='col m2 center'>
						<label>Seleziona stagione:</label>
						<div class='input-field col m12 right' style='margin-top: 0;'>
							<select id='stg' name='stg' onchange='selectChanged(this)'>";
								{$season}
							</select>
						</div>
					</div>
					<div class='col m2 center'>
						<label>Seleziona giornata:</label>
						<div class='input-field col m12 right' style='margin-top: 0;'>
							<select id='numgio' name='numgio' onchange='selectChanged(this)'>";
								<option value='tutte'>Tutte</option>"; 
								{$match}
							</select>
						</div>
					</div>
				</form>
			</div>
			
		{* Tabella calciatori *}
		
		{if $numero_giornata neq 'tutte'}
		
			{* Legenda sigle *}		
			<div class="row">
				<div class="col m12">
					<ul class="collapsible">
						<li>
							<div class="collapsible-header yellow" style="font-size: 16px;line-height: 1.6em;">
								<i class="material-icons">info_outline</i>
								Legenda<i class="material-icons">arrow_drop_down</i></div>
								<div class="collapsible-body yellow lighten-3">
									<p>
										<b>V</b> - Voto; <b>FV</b> - FantaVoto; <b>Gf</b> - Gol Fatti; <b>Gr</b> - Gol su Rigore; <b>Rs</b> - Rigore Sbagliato; <b>Gv</b> - Gol Vittoria; <b>Gp</b> - Gol Pareggio; <b>As</b> - Assist;<br> <b>Gs</b> - Gol Subito; <b>Rp</b> - Rigore Parato; <b>Au</b> - Autorete;
									</p>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col m12">
					<table class='sortable responsive-table highlight' style='width:100%' cellpadding='10' cellspacing='0' id='t1'>
						<tr>
							<thead>
								<th></th>
								<th>Nome</th>
								<th class='center'>V</th>
								<th class='center'>FV</th>
								<th class='center'>Gf</th>
								<th class='center'>Gr</th>
								<th class='center'>Rs</th>
								<th class='center'>Gv</th>
								<th class='center'>Gp</th>
								<th class='center'>As</th>
								<th class='center'>Gs</th>
								<th class='center'>Rp</th>
								<th class='center'>Au</th>
							</thead>
						</tr>
					{foreach $GiocatoriTabella as $giocatore}
					{if ($squadra_selezionata eq {$giocatore.squadra} or $squadra_selezionata eq 'tutte') && {$giocatore.presenza} neq '0'}
						<tr class='{$giocatore.ruolo}' align='center'>
							<td class='center' style='padding: 5px;'><span class='ruolo {$giocatore.backruolo}'>{$giocatore.ruolo}</span></td>
							<td>{$giocatore.nome}</td>
							<td class='{$giocatore.cartellino}'>{$giocatore.voto}</td>
							<td class='center' bgcolor='{$giocatore.colore_sv}'>{$giocatore.fantavoto}</td>
							<td class='center'>{$giocatore.gol_fatti}</td>
							<td class='center'>{$giocatore.rigori_tirati}</td>
							<td class='center'>{$giocatore.rigori_sbagliati}</td>
							<td class='center'>{$giocatore.gol_vittoria}</td>
							<td class='center'>{$giocatore.gol_pareggio}</td>
							<td class='center'>{$giocatore.assist}</td>
							<td class='center' style='background: {$giocatore.colonne_portiere}'>{$giocatore.gol_subiti}</td>
							<td class='center' style='background: {$giocatore.colonne_portiere}'>{$giocatore.rigori_parati}</td>
							<td class='center'>{$giocatore.autogol}</td>
						</tr>
					{/if}
					{/foreach}
					</table>
				</div>
			</div>
		{else}
			{if $ultima_giornata eq ''}
				Statistiche non presenti
			{else}
				<p align='center'>
					Dati statistici aggiornati dalla giornata di campionato 01 alla giornata {$ultima_giornata}
				</p>
				<table class='sortable responsive-table highlight' style='width:100%' cellpadding='10' cellspacing='0' id='t1'>
					<tr>
						<thead>
							<th></th>
							<th>Nome</th>
							<th class='center'>Partite</th>
							<th class='center'>Media</th>
							<th class='center'>Media FV</th>
							<th class='center'>Gol</th>
							<th class='center'>Assist</th>
							<th class='center'>Gialli</th>
							<th class='center'>Rossi</th>
							<th class='center'>Su Rigore</th>
							<th class='center'>Autogol</th>
						</thead>
					</tr>
					{foreach $GiocatoriTabella as $giocatore}
					<tr class='{$giocatore.ruolo}'>
						<td class='center' style='padding: 15px;'><span class='ruolo {$giocatore.backruolo}'>{$giocatore.ruolo}</span></td>
						<td>{$giocatore.nome} {$giocatore.attivo}</td>
						<td class='center'>{$giocatore.presenze_totali}</td>
						<td class='center'>{$giocatore.media_voto}</td>
						<td class='center'>{$giocatore.media_fantavoto}</td>
						<td class='center'>{$giocatore.totale_gol_segnati}</td>
						<td class='center'>{$giocatore.totale_assist}</td>
						<td class='center'>{$giocatore.totale_gialli}</td>
						<td class='center'>{$giocatore.totale_rossi}</td>
						<td class='center'>{$giocatore.totale_rigori}</td>
						<td class='center'>{$giocatore.totale_autoreti}</td>
					</tr>
					{/foreach}
				</table>
			{/if}
		{/if}
		
		
	</div>
	</div>
		
	<script type='text/javascript' src='./inc/js/ordina_tabella.js'></script> {* Script ordinamento tabella *}
		
{/if} 

{include file="footer.tpl"}
