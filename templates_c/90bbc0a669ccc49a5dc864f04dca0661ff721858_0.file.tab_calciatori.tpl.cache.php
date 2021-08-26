<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-20 09:16:55
  from 'C:\xampp\htdocs\test_fcbe\templates\tab_calciatori.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60a60ce7b6fab4_59809362',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '90bbc0a669ccc49a5dc864f04dca0661ff721858' => 
    array (
      0 => 'C:\\xampp\\htdocs\\test_fcbe\\templates\\tab_calciatori.tpl',
      1 => 1571991621,
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
function content_60a60ce7b6fab4_59809362 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '20133511860a60ce5a24e86_40815892';
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "test.conf", "configurazione_script", 0);
?>

<?php
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "torneo_1.conf", null, 0);
?>


<?php if ($_SESSION['valido'] == 'SI') {?>
    <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('title'=>$_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'titolo_sito')), 0, false);
?>
    <?php $_smarty_tpl->_subTemplateRender("file:template.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<?php echo tabella_squadre();?>

	
		
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
 <?php echo $_smarty_tpl->tpl_vars['giocatore']->value[$_smarty_tpl->tpl_vars['info']->value];?>
</td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_<?php echo $_smarty_tpl->tpl_vars['giocatore']->value['squadra'];?>
.gif'><a href='tab_squadre.php?vedi_squadra=<?php echo $_smarty_tpl->tpl_vars['giocatore']->value['squadra'];?>
'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['squadra'];?>
</a></td>
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['partite_giocate'];?>
</td>
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['media_giornale'];?>
</td>
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['media_punti'];?>
</td>
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['valore'];?>
</td>
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['azione'];?>
</td>
				</tr>
				
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				
			</table>
		</div>
	</div>
		
	<?php echo '<script'; ?>
 type='text/javascript' src='./inc/js/ordina_tabella.js'><?php echo '</script'; ?>
> 		
<?php }?> 

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
