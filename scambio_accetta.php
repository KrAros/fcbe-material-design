<?php
##################################################################################
#    FANTACALCIOBAZAR EVOLUTION
#    Copyright (C) 2003-2008 by Antonello Onida
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
$debug = 'NO';

if ($_SESSION['valido'] == "SI") {
	require ("./menu.php");

	$id_scambio=$_GET['id_scambio'];
	$referente=$_GET['referente'];
	
	echo "<br /><br /><table bgcolor='$sfondo_tab' align='center' cellpadding='20' class='border'><tr><td><center><h3>Scambio di calciatori</h3><font class='evidenziato'><b>Attenzione!!!</b><br />Confermando la procedura &eacute; irreversibile</font>.<br />Procedere con cura leggendo attentamente tutti i messaggi che sono visualizzati.<br /><br />";

	$trovato = "NO";
	$num_calciatori_posseduti = 0;
	$num_calciatori_effettivi = 0;
	$soldi_spesi = 0;
	$calciatori_utente = "";
	$num_calciatori_posseduti_altro = 0;
	$num_calciatori_effettivi_altro = 0;
	$soldi_spesi_altro = 0;
	$calciatori_altro = "";
	$calciatori_offerti = "";
	$calciatori_richiesti = "";
	$num_calciatori_offerti = 0;
	$num_calciatori_richiesti = 0;
	$lista_off = "";
	$lista_ric = "";
	$ini_lista_off = "";
	$ini_lista_ric = "";

	$scambi_proposti = @file($percorso_cartella_dati."/scambi_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
	$num_scambi_proposti = count($scambi_proposti);

	for ($num1 = 0 ; $num1 < $num_scambi_proposti ; $num1++) {
		$dati_scambio = explode(",", $scambi_proposti[$num1]);
		if ($id_scambio == $dati_scambio[0]) {
			$trovato = "SI";
			$utente_offerente = $dati_scambio[1];
			$calciatori_offerti = $dati_scambio[2];
			$calciatori_offerti = explode(";", $calciatori_offerti);
			$num_calciatori_offerti = count($calciatori_offerti);
			$soldi_offerti = $dati_scambio[3];
			$utente_richiesto = $dati_scambio[4];
			
				if ($utente_richiesto != $_SESSION['utente']) $trovato = "NO";
			
			$calciatori_richiesti = $dati_scambio[5];
			$calciatori_richiesti = explode(";", $calciatori_richiesti);
			$num_calciatori_richiesti = count($calciatori_richiesti);
			$soldi_richiesti = $dati_scambio[6];
			$tempo_off = $dati_scambio[7];
			$tempo_off = togli_acapo($tempo_off);
			$anno_off = substr($tempo_off,0,4);
			$mese_off = substr($tempo_off,4,2);
			$giorno_off = substr($tempo_off,6,2);
			$ora_off = substr($tempo_off,8,2);
			$minuto_off = substr($tempo_off,10,2);
			$adesso = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));
			$sec_restanti = mktime($ora_off,$minuto_off,0,$mese_off,$giorno_off,$anno_off) - $adesso;
			
				if ($sec_restanti < 0) $trovato = "NO";
			
			break;
		} # fine if ($id_scambio == $dati_scambio[0])
	} # fine for $num1

	if ($trovato == "NO") echo "<center><h3>Proposta di scambio non trovata.</h3>";

	else {

		if ($stato_mercato == "C") {
			echo "<center>Il mercato &eacute; <b>chiuso</b> in questo momento.</center><br />";
		} # fine if ($stato_mercato == "C")
		else {

			if (!$_POST['sicuro']) {
				echo "<center><form method='POST' action='$SCRIPT_NAME'>
				<b>$utente_richiesto</b>, sei sicuro di voler accettare lo scambio proposto da <b>$utente_offerente</b> (Crediti richiesti: $soldi_richiesti - Crediti offerti: $soldi_offerti)?<br /><br />
				<input type='hidden' name='id_scambio' value='$id_scambio' />
				<input type='submit' name='sicuro' value='Conferma scambio' />
				</form></center>";
			} # fine if (!$sicuro)
			else {
				$calciatori = @file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
				$num_calciatori = count($calciatori);

				for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
					$dati_calciatore = explode(",", $calciatori[$num1]);
					$numero = $dati_calciatore[0];
					$nome = $dati_calciatore[1];
					$costo = $dati_calciatore[3];
					$tempo_off = $dati_calciatore[5];
					$anno_off = substr($tempo_off,0,4);
					$mese_off = substr($tempo_off,4,2);
					$giorno_off = substr($tempo_off,6,2);
					$ora_off = substr($tempo_off,8,2);
					$minuto_off = substr($tempo_off,10,2);
					$adesso = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));
					$sec_restanti = mktime($ora_off,$minuto_off,0,$mese_off,$giorno_off,$anno_off) - $adesso;
					$proprietario = $dati_calciatore[4];

					if ($proprietario == $_SESSION['utente']) {
						$soldi_spesi = $soldi_spesi + $dati_calciatore[3];
						$num_calciatori_posseduti++;
						if ($sec_restanti < 0) {
							$num_calciatori_effettivi++;
							$nomi_calciatori_utente[$num_calciatori_effettivi] = $nome;
							$num_calciatori_utente[$num_calciatori_effettivi] = $numero;
							$calciatori_utente[$numero] = "SI";
						} # fine if ($sec_restanti < 0)
					} # fine if ($proprietario == $_SESSION['utente'])

					if ($proprietario == $utente_offerente) {
						$soldi_spesi_altro = $soldi_spesi_altro + $dati_calciatore[3];
						$num_calciatori_posseduti_altro++;
						if ($sec_restanti < 0) {
							$num_calciatori_effettivi_altro++;
							$nomi_calciatori_altro[$num_calciatori_effettivi_altro] = $nome;
							$num_calciatori_altro[$num_calciatori_effettivi_altro] = $numero;
							$calciatori_altro[$numero] = "SI";
						} # fine if ($sec_restanti < 0)
					} # fine if ($proprietario == $altro_utente)

				} # fine for $num1

				for ($num1 = 0 ; $num1 < $num_calciatori_richiesti ; $num1++) {
					$calciatore_scambio_utente = $calciatori_richiesti[$num1];
					if ($calciatori_utente[$calciatore_scambio_utente] != "SI" and $calciatore_scambio_utente != "") {
						$scambiare = "NO";
						echo "Nella richiesta c'&eacute; un calciatore non pi&ugrave; in tuo possesso.<br />";
					} # fine if ($calciatori_utente[$calciatore_scambio_utente] != "SI" and...
				} # fine for $num1
				
				for ($num1 = 0 ; $num1 < $num_calciatori_offerti ; $num1++) {
					$calciatore_scambio_altro = $calciatori_offerti[$num1];
					if ($calciatori_altro[$calciatore_scambio_altro] != "SI" and $calciatore_scambio_utente != "") {
						$scambiare = "NO";
						echo "Nell'offerta c'&eacute; un calciatore non pi&ugrave; posseduto da $utente_offerente.<br />";
					} # fine if ($calciatori_utente[$calciatore_scambio_utente] != "SI" and...
				} # fine for $num1

				$num_calciatori_dopo = $num_calciatori_posseduti + $num_calciatori_offerti - $num_calciatori_richiesti;
				
				if ($num_calciatori_dopo > $max_calciatori) {
					$scambiare = "NO";
					echo "Dopo lo scambio avresti pi&ugrave; di $max_calciatori calciatori.<br />";
				} # fine if ($num_calciatori_dopo > $max_calciatori)
				
				$num_calciatori_dopo_altro = $num_calciatori_posseduti_altro + $num_calciatori_richiesti - $num_calciatori_offerti;
				
				if ($num_calciatori_dopo_altro > $max_calciatori) {
					$scambiare = "NO";
					echo "Dopo lo scambio $utente_offerente avrebbe pi&ugrave; di $max_calciatori calciatori.<br />";
				} # fine if ($num_calciatori_dopo > $max_calciatori)

				$filei = file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
				$linee = count($filei);

				for($num1 = 1 ; $num1 < $linee; $num1++) {
					@list($ooutente, $oopass, $oopermessi, $ooemail, $oourl, $oosquadra, $oocittà, $oocrediti, $oovariazioni, $oocambi, $ooreg) = explode("<del>", $file[$num1]);
					if ($ooutente == $utente_offerente) {
						$uid_altro = $num1;
						break;
					}
				}
				@list($o1utente, $o1pass, $o1permessi, $o1email, $o1url, $o1squadra,  $o1torneo, $o1serie, $o1città, $o1crediti, $o1variazioni, $o1cambi, $o1reg, $o1titolari, $o1panchina, $o1nome, $o1cognome) = explode("<del>", trim($file[$_SESSION['uid']]));
				@list($o2utente, $o2pass, $o2permessi, $o2email, $o2url, $o2squadra,  $o2torneo, $o2serie, $o2città, $o2crediti, $o2variazioni, $o2cambi, $o2reg, $o2titolari, $o2panchina, $o2nome, $o2cognome) = explode("<del>", trim($file[$uid_altro]));
				if ($scambio_con_soldi =="SI") {
				$soldi_spendibili = $soldi_iniziali + $o1crediti + $o1variazioni - $soldi_spesi;

				if ($soldi_richiesti > $soldi_spendibili) {
					$scambiare = "NO";
					echo "Sono richiesti pi&ugrave; crediti di quelli da te posseduti.<br />";
				} # fine if ($soldi_richiesti > $soldi_spendibili)

				$soldi_spendibili_altro = $soldi_iniziali + $o2crediti + $o2variazioni - $soldi_spesi_altro;
				if ($soldi_offerti > $soldi_spendibili_altro) {
					$scambiare = "NO";
					echo "I soldi offerti sono pi&ugrave; di quelli posseduti da $utente_offerente.<br />";
				} # fine if ($soldi_offerti > $soldi_spendibili_altro)
				}
				# se i controlli sono andati bene effettuo lo scambio
				if ($scambiare != "NO") {
					$file_mercato = fopen($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt","w+");
					flock($file_mercato,LOCK_EX);
					for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
						$dati_calciatore = explode(",", $calciatori[$num1]);
						$numero = $dati_calciatore[0];
						$nome = $dati_calciatore[1];
						$ruolo = $dati_calciatore[2];
						$costo = $dati_calciatore[3];
						$tempo_off = $dati_calciatore[5];
						$tempo_off = togli_acapo($tempo_off);
						$scritto_linea = "NO";

						for ($num2 = 0 ; $num2 < $num_calciatori_richiesti ; $num2++) {
							if ($numero == $calciatori_richiesti[$num2]) {
								$linea = "$numero,$nome,$ruolo,$costo,$utente_offerente,$tempo_off\n";
								fwrite($file_mercato,$linea);
								if ($debug == "SI") echo "Linea mercato richiedente: $linea<br />";
								$costo_calciatori_richiesti = $costo_calciatori_richiesti + $costo;
								$scritto_linea = "SI";
								if ($ini_lista_ric) $lista_ric .= " + $nome";
								else $lista_ric = "$nome";
								$ini_lista_ric = "SI";
							} # fine if ($numero = $calciatori_richiesti[$num2])
						} # fine for $num2
						for ($num2 = 0 ; $num2 < $num_calciatori_offerti ; $num2++) {
							if ($numero == $calciatori_offerti[$num2]) {
								$linea = "$numero,$nome,$ruolo,$costo,".$_SESSION['utente'].",$tempo_off\n";
								fwrite($file_mercato,$linea);
								if ($debug == "SI") echo "Linea mercato offerente: $linea<br />";
								$costo_calciatori_offerti = $costo_calciatori_offerti + $costo;
								$scritto_linea = "SI";
								if ($ini_lista_off) $lista_off .= " + $nome";
								else $lista_off = "$nome";
								$ini_lista_off = "SI";
							} # fine if ($numero = $calciatori_offerti[$num2])
						} # fine for $num2
						if ($scritto_linea == "NO") {
							fwrite($file_mercato,$calciatori[$num1]);
							if ($debug == "SI") echo $calciatori[$num1]."<br/>";
						} # fine if ($scritto_linea == "NO")
					} # fine for $num1
					flock($file_mercato,LOCK_UN);
					fclose($file_mercato);
					
					$aggiungi_surplus_utente = $soldi_offerti - $soldi_richiesti + $o1crediti;
					$aggiungi_surplusvar_utente = $costo_calciatori_offerti - $costo_calciatori_richiesti + $o1variazioni;
					
					$aggiungi_surplus_offerente = $soldi_richiesti - $soldi_offerti  + $o2crediti;
					$aggiungi_surplusvar_offerente = $costo_calciatori_richiesti - $costo_calciatori_offerti + $o2variazioni;
/*					
					echo "----------------------------<br>
					aggiungi_surplus_utente = soldi_offerti - soldi_richiesti + o1crediti;<br>
					$aggiungi_surplus_utente = $soldi_offerti - $soldi_richiesti + $o1crediti;<br>
					<br>
					<br>
					aggiungi_surplusvar_utente = costo_calciatori_offerti - costo_calciatori_richiesti + o1variazioni;<br>
					$aggiungi_surplusvar_utente = $costo_calciatori_offerti - $costo_calciatori_richiesti + $o1variazioni;<br>
					<br>
					<br>
					aggiungi_surplus_offerente = soldi_richiesti - soldi_offerti  + o2crediti;<br>
					$aggiungi_surplus_offerente = $soldi_richiesti - $soldi_offerti  + $o2crediti;<br>
					<br>
					<br>
					aggiungi_surplusvar_offerente = costo_calciatori_richiesti - costo_calciatori_offerti + o2variazioni;<br>
					$aggiungi_surplusvar_offerente = $costo_calciatori_richiesti - $costo_calciatori_offerti + $o2variazioni;<br>
					";
*/					
										
					$agg_utente1 = $o1utente."<del>".$o1pass."<del>".$o1permessi."<del>".$o1email."<del>".$o1url."<del>".$o1squadra."<del>".$o1torneo."<del>".$o1serie."<del>".$o1citta."<del>".$aggiungi_surplus_utente."<del>".$aggiungi_surplusvar_utente."<del>".$o1cambi."<del>".$o1reg. "<del>0<del>0<del>".$o1nome."<del>".$o1cognome."<del>0<del>0<del>0<del>0<del>0<del>0<del>0<del>0";
					$agg_utente2 = $o2utente."<del>".$o2pass."<del>".$o2permessi."<del>".$o2email."<del>".$o2url."<del>".$o2squadra."<del>".$o2torneo."<del>".$o2serie."<del>".$o2citta."<del>".$aggiungi_surplus_offerente."<del>".$aggiungi_surplusvar_offerente."<del>".$o2cambi."<del>".$o2reg. "<del>0<del>0<del>".$o2nome."<del>".$o2cognome."<del>0<del>0<del>0<del>0<del>0<del>0<del>0<del>0";

					$filei = file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
					$linee = count($filei);
					for($linea = 0 ; $linea < $linee; $linea++) {
						@list($ooutente, $oopass, $oopermessi, $ooemail, $oourl, $oosquadra, $oocittà, $oocrediti, $oovariazioni, $oocambi, $ooreg, $ootitolari, $oopanchina, $oonome, $oocognome) = explode("<del>", trim($filei[$linea]));
						if ($ooutente == $o1utente) $filei[$linea] = $agg_utente1."\n";
						if ($ooutente == $o2utente) $filei[$linea] = $agg_utente2."\n";
					}
					$nuovo_file = implode("",$filei);

					$agg_file = fopen($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php", "wb");
					flock($agg_file,LOCK_EX);
					fwrite($agg_file, $nuovo_file);
					if ($debug == "SI") echo $nuovo_file."<br/>";
					flock($agg_file,LOCK_UN);
					fclose($agg_file);
					
					$scambi_proposti = @file($percorso_cartella_dati."/scambi_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
					$num_scambi_proposti = count($scambi_proposti);

					$file_scambi = fopen($percorso_cartella_dati."/scambi_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt","wb+");
					flock($file_scambi,LOCK_EX);
					$adesso = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));

					for ($num1 = 0 ; $num1 < $num_scambi_proposti ; $num1++) {
						# se lo scambio &egrave; scaduto non lo riscrivo
						$dati_scambio = explode(",", $scambi_proposti[$num1]);
						$tempo_off = $dati_scambio[7];
						$tempo_off = togli_acapo($tempo_off);
						$anno_off = substr($tempo_off,0,4);
						$mese_off = substr($tempo_off,4,2);
						$giorno_off = substr($tempo_off,6,2);
						$ora_off = substr($tempo_off,8,2);
						$minuto_off = substr($tempo_off,10,2);
						$sec_restanti = mktime($ora_off,$minuto_off,0,$mese_off,$giorno_off,$anno_off) - $adesso;
						if ($sec_restanti > 0 AND $id_scambio != $dati_scambio[0]) fwrite($file_scambi,$scambi_proposti[$num1]);
					} # fine for $num1
					
					flock($file_scambi,LOCK_UN);
					fclose($file_scambi);

					if ($soldi_richiesti != 0) $lista_ric .= " + $soldi_richiesti FantaEuro";
					if ($soldi_offerti != 0) $lista_off .= " + $soldi_offerti FantaEuro";
					$nuovo_messaggio = $_SESSION['utente']." ha accettato lo scambio proposto da $utente_offerente per $lista_ric in cambio di $lista_off";
					$file_messaggi = fopen($percorso_cartella_dati."/registro_mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt","ab+");
					flock($file_messaggi,LOCK_EX);
					fwrite($file_messaggi,$acapo."Radio mercato: ".date("d/m/Y H:i")." - ".$nuovo_messaggio);
					if ($debug == "SI") echo"Radio mercato: ".date("d/m/Y H:i")." - ".$nuovo_messaggio;
					flock($file_messaggi,LOCK_UN);
					fclose($file_messaggi);
					echo "Lo scambio &eacute; stato effettuato!<br />";
				} # fine if ($scambiare != "NO")

				if ($scambiare == "NO") echo "<b>Scambio non permesso</b>.<br />";
			} # fine else if (!$sicuro)
		} # fine else if ($stato_mercato == "C")
	} # fine else if ($trovato == "NO")
	echo "</center></tr></table>";
} # fine elseif ($_SESSION['utente'] == "admin")
else echo"<meta http-equiv='refresh' content='0; url=logout.php'>";
echo"</td></tr></table>";
include("./footer.php");
?>