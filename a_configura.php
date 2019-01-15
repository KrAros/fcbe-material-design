<?php
	##################################################################################
	#    FANTACALCIOBAZAR EVOLUTION
	#    Copyright (C) 2003-2009 by Antonello Onida 
	#
	#    This program is free software; you can redistribute it and/or modify
	#    it under the terms of the GNU General Public License as published by
	#    the Free Software Foundation; either version 2 of the License, or
	#    (at your option) any later version.
	#
	#    This program is distributed in the hope that it will be useful,
	#    but WITHOUT ANY WARRANTY; without even the implied warranty of
	#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	#    GNU General Public License for more details.
	#
	#    You should have received a copy of the GNU General Public License
	#    along with this program; if not, write to the Free Software
	#    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
	##################################################################################
	require_once("./controlla_pass.php");
	include("./header.php");
	
	if ($_SESSION['valido'] == "SI" and $_SESSION['permessi'] == 5) {
		echo "<script type='text/javascript' src='./inc/js/picker.js'></script>";
		#require("./a_menu.php");
		
		if ($verifiche_config == 2) {
			$n_contenuto_dati = "<?php
			############################################################################
			# FANTACALCIOBAZAR EVOLUTION
			# Copyright (C) 2003-2010 by Antonello Onida 
			#
			# PARAMETRI VISUALIZZAZIONE ED ESTETICA\n\n";
			$n_contenuto_dati .= "\$titolo_sito						= '".htmlentities($N_titolo_sito)."';\n";
			$n_contenuto_dati .= "\$admin_nome 						= '$N_admin_nome';\n";
			$n_contenuto_dati .= "\$email_mittente 					= '$N_email_mittente';\n";
			$n_contenuto_dati .= "\$admin_user 						= '$N_admin_user';\n";
			$n_contenuto_dati .= "\$admin_pass 						= '$N_admin_pass';\n";
			if ($N_iscrizione_online == "") $N_iscrizione_online = "NO";
			$n_contenuto_dati .= "\$iscrizione_online				= '$N_iscrizione_online';\n";
			$n_contenuto_dati .= "\$iscrizione_immediata_utenti		=	'$N_iscrizione_immediata_utenti';\n";
			$n_contenuto_dati .= "\$mostra_voti_in_login 			= '$N_mostra_voti_in_login';\n";
			$n_contenuto_dati .= "\$trasferiti_ok       			= '$N_trasferiti_ok';\n";
			$n_contenuto_dati .= "\$mostra_immagini_in_login 		= '$N_mostra_immagini_in_login';\n";
			$n_contenuto_dati .= "\$dir_immagini 					= '$N_dir_immagini';\n";
			$n_contenuto_dati .= "\$larghezza_immagine 				= '$N_larghezza_immagine';\n";
			$n_contenuto_dati .= "\$larghezza_immagine_casuale 		= '$N_larghezza_immagine_casuale';\n";
			$n_contenuto_dati .= "\$file_voti_fonte					= '$N_file_voti_fonte';\n";
			$n_contenuto_dati .= "\$statistiche 					= '$N_statistiche';\n";
			$n_contenuto_dati .= "\$menu_lato 						= '$N_menu_lato';\n";
			$n_contenuto_dati .= "\$foto_calciatori 				= '$N_foto_calciatori';\n";
			$n_contenuto_dati .= "\$foto_path 						= '$N_foto_path';\n";
			$n_contenuto_dati .= "\$consenti_logo					=	'$N_consenti_logo';\n";
			$n_contenuto_dati .= "\$vedi_campetto					=	'$N_vedi_campetto';\n";
			$n_contenuto_dati .= "\$percorso_cartella_dati 			=	'$N_percorso_cartella_dati';\n";
			$n_contenuto_dati .= "\$percorso_cartella_scontri 		=	'$N_percorso_cartella_scontri';\n";
			$n_contenuto_dati .= "\$percorso_cartella_voti 			=	'$N_percorso_cartella_voti';\n";
			$n_contenuto_dati .= "\$uploaddir 						=	'$N_uploaddir';\n";
			$n_contenuto_dati .= "\$manutenzione 					=	'$N_manutenzione';\n";
			$n_contenuto_dati .= "\$attiva_log 						=	'$N_attiva_log';\n";
			$n_contenuto_dati .= "\$attiva_rss 						= '$N_attiva_rss';\n";
			$n_contenuto_dati .= "\$url_rss							= '$N_url_rss';\n";
			$n_contenuto_dati .= "\$attiva_multi 					= '$N_attiva_multi';\n\n";
			$n_contenuto_dati .= "\$attiva_shoutbox 				= '$N_attiva_shoutbox';\n";
			$n_contenuto_dati .= "\$usa_cms 						= '$N_usa_cms';\n";
			$n_contenuto_dati .= "\$vedi_notizie 					= '$N_vedi_notizie';\n";
			$n_contenuto_dati .= "\$temp1	= '';\n";
			$n_contenuto_dati .= "\$temp2	= '';\n";
			$n_contenuto_dati .= "\$temp3	= '';\n";
			$n_contenuto_dati .= "\$temp4	= '';\n";
			$n_contenuto_dati .= "\$temp5	= '';\n";
			$n_contenuto_dati .= "\$temp6	= '';\n";
			$n_contenuto_dati .= "\$temp7	= '';\n";
			$n_contenuto_dati .= "\$temp8	= '';\n";
			$n_contenuto_dati .= "\$temp9	= '';\n";
			$n_contenuto_dati .= "\$temp0	= '';\n\n\n\n";
			
			# Dati non configurabili da form
			
			$n_contenuto_dati .= "# PARAMETRI NON CONFIGURABILI DA FORM\n\n";
			$n_contenuto_dati .= "\$attiva_sponsors = 'SI';\n";
			$n_contenuto_dati .= "\$usa_tinyMCE = 'SI';\n";
			$n_contenuto_dati .= "\$separatore_campi_file_calciatori = '|';\n";
			$n_contenuto_dati .= "\$num_colonna_numcalciatore_file_calciatori = 1;\n";
			$n_contenuto_dati .= "\$num_colonna_nome_file_calciatori = 3;\n";
			$n_contenuto_dati .= "\$num_colonna_ruolo_file_calciatori = 6;\n";
			$n_contenuto_dati .= "\$simbolo_portiere_file_calciatori = '0';\n";
			$n_contenuto_dati .= "\$simbolo_difensore_file_calciatori = '1';\n";
			$n_contenuto_dati .= "\$simbolo_centrocampista_file_calciatori = '2';\n";
			$n_contenuto_dati .= "\$simbolo_fantasista_file_calciatori = '';\n";
			$n_contenuto_dati .= "\$simbolo_attaccante_file_calciatori = '3';\n";
			$n_contenuto_dati .= "\$considera_fantasisti_come = 'C';\n";
			$n_contenuto_dati .= "\$num_colonna_squadra_file_calciatori = 4;\n\n";
			
			$n_contenuto_dati .= "# Composizione del file con i voti di giornata (dati/votiXX.txt)\n";
			$n_contenuto_dati .= "\$separatore_campi_file_voti = '|';\n";
			$n_contenuto_dati .= "\$num_colonna_numcalciatore_file_voti = 1;\n";
			$n_contenuto_dati .= "\$num_colonna_vototot_file_voti = 8;\n";
			$n_contenuto_dati .= "\$num_colonna_votogiornale_file_voti = 11;\n";
			$n_contenuto_dati .= "\$num_colonna_valore_calciatori = 28;\n\n";
			
			$n_contenuto_dati .= "# Posizione del file dei voti da copiare (se non viene copiato a mano), può\n";
			$n_contenuto_dati .= "# essere anche una URL (http://...). Se il file contiene anche 01,02,... in\n";
			$n_contenuto_dati .= "# corripondeza alla giornata utilizzare anche la 2ª,3ª,4ª e 5ª variabile.\n";
			$n_contenuto_dati .= "\$prima_parte_pos_file_voti = '$N_prima_parte_pos_file_voti';\n";
			$n_contenuto_dati .= "\$cartella_remota ='$N_cartella_remota';\n";
			$n_contenuto_dati .= "\$abilita_stat ='$N_abilita_stat';\n";
			$n_contenuto_dati .= "\$risparmia_risorse ='$N_risparmia_risorse';\n";
			$n_contenuto_dati .= "\$num_giornata_file_voti = 'SI';\n";
			$n_contenuto_dati .= "\$num_giornata_file_voti_doppio = 'SI';\n";
			$n_contenuto_dati .= "\$seconda_parte_pos_file_voti = '.txt';\n\n";
			
			$n_contenuto_dati .= "# Dati non configurabili da form\n\n";
			$n_contenuto_dati .= "\$sito_principale='http://fcbe.sssr.it/dati/';\n";
			$n_contenuto_dati .= "\$sito_mirror='http://fantadownload.altervista.org/mirrorFCBE/dati/';\n\n";
			$n_contenuto_dati .= "\$riduci							=	'$N_riduci';\n";
			$n_contenuto_dati .= "\$riduci1							=	'$N_riduci1';\n";
			$n_contenuto_dati .= "\$orientamento_campetto			=	'$N_orientamento_campetto';\n\n";
			$n_contenuto_dati .= "\$sfondo_tab						=	'$N_sfondo_tab';\n";
			$n_contenuto_dati .= "\$sfondo_tab1						=	'$N_sfondo_tab1';\n";
			$n_contenuto_dati .= "\$sfondo_tab2						=	'$N_sfondo_tab2';\n";
			$n_contenuto_dati .= "\$sfondo_tab3						=	'$N_sfondo_tab3';\n";
			$n_contenuto_dati .= "\$bgtabtitolari					=	'$N_bgtabtitolari';\n";
			$n_contenuto_dati .= "\$bgtabpanchinari					=	'$N_bgtabpanchinari';\n";
			$n_contenuto_dati .= "\$colore_riga_alt					=	'$N_colore_riga_alt';\n";
			$n_contenuto_dati .= "\$carattere_tipo	= 'Roboto Condensed';\n";
			$n_contenuto_dati .= "\$carattere_size	= '13px';\n";
			$n_contenuto_dati .= "\$carattere_colore	= '#060644';\n";
			$n_contenuto_dati .= "\$carattere_colore_chiaro			=	'$N_carattere_colore_chiaro';\n\n";
			$n_contenuto_dati .= "# Composizione del file con i dati delle statistiche (dati/file);\n";
			$n_contenuto_dati .= "\$ncs_codice = 1;\n";
			$n_contenuto_dati .= "\$ncs_giornata = 2;\n";
			$n_contenuto_dati .= "\$ncs_nome = 3;\n";
			$n_contenuto_dati .= "\$ncs_squadra = 4;\n";
			$n_contenuto_dati .= "\$ncs_attivo = 5;\n";
			$n_contenuto_dati .= "\$ncs_ruolo = 6;\n";
			$n_contenuto_dati .= "\$ncs_presenza = 7;\n";
			$n_contenuto_dati .= "\$ncs_votofc = 8;\n";
			$n_contenuto_dati .= "\$ncs_mininf25 = 9;\n";
			$n_contenuto_dati .= "\$ncs_minsup25 = 10;\n";
			$n_contenuto_dati .= "\$ncs_voto = 11;\n";
			$n_contenuto_dati .= "\$ncs_golsegnati = 12;\n";
			$n_contenuto_dati .= "\$ncs_golsubiti = 13;\n";
			$n_contenuto_dati .= "\$ncs_golvittoria = 14;\n";
			$n_contenuto_dati .= "\$ncs_golpareggio = 15;\n";
			$n_contenuto_dati .= "\$ncs_assist = 16;\n";
			$n_contenuto_dati .= "\$ncs_ammonizione = 17;\n";
			$n_contenuto_dati .= "\$ncs_espulsione = 18;\n";
			$n_contenuto_dati .= "\$ncs_rigoretirato = 19;\n";
			$n_contenuto_dati .= "\$ncs_rigoresubito = 20;\n";
			$n_contenuto_dati .= "\$ncs_rigoreparato = 21;\n";
			$n_contenuto_dati .= "\$ncs_rigoresbagliato = 22;\n";
			$n_contenuto_dati .= "\$ncs_autogol = 23;\n";
			$n_contenuto_dati .= "\$ncs_entrato = 24;\n";
			$n_contenuto_dati .= "\$ncs_titolare = 25;\n";
			$n_contenuto_dati .= "\$ncs_sv = 26;\n";
			$n_contenuto_dati .= "\$ncs_casa = 27;\n";
			$n_contenuto_dati .= "\$ncs_valore = 28;\n\n";
			$n_contenuto_dati .= "?>";
			
			if (@fopen($percorso_cartella_dati."/dati_gen.php","w+")) {
				$file_dati = fopen($percorso_cartella_dati."/dati_gen.php","wb+");
				flock($file_dati,LOCK_EX);
				$n_contenuto_dati = trim($n_contenuto_dati);
				fwrite($file_dati,$n_contenuto_dati);
				flock($file_dati,LOCK_UN);
				fclose($file_dati);
				echo "<br/><br/><center><h3>Modifiche dati_gen.php salvate.</h3></center><br/><br/><br/><br/><br/>";
				echo"<meta http-equiv='refresh' content='0; url=a_gestione.php?messgestutente=30'>";
				exit;
			} # fine if (fopen("$percorso_cartella_dati/dati_gen.php","w+"))
			else  {
				echo "<br/><br/><center><h3>Modifiche dati_gen.php non salvate.</h3></center><br/><br/><br/><br/><br/>";
				echo "<meta http-equiv='refresh' content='0; url=a_gestione.php?messgestutente=31'>";
				exit;
			}
		} # fine if ($verifiche_config == 2) {
		
		else	if ($verifiche_config == 1) {
			$procedi = "SI";
		} # fine else if ($verifiche_config == 1) {
		
		else {
			
			echo '<div class="container" style="width: 85%;margin-top: -10px;">
			<div class="card-panel">
			<div class="row">';
			
			require ("./a_widget.php");
			echo'<div class="col m9">';
			echo"<div class='bread'><a href='./a_gestione.php'>Gestione</a> / Configurazione sito</div><br>
			<div class='card'>
			<div class='card-content'>
			<span class='card-title'>Configurazione sito<span style='font-size: 13px;'> - Modifica i parametri generali del sito</span></span>
			<hr>
			<div class='row'>
			
			<form name='form_configura' action='./a_configura.php' method='post'>
			<table class='highlight'><thead>
			<tr>
			<th class='center'>Nome</th>
			<th class='center'>Opzione</th>
			</tr>
			</thead>
			
			<tr>
			<td style='width:30%'><p style='padding-left:30px'>Titolo sito</p></td>
			<td style='width:50%'><div class='input-field'><input
			class='validate' placeholder='$titolo_sito' type='text' value='$titolo_sito' name='N_titolo_sito' id='input_text' data-length='50' /></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Il nome del sito visualizzato in alto a sinistra.' >info</i></span></td>
			</tr>
			
			<tr>
			<td style='width:30%'><p style='padding-left:30px'>Nome amministratore</p></td>
			<td style='width:50%'><div class='input-field'><input
			class='validate' placeholder='$admin_nome' type='text' value='$admin_nome' name='N_admin_nome' id='input_text' data-length='40' /></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Nome del Presidente visualizzato nei vari messaggi.' >info</i></span></td>
			</tr>
			
			<tr>
			<td style='width:30%'><p style='padding-left:30px'>Email amministratore</p></td>
			<td style='width:50%'><div class='input-field'><input
			class='validate' placeholder='$email_mittente' type='email' value='$email_mittente' name='N_email_mittente' id='input_text' data-length='40' /></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Indirizzo email del Presidente di Lega.' >info</i></span></td>
			</tr>
			
			<tr>
			<td style='width:30%'><p style='padding-left:30px'>Username amministratore</p></td>
			<td style='width:50%'><div class='input-field'><input
			class='validate' placeholder='$admin_user' type='text' value='$admin_user' name='N_admin_user' id='input_text' data-length='15' /></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Username amministratore per accedere al pannello di controllo.' >info</i></span></td>
			</tr>
			
			<tr>
			<td style='width:30%'><p style='padding-left:30px'>Password amministratore</p></td>
			<td style='width:50%'><div class='input-field'><input
			class='validate' placeholder='$admin_pass' type='text' value='$admin_pass' name='N_admin_pass' id='input_text' data-length='15' /></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Password amministratore per accedere al pannello di controllo.' >info</i></span></td>
			</tr>";
			
			$checkSI = ""; $checkNO = "";
			if ($iscrizione_online == "SI") $checkSI = "checked";
			else $checkNO = "checked";
			echo"<tr>
			<td style='width:30%'><p style='padding-left:30px'>Iscrizioni aperte</p></td>
			<td style='width:50%' class='center'>
			<label>
			<input class='with-gap' type='radio' name='N_iscrizione_online' value='SI' $checkSI>
			<span>SI&nbsp;</span>
			</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
			<input class='with-gap' type='radio' name='N_iscrizione_online' value='NO' $checkNO />
			<span>NO</span>
			</label>
			</td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='<b>SI</b>: iscrizioni aperte a tutti.<br><b>NO:</b> iscrizioni aperte solo al gestore.' >info</i></span></td>
			</tr>";
			
			$checkSI = ""; $checkNO = "";
			if ($iscrizione_immediata_utenti == "SI") $checkSI = "checked";
			else $checkNO = "checked";
			echo"<tr>
			<td style='width:30%'><p style='padding-left:30px'>Abilitazione iscrizioni</p></td>
			<td style='width:50%' class='center'>
			<label>
			<input class='with-gap' type='radio' name='N_iscrizione_immediata_utenti' value='SI' $checkSI />
			<span>SI&nbsp;</span>
			</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
			<input class='with-gap' type='radio' name='N_iscrizione_immediata_utenti' value='NO' $checkNO />
			<span>NO</span>
			</label>
			</td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='<b>SI</b>: iscrizione immediata.<br><b>NO:</b> il gestore dovr&agrave; attivare manualmente il profilo.' >info</i></span></td>
			</tr>";
			
			$checkSI = ""; $checkNO = "";
			if ($mostra_voti_in_login == "SI") $checkSI = "checked";
			else $checkNO = "checked";
			echo"<tr>
			<td style='width:30%'><p style='padding-left:30px'>Voti in prima pagina</p></td>
			<td style='width:50%' class='center'>
			<label>
			<input class='with-gap' type='radio' name='N_mostra_voti_in_login' value='SI' $checkSI />
			<span>SI&nbsp;</span>
			</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
			<input class='with-gap' type='radio' name='N_mostra_voti_in_login' value='NO' $checkNO />
			<span>NO</span>
			</label>
			</td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Consente di visualizzare i voti senza loggarsi in prima pagina.' >info</i></span></td>
			</tr>";
			
			$checkSI = ""; $checkNO = "";
			if ($risparmia_risorse == "SI") $checkSI = "checked";
			else $checkNO = "checked";
			echo"<tr>
			<td style='width:30%'><p style='padding-left:30px'>Risparmia risorse</p></td>
			<td style='width:50%' class='center'>
			<label>
			<input class='with-gap' type='radio' name='N_risparmia_risorse' value='SI' $checkSI />
			<span>SI&nbsp;</span>
			</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
			<input class='with-gap' type='radio' name='N_risparmia_risorse' value='NO' $checkNO />
			<span>NO</span>
			</label>
			</td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Limita utilizzo di risorse sul server accellerando il caricamento delle pagine.' >info</i></span></td>
			</tr>";
			
			//// Da spostare per ogni singolo torneo ////
			
			$checkSI = ""; $checkNO = "";
			if ($trasferiti_ok == "SI") $checkSI = "checked";
			else $checkNO = "checked";
			echo"<tr>
			<td style='width:30%'><p style='padding-left:30px'>Cambia trasferiti</p></td>
			<td style='width:50%' class='center'>
			<label>
			<input class='with-gap' type='radio' name='N_trasferiti_ok' value='SI' $checkSI />
			<span>SI&nbsp;</span>
			</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
			<input class='with-gap' type='radio' name='N_trasferiti_ok' value='NO' $checkNO />
			<span>NO</span>
			</label>
			</td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Consente di abilitare la procedura per il cambio dei trasferiti.<br>Questi vengano conteggiati nel totale dei cambi.' >info</i></span></td>
			</tr>";
			
			$ATT1="";$ATT2="";$ATT3="";$ATT4="";
			if ($abilita_stat == "AUTO") $ATT1="selected";
			if ($abilita_stat == "PRINCIPALE") $ATT2="selected";
			if ($abilita_stat == "MIRROR") $ATT3="selected";
			if ($abilita_stat == "OFF") $ATT4="selected";
			
			echo "<tr>
			<td style='width:30%'><p style='padding-left:30px'>Caricamento statistiche</p></td>
			<td style='width:50%'><div class='input-field'><select name='N_abilita_stat'>
			<option value='AUTO' $ATT1>AUTOMATICO</option>
			<option value='PRINCIPALE' $ATT2>PRINCIPALE</option>
			<option value='MIRROR' $ATT3>MIRROR</option>
			<option value='OFF'$ATT4>OFF</option>
			</select></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Seleziona da quale server esterno caricare le risorse.' >info</i></span></td>
			</tr>";
			
			$checkSI = ""; $checkNO = "";
			if ($usa_cms == "SI") $checkSI = "checked";
			else $checkNO = "checked";
			echo"<tr>
			<td style='width:30%'><p style='padding-left:30px'>Utilizza CMS</p></td>
			<td style='width:50%' class='center'>
			<label>
			<input class='with-gap' type='radio' name='N_usa_cms' value='SI' $checkSI />
			<span>SI&nbsp;</span>
			</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
			<input class='with-gap' type='radio' name='N_usa_cms' value='NO' $checkNO />
			<span>NO</span>
			</label>
			</td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Utilizza il CMS Alessia di Antonello Onida da richiedere separatamente.' >info</i></span></td>
			</tr>";
			
			$NO_NEWS="";$SING_NEWS="";$DOPP_NEWS="";
			if ($vedi_notizie == "0") $NO_NEWS="selected";
			if ($vedi_notizie == "1") $SING_NEWS="selected";
			if ($vedi_notizie == "2") $DOPP_NEWS="selected";
			
			echo "<tr>
			<td style='width:30%'><p style='padding-left:30px'>Notizie in Home Page</p></td>
			<td style='width:50%'><div class='input-field'><select name='N_vedi_notizie'>
			<option value='0' $NO_NEWS>Nessuna notizia</option>
			<option value='1' $SING_NEWS>Blocco singolo</option>
			<option value='2' $DOPP_NEWS>Blocco singolo e blocco laterale nel menu</option>
			</select></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Seleziona la disposizione delle news in Home Page.' >info</i></span></td>
			</tr>";
			
			$checkSI = ""; $checkNO = "";
			if ($attiva_shoutbox == "SI") $checkSI = "checked";
			else $checkNO = "checked";
			echo"<tr>
			<td style='width:30%'><p style='padding-left:30px'>Attiva Shoutbox</p></td>
			<td style='width:50%' class='center'>
			<label>
			<input class='with-gap' type='radio' name='N_attiva_shoutbox' value='SI' $checkSI />
			<span>SI&nbsp;</span>
			</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
			<input class='with-gap' type='radio' name='N_attiva_shoutbox' value='NO' $checkNO />
			<span>NO</span>
			</label>
			</td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Attiva lo shoutbox nella Home Page.' >info</i></span></td>
			</tr>";
			
			$checkSI = ""; $checkNO = "";
			if ($mostra_immagini_in_login == "SI") $checkSI = "checked";
			else $checkNO = "checked";
			echo"<tr>
			<td style='width:30%'><p style='padding-left:30px'>Attiva galleria immagini</p></td>
			<td style='width:50%' class='center'>
			<label>
			<input class='with-gap' type='radio' name='N_mostra_immagini_in_login' value='SI' $checkSI />
			<span>SI&nbsp;</span>
			</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
			<input class='with-gap' type='radio' name='N_mostra_immagini_in_login' value='NO' $checkNO />
			<span>NO</span>
			</label>
			</td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Mostra una galleria di immagini nella Home Page.' >info</i></span></td>
			</tr>
			
			<tr>
			<td style='width:30%'><p style='padding-left:30px'>Cartella immagini</p></td>
			<td style='width:50%'><div class='input-field'><input
			class='validate' placeholder='$dir_immagini' type='text' value='$dir_immagini' name='N_dir_immagini' id='input_text' data-length='40' /></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Indica la cartella dove sono situate le immagini per la galleria.' >info</i></span></td>
			</tr>
			
			<tr>
			<td style='width:30%'><p style='padding-left:30px'>Larghezza immagini galleria</p></td>
			<td style='width:50%'><div class='input-field'><input
			class='validate' placeholder='$larghezza_immagine' type='text' value='$larghezza_immagine' name='N_larghezza_immagine' id='input_text' data-length='4' /></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Indica la larghezza delle immagini mostrate nella galleria, in Pixel.' >info</i></span></td>
			</tr>
			
			<tr>
			<td style='width:30%'><p style='padding-left:30px'>Larghezza immagini casuali</p></td>
			<td style='width:50%'><div class='input-field'><input
			class='validate' placeholder='$larghezza_immagine_casuale' type='text' value='$larghezza_immagine_casuale' name='N_larghezza_immagine_casuale' id='input_text' data-length='4' /></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Indica la larghezza delle immagini della funzione immagine_casuale(), in Pixel.' >info</i></span></td>
			</tr>";
			
			$checkSI = ""; $checkNO = "";
			if ($statistiche == "SI") $checkSI = "checked";
			else $checkNO = "checked";
			echo"<tr>
			<td style='width:30%'><p style='padding-left:30px'>Statistiche avanzate</p></td>
			<td style='width:50%' class='center'>
			<label>
			<input class='with-gap' type='radio' name='N_statistiche' value='SI' $checkSI />
			<span>SI&nbsp;</span>
			</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
			<input class='with-gap' type='radio' name='N_statistiche' value='NO' $checkNO />
			<span>NO</span>
			</label>
			</td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Se si dispone di un file statistiche (MCCxx.txt) consente di mostrare statistiche avanzate.' >info</i></span></td>
			</tr>
			
			<tr>
			<td style='width:30%'><p style='padding-left:30px'>Fonte Voti</p></td>
			<td style='width:50%'><div class='input-field'><input
			class='validate' placeholder='$file_voti_fonte' type='text' value='$file_voti_fonte' name='N_file_voti_fonte' id='input_text' data-length='40' /></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Origine del file voti (Gazzetta, Corriere, Fantacalcio.it).' >info</i></span></td>
			</tr>";
			
			$checkSI = ""; $checkNO = "";
			if ($foto_calciatori == "SI") $checkSI = "checked";
			else $checkNO = "checked";
			echo"<tr>
			<td style='width:30%'><p style='padding-left:30px'>Statistiche avanzate</p></td>
			<td style='width:50%' class='center'>
			<label>
			<input class='with-gap' type='radio' name='N_foto_calciatori' value='SI' $checkSI />
			<span>SI&nbsp;</span>
			</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
			<input class='with-gap' type='radio' name='N_foto_calciatori' value='NO' $checkNO />
			<span>NO</span>
			</label>
			</td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Se si dispone delle foto dei calciatori queste saranno visualizzate in varie pagine.' >info</i></span></td>
			</tr>
			
			<tr>
			<td style='width:30%'><p style='padding-left:30px'>Cartella foto calciatori</p></td>
			<td style='width:50%'><div class='input-field'><input
			class='validate' placeholder='$foto_path' type='text' value='$foto_path' name='N_foto_path' id='input_text' data-length='40' /></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Indica la cartella contenente le foto dei calciatori.' >info</i></span></td>
			</tr>";
			
			$checkSI = ""; $checkNO = "";
			if ($consenti_logo == "SI") $checkSI = "checked";
			else $checkNO = "checked";
			echo"<tr>
			<td style='width:30%'><p style='padding-left:30px'>Logo squadre</p></td>
			<td style='width:50%' class='center'>
			<label>
			<input class='with-gap' type='radio' name='N_consenti_logo' value='SI' $checkSI />
			<span>SI&nbsp;</span>
			</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
			<input class='with-gap' type='radio' name='N_consenti_logo' value='NO' $checkNO />
			<span>NO</span>
			</label>
			</td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Abilita il caricamento dei loghi per le squadre.' >info</i></span></td>
			</tr>";
			
			$checkSI = ""; $checkNO = "";
			if ($vedi_campetto == "SI") $checkSI = "checked";
			else $checkNO = "checked";
			echo"<tr>
			<td style='width:30%'><p style='padding-left:30px'>Visualizza campetto</p></td>
			<td style='width:50%' class='center'>
			<label>
			<input class='with-gap' type='radio' name='N_vedi_campetto' value='SI' $checkSI />
			<span>SI&nbsp;</span>
			</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
			<input class='with-gap' type='radio' name='N_vedi_campetto' value='NO' $checkNO />
			<span>NO</span>
			</label>
			</td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Visualizzazione grafica delle squadre in campo.' >info</i></span></td>
			</tr>
			
			<tr>
			<td style='width:30%'><p style='padding-left:30px'>Cartella dati</p></td>
			<td style='width:50%'><div class='input-field'><input
			class='validate' placeholder='$percorso_cartella_dati' type='text' value='$percorso_cartella_dati' name='N_percorso_cartella_dati' id='input_text' data-length='40' /></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Indica la cartella contenente i dati del sito: <b>./dati</b> di default.' >info</i></span></td>
			</tr>
			
			<tr>
			<td style='width:30%'><p style='padding-left:30px'>Cartella scontri</p></td>
			<td style='width:50%'><div class='input-field'><input
			class='validate' placeholder='$percorso_cartella_scontri' type='text' value='$percorso_cartella_scontri' name='N_percorso_cartella_scontri' id='input_text' data-length='40' /></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Indica la cartella contenente i dati dei template degli scontri: <b>./scontri</b> di default.' >info</i></span></td>
			</tr>
			
			<tr>
			<td style='width:30%'><p style='padding-left:30px'>Cartella voti</p></td>
			<td style='width:50%'><div class='input-field'><input
			class='validate' placeholder='$percorso_cartella_voti' type='text' value='$percorso_cartella_voti' name='N_percorso_cartella_voti' id='input_text' data-length='40' /></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Indica la cartella contenente i voti, solitamente uguale a quella dati: <b>./dati</b> di default.' >info</i></span></td>
			</tr>
			
			<tr>
			<td style='width:30%'><p style='padding-left:30px'>Posizione file voti</p></td>
			<td style='width:50%'><div class='input-field'><input
			class='validate' placeholder='$prima_parte_pos_file_voti' type='text' value='$prima_parte_pos_file_voti' name='N_prima_parte_pos_file_voti' id='input_text' data-length='40' /></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Indica la cartella e la struttura del file voti, solitamente <b>dati/XXXX/MCC</b> dove XXXX &agrave; anno.' >info</i></span></td>
			</tr>
			
			<tr>
			<td style='width:30%'><p style='padding-left:30px'>Cartella remota download file voti</p></td>
			<td style='width:50%'><div class='input-field'><input
			class='validate' placeholder='$cartella_remota' type='text' value='$cartella_remota' name='N_cartella_remota' id='input_text' data-length='4' /></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Solitamente si utilizza anno di inizio del campionato, ad esempio 2018.' >info</i></span></td>
			</tr>
			
			<tr>
			<td style='width:30%'><p style='padding-left:30px'>Cartella upload file voti</p></td>
			<td style='width:50%'><div class='input-field'><input
			class='validate' placeholder='$uploaddir' type='text' value='$uploaddir' name='N_uploaddir' id='input_text' data-length='40' /></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Nome cartella dove uploadare i file dati dentro la cartella <b>$percorso_cartella_dati</b>; ad esempio <b>2018</b>.' >info</i></span></td>
			</tr>";
			
			$checkSI = ""; $checkNO = "";
			if ($manutenzione == "SI") $checkSI = "checked";
			else $checkNO = "checked";
			echo"<tr>
			<td style='width:30%'><p style='padding-left:30px'>Sito in manutenzione</p></td>
			<td style='width:50%' class='center'>
			<label>
			<input class='with-gap' type='radio' name='N_manutenzione' value='SI' $checkSI />
			<span>SI&nbsp;</span>
			</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
			<input class='with-gap' type='radio' name='N_manutenzione' value='NO' $checkNO />
			<span>NO</span>
			</label>
			</td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Attiva la modalit&agrave; di manutenzione nel sito.' >info</i></span></td>
			</tr>";
			
			$checkSI = ""; $checkNO = "";
			if ($attiva_log == "SI") $checkSI = "checked";
			else $checkNO = "checked";
			echo"<tr>
			<td style='width:30%'><p style='padding-left:30px'>Attiva log dati</p></td>
			<td style='width:50%' class='center'>
			<label>
			<input class='with-gap' type='radio' name='N_attiva_log' value='SI' $checkSI />
			<span>SI&nbsp;</span>
			</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
			<input class='with-gap' type='radio' name='N_attiva_log' value='NO' $checkNO />
			<span>NO</span>
			</label>
			</td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Attiva il tracking degli accessi al sito.' >info</i></span></td>
			</tr>";
			
			$checkSI = ""; $checkNO = "";
			if ($attiva_rss == "SI") $checkSI = "checked";
			else $checkNO = "checked";
			echo"<tr>
			<td style='width:30%'><p style='padding-left:30px'>Attiva lettore RSS</p></td>
			<td style='width:50%' class='center'>
			<label>
			<input class='with-gap' type='radio' name='N_attiva_rss' value='SI' $checkSI />
			<span>SI&nbsp;</span>
			</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
			<input class='with-gap' type='radio' name='N_attiva_rss' value='NO' $checkNO />
			<span>NO</span>
			</label>
			</td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Attiva lettore interno di RSS nella home page del sito.' >info</i></span></td>
			</tr>";
			
			echo "<tr>
			<td style='width:30%'><p style='padding-left:30px'>URL RSS feed</p></td>
			<td style='width:50%'><div class='input-field'><input
			class='validate' placeholder='$url_rss' type='text' value='$url_rss' name='N_url_rss' id='input_text' data-length='40' /></div></td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Indirizzo del file RSS.' >info</i></span></td>
			</tr>";
			
			$checkSI = ""; $checkNO = "";
			if ($attiva_multi == "SI") $checkSI = "checked";
			else $checkNO = "checked";
			echo"<tr>
			<td style='width:30%'><p style='padding-left:30px'>Gestione multicampionati</p></td>
			<td style='width:50%' class='center'>
			<label>
			<input class='with-gap' type='radio' name='N_attiva_multi' value='SI' $checkSI />
			<span>SI&nbsp;</span>
			</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label>
			<input class='with-gap' type='radio' name='N_attiva_multi' value='NO' $checkNO />
			<span>NO</span>
			</label>
			</td>
			<td class='center'><i class='material-icons tooltipped' data-position='top' data-tooltip='Attiva la gestione per multicampionati.' >info</i></span></td>
			</tr>
			</table>
			</div>
			</div>
			<div class='card-action center'><input type='hidden' name='verifiche_config' value='2' />
			<button type='submit' class='btn waves-effect waves-light green'>Salva le modifiche</button>
			</div>
			</form>
			</div></div></div></div></div>";
		} # fine else
		
	} # fine if ($_SESSION valido)
	else header("location: logout.php?logout=2");
	include("./footer.php");
?>