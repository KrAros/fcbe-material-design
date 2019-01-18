<?php
	// #################################################################################
	if ($usa_cms == "SI") {
		require_once ("./dati/cms.conf.php");
		require_once ("./inc/cms.inc.php");
	}
	
	if (@is_file ( $percorso_cartella_dati . "/testi.php" ))
	$messaggi = file ( $percorso_cartella_dati . "/testi.php" );
	function ultimo_del_mese($mon, $year) {
		for($tday = 28; $tday <= 31; $tday ++) {
			$tdate = getdate ( mktime ( 0, 0, 0, $mon, $tday, $year ) );
			if ($tdate ["mon"] != $mon) {
				break;
			}
		}
		$tday --;
		
		return $tday;
	}
	
	function last_update() {
		############################################
		#### Controllo l'ultima versione disponibile
		
		$version = file_get_contents('http://pokemonoverwhelm.com/VERSION');
		$version = explode(".", $version);
		$major = $version[0];
		$minor = $version[1];
		$revision = $version[2];
		$revision = explode("-", $revision);
		$channel = $revision[1];
		$revision = $revision[0];
		$vnum = $major.$minor.$revision;
		return $vnum;
	}
	
	function local_version() {
		#################################
		#### Controllo la versione locale
		
		global $percorso_cartella_dati;
		
		$version_loc = file_get_contents($percorso_cartella_dati."/update/VERSION");
		$version_loc = explode(".", $version_loc);
		$major_loc = $version_loc[0];
		$minor_loc = $version_loc[1];
		$revision_loc = $version_loc[2];
		$revision_loc = explode("-", $revision_loc);
		$channel_loc = $revision_loc[1];
		$revision_loc = $revision_loc[0];
		$user_vnum = $major_loc.$minor_loc.$revision_loc;
		return $user_vnum;	
	}
	
	function countdown($id, $tempo) {
		echo "<style type='text/css'>@import './inc/js/jquery.countdown.css';
		#$id { width: 240px; height: 25px; }
		</style>
		<script type='text/javascript' src='./inc/js/jquery.plugin.js'></script>
		<script type='text/javascript' src='./inc/js/jquery.countdown.js'></script>
		<script type='text/javascript'>
		function serverTime() {
		var time = null;
		$.ajax({url: 'serverTime.php',
		async: false, dataType: 'text',
		success: function(text) {
		time = new Date(text);
		}, error: function(http, message, exc) {
		time = new Date();
		}});
		return time;
		}
		$(function () {
		$('#$id').countdown({until: new Date($tempo), serverSync: serverTime, compact: true, format: 'odHMS', expiryText: '<div class=$id><b>Tempo scaduto</b></div>'});
		});
		</script>";
	}
	
	function crea_calendario() {
		global $giorno, $mese, $anno, $m, $y;
		
		if ((! $_GET ['m']) || (! $_GET ['y'])) {
			$m = date ( "m", mktime () );
			$y = date ( "Y", mktime () );
		}
		
		$tmpd = getdate ( mktime ( 0, 0, 0, $m, 1, $y ) );
		$month = $tmpd ["mon"];
		if ($month == 1)
		$mese_cal = "gennaio";
		elseif ($month == 2)
		$mese_cal = "febbraio";
		elseif ($month == 3)
		$mese_cal = "marzo";
		elseif ($month == 4)
		$mese_cal = "aprile";
		elseif ($month == 5)
		$mese_cal = "maggio";
		elseif ($month == 6)
		$mese_cal = "giugno";
		elseif ($month == 7)
		$mese_cal = "luglio";
		elseif ($month == 8)
		$mese_cal = "agosto";
		elseif ($month == 9)
		$mese_cal = "settembre";
		elseif ($month == 10)
		$mese_cal = "ottobre";
		elseif ($month == 11)
		$mese_cal = "novembre";
		elseif ($month == 12)
		$mese_cal = "dicembre";
		$firstwday = $tmpd ["wday"];
		$lastday = ultimo_del_mese ( $m, $y );
		
		echo "<table summary='' cellpadding='2' cellspacing='0' border='0'>
		<tr><td colspan='7'>
		<table summary='' cellpadding='0' width='100%'>
		<tr><td width='20'><a href='" . $_SERVER ['SCRIPT_NAME'] . "?m=" . ((($m - 1) < 1) ? 12 : $m - 1) . "&amp;y=" . ((($m - 1) < 1) ? $y - 1 : $y) . "'>&lt;&lt;</a></td>
		<td align='center'><b>" . $mese_cal . " " . $y . "</b></td>
		<td width='20'><a href='" . $_SERVER ['SCRIPT_NAME'] . "?m=" . ((($m + 1) > 12) ? 1 : $m + 1) . "&amp;y=" . ((($m + 1) > 12) ? $y + 1 : $y) . "'>&gt;&gt;</a></td>
		</tr></table>
		</td></tr>
		<tr><td width='20' class='datario'><u>D</u></td><td width='20' class='datario'><u>L</u></td>
		<td width='20' class='datario'><u>M</u></td><td width='20' class='datario'><u>M</u></td>
		<td width='20' class='datario'><u>G</u></td><td width='20' class='datario'><u>V</u></td>
		<td width='20' class='datario'><u>S</u></td></tr>";
		
		$d = 1;
		$wday = $firstwday;
		$firstweek = true;
		
		/* == loop through all the days of the month == */
		while ( $d <= $lastday ) {
			
			/* == set up blank days for first week == */
			if ($firstweek) {
				echo "<tr>";
				for($i = 1; $i <= $firstwday; $i ++) {
					echo "<td><font size='2'>&nbsp;</font></td>";
				}
				$firstweek = false;
			}
			
			/* == Sunday start week with <tr> == */
			if ($wday == 0) {
				echo "<tr>";
			}
			
			/* == check for event == */
			echo "<td class='datario' align='center'>";
			if (INTVAL ( "$giorno" ) == $d and INTVAL ( "$mese" ) == $m and INTVAL ( "$anno" ) == $y)
			echo "<a href='#' class='evidenziato'>&nbsp;<b>$d</b>&nbsp;</a>";
			else
			echo "&nbsp;$d&nbsp;";
			// else echo "<a href='#'>&nbsp;$d&nbsp;</a>";
			echo "</td>\r\n";
			
			/* == Saturday end week with </tr> == */
			if ($wday == 6) {
				echo "</tr>\r\n";
			}
			
			$wday ++;
			$wday = $wday % 7;
			$d ++;
		}
		echo "</tr></table>\r\n";
	}

	function ultima_giornata_giocata() {
		global $percorso_cartella_voti;
		for($num1 = 1; $num1 < 40; $num1 ++) {
			if (strlen ( $num1 ) == 1)
			$num1 = "0" . $num1;
			$giornata = $percorso_cartella_voti . "/voti$num1.txt";
			if (@is_file ( $giornata ))
			$ultima_giornata = 0;
			else {
				$ultima_giornata = $num1 - 1;
				if (strlen ( $ultima_giornata ) == 1)
				$ultima_giornata = "0" . $ultima_giornata;
				break;
			} // fine else
		} // fine for $num1
		
		return $ultima_giornata;
	} // fine function ultima_giornata_giocata
	
	function immagine_casuale($allinea, $osp, $vsp) {
		// Parametri dx - sx - top
		global $dir_immagini, $larghezza_immagine_casuale;
		// Percorso relativo della cartella contenente le immagini
		$cartella = $dir_immagini . "/";
		// Array di tutte le estensioni valide che si vogliono caricare (bmp,gif,jpg,png)
		$estensioni = array (
		'gif',
		'jpg',
		'bmp' 
		);
		// ***************************************************//
		$dir = opendir ( $cartella ) or die ( "Attenzione, impossibile aprire la cartella " . $cartella );
		$immagini = array ();
		$misure = array ();
		while ( false !== ($file = readdir ( $dir )) ) {
			$estens = count ( $estensioni );
			for($i = 0; $i < $estens; $i ++) {
				$estensione = substr ( $file, (strlen ( $file ) - 3), strlen ( $file ) );
				if (in_array ( $estensione, $estensioni )) {
					$immagini [] = $file;
					$misure [] = getimagesize ( $cartella . $file );
				}
			}
		}
		
		if (count ( $immagini ) == 0)
		die ( "Attenzione, la cartella indicata non contiene immagini compatibili con le estensioni inserite.<br/> Provare a controllare l'esattezza delle estensioni e della directory indicata nella variabile 'cartella' o disabilitare da menu configurazione l'opzione galleria!" );
		$indice = rand ( 0, (count ( $immagini ) - 1) );
		// echo '<img src="'.$cartella.$immagini[$indice].'" '.$misure[$indice][3].' alt="'.$immagini[$indice].'" />';
		
		if ($allinea == "sx")
		$allinea1 = "align='left'";
		elseif ($allinea == "dx")
		$allinea1 = "align='right'";
		elseif ($allinea == "top")
		$allinea1 = "align='top'";
		else
		unset ( $allinea, $allinea1 );
		
		echo "<a href='" . $dir_immagini . "/index.php' title=''><img src='" . $cartella . $immagini [$indice] . "' width='" . $larghezza_immagine_casuale . "' alt='" . $immagini [$indice] . "' " . $allinea1 . " hspace='" . $osp . "' vspace='" . $vsp . "' /></a>";
	}
	function cmp($a, $b) {
		// if ($a == $b) { return 0;}
		// return ($a < $b) ? -1 : 1;
		return strcmp ( $a ["ptitolo"], $b ["ptitolo"] );
	}
	function togli_acapo($stringa) {
		$stringa = str_replace ( "\r\n", "", $stringa );
		$stringa = str_replace ( "\n", "", $stringa );
		$stringa = str_replace ( "
		", "<br />", $stringa );
		
		return $stringa;
	} // fine function togli_acapo
	function aggiusta_tag($stringa) {
		
		// tag per andare a capo e cambio colore dei font non insieme perch
		// potrebbero essere usati per far sembrare i messaggi scritti da altri
		$stringa2 = eregi_replace ( "<br", "", $stringa );
		$stringa2 = eregi_replace ( "<p", "", $stringa2 );
		$stringa3 = eregi_replace ( "<font", "", $stringa2 );
		if ($stringa != $stringa2 and $stringa2 != $stringa3) {
			$stringa = eregi_replace ( "<br/>", "", $stringa );
			$stringa = eregi_replace ( "<br/>", "", $stringa );
			$stringa = eregi_replace ( "<br />", "", $stringa );
			$stringa = eregi_replace ( "<br", "", $stringa );
			$stringa = eregi_replace ( "<p>", "", $stringa );
			$stringa = eregi_replace ( "<p", "", $stringa );
		} // fine if ($stringa != $stringa2 and $stringa2 != $stringa3)
		
		// per non inserire messaggi con tag aperti
		$stringa_minuscole = strtolower ( $stringa );
		$leggendo_tag = "NO";
		$tag_chiuso = "SI";
		$num_tag = 0;
		$nome_tag = "";
		$controtag = "";
		for($num1 = 0; $num1 < strlen ( $stringa ); $num1 ++) {
			$carattere = substr ( $stringa_minuscole, $num1, 1 );
			
			if ($leggendo_tag == "SI") {
				
				if ($primo_carattere_tag == "SI") {
					if ($carattere != "<") {
						$tag_di_chiusura = "NO";
						if (ereg_replace ( "[a-z]", "", $carattere ) != "" and $carattere != "/" and $carattere != "!" and $carattere != "?") {
							$leggendo_tag = "NO";
							$tag_chiuso = "SI";
						} // fine if ("[a-z]","",$carattere) != "" and $carattere != "/"...
						else {
							$primo_carattere_tag = "NO";
							if ($carattere == "/") {
								$tag_di_chiusura = "SI";
								$nome_tag_corrente = "";
							} // fine if ($carattere == "/")
							else {
								$num_tag ++;
								$nome_tag_corrente = $carattere;
							} // fine else if ($carattere == "/")
						} // fine else if ($carattere == " " or $carattere == ">")
					} // fine if ($carattere != "<")
				} // fine if ($primo_carattere_tag == "SI")
				
				else {
					if ($leggendo_nome_tag == "SI") {
						if ($carattere != " " and $carattere != ">")
						$nome_tag_corrente .= $carattere;
						else {
							$leggendo_nome_tag = "NO";
							if ($tag_di_chiusura == "NO")
							$nome_tag [$num_tag] = $nome_tag_corrente;
							else {
								for($num2 = $num_tag; $num2 > 0; $num2 --) {
									// echo $nome_tag[$num2]." $nome_tag_corrente<br/>";
									if ($nome_tag [$num2] == $nome_tag_corrente and $controtag [$num2] != 1) {
										$controtag [$num2] = 1;
										break;
									} // fine if ($nome_tag[$num2] == $nome_tag_corrente and $controtag[$num2] != 1)
								} // fine for $num2
							} // fine else if ($tag_di_chiusura == "NO")
						} // fine else if ($carattere != " " and $carattere != ">")
					} // fine if ($leggendo_nome_tag == "SI")
					if ($carattere == ">") {
						$leggendo_tag = "NO";
						$tag_chiuso = "SI";
					} // fine if ($carattere == ">")
				} // fine else if ($primo_carattere_tag == "SI")
			} // fine if ($leggendo_tag == "SI")
			
			else {
				if ($carattere == "<") {
					$leggendo_tag = "SI";
					$leggendo_nome_tag = "SI";
					$tag_chiuso = "NO";
					$primo_carattere_tag = "SI";
				} // fine if ($carattere == "<")
			} // fine else if ($leggendo_tag == "SI")
		} // fine for $num1
		
		if ($tag_chiuso == "NO") {
			$stringa .= ">";
			if ($leggendo_nome_tag == "SI") {
				if ($tag_di_chiusura == "NO")
				$nome_tag [$num_tag] = $nome_tag_corrente;
				else {
					for($num2 = $num_tag; $num2 > 0; $num2 --) {
						if ($nome_tag [$num2] == $nome_tag_corrente and $controtag [$num2] != 1) {
							$controtag [$num2] = 1;
							break;
						} // fine if ($nome_tag[$num2] == $nome_tag_corrente and $controtag[$num2] != 1)
					} // fine for $num2
				} // fine else if ($tag_di_chiusura == "NO")
			} // fine if ($leggendo_nome_tag == "SI")
		} // fine if ($tag_chiuso == "NO")
		for($num1 = $num_tag; $num1 > 0; $num1 --) {
			if ($controtag [$num1] != 1 and $nome_tag [$num1] != "br" and $nome_tag [$num1] != "p") {
				$stringa .= "</" . $nome_tag [$num1] . ">";
			} // fine if ($controtag[$num1] != 1)
		} // fine for $num1
		
		return $stringa;
	} // fine function aggiusta_tag
	function num_pag($total_pages, $current = 1) {
		$url_bar = $_SERVER ['PHP_SELF'] . "?" . $_SERVER ['QUERY_STRING'];
		$url_bar = preg_replace ( "/(shoutbox_page=[1-9]+)/", "", $url_bar );
		$buffer = "Pagina: <select onchange=\"javascript:location.href='" . $url_bar . "shoutbox_page='+this.value;\">\r\n";
		
		for($i = 1; $i <= $total_pages; $i ++) {
			$selected = "";
			
			if ($current == $i)
			$selected = "selected='selected'";
			
			$buffer .= "<option value='" . $i . "' " . $selected . ">" . $i . "</option>\r\n";
		}
		$buffer .= "</select>\r\n";
		
		return $buffer;
	}
	function mostra_shoutbox($height = "150", $width = "96%", $per_page = "3", $caratteri_sicurezza = 5, $border = "border:1px #DDDDDD solid;", $font_family = "tahoma", $font_size = "9") {
		global $db_sb, $admin_user, $admin_nome;
		
		if (isset ( $_GET ['shoutbox_page'] ))
		$shoutbox_page = $_GET ['shoutbox_page'];
		
		if (empty ( $_GET ['shoutbox_page'] ))
		$shoutbox_page = 1;
		
		$file = $db_sb;
		$output_buffer = "";
		$shouts = array ();
		
		if (@filesize ( $file )) {
			$fp = fopen ( $file, "r" );
			$fp1 = fread ( $fp, filesize ( $file ) );
			$shouts = explode ( "\r\n", $fp1 );
			$total_shouts = count ( $shouts );
			$total_pages = ceil ( $total_shouts / $per_page );
			$shout_pointer = (($total_shouts - ($shoutbox_page * $per_page)) + $per_page) - 1;
			
			if ($shoutbox_page > $total_pages)
			$shoutbox_page = 1;
			
			$output_buffer .= num_pag ( $total_pages, $shoutbox_page );
			} else {
			$shouts = 0;
			$total_shouts = 0;
			$shout_pointer = 0;
			$output_buffer .= num_pag ( 1, 1 );
		}
		
		for($i = $shout_pointer; $i > ($shout_pointer - $per_page); $i --) {
			if ($i > - 1) {
				if ($shouts [$i])
				list ( $name, $email, $date, $shout ) = explode ( "|", $shouts [$i] );
				
				if (! empty ( $name )) {
					$email_start = "";
					$email_end = "";
					
					if (! empty ( $email )) {
						$email_start = "<a href='mailto:" . $email . "'>";
						$email_end = "</a>";
					}
					$output_buffer .= "<br /><strong>" . $email_start . $name . $email_end . "</strong>\r\n<br />" . $shout . "<br />\r\n";
				}
			}
		}
		
		if ($_SESSION ['utente'] == $admin_user)
		$smsNome = $admin_nome;
		elseif (isset ( $_SESSION ['utente'] ))
		$smsNome = $_SESSION ['utente'];
		else
		$smsNome = "Nome";
		
		echo "<form method='post' action='" . $_SERVER ['PHP_SELF'] . "'>
		<table summary='SMS' align='center' style='font-family:$font_family; font-size:$font_sizepx; width:$width;'>
		<caption> S M S </caption>
		<tr>
		<td style='$border font-family:$font_family; font-size:$font_sizepx;  margin: 2px; padding: 2px; height:$height; overflow:auto;'>
		$output_buffer
		</td>
		</tr>
		<tr>
		<td>
		<input type='text' size='15' maxlength='15' name='nome' value='$smsNome' style='$border; font-family:$font_family; font-size:$font_sizepx; width:100%;' onfocus='this.select();' /><br />
		<input type='hidden' name='email' value='Email' />
		<input type='hidden' name='azione' value='aggiungi' />
		<input type='text' size='15' maxlength='100' name='messaggio' value='Messaggio' style='$border font-family:$font_family; font-size:$font_sizepx; width:100%;' onfocus='this.select();' /><br />
		</td>
		</tr>
		<tr><td valign='middle'>
		<img src='./inc/captcha.inc.php?width=80&amp;height=30&amp;characters=$caratteri_sicurezza' alt='Codice sicurezza'/>
		NoSpam: <input name='security_code' type='text' size=$caratteri_sicurezza maxlength=$caratteri_sicurezza style='$border; font-family:$font_family; font-size:$font_sizepx;' onfocus='this.select();' />
		</td>
		</tr>
		<tr>
		<td align='center'>
		<input type='submit' value='Invia' style='$border font-family:$font_family; font-size:$font_sizepx;' />
		</td>
		</tr>
		</table></form>";
	}
	function select_vedi_tornei() {
		global $percorso_cartella_dati;
		$vedi_tornei_attivi = "<select name='itorneo'>";
		$tornei = @file ( $percorso_cartella_dati . "/tornei.php" );
		$num_tornei = 0;
		for($num1 = 0; $num1 < count ( $tornei ); $num1 ++) {
			$num_tornei ++;
		}
		
		for($num1 = 1; $num1 < $num_tornei; $num1 ++) {
			@list ( $otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema, $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza ) = explode ( ",", $tornei [$num1] );
			
			$vedi_tornei_attivi .= "<option value='$otid'>$otdenom</option>";
		} // fine for $num1
		
		$vedi_tornei_attivi .= "</select>";
		echo $vedi_tornei_attivi;
	}
	function ricerca_estesa($testo, $termini, $op) {
		$termini = trim ( $termini );
		$ricerca_arr = explode ( " ", $termini, strlen ( $termini ) );
		switch ($op) {
			case "ogni" :
			{
				foreach ( $ricerca_arr as $chiavi_ricerca ) {
					if (stristr ( strip_tags ( $testo ), $chiavi_ricerca )) {
						return true;
					}
				}
				break;
			}
			case "tutti" :
			{
				$all_present = true;
				foreach ( $ricerca_arr as $chiavi_ricerca ) {
					if (! stristr ( strip_tags ( $testo ), $chiavi_ricerca )) {
						$all_present = false;
						break;
					}
				}
				if ($all_present)
				return true;
				break;
			}
			case "esatta" :
			{
				if (strstr ( strip_tags ( $testo ), $termini ))
				return true;
				break;
			}
		}
		return false;
	}
	function form_contatti() {
		global $sfondo_tab;
		
		if ($contatti == "invia") {
			$key = array ();
			$val = array ();
			$output = "";
			$senderNames = array (
			$senderNames 
			);
			
			foreach ( $_POST as $chiave => $valore ) {
				// <Input type=qualunque name=chiave value=valore>
				
				array_push ( $key, $chiave );
				array_push ( $val, eregi_replace ( "\\\\'", "'", $valore ) );
				
				if (! empty ( $emailField )) {
					if ($chiave == $emailField) {
						$emailMittente = $valore;
					}
				}
				
				if (! empty ( $subjectField )) {
					if ($chiave == $subjectField) {
						$subject = $valore;
					}
				}
				
				if (! empty ( $senderNames )) {
					for($i = 0; $i < count ( $senderNames ); $i ++) {
						if ($chiave == $senderNames [$i]) {
							$nome .= $valore . " ";
						}
					}
				}
			}
			
			if (! empty ( $subject )) {
				$oggetto .= " - " . $subject;
			}
			
			if ($html) {
			$output = getHtmlOutput ( $key, $val );
			
			$intestazioni = "MIME-Version: 1.0\r\n";
			$intestazioni .= "Content-type: text/html; charset=iso-8859-1\r\n";
			} else {
			for($i = 0; $i < count ( $key ); $i ++) {
			$output .= $key [$i] . ": " . $val [$i] . "\r\n";
			}
			
			$intestazioni = "";
			}
			
			if ((! empty ( $emailMittente )) || (! empty ( $nome ))) {
			$intestazioni .= "From: " . $nome . "<" . $emailMittente . "> \r\n";
			} else {
			$intestazioni .= "From: " . $mittente . "\r\n";
			}
			
			if (! mail ( $destinatari, $oggetto, $output, $intestazioni )) {
			echo "<br/>" . $messaggioErrore . "<br/><br/><br/>" . getHtmlOutput ( $key, $val ) . "<br/><br/><br/>" . getCredits ();
			
			if (strlen ( $paginaErrore ) < 5) {
			exit ();
			} else {
			echo "<META HTTP-EQUIV=Refresh CONTENT=\"10; URL=" . $paginaErrore . "\">";
			}
			}
			
			echo "<br/>" . $messaggioConferma . "<br/><br/><br/>" . getHtmlOutput ( $key, $val ) . "<br/><br/><br/>" . getCredits ();
			
			if (strlen ( $paginaConferma ) < 5) {
			exit ();
			} else {
			echo "<META HTTP-EQUIV=Refresh CONTENT=\"10; URL=" . $paginaConferma . "\">";
			}
			} else {
			echo "<center>
			<form method='POST' action='" . $_SERVER ['PHP_SELF'] . "'>
			<input type='hidden' name='q' value='98' />
			<input type='hidden' name='contatti' value='invia' />
			<table  summary=''border='0' cellpadding='3' cellspacing='3' style='border-collapse: collapse' bordercolor='$sfondo_tab' width='450'>
			<colgroup span=1 style='font-family: Verdana; font-size:10pt; font-color: navy; text-align: right'></colgroup>
			<tr>
			<td>
			Nome:
			</td>
			<td>
			<input type='text' name='nome' size='25' /></td>
			</tr>
			<tr>
			<td>Cognome: </td>
			<td>
			<input type='text' name='cognome' size='25' /></td>
			</tr>
			<tr>
			<td>Email: </td>
			<td>
			<input type='text' name='email' size='25' /></td>
			</tr>
			<tr>
			<td>Commento: </td>
			<td><textarea rows='8' name='commento' cols='21'></textarea></td>
			</tr>
			</table>
			<br/><input type='submit' value='Invia' /><br/>
			</form></center>";
			}
			}
			function getHtmlOutput($k, $v) {
			$stripsHtml = 1; // Se settato a 1, toglie tutti i tag html presenti negli input prima di visualizzarlo graficamente. E' possibile specificare quali tag permettere. Se a 0 permette tag html
			$tagAllowed = "<b><i><br><br/><u>"; // Specifica quali tag html sono permessi nel caso in cui il parametro di sopra sia settato a 1
			
			$return = "<center><div style=\"width: 322; height: 147; text-align: center\">";
			$return .= "<fieldset style=\"font-family: Verdana; font-size: 10pt; color: #008080; font-weight: bold; border: 3px double #F3C65C; background-color: #F4F5FF\">";
			$return .= "<legend align='center'>Dati inseriti</legend>";
			$return .= "<table summary='' border=0 cellpadding=3 style=\"border-collapse: collapse; font-family:Verdana; font-size:10pt; color:#4062EA\" bordercolor=#111111 cellspacing=5 width=300>";
			$return .= "<colgroup span=1 style=\"text-align:right; font-weight: bold; background-color: #DDE8FF\"></colgroup>";
			
			for($i = 0; $i < count ( $k ); $i ++) {
			$v [$i] = eregi_replace ( "\r\n", "<br/>", $v [$i] );
			
			if ($stripsHtml) {
			$v [$i] = strip_tags ( $v [$i], $tagAllowed );
			}
			
			$return .= "<tr><td width=\"30%\">" . $k [$i] . ": </td><td>" . $v [$i] . "</td></tr>";
			}
			
			$return .= "</table></fieldset></div></center>";
			
			return $return;
			}
			function ultimi10() {
			global $percorso_cartella_dati;
			$files = array ();
			$dhandle = opendir ( $percorso_cartella_dati . "/messaggi" ) or die ( "impossibile aprire la directory dei messaggi" );
			while ( $filei = readdir ( $dhandle ) ) {
			if (($filei == ".") || ($filei == "..") || ($filei == "index.php")) {
			} else {
			array_push ( $files, $filei );
			}
			}
			
			rsort ( $files );
			reset ( $files );
			
			for($x = 0; $x < 10; $x ++) {
			$dato = $files [$x];
			
			if ($dato != "") {
			$topic = file ( $percorso_cartella_dati . "/messaggi/$dato" );
			$topicinfo = explode ( "|", $topic [0] );
			echo "- <a href='messaggi.php?a=topic&amp;topic=" . substr ( $dato, 0, strlen ( $dato ) - 4 ) . "'>" . $topicinfo [0] . "</a><br />";
			}
			}
			}
			function read_dir($dir, $type = 'both', $extra = false) {
			$info = array ();
			$dh = opendir ( $dir );
			$infod = array ();
			$infof = array ();
			while ( $lm_name = readdir ( $dh ) ) {
			
			if ($lm_name == "." || $lm_name == "..")
			continue;
			
			if (is_dir ( "$dir/$lm_name" ) && ($type == 'dir' || $type == 'both')) {
			if ($extra) {
			$tinfo ['id'] = $lm_name . "/";
			$tinfo ['path'] = $dir . $lm_name . "/";
			$tinfo ['size'] = 'NA';
			$tinfo ['perms'] = getPerms ( fileperms ( $tinfo ['path'] ) );
			$tinfo ['created'] = filectime ( "$dir/$lm_name" );
			$infod [] = $tinfo;
			} else
			$infod [] = $lm_name;
			}
			
			if (is_file ( "$dir/$lm_name" ) && ($type == 'file' || $type == 'both')) {
			if ($extra) {
			$tinfo ['id'] = $lm_name;
			$tinfo ['path'] = $dir . '/' . $lm_name;
			$tinfo ['size'] = filesize ( "$dir/$lm_name" );
			$tinfo ['perms'] = getPerms ( fileperms ( $tinfo ['path'] ) );
			$tinfo ['created'] = filectime ( "$dir/$lm_name" );
			$infof [] = $tinfo;
			} else
			$infof [] = $lm_name;
			}
			}
			$info = array_merge ( $infod, $infof );
			return $info;
			}
			function controlla_ug() {
			global $percorso_cartella_dati;
			for($num1 = 1; $num1 < 40; $num1 ++) {
			if (strlen ( $num1 ) == 1)
			$num1 = "0" . $num1;
			$giornata = "giornata" . $num1 . "_" . $_SESSION ['torneo'] . "_" . $_SESSION ['serie'];
			if (@is_file ( $percorso_cartella_dati . "/" . $giornata ))
			$ultima_giornata = "";
			else {
			$ultima_giornata = $num1 - 1;
			if (strlen ( $ultima_giornata ) == 1)
			$ultima_giornata = "0" . $ultima_giornata;
			break;
			} // fine else
			} // fine for $num1
			
			return $ultima_giornata;
			} // fine function ultima_giornata_giocata
			
			// ################################################################
			// #############################################################################
			// Ricerca Binaria sostituisce la for nel cerca dei giocatori
			// in max 10 cicli trova la riga del giocatore
			// da utilizzare pero solo su file ordinati
			// quindi se non ordinati ardinarli prima con l'istruzione
			// es. sort($calciatori,SORT_NUMERIC);
			// Parametri: file-> file ordinatovoti
			// conta -> numero righe presenti
			// numero_da_cercare -> numero del giocatore da cercare
			// tipo -> voti,calciatori,mercato (opzionale per i primi due tipi che hanno lo stesso formato )
			// Ritorna: numoro riga corrispondente al giocatore trovato
			// Ritorna -1 se non lo ha trovato il numero nel file
			// by luigi_anselmi@hotmail.com aka (giggios)
			// 29-08-2007 aggiornata by luigi_anselmi@hotmail.com aka (giggios)
			// Inserito parametro tipo
			// che ci permette di usarla anche per il file mercato.txt previa
			// ordinamento e passagio marametro tipo="mercato".
			// Inserite due possibili ottimizzazioni di ricerca che pervedono
			// l'inerimento in dati.php delle due variabili:
			// $ric_binaria_ottimizzata01="SI";
			// Tiente presente la struttura di codifica del file voti e/o mcc
			// e della media delle righe per determinate le posizioni del file
			// da elaborare e le posizioni del file da qui partire.
			// $ric_binaria_ottimizzata02"SI";
			// tiente presente la sequenzialita dei ruoli del file voti e/o mcc
			// es.101,102 ecc
			// ed esegue un tentativo di ricerca per sequenzialita
			// #le prestazioni della ricerca (con questi due parametri impostati)
			// #salgono a soli due cicli per i calciatori trovati e nove per quelli
			// # non presenti
			// fate qualche prova e ditemi
			// ###########################################################################
			function ricerca_binaria($file, $conta, $numero_da_cercare, $tipo = "voti") {
			global $ric_binaria_ottimizzata01, $ric_binaria_ottimizzata02;
			$l_ric_binaria_ottimizzata02 = 0;
			if (strtolower ( $tipo ) == "voti" or strtolower ( $tipo ) == "calciatori" or strtolower ( $tipo ) == 'mcc') {
			global $separatore_campi_file_voti, $num_colonna_numcalciatore_file_voti;
			$separatore_campi = $separatore_campi_file_voti;
			$num_colonna_numcalciatore = $num_colonna_numcalciatore_file_voti - 1;
			} else { // mercato
			$separatore_campi = ",";
			$num_colonna_numcalciatore = 0;
			}
			//
			$basso = 0;
			//
			$alto = intval ( $conta - 1 );
			$medio = 0;
			$xx_num_calciatore = 0;
			$riga_return = - 1;
			$ap_conta = 0;
			//
			while ( $basso <= $alto ) {
			$ap_conta ++;
			if (($ric_binaria_ottimizzata01 == "SI" and $ap_conta == 1 and $conta >= 540) and (strtolower ( $tipo ) == "voti" or strtolower ( $tipo ) == "calciatori" or strtolower ( $tipo ) == 'mcc')) {
			if ($numero_da_cercare > 100 and $numero_da_cercare <= 200) {
			$basso = 0;
			$medio = 50;
			$alto = 101;
			} elseif ($numero_da_cercare >= 201 and $numero_da_cercare <= 500) {
			$basso = 50;
			$medio = 130;
			$alto = 400;
			} elseif ($numero_da_cercare >= 501 and $numero_da_cercare <= 800) {
			$basso = 230;
			$medio = 400;
			$alto = 700;
			} elseif ($numero_da_cercare >= 801 and $numero_da_cercare <= 999) {
			$basso = 400;
			$medio = 600;
			$alto = 900;
			} else
			$medio = intval ( ($basso + $alto) / 2 );
			//
			if ($alto >= $conta)
			$alto = intval ( $conta - 1 );
			if ($medio >= $conta)
			$medio = intval ( ($basso + $alto) / 2 );
			if ($basso >= $conta)
			$basso = 0;
			} elseif ($ap_conta == 1)
			$medio = intval ( ($basso + $alto) / 2 );
			else {
			$medio = intval ( ($basso + $alto) / 2 );
			}
			//
			$dati_voto = explode ( $separatore_campi, $file [$medio] );
			$xx_num_calciatore = $dati_voto [$num_colonna_numcalciatore];
			$xx_num_calciatore = trim ( $xx_num_calciatore );
			//
			// per la verifica delloscript
			// echo "tipo: $tipo conta: $ap_conta medio: $medio basso: $basso alto: $alto ** $numero_da_cercare == $xx_num_calciatore<br>";
			//
			if (($ric_binaria_ottimizzata02 == "SI" and $l_ric_binaria_ottimizzata02 == 0 and $numero_da_cercare != $xx_num_calciatore) and (strtolower ( $tipo ) == "voti" or strtolower ( $tipo ) == "calciatori" or strtolower ( $tipo ) == 'mcc')) {
			if (($numero_da_cercare > 100 and $numero_da_cercare <= 200 and $xx_num_calciatore > 100 and $xx_num_calciatore <= 200) or ($numero_da_cercare >= 201 and $numero_da_cercare <= 500 and $xx_num_calciatore > 201 and $xx_num_calciatore <= 500) or ($numero_da_cercare >= 501 and $numero_da_cercare <= 800 and $xx_num_calciatore > 501 and $xx_num_calciatore <= 800) or ($numero_da_cercare >= 801 and $numero_da_cercare <= 999 and $xx_num_calciatore > 801 and $xx_num_calciatore <= 999)) {
			$ap_conta ++;
			$l_ric_binaria_ottimizzata02 ++;
			// echo "*tipo: $tipo conta: $ap_conta medio: $medio ** $numero_da_cercare == $xx_num_calciatore Differenza: ".($numero_da_cercare-$xx_num_calciatore)." ". "<br>";
			$ap_medio = ($numero_da_cercare - $xx_num_calciatore) + $medio;
			if ($ap_medio <= ($conta - 1)) {
			$dati_voto = explode ( $separatore_campi, $file [$ap_medio] );
			$ap_xx_num_calciatore = $dati_voto [$num_colonna_numcalciatore];
			$ap_xx_num_calciatore = trim ( $ap_xx_num_calciatore );
			// echo "**tipo: $tipo conta: $ap_conta medio: $ap_medio ** $numero_da_cercare == $ap_xx_num_calciatore<br>";
			if ($numero_da_cercare == $ap_xx_num_calciatore) {
			$riga_return = $ap_medio;
			break;
			}
			}
			}
			}
			//
			if ($numero_da_cercare == $xx_num_calciatore) {
			$riga_return = $medio;
			break;
			} elseif ($numero_da_cercare < $xx_num_calciatore)
			$alto = ($medio - 1);
			elseif ($numero_da_cercare > $xx_num_calciatore)
			$basso = ($medio + 1);
			//
			if ($ap_conta >= $conta)
			break;
			//
			} // while($basso <= $alto)
			return ($riga_return);
			} // end ricerca_binaria
			function pr($val) {
			echo "<u>DEBUG:</u><br /><pre style='text-align: left; border: 1px solid navy; background-color: white; padding: 5px'>";
			print_r ( $val );
			echo "</pre>";
			}
			class createZip {
			public $compressedData = array ();
			public $centralDirectory = array (); // central directory
			public $endOfCentralDirectory = "\x50\x4b\x05\x06\x00\x00\x00\x00"; // end of Central directory record
			public $oldOffset = 0;
			
			/**
			* Function to create the directory where the file(s) will be unzipped
			*
			* @param $directoryName string
			*
			*/
			public function addDirectory($directoryName) {
			$directoryName = str_replace ( "\\", "/", $directoryName );
			
			$feedArrayRow = "\x50\x4b\x03\x04";
			$feedArrayRow .= "\x0a\x00";
			$feedArrayRow .= "\x00\x00";
			$feedArrayRow .= "\x00\x00";
			$feedArrayRow .= "\x00\x00\x00\x00";
			
			$feedArrayRow .= pack ( "V", 0 );
			$feedArrayRow .= pack ( "V", 0 );
			$feedArrayRow .= pack ( "V", 0 );
			$feedArrayRow .= pack ( "v", strlen ( $directoryName ) );
			$feedArrayRow .= pack ( "v", 0 );
			$feedArrayRow .= $directoryName;
			
			$feedArrayRow .= pack ( "V", 0 );
			$feedArrayRow .= pack ( "V", 0 );
			$feedArrayRow .= pack ( "V", 0 );
			
			$this->compressedData [] = $feedArrayRow;
			
			$newOffset = strlen ( implode ( "", $this->compressedData ) );
			
			$addCentralRecord = "\x50\x4b\x01\x02";
			$addCentralRecord .= "\x00\x00";
			$addCentralRecord .= "\x0a\x00";
			$addCentralRecord .= "\x00\x00";
			$addCentralRecord .= "\x00\x00";
			$addCentralRecord .= "\x00\x00\x00\x00";
			$addCentralRecord .= pack ( "V", 0 );
			$addCentralRecord .= pack ( "V", 0 );
			$addCentralRecord .= pack ( "V", 0 );
			$addCentralRecord .= pack ( "v", strlen ( $directoryName ) );
			$addCentralRecord .= pack ( "v", 0 );
			$addCentralRecord .= pack ( "v", 0 );
			$addCentralRecord .= pack ( "v", 0 );
			$addCentralRecord .= pack ( "v", 0 );
			$ext = "\x00\x00\x10\x00";
			$ext = "\xff\xff\xff\xff";
			$addCentralRecord .= pack ( "V", 16 );
			
			$addCentralRecord .= pack ( "V", $this->oldOffset );
			$this->oldOffset = $newOffset;
			
			$addCentralRecord .= $directoryName;
			
			$this->centralDirectory [] = $addCentralRecord;
			}
			
			/**
			* Function to add file(s) to the specified directory in the archive
			*
			* @param $directoryName string
			*
			*/
			public function addFile($data, $directoryName) {
			$directoryName = str_replace ( "\\", "/", $directoryName );
			
			$feedArrayRow = "\x50\x4b\x03\x04";
			$feedArrayRow .= "\x14\x00";
			$feedArrayRow .= "\x00\x00";
			$feedArrayRow .= "\x08\x00";
			$feedArrayRow .= "\x00\x00\x00\x00";
			
			$uncompressedLength = strlen ( $data );
			$compression = crc32 ( $data );
			$gzCompressedData = gzcompress ( $data );
			$gzCompressedData = substr ( substr ( $gzCompressedData, 0, strlen ( $gzCompressedData ) - 4 ), 2 );
			$compressedLength = strlen ( $gzCompressedData );
			$feedArrayRow .= pack ( "V", $compression );
			$feedArrayRow .= pack ( "V", $compressedLength );
			$feedArrayRow .= pack ( "V", $uncompressedLength );
			$feedArrayRow .= pack ( "v", strlen ( $directoryName ) );
			$feedArrayRow .= pack ( "v", 0 );
			$feedArrayRow .= $directoryName;
			
			$feedArrayRow .= $gzCompressedData;
			
			$feedArrayRow .= pack ( "V", $compression );
			$feedArrayRow .= pack ( "V", $compressedLength );
			$feedArrayRow .= pack ( "V", $uncompressedLength );
			
			$this->compressedData [] = $feedArrayRow;
			
			$newOffset = strlen ( implode ( "", $this->compressedData ) );
			
			$addCentralRecord = "\x50\x4b\x01\x02";
			$addCentralRecord .= "\x00\x00";
			$addCentralRecord .= "\x14\x00";
			$addCentralRecord .= "\x00\x00";
			$addCentralRecord .= "\x08\x00";
			$addCentralRecord .= "\x00\x00\x00\x00";
			$addCentralRecord .= pack ( "V", $compression );
			$addCentralRecord .= pack ( "V", $compressedLength );
			$addCentralRecord .= pack ( "V", $uncompressedLength );
			$addCentralRecord .= pack ( "v", strlen ( $directoryName ) );
			$addCentralRecord .= pack ( "v", 0 );
			$addCentralRecord .= pack ( "v", 0 );
			$addCentralRecord .= pack ( "v", 0 );
			$addCentralRecord .= pack ( "v", 0 );
			$addCentralRecord .= pack ( "V", 32 );
			
			$addCentralRecord .= pack ( "V", $this->oldOffset );
			$this->oldOffset = $newOffset;
			
			$addCentralRecord .= $directoryName;
			
			$this->centralDirectory [] = $addCentralRecord;
			}
			
			/**
			* Fucntion to return the zip file
			*
			* @return zipfile (archive)
			*/
			public function getZippedfile() {
			$data = implode ( "", $this->compressedData );
			$controlDirectory = implode ( "", $this->centralDirectory );
			
			return $data . $controlDirectory . $this->endOfCentralDirectory . pack ( "v", sizeof ( $this->centralDirectory ) ) . pack ( "v", sizeof ( $this->centralDirectory ) ) . pack ( "V", strlen ( $controlDirectory ) ) . pack ( "V", strlen ( $data ) ) . "\x00\x00";
			}
			}
			
			define ( 'MSB_VERSION', '1.0.0' );
			
			define ( 'MSB_NL', "\r\n" );
			
			define ( 'MSB_STRING', 0 );
			define ( 'MSB_DOWNLOAD', 1 );
			define ( 'MSB_SAVE', 2 );
			class MySQL_Backup {
			var $server = 'localhost';
			var $port = 3306;
			var $username = 'root';
			var $password = '';
			var $database = '';
			var $link_id = - 1;
			var $connected = false;
			var $tables = array ();
			var $drop_tables = true;
			var $struct_only = false;
			var $comments = true;
			var $backup_dir = '';
			var $fname_format = 'd_m_y__H_i_s';
			var $error = '';
			function Execute($task = MSB_STRING, $fname = '', $compress = false) {
			if (! ($sql = $this->_Retrieve ())) {
			return false;
			}
			if ($task == MSB_SAVE) {
			if (empty ( $fname )) {
			$fname = $this->backup_dir;
			$fname .= date ( $this->fname_format );
			$fname .= ($compress ? '.sql.gz' : '.sql');
			}
			return $this->_SaveToFile ( $fname, $sql, $compress );
			} elseif ($task == MSB_DOWNLOAD) {
			if (empty ( $fname )) {
			$fname = date ( $this->fname_format );
			$fname .= ($compress ? '.sql.gz' : '.sql');
			}
			return $this->_DownloadFile ( $fname, $sql, $compress );
			} else {
			return $sql;
			}
			}
			function _Connect() {
			$value = false;
			if (! $this->connected) {
			$host = $this->server . ':' . $this->port;
			$this->link_id = mysql_connect ( $host, $this->username, $this->password );
			}
			if ($this->link_id) {
			if (empty ( $this->database )) {
			$value = true;
			} elseif ($this->link_id !== - 1) {
			$value = mysql_select_db ( $this->database, $this->link_id );
			} else {
			$value = mysql_select_db ( $this->database );
			}
			}
			if (! $value) {
			$this->error = mysql_error ();
			}
			return $value;
			}
			function _Query($sql) {
			if ($this->link_id !== - 1) {
			$result = mysql_query ( $sql, $this->link_id );
			} else {
			$result = mysql_query ( $sql );
			}
			if (! $result) {
			$this->error = mysql_error ();
			}
			return $result;
			}
			function _GetTables() {
			$value = array ();
			if (! ($result = $this->_Query ( 'SHOW TABLES' ))) {
			return false;
			}
			while ( $row = mysql_fetch_row ( $result ) ) {
			if (empty ( $this->tables ) || in_array ( $row [0], $this->tables )) {
			$value [] = $row [0];
			}
			}
			if (! sizeof ( $value )) {
			$this->error = 'No tables found in database.';
			return false;
			}
			return $value;
			}
			function _DumpTable($table) {
			$value = '';
			$this->_Query ( 'LOCK TABLES ' . $table . ' WRITE' );
			if ($this->comments) {
			$value .= '#' . MSB_NL;
			$value .= '# Table structure for table `' . $table . '`' . MSB_NL;
			$value .= '#' . MSB_NL . MSB_NL;
			}
			if ($this->drop_tables) {
			$value .= 'DROP TABLE IF EXISTS `' . $table . '`;' . MSB_NL;
			}
			if (! ($result = $this->_Query ( 'SHOW CREATE TABLE ' . $table ))) {
			return false;
			}
			$row = mysql_fetch_assoc ( $result );
			$value .= str_replace ( "\n", MSB_NL, $row ['Create Table'] ) . ';';
			$value .= MSB_NL . MSB_NL;
			if (! $this->struct_only) {
			if ($this->comments) {
			$value .= '#' . MSB_NL;
			$value .= '# Dumping data for table `' . $table . '`' . MSB_NL;
			$value .= '#' . MSB_NL . MSB_NL;
			}
			
			$value .= $this->_GetInserts ( $table );
			}
			$value .= MSB_NL . MSB_NL;
			$this->_Query ( 'UNLOCK TABLES' );
			return $value;
			}
			function _GetInserts($table) {
			$value = '';
			if (! ($result = $this->_Query ( 'SELECT * FROM ' . $table ))) {
			return false;
			}
			while ( $row = mysql_fetch_row ( $result ) ) {
			$values = '';
			foreach ( $row as $data ) {
			$values .= '\'' . addslashes ( $data ) . '\', ';
			}
			$values = substr ( $values, 0, - 2 );
			$value .= 'INSERT INTO ' . $table . ' VALUES (' . $values . ');' . MSB_NL;
			}
			return $value;
			}
			function _Retrieve() {
			$value = '';
			if (! $this->_Connect ()) {
			return false;
			}
			if ($this->comments) {
			$value .= '#' . MSB_NL;
			$value .= '# MySQL database dump' . MSB_NL;
			$value .= '# Created by MySQL_Backup class, ver. ' . MSB_VERSION . MSB_NL;
			$value .= '#' . MSB_NL;
			$value .= '# Host: ' . $this->server . MSB_NL;
			$value .= '# Generated: ' . date ( 'M j, Y' ) . ' at ' . date ( 'H:i' ) . MSB_NL;
			$value .= '# MySQL version: ' . mysql_get_server_info () . MSB_NL;
			$value .= '# PHP version: ' . phpversion () . MSB_NL;
			if (! empty ( $this->database )) {
			$value .= '#' . MSB_NL;
			$value .= '# Database: `' . $this->database . '`' . MSB_NL;
			}
			$value .= '#' . MSB_NL . MSB_NL . MSB_NL;
			}
			if (! ($tables = $this->_GetTables ())) {
			return false;
			}
			foreach ( $tables as $table ) {
			if (! ($table_dump = $this->_DumpTable ( $table ))) {
			$this->error = mysql_error ();
			return false;
			}
			$value .= $table_dump;
			}
			return $value;
			}
			function _SaveToFile($fname, $sql, $compress) {
			if ($compress) {
			if (! ($zf = gzopen ( $fname, 'w9' ))) {
			$this->error = 'Can\'t create the output file.';
			return false;
			}
			gzwrite ( $zf, $sql );
			gzclose ( $zf );
			} else {
			if (! ($f = fopen ( $fname, 'w' ))) {
			$this->error = 'Can\'t create the output file.';
			return false;
			}
			fwrite ( $f, $sql );
			fclose ( $f );
			}
			return true;
			}
			}
			function mailAttachment($file, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
			$filename = basename ( $file );
			$file_size = filesize ( $file );
			$handle = fopen ( $file, "r" );
			$content = fread ( $handle, $file_size );
			fclose ( $handle );
			$content = chunk_split ( base64_encode ( $content ) );
			$uid = md5 ( uniqid ( time () ) );
			$name = basename ( $file );
			$header = "From: " . $from_name . " <" . $from_mail . ">\r\n";
			$header .= "Reply-To: " . $replyto . "\r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";
			$header .= "This is a multi-part message in MIME format.\r\n";
			$header .= "--" . $uid . "\r\n";
			$header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
			$header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
			$header .= $message . "\r\n\r\n";
			$header .= "--" . $uid . "\r\n";
			$header .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\r\n"; // use diff. tyoes here
			$header .= "Content-Transfer-Encoding: base64\r\n";
			$header .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\r\n\r\n";
			$header .= $content . "\r\n\r\n";
			$header .= "--" . $uid . "--";
			if (mail ( $mailto, $subject, "", $header )) {
			echo "mail send ... OK"; // or use booleans here
			} else {
			echo "mail send ... ERROR!";
			}
			}
			function directoryToArray($directory, $recursive) {
			$array_items = array ();
			if ($handle = opendir ( $directory )) {
			while ( false !== ($file = readdir ( $handle )) ) {
			if ($file != "." && $file != "..") {
			if (is_dir ( $directory . "/" . $file )) {
			if ($recursive) {
			$array_items = array_merge ( $array_items, directoryToArray ( $directory . "/" . $file, $recursive ) );
			}
			$file = $directory . "/" . $file . "/";
			$array_items [] = preg_replace ( "/\/\//si", "/", $file );
			} else {
			$file = $directory . "/" . $file;
			$array_items [] = preg_replace ( "/\/\//si", "/", $file );
			}
			}
			}
			closedir ( $handle );
			}
			return $array_items;
			}
			function syntax_hilight($filename) {
			if ((substr ( $filename, - 4 ) == '.php')) {
			ob_start ();
			show_source ( $filename );
			$buffer = ob_get_contents ();
			ob_end_clean ();
			} else {
			$argv = '-q -p - -E --language=html --color ' . escapeshellcmd ( $filename );
			$buffer = array ();
			
			exec ( "enscript $argv", $buffer );
			
			$buffer = join ( "\n", $buffer );
			$buffer = eregi_replace ( '^.*<PRE>', '<pre>', $buffer );
			$buffer = eregi_replace ( '</PRE>.*$', '</pre>', $buffer );
			}
			
			// Making it XHTML compatible.
			$buffer = eregi_replace ( '<FONT COLOR="', '<span style="color:', $buffer );
			$buffer = eregi_replace ( '</FONT>', '</style>', $buffer );
			
			return $buffer;
			}
			function tabella_squadre() {
			global $percorso_cartella_dati;
			$sq = file ( $percorso_cartella_dati . "/squadre.txt" );
			echo "<center><div>" . $acapo;
			
			foreach ( $sq as $val ) {
			$val = trim ( $val );
			echo "<div style=' float: left; background-color: #FFFFFF; height:auto' class='loghi_piccoli card'>
			<a href='tab_squadre.php?vedi_squadra=$val' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_" . strtolower ( $val ) . ".png' width='32' height='34' alt='" . ucfirst ( strtolower ( $val ) ) . "' title='" . ucfirst ( strtolower ( $val ) ) . "' style='border: 0px; text-decoration:none' />
			</a>
			</div>" . $acapo;
			}
			echo "<div style='clear:both'></div></div></center>";
			}
			
			function tabella_squadre_tra() {
			$sq = file ( $percorso_cartella_dati . "/squadre.txt" );
			echo "<center><div>" . $acapo;
			
			foreach ( $sq as $val ) {
			$val = trim ( $val );
			echo "<div style='padding: 0px; margin: 0px; float: left; background-color: #FFFFFF'>
			<a href='tab_squadre_tra.php?vedi_squadra=$val' style='border: 0px; text-decoration:none'>
			<img src='./immagini/lp_" . strtolower ( $val ) . ".png' width='32' height='34' alt='" . ucfirst ( strtolower ( $val ) ) . "' title='" . ucfirst ( strtolower ( $val ) ) . "' style='border: 0px; text-decoration:none' />
			</a>
			</div>" . $acapo;
			}
			echo "<div style='clear:both'></div></div></center>" . $acapo;
			}
			function cerca_proprietario($num_gio_cerc) {
			global $percorso_cartella_dati;
			$calciatori_merc1 = @file ( $percorso_cartella_dati . "/mercato_" . $_SESSION [torneo] . "_" . $_SESSION [serie] . ".txt" );
			$num_calciatori_merc1 = count ( $calciatori_merc1 );
			for($num21 = 0; $num21 < $num_calciatori_merc1; $num21 ++) {
			$dati_calciatore_merc1 = explode ( ",", $calciatori_merc1 [$num21] );
			$numero_merc1 = $dati_calciatore_merc1 [0];
			if ($num_gio_cerc == $numero_merc1)
			$proprietario_merc1 = $dati_calciatore_merc1 [4];
			}
			return $proprietario_merc1;
			}
			
			function rosa_squadra($largcol) {
			
			global $percorso_cartella_voti;
			global $percorso_cartella_dati;
			global $separatore_campi_file_calciatori;
			global $num_colonna_nome_file_calciatori;
			global $num_colonna_numcalciatore_file_calciatori;
			global $num_colonna_ruolo_file_calciatori;
			global $num_colonna_valore_calciatori;
			global $num_colonna_squadra_file_calciatori;
			global $ncs_attivo;
			global $outente;
			global $mercato_libero;
			global $stato_mercato;
			global $simbolo_portiere_file_calciatori;
			global $simbolo_difensore_file_calciatori;
			global $simbolo_centrocampista_file_calciatori;
			global $simbolo_attaccante_file_calciatori;
			global $vedi_squadra;
			global $num_colonna_votogiornale_file_voti;
			global $num_colonna_vototot_file_voti;
			
			######################################
			##### Controlla numero ultima giornata		
			
			$ultima_giornata = ultima_giornata_giocata();
			
			if ($ultima_giornata != "00") {
			$cerca_squadra = file($percorso_cartella_voti."/voti".$ultima_giornata.".txt");
			$frase_giornata = "Dati aggiornati alla giornata $ultima_giornata";
			}
			else {
			$cerca_squadra = file($percorso_cartella_dati."/calciatori.txt");
			$frase_giornata = "Dati relativi al precampionato";
			}
			
			$num_cer_squ = count($cerca_squadra);
			
			$table_layout = "<div class='col m$largcol'>
			<div class='card'>
			<div class='card-content'>
			<span class='card-title'>Rosa<span style='font-size: 13px;'> - $frase_giornata</span></span>
			<hr>
			<table class='centered highlight' style='width:100%' cellpadding='3px' bgcolor='$sfondo_tab'>
			<tr>
			<td class='testa'>Nome</td>
			<td class='testa'>V</td>
			<td class='testa'>FV</td>
			<td class='testa'>Val</td>
			<td class='testa'>&nbsp;</td>
			</tr>";
			
			$calciatori = @file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
			$num_calciatori = count($calciatori);
			
			
			for ($num1 = 0 ; $num1 < $num_cer_squ ; $num1++) {
			
			#######################################
			#Controllo componenti squadra		
			
			$dati_calciatore = explode($separatore_campi_file_calciatori, $cerca_squadra[$num1]);
			$numero = $dati_calciatore[($num_colonna_numcalciatore_file_calciatori-1)];
			$numero = trim($numero);
			$nome = stripslashes($dati_calciatore[($num_colonna_nome_file_calciatori-1)]);
			$nome = trim($nome);
			$nome = preg_replace( "/\"/", "",$nome);
			$ruolo = $dati_calciatore[($num_colonna_ruolo_file_calciatori-1)];
			$ruolo = trim($ruolo);
			$valore = $dati_calciatore[($num_colonna_valore_calciatori-1)];
			$valore = trim($valore);
			$ultvoto = $dati_calciatore[($num_colonna_votogiornale_file_voti-1)];
			$ultvoto = trim($ultvoto);
			$ultfantavoto = $dati_calciatore[($num_colonna_vototot_file_voti-1)];
			$ultfantavoto = trim($ultfantavoto);
			$xsquadra = $dati_calciatore[($num_colonna_squadra_file_calciatori-1)];
			$xsquadra = trim($xsquadra);
			$xsquadra = preg_replace( "/\"/", "",$xsquadra);
			
			$attivo = $dati_calciatore[($ncs_attivo-1)];
			$attivo = trim($attivo);
			
			if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
			if ($ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
			if ($ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
			if ($ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
			if ($ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
			if ($ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";
			
			#####################
			if ($vedi_squadra == $xsquadra and $attivo == "1") {
			$sx="on";
			for ($num2 = 0 ; $num2 < $num_calciatori ; $num2++) {
			$dati_calciatore = explode(",", $calciatori[$num2]);
			$proprietario = $dati_calciatore[4];
			$numero_calciatore= $dati_calciatore[0];
			if ($proprietario == $outente and $numero_calciatore==$numero) $sx="off";
			}
			if ($ruolo == "P") {$backruolo = "#ffb732";}
			if ($ruolo == "D") {$backruolo = "#00007f";}
			if ($ruolo == "C") {$backruolo = "#006600";}
			if ($ruolo == "A") {$backruolo = "#cc0000";}
			
			$table_layout .= "<tr>
			<td style='text-align:left'><b class='ruolo' style='background: $backruolo'>$ruolo</b> <a href='stat_calciatore.php?num_calciatore=$numero&amp;ruolo_guarda=$ruolo_guarda&amp;escludi_controllo=$escludi_controllo' class='user'>$nome</a></td>
			<td align=center>$ultvoto</td>
			<td align=center>$ultfantavoto</td>
			<td align=center>$valore</td>";
			if ($_SESSION['valido'] == "SI" and $mercato_libero == "SI" and $stato_mercato == "I" and $sx!="off")  $table_layout .= "<td align='center'><a href='compra.php?num_calciatore=$numero&amp;valutazione=$valutazione' class='user'>compra</a></td>";
			elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "SI" and $stato_mercato != "I" and $sx!="off") $table_layout .= "<td align='center'><a href='cambi.php?num_calciatore=$numero' class='user'>cambia</a></td>";
			elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "I" and $sx!="off") $table_layout .= "<td align='center'><a href='offerta.php?num_calciatore=$numero' class='user'>offri</a></td>";
			//elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "B") $table_layout .= "<td align='center'><a href='busta_offerta.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=$xsquadra_ok&amp;mercato_libero=$mercato_libero' class='user'>inserisci nella busta</a></td>";
			elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "B" and $sx!="off") $table_layout .= "<td align='center'><a class='user'>inserisci nella busta</a></td>";
			elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "P" and $sx!="off") $table_layout .= "<td align='center'><a href='offerta.php?num_calciatore=$numero' class='user'>offri</a></td>";
			elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "S" and $sx!="off") $table_layout .= "<td align='center'><a href='offerta.php?num_calciatore=$numero' class='user'>offri</a></td>";
			elseif ($_SESSION['valido'] == "SI" and $mercato_libero == "NO" and $stato_mercato == "A" and $sx!="off") $table_layout .= "<td align=center><a href='scambia.php?num_calciatore=$numero&amp;altro_utente=$proprietario' class='user'>scambia</a></td>";
			else $table_layout .= "<td align='center'>----</td>";
			$table_layout .= "</tr>";
			}
			} # fine for $num1
			$table_layout .= "</table>
			</div>
			</div>
			</div>";
			echo $table_layout;
			}
			
			function carica_logo() {
			$uploadpath = 'immagini/loghi/';      // directory to store the uploaded files
			$max_size = 256;          // maximum file size, in KiloBytes
			$alwidth = 1500;            // maximum allowed width, in pixels
			$alheight = 1500;           // maximum allowed height, in pixels
			$allowtype = array('gif', 'jpg','png');        // allowed extensions
			
			
			if (!is_dir($uploadpath)) {
			mkdir($uploadpath, 0775, true);
			echo "Creata cartella caricamento loghi: $uploadpath!<br />";
			}
			
			if (!is_writable($uploadpath)) echo "La cartella $uploadpath non &egrave; scrivibile!<br /> Impostare CHMOD 775.<br />";
			if (!is_readable($uploadpath)) echo "La cartella $uploadpath non &egrave; leggibile!<br /> Impostare CHMOD 775.<br />";
			
			echo "<center>Form upload per il logo utente. <br />Sono supportate le seguenti estensioni: $allowtype[0] - $allowtype[1] - $allowtype[2] <br /><br />
			Dimensione consentita: $max_size Kb<br /><br />";
			
			if(isset($_FILES['fileup']) && strlen($_FILES['fileup']['name']) > 1) {
			$sepext = explode('.', strtolower($_FILES['fileup']['name']));
			$type = end($sepext);       // gets extension
			$uploadpath = $uploadpath.$_SESSION['utente'].".jpg";    // gets the file name
			list($width, $height) = getimagesize($_FILES['fileup']['tmp_name']);     // gets image width and height
			$err = '';         // to store the errors
			
			// Checks if the file has allowed type, size, width and height (for images)
			if(!in_array($type, $allowtype)) $err .= 'Il file <b>'. $_FILES['fileup']['name']. '</b> ha un estensione non valida';
			if($_FILES['fileup']['size'] > $max_size*1000) $err .= '<br/>La dimensione massima del file &egrave;: '. $max_size. ' KB.';
			if(isset($width) && isset($height) && ($width >= $alwidth || $height >= $alheight)) $err .= '<br/>Il file deve essere massimo: '. $alwidth. ' x '. $alheight;
			
			// If no errors, upload the image, else, output the errors
			if($err == '') {
			if(file_exists($_SESSION['utente'].".jpg")) unlink($_SESSION['utente'].".jpg");
			if(move_uploaded_file($_FILES['fileup']['tmp_name'], $uploadpath)) {
			echo 'File: <b>'. basename( $_FILES['fileup']['name']). '</b> caricato correttamente:';
			echo '<br/>File tipo: <b>'. $_FILES['fileup']['type'] .'</b>';
			echo '<br />Dimensione: <b>'. number_format($_FILES['fileup']['size']/1024, 3, '.', '') .'</b> KB';
			#if(isset($width) && isset($height)) echo '<br/>Image Width x Height: '. $width. ' x '. $height;
			#echo '<br/><br/>Image address: <b>http://'.$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['REQUEST_URI']), '\\/').'/'.$uploadpath.'</b>';
			}
			else echo '<b>Impossibile caricare il file.</b>';
			}
			else echo $err;
			}
			}
			
			?>																			