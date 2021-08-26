{config_load file="test.conf" section="configurazione_script"}

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
{if #a_fm# eq 'SI'}
<link rel='stylesheet' type='text/css' href='./inc/fm_style.css' />
{/if}
<title>{#titolo_sito#}</title>
<style type="text/css">
			body {
			color: {#carattere_colore#};
			font-family: {#carattere_tipo#};
			font-size: {#carattere_size#}
			}
		</style>
</head>

<body>
<div id="navbar" class="navbar-fixed">
<nav class="indigo">
<div class="nav-wrapper">
<a href="./index.php" class="brand-logo" style="padding-left: 15px;">{#titolo_sito#|capitalize}</a>

{if $smarty.session.valido eq 'SI' and $smarty.session.utente eq 'admin'}

<ul class="right hide-on-med-and-down">
<li><a href="a_gestione.php"><i class="material-icons left">dashboard</i>Dashboard amministrativa</a></li>
<li><a href="a_torneo.php"><i class="material-icons left">event_note</i>Gestione tornei</a></li>
{if #usa_cms# eq 'SI'}
<li><a href="a_sito.php"><i class="material-icons left">view_module</i>CMS</a></li>
{/if}
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

{elseif $smarty.session.valido eq 'SI'}
	
	<ul class="right hide-on-med-and-down">
	<li><a href="mercato.php"><i class="material-icons left">dashboard</i>Dashboard</a></li>
	<li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i class="material-icons left">security</i>Gestione<i class="material-icons right">arrow_drop_down</i></a></li>
	
	<ul id="dropdown1" class="dropdown-content">
	{if $chiusura_giornata neq 1}
		<li><a href='./squadra.php'>Schiera formazione</a></li>
		<li><a href='./suggteam.php'>Team consigliato</a></li>
		<li><a href='./statistiche_rosa.php?vedi_squadra={$smarty.session.utente}'>Statistiche rosa</a></li>
		{if #mercato_libero# eq 'SI' and #stato_mercato# eq 'A'}
		<li><a href='./cambi.php' >Cambi</a></li>
		{/if}
		{if #mercato_libero# eq 'SI' and #stato_mercato# eq 'A' and $trasferiti_ok eq 'SI'}
		<li><a href='./cambi_tra.php'>Cambia Trasferiti</a></li>
		{/if}
		{elseif $chiusura_giornata eq 1}
		<li><a href='./squadra1.php'>Formazioni attuali</a></li>
	{/if}
			
		<li class="divider"></li>
	
		{if #tipo_calcolo# eq 'S' }
		<li><a href='./calendario.php'>Calendario</a></li>
		{/if}
		
		{if #mercato_libero# eq 'NO' and #tipo_calcolo# eq 'S' and #stato_mercato# neq 'I'}
		<li><a href='./classifica.php' >Classifica</a></li>
		{/if}
		{if #stato_mercato# neq 'I' and #stato_mercato# neq 'R' or #stato_mercato# neq 'B'}
		<li><a href='./rose.php' >Riepilogo rose</a></li>
		<li><a href='./statistiche.php?numgio=tutte&squadra_guarda=ATALANTA&anno_guarda=cartella_remota'>Statistiche</a></li>
		{/if}
		{if #stato_mercato# eq 'A' or #stato_mercato# eq 'P' or #stato_mercato# eq 'C' or #stato_mercato# eq 'S'}
		<li><a href='./giornate.php'>Riepilogo giornate</a></li>
		{/if}
		{if #mercato_libero# eq 'SI' or #stato_mercato# neq 'I' and $ultgio neq 0}
		<li><a href='./guarda_giornate.php' >Vedi tutti i voti</a></li>
		{/if}
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
	
	<li><a class="dropdown-trigger" href="#!" data-target="dropdown4"><i class="material-icons left">account_circle</i>{$smarty.session.utente}<i class="material-icons right">arrow_drop_down</i></a></li>
	
	<ul id="dropdown4" class="dropdown-content">
	<li><a href="a_modUtente.php">Modifica profilo</a></li>
	<li><a href="messaggi.php">Messaggi</a></li>
	</ul>
	
	<li><a href="logout.php"><i class="material-icons left">exit_to_app</i>Logout</a></li>
	</ul>
	{/if}
	</div>
	</nav>
</div>										