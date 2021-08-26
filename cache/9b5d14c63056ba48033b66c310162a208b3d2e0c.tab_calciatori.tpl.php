<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-19 13:06:39
  from 'C:\Program Files (x86)\EasyPHP-Devserver-17\eds-www\test_fcbe\templates\tab_calciatori.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60a4f13fb453d7_45926485',
  'has_nocache_code' => true,
  'file_dependency' => 
  array (
    '0a957e5ae038a428b816f50a0018e8ac8a03a338' => 
    array (
      0 => 'C:\\Program Files (x86)\\EasyPHP-Devserver-17\\eds-www\\test_fcbe\\templates\\tab_calciatori.tpl',
      1 => 1621412431,
      2 => 'file',
    ),
    '7d9bcc829cad332109d9d5cc8615abe2f25ac25a' => 
    array (
      0 => 'C:\\Program Files (x86)\\EasyPHP-Devserver-17\\eds-www\\test_fcbe\\templates\\header.tpl',
      1 => 1571907198,
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
function content_60a4f13fb453d7_45926485 (Smarty_Internal_Template $_smarty_tpl) {
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
		<li><a href='./statistiche_rosa.php?vedi_squadra=Test02'>Statistiche rosa</a></li>
									
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
	
	<li><a class="dropdown-trigger" href="#!" data-target="dropdown4"><i class="material-icons left">account_circle</i>Test02<i class="material-icons right">arrow_drop_down</i></a></li>
	
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
		<span class='card-title'>Listone calciatori<span style='font-size: 13px;'> - Dati aggiornati all'ultima giornata <b>20</b></span></span>
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
		<div class='col m6 center'>
			<label>Filtra per ruolo:</label>
			<div class='switch' style='padding-top: 10px;'>
				<label>
					<input id='switch_portieri' type='checkbox' checked>
					<span class='lever portieri'></span>
				</label>
				<label>
					<input id='switch_difensori' type='checkbox' checked>
					<span class='lever difensori'></span>
				</label>
				<label>
					<input id='switch_centrocampisti' type='checkbox' checked>
					<span class='lever centrocampisti'></span>
				</label>
				<label>
					<input id='switch_attaccanti' type='checkbox' checked>
					<span class='lever attaccanti'></span>
				</label>
			</div>
		</div>
		<div class='col m6 center'>
			<label>Cerca giocatore:</label>
			<div class='input-field' style='margin: 0;'>
				<input type='text' id='search'></input>
			</div>
		</div>
	</div>
	
			
	<div class='row'>
		<div class='col m12'>			
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
		
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=100' class='user'>ARESTI Simone</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=101' class='user'>AUDERO Emil</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>20</td>
					<td class='center'>4.85</td>
					<td class='center'>6.15</td>
					<td class='center'>15</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=102' class='user'>BARDI Francesco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=103' class='user'>BELEC Vid</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=104' class='user'>BERISHA Etrit</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>13</td>
					<td class='center'>5.04</td>
					<td class='center'>6.27</td>
					<td class='center'>16</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=105' class='user'>BERNI Tommaso</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=106' class='user'>CONSIGLI Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>20</td>
					<td class='center'>4.6</td>
					<td class='center'>6.25</td>
					<td class='center'>14</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=107' class='user'>CONTINI Nikita</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=108' class='user'>CRAGNO Alessio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>20</td>
					<td class='center'>5.4</td>
					<td class='center'>6.45</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=109' class='user'>DA COSTA Angelo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=110' class='user'>DAGA Riccardo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=111' class='user'>DINI Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=112' class='user'>DONNARUMMA Gianluigi</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>20</td>
					<td class='center'>5.28</td>
					<td class='center'>6.28</td>
					<td class='center'>20</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=113' class='user'>DONNARUMMA Antonio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=114' class='user'>DRAGOWSKI Bartlomiej</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>3</td>
					<td class='center'>5.5</td>
					<td class='center'>3.83</td>
					<td class='center'>3</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=115' class='user'>FALCONE Wladimiro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=116' class='user'>FRATTALI Pierluigi</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=117' class='user'>FUZATO Daniel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=118' class='user'>GASPARINI Manuel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=119' class='user'>GIACOMEL Alessandro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=120' class='user'>GOLLINI Pierluigi</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>7</td>
					<td class='center'>4.21</td>
					<td class='center'>5.79</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=121' class='user'>GOMIS Alfred</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>18</td>
					<td class='center'>4.78</td>
					<td class='center'>6.06</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=122' class='user'>GUERRIERI Guido</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=123' class='user'>HANDANOVIC Samir</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>20</td>
					<td class='center'>5.63</td>
					<td class='center'>6.33</td>
					<td class='center'>23</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=124' class='user'>ICHAZO Salvador</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>3</td>
					<td class='center'>5.5</td>
					<td class='center'>6.17</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=125' class='user'>KARNEZIS Orestis</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>6</td>
					<td class='center'>5.83</td>
					<td class='center'>6.17</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=126' class='user'>LAFONT Alban</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>19</td>
					<td class='center'>4.92</td>
					<td class='center'>6</td>
					<td class='center'>16</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=127' class='user'>MARCHETTI Federico</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>5</td>
					<td class='center'>3.7</td>
					<td class='center'>4.6</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=128' class='user'>MERET Alex</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>5</td>
					<td class='center'>5.5</td>
					<td class='center'>6.3</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=129' class='user'>MILINKOVIC Vanja</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>2</td>
					<td class='center'>3.25</td>
					<td class='center'>5.75</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=130' class='user'>MIRANTE Antonio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>1</td>
					<td class='center'>5</td>
					<td class='center'>6</td>
					<td class='center'>2</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=131' class='user'>MUSSO Juan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>11</td>
					<td class='center'>4.95</td>
					<td class='center'>6.14</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=132' class='user'>PADELLI Daniele</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=133' class='user'>PAVONI Filippo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=134' class='user'>PEGOLO Gianluca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=135' class='user'>PERIN Mattia</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>5</td>
					<td class='center'>5.5</td>
					<td class='center'>5.8</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=136' class='user'>PINSOGLIO Carlo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=137' class='user'>PLIZZARI Alessandro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=138' class='user'>POLUZZI Giacomo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=139' class='user'>PROTO Silvio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=140' class='user'>PROVEDEL Ivan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>12</td>
					<td class='center'>3.46</td>
					<td class='center'>5.88</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=141' class='user'>RADU Ionut</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>16</td>
					<td class='center'>4.69</td>
					<td class='center'>6.06</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=142' class='user'>RADUNOVIC Boris</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=143' class='user'>RAFAEL De Andrade Bittencourt</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=144' class='user'>REINA Pepe</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=145' class='user'>ROSATI Antonio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=146' class='user'>ROSSI Francesco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=147' class='user'>SANTURRO Antonio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=148' class='user'>SATALINO Giacomo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=149' class='user'>SCUFFET Simone</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>9</td>
					<td class='center'>4.61</td>
					<td class='center'>6.06</td>
					<td class='center'>6</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=150' class='user'>SECULIN Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>2</td>
					<td class='center'>2.25</td>
					<td class='center'>2.75</td>
					<td class='center'>2</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=151' class='user'>SEPE Luigi</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>20</td>
					<td class='center'>5.03</td>
					<td class='center'>6.25</td>
					<td class='center'>17</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=152' class='user'>SIRIGU Salvatore</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>18</td>
					<td class='center'>5.33</td>
					<td class='center'>6.31</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=153' class='user'>SKORUPSKI Lukasz</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>20</td>
					<td class='center'>4.55</td>
					<td class='center'>6.08</td>
					<td class='center'>14</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=154' class='user'>SORRENTINO Stefano</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>19</td>
					<td class='center'>5.08</td>
					<td class='center'>6.55</td>
					<td class='center'>18</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=155' class='user'>SPORTIELLO Marco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>20</td>
					<td class='center'>4.03</td>
					<td class='center'>6.2</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=156' class='user'>STRAKOSHA Thomas</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>20</td>
					<td class='center'>4.83</td>
					<td class='center'>6.03</td>
					<td class='center'>16</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=157' class='user'>SZCZESNY Wojciech</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>15</td>
					<td class='center'>5.7</td>
					<td class='center'>6.17</td>
					<td class='center'>23</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=158' class='user'>TERRACCIANO Pietro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>8</td>
					<td class='center'>5.06</td>
					<td class='center'>6.31</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=159' class='user'>TOZZO Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=160' class='user'>VIGORITO Mauro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=161' class='user'>VODISEK Rok</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=162' class='user'>ZACCAGNO Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=163' class='user'>RAFAEL Cabral</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=164' class='user'>OLSEN Robin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>19</td>
					<td class='center'>4.76</td>
					<td class='center'>6.13</td>
					<td class='center'>17</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=165' class='user'>FULIGNATI Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=166' class='user'>NICOLAS Andrade</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=167' class='user'>IACOBUCCI Alessandro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=168' class='user'>SEMPER Adrian</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=169' class='user'>BAGHERIA Fabrizio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=170' class='user'>OSPINA David</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>9</td>
					<td class='center'>4.72</td>
					<td class='center'>6.06</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=171' class='user'>GHIDOTTI Simone</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=172' class='user'>JANDREI Chitolina Carniel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='P'>
					<td class='center' style='padding: 15px;'><span class='ruolo orange darken-4'>P</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=173' class='user'>VIVIANO Emiliano</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>1</td>
					<td class='center'>5.5</td>
					<td class='center'>6.5</td>
					<td class='center'>3</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=200' class='user'>ABATE Ignazio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>12</td>
					<td class='center'>6.04</td>
					<td class='center'>5.58</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=201' class='user'>ACERBI Francesco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>20</td>
					<td class='center'>6.65</td>
					<td class='center'>6.08</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=202' class='user'>ADJAPONG Claud</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>3</td>
					<td class='center'>7</td>
					<td class='center'>5.67</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=203' class='user'>ADNAN Ali Kadhim</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>3</td>
					<td class='center'>5.67</td>
					<td class='center'>5.67</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=204' class='user'>ALBIOL Ra&Atilde;&ordm;l</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>15</td>
					<td class='center'>5.93</td>
					<td class='center'>5.73</td>
					<td class='center'>14</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=205' class='user'>ALEX SANDRO Lobo Silva</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>17</td>
					<td class='center'>6.24</td>
					<td class='center'>6.21</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=206' class='user'>ALVES Bruno</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>19</td>
					<td class='center'>6.45</td>
					<td class='center'>6.11</td>
					<td class='center'>13</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=207' class='user'>ANDERSEN Joachim</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>19</td>
					<td class='center'>5.92</td>
					<td class='center'>5.74</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=208' class='user'>ANDREOLLI Marco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>2</td>
					<td class='center'>5</td>
					<td class='center'>5.25</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=209' class='user'>ANGELLA Gabriele</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=210' class='user'>ANSALDI Cristian</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>8</td>
					<td class='center'>7.5</td>
					<td class='center'>6.44</td>
					<td class='center'>13</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=211' class='user'>ANTONELLI Luca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>9</td>
					<td class='center'>6.06</td>
					<td class='center'>6</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=212' class='user'>ARIAUDO Lorenzo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>11</td>
					<td class='center'>5.55</td>
					<td class='center'>5.77</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=213' class='user'>ASAMOAH Kwadwo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>17</td>
					<td class='center'>5.68</td>
					<td class='center'>5.82</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=214' class='user'>BANI Mattia</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>17</td>
					<td class='center'>5.41</td>
					<td class='center'>5.68</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=215' class='user'>BARZAGLI Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>6</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=216' class='user'>BASTA Dusan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=217' class='user'>BASTONI Alessandro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>11</td>
					<td class='center'>6.14</td>
					<td class='center'>6.18</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=218' class='user'>BASTOS Jacinto Quissanga</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>5</td>
					<td class='center'>5.2</td>
					<td class='center'>5.4</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=219' class='user'>BENATIA Medhi</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>5</td>
					<td class='center'>5.7</td>
					<td class='center'>5.9</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=220' class='user'>BERESZYNSKI Bartosz</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>15</td>
					<td class='center'>5.63</td>
					<td class='center'>5.77</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=221' class='user'>BETTELLA Davide</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=222' class='user'>BIANDA William</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>2</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=223' class='user'>BIRAGHI Cristiano</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>20</td>
					<td class='center'>6.1</td>
					<td class='center'>5.6</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=224' class='user'>BIRASCHI Davide</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>20</td>
					<td class='center'>5.8</td>
					<td class='center'>5.65</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=225' class='user'>BONIFAZI Kevin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>10</td>
					<td class='center'>6.2</td>
					<td class='center'>5.8</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=226' class='user'>BONUCCI Leonardo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>16</td>
					<td class='center'>6.34</td>
					<td class='center'>6.09</td>
					<td class='center'>16</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=227' class='user'>BREMER Gleison Silva Nascimento</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=228' class='user'>BRIGHENTI Nicol&Atilde;&sup2;</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>4</td>
					<td class='center'>4.63</td>
					<td class='center'>4.88</td>
					<td class='center'>3</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=229' class='user'>BRIGNANI Fabrizio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=230' class='user'>CACCIATORE Fabrizio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>7</td>
					<td class='center'>5.64</td>
					<td class='center'>5.71</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=231' class='user'>CACERES Mart&Atilde;&shy;n</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>4</td>
					<td class='center'>5.75</td>
					<td class='center'>5.75</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=232' class='user'>CALABRESI Arturo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>14</td>
					<td class='center'>5.82</td>
					<td class='center'>5.71</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=233' class='user'>CALABRIA Davide</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>15</td>
					<td class='center'>6.07</td>
					<td class='center'>5.5</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=234' class='user'>CALDARA Mattia</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=235' class='user'>CANCELO Joao</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>12</td>
					<td class='center'>6.63</td>
					<td class='center'>6.54</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=236' class='user'>CAPUANO Marco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>13</td>
					<td class='center'>5.35</td>
					<td class='center'>5.42</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=237' class='user'>CASTAGNE Timothy</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>10</td>
					<td class='center'>6.55</td>
					<td class='center'>6.15</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=238' class='user'>CECCHERINI Federico</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>5</td>
					<td class='center'>6</td>
					<td class='center'>4.8</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=239' class='user'>CEPPITELLI Luca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>10</td>
					<td class='center'>5.6</td>
					<td class='center'>5.9</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=240' class='user'>CESAR Bostjan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>3</td>
					<td class='center'>5.33</td>
					<td class='center'>5.5</td>
					<td class='center'>3</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=241' class='user'>CHIELLINI Giorgio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>14</td>
					<td class='center'>7</td>
					<td class='center'>6.64</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=242' class='user'>CHIRICHES Vlad</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=243' class='user'>CIOFANI Matteo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>5</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=244' class='user'>CIONEK Thiago</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>17</td>
					<td class='center'>5.41</td>
					<td class='center'>5.62</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=245' class='user'>COLLEY Omar</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>8</td>
					<td class='center'>5.94</td>
					<td class='center'>5.19</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=246' class='user'>CONTI Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>3</td>
					<td class='center'>6.33</td>
					<td class='center'>4</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=247' class='user'>COSTA Filippo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>5</td>
					<td class='center'>6</td>
					<td class='center'>6</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=248' class='user'>CREMONESI Michele</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=249' class='user'>CRISCITO Domenico</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>18</td>
					<td class='center'>5.86</td>
					<td class='center'>5.61</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=250' class='user'>D'AMBROSIO Danilo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>14</td>
					<td class='center'>6.07</td>
					<td class='center'>5.68</td>
					<td class='center'>13</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=251' class='user'>DALBERT Henrique</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>5</td>
					<td class='center'>5.6</td>
					<td class='center'>5.5</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=252' class='user'>DANILO Larangeira</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>18</td>
					<td class='center'>5.78</td>
					<td class='center'>5.58</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=253' class='user'>DE MAIO Sebastian</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>6</td>
					<td class='center'>5.17</td>
					<td class='center'>5.42</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=254' class='user'>DE SCIGLIO Mattia</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>10</td>
					<td class='center'>6.25</td>
					<td class='center'>6.2</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=255' class='user'>DE SILVESTRI Lorenzo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>16</td>
					<td class='center'>6.53</td>
					<td class='center'>6.22</td>
					<td class='center'>18</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=256' class='user'>DE VRIJ Stefan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>15</td>
					<td class='center'>6.47</td>
					<td class='center'>6.2</td>
					<td class='center'>20</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=257' class='user'>DELL'ORCO Christian</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>2</td>
					<td class='center'>6.25</td>
					<td class='center'>5.75</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=258' class='user'>DI CESARE Valerio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>5</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=259' class='user'>DI LORENZO Giovanni</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>19</td>
					<td class='center'>6.11</td>
					<td class='center'>5.95</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=260' class='user'>DICKMANN Lorenzo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>1</td>
					<td class='center'>5</td>
					<td class='center'>5</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=261' class='user'>DIJKS Mitchell</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>10</td>
					<td class='center'>5.55</td>
					<td class='center'>5.65</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=262' class='user'>DIKS Kevin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=263' class='user'>DIMARCO Federico</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>3</td>
					<td class='center'>7.83</td>
					<td class='center'>6.5</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=264' class='user'>DURMISI Riza</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>6.5</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=265' class='user'>EL YAMIQ Jawad</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=266' class='user'>FARAG&Atilde; Paolo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>13</td>
					<td class='center'>5.85</td>
					<td class='center'>5.88</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=267' class='user'>FAZIO Federico</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>17</td>
					<td class='center'>6.44</td>
					<td class='center'>5.76</td>
					<td class='center'>17</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=268' class='user'>FELIPE Dal Belo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>18</td>
					<td class='center'>5.61</td>
					<td class='center'>5.78</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=269' class='user'>FERRARI Gianmarco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>18</td>
					<td class='center'>6.64</td>
					<td class='center'>6.03</td>
					<td class='center'>15</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=270' class='user'>FERRARI Alex</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>2</td>
					<td class='center'>5.75</td>
					<td class='center'>3</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=271' class='user'>FLORENZI Alessandro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>16</td>
					<td class='center'>6.56</td>
					<td class='center'>6.03</td>
					<td class='center'>18</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=272' class='user'>GAGLIOLO Riccardo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>20</td>
					<td class='center'>5.73</td>
					<td class='center'>5.88</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=273' class='user'>GAZZOLA Marcello</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>4</td>
					<td class='center'>6.13</td>
					<td class='center'>6.13</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=274' class='user'>GHIGLIONE Paolo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>6</td>
					<td class='center'>5.42</td>
					<td class='center'>5.67</td>
					<td class='center'>2</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=275' class='user'>GHOULAM Faouzi</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>4</td>
					<td class='center'>6.88</td>
					<td class='center'>6.38</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=276' class='user'>GOBBI Massimo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>10</td>
					<td class='center'>5.6</td>
					<td class='center'>5.7</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=277' class='user'>GOLDANIGA Edoardo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>17</td>
					<td class='center'>5.71</td>
					<td class='center'>5.53</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=278' class='user'>GOMEZ Gustavo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=279' class='user'>GONZALEZ Giancarlo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>8</td>
					<td class='center'>5.56</td>
					<td class='center'>5.5</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=280' class='user'>GOSENS Robin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>15</td>
					<td class='center'>6.33</td>
					<td class='center'>5.97</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=281' class='user'>GUNTER Koray</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>9</td>
					<td class='center'>5.67</td>
					<td class='center'>5.06</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=282' class='user'>HANCKO David</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>2</td>
					<td class='center'>6.25</td>
					<td class='center'>3.25</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=283' class='user'>HATEBOER Hans</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>18</td>
					<td class='center'>6.89</td>
					<td class='center'>6.03</td>
					<td class='center'>15</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=284' class='user'>HELANDER Filip Viktor</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>15</td>
					<td class='center'>5.4</td>
					<td class='center'>5.53</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=285' class='user'>HEURTAUX Thomas</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=286' class='user'>HRISTOV Petko</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>2</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=287' class='user'>HYSAJ Elseid</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>15</td>
					<td class='center'>5.73</td>
					<td class='center'>5.7</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=288' class='user'>IACOPONI Simone</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>20</td>
					<td class='center'>5.7</td>
					<td class='center'>5.78</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=289' class='user'>IMPERIALE Marco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=290' class='user'>IZZO Armando</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>19</td>
					<td class='center'>6.24</td>
					<td class='center'>6.13</td>
					<td class='center'>13</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=291' class='user'>JAROSZYNSKI Pawel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>9</td>
					<td class='center'>5.39</td>
					<td class='center'>5.44</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=292' class='user'>JUAN JESUS Guilherme Nunes</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>9</td>
					<td class='center'>6.22</td>
					<td class='center'>5.72</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=293' class='user'>KARSDORP Rick</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>3</td>
					<td class='center'>5.67</td>
					<td class='center'>5.67</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=294' class='user'>KOLAROV Aleksandar</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>18</td>
					<td class='center'>7.33</td>
					<td class='center'>6.08</td>
					<td class='center'>27</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=295' class='user'>KONATE Pa</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=296' class='user'>KOULIBALY Kalidou</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>18</td>
					<td class='center'>6.19</td>
					<td class='center'>6.31</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=297' class='user'>KRAFTH Emil</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=298' class='user'>KRAJNC Luka</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>7</td>
					<td class='center'>5.07</td>
					<td class='center'>5.29</td>
					<td class='center'>3</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=299' class='user'>LAKICEVIC Ivan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=300' class='user'>LARSEN Jens Stryger</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>20</td>
					<td class='center'>6</td>
					<td class='center'>5.93</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=301' class='user'>LAURINI Vincent</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>4</td>
					<td class='center'>5.5</td>
					<td class='center'>4.13</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=302' class='user'>LEMOS Mauricio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>2</td>
					<td class='center'>5.25</td>
					<td class='center'>5.25</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=303' class='user'>LETSCHERT Timo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=304' class='user'>LEVERBE Maxime</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=305' class='user'>LIROLA Pol</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>18</td>
					<td class='center'>6.31</td>
					<td class='center'>5.92</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=306' class='user'>LUIZ FELIPE Ramos Marchi</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>11</td>
					<td class='center'>6.27</td>
					<td class='center'>5.86</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=307' class='user'>LUPERTO Sebastiano</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>3</td>
					<td class='center'>6</td>
					<td class='center'>6</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=308' class='user'>LYANCO Silveira Neves Vojnovic</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>1</td>
					<td class='center'>5</td>
					<td class='center'>5.5</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=309' class='user'>LYKOGIANNIS Charalampos</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>3</td>
					<td class='center'>6</td>
					<td class='center'>6</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=310' class='user'>MAIETTA Domenico</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>14</td>
					<td class='center'>5.32</td>
					<td class='center'>5.46</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=311' class='user'>MAKSIMOVIC Nikola</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>9</td>
					<td class='center'>5.83</td>
					<td class='center'>5.89</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=312' class='user'>MANCINI Gianluca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>15</td>
					<td class='center'>7.83</td>
					<td class='center'>6.33</td>
					<td class='center'>20</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=313' class='user'>MANOLAS Konstantinos</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>17</td>
					<td class='center'>6.29</td>
					<td class='center'>6.06</td>
					<td class='center'>17</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=314' class='user'>MARCANO Iv&Atilde;&iexcl;n</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>4</td>
					<td class='center'>5.25</td>
					<td class='center'>5.25</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=315' class='user'>MARCHIZZA Riccardo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>2</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=316' class='user'>MARCJANIK Michal</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=317' class='user'>MARIO RUI Silva Duarte</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>13</td>
					<td class='center'>5.81</td>
					<td class='center'>5.92</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=318' class='user'>MARUSIC Adam</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>14</td>
					<td class='center'>5.54</td>
					<td class='center'>5.68</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=319' class='user'>MASIELLO Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>11</td>
					<td class='center'>5.27</td>
					<td class='center'>5.59</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=320' class='user'>MBAYE Ibrahima</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>8</td>
					<td class='center'>6.56</td>
					<td class='center'>5.56</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=321' class='user'>MILENKOVIC Nikola</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>19</td>
					<td class='center'>6.34</td>
					<td class='center'>5.71</td>
					<td class='center'>13</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=322' class='user'>MIRANDA Joao</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>7</td>
					<td class='center'>5.29</td>
					<td class='center'>5.5</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=323' class='user'>MOLINARO Cristian</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>9</td>
					<td class='center'>5.5</td>
					<td class='center'>5.61</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=324' class='user'>MORETTI Emiliano</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>9</td>
					<td class='center'>5.83</td>
					<td class='center'>5.94</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=325' class='user'>MURRU Nicola</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>20</td>
					<td class='center'>5.98</td>
					<td class='center'>5.58</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=326' class='user'>MUSACCHIO Mateo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>12</td>
					<td class='center'>5.75</td>
					<td class='center'>5.25</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=327' class='user'>NKOULOU Nicolas</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>20</td>
					<td class='center'>6.58</td>
					<td class='center'>6.2</td>
					<td class='center'>18</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=328' class='user'>NUYTINCK Bram</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>18</td>
					<td class='center'>5.86</td>
					<td class='center'>5.69</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=329' class='user'>OLIVERA Maximiliano</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=330' class='user'>OPOKU Nicholas</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>6</td>
					<td class='center'>5.25</td>
					<td class='center'>5.5</td>
					<td class='center'>3</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=331' class='user'>PAJAC Marko</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>3</td>
					<td class='center'>5.83</td>
					<td class='center'>5.83</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=332' class='user'>PALOMINO Jos&Atilde;&copy; Luis</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>14</td>
					<td class='center'>6.32</td>
					<td class='center'>6.07</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=333' class='user'>PASQUAL Manuel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>11</td>
					<td class='center'>6.55</td>
					<td class='center'>5.95</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=334' class='user'>PAZ Nehu&Atilde;&copy;n</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>1</td>
					<td class='center'>4.5</td>
					<td class='center'>5</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=335' class='user'>PELLEGRINI Luca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>4</td>
					<td class='center'>5.38</td>
					<td class='center'>5.38</td>
					<td class='center'>2</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=336' class='user'>PELUSO Federico</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>2</td>
					<td class='center'>5.25</td>
					<td class='center'>5.5</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=337' class='user'>PEREIRA Pedro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>11</td>
					<td class='center'>5.55</td>
					<td class='center'>5</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=338' class='user'>PEZZELLA German</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>19</td>
					<td class='center'>6.47</td>
					<td class='center'>5.97</td>
					<td class='center'>16</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=339' class='user'>PEZZELLA Giuseppe</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>3</td>
					<td class='center'>5.5</td>
					<td class='center'>5.67</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=340' class='user'>PISACANE Fabio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>12</td>
					<td class='center'>5.75</td>
					<td class='center'>5.92</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=341' class='user'>POLVANI Luca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>2</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=342' class='user'>RADU Stefan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>17</td>
					<td class='center'>5.82</td>
					<td class='center'>5.85</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=343' class='user'>RANOCCHIA Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=344' class='user'>RASMUSSEN Jacob</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>9</td>
					<td class='center'>5.5</td>
					<td class='center'>5.61</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=345' class='user'>RECA Arkadiusz</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=346' class='user'>REGINI Vasco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=347' class='user'>RODRIGUEZ Ricardo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>19</td>
					<td class='center'>5.95</td>
					<td class='center'>5.61</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=348' class='user'>ROGERIO Oliveira Da Silva</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>17</td>
					<td class='center'>5.68</td>
					<td class='center'>5.85</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=349' class='user'>ROLANDO Gabriele</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=350' class='user'>ROMAGNA Filippo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>12</td>
					<td class='center'>5.83</td>
					<td class='center'>5.92</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=351' class='user'>ROMAGNOLI Alessio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>15</td>
					<td class='center'>6.23</td>
					<td class='center'>5.67</td>
					<td class='center'>16</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=352' class='user'>ROMAGNOLI Simone</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=353' class='user'>ROSSETTINI Luca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>18</td>
					<td class='center'>5.47</td>
					<td class='center'>5.61</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=354' class='user'>RUGANI Daniele</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>5</td>
					<td class='center'>6.9</td>
					<td class='center'>6.1</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=355' class='user'>RUSSO Adriano</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>2</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=356' class='user'>SALA Jacopo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>9</td>
					<td class='center'>5.78</td>
					<td class='center'>5.06</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=357' class='user'>SALAMON Bartosz</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>8</td>
					<td class='center'>5.44</td>
					<td class='center'>5.44</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=358' class='user'>SAMIR Caetano de Sousa</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>13</td>
					<td class='center'>5.77</td>
					<td class='center'>5.81</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=359' class='user'>SANTON Davide</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>9</td>
					<td class='center'>6</td>
					<td class='center'>5.89</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=360' class='user'>SCAGLIA Luigi</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=361' class='user'>SERNICOLA Leonardo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=362' class='user'>SIMIC Stefan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>2</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=363' class='user'>SKRINIAR Milan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>18</td>
					<td class='center'>6.11</td>
					<td class='center'>6.25</td>
					<td class='center'>18</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=364' class='user'>SPINAZZOLA Leonardo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=365' class='user'>SPOLLI Nicolas</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>8</td>
					<td class='center'>5.19</td>
					<td class='center'>4.81</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=366' class='user'>SRNA Darijo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>16</td>
					<td class='center'>5.97</td>
					<td class='center'>5.91</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=367' class='user'>STRINIC Ivan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=368' class='user'>TANASIJEVIC Strahinja</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>1</td>
					<td class='center'>3.5</td>
					<td class='center'>4.5</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=369' class='user'>TAVARES Junior</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=370' class='user'>TER AVEST Hidde</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>8</td>
					<td class='center'>5.81</td>
					<td class='center'>5.81</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=371' class='user'>TERRANOVA Emanuele</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>6</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=372' class='user'>TOLOI Rafael</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>17</td>
					<td class='center'>6</td>
					<td class='center'>6.03</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=373' class='user'>TOMOVIC Nenad</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>8</td>
					<td class='center'>6.19</td>
					<td class='center'>5.69</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=374' class='user'>TONELLI Lorenzo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>13</td>
					<td class='center'>6.35</td>
					<td class='center'>5.62</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=375' class='user'>UNTERSEE Joel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>3</td>
					<td class='center'>5.83</td>
					<td class='center'>5.83</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=376' class='user'>VAISANEN Sauli</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=377' class='user'>VALJENT Martin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=378' class='user'>VARNIER Marco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=379' class='user'>VENUTI Lorenzo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=380' class='user'>VESELI Frederic</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>13</td>
					<td class='center'>5.31</td>
					<td class='center'>5.42</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=381' class='user'>VICARI Francesco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>16</td>
					<td class='center'>5.94</td>
					<td class='center'>5.97</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=382' class='user'>VITOR HUGO Franchescoli de Souza</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>18</td>
					<td class='center'>5.58</td>
					<td class='center'>5.5</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=383' class='user'>WAGUE Molla</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>1</td>
					<td class='center'>5.5</td>
					<td class='center'>5.5</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=384' class='user'>WALLACE Oliveira dos Santos</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>12</td>
					<td class='center'>5.29</td>
					<td class='center'>5.54</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=385' class='user'>ZAPATA Cristian</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>10</td>
					<td class='center'>6.05</td>
					<td class='center'>5.6</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=386' class='user'>ZUKANOVIC Ervin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>8</td>
					<td class='center'>5.31</td>
					<td class='center'>4.75</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=387' class='user'>SIERRALTA Francisco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>6</td>
					<td class='center'>2</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=388' class='user'>PATRIC Patricio Gabarron Gil</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>7</td>
					<td class='center'>6.07</td>
					<td class='center'>6.07</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=389' class='user'>MATTIELLO Federico</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>14</td>
					<td class='center'>6.04</td>
					<td class='center'>5.71</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=390' class='user'>DJOUROU Johan Danon</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>4</td>
					<td class='center'>5.88</td>
					<td class='center'>5.88</td>
					<td class='center'>7</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=391' class='user'>TRIPALDELLI Alessandro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=392' class='user'>LUKAKU Jordan Zacharie</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>7</td>
					<td class='center'>5.79</td>
					<td class='center'>5.86</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=393' class='user'>MAGNANI Giangiacomo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>12</td>
					<td class='center'>6</td>
					<td class='center'>5.96</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=394' class='user'>GILLEKENS Jordy</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=395' class='user'>GABBIA Matteo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=396' class='user'>BELLANOVA Raoul</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=397' class='user'>VRSALJKO Sime</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>9</td>
					<td class='center'>5.89</td>
					<td class='center'>5.78</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=398' class='user'>LOPEZ Lisandro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=399' class='user'>SILVESTRE Matias</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>20</td>
					<td class='center'>6.03</td>
					<td class='center'>5.78</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=400' class='user'>MALCUIT Kevin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>10</td>
					<td class='center'>6.25</td>
					<td class='center'>6.2</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=401' class='user'>ANDERSON Djavan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=402' class='user'>FERIGRA Erick</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=403' class='user'>CORBO Gabriele</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=404' class='user'>BARBA Federico</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>15</td>
					<td class='center'>5.53</td>
					<td class='center'>5.67</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=405' class='user'>AINA Ola</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>17</td>
					<td class='center'>5.94</td>
					<td class='center'>5.91</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=406' class='user'>DJIDJI Koffi</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>12</td>
					<td class='center'>6.04</td>
					<td class='center'>6.08</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=407' class='user'>ZAMPANO Francesco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>18</td>
					<td class='center'>5.78</td>
					<td class='center'>5.44</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=408' class='user'>SIMIC Lorenco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>3</td>
					<td class='center'>5</td>
					<td class='center'>5</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=409' class='user'>MARLON -</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>17</td>
					<td class='center'>5.88</td>
					<td class='center'>5.76</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=410' class='user'>DJIMSITI Berat</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>9</td>
					<td class='center'>5.89</td>
					<td class='center'>5.78</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=411' class='user'>TROOST-EKONG William</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>20</td>
					<td class='center'>5.93</td>
					<td class='center'>5.98</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=412' class='user'>VERGARA Jherson</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>2</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=413' class='user'>SALVI Matteo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=414' class='user'>FERRARESI Stefano</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=415' class='user'>KLAVAN Ragnar</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>10</td>
					<td class='center'>5.85</td>
					<td class='center'>5.85</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=416' class='user'>RIGIONE Michele</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>2</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=417' class='user'>ROMERO Cristian</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>12</td>
					<td class='center'>6</td>
					<td class='center'>5.88</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=418' class='user'>DI MAGGIO Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='D'>
					<td class='center' style='padding: 15px;'><span class='ruolo indigo darken-4'>D</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=419' class='user'>ZEEGELAAR Marvin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=500' class='user'>ACQUAH Afriyie</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>12</td>
					<td class='center'>5.79</td>
					<td class='center'>5.83</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=501' class='user'>ALLAN Marques Loureiro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>18</td>
					<td class='center'>6.39</td>
					<td class='center'>6.42</td>
					<td class='center'>18</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=503' class='user'>BADU Emmanuel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=504' class='user'>BALIC Andrija</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=505' class='user'>BANDINELLI Filippo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=506' class='user'>BARAK Antonin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>5</td>
					<td class='center'>5.7</td>
					<td class='center'>5.7</td>
					<td class='center'>15</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=507' class='user'>BARELLA Nicol&Atilde;&sup2;</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>19</td>
					<td class='center'>6.16</td>
					<td class='center'>6.05</td>
					<td class='center'>16</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=508' class='user'>BARILL&Atilde; Antonino</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>18</td>
					<td class='center'>6.17</td>
					<td class='center'>6.06</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=509' class='user'>BARRETO Edgar</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>8</td>
					<td class='center'>6.25</td>
					<td class='center'>5.44</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=510' class='user'>BASELLI Daniele</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>17</td>
					<td class='center'>6.82</td>
					<td class='center'>6.12</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=511' class='user'>BAUMGARTNER Denis</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=512' class='user'>BEGHETTO Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>12</td>
					<td class='center'>5.58</td>
					<td class='center'>5.67</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=513' class='user'>BEHRAMI Valon</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>14</td>
					<td class='center'>6.04</td>
					<td class='center'>5.93</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=514' class='user'>BENASSI Marco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>18</td>
					<td class='center'>7.28</td>
					<td class='center'>5.69</td>
					<td class='center'>21</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=515' class='user'>BENNACER Ismael</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>17</td>
					<td class='center'>5.79</td>
					<td class='center'>5.88</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=516' class='user'>BENTANCUR Rodrigo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>15</td>
					<td class='center'>6.27</td>
					<td class='center'>5.97</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=517' class='user'>BERENGUER Alex</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>9</td>
					<td class='center'>6.67</td>
					<td class='center'>6.11</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=518' class='user'>BERISHA Valon</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>2</td>
					<td class='center'>6.5</td>
					<td class='center'>6.5</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=519' class='user'>BERNARDESCHI Federico</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>9</td>
					<td class='center'>7.22</td>
					<td class='center'>6.33</td>
					<td class='center'>20</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=520' class='user'>BERTOLACCI Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=521' class='user'>BESEA Emmanuel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>2</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=522' class='user'>BESSA Daniel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>17</td>
					<td class='center'>6.26</td>
					<td class='center'>5.71</td>
					<td class='center'>15</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=523' class='user'>BIGLIA Lucas</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>10</td>
					<td class='center'>5.95</td>
					<td class='center'>5.45</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=524' class='user'>BIRSA Valter</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>18</td>
					<td class='center'>6.31</td>
					<td class='center'>5.78</td>
					<td class='center'>16</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=525' class='user'>BOATENG Kevin-Prince</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>13</td>
					<td class='center'>7.46</td>
					<td class='center'>6.19</td>
					<td class='center'>20</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=526' class='user'>BONAVENTURA Giacomo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>9</td>
					<td class='center'>7.5</td>
					<td class='center'>5.5</td>
					<td class='center'>24</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=527' class='user'>BORINI Fabio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>8</td>
					<td class='center'>6.25</td>
					<td class='center'>5.06</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=528' class='user'>BORJA VALERO Iglesias</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>13</td>
					<td class='center'>5.88</td>
					<td class='center'>5.92</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=529' class='user'>BOURABIA Mehdi</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>17</td>
					<td class='center'>5.91</td>
					<td class='center'>5.94</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=530' class='user'>BRIGHI Matteo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>1</td>
					<td class='center'>5</td>
					<td class='center'>5</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=531' class='user'>BROZOVIC Marcelo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>17</td>
					<td class='center'>6.26</td>
					<td class='center'>5.97</td>
					<td class='center'>17</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=532' class='user'>CALHANOGLU Hakan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>16</td>
					<td class='center'>5.63</td>
					<td class='center'>5.53</td>
					<td class='center'>16</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=533' class='user'>CALIGARA Fabrizio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=534' class='user'>CALLEGARI Lorenzo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=535' class='user'>CAN Emre</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>12</td>
					<td class='center'>6.46</td>
					<td class='center'>6.13</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=536' class='user'>CANDREVA Antonio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>5</td>
					<td class='center'>6.8</td>
					<td class='center'>6</td>
					<td class='center'>14</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=537' class='user'>CAPEZZI Leonardo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>9</td>
					<td class='center'>5.28</td>
					<td class='center'>5.67</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=538' class='user'>CASSATA Francesco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>10</td>
					<td class='center'>5.95</td>
					<td class='center'>5.65</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=539' class='user'>CASTRO Lucas</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>10</td>
					<td class='center'>6.65</td>
					<td class='center'>6.1</td>
					<td class='center'>17</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=540' class='user'>CATALDI Danilo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>3</td>
					<td class='center'>7.67</td>
					<td class='center'>6.17</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=541' class='user'>CHIBSAH Raman</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>20</td>
					<td class='center'>5.9</td>
					<td class='center'>5.8</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=542' class='user'>CHIESA Federico</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>20</td>
					<td class='center'>7.13</td>
					<td class='center'>6.2</td>
					<td class='center'>24</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=543' class='user'>CIGARINI Luca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>8</td>
					<td class='center'>5.56</td>
					<td class='center'>5.75</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=544' class='user'>COLOMBATTO Santiago</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=545' class='user'>CORIC Ante</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>1</td>
					<td class='center'>5</td>
					<td class='center'>5</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=546' class='user'>COULIBALY Mamadou</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=547' class='user'>CRISETIG Lorenzo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>7</td>
					<td class='center'>5.36</td>
					<td class='center'>5.57</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=548' class='user'>CRISTANTE Bryan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>19</td>
					<td class='center'>6.84</td>
					<td class='center'>5.95</td>
					<td class='center'>25</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=549' class='user'>CRISTOFORO Sebastian</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=550' class='user'>CUADRADO Juan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>9</td>
					<td class='center'>6.33</td>
					<td class='center'>5.89</td>
					<td class='center'>20</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=551' class='user'>D'ALESSANDRO Marco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>8</td>
					<td class='center'>6</td>
					<td class='center'>6</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=552' class='user'>DABO Bryan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>6</td>
					<td class='center'>6.5</td>
					<td class='center'>4.92</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=553' class='user'>DE PAUL Rodrigo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>19</td>
					<td class='center'>7.26</td>
					<td class='center'>6.18</td>
					<td class='center'>20</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=554' class='user'>DE ROON Marten</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>17</td>
					<td class='center'>6.26</td>
					<td class='center'>6.15</td>
					<td class='center'>15</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=555' class='user'>DE ROSSI Daniele</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>9</td>
					<td class='center'>5.78</td>
					<td class='center'>5.94</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=556' class='user'>DEIOLA Alessandro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>8</td>
					<td class='center'>5.88</td>
					<td class='center'>5.81</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=557' class='user'>DEPAOLI Fabio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>17</td>
					<td class='center'>5.65</td>
					<td class='center'>5.76</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=558' class='user'>DESSENA Daniele</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>6</td>
					<td class='center'>5.58</td>
					<td class='center'>5.83</td>
					<td class='center'>5</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=559' class='user'>DEZI Jacopo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=560' class='user'>DI GENNARO Davide</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=561' class='user'>DIAWARA Amadou</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>9</td>
					<td class='center'>5.56</td>
					<td class='center'>5.72</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=562' class='user'>DJURICIC Filip</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>12</td>
					<td class='center'>6.04</td>
					<td class='center'>5.83</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=563' class='user'>DONSAH Godfred</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=564' class='user'>DOUGLAS COSTA de Souza</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>11</td>
					<td class='center'>6.14</td>
					<td class='center'>5.91</td>
					<td class='center'>23</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=565' class='user'>DUNCAN Alfred</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>13</td>
					<td class='center'>7.42</td>
					<td class='center'>6.5</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=566' class='user'>DZEMAILI Blerim</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>15</td>
					<td class='center'>5.3</td>
					<td class='center'>5.4</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=567' class='user'>EMMERS Xian</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=568' class='user'>EVANGELISTA Lucas</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>5</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=569' class='user'>EVERTON LUIZ Guimaraes Bilher</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>9</td>
					<td class='center'>5.56</td>
					<td class='center'>5.78</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=570' class='user'>EYSSERIC Valentin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>8</td>
					<td class='center'>6</td>
					<td class='center'>5.19</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=571' class='user'>FARES Mohamed</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>19</td>
					<td class='center'>5.66</td>
					<td class='center'>5.74</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=572' class='user'>FOFANA Seko</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>20</td>
					<td class='center'>6.03</td>
					<td class='center'>5.93</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=573' class='user'>FRATTESI Davide</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=574' class='user'>FREDIANI Marco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=575' class='user'>FREULER Remo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>18</td>
					<td class='center'>6.47</td>
					<td class='center'>6.25</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=576' class='user'>GAGLIARDINI Roberto</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>7</td>
					<td class='center'>6.71</td>
					<td class='center'>5.71</td>
					<td class='center'>13</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=577' class='user'>GARRITANO Luca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>5</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=578' class='user'>GAUDINO Gianluca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=579' class='user'>GERSON Santos Da Silva</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>19</td>
					<td class='center'>5.92</td>
					<td class='center'>5.47</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=580' class='user'>GIACCHERINI Emanuele</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>15</td>
					<td class='center'>6.47</td>
					<td class='center'>6.1</td>
					<td class='center'>18</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=581' class='user'>GIORNO Francesco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=582' class='user'>GONALONS Maxime</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>6</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=583' class='user'>GORI Mirko</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>3</td>
					<td class='center'>5.67</td>
					<td class='center'>5.83</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=584' class='user'>GRASSI Alberto</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>5</td>
					<td class='center'>6</td>
					<td class='center'>6</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=585' class='user'>HAAS Nicolas</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=586' class='user'>HALILOVIC Alen</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=587' class='user'>HALLFREDSSON Emil</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>5</td>
					<td class='center'>5.5</td>
					<td class='center'>5.7</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=588' class='user'>HAMSIK Marek</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>12</td>
					<td class='center'>5.83</td>
					<td class='center'>5.88</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=589' class='user'>HETEMAJ Perparim</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>13</td>
					<td class='center'>5.58</td>
					<td class='center'>5.73</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=590' class='user'>HILJEMARK Oscar</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>16</td>
					<td class='center'>6.06</td>
					<td class='center'>5.44</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=591' class='user'>INGELSSON Svante</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=592' class='user'>IONITA Artur</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>20</td>
					<td class='center'>6.28</td>
					<td class='center'>5.88</td>
					<td class='center'>14</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=593' class='user'>JANKTO Jakub</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>8</td>
					<td class='center'>5.31</td>
					<td class='center'>4.63</td>
					<td class='center'>13</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=594' class='user'>JOAO PEDRO Geraldino Galvao</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>16</td>
					<td class='center'>7.22</td>
					<td class='center'>6.06</td>
					<td class='center'>20</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=595' class='user'>KATUMA Aron</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=596' class='user'>KESSIE Franck</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>18</td>
					<td class='center'>6.56</td>
					<td class='center'>5.67</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=597' class='user'>KHEDIRA Sami</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>6</td>
					<td class='center'>6.42</td>
					<td class='center'>5.75</td>
					<td class='center'>21</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=598' class='user'>KINGSLEY Michael</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=599' class='user'>KIYINE Sofian</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>8</td>
					<td class='center'>5.69</td>
					<td class='center'>5.94</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=600' class='user'>KON&Atilde; Moussa</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=601' class='user'>KREJCI Ladislav</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>11</td>
					<td class='center'>5.32</td>
					<td class='center'>5.32</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=602' class='user'>KRUNIC Rade</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>17</td>
					<td class='center'>6.76</td>
					<td class='center'>6.09</td>
					<td class='center'>17</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=603' class='user'>KULUSEVSKI Dejan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>6</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=604' class='user'>KURTIC Jasmin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>14</td>
					<td class='center'>7.14</td>
					<td class='center'>6.21</td>
					<td class='center'>18</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=605' class='user'>LAXALT Diego</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>8</td>
					<td class='center'>5.5</td>
					<td class='center'>4.88</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=606' class='user'>LAZOVIC Darko</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>20</td>
					<td class='center'>6.08</td>
					<td class='center'>5.5</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=607' class='user'>LAZZARI Manuel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>19</td>
					<td class='center'>6.79</td>
					<td class='center'>6.55</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=608' class='user'>LEIVA Lucas</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>12</td>
					<td class='center'>6.13</td>
					<td class='center'>6.13</td>
					<td class='center'>15</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=609' class='user'>LINETTY Karol</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>17</td>
					<td class='center'>6.03</td>
					<td class='center'>5.59</td>
					<td class='center'>13</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=610' class='user'>LJAJIC Adem</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>1</td>
					<td class='center'>7</td>
					<td class='center'>7</td>
					<td class='center'>22</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=611' class='user'>LOCATELLI Manuel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>12</td>
					<td class='center'>5.75</td>
					<td class='center'>5.71</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=612' class='user'>LOLLO Lorenzo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=613' class='user'>LUKIC Sasa</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>5</td>
					<td class='center'>5.8</td>
					<td class='center'>5.9</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=614' class='user'>LULIC Senad</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>19</td>
					<td class='center'>6.5</td>
					<td class='center'>6.11</td>
					<td class='center'>18</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=615' class='user'>MAGNANELLI Francesco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>8</td>
					<td class='center'>6.06</td>
					<td class='center'>6.13</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=616' class='user'>MAIELLO Raffaele</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>16</td>
					<td class='center'>5.47</td>
					<td class='center'>5.59</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=617' class='user'>MANDRAGORA Rolando</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>18</td>
					<td class='center'>5.94</td>
					<td class='center'>5.83</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=618' class='user'>MARCHISIO Claudio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>6</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=619' class='user'>MATUIDI Blaise</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>17</td>
					<td class='center'>6.68</td>
					<td class='center'>6.21</td>
					<td class='center'>18</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=620' class='user'>MAURI Jos&Atilde;&uml;</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>3</td>
					<td class='center'>6</td>
					<td class='center'>4</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=621' class='user'>MAZZITELLI Luca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>7</td>
					<td class='center'>5.71</td>
					<td class='center'>5</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=622' class='user'>MEITE Soualiho</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>18</td>
					<td class='center'>6.31</td>
					<td class='center'>6.08</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=623' class='user'>MILINKOVIC Sergej</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>19</td>
					<td class='center'>6.16</td>
					<td class='center'>5.58</td>
					<td class='center'>23</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=624' class='user'>MINALA Joseph</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=625' class='user'>MISSIROLI Simone</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>19</td>
					<td class='center'>5.87</td>
					<td class='center'>5.95</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=626' class='user'>MONTOLIVO Riccardo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=627' class='user'>MURGIA Alessandro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=628' class='user'>NAGY Adam</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>11</td>
					<td class='center'>5.23</td>
					<td class='center'>4.91</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=629' class='user'>NAINGGOLAN Radja</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>12</td>
					<td class='center'>6.79</td>
					<td class='center'>6.13</td>
					<td class='center'>22</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=630' class='user'>OBI Joel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>10</td>
					<td class='center'>6.15</td>
					<td class='center'>5.8</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=631' class='user'>OMEONGA Stephane</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>2</td>
					<td class='center'>5.5</td>
					<td class='center'>2.75</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=632' class='user'>PADOIN Simone</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>15</td>
					<td class='center'>5.87</td>
					<td class='center'>5.83</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=633' class='user'>PAGANINI Luca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=634' class='user'>PARIGINI Vittorio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>6</td>
					<td class='center'>6.08</td>
					<td class='center'>6.08</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=635' class='user'>PAROLO Marco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>20</td>
					<td class='center'>6.55</td>
					<td class='center'>5.95</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=636' class='user'>PASTORE Javier</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>8</td>
					<td class='center'>6.5</td>
					<td class='center'>5.5</td>
					<td class='center'>23</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=637' class='user'>PELLEGRINI Lorenzo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>12</td>
					<td class='center'>6.79</td>
					<td class='center'>6.29</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=638' class='user'>PERISIC Ivan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>18</td>
					<td class='center'>6.44</td>
					<td class='center'>5.69</td>
					<td class='center'>21</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=639' class='user'>PEROTTI Diego</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>4</td>
					<td class='center'>7.13</td>
					<td class='center'>6.13</td>
					<td class='center'>18</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=640' class='user'>PESSINA Matteo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>4</td>
					<td class='center'>6</td>
					<td class='center'>5.75</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=641' class='user'>PJANIC Miralem</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>17</td>
					<td class='center'>6.24</td>
					<td class='center'>6.06</td>
					<td class='center'>20</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=642' class='user'>POLI Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>15</td>
					<td class='center'>6.33</td>
					<td class='center'>5.87</td>
					<td class='center'>13</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=643' class='user'>PONTISSO Simone</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=644' class='user'>PRAET Dennis</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>17</td>
					<td class='center'>6.21</td>
					<td class='center'>5.62</td>
					<td class='center'>15</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=645' class='user'>PULGAR Erick</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>11</td>
					<td class='center'>5.32</td>
					<td class='center'>5.45</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=646' class='user'>RADOVANOVIC Ivan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>19</td>
					<td class='center'>5.61</td>
					<td class='center'>5.76</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=647' class='user'>RAMIREZ Gast&Atilde;&sup3;n</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>17</td>
					<td class='center'>7.15</td>
					<td class='center'>5.76</td>
					<td class='center'>23</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=648' class='user'>RICCARDI Alessio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=649' class='user'>RIGONI Luca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>13</td>
					<td class='center'>6.04</td>
					<td class='center'>5.85</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=650' class='user'>RIGONI Nicola</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>11</td>
					<td class='center'>5.41</td>
					<td class='center'>5.45</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=651' class='user'>RINCON Tomas</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>18</td>
					<td class='center'>6.39</td>
					<td class='center'>6.19</td>
					<td class='center'>14</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=652' class='user'>RIZZO Luca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=653' class='user'>ROG Marko</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>7</td>
					<td class='center'>6.21</td>
					<td class='center'>5.86</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=654' class='user'>ROMULO Orestes</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>16</td>
					<td class='center'>6.25</td>
					<td class='center'>5.63</td>
					<td class='center'>13</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=655' class='user'>RUIZ Fabian</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>12</td>
					<td class='center'>7.38</td>
					<td class='center'>6.38</td>
					<td class='center'>20</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=656' class='user'>SAMMARCO Paolo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=657' class='user'>SANCHEZ Carlos</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>5</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=658' class='user'>SANDRO Raniere</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>12</td>
					<td class='center'>5.75</td>
					<td class='center'>5.25</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=659' class='user'>SAPONARA Riccardo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>13</td>
					<td class='center'>6.92</td>
					<td class='center'>5.69</td>
					<td class='center'>16</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=660' class='user'>SCAVONE Manuel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>6</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=661' class='user'>SCHETINO Andres</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>2</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=662' class='user'>SCHIATTARELLA Pasquale</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>17</td>
					<td class='center'>5.79</td>
					<td class='center'>5.94</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=663' class='user'>SCOZZARELLA Matteo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>7</td>
					<td class='center'>6.29</td>
					<td class='center'>6.29</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=664' class='user'>SENSI Stefano</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>15</td>
					<td class='center'>6.37</td>
					<td class='center'>6.2</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=665' class='user'>SODDIMO Danilo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>7</td>
					<td class='center'>5.36</td>
					<td class='center'>5.36</td>
					<td class='center'>6</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=666' class='user'>STIJEPOVIC Ognjen</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=667' class='user'>STROOTMAN Kevin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>6</td>
					<td class='center'>13</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=668' class='user'>STULAC Leo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>16</td>
					<td class='center'>5.91</td>
					<td class='center'>6</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=669' class='user'>STURARO Stefano</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=670' class='user'>SVANBERG Mattias</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>16</td>
					<td class='center'>5.72</td>
					<td class='center'>5.66</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=671' class='user'>TESSIORE Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=672' class='user'>TRAOR&Atilde; Hamed Junior</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>15</td>
					<td class='center'>6.17</td>
					<td class='center'>6.17</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=673' class='user'>VALDIFIORI Mirko</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>10</td>
					<td class='center'>5.7</td>
					<td class='center'>5.75</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=674' class='user'>VALENCIA Juan Manuel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>2</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=675' class='user'>VALOTI Mattia</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>10</td>
					<td class='center'>5.95</td>
					<td class='center'>6</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=676' class='user'>VALZANIA Luca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>3</td>
					<td class='center'>5.5</td>
					<td class='center'>5.5</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=677' class='user'>VECINO Matias</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>13</td>
					<td class='center'>5.69</td>
					<td class='center'>5.69</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=678' class='user'>VERETOUT Jordan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>16</td>
					<td class='center'>6.94</td>
					<td class='center'>6.28</td>
					<td class='center'>21</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=679' class='user'>VERRE Valerio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=680' class='user'>VIGNATO Emanuel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>1</td>
					<td class='center'>5.5</td>
					<td class='center'>5.5</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=681' class='user'>VITALE Mattia</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>2</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=682' class='user'>VIVIANI Federico</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=683' class='user'>YOUNES Amin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>1</td>
					<td class='center'>6.5</td>
					<td class='center'>6.5</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=684' class='user'>ZAJC Miha</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>19</td>
					<td class='center'>6.82</td>
					<td class='center'>6.16</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=685' class='user'>ZANIOLO Nicol&Atilde;&sup2;</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>9</td>
					<td class='center'>7.28</td>
					<td class='center'>6.5</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=686' class='user'>ZIELINSKI Piotr</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>20</td>
					<td class='center'>6.5</td>
					<td class='center'>5.98</td>
					<td class='center'>18</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=687' class='user'>&Atilde;NDER Cengiz</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>16</td>
					<td class='center'>6.84</td>
					<td class='center'>5.88</td>
					<td class='center'>25</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=688' class='user'>PEETERS Daouda</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=689' class='user'>NORGAARD Christian</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>4</td>
					<td class='center'>5.88</td>
					<td class='center'>4.38</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=690' class='user'>NETO Pedro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=691' class='user'>JORDAO Bruno</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=692' class='user'>JOAO MARIO -</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>10</td>
					<td class='center'>6.65</td>
					<td class='center'>6.2</td>
					<td class='center'>13</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=693' class='user'>PASALIC Mario</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>15</td>
					<td class='center'>6.2</td>
					<td class='center'>5.73</td>
					<td class='center'>15</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=694' class='user'>BRADARIC Filip</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>16</td>
					<td class='center'>5.59</td>
					<td class='center'>5.84</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=695' class='user'>CORREA Carlos Joaquin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>19</td>
					<td class='center'>6.79</td>
					<td class='center'>6.13</td>
					<td class='center'>18</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=696' class='user'>BADELJ Milan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>10</td>
					<td class='center'>5.5</td>
					<td class='center'>5.85</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=697' class='user'>VIEIRA Ronaldo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>4</td>
					<td class='center'>6</td>
					<td class='center'>4.5</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=698' class='user'>NIKOLIC Lazar</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=699' class='user'>ROLON Esteban</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>7</td>
					<td class='center'>5.5</td>
					<td class='center'>4.93</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=700' class='user'>FURLAN Federico</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>5</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=701' class='user'>FERNANDES Edimilson</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>18</td>
					<td class='center'>5.47</td>
					<td class='center'>5.36</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=702' class='user'>EKDAL Albin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>19</td>
					<td class='center'>5.92</td>
					<td class='center'>5.71</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=703' class='user'>CARRIERO Giuseppe</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=704' class='user'>N'ZONZI Steven</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>17</td>
					<td class='center'>6.03</td>
					<td class='center'>5.91</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=705' class='user'>VLOET Rai</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>3</td>
					<td class='center'>5.67</td>
					<td class='center'>5.67</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=706' class='user'>BAKAYOKO Tiemou&Atilde;&copy;</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>13</td>
					<td class='center'>5.96</td>
					<td class='center'>5.62</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=707' class='user'>CASTILLEJO Samu</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>11</td>
					<td class='center'>6.55</td>
					<td class='center'>5.32</td>
					<td class='center'>16</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=708' class='user'>BURRUCHAGA Mauro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=709' class='user'>ESPOSITO Salvatore</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=710' class='user'>RIGONI Emiliano</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>9</td>
					<td class='center'>6.94</td>
					<td class='center'>5.67</td>
					<td class='center'>15</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=711' class='user'>COLPANI Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=712' class='user'>SORIANO Roberto</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>8</td>
					<td class='center'>5.75</td>
					<td class='center'>5.63</td>
					<td class='center'>13</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=713' class='user'>UCAN Salih</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>3</td>
					<td class='center'>7.67</td>
					<td class='center'>6.33</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=714' class='user'>MUNARI Gianni</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=715' class='user'>MONTIEL Cristobal</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=716' class='user'>ARAMU Mattia</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=717' class='user'>ERRICO Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=718' class='user'>VELOSO Miguel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>7</td>
					<td class='center'>5.79</td>
					<td class='center'>5.93</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=719' class='user'>PAQUETA Lucas</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>6.5</td>
					<td class='center'>20</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=720' class='user'>KUCKA Juraj</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>6</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=721' class='user'>INIGUEZ Gaspar</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=800' class='user'>ANDR&Atilde; SILVA Miguel Valente</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>15</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=801' class='user'>ANTENUCCI Mirco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>17</td>
					<td class='center'>6.15</td>
					<td class='center'>5.79</td>
					<td class='center'>16</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=802' class='user'>ASENCIO Ra&Atilde;&ordm;l</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>7</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=803' class='user'>AVENATTI Felipe</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>5</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=804' class='user'>BABACAR Khouma El</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>15</td>
					<td class='center'>7.07</td>
					<td class='center'>6</td>
					<td class='center'>21</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=805' class='user'>BACCA Carlos</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>16</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=806' class='user'>BAEZ Jaime</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=807' class='user'>BARAYE Yves</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=808' class='user'>BARROW Musa</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>11</td>
					<td class='center'>5.55</td>
					<td class='center'>5.55</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=809' class='user'>BELOTTI Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>20</td>
					<td class='center'>7.08</td>
					<td class='center'>6.08</td>
					<td class='center'>29</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=810' class='user'>BERARDI Domenico</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>19</td>
					<td class='center'>6.5</td>
					<td class='center'>6.03</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=811' class='user'>BUTIC Karlo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=812' class='user'>CAICEDO Felipe</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>9</td>
					<td class='center'>6.28</td>
					<td class='center'>5.94</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=813' class='user'>CALAI&Atilde; Emanuele</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=814' class='user'>CALLEJON Jose Maria</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>16</td>
					<td class='center'>6.66</td>
					<td class='center'>6.22</td>
					<td class='center'>24</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=815' class='user'>CAPRARI Gianluca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>14</td>
					<td class='center'>6.82</td>
					<td class='center'>5.86</td>
					<td class='center'>17</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=816' class='user'>CAPUTO Francesco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>20</td>
					<td class='center'>7.35</td>
					<td class='center'>6.18</td>
					<td class='center'>25</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=817' class='user'>CERAVOLO Fabio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>12</td>
					<td class='center'>5.71</td>
					<td class='center'>5.46</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=818' class='user'>CERRI Alberto</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>8</td>
					<td class='center'>5.38</td>
					<td class='center'>5.44</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=819' class='user'>CIANO Camillo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>16</td>
					<td class='center'>6.41</td>
					<td class='center'>5.75</td>
					<td class='center'>17</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=820' class='user'>CICIRETTI Amato</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>4</td>
					<td class='center'>5.38</td>
					<td class='center'>5.38</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=821' class='user'>CIOFANI Daniel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>12</td>
					<td class='center'>6.17</td>
					<td class='center'>5.58</td>
					<td class='center'>13</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=822' class='user'>CITRO Nicola</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>7</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=823' class='user'>COLIDIO Facundo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=824' class='user'>CORNELIUS Andreas</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>8</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=825' class='user'>CUTRONE Patrick</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>17</td>
					<td class='center'>6.5</td>
					<td class='center'>5.53</td>
					<td class='center'>22</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=826' class='user'>DA CRUZ Alessio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>3</td>
					<td class='center'>5.5</td>
					<td class='center'>5.5</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=827' class='user'>DAMASCAN Vitalie</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=828' class='user'>DEFREL Gregoire</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>19</td>
					<td class='center'>6.87</td>
					<td class='center'>5.66</td>
					<td class='center'>18</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=829' class='user'>DESTRO Mattia</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>4</td>
					<td class='center'>5.13</td>
					<td class='center'>5.25</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=830' class='user'>DI FRANCESCO Federico</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>14</td>
					<td class='center'>6.43</td>
					<td class='center'>5.93</td>
					<td class='center'>14</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=831' class='user'>DI GAUDIO Antonio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>11</td>
					<td class='center'>5.86</td>
					<td class='center'>5.86</td>
					<td class='center'>9</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=832' class='user'>DIONISI Federico</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=833' class='user'>DJORDJEVIC Filip</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>5</td>
					<td class='center'>5.4</td>
					<td class='center'>5.4</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=834' class='user'>DYBALA Paulo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>17</td>
					<td class='center'>6.62</td>
					<td class='center'>6.24</td>
					<td class='center'>29</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=835' class='user'>DZEKO Edin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>15</td>
					<td class='center'>5.93</td>
					<td class='center'>5.57</td>
					<td class='center'>24</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=836' class='user'>EDERA Simone</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>2</td>
					<td class='center'>5.5</td>
					<td class='center'>5.5</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=837' class='user'>EL SHAARAWY Stephan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>12</td>
					<td class='center'>7.88</td>
					<td class='center'>6.29</td>
					<td class='center'>27</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=838' class='user'>EWANDRO Felipe De Lima Costa</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=839' class='user'>FALCINELLI Diego</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>9</td>
					<td class='center'>5.56</td>
					<td class='center'>5.44</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=840' class='user'>FALLETTI Cesar</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>8</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=841' class='user'>FANTACCI Tommaso</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=842' class='user'>FARIAS Diego</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>14</td>
					<td class='center'>6.36</td>
					<td class='center'>5.82</td>
					<td class='center'>15</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=843' class='user'>FAVILLI Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>5</td>
					<td class='center'>6.1</td>
					<td class='center'>4.7</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=844' class='user'>FINOTTO Mattia</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>5</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=845' class='user'>FLOCCARI Sergio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>3</td>
					<td class='center'>5.33</td>
					<td class='center'>5.67</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=846' class='user'>GALABINOV Andrej</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>8</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=847' class='user'>GALUPPINI Francesco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=848' class='user'>GIANNETTI Niccol&Atilde;&sup2;</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>5</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=849' class='user'>GOMEZ Alejandro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>19</td>
					<td class='center'>7.21</td>
					<td class='center'>6.26</td>
					<td class='center'>27</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=850' class='user'>GRAICIAR Martin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=851' class='user'>HAN Kwang Song</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>11</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=852' class='user'>HIGUAIN Gonzalo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>15</td>
					<td class='center'>6.77</td>
					<td class='center'>5.43</td>
					<td class='center'>29</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=853' class='user'>IAGO Falque</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>16</td>
					<td class='center'>6.97</td>
					<td class='center'>6.31</td>
					<td class='center'>27</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=854' class='user'>ICARDI Mauro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>17</td>
					<td class='center'>7.85</td>
					<td class='center'>6.15</td>
					<td class='center'>38</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=855' class='user'>ILICIC Josip</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>14</td>
					<td class='center'>7.18</td>
					<td class='center'>6.07</td>
					<td class='center'>28</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=856' class='user'>IMMOBILE Ciro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>20</td>
					<td class='center'>7.83</td>
					<td class='center'>6.18</td>
					<td class='center'>38</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=857' class='user'>INGLESE Roberto</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>15</td>
					<td class='center'>7.37</td>
					<td class='center'>6.17</td>
					<td class='center'>22</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=858' class='user'>INSIGNE Roberto</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>5</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=859' class='user'>INSIGNE Lorenzo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>17</td>
					<td class='center'>7.53</td>
					<td class='center'>6.24</td>
					<td class='center'>31</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=860' class='user'>JAKUPOVIC Arnel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>2</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=861' class='user'>KALINIC Nikola</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>13</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=862' class='user'>KARAMOH Yann</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>12</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=863' class='user'>KLUIVERT Justin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>14</td>
					<td class='center'>6.32</td>
					<td class='center'>5.93</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=864' class='user'>KOUAM&Atilde; Christian</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>20</td>
					<td class='center'>6.8</td>
					<td class='center'>5.95</td>
					<td class='center'>18</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=865' class='user'>KOWNACKI Dawid</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>7</td>
					<td class='center'>5.79</td>
					<td class='center'>4.79</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=866' class='user'>LA GUMINA Antonino</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>16</td>
					<td class='center'>6.16</td>
					<td class='center'>5.31</td>
					<td class='center'>14</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=867' class='user'>LAPADULA Gianluca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=868' class='user'>LASAGNA Kevin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>18</td>
					<td class='center'>5.92</td>
					<td class='center'>5.64</td>
					<td class='center'>17</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=869' class='user'>LERIS Mehdi</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>9</td>
					<td class='center'>5.61</td>
					<td class='center'>5.67</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=870' class='user'>LOMBARDI Cristiano</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=871' class='user'>LUIS ALBERTO Romero Alconchel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>15</td>
					<td class='center'>6.03</td>
					<td class='center'>5.9</td>
					<td class='center'>23</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=872' class='user'>MACHIS Darwin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>12</td>
					<td class='center'>5.67</td>
					<td class='center'>5.67</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=873' class='user'>MALL&Atilde; Aly</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>2</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=874' class='user'>MANDZUKIC Mario</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>16</td>
					<td class='center'>8.03</td>
					<td class='center'>6.44</td>
					<td class='center'>28</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=875' class='user'>MARTINEZ Lautaro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>10</td>
					<td class='center'>6.8</td>
					<td class='center'>6.1</td>
					<td class='center'>23</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=876' class='user'>MATARESE Luca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>2</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=877' class='user'>MATRI Alessandro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>6</td>
					<td class='center'>6.5</td>
					<td class='center'>6.08</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=878' class='user'>MCHEDLIDZE Levan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>3</td>
					<td class='center'>5.83</td>
					<td class='center'>6</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=879' class='user'>MEDEIROS Iuri</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>3</td>
					<td class='center'>5.67</td>
					<td class='center'>3.67</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=880' class='user'>MEGGIORINI Riccardo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>13</td>
					<td class='center'>5.85</td>
					<td class='center'>5.73</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=881' class='user'>MERTENS Dries</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>18</td>
					<td class='center'>7.83</td>
					<td class='center'>6.25</td>
					<td class='center'>36</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=882' class='user'>MICIN Petar</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=883' class='user'>MILIK Arkadiusz</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>17</td>
					<td class='center'>8.21</td>
					<td class='center'>6.24</td>
					<td class='center'>35</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=884' class='user'>MRAZ Samuel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>4</td>
					<td class='center'>6.38</td>
					<td class='center'>5.63</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=885' class='user'>MURANO Jacopo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>2</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=886' class='user'>NIANG M'Baye</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>13</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=887' class='user'>ODGAARD Jens</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=888' class='user'>OKWONKWO Orji</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>6</td>
					<td class='center'>5.67</td>
					<td class='center'>5.67</td>
					<td class='center'>7</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=889' class='user'>ORSOLINI Riccardo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>15</td>
					<td class='center'>6.43</td>
					<td class='center'>5.97</td>
					<td class='center'>14</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=890' class='user'>OUNAS Adam</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>6</td>
					<td class='center'>7.17</td>
					<td class='center'>6.17</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=891' class='user'>PALACIO Rodrigo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>13</td>
					<td class='center'>6.62</td>
					<td class='center'>6.15</td>
					<td class='center'>16</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=892' class='user'>PALOSCHI Alberto</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>9</td>
					<td class='center'>6.44</td>
					<td class='center'>5.83</td>
					<td class='center'>15</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=893' class='user'>PANDEV Goran</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>10</td>
					<td class='center'>6.45</td>
					<td class='center'>5.3</td>
					<td class='center'>15</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=894' class='user'>PAVOLETTI Leonardo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>15</td>
					<td class='center'>7.83</td>
					<td class='center'>6.43</td>
					<td class='center'>28</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=895' class='user'>PELLISSIER Sergio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>9</td>
					<td class='center'>7.33</td>
					<td class='center'>6.28</td>
					<td class='center'>13</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=896' class='user'>PERICA Stipe</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>7</td>
					<td class='center'>5.14</td>
					<td class='center'>5.36</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=897' class='user'>PETAGNA Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>19</td>
					<td class='center'>6.74</td>
					<td class='center'>5.89</td>
					<td class='center'>18</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=898' class='user'>PETKOVIC Bruno</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>7</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=899' class='user'>PIATEK Krzysztof</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>19</td>
					<td class='center'>8.47</td>
					<td class='center'>6.24</td>
					<td class='center'>28</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=900' class='user'>PJACA Marko</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>12</td>
					<td class='center'>5.88</td>
					<td class='center'>4.71</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=901' class='user'>POLITANO Matteo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>20</td>
					<td class='center'>6.35</td>
					<td class='center'>5.95</td>
					<td class='center'>20</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=902' class='user'>PUCCIARELLI Manuel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>2</td>
					<td class='center'>5</td>
					<td class='center'>5</td>
					<td class='center'>5</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=903' class='user'>PUSSETTO Ignacio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>18</td>
					<td class='center'>6.47</td>
					<td class='center'>6.06</td>
					<td class='center'>17</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=904' class='user'>QUAGLIARELLA Fabio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>19</td>
					<td class='center'>9.03</td>
					<td class='center'>6.47</td>
					<td class='center'>42</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=905' class='user'>RODRIGUEZ Alejandro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_EMPOLI.gif'><a href='tab_squadre.php?vedi_squadra=EMPOLI'>EMPOLI</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>6</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=906' class='user'>RONALDO Cristiano</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>20</td>
					<td class='center'>8.85</td>
					<td class='center'>6.75</td>
					<td class='center'>55</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=907' class='user'>SALCEDO Eddie Mora</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=908' class='user'>SANTANDER Federico</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>18</td>
					<td class='center'>6.69</td>
					<td class='center'>5.53</td>
					<td class='center'>18</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=909' class='user'>SAU Marco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CAGLIARI.gif'><a href='tab_squadre.php?vedi_squadra=CAGLIARI'>CAGLIARI</a></td>
					<td class='center'>12</td>
					<td class='center'>5.67</td>
					<td class='center'>5.13</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=910' class='user'>SCAMACCA Gianluca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=911' class='user'>SCHICK Patrik</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>12</td>
					<td class='center'>6.08</td>
					<td class='center'>5.17</td>
					<td class='center'>16</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=912' class='user'>SILIGARDI Luca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>13</td>
					<td class='center'>6.27</td>
					<td class='center'>6.04</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=913' class='user'>SIMEONE Giovanni</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>20</td>
					<td class='center'>6</td>
					<td class='center'>5.15</td>
					<td class='center'>19</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=914' class='user'>SOTTIL Riccardo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=915' class='user'>SPINELLI Claudio</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>10</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=916' class='user'>SPROCATI Mattia</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>3</td>
					<td class='center'>5.67</td>
					<td class='center'>5.67</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=917' class='user'>STEPINSKI Mariusz</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>19</td>
					<td class='center'>6.34</td>
					<td class='center'>5.71</td>
					<td class='center'>15</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=918' class='user'>SUSO Jesus Fernandez Saez</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_MILAN.gif'><a href='tab_squadre.php?vedi_squadra=MILAN'>MILAN</a></td>
					<td class='center'>19</td>
					<td class='center'>7.21</td>
					<td class='center'>6.03</td>
					<td class='center'>26</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=919' class='user'>THEREAU Cyril</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>2</td>
					<td class='center'>5.5</td>
					<td class='center'>2.5</td>
					<td class='center'>10</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=920' class='user'>TROTTA Marcello</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>6</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=921' class='user'>TUMMINELLO Marco</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=922' class='user'>VERDE Daniele</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ROMA.gif'><a href='tab_squadre.php?vedi_squadra=ROMA'>ROMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>8</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=923' class='user'>VERDI Simone</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>6</td>
					<td class='center'>6.67</td>
					<td class='center'>6</td>
					<td class='center'>18</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=924' class='user'>VINICIUS Morais</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_NAPOLI.gif'><a href='tab_squadre.php?vedi_squadra=NAPOLI'>NAPOLI</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>3</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=925' class='user'>VIZEU Felipe</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>1</td>
					<td class='center'>5.5</td>
					<td class='center'>5.5</td>
					<td class='center'>9</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=926' class='user'>VLAHOVIC Dusan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>2</td>
					<td class='center'>5.5</td>
					<td class='center'>2.5</td>
					<td class='center'>2</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=927' class='user'>ZANIMACCHIA Luca</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=928' class='user'>ZAPATA Duvan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_ATALANTA.gif'><a href='tab_squadre.php?vedi_squadra=ATALANTA'>ATALANTA</a></td>
					<td class='center'>20</td>
					<td class='center'>8.8</td>
					<td class='center'>6.63</td>
					<td class='center'>40</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=929' class='user'>ZEKHNINI Rafik</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>0</td>
					<td class='center'>2</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=930' class='user'>BOGA Jeremie</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>6</td>
					<td class='center'>6.17</td>
					<td class='center'>6.17</td>
					<td class='center'>11</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=931' class='user'>ROSSI Alessandro</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_LAZIO.gif'><a href='tab_squadre.php?vedi_squadra=LAZIO'>LAZIO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=932' class='user'>MONCINI Gabriele</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SPAL.gif'><a href='tab_squadre.php?vedi_squadra=SPAL'>SPAL</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=933' class='user'>KEAN Moise</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_JUVENTUS.gif'><a href='tab_squadre.php?vedi_squadra=JUVENTUS'>JUVENTUS</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=934' class='user'>PINAMONTI Andrea</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>11</td>
					<td class='center'>6.41</td>
					<td class='center'>5.95</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=935' class='user'>BRIGNOLA Enrico</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SASSUOLO.gif'><a href='tab_squadre.php?vedi_squadra=SASSUOLO'>SASSUOLO</a></td>
					<td class='center'>2</td>
					<td class='center'>7</td>
					<td class='center'>5.75</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=936' class='user'>GALANO Cristian</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>12</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='C'>
					<td class='center' style='padding: 15px;'><span class='ruolo green darken-4'>C</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=937' class='user'>BIABIANY Jonathan</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>10</td>
					<td class='center'>5.65</td>
					<td class='center'>5.8</td>
					<td class='center'>9</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=938' class='user'>DALMONTE Nicola</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_GENOA.gif'><a href='tab_squadre.php?vedi_squadra=GENOA'>GENOA</a></td>
					<td class='center'>2</td>
					<td class='center'>6</td>
					<td class='center'>3</td>
					<td class='center'>4</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=939' class='user'>MIRALLAS Kevin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>13</td>
					<td class='center'>6.35</td>
					<td class='center'>5.5</td>
					<td class='center'>16</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=940' class='user'>KEITA Balde Diao</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_INTER.gif'><a href='tab_squadre.php?vedi_squadra=INTER'>INTER</a></td>
					<td class='center'>16</td>
					<td class='center'>6.69</td>
					<td class='center'>5.84</td>
					<td class='center'>24</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=941' class='user'>CAMPBELL Joel</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>15</td>
					<td class='center'>5.43</td>
					<td class='center'>5.37</td>
					<td class='center'>8</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=942' class='user'>GERVINHO </a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>13</td>
					<td class='center'>7.62</td>
					<td class='center'>6.23</td>
					<td class='center'>24</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=943' class='user'>ZAZA Simone</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_TORINO.gif'><a href='tab_squadre.php?vedi_squadra=TORINO'>TORINO</a></td>
					<td class='center'>15</td>
					<td class='center'>5.87</td>
					<td class='center'>5.63</td>
					<td class='center'>15</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=944' class='user'>TEODORCZYK Lukasz</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>8</td>
					<td class='center'>5.75</td>
					<td class='center'>5.75</td>
					<td class='center'>13</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=945' class='user'>ARDAIZ Joaquin</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FROSINONE.gif'><a href='tab_squadre.php?vedi_squadra=FROSINONE'>FROSINONE</a></td>
					<td class='center'>1</td>
					<td class='center'>5.5</td>
					<td class='center'>5.5</td>
					<td class='center'>4</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=946' class='user'>GRUBAC Sergej</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=947' class='user'>JUWARA Musa</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_CHIEVO.gif'><a href='tab_squadre.php?vedi_squadra=CHIEVO'>CHIEVO</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=948' class='user'>MASTAJ Davide</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_PARMA.gif'><a href='tab_squadre.php?vedi_squadra=PARMA'>PARMA</a></td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>0</td>
					<td class='center'>1</td>
					<td class='center'><font color='red'><b>Trasferito</b></font></td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=949' class='user'>MURIEL Luis</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_FIORENTINA.gif'><a href='tab_squadre.php?vedi_squadra=FIORENTINA'>FIORENTINA</a></td>
					<td class='center'>1</td>
					<td class='center'>14</td>
					<td class='center'>8</td>
					<td class='center'>21</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=950' class='user'>SANSONE Nicola</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_BOLOGNA.gif'><a href='tab_squadre.php?vedi_squadra=BOLOGNA'>BOLOGNA</a></td>
					<td class='center'>1</td>
					<td class='center'>6.5</td>
					<td class='center'>6.5</td>
					<td class='center'>15</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=951' class='user'>OKAKA Stefano</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_UDINESE.gif'><a href='tab_squadre.php?vedi_squadra=UDINESE'>UDINESE</a></td>
					<td class='center'>1</td>
					<td class='center'>8.5</td>
					<td class='center'>6</td>
					<td class='center'>12</td>
					<td class='center'>Mercato chiuso</td>
				</tr>
				
				
				<tr class='A'>
					<td class='center' style='padding: 15px;'><span class='ruolo red darken-4'>A</span></td>
					<td><a href='stat_calciatore.php?num_calciatore=952' class='user'>GABBIADINI Manolo</a> </td>
					<td><img class='iconasquadra z-depth-2' src='./immagini/m_SAMPDORIA.gif'><a href='tab_squadre.php?vedi_squadra=SAMPDORIA'>SAMPDORIA</a></td>
					<td class='center'>1</td>
					<td class='center'>6</td>
					<td class='center'>6</td>
					<td class='center'>16</td>
					<td class='center'>Mercato chiuso</td>
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
            <p class="grey-text text-lighten-4 left">&copy; 2019 Simone Gentile <?php echo '<?php ';?>
if ($vvm) echo "- Versione: $vvm"; <?php echo '?>';?>
</p>
            <p class="grey-text text-lighten-4 right">Pagina generata in [[[loadtime]]] secondi.</p>
		</div>
	</div></div>
</footer>


<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="inc/js/materialize.min.js"></script>

</body>
</html><?php }
}
