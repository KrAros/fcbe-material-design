<?php
	ini_set ( 'display_errors', 1 );
	$clock [] = "Inizio " . microtime ();
	if ($attiva_log == "SI") {
		$xx1 = $_SERVER ['SERVER_PORT'];
		$giorno = date ( "d", time () );
		$mese = date ( "m", time () );
		$anno = date ( "Y", time () );
		$ora = date ( "H", time () );
		$minuto = date ( "i", time () );
		if (@$_SERVER ['REMOTE_HOST'] == "")
		$visitatore_info = $_SERVER ['REMOTE_ADDR'];
		else
		$visitatore_info = $_SERVER ['REMOTE_HOST'];
		$base = "http://" . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'];
		$x1 = "host " . $_SERVER ['REMOTE_ADDR'] . "";
		$x2 = $_SERVER ['REMOTE_PORT'];
		$date = "$giorno-$mese-$anno $ora:$minuto";
		if (@$_SESSION ['utente'] == "")
		$infonome = "Visitatore";
		else
		$infonome = $_SESSION ['utente'];
		$fp = fopen ( $percorso_cartella_dati . "/log" . @$_SESSION ["torneo"] . ".txt", "a" );
		fwrite ( $fp, "$date - $infonome - $base:$xx1 - $visitatore_info\n" );
		fclose ( $fp );
	}
	
	if (strtoupper ( substr ( PHP_OS, 0, 3 ) == 'WIN' ))
	$acapo = "\r\n";
	elseif (strtoupper ( substr ( PHP_OS, 0, 3 ) == 'MAC' ))
	$acapo = "\r";
	else
	$acapo = "\n";
	
	$chiusura_giornata = INTVAL ( @file ( $percorso_cartella_dati . "/chiusura_giornata.txt" ) );
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it"
dir="ltr">
	<head>
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
		rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"
		media="screen,projection" />
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
		<link type="text/css" rel="stylesheet" href="immagini/tab.css"
		media="screen,projection" />
		<link type="text/css" rel="stylesheet" href="css/extra.css"
		media="screen,projection" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Language" content="Italian" />
		<meta name="Author"
		content="Antonello Onida - http://fantacalciobazar.sssr.it" />
		<meta name="Description"
		content="FantacalcioBazar | Il migliore gestore di Fantacalcio on line" />
		<meta name="Keywords"
		content="fantacalciobazar, fantacalcio, semplice, completo, online" />
		<meta name="Robots" content="INDEX, FOLLOW" />
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/highcharts-more.js"></script>
		<style type="text/css">
			body {
			background-color: <?php echo$sfondo_tab1?>;
			color: <?php echo$carattere_colore?>;
			font-family: <?php echo $carattere_tipo ?>;
			font-size: <?php echo$carattere_size?>
			}
			
			caption {
			background-color: <?php echo $sfondo_tab2?>
			}
			
			.menu_s a {
			background: <?php echo$sfondo_tab3?> url(immagini/vmenuarrow.gif)
			no-repeat center left;
			color: <?php echo$carattere_colore_chiaro?>
			}
		</style>
		
		<?php
			if (@$a_fm == "SI")
			echo "<link rel='stylesheet' type='text/css' href='./inc/fm_style.css' />" . $acapo;
		?>
		<!--[if lt IE 9]>
			<script src="./inc/js/jquery-1.10.2.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		<script src="./inc/js/jquery-2.0.3.min.js"></script>
		<!--<![endif]-->
		<script src="./dati/update/update.js" type="text/javascript"></script>
		<script type="text/javascript">
			/* <![CDATA[ */
			$(document).ready(function(){
				/* CONFIG */
				/* set start (sY) and finish (fY) heights for the list items */
				sY = 24;
				fY = 375;
				/* end CONFIG */
				
				/* open first list item */
				animate (fY)
				
				$("#slide .top").click(function() {
					if (this.className.indexOf('clicked') == -1 ) {
						animate(sY)
						$('.clicked').removeClass('clicked');
						$(this).addClass('clicked');
						animate(fY)
					}
				});
				
				function animate(pY) {
					$('.clicked').animate({"height": pY + "px"}, 500);
				}
				
			});
			/* ]]> */
		</script>
		
		<script>
			$(document).ready(function(){
				$('.modal').modal();
				$('.dropdown-trigger').dropdown();
			});
		</script>
		<script>
			
			$(document).ready(function(){
				$('.tooltipped').tooltip();
			});
			
			$(document).ready(function() {
				$('input#input_text, textarea#textarea2').characterCounter();
			});
			
			$(document).ready(function(){
				$('select').formSelect();
			});
		</script>
		<script>
			$(document).ready(function() {
				$("#switch_portieri").change(function() {
					if($(this).is(":checked")) {
						$(".P").show(2000)
					}
					else {
						$(".P").hide("slow")
					}
					}),$("#switch_difensori").change(function() {
					if($(this).is(":checked")) {
						$(".D").show(2000)
					}
					else {
						$(".D").hide("slow")
					}
					}),$("#switch_centrocampisti").change(function() {
					if($(this).is(":checked")) {
						$(".C").show(2000)
					}
					else {
						$(".C").hide("slow")
					}
					}),$("#switch_attaccanti").change(function() {
					if($(this).is(":checked")) {
						$(".A").show(2000)
					}
					else {
						$(".A").hide("slow")
					}
				})
			});
		</script>
		<script>
			$(document).ready(function() {
				$("#search").on("keyup", function() {
					var value = $(this).val().toUpperCase();
					$("#t1 tr").each(function(index) {
						if (index !== 1) {
							
							$row = $(this);
							
							var id = $row.find("td:nth-child(2)").text();
							
							if (id.indexOf(value) !== 0) {
								$row.hide();
							}
							else {
								$row.show();
							}
						}
					});
				})
			});
		</script>
		
		<title><?php echo $titolo_sito; ?></title>
		
	</head>
	
	<body>
		<div id="navbar" class="navbar-fixed">
			<nav class="indigo">
				<div class="nav-wrapper">
					<a href="./index.php" class="brand-logo" style="padding-left: 15px;"><?php echo $titolo_sito; ?></a>
					<?php
					
					if (@$_SESSION ['valido'] == "SI" and $_SESSION ['utente'] == $admin_user) {
						echo '<ul class="right hide-on-med-and-down">
						<li><a href="a_gestione.php"><i class="material-icons left">dashboard</i>Dashboard amministrativa</a></li>
						<li><a href="a_torneo.php"><i class="material-icons left">event_note</i>Gestione tornei</a></li>';
						if ($usa_cms == "SI")
						echo '<li><a href="a_sito.php"><i class="material-icons left">view_module</i>CMS</a></li>';
						echo '<li><a href="a_configura.php"><i class="material-icons left">build</i>Configurazione sito</a></li>
						<li><a class="dropdown-trigger" href="#!" data-target="dropdownad"><i class="material-icons left">list</i>Altre funzionalit&agrave;</a></li>
						
						
						<ul id="dropdownad" class="dropdown-content">
						<li><a href="./a_aggUtente.php">Aggiungi utenti</a></li>
						<li><a href="./a_appUtente.php">Approvazione utenti</a></li>
						<li><a href="./a_verifiche.php">Verifiche struttura</a></li>
						<li class="divider"></li>
						<li><a href="./a_upload.php">Carica voti</a></li>
						<li><a href="./a_invia_voti.php">Invia formazioni - DA FIXARE</a></li>
						<li><a href="./a_invia_risultati.php">Invia risultati - DA FIXARE</a></li>
						<li><a href="./messaggi.php">Gestione messaggi</a></li>
						<li class="divider"></li>
						<li><a href="./a_nlUtente.php">Newsletter utenti</a></li>
						<li><a href="./a_crea_sondaggio.php">Sondaggi e votazioni</a></li>
						<li><a href="./a_fm.php">File manager</a></li>
						<li><a href="./a_backup.php">Backup dati</a></li>
						<li><a href="./a_b2mail.php">Backup dati per email</a></li>
						</ul>
						
						
						<li><a href="logout.php"><i class="material-icons left">exit_to_app</i>Logout</a></li>
						</ul>';
					} 
					elseif (@$_SESSION ['valido'] == "SI") {
						$chiusura_giornata = ( int ) @file ( $percorso_cartella_dati . "/chiusura_giornata.txt" );
						$file = file ( $percorso_cartella_dati . "/utenti_" . $_SESSION ['torneo'] . ".php" );
						$linee = count ( $file );
						
						for($num1 = 1; $num1 < 40; $num1 ++) {
							if (strlen ( $num1 ) == 1)
							$num1 = "0" . $num1;
							if (@is_file ( $percorso_cartella_dati . "/giornata" . $num1 . "_" . $_SESSION ['torneo'] . "_" . $_SESSION ['serie'] ))
							$ultgio = $num1;
							else
							break;
						} // fine for $num1
						echo '<ul class="right hide-on-med-and-down">
						<li><a href="mercato.php"><i class="material-icons left">dashboard</i>Dashboard</a></li>
						<li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i class="material-icons left">security</i>Gestione<i class="material-icons right">arrow_drop_down</i></a></li>
						
						<ul id="dropdown1" class="dropdown-content">';
						if ($chiusura_giornata != 1) {
							echo "
							<li><a href='./squadra.php'>Schiera formazione</a></li>
							<li><a href='./suggteam.php'>Team consigliato</a></li>
							<li><a href='./statistiche_rosa.php?vedi_squadra=".$_SESSION['utente']."'>Statistiche rosa</a></li>";
							if ($mercato_libero == "SI" and $stato_mercato == "A") {
								echo "<li><a href='./cambi.php' >Cambi</a></li>";
							}
							if ($mercato_libero == "SI" and $stato_mercato == "A" and $trasferiti_ok == "SI") {
								echo "<li><a href='./cambi_tra.php'>Cambia Trasferiti</a></li>";
							}
							} elseif ($chiusura_giornata == 1) {
							echo "<li><a href='./squadra1.php'>Formazioni attuali</a></li>";
						}
						echo '<li class="divider"></li>';
						for($num1 = 1; $num1 < 40; $num1 ++) {
							if ($campionato ["1-$num1"] == "S") {
								echo "<li><a href='./calendario.php'>Calendario</a></li>";
								break;
							}
						} // fine for $num1
						if ($mercato_libero == "NO" or $ottipo_calcolo == "S") {
							if ($stato_mercato != "I") {
								echo "<li><a href='./classifica.php' >Classifica</a></li>";
							}
						}
						if ($stato_mercato != "I" or $stato_mercato != "R" or $stato_mercato != "B") {
							echo "<li><a href='./rose.php' >Riepilogo rose</a></li>";
							echo "<li><a href='./statistiche.php' >Statistiche</a></li>";
						}
						if ($stato_mercato == "A" or $stato_mercato == "P" or $stato_mercato == "C" or $stato_mercato == "S") {
							echo "<li><a href='./giornate.php'>Riepilogo giornate</a></li>";
						}
						if ($mercato_libero == "SI" and $stato_mercato != "I" and $ultgio != 0) {
							echo "<li><a href='./guarda_giornate.php' >Vedi tutti i voti</a></li>";
						}
						echo '</ul>
						
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
						
					<li><a class="dropdown-trigger" href="#!" data-target="dropdown4"><i class="material-icons left">account_circle</i>' . $_SESSION ['utente'] . '<i class="material-icons right">arrow_drop_down</i></a></li>
					
					
					<ul id="dropdown4" class="dropdown-content">
					<li><a href="a_modUtente.php">Modifica profilo</a></li>
					<li><a href="messaggi.php">Messaggi</a></li>
					</ul>
					
					<li><a href="logout.php"><i class="material-icons left">exit_to_app</i>Logout</a></li>
					</ul>';
					}
					?>	
					</div>
					</nav>
					</div>																																	