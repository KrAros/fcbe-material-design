<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-20 09:22:07
  from 'C:\xampp\htdocs\test_fcbe\templates\suggteam.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60a60e1f5ff902_64969089',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1b29241a38357322d3f4882d244faf303a81f75d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\test_fcbe\\templates\\suggteam.tpl',
      1 => 1571995952,
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
function content_60a60e1f5ff902_64969089 (Smarty_Internal_Template $_smarty_tpl) {
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

	<?php echo tabella_squadre();?>

	
		
	<div class='row'>
		<div class='col m6 center'>
			<form method='post' action='suggteam.php'>
				<input type='hidden' name='dif' value='<?php echo $_smarty_tpl->tpl_vars['dif']->value;?>
'>
				<input type='hidden' name='cen' value='<?php echo $_smarty_tpl->tpl_vars['cen']->value;?>
'>
				<input type='hidden' name='att' value='<?php echo $_smarty_tpl->tpl_vars['att']->value;?>
'>
				Seleziona l'intervallo tra le giornate per la generazione delle statistiche: 
				<select name='range' onChange='this.form.submit()' <?php echo count($_smarty_tpl->tpl_vars['numero_giornate']->value);?>
>
					<?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['numero_giornate']->value,'output'=>$_smarty_tpl->tpl_vars['numero_giornate']->value,'selected'=>$_smarty_tpl->tpl_vars['range']->value),$_smarty_tpl);?>

				</select>
			</form>
		</div>
		
		<div class='col m6 center'>Cambia il modulo:</b><br><br>
			<a href='./suggteam.php?dif=3&amp;cen=5&amp;att=2&amp;range=<?php echo $_smarty_tpl->tpl_vars['range']->value;?>
'><b>3 - 5 - 2</b></a> /
			<a href='./suggteam.php?dif=3&amp;cen=4&amp;att=3&amp;range=<?php echo $_smarty_tpl->tpl_vars['range']->value;?>
'><b>3 - 4 - 3</b></a> /
			<a href='./suggteam.php?dif=4&amp;cen=3&amp;att=3&amp;range=<?php echo $_smarty_tpl->tpl_vars['range']->value;?>
'><b>4 - 3 - 3</b></a> /
			<a href='./suggteam.php?dif=4&amp;cen=4&amp;att=2&amp;range=<?php echo $_smarty_tpl->tpl_vars['range']->value;?>
'><b>4 - 4 - 2</b></a> /
			<a href='./suggteam.php?dif=4&amp;cen=5&amp;att=1&amp;range=<?php echo $_smarty_tpl->tpl_vars['range']->value;?>
'><b>4 - 5 - 1</b></a> /
			<a href='./suggteam.php?dif=5&amp;cen=4&amp;att=1&amp;range=<?php echo $_smarty_tpl->tpl_vars['range']->value;?>
'><b>5 - 4 - 1</b></a>
		</div>
	</div>
	
			
	<div class='row'>
		<div class='col m12'>			
			<table width='100%' cellpadding='10' class='responsive-table highlight' >
				<tr>
					<thead>
						<th></th>
						<th>Nome</th>
						<th>Squadra</th>
						<th>Partite</th>
						<th>Media Voto</th>
						<th>Media FantaVoto</th>
						<th>Gol</th>
						<th>Assist</th>
						<th>Rigori</th>
						<th>Gialli</th>
						<th>Rossi</th>
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
					<td class='center'><b class='ruolo <?php echo $_smarty_tpl->tpl_vars['giocatore']->value['backruolo'];?>
'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['ruolo'];?>
</b></td> 
					<td><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['nome'];?>
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
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['gol'];?>
</td>
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['assist'];?>
</td>
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['rigori'];?>
</td>
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['ammonizioni'];?>
</td>
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['espulsioni'];?>
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

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
