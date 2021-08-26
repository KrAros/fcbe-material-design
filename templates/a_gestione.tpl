{config_load file="test.conf" section="configurazione_script"}
{config_load file="torneo_1.conf"}

{if $smarty.session.valido eq 'SI'}
    {include file="header.tpl" title=#titolo_sito#}
    {include file="a_template.tpl"}
	
	{* Scheda elenco giornate *}
	<div class='row'>
		<div class='col m12'>
			<div class='card light-blue darken-4'>
				<div class='card-content white-text'>
					<span class='card-title center'>Elenco giornate</span>
					<p>{$giornate_giocate}</p>
				</div>
			</div>
		</div>
	</div>
	{* Scheda aggiornamento file calciatori *}
	<div class='row'>
		<div class='col m12'>
			{if $timestamp > $time_voti_locale}
				<form method='post' action='./a_gestione.php'>
					<input type='hidden' name='ccfv' value='SI' />
					<input type='hidden' name='clfv' value='{$clfv}' />
					<div class='card yellow'>
						<div class='card-content center'>
							<span class='card-title'>Lista calciatori</span>
							<p><i class='medium material-icons yellow-text text-darken-3'>info</i></p>
							<br>
							<p>&Eacute; disponibile un nuovo file <b>Calciatori</b>: scaricalo!</p>
						</div>
						<div class='card-action center'>
							<button class='btn waves-effect waves-light yellow darken-3 black-text' type='submit' name='carica_calciatori' $dis1>Aggiorna lista</button>
						</div>
					</div>
				</form>
			{else}
				<div class='card green'>
					<div class='card-content center white-text'>
						<span class='card-title'>Lista calciatori</span>
						<p><i class='medium material-icons green-text text-lighten-4'>check_circle</i></p>
						<br>
						<p>Tutto aggiornato: l'ultimo file <b>Calciatori</b> &eacute; caricato sul sito.</p>
					</div>
					<div class='card-action center'>
						<button class='btn waves-effect waves-light green darken-3 black-text' type='submit' disabled>Nulla da aggiornare</button>
					</div>
				</div>
			{/if}
		</div>
	</div>
	{* Schede voti *}
	<div class='row'>
		{* Scheda giornata precedente *}
		<div class='col s12 m6'>
			{if $timestamp > $mcc_file && $ultima_gio eq "00"}
				<div class='card green'>
					<div class='card-content center white-text'>
						<span class='card-title'>Fase preliminare</span>
						<p><i class='medium material-icons green-text text-lighten-4'>check_circle</i></p>
						<br>
						<p>I file MCC non sono disponibili in questa fase.</p>
					</div>
					<div class='card-action center'>
						<button class='btn waves-effect waves-light' type='submit' name='carica_calciatori' disabled $dis1>Nulla da aggiornare</button>
					</div>
				</div>
			{elseif $timestamp > $mcc_file}
				<center>
					<br/>
					<span class='evidenziato'>E' disponibile un aggiornamento del file <b>MCC{$ultima_gio}.txt</b></span>
				</center>
				<br/>
				<div style='float: left; padding: 5px;'>
					<form method='post' action='./a_gestione.php'>
						<input type='hidden' name='procedi' value='SI' />
						<input type='hidden' name='ultima_gio' value='$ultima_gio' />
						<input type='submit' name='aggiorna_voti' value='Aggiorna MCC$ultima_gio.txt' />
					</form>
				</div>
			{else}
				<div class='card green'>
					<div class='card-content center white-text'>
						<span class='card-title'>Voti giornata {$ultima_gio}</span>
						<p><i class='medium material-icons green-text text-lighten-4'>check_circle</i></p>
						<br>
						<p>Il file MCC della giornata precedente &eacute; aggiornato.</p>
					</div>
					<div class='card-action center'>
						<button class='btn waves-effect waves-light' type='submit' name='carica_calciatori' disabled $dis1>Nulla da aggiornare</button>
					</div>
				</div>
			{/if}
		</div>
		{* Scheda giornata successiva *}
		{if $clfv eq "NO" && $lfv eq "NO"}
			<div style='float: center; padding: 22px;'>
				<b>Procedura disattivata da pannello config!</b>
			</div>
		{else}
			<div class='col s12 m6'>
				{if not $file_mcc}
					<form method='post' action='./a_gestione.php'>
						<input type='hidden' name='cfv' value='SI' />
						<input type='hidden' name='lfv' value='{$lfv}' />
						<input type='hidden' name='nfv' value='{$prossima}' />
						<div class='card yellow'>
							<div class='card-content center'>
								<span class='card-title'>Voti giornata {$prossima}</span>
								<p><i class='medium material-icons yellow-text text-darken-3'>info</i></p>
								<br>
								<p>&Eacute; disponibile un nuovo file <b>MCC</b>: scaricalo!</p>
							</div>
							<div class='card-action center'>
								<button class='btn waves-effect waves-light yellow darken-3 black-text' type='submit' name='preleva_voti' $dis1>Preleva MCC{$prossima}.txt</button>
							</div>
						</div>
					</form>
				{else}
					<div class='card green'>
						<div class='card-content center white-text'>
							<span class='card-title'>Voti giornata</span>
							<p><i class='medium material-icons green-text text-lighten-4'>check_circle</i></p>
							<br>
							<p>L'ultimo file MCC &eacute; correttamente caricato sul sito.</p>
						</div>
						<div class='card-action center'>
							<button class='btn waves-effect waves-light' type='submit' name='carica_calciatori' disabled $dis1>Nulla da aggiornare</button>
						</div>
					</div>
				{/if}
			</div>
		{/if}
	</div>
	</div>
	</div>
	</div>
	<div class='card-action center'>
		<form method='post' action='./a_crea_giornata.php'>
			<input type='hidden' name='giornata' value='{$prossima}' />
			<button class='btn waves-effect waves-light green' type='submit' name='crea_giornata' {$dis}>Crea la giornata {$prossima}</button>
		</form>			
	</div>
{/if}

{include file="footer.tpl"}
