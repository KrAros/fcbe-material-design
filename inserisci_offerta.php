<?php
#################################################################################
#    FANTACALCIOBAZAR EVOLUTION
#    Copyright (C) 2003-2010 by Antonello Onida
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
require_once ("./controlla_pass.php");
include("./header.php");

$inserire = "NO";
$notifica_rialzo_mercato = "NO"; # in attesa di inserirla in pianificazione!

if ($_SESSION['valido'] == "SI") {
	require ("./menu.php");
	$filei = file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
	$ultima_giornata = ultima_giornata_giocata();

	
	if ($stato_mercato != "I" AND intval($ultima_giornata) > 0) {
		$cerca_valutazione = file("$percorso_cartella_voti/voti$ultima_giornata.txt");
		$calciatori = file("$percorso_cartella_dati/calciatori.txt");
		if (@is_file("$percorso_cartella_voti/voti$ultima_giornata.txt")) {
			$cerca_valutazione = file("$percorso_cartella_voti/voti$ultima_giornata.txt");
			$frase_voti = "Dati aggiornati all'ultima giornata";
		}
		else {
			$ultima_giornata--;
			$cerca_valutazione = file("$percorso_cartella_voti/voti$ultima_giornata.txt");
			$frase_voti = "<font color='red'>Dati dell'ultima giornata ancora non presenti.</font><br /> Valutazione alla giornata $ultima_giornata";
			$blocco=1;
		}
	}
	else {
		$cerca_valutazione = file("$percorso_cartella_dati/calciatori.txt");
		$calciatori = file("$percorso_cartella_dati/calciatori.txt");
		$frase_voti = "Dati di precampionato";
	}
	#echo $valore_offerta; die;
	$valore_offerta = intval($_POST['valore_offerta']);
	$sostituire = "SI";
	$trovato = "NO";
	$inserire = "SI";
	$soldi_spesi = 0;
	$vecchio_proprietario = "";
	$nuovo_costo = 0;
	$num_calciatori_posseduti = 0;
	$vecchia_scadenza = "";

	$calciatorim = @file("$percorso_cartella_dati/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
	$num_calciatori = count($calciatorim);

	for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
		$dati_calciatore = explode(",", $calciatorim[$num1]);
		$numero = $dati_calciatore[0];
		$proprietario = $dati_calciatore[4];
				
		if ($proprietario == $_SESSION['utente']) {
			$soldi_spesi = $soldi_spesi + $dati_calciatore[3];
			$num_calciatori_posseduti++;
		} # fine if ($proprietario == $_SESSION['utente'])

		if ($num_calciatore == $numero) {
			$nome = $dati_calciatore[1];
			$ruolo = $dati_calciatore[2];
			$trovato = "SI";
			$posizione = $num1;
			$costo = $dati_calciatore[3];
			$proprietario_vero = $proprietario;
			$vecchio_proprietario = $dati_calciatore[6];
			$vecchia_scadenza = $dati_calciatore[5];
			$vecchio_costo = $dati_calciatore[7];
			$vecchio_costo = togli_acapo($vecchio_costo);
			$nuovo_costo = $dati_calciatore[8];
			$nuovo_costo = togli_acapo($nuovo_costo);
			$tempo_off = $dati_calciatore[5];
			$anno_off = substr($tempo_off,0,4);
			$mese_off = substr($tempo_off,4,2);
			$giorno_off = substr($tempo_off,6,2);
			$ora_off = substr($tempo_off,8,2);
			$minuto_off = substr($tempo_off,10,2);
			$adesso = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));
			$sec_restanti = mktime($ora_off,$minuto_off,0,$mese_off,$giorno_off,$anno_off) - $adesso;

			if ($nuovo_costo) { $costo_mostra = $nuovo_costo; }
			else { $costo_mostra = $costo; }
			if ($sec_restanti < 0) {
				$inserire = "NO";
				$frase .= "Tempo scaduto per questa offerta!<br />";
			} # fine if ($sec_restanti < 0)
			else {if ($costo_mostra >= $valore_offerta) {
				$inserire = "NO";
				$frase .= "L'offerta non &egrave; abbastanza alta per comprare il calciatore.<br />";
			}} # fine if ($costo >= $valore_offerta)
		} # fine if ($num_calciatore == $numero)
	} # fine for $num1

	if ($trovato != "SI") {
		$nuova_offerta = "SI";
		$sostituire = "NO";
		$num_calciatori_completi = count($cerca_valutazione);

		for ($num1 = 0 ; $num1 < $num_calciatori_completi ; $num1++) {
			$dati_calciatore = explode($separatore_campi_file_calciatori, $cerca_valutazione[$num1]);
			$numero = $dati_calciatore[($num_colonna_numcalciatore_file_calciatori-1)];
			$numero = togli_acapo($numero);

			if ($num_calciatore == $numero) {
				$trovato = "SI";
				$nome = $dati_calciatore[($num_colonna_nome_file_calciatori-1)];
				$nome = togli_acapo($nome);
				$nome = preg_replace("#\"#","",$nome);
				$s_ruolo = $dati_calciatore[($num_colonna_ruolo_file_calciatori-1)];
				$s_ruolo = togli_acapo($s_ruolo);
				$ruolo = $s_ruolo;
				if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
				if ($s_ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
				if ($s_ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
				if ($s_ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
				if ($s_ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
				if ($s_ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";
			} # fine if ($num_calciatore == $numero)
		} # fine for $num1
	} # fine if ($trovato != "SI")

	if ($trovato != "SI") {
		$inserire = "NO";
		$frase .= "Calciatore inesistente, sei un BARO! - $trovato<br />";
	} # fine if ($trovato != "SI")

	if ($num_calciatore == "") {
		$inserire = "NO";
		$frase .= "Calciatore inesistente.<br />";
	} # fine if ($num_calciatore == "")

	if ($nuova_offerta == "SI" and $stato_mercato == "S") {
		$inserire = "NO";
		echo "<center>Il mercato &egrave; <b>sospeso</b> in questo momento.</center><br />";
	} # fine if ($nuova_offerta == "SI" and $stato_mercato == "S")

	if ($stato_mercato == "C") {
		$inserire = "NO";
		echo "<center>Il mercato &egrave; <b>chiuso</b> in questo momento.</center><br />";
	} # fine if ($stato_mercato == "C")

	$verifica_num = preg_replace("#[0-9]#","",$valore_offerta);

	if ($verifica_num != "" or $valore_offerta == "" or $valore_offerta == 0) {
		$inserire = "NO";
		$frase .= "L'offerta deve essere un numero intero positivo.<br />";
	} # fine if ($verifica_num != "" or $valore_offerta == "" or $valore_offerta == 0)

	$num_calciatori_comprabili = $max_calciatori - $num_calciatori_posseduti;

	@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $filei[$_SESSION['uid']]);
	$surplus = intval($ocrediti);
	$variazioni = intval($ovariazioni);

	/*
	if ($vecchio_proprietario == $_SESSION['utente'] AND $vecchio_proprietario != $proprietario_vero) {
	$surplus = $surplus - $costo + $vecchio_costo;
	} # fine if ($vecchio_proprietario == $_SESSION['utente'])
	*/

	$soldi_spendibili = $soldi_iniziali + $surplus + $variazioni - $soldi_spesi;

	if ($num_calciatori_comprabili <= 0) {
		$inserire = "NO";
		$frase .= "Hai raggiunto il valore massimo di calciatori comperabili.<br />";
	} # fine if ($num_calciatori_comprabili <= 0)

	if ($soldi_spendibili < $valore_offerta) {
		$inserire = "NO";
		$frase .= "La tua offerta ($valore_offerta) supera i crediti che hai a disposizione ($soldi_spendibili).<br />";
	} # fine if ($soldi_spendibili < $valore_offerta)

	if ($inserire == "SI") {
		if ($sostituire == "NO") {
			$posizione == 0;
			$num_calciatori++;
		} # fine if ($sostituire == "NO")

		$file_mercato = fopen("$percorso_cartella_dati/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt","wb+");
		
		for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {

			if ($posizione == $num1) {
				$anno_attuale = date("Y");
				$mese_attuale = date("m");
				$giorno_attuale = date("d");
				$ora_attuale = date("H");
				$minuto_attuale = date("i");
				$secondo_attuale = date("s")+5;
				$scadenza_teorica = date("YmdHi",mktime($ora_attuale+$aspetta_ore,$minuto_attuale+$aspetta_minuti,0,$mese_attuale,$giorno_attuale+$aspetta_giorni,$anno_attuale));
				$data_chigio = @file("dati/data_chigio.txt");
				$data_cg = $data_chigio[0];
				if ($scadenza_teorica > $data_cg) $scadenza_teorica = $data_cg;

				if ($mercato_libero == "NO") {
					if ($stato_mercato == "I" OR $stato_mercato == "P"){
						if (isset($data_cg)){
							if ($scadenza_teorica > $data_cg) $scadenza = $data_cg;
							else $scadenza = $scadenza_teorica;
						}
						else $scadenza = $scadenza_teorica;
					}
					else $scadenza = 0;
				}
				else $scadenza = 0;

				if ($_SESSION['otreset'] == "SI") $scadenza_gen=$scadenza.$secondo_attuale;
				else if ($vecchia_scadenza!="") $scadenza_gen=rtrim($vecchia_scadenza);
						else $scadenza_gen=$scadenza.$secondo_attuale;
						
				$linea = "$num_calciatore,$nome,$ruolo,$valore_offerta,".$_SESSION['utente'].",$scadenza_gen";
				if ($proprietario_vero != $_SESSION['utente']) $vecchio_proprietario = $proprietario_vero;

				#######################
				
				if ($vecchio_proprietario) {
					$vecchio_costo = $costo;
					$linea .= ",$vecchio_proprietario,$vecchio_costo";
/*					
					if ($vecchio_proprietario == $_SESSION['utente']) {
						if ($vecchio_proprietario != $proprietario_vero) { $aggiungi_surplus = $vecchio_costo - $costo; }
						else { $aggiungi_surplus = 0; }
					} # fine if ($vecchio_proprietario == $_SESSION['utente'])
					else {
						if ($vecchio_proprietario == $proprietario_vero) { $aggiungi_surplus = $valore_offerta - $vecchio_costo; }
						else { $aggiungi_surplus = $valore_offerta - $costo; }
					} # fine else if ($vecchio_proprietario == $_SESSION['utente'])

					if ($stato_mercato != "I") {
						$linee = count($filei);
						for($lineaf = 0; $lineaf < $linee; $lineaf++) {
							@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $filei[$lineaf]);
							if ($outente == $vecchio_proprietario) $filei[$lineaf] =  $outente."<del>".$opass."<del>".$opermessi."<del>".$oemail."<del>".$ourl."<del>".$osquadra."<del>".$otorneo."<del>".$oserie."<del>".$ocitta."<del>".$aggiungi_surplus."<del>".$ovariazioni."<del>".$ocambi."<del>".$oreg."<del>0<del>0<del>0<del>0<del>0<del>0<del>0<del>0<del>0<del>0<del>0<del>0\n";
						}

						$agg_file = fopen($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php", "wb");
						flock($agg_file,LOCK_EX);
						$file_aggiornato = implode("",$filei);
						fwrite($agg_file, $file_aggiornato);
						flock($agg_file,LOCK_UN);
						fclose($agg_file);
					}
*/
				} # fine if ($vecchio_proprietario)
							
				flock($file_mercato,LOCK_EX);
				fwrite($file_mercato,$linea."\n");
				flock($file_mercato,LOCK_UN);
			} # fine if ($posizione == $num1)
			else {
				if ($sostituire == "NO") { $num_linea = $num1 - 1; }
				else { $num_linea = $num1; }
			flock($file_mercato,LOCK_EX);
			fwrite($file_mercato,$calciatorim[$num_linea]);
			flock($file_mercato,LOCK_UN);
			} # fine else if ($posizione == $num1)
		} # fine for $num1
		fclose($file_mercato);
		unset($file_mercato,$linea);

		//    il sistema manda una mail se la propria offerta viene superata
		if ($notifica_rialzo_mercato == "SI"){
			$returnAddress = $email_mittente ;
			$mexmail= "Questa &egrave; una notifica automatica, non rispondere per cortesia.\r\n";
			$mexemail .= "Giocatore: $nome \r\n";
			$mexemail .= "Nuovo Proprietario: $outente ($osquadra)\r\n";
			$mexemail .= "Nuovo Valore: $valore_offerta \r\n";
			if (isset ($proprietario_mail)) {
				for($linean = 0 ; $linean < sizeof($file); $linean++) {
					@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$linean]);
					if ($outente == $proprietario_mail) {$email_ex = $oemail; $oexsquadra = $osquadra ; }
				}
				$mexemail .= "Vecchio proprietario: $proprietario_mail ($oexsquadra) \r\n";
			}
			else $mexemail .= "(Il giocatore era svincolato)";

			if (isset ($vecchio_costo_mail))	$mexemail .= "Vecchio costo: $vecchio_costo_mail \r\n";
			
			$mexemail .= "\r\n\r\n Ricevi questa email perche' sei iscritto al fantacalcio $titolo_sito --- $url_sito \r\n ";
			$intestazioni  = "MIME-Version: 1.0\r\n";
			$intestazioni .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$intestazione .= "From: $titolo_sito Notification <$email_mittente>\r\n" ;
			$intestazioni .= "Bcc: $email_nome_mittente <$email_mittente>\r\n";
			if (isset ($email_ex)) $destinatario = $email_ex ;
			else{
				if ($usa_ML == "SI") $destinatario = $indirizzo_ML ;
				else $destinatario = $email_mittente ;
			}
			if ($safemode)
			$status=mail($destinatario, "Movimento Mercato - Mail automatica" ,$mexemail , $intestazione) ;
			else
			$status=mail($destinatario, "Movimento Mercato - Mail automatica" ,$mexemail , $intestazione,"-f$returnAddress") ;
		} #fine if ($notifica_rialzo_mercato == "SI")
		echo"<br /><br /><br /><center><h3>Offerta inserita!</h3><center>";
		echo "<meta http-equiv='refresh' content='1; url=mercato.php?messgestutente=10'>";
	} # fine if ($inserire == "SI");

	else echo "<br /><br /><br /><center><h3>$frase</h3></center><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
			echo "<meta http-equiv='refresh' content='5; url=mercato.php?messgestutente=10'>";

	echo "</td></tr></table>";
} # fine if ($_SESSION...)
else header("location: logout.php?logout=2");

include("./footer.php");
?>