<?php
/* Smarty version 3.1.33, created on 2019-10-17 18:24:18
  from 'C:\Program Files (x86)\EasyPHP-Devserver-17\eds-www\test_fcbe\templates\suggteam.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5da895b25b7e74_80738652',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    'd06b5c584a3121eca12e0cf234e329047706996a' => 
    array (
      0 => 'C:\\Program Files (x86)\\EasyPHP-Devserver-17\\eds-www\\test_fcbe\\templates\\suggteam.tpl',
      1 => 1571329275,
      2 => 'file',
    ),
    '7d9bcc829cad332109d9d5cc8615abe2f25ac25a' => 
    array (
      0 => 'C:\\Program Files (x86)\\EasyPHP-Devserver-17\\eds-www\\test_fcbe\\templates\\header.tpl',
      1 => 1571298056,
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
function content_5da895b25b7e74_80738652 (Smarty_Internal_Template $_smarty_tpl) {
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
	<li><a href="tab_calciatori.php">Listone calciatori</a></li>
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
		<span class='card-title'>Forma squadra<span style='font-size: 13px;'> - Calciatori migliori nelle ultime 5 giornate</span></span>
		<hr>
		<div class='row'>
		<div class='col m12'>
	<div class='row'>
		<div class='col m12'><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=ATALANTA' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_atalanta.png' width='32' height='34' alt='Atalanta' title='Atalanta' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=BOLOGNA' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_bologna.png' width='32' height='34' alt='Bologna' title='Bologna' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=CAGLIARI' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_cagliari.png' width='32' height='34' alt='Cagliari' title='Cagliari' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=CHIEVO' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_chievo.png' width='32' height='34' alt='Chievo' title='Chievo' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=EMPOLI' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_empoli.png' width='32' height='34' alt='Empoli' title='Empoli' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=FIORENTINA' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_fiorentina.png' width='32' height='34' alt='Fiorentina' title='Fiorentina' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=FROSINONE' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_frosinone.png' width='32' height='34' alt='Frosinone' title='Frosinone' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=GENOA' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_genoa.png' width='32' height='34' alt='Genoa' title='Genoa' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=INTER' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_inter.png' width='32' height='34' alt='Inter' title='Inter' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=JUVENTUS' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_juventus.png' width='32' height='34' alt='Juventus' title='Juventus' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=LAZIO' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_lazio.png' width='32' height='34' alt='Lazio' title='Lazio' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=MILAN' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_milan.png' width='32' height='34' alt='Milan' title='Milan' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=NAPOLI' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_napoli.png' width='32' height='34' alt='Napoli' title='Napoli' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=PARMA' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_parma.png' width='32' height='34' alt='Parma' title='Parma' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=ROMA' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_roma.png' width='32' height='34' alt='Roma' title='Roma' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=SAMPDORIA' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_sampdoria.png' width='32' height='34' alt='Sampdoria' title='Sampdoria' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=SASSUOLO' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_sassuolo.png' width='32' height='34' alt='Sassuolo' title='Sassuolo' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=SPAL' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_spal.png' width='32' height='34' alt='Spal' title='Spal' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=TORINO' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_torino.png' width='32' height='34' alt='Torino' title='Torino' style='border: 0px; text-decoration:none' />
			</a>
			</div><div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=UDINESE' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_udinese.png' width='32' height='34' alt='Udinese' title='Udinese' style='border: 0px; text-decoration:none' />
			</a>
			</div></div></div>
	
			
	<div class='row'>
		<div class='col m12'>			
		
		<table width='100%' cellpadding='10' class='responsive-table highlight' >
			<thead>
			<tr>
			<th></td>
			<th>Nome</td>
			<th>Squadra</td>
			<th>Partite</td>
			<th>Media Voto</td>
			<th>Media FantaVoto</td>
			<th>Gol</td>
			<th>Assist</td>
			<th>Rigori</td>
			<th>Gialli</td>
			<th>Rossi</td>
			</tr>
			</thead>
			
						
			<tr>
			<td class='center'><b class='ruolo orange darken-4'>A</b></td>
			<td><a href='stat_calciatore.php?num_calciatore=$numero'>BERISHA Etrit</a></td>
			<td><img class='iconasquadra' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
			<td class='center'>5</td>
			<td class='center'>6.6</td>
			<td class='center'>5.2</td>
			<td class='center'>0</td>
			<td class='center'>0</td>
			<td class='center'>0</td>
			<td class='center'>0</td>
			<td class='center'>0</td>
			</tr>
		
					
		
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
		
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo '>A</span></td>
					<td>BERISHA Etrit </td>
					<td><img class='iconasquadra' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>5</td>
					<td class='center'>6.6</td>
					<td class='center'>5.2</td>
					<td class='center'></td>
					<td class='center'></td>
				</tr>
				
								
			</table>
		</div>
	</div>
		
	<script type='text/javascript' src='./inc/js/ordina_tabella.js'></script> 		
 

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
