<?php
/* Smarty version 3.1.33, created on 2019-10-09 16:46:31
  from 'C:\xampp\htdocs\test_fcbe\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d9df2c713bf72_06667604',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6853fb33b4536ab23886f0619a9a58b2d625d857' => 
    array (
      0 => 'C:\\xampp\\htdocs\\test_fcbe\\templates\\index.tpl',
      1 => 1570632388,
      2 => 'file',
    ),
    'c55bf49e2db3dd0538b71668c2b823eb43a313e4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\test_fcbe\\templates\\header.tpl',
      1 => 1570631003,
      2 => 'file',
    ),
    '110108935eae90a94b4f3d9d0e8e3bf0114b1228' => 
    array (
      0 => 'C:\\xampp\\htdocs\\test_fcbe\\templates\\template.tpl',
      1 => 1570630423,
      2 => 'file',
    ),
    'c6cd1c6792b2a3b4c5f78666db7fae6f64538d1e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\test_fcbe\\templates\\widget.tpl',
      1 => 1570630316,
      2 => 'file',
    ),
    '0d459b5f4581f04377576dafaf234d1e40fcf079' => 
    array (
      0 => 'C:\\xampp\\htdocs\\test_fcbe\\templates\\footer.tpl',
      1 => 1570629718,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 120,
),true)) {
function content_5d9df2c713bf72_06667604 (Smarty_Internal_Template $_smarty_tpl) {
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
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="./inc/js/jquery-2.0.3.min.js"></script>
<script src="./dati/update/update.js" type="text/javascript"></script>
<script src="./inc/js/extra.js" type="text/javascript"></script>
<title>FCBE Revolution</title>
<style type="text/css">
			body {
			color: #060644;
			font-family: Roboto Condensed;
			font-size: 13px
			}
		</style>
</head>

<body>
<div id="navbar" class="navbar-fixed">
<nav class="indigo">
<div class="nav-wrapper">
<a href="./index.php" class="brand-logo" style="padding-left: 15px;">FCBE Revolution</a>

	
	<ul class="right hide-on-med-and-down">
	<li><a href="mercato.php"><i class="material-icons left">dashboard</i>Dashboard</a></li>
	<li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i class="material-icons left">security</i>Gestione<i class="material-icons right">arrow_drop_down</i></a></li>
	
	<ul id="dropdown1" class="dropdown-content">
			<li><a href='./squadra.php'>Schiera formazione</a></li>
		<li><a href='./suggteam.php'>Team consigliato</a></li>
		<li><a href='./statistiche_rosa.php?vedi_squadra'>Statistiche rosa</a></li>
									
		<li class="divider"></li>
	
				<li><a href='./calendario.php'>Calendario</a></li>
				
						<li><a href='./rose.php' >Riepilogo rose</a></li>
		<li><a href='./statistiche.php?numgio=tutte&squadra_guarda=ATALANTA&anno_guarda=cartella_remota'>Statistiche</a></li>
						<li><a href='./giornate.php'>Riepilogo giornate</a></li>
						<li><a href='./guarda_giornate.php' >Vedi tutti i voti</a></li>
			</ul>
	
	<li><a class="dropdown-trigger" href="#!" data-target="dropdown2"><i class="material-icons left">compare_arrows</i>Mercato<i class="material-icons right">arrow_drop_down</i></a></li>
		
		<ul id="dropdown2" class="dropdown-content">
		<li><a href="registro_mercato.php">Riepilogo acquisti</a></li>
	<li><a href="tab_calciatori.php?ruolo_guarda=tutti">Listone calciatori</a></li>
	</ul>
	
	<li><a class="dropdown-trigger" href="#!" data-target="dropdown3"><i class="material-icons left">star</i>Link Utili<i class="material-icons right">arrow_drop_down</i></a></li>
	
	<ul id="dropdown3" class="dropdown-content">
	<li><a href="televideo.php">Televideo</a></li>
	<li><a href="temporeale.php">Risultati temporeale</a></li>
		<li><a href="probform.php">Probabili formazioni</a></li>
		<li><a href="indisponibili.php">Indisponibili</a></li>
	</ul>
	
	<li><a class="dropdown-trigger" href="#!" data-target="dropdown4"><i class="material-icons left">account_circle</i>Test<i class="material-icons right">arrow_drop_down</i></a></li>
	
	<ul id="dropdown4" class="dropdown-content">
	<li><a href="a_modUtente.php">Modifica profilo</a></li>
	<li><a href="messaggi.php">Messaggi</a></li>
	</ul>
	
	<li><a href="logout.php"><i class="material-icons left">exit_to_app</i>Logout</a></li>
	</ul>
		</div>
	</nav>
</div>										    				
		<div class="container" style="width: 85%;margin-top: -10px;">
		<div class="card-panel">
		<div class="row">
		
				
			<div class='col m3'>
	<div id='wrapper'>
	<div class='row'>
	<div class='col m12'>
	<div class='card indigo'>
	<div class='card-content white-text'>
	La giornata &egrave; chiusa.<br>
	Non &egrave; possibile inviare la formazione.<br>
	Attendere il calcolo di giornata per poterla modificare.
	</div>
	<div class='card-action'>
	<a>
	Consegna formazioni <i class='material-icons right'>alarm</i>
	</a>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>		
				
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
		<span class='card-title'>Registro mercato<span style='font-size: 13px;'> - Controlla tutti i movimenti di mercato di ogni squadra</span></span>
		<hr>
		<div class='row'>
		<div class='col m12'>
		<div class='row'>
<div class='card'>
		<form action='registro_mercato.php' method='post'>
		<div class='input-field col m4 right'>
		<select name='manager' onchange='this.form.submit()'>";
		
		<option value='Tutti' >Tutti</option>
		<option value='Test' >Test</option><option value='enzo' >enzo</option><option value='jarod13' >jarod13</option><option value='Testone' >Testone</option><option value='Test02' >Test02</option>
		</select>
		<label>Filtra per utente</label>
		</form>
		</div>
		</div>
		
		
		
		if (isset($_POST['manager']) AND $_POST['manager'] != "Tutti"){
			echo "$messmerc_manager";
		}
		else {
			echo "$messmerc";
		}
		echo "</div>
		</div>
		</div>
		</div>";

 

		</div>
        </div>
        </div>
		
				
		</div></div></div></div></div></div></div>

<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="./inc/js/materialize.min.js"></script>
</BODY>
</HTML>
<?php }
}
