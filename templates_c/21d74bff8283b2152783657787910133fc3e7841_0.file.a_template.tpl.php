<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-20 10:43:00
  from 'C:\xampp\htdocs\test_fcbe\templates\a_template.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60a62114edea87_03849795',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '21d74bff8283b2152783657787910133fc3e7841' => 
    array (
      0 => 'C:\\xampp\\htdocs\\test_fcbe\\templates\\a_template.tpl',
      1 => 1598948144,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:a_widget.tpl' => 1,
  ),
),false)) {
function content_60a62114edea87_03849795 (Smarty_Internal_Template $_smarty_tpl) {
?>		
<div class="container" style="width: 85%;margin-top: -10px;">
	<div class="card-panel">
		<div class="row">
		
				
		<?php $_smarty_tpl->_subTemplateRender("file:a_widget.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		
				
		<div class='col m9'>
		
					
			<div class='row'>
				<div class='col m12'>
					<ol class='breadcrumbs indigo'>
						<li class='breadcrumbs-item'><a class='white-text' href='./mercato.php'>Dashboard</a></li>
						<li class='breadcrumbs-item grey-text text-lighten-1'>Listone calciatori</li>
					</ol>
				</div>
			</div>
		
				
		
			<div class='row'>
				<div class='col m12'>
					<div class='card'>
						<div class='card-content'>
							<span class='card-title'><?php echo $_smarty_tpl->tpl_vars['TitoloPagina']->value;?>
<span style='font-size: 13px;'> - <?php echo $_smarty_tpl->tpl_vars['Sottotitolo']->value;?>
</span></span>
							<hr>
								<div class='row'>
									<div class='col m12'><?php }
}
