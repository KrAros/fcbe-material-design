<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-20 09:22:25
  from 'C:\xampp\htdocs\test_fcbe\templates\statistiche_rosa.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60a60e318e8f22_45337757',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cc5600cac53dbcfb87ffcb1b2ad6f91bfad997e2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\test_fcbe\\templates\\statistiche_rosa.tpl',
      1 => 1571906644,
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
function content_60a60e318e8f22_45337757 (Smarty_Internal_Template $_smarty_tpl) {
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
		<div class='col m12'>			
			<table class='highlight' width='100%' cellpadding='0' cellspacing='0' align='center'>
				<tr>
					<thead>
						<th></th>
						<th>Nome</th>
						<th>Squadra</th>
						<th class='center'>Gare</th>
						<th class='center'>Medie</th>
						<th class='center'>Gol</th>
						<th class='center'>Assist</th>
						<th class='center'>Gialli</th>
						<th class='center'>Rossi</th>
						<th class='center'>Rigori</th>
						<th class='center'>Cos / Val</th>
						<th class='center'>Ultimi</th>
					</thead>
				</tr>
				
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GiocatoriTabella']->value, 'giocatore');
$_smarty_tpl->tpl_vars['giocatore']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['giocatore']->value) {
$_smarty_tpl->tpl_vars['giocatore']->do_else = false;
?>
				
				<tr class='$ruolo'>
					<td class='center'><b class='ruolo <?php echo $_smarty_tpl->tpl_vars['giocatore']->value['backruolo'];?>
'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['ruolo'];?>
</b></td> 
					<td><a href='stat_calciatore.php?num_calciatore=$num_calciatore'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['nome'];?>
</a> <?php echo $_smarty_tpl->tpl_vars['giocatore']->value['attivo'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['squadra'];?>
</td>
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['partite_giocate'];?>
</td>
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['media_punti'];?>
 (<?php echo $_smarty_tpl->tpl_vars['giocatore']->value['media_giornale'];?>
)</td>
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['gol'];?>
</td>
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['assist'];?>
</td>
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['ammonizioni'];?>
</td>
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['espulsioni'];?>
</td>
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['rigori'];?>
</td>
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['costo'];?>
 / <?php echo $_smarty_tpl->tpl_vars['giocatore']->value['valore_attuale'];?>
</td>
					<td class='center'><?php echo $_smarty_tpl->tpl_vars['giocatore']->value['ultimo_fantavoto'];?>
 (<?php echo $_smarty_tpl->tpl_vars['giocatore']->value['ultimo_voto'];?>
)</td>
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
