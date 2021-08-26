<?php
/* Smarty version 3.1.33, created on 2019-10-16 09:19:08
  from 'C:\Program Files (x86)\EasyPHP-Devserver-17\eds-www\test_fcbe\templates\registro_mercato.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5da6c46c23b228_48905852',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '8d1411ed906f66d04cebdc6ef6421edfc442adf4' => 
    array (
      0 => 'C:\\Program Files (x86)\\EasyPHP-Devserver-17\\eds-www\\test_fcbe\\templates\\registro_mercato.tpl',
      1 => 1571210343,
      2 => 'file',
    ),
    '7d9bcc829cad332109d9d5cc8615abe2f25ac25a' => 
    array (
      0 => 'C:\\Program Files (x86)\\EasyPHP-Devserver-17\\eds-www\\test_fcbe\\templates\\header.tpl',
      1 => 1570631003,
      2 => 'file',
    ),
    'd8622e0aea8e5df78a447c8ff6ad30f6e0f4f726' => 
    array (
      0 => 'C:\\Program Files (x86)\\EasyPHP-Devserver-17\\eds-www\\test_fcbe\\templates\\template.tpl',
      1 => 1570635144,
      2 => 'file',
    ),
    'a86df1a36bb23039ba1aa8688138f02ee82f6fd1' => 
    array (
      0 => 'C:\\Program Files (x86)\\EasyPHP-Devserver-17\\eds-www\\test_fcbe\\templates\\widget.tpl',
      1 => 1570630316,
      2 => 'file',
    ),
    '6bf3484a76d8f780ef94289144420da32896796c' => 
    array (
      0 => 'C:\\Program Files (x86)\\EasyPHP-Devserver-17\\eds-www\\test_fcbe\\templates\\footer.tpl',
      1 => 1571132550,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 120,
),true)) {
function content_5da6c46c23b228_48905852 (Smarty_Internal_Template $_smarty_tpl) {
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
		
				
		<form action='registro_mercato.php' method='post'>
		<div class='input-field col m4 right'>
		<select name='manager' onchange='this.form.submit()'>
		<option value='Tutti' selected>Tutti</option>"; 
		<option value='Test' >Test</option><option value='enzo' >enzo</option><option value='jarod13' >jarod13</option><option value='Testone' >Testone</option><option value='Test02' >Test02</option>
		</select>
		<label>Filtra per utente</label>
		</div>
		</div>
		</form>
		
				<option value='Test' >Test</option><option value='enzo' >enzo</option><option value='jarod13' >jarod13</option><option value='Testone' >Testone</option><option value='Test02' >Test02</option>
		Radio mercato: 21/01/2019 09:36 - Mercato iniziale: Test ha vincolato ARESTI Simone per 1 Fanta-Euro
<br/>Radio mercato: 21/01/2019 09:40 - Mercato iniziale: Test ha vincolato AUDERO Emil per 12 Fanta-Euro
<br/>Radio mercato: 21/01/2019 09:40 - Mercato iniziale: Test ha vincolato BARDI Francesco per 1 Fanta-Euro
<br/>Radio mercato: 21/01/2019 10:09 - Mercato iniziale: Test ha vincolato BELEC Vid per 1 Fanta-Euro
<br/>Radio mercato: 21/01/2019 10:09 - Mercato iniziale: Test ha vincolato BERISHA Etrit per 13 Fanta-Euro
<br/>Radio mercato: 21/01/2019 10:11 - Mercato iniziale: Test ha vincolato BERNI Tommaso per 1 Fanta-Euro
<br/>Radio mercato: 21/01/2019 10:15 - Fase iniziale: Test ha svincolato BERNI Tommaso al costo di acquisto.
<br/>Radio mercato: 21/01/2019 10:16 - Fase iniziale: Test ha svincolato BELEC Vid al costo di acquisto.
<br/>Radio mercato: 21/01/2019 10:16 - Fase iniziale: Test ha svincolato BARDI Francesco al costo di acquisto.
<br/>Radio mercato: 02/02/2019 10:07 - Mercato iniziale: Test ha vincolato ABATE Ignazio per 3 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:07 - Mercato iniziale: Test ha vincolato ALVES Bruno per 6 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:08 - Mercato iniziale: Test ha vincolato ANDERSEN Joachim per 6 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:08 - Mercato iniziale: Test ha vincolato ASAMOAH Kwadwo per 9 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:08 - Mercato iniziale: Test ha vincolato ANTONELLI Luca per 3 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:08 - Mercato iniziale: Test ha vincolato ALBIOL Raúl per 15 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:08 - Mercato iniziale: Test ha vincolato ALLAN Marques Loureiro per 19 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:08 - Mercato iniziale: Test ha vincolato BARAK Antonin per 19 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:08 - Mercato iniziale: Test ha vincolato BARRETO Edgar per 7 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:08 - Mercato iniziale: Test ha vincolato BEGHETTO Andrea per 5 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:08 - Mercato iniziale: Test ha vincolato BASELLI Daniele per 14 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:09 - Mercato iniziale: Test ha vincolato BENASSI Marco per 14 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:09 - Mercato iniziale: Test ha vincolato CALHANOGLU Hakan per 23 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:09 - Mercato iniziale: Test ha vincolato LINETTY Karol per 13 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:09 - Mercato iniziale: Test ha vincolato ANTENUCCI Mirco per 18 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:09 - Mercato iniziale: Test ha vincolato BABACAR Khouma El per 16 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:10 - Mercato iniziale: Test ha vincolato BELOTTI Andrea per 30 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:10 - Mercato iniziale: Test ha vincolato CAPUTO Francesco per 18 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:10 - Mercato iniziale: Test ha vincolato BERARDI Domenico per 17 Fanta-Euro
<br/>Radio mercato: 02/02/2019 10:10 - Mercato iniziale: Test ha vincolato CALLEJON Jose Maria per 26 Fanta-Euro<br/>
 

		</div></div></div></div></div></div></div></div></div></div>
		
		
<footer class="page-footer indigo" style="margin-top:-15px">
	<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col l6 s12">
                <h5 class="white-text">Fantacalcio Smash</h5>
                <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
			</div>
			<div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
					<li><a class="grey-text text-lighten-3" href="licenza.php">Licenza GNU/GPL</a></li>
					<li><a class="grey-text text-lighten-3" href="#!">fantacalciosmash.netsons.org</a></li>
					<li><a class="grey-text text-lighten-3" href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a></li>
					<li><a class="grey-text text-lighten-3" href="http://validator.w3.org/check?uri=referer">XHTML</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
            <p class="grey-text text-lighten-4 left">&copy; 2019 Simone Gentile <?php echo '<?php ';?>if ($vvm) echo "- Versione: $vvm"; <?php echo '?>';?></p>
            <p class="grey-text text-lighten-4 right">Pagina generata in [[[loadtime]]] secondi.</p>
		</div>
	</div></div>
</footer>


<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="inc/js/materialize.min.js"></script>

</body>
</html><?php }
}
