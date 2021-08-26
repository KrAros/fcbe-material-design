<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-20 12:56:16
  from 'C:\xampp\htdocs\test_fcbe\templates\a_torneo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60a640500fc394_67853129',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f97c61ace1245cda9a1a75a3e16ada117631569e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\test_fcbe\\templates\\a_torneo.tpl',
      1 => 1621508171,
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
function content_60a640500fc394_67853129 (Smarty_Internal_Template $_smarty_tpl) {
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
						<?php if ($_smarty_tpl->tpl_vars['inserimento']->value != "scrivi" && $_smarty_tpl->tpl_vars['azione']->value == "cancella") {?>
				<table width='100%' style='padding: 15px;'>
				<caption>Cancellazione torneo</caption>
					<tr>
						<td align='center'>
							<br /><br />
							<b>Utilizzare la funzione di cancellazione solo alla fine del campionato e verificare che nel file tornei.php non ci siano righe vuote presenti!</b><br /><br />
							Sei sicuro di voler cancellare il torneo <b><u><?php echo $_smarty_tpl->tpl_vars['itdenom']->value;?>
</u></b> (ID: <?php echo $_smarty_tpl->tpl_vars['id']->value;?>
)?<br /><br />
							<br /><br />
							<form method='post' action='a_torneo.php'>
								<input type='hidden' name='iitorneo' value='<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
' />
								<input type='hidden' name='azione' value='cancella' />
								<input type='hidden' name='inserimento' value='scrivi' />
								<input type='submit' value='Cancella' />
							</form>
						</td>
					</tr>
				</table>
			<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['inserimento']->value == "scrivi") {?>
								<?php if ($_smarty_tpl->tpl_vars['azione']->value == "nuovo") {?>
					<h1>Torneo creato</h1><br />
					$N_otid - $N_otdenom<br />
					<form method='post' action='a_torneo.php'>
						<input type='hidden' name='itorneo' value='$id' />
						<input type='submit' value='Ritorna' />
					</form>
					
				<?php } elseif ($_smarty_tpl->tpl_vars['azione']->value == "modifica") {?>
					<h1>Torneo modificato</h1><br />
					$N_otid - $N_otdenom<br />
					<form method='post' action='a_torneo.php'>
						<input type='hidden' name='itorneo' value='$id' />
						<input type='submit' value='Ritorna' />
					</form>
								<?php } elseif ($_smarty_tpl->tpl_vars['azione']->value == "cancella") {?>
					<h1>Torneo cancellato</h1><br />
						<form method='post' action='a_torneo.php'>
						<input type='submit' value='Ritorna' /></form>
				<?php }?>
						<?php } elseif ($_smarty_tpl->tpl_vars['azione']->value != "cancella") {?>
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
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['TorneiTabella']->value, 'lista_tornei');
$_smarty_tpl->tpl_vars['lista_tornei']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['lista_tornei']->value) {
$_smarty_tpl->tpl_vars['lista_tornei']->do_else = false;
?>
						<tr>
							<td align='center'>
								<?php echo $_smarty_tpl->tpl_vars['lista_tornei']->value['id'];?>

							</td>
							<td align='left'>
								<?php echo $_smarty_tpl->tpl_vars['lista_tornei']->value['nome'];?>

							</td>
							<td class='center'>
								<form method='post' action='a_torneo.php'>
									<input type='hidden' name='itorneo' value='<?php echo $_smarty_tpl->tpl_vars['lista_tornei']->value['id'];?>
' />
									<input type='hidden' name='azione' value='vedi' />
									<input type='hidden' name='inserimento' value='NO' />
									<input type='image' src='./immagini/parametri.png' name='submit' alt='Parametri' />
								</form>
							</td>
							<td class='center'>
								<form method='post' action='a_gestione_tornei.php'>
									<input type='hidden' name='itorneo' value='<?php echo $_smarty_tpl->tpl_vars['lista_tornei']->value['id'];?>
' />
									<input type='image' src='./immagini/gestione.png' name='submit' alt='Gestione' />
								</form>
							</td>
							<td class='center'>
								<form method='post' action='a_torneo.php'>
									<input type='hidden' name='itorneo' value='<?php echo $_smarty_tpl->tpl_vars['lista_tornei']->value['id'];?>
' />
									<input type='hidden' name='itdenom' value='<?php echo $_smarty_tpl->tpl_vars['lista_tornei']->value['nome'];?>
' />
									<input type='hidden' name='inserimento' value='NO' />
									<input type='hidden' name='azione' value='cancella' />
									<input type='image' src='./immagini/elimina32.png' name='submit' alt='Elimina' />
								</form>
							</td>
						</tr>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					<tr>
						<td colspan='5' class='center'>
							<form method='post' action='a_torneo.php'>
								<input type='hidden' name='azione' value='nuovo' />
								<input type='hidden' name='itorneo' value='<?php echo $_smarty_tpl->tpl_vars['nuovo_torneo']->value;?>
' />
								<input type='hidden' name='inserimento' value='NO' />
								<button type='submit' class='btn waves-effect waves-light green' name='cancella' value='Crea un nuovo campionato (ID: <?php echo $_smarty_tpl->tpl_vars['nuovo_torneo']->value;?>
)'/>Crea un nuovo campionato (ID: <?php echo $_smarty_tpl->tpl_vars['nuovo_torneo']->value;?>
)</button>
							</form>
						</td>
					</tr>
				</table>
				<?php if ($_smarty_tpl->tpl_vars['messgestutente']->value) {?>
					<font class='evidenziato'>&nbsp;$avviso[$messgestutente]&nbsp;</font>
				<?php } else { ?>
					<?php if ($_smarty_tpl->tpl_vars['azione']->value == "nuovo") {?>
						<?php if ($_smarty_tpl->tpl_vars['attiva_multi']->value != "SI") {?>
							<div align='center' class='evidenziato'>
								<i class='material-icons'>info</i><h2>ATTENZIONE</h2> L'opzione <b>multigestione</b> non &egrave; stata attivata: proseguite a vostro rischio e pericolo!
							</div>
						<?php }?>
						<div class='mdl-card mdl-shadow--2dp'>
							<div class='mdl-card__supporting-text' style='color:#060643; width: 97%;'>
								La procedura di <b>configurazione del torneo</b> si svolge in due fasi: questa &egrave; la prima, dove sono definite le caratteristiche generali del torneo. Occorrer&agrave; modificare successivamente la competizione appena creata per selezionare le opzioni specifiche relative alla modalit&agrave; di torneo scelta.
							</div>
						</div>
						<form name='torneo' method='post' action='a_torneo.php'>
						<?php if ($_smarty_tpl->tpl_vars['azione']->value == "nuovo") {?>
							<input type='hidden' name='azione' value='nuovo' />
						<?php } else { ?>
							<input type='hidden' name='azione' value='modifica' />
						<?php }?>
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
											<input type="hidden" name="N_otid" value="<?php echo $_smarty_tpl->tpl_vars['info_torneo']->value['id'];?>
" /><?php echo $_smarty_tpl->tpl_vars['info_torneo']->value['id'];?>

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
											<input class='validate' placeholder='<?php echo $_smarty_tpl->tpl_vars['info_torneo']->value['nome'];?>
' type='text' value='<?php echo $_smarty_tpl->tpl_vars['info_torneo']->value['nome'];?>
' name='N_otdenom' id='input_text' data-length='50' />
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
												<option value="SI" <?php if ($_smarty_tpl->tpl_vars['info_torneo']->value['mercato_libero'] == "SI") {?> "selected" <?php }?>>Mercato libero</option>
												<option value="NO" <?php if ($_smarty_tpl->tpl_vars['info_torneo']->value['mercato_libero'] == "NO") {?> "selected" <?php }?>>Asta iniziale</option>
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
												<option value="I" <?php if ($_smarty_tpl->tpl_vars['info_torneo']->value['stato_mercato'] == "I") {?> "selected" <?php }?>>Fase Iniziale</option>
												<option value="B" <?php if ($_smarty_tpl->tpl_vars['info_torneo']->value['stato_mercato'] == "B") {?> "selected" <?php }?>>Buste chiuse</option>
												<option value="R" <?php if ($_smarty_tpl->tpl_vars['info_torneo']->value['stato_mercato'] == "R") {?> "selected" <?php }?>>Mercato riparazione</option>
												<option value="A" <?php if ($_smarty_tpl->tpl_vars['info_torneo']->value['stato_mercato'] == "A") {?> "selected" <?php }?>>Mercato aperto</option>
												<option value="P" <?php if ($_smarty_tpl->tpl_vars['info_torneo']->value['stato_mercato'] == "P") {?> "selected" <?php }?>>Asta perenne</option>
												<option value="S" <?php if ($_smarty_tpl->tpl_vars['info_torneo']->value['stato_mercato'] == "S") {?> "selected" <?php }?>>>Mercato sospeso</option>
												<option value="C" <?php if ($_smarty_tpl->tpl_vars['info_torneo']->value['stato_mercato'] == "C") {?> "selected" <?php }?>>Mercato chiuso</option>
												<option value="Z" <?php if ($_smarty_tpl->tpl_vars['info_torneo']->value['stato_mercato'] == "Z") {?> "selected" <?php }?>>Torneo non attivo</option>
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
					<?php }?>
				<?php }?>
			<?php }?>
		</div>
	</div>
	
<?php }?>

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
