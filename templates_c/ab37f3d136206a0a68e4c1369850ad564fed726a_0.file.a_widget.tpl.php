<?php
/* Smarty version 3.1.34-dev-7, created on 2021-08-26 11:43:18
  from 'C:\xampp\htdocs\fcbe-material-design\templates\a_widget.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_612762360def71_52608550',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ab37f3d136206a0a68e4c1369850ad564fed726a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\fcbe-material-design\\templates\\a_widget.tpl',
      1 => 1598955047,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_612762360def71_52608550 (Smarty_Internal_Template $_smarty_tpl) {
?><div class='col m3'>

		<div class='row'>
		<div class='col m12'>
			<div class='card indigo'>
				<form method='post' action='a_gestione.php'>
					<div class='card-content white-text'>
						<span class='card-title center white-text'>Consegna formazioni</span>
						<div class='evidenziato <?php echo $_smarty_tpl->tpl_vars['colorinfo']->value;?>
 center white-text'><?php echo $_smarty_tpl->tpl_vars['status_giornata']->value;?>
</div><br>
						<div class='center white-text'>Prossima chiusura giornata:</div>
						<input type='hidden' name='cambia_data' value='cambia_data' />
						<div class='input-field'>
							<i class='material-icons prefix white-text'>event</i>
							<input type='text' class='datepicker' name='datepicker' value='<?php echo $_smarty_tpl->tpl_vars['giorno_chiusura']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['mese_chiusura']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['anno_chiusura']->value;?>
'>
						</div>
						<div class='input-field'>
							<i class='material-icons prefix white-text'>alarm</i>
							<input type='text' class='timepicker' name='timepicker' value='<?php echo $_smarty_tpl->tpl_vars['ora_chiusura']->value;?>
:<?php echo $_smarty_tpl->tpl_vars['minuti_chiusura']->value;?>
'>
						</div>
					</div>
					<div class='card-action center'>
						<button type='submit' class='btn waves-effect waves-light green'/>Cambia data</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<?php echo '<script'; ?>
>
		$(document).ready(function(){
			$('.datepicker').datepicker({
				firstDay: 1,
				format: 'dd/mm/yyyy',
				defaultDate: new Date('<?php echo $_smarty_tpl->tpl_vars['mese_chiusura']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['giorno_chiusura']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['anno_chiusura']->value;?>
'),
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
				defaultTime: '<?php echo $_smarty_tpl->tpl_vars['ora_chiusura']->value;?>
:<?php echo $_smarty_tpl->tpl_vars['minuti_chiusura']->value;?>
',
			})
		});
	<?php echo '</script'; ?>
>
	
		<div class='row'>
		<div class='col m12'>
			<div class='card'>
				<div class='card-content'>
					<span class='card-title'>Le ultime dal Forum</span>
					<div class='row'>
						<?php echo $_smarty_tpl->tpl_vars['feed_rss_forum']->value;?>

					</div>
				</div>
			</div>
		</div>
	</div>
		
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
</div><?php }
}
