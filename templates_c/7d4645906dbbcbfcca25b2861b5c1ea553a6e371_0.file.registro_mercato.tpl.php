<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-20 09:26:44
  from 'C:\xampp\htdocs\test_fcbe\templates\registro_mercato.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60a60f34e786b4_44998497',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d4645906dbbcbfcca25b2861b5c1ea553a6e371' => 
    array (
      0 => 'C:\\xampp\\htdocs\\test_fcbe\\templates\\registro_mercato.tpl',
      1 => 1571216965,
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
function content_60a60f34e786b4_44998497 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\test_fcbe\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
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
		<form action='registro_mercato.php' method='post'>
			<div class='input-field col m4 right'>
				<select name='manager' onchange='this.form.submit()' size='<?php echo count($_smarty_tpl->tpl_vars['managers']->value);?>
'>
					<option value='Tutti' <?php echo $_smarty_tpl->tpl_vars['managerseltutti']->value;?>
>Tutti</option>"; 
					<?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['managers']->value,'output'=>$_smarty_tpl->tpl_vars['managers']->value,'selected'=>$_smarty_tpl->tpl_vars['managerselec']->value),$_smarty_tpl);?>

				</select>
				<label>Filtra per utente</label>
			</div>
		</form>
	</div>
	
		
	<div class='row'>
		<div class='col m12'>
			<?php echo $_smarty_tpl->tpl_vars['messmerc']->value;?>

		</div>
	</div>
<?php }?> 

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
