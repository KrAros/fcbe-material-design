<?php
			############################################################################
			# FANTACALCIOBAZAR EVOLUTION
			# Copyright (C) 2003-2010 by Antonello Onida 
			#
			# PARAMETRI VISUALIZZAZIONE ED ESTETICA

$titolo_sito						= 'FantacalcioBazar Evolution';
$admin_nome 						= 'Presidente';
$email_mittente 					= 'fantacalcio@localhost.com';
$admin_user 						= 'admin';
$admin_pass 						= 'password';
$iscrizione_online				= 'SI';
$iscrizione_immediata_utenti		=	'SI';
$mostra_voti_in_login 			= 'SI';
$trasferiti_ok       			= 'NO';
$mostra_immagini_in_login 		= 'NO';
$dir_immagini 					= 'immagini/galleria';
$larghezza_immagine 				= '300';
$larghezza_immagine_casuale 		= '150';
$file_voti_fonte					= 'Gazzetta dello Sport';
$statistiche 					= 'SI';
$menu_lato 						= '';
$foto_calciatori 				= 'SI';
$foto_path 						= 'immagini/foto/';
$consenti_logo					=	'SI';
$vedi_campetto					=	'SI';
$percorso_cartella_dati 			=	'./dati';
$percorso_cartella_scontri 		=	'./dati/scontri';
$percorso_cartella_voti 			=	'./dati';
$uploaddir 						=	'dati/2018';
$manutenzione 					=	'NO';
$attiva_log 						=	'SI';
$attiva_rss 						= 'SI';
$url_rss							= 'http://www.gazzetta.it/rss/Calcio.xml                                                                                                                                                    ';
$attiva_multi 					= 'NO';

$attiva_shoutbox 				= 'NO';
$usa_cms 						= 'NO';
$vedi_notizie 					= '2';
$temp1	= '';
$temp2	= '';
$temp3	= '';
$temp4	= '';
$temp5	= '';
$temp6	= '';
$temp7	= '';
$temp8	= '';
$temp9	= '';
$temp0	= '';



# PARAMETRI NON CONFIGURABILI DA FORM

$attiva_sponsors = 'SI';
$usa_tinyMCE = 'SI';
$separatore_campi_file_calciatori = '|';
$num_colonna_numcalciatore_file_calciatori = 1;
$num_colonna_nome_file_calciatori = 3;
$num_colonna_ruolo_file_calciatori = 6;
$simbolo_portiere_file_calciatori = '0';
$simbolo_difensore_file_calciatori = '1';
$simbolo_centrocampista_file_calciatori = '2';
$simbolo_fantasista_file_calciatori = '';
$simbolo_attaccante_file_calciatori = '3';
$considera_fantasisti_come = 'C';
$num_colonna_squadra_file_calciatori = 4;

# Composizione del file con i voti di giornata (dati/votiXX.txt)
$separatore_campi_file_voti = '|';
$num_colonna_numcalciatore_file_voti = 1;
$num_colonna_vototot_file_voti = 8;
$num_colonna_votogiornale_file_voti = 11;
$num_colonna_valore_calciatori = 28;

# Posizione del file dei voti da copiare (se non viene copiato a mano), può
# essere anche una URL (http://...). Se il file contiene anche 01,02,... in
# corripondeza alla giornata utilizzare anche la 2ª,3ª,4ª e 5ª variabile.
$prima_parte_pos_file_voti = 'dati/2018/MCC';
$cartella_remota ='2018';
$abilita_stat ='MIRROR';
$risparmia_risorse ='NO';
$num_giornata_file_voti = 'SI';
$num_giornata_file_voti_doppio = 'SI';
$seconda_parte_pos_file_voti = '.txt';

# Dati non configurabili da form

$sito_principale='http://fcbe.sssr.it/dati/';
$sito_mirror='http://fantadownload.altervista.org/mirrorFCBE/dati/';

$riduci							=	'';
$riduci1							=	'';
$orientamento_campetto			=	'';

$sfondo_tab						=	'';
$sfondo_tab1						=	'';
$sfondo_tab2						=	'';
$sfondo_tab3						=	'';
$bgtabtitolari					=	'';
$bgtabpanchinari					=	'';
$colore_riga_alt					=	'';
$carattere_tipo	= 'Roboto Condensed';
$carattere_size	= '13px';
$carattere_colore	= '#060644';
$carattere_colore_chiaro			=	'';

# Composizione del file con i dati delle statistiche (dati/file);
$ncs_codice = 1;
$ncs_giornata = 2;
$ncs_nome = 3;
$ncs_squadra = 4;
$ncs_attivo = 5;
$ncs_ruolo = 6;
$ncs_presenza = 7;
$ncs_votofc = 8;
$ncs_mininf25 = 9;
$ncs_minsup25 = 10;
$ncs_voto = 11;
$ncs_golsegnati = 12;
$ncs_golsubiti = 13;
$ncs_golvittoria = 14;
$ncs_golpareggio = 15;
$ncs_assist = 16;
$ncs_ammonizione = 17;
$ncs_espulsione = 18;
$ncs_rigoretirato = 19;
$ncs_rigoresubito = 20;
$ncs_rigoreparato = 21;
$ncs_rigoresbagliato = 22;
$ncs_autogol = 23;
$ncs_entrato = 24;
$ncs_titolare = 25;
$ncs_sv = 26;
$ncs_casa = 27;
$ncs_valore = 28;

?>