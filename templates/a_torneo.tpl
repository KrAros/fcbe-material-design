{config_load file="test.conf" section="configurazione_script"}
{config_load file="torneo_1.conf"}

{if $smarty.session.valido eq 'SI'}
    {include file="header.tpl" title=#titolo_sito#}
    {include file="a_template.tpl"}
	
	<div class='row'>
		<div class='col m12'>
			{* Finestra di cancellazione del torneo *}
			{if $inserimento neq "scrivi" && $azione eq "cancella"}
				<table width='100%' style='padding: 15px;'>
				<caption>Cancellazione torneo</caption>
					<tr>
						<td align='center'>
							<br /><br />
							<b>Utilizzare la funzione di cancellazione solo alla fine del campionato e verificare che nel file tornei.php non ci siano righe vuote presenti!</b><br /><br />
							Sei sicuro di voler cancellare il torneo <b><u>{$itdenom}</u></b> (ID: {$id})?<br /><br />
							<br /><br />
							<form method='post' action='a_torneo.php'>
								<input type='hidden' name='iitorneo' value='{$id}' />
								<input type='hidden' name='azione' value='cancella' />
								<input type='hidden' name='inserimento' value='scrivi' />
								<input type='submit' value='Cancella' />
							</form>
						</td>
					</tr>
				</table>
			{/if}
			{* Messaggi di modifiche del torneo *}
			{if $inserimento eq "scrivi"}
				{* Messaggio di creazione del torneo *}
				{if $azione eq "nuovo"}
					<h1>Torneo creato</h1><br />
					$N_otid - $N_otdenom<br />
					<form method='post' action='a_torneo.php'>
						<input type='hidden' name='itorneo' value='$id' />
						<input type='submit' value='Ritorna' />
					</form>
				{* Messaggio di modifica del torneo *}	
				{elseif $azione eq "modifica"}
					<h1>Torneo modificato</h1><br />
					$N_otid - $N_otdenom<br />
					<form method='post' action='a_torneo.php'>
						<input type='hidden' name='itorneo' value='$id' />
						<input type='submit' value='Ritorna' />
					</form>
				{* Messaggio di cancellazione del torneo *}
				{elseif $azione eq "cancella"}
					<h1>Torneo cancellato</h1><br />
						<form method='post' action='a_torneo.php'>
						<input type='submit' value='Ritorna' /></form>
				{/if}
			{* Interfaccia di riepilogo dei tornei *}
			{elseif $azione neq "cancella"}
				<table class='highlight' style='width:100%'>
					<thead>
						<tr>
							<th>ID</th>
							<th>Denominazione</th>
							<th class='center'>Parametri</th>
							<th class='center'>Gestione</th>
							<th class='center'>Elimina</th>
						</tr>
					</thead>
					{foreach $TorneiTabella as $lista_tornei}
						<tr>
							<td align='center'>
								{$lista_tornei.id}
							</td>
							<td align='left'>
								{$lista_tornei.nome}
							</td>
							<td class='center'>
								<form method='post' action='a_torneo.php'>
									<input type='hidden' name='itorneo' value='{$lista_tornei.id}' />
									<input type='hidden' name='azione' value='vedi' />
									<input type='hidden' name='inserimento' value='NO' />
									<input type='image' src='./immagini/parametri.png' name='submit' alt='Parametri' />
								</form>
							</td>
							<td class='center'>
								<form method='post' action='a_gestione_tornei.php'>
									<input type='hidden' name='itorneo' value='{$lista_tornei.id}' />
									<input type='image' src='./immagini/gestione.png' name='submit' alt='Gestione' />
								</form>
							</td>
							<td class='center'>
								<form method='post' action='a_torneo.php'>
									<input type='hidden' name='itorneo' value='{$lista_tornei.id}' />
									<input type='hidden' name='itdenom' value='{$lista_tornei.nome}' />
									<input type='hidden' name='inserimento' value='NO' />
									<input type='hidden' name='azione' value='cancella' />
									<input type='image' src='./immagini/elimina32.png' name='submit' alt='Elimina' />
								</form>
							</td>
						</tr>
					{/foreach}
					<tr>
						<td colspan='5' class='center'>
							<form method='post' action='a_torneo.php'>
								<input type='hidden' name='azione' value='nuovo' />
								<input type='hidden' name='itorneo' value='{$nuovo_torneo}' />
								<input type='hidden' name='inserimento' value='NO' />
								<button type='submit' class='btn waves-effect waves-light green' name='cancella' value='Crea un nuovo campionato (ID: {$nuovo_torneo})'/>Crea un nuovo campionato (ID: {$nuovo_torneo})</button>
							</form>
						</td>
					</tr>
				</table>
				{if $messgestutente}
					<font class='evidenziato'>&nbsp;$avviso[$messgestutente]&nbsp;</font>
				{else}
					{if $azione eq "nuovo"}
						{if $attiva_multi neq "SI"}
							<div align='center' class='evidenziato'>
								<i class='material-icons'>info</i><h2>ATTENZIONE</h2> L'opzione <b>multigestione</b> non &egrave; stata attivata: proseguite a vostro rischio e pericolo!
							</div>
						{/if}
						<div class='mdl-card mdl-shadow--2dp'>
							<div class='mdl-card__supporting-text' style='color:#060643; width: 97%;'>
								La procedura di <b>configurazione del torneo</b> si svolge in due fasi: questa &egrave; la prima, dove sono definite le caratteristiche generali del torneo. Occorrer&agrave; modificare successivamente la competizione appena creata per selezionare le opzioni specifiche relative alla modalit&agrave; di torneo scelta.
							</div>
						</div>
						<form name='torneo' method='post' action='a_torneo.php'>
						{if $azione eq "nuovo"}
							<input type='hidden' name='azione' value='nuovo' />
						{else}
							<input type='hidden' name='azione' value='modifica' />
						{/if}
						<table class="highlight centered">
							<thead>
								<tr>
									<th>Nome</th>
									<th>Opzione</th>
									<th>Info</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>ID Torneo</td>
									<td>
										<div class='input-field'>
											<input type="hidden" name="N_otid" value="{$info_torneo.id}" />{$info_torneo.id}
										</div>
									</td>
									<td>
										<i class='material-icons tooltipped' data-position='top' data-tooltip='Progressivo ad uso interno, non modificabile.' >info</i>
									</td>
								</tr>
								<tr>
									<td>Denominazione</td>
									<td>
										<div class='input-field'>
											<input class='validate' placeholder='{$info_torneo.nome}' type='text' value='{$info_torneo.nome}' name='N_otdenom' id='input_text' data-length='50' />
										</div>
									</td>
									<td>
										<i class='material-icons tooltipped' data-position='top' data-tooltip='Il nome del torneo.' >info</i>
									</td>
								</tr>
								<tr>
									<td>Modalit&agrave; di mercato</td>
									<td>
										<div class='input-field'>
											<select name='N_otmercato_libero'>
												<option value="SI" {if $info_torneo.mercato_libero eq "SI"} "selected" {/if}>Mercato libero</option>
												<option value="NO" {if $info_torneo.mercato_libero eq "NO"} "selected" {/if}>Asta iniziale</option>
											</select>
										</div>
									</td>
									<td>
										<i class='material-icons tooltipped' data-position='top' data-tooltip='La mdalit&agrave; del mercato pu&ograve; essere:<br /> 
										<b>Mercato libero</b>: un calciatore pu&ograve; apparire in pi&ugrave; rose.<br />
										<b>Asta iniziale</b>: un calciatore pu&ograve; apparire in una sola rosa a seguito di asta.' >info</i>
									</td>
								</tr>
								<tr>
									<td>Stato del mercato</td>
									<td>
										<div class='input-field'>
											<select name='N_otstato'>
												<option value="I" {if $info_torneo.stato_mercato eq "I"} "selected" {/if}>Fase Iniziale</option>
												<option value="B" {if $info_torneo.stato_mercato eq "B"} "selected" {/if}>Buste chiuse</option>
												<option value="R" {if $info_torneo.stato_mercato eq "R"} "selected" {/if}>Mercato riparazione</option>
												<option value="A" {if $info_torneo.stato_mercato eq "A"} "selected" {/if}>Mercato aperto</option>
												<option value="P" {if $info_torneo.stato_mercato eq "P"} "selected" {/if}>Asta perenne</option>
												<option value="S" {if $info_torneo.stato_mercato eq "S"} "selected" {/if}>Mercato sospeso</option>
												<option value="C" {if $info_torneo.stato_mercato eq "C"} "selected" {/if}>Mercato chiuso</option>
												<option value="Z" {if $info_torneo.stato_mercato eq "Z"} "selected" {/if}>Torneo non attivo</option>
											</select>
										</div>
									</td>
									<td>
										<i class='material-icons tooltipped' data-position='top' data-tooltip='Lo stato del mercato pu&ograve; essere:<br /> 
										<b>I</b> - Iniziale (fase di calcio mercato prima del campionato).<br />
										<b>A</b> - Aperto (consentite tutte le operazioni di mercato).<br />
										<b>P</b> - Asta perenne (consentite tutte le operazioni di mercato a base asta).<br />
										<b>S</b> - Sospeso (consentiti solo rilanci e vendita immediata di calciatori).<br />
										<b>C</b> - Chiuso (nessuna operazione di mercato consentita).<br /> 
										<b>R</b> - Riparazione (fase post-asta in cui si completano le squadre - <b>solo con asta iniziale</b>). <br /> 
										<b>B</b> - Buste chiuse (permette di fare offerte nascoste - <b>solo con asta iniziale</b>).' >info</i>
									</td>
								</tr>
							</tbody>
						</table>
					{/if}
				{/if}
			{/if}
		</div>
	</div>
	
{/if}

{include file="footer.tpl"}
