<?php
/* Smarty version 3.1.34-dev-7, created on 2021-08-26 11:43:17
  from 'C:\xampp\htdocs\fcbe-material-design\templates\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_61276235ee0fd7_64538395',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1d8b5132417b1789e108dc9b9abb65db7e73a5e3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\fcbe-material-design\\templates\\header.tpl',
      1 => 1571907198,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61276235ee0fd7_64538395 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\fcbe-material-design\\libs\\plugins\\modifier.capitalize.php','function'=>'smarty_modifier_capitalize',),));
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "test.conf", "configurazione_script", 0);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" dir="ltr">
<head>
<!--Import Google Icon Font-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!--Import materialize.css-->
<link type="text/css" rel="stylesheet" href="./css/materialize.min.css" media="screen,projection" />
<!--Let browser know website is optimized for mobile-->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link type="text/css" rel="stylesheet" href="./immagini/tab.css" media="screen,projection" />
<link type="text/css" rel="stylesheet" href="./css/extra.css" media="screen,projection" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Language" content="Italian" />
<meta name="Author" content="Antonello Onida - http://fantacalciobazar.sssr.it" />
<meta name="Description" content="FantacalcioBazar | Il migliore gestore di Fantacalcio on line" />
<meta name="Keywords" content="fantacalciobazar, fantacalcio, semplice, completo, online" />
<meta name="Robots" content="INDEX, FOLLOW" />
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.1.1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://code.highcharts.com/highcharts.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://code.highcharts.com/highcharts-more.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="./inc/js/jquery-2.0.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="./dati/update/update.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="./inc/js/extra.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'a_fm') == 'SI') {?>
<link rel='stylesheet' type='text/css' href='./inc/fm_style.css' />
<?php }?>
<title><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'titolo_sito');?>
</title>
<style type="text/css">
			body {
			color: <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'carattere_colore');?>
;
			font-family: <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'carattere_tipo');?>
;
			font-size: <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'carattere_size');?>

			}
		</style>
</head>

<body>
<div id="navbar" class="navbar-fixed">
<nav class="indigo">
<div class="nav-wrapper">
<a href="./index.php" class="brand-logo" style="padding-left: 15px;"><?php echo smarty_modifier_capitalize($_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'titolo_sito'));?>
</a>

<?php if ($_SESSION['valido'] == 'SI' && $_SESSION['utente'] == 'admin') {?>

<ul class="right hide-on-med-and-down">
<li><a href="a_gestione.php"><i class="material-icons left">dashboard</i>Dashboard amministrativa</a></li>
<li><a href="a_torneo.php"><i class="material-icons left">event_note</i>Gestione tornei</a></li>
<?php if ($_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'usa_cms') == 'SI') {?>
<li><a href="a_sito.php"><i class="material-icons left">view_module</i>CMS</a></li>
<?php }?>
	<li><a href="a_configura.php"><i class="material-icons left">build</i>Configurazione sito</a></li>
	<li><a class="dropdown-trigger" href="#!" data-target="dropdownad"><i class="material-icons left">list</i>Altre funzionalit&agrave;</a></li>
	<ul id="dropdownad" class="dropdown-content">
	<li><a href="./a_aggUtente.php">Aggiungi utenti</a></li>
	<li><a href="./a_appUtente.php">Approvazione utenti</a></li>
	<li><a href="./a_verifiche.php">Verifiche struttura</a></li>
	
	<li class="divider"></li>
	
	<li><a href="./a_upload.php">Carica voti</a></li>
	<li><a href="./a_invia_voti.php">Invia formazioni</a></li>
	<li><a href="./a_invia_risultati.php">Invia risultati</a></li>
	<li><a href="./messaggi.php">Gestione messaggi</a></li>
	
	<li class="divider"></li>
	
	<li><a href="./a_nlUtente.php">Newsletter utenti</a></li>
	<li><a href="./a_crea_sondaggio.php">Sondaggi e votazioni</a></li>
	<li><a href="./a_fm.php">File manager</a></li>
	<li><a href="./a_backup.php">Backup dati</a></li>
	<li><a href="./a_b2mail.php">Backup dati per email</a></li>
	</ul>
	<li><a href="logout.php"><i class="material-icons left">exit_to_app</i>Logout</a></li>
	</ul>

<?php } elseif ($_SESSION['valido'] == 'SI') {?>
	
	<ul class="right hide-on-med-and-down">
	<li><a href="mercato.php"><i class="material-icons left">dashboard</i>Dashboard</a></li>
	<li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i class="material-icons left">security</i>Gestione<i class="material-icons right">arrow_drop_down</i></a></li>
	
	<ul id="dropdown1" class="dropdown-content">
	<?php if ($_smarty_tpl->tpl_vars['chiusura_giornata']->value != 1) {?>
		<li><a href='./squadra.php'>Schiera formazione</a></li>
		<li><a href='./suggteam.php'>Team consigliato</a></li>
		<li><a href='./statistiche_rosa.php?vedi_squadra=<?php echo $_SESSION['utente'];?>
'>Statistiche rosa</a></li>
		<?php if ($_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'mercato_libero') == 'SI' && $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'stato_mercato') == 'A') {?>
		<li><a href='./cambi.php' >Cambi</a></li>
		<?php }?>
		<?php if ($_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'mercato_libero') == 'SI' && $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'stato_mercato') == 'A' && $_smarty_tpl->tpl_vars['trasferiti_ok']->value == 'SI') {?>
		<li><a href='./cambi_tra.php'>Cambia Trasferiti</a></li>
		<?php }?>
		<?php } elseif ($_smarty_tpl->tpl_vars['chiusura_giornata']->value == 1) {?>
		<li><a href='./squadra1.php'>Formazioni attuali</a></li>
	<?php }?>
			
		<li class="divider"></li>
	
		<?php if ($_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'tipo_calcolo') == 'S') {?>
		<li><a href='./calendario.php'>Calendario</a></li>
		<?php }?>
		
		<?php if ($_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'mercato_libero') == 'NO' && $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'tipo_calcolo') == 'S' && $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'stato_mercato') != 'I') {?>
		<li><a href='./classifica.php' >Classifica</a></li>
		<?php }?>
		<?php if ($_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'stato_mercato') != 'I' && $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'stato_mercato') != 'R' || $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'stato_mercato') != 'B') {?>
		<li><a href='./rose.php' >Riepilogo rose</a></li>
		<li><a href='./statistiche.php?numgio=tutte&squadra_guarda=ATALANTA&anno_guarda=cartella_remota'>Statistiche</a></li>
		<?php }?>
		<?php if ($_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'stato_mercato') == 'A' || $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'stato_mercato') == 'P' || $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'stato_mercato') == 'C' || $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'stato_mercato') == 'S') {?>
		<li><a href='./giornate.php'>Riepilogo giornate</a></li>
		<?php }?>
		<?php if ($_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'mercato_libero') == 'SI' || $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'stato_mercato') != 'I' && $_smarty_tpl->tpl_vars['ultgio']->value != 0) {?>
		<li><a href='./guarda_giornate.php' >Vedi tutti i voti</a></li>
		<?php }?>
	</ul>
	
	<li><a class="dropdown-trigger" href="#!" data-target="dropdown2"><i class="material-icons left">compare_arrows</i>Mercato<i class="material-icons right">arrow_drop_down</i></a></li>
		
		<ul id="dropdown2" class="dropdown-content">
		<li><a href="registro_mercato.php">Riepilogo acquisti</a></li>
	<li><a href="tab_calciatori.php">Listone calciatori</a></li>
	</ul>
	
	<li><a class="dropdown-trigger" href="#!" data-target="dropdown3"><i class="material-icons left">star</i>Link Utili<i class="material-icons right">arrow_drop_down</i></a></li>
	
	<ul id="dropdown3" class="dropdown-content">
	<li><a href="televideo.php">Televideo</a></li>
	<li><a href="temporeale.php">Risultati temporeale</a></li>
		<li><a href="probform.php">Probabili formazioni</a></li>
		<li><a href="indisponibili.php">Indisponibili</a></li>
	</ul>
	
	<li><a class="dropdown-trigger" href="#!" data-target="dropdown4"><i class="material-icons left">account_circle</i><?php echo $_SESSION['utente'];?>
<i class="material-icons right">arrow_drop_down</i></a></li>
	
	<ul id="dropdown4" class="dropdown-content">
	<li><a href="a_modUtente.php">Modifica profilo</a></li>
	<li><a href="messaggi.php">Messaggi</a></li>
	</ul>
	
	<li><a href="logout.php"><i class="material-icons left">exit_to_app</i>Logout</a></li>
	</ul>
	<?php }?>
	</div>
	</nav>
</div>										<?php }
}
