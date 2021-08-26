<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-20 09:28:46
  from 'C:\xampp\htdocs\test_fcbe\templates\calendario.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60a60fae3e6de2_47825020',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '09b10fa317357fd0a4c249ecc7010b2dd920b0e3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\test_fcbe\\templates\\calendario.tpl',
      1 => 1598606461,
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
function content_60a60fae3e6de2_47825020 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '38122334460a60fae296c08_34097139';
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
		<div class='col m12 center'>
		
			<?php echo $_smarty_tpl->tpl_vars['vedi_giornate']->value;?>

			
			<table class='highlight' width='100%' cellpadding='0' cellspacing='0' align='center'>
				
				<?php
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['foo']->step = 1;$_smarty_tpl->tpl_vars['foo']->total = (int) ceil(($_smarty_tpl->tpl_vars['foo']->step > 0 ? 38+1 - (1) : 1-(38)+1)/abs($_smarty_tpl->tpl_vars['foo']->step));
if ($_smarty_tpl->tpl_vars['foo']->total > 0) {
for ($_smarty_tpl->tpl_vars['foo']->value = 1, $_smarty_tpl->tpl_vars['foo']->iteration = 1;$_smarty_tpl->tpl_vars['foo']->iteration <= $_smarty_tpl->tpl_vars['foo']->total;$_smarty_tpl->tpl_vars['foo']->value += $_smarty_tpl->tpl_vars['foo']->step, $_smarty_tpl->tpl_vars['foo']->iteration++) {
$_smarty_tpl->tpl_vars['foo']->first = $_smarty_tpl->tpl_vars['foo']->iteration === 1;$_smarty_tpl->tpl_vars['foo']->last = $_smarty_tpl->tpl_vars['foo']->iteration === $_smarty_tpl->tpl_vars['foo']->total;?>
					<table class='center' width='100%' border='1' cellpadding='5' cellspacing='0'>
						<tr>
							<td class='testa' colspan='2'>Giornata <?php echo $_smarty_tpl->tpl_vars['numero_giornata']->value;?>
</td>
						</tr>
						
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GiocatoriTabella']->value, 'giocatore');
$_smarty_tpl->tpl_vars['giocatore']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['giocatore']->value) {
$_smarty_tpl->tpl_vars['giocatore']->do_else = false;
?>
						
						<tr>
							<td class='center'>
								<a href='giornate.php?opzione=2&amp;nome_squadra=<?php echo $_smarty_tpl->tpl_vars['giocatore']->value['squadra1'];?>
' class='user'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['squadra1'];?>
</a> 
								- 
								<a href='giornate.php?opzione=2&amp;nome_squadra=<?php echo $_smarty_tpl->tpl_vars['giocatore']->value['squadra2'];?>
' class='user'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['squadra2'];?>
</a>
							</td>
							<td align='center' width='15%'>
								<?php echo $_smarty_tpl->tpl_vars['giocatore']->value['gol_casa'];?>
 - <?php echo $_smarty_tpl->tpl_vars['giocatore']->value['gol_fuori'];?>

							</td>
						</tr>
						
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						
					</table>
				<?php }
}
?>
				
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
