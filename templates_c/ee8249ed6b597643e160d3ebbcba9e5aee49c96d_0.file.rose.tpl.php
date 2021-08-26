<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-20 09:23:24
  from 'C:\xampp\htdocs\test_fcbe\templates\rose.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60a60e6ccf33d1_43649382',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ee8249ed6b597643e160d3ebbcba9e5aee49c96d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\test_fcbe\\templates\\rose.tpl',
      1 => 1598600813,
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
function content_60a60e6ccf33d1_43649382 (Smarty_Internal_Template $_smarty_tpl) {
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
	
		
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['UserTabella']->value, 'user');
$_smarty_tpl->tpl_vars['user']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->do_else = false;
?>
		<div class='col m6'>
			<div class='card'>
				<span class='card-title white-text' style='background-color: #3f51b5;height:60px;padding: 14px 0 0 10px;'>    
					<?php echo $_smarty_tpl->tpl_vars['user']->value['squadra'];?>

					<p class='creditirimasti right indigo darken-4'>
						<?php ob_start();
echo $_smarty_tpl->tpl_vars['user']->value['nick'];
$_prefixVariable1 = ob_get_clean();
echo $_smarty_tpl->tpl_vars['a']->value->crediti_rimasti($_prefixVariable1);?>
	
						<small>Crediti rimasti</small>
					</p>     
				</span>
				<div class='card-content'>
					<table class='sortable responsive-table highlight' style='width:100%' cellpadding='10' cellspacing='0' id='t1'>
						<thead>
							<tr>
								<th></th>
								<th>Calciatore</th>
								<th>Squadra</th>
								<th class='center'>Costo</th>
							</tr>
						</thead>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GiocatoriTabella']->value, 'giocatore');
$_smarty_tpl->tpl_vars['giocatore']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['giocatore']->value) {
$_smarty_tpl->tpl_vars['giocatore']->do_else = false;
?>
							<?php if ($_smarty_tpl->tpl_vars['giocatore']->value['proprietario'] == $_smarty_tpl->tpl_vars['user']->value['nick']) {?>
								<tr>
									<td class='center'><b class='ruolo <?php echo $_smarty_tpl->tpl_vars['giocatore']->value['backruolo'];?>
'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['ruolo'];?>
</b></td> 
									<td><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['nome'];?>
</td>
									<td><img class='iconasquadra' src='./immagini/m_<?php echo $_smarty_tpl->tpl_vars['giocatore']->value['squadra'];?>
.gif'><a href='tab_squadre.php?vedi_squadra=<?php echo $_smarty_tpl->tpl_vars['giocatore']->value['squadra'];?>
'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['squadra'];?>
</td>
									<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['costo'];?>
</td>
								</tr>
							<?php }?>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</table>
				</div>
				<div class='card-action'>
					<div class='row' style='margin: 0;'>
						<span class='left'>Presidente: <b><?php echo $_smarty_tpl->tpl_vars['user']->value['nick'];?>
</b></span>
						<span class='right'>Data iscrizione: <?php echo $_smarty_tpl->tpl_vars['user']->value['reg_data'];?>
</span>
					</div>
				</div>
			</div>
		</div>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		
	<?php echo '<script'; ?>
 type='text/javascript' src='./inc/js/ordina_tabella.js'><?php echo '</script'; ?>
> 		
<?php }?> 

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
