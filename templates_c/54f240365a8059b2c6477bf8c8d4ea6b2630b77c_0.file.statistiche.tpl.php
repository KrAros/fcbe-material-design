<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-20 09:23:51
  from 'C:\xampp\htdocs\test_fcbe\templates\statistiche.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60a60e8792db88_83056189',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '54f240365a8059b2c6477bf8c8d4ea6b2630b77c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\test_fcbe\\templates\\statistiche.tpl',
      1 => 1598684813,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:template.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_60a60e8792db88_83056189 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "test.conf", "configurazione_script", 0);
?>

<?php
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "torneo_1.conf", null, 0);
?>


<?php if ($_SESSION['valido'] == 'SI') {?>
    <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>$_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'titolo_sito')), 0, false);
?>
    <?php $_smarty_tpl->_subTemplateRender("file:template.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	
			
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
								<?php echo $_smarty_tpl->tpl_vars['team']->value;?>

							</select>
						</div>
					</div>
					<div class='col m2 center'>
						<label>Seleziona stagione:</label>
						<div class='input-field col m12 right' style='margin-top: 0;'>
							<select id='stg' name='stg' onchange='selectChanged(this)'>";
								<?php echo $_smarty_tpl->tpl_vars['season']->value;?>

							</select>
						</div>
					</div>
					<div class='col m2 center'>
						<label>Seleziona giornata:</label>
						<div class='input-field col m12 right' style='margin-top: 0;'>
							<select id='numgio' name='numgio' onchange='selectChanged(this)'>";
								<option value='tutte'>Tutte</option>"; 
								<?php echo $_smarty_tpl->tpl_vars['match']->value;?>

							</select>
						</div>
					</div>
				</form>
			</div>
			
				
		<?php if ($_smarty_tpl->tpl_vars['numero_giornata']->value != 'tutte') {?>
		
					
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
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GiocatoriTabella']->value, 'giocatore');
$_smarty_tpl->tpl_vars['giocatore']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['giocatore']->value) {
$_smarty_tpl->tpl_vars['giocatore']->do_else = false;
?>
					<?php ob_start();
echo $_smarty_tpl->tpl_vars['giocatore']->value['squadra'];
$_prefixVariable1 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['giocatore']->value['presenza'];
$_prefixVariable2 = ob_get_clean();
if (($_smarty_tpl->tpl_vars['squadra_selezionata']->value == $_prefixVariable1 || $_smarty_tpl->tpl_vars['squadra_selezionata']->value == 'tutte') && $_prefixVariable2 != '0') {?>
						<tr class='<?php echo $_smarty_tpl->tpl_vars['giocatore']->value['ruolo'];?>
' align='center'>
							<td class='center' style='padding: 5px;'><span class='ruolo <?php echo $_smarty_tpl->tpl_vars['giocatore']->value['backruolo'];?>
'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['ruolo'];?>
</span></td>
							<td><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['nome'];?>
</td>
							<td class='<?php echo $_smarty_tpl->tpl_vars['giocatore']->value['cartellino'];?>
'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['voto'];?>
</td>
							<td class='center' bgcolor='<?php echo $_smarty_tpl->tpl_vars['giocatore']->value['colore_sv'];?>
'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['fantavoto'];?>
</td>
							<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['gol_fatti'];?>
</td>
							<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['rigori_tirati'];?>
</td>
							<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['rigori_sbagliati'];?>
</td>
							<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['gol_vittoria'];?>
</td>
							<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['gol_pareggio'];?>
</td>
							<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['assist'];?>
</td>
							<td class='center' style='background: <?php echo $_smarty_tpl->tpl_vars['giocatore']->value['colonne_portiere'];?>
'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['gol_subiti'];?>
</td>
							<td class='center' style='background: <?php echo $_smarty_tpl->tpl_vars['giocatore']->value['colonne_portiere'];?>
'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['rigori_parati'];?>
</td>
							<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['autogol'];?>
</td>
						</tr>
					<?php }?>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</table>
				</div>
			</div>
		<?php } else { ?>
			<?php if ($_smarty_tpl->tpl_vars['ultima_giornata']->value == '') {?>
				Statistiche non presenti
			<?php } else { ?>
				<p align='center'>
					Dati statistici aggiornati dalla giornata di campionato 01 alla giornata <?php echo $_smarty_tpl->tpl_vars['ultima_giornata']->value;?>

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
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GiocatoriTabella']->value, 'giocatore');
$_smarty_tpl->tpl_vars['giocatore']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['giocatore']->value) {
$_smarty_tpl->tpl_vars['giocatore']->do_else = false;
?>
					<tr class='<?php echo $_smarty_tpl->tpl_vars['giocatore']->value['ruolo'];?>
'>
						<td class='center' style='padding: 15px;'><span class='ruolo <?php echo $_smarty_tpl->tpl_vars['giocatore']->value['backruolo'];?>
'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['ruolo'];?>
</span></td>
						<td><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['nome'];?>
 <?php echo $_smarty_tpl->tpl_vars['giocatore']->value['attivo'];?>
</td>
						<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['presenze_totali'];?>
</td>
						<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['media_voto'];?>
</td>
						<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['media_fantavoto'];?>
</td>
						<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['totale_gol_segnati'];?>
</td>
						<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['totale_assist'];?>
</td>
						<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['totale_gialli'];?>
</td>
						<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['totale_rossi'];?>
</td>
						<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['totale_rigori'];?>
</td>
						<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['totale_autoreti'];?>
</td>
					</tr>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</table>
			<?php }?>
		<?php }?>
		
		
	</div>
	</div>
		
	<?php echo '<script'; ?>
 type='text/javascript' src='./inc/js/ordina_tabella.js'><?php echo '</script'; ?>
> 		
<?php }?> 

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
