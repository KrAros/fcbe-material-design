<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-20 10:43:00
  from 'C:\xampp\htdocs\test_fcbe\templates\a_gestione.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60a621144c68c8_08011695',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd69d000f1f01939e69624a1624b1922418681e9e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\test_fcbe\\templates\\a_gestione.tpl',
      1 => 1621410199,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:a_template.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_60a621144c68c8_08011695 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "test.conf", "configurazione_script", 0);
?>

<?php
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "torneo_1.conf", null, 0);
?>


<?php if ($_SESSION['valido'] == 'SI') {?>
    <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>$_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'titolo_sito')), 0, false);
?>
    <?php $_smarty_tpl->_subTemplateRender("file:a_template.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	
		<div class='row'>
		<div class='col m12'>
			<div class='card light-blue darken-4'>
				<div class='card-content white-text'>
					<span class='card-title center'>Elenco giornate</span>
					<p><?php echo $_smarty_tpl->tpl_vars['giornate_giocate']->value;?>
</p>
				</div>
			</div>
		</div>
	</div>
		<div class='row'>
		<div class='col m12'>
			<?php if ($_smarty_tpl->tpl_vars['timestamp']->value > $_smarty_tpl->tpl_vars['time_voti_locale']->value) {?>
				<form method='post' action='./a_gestione.php'>
					<input type='hidden' name='ccfv' value='SI' />
					<input type='hidden' name='clfv' value='<?php echo $_smarty_tpl->tpl_vars['clfv']->value;?>
' />
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
			<?php } else { ?>
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
			<?php }?>
		</div>
	</div>
		<div class='row'>
				<div class='col s12 m6'>
			<?php if ($_smarty_tpl->tpl_vars['timestamp']->value > $_smarty_tpl->tpl_vars['mcc_file']->value && $_smarty_tpl->tpl_vars['ultima_gio']->value == "00") {?>
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
			<?php } elseif ($_smarty_tpl->tpl_vars['timestamp']->value > $_smarty_tpl->tpl_vars['mcc_file']->value) {?>
				<center>
					<br/>
					<span class='evidenziato'>E' disponibile un aggiornamento del file <b>MCC<?php echo $_smarty_tpl->tpl_vars['ultima_gio']->value;?>
.txt</b></span>
				</center>
				<br/>
				<div style='float: left; padding: 5px;'>
					<form method='post' action='./a_gestione.php'>
						<input type='hidden' name='procedi' value='SI' />
						<input type='hidden' name='ultima_gio' value='$ultima_gio' />
						<input type='submit' name='aggiorna_voti' value='Aggiorna MCC$ultima_gio.txt' />
					</form>
				</div>
			<?php } else { ?>
				<div class='card green'>
					<div class='card-content center white-text'>
						<span class='card-title'>Voti giornata <?php echo $_smarty_tpl->tpl_vars['ultima_gio']->value;?>
</span>
						<p><i class='medium material-icons green-text text-lighten-4'>check_circle</i></p>
						<br>
						<p>Il file MCC della giornata precedente &eacute; aggiornato.</p>
					</div>
					<div class='card-action center'>
						<button class='btn waves-effect waves-light' type='submit' name='carica_calciatori' disabled $dis1>Nulla da aggiornare</button>
					</div>
				</div>
			<?php }?>
		</div>
				<?php if ($_smarty_tpl->tpl_vars['clfv']->value == "NO" && $_smarty_tpl->tpl_vars['lfv']->value == "NO") {?>
			<div style='float: center; padding: 22px;'>
				<b>Procedura disattivata da pannello config!</b>
			</div>
		<?php } else { ?>
			<div class='col s12 m6'>
				<?php if (!$_smarty_tpl->tpl_vars['file_mcc']->value) {?>
					<form method='post' action='./a_gestione.php'>
						<input type='hidden' name='cfv' value='SI' />
						<input type='hidden' name='lfv' value='<?php echo $_smarty_tpl->tpl_vars['lfv']->value;?>
' />
						<input type='hidden' name='nfv' value='<?php echo $_smarty_tpl->tpl_vars['prossima']->value;?>
' />
						<div class='card yellow'>
							<div class='card-content center'>
								<span class='card-title'>Voti giornata <?php echo $_smarty_tpl->tpl_vars['prossima']->value;?>
</span>
								<p><i class='medium material-icons yellow-text text-darken-3'>info</i></p>
								<br>
								<p>&Eacute; disponibile un nuovo file <b>MCC</b>: scaricalo!</p>
							</div>
							<div class='card-action center'>
								<button class='btn waves-effect waves-light yellow darken-3 black-text' type='submit' name='preleva_voti' $dis1>Preleva MCC<?php echo $_smarty_tpl->tpl_vars['prossima']->value;?>
.txt</button>
							</div>
						</div>
					</form>
				<?php } else { ?>
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
				<?php }?>
			</div>
		<?php }?>
	</div>
	</div>
	</div>
	</div>
	<div class='card-action center'>
		<form method='post' action='./a_crea_giornata.php'>
			<input type='hidden' name='giornata' value='<?php echo $_smarty_tpl->tpl_vars['prossima']->value;?>
' />
			<button class='btn waves-effect waves-light green' type='submit' name='crea_giornata' <?php echo $_smarty_tpl->tpl_vars['dis']->value;?>
>Crea la giornata <?php echo $_smarty_tpl->tpl_vars['prossima']->value;?>
</button>
		</form>			
	</div>
<?php }?>

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
