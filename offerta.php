<?php
	##################################################################################
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
	
	if ($_SESSION['valido'] == "SI") {
		require ("./menu.php");
		$mercato = @file("$percorso_cartella_dati/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
		
		$chiusura_giornata = (INT) @file("$percorso_cartella_dati/chiusura_giornata.txt");
		
		if ($chiusura_giornata != 1) {
			
			######################################
			##### Controlla numero ultima giornata
			
			if ($stato_mercato != "I") {
				for ($num1 = "01" ; $num1 < 40 ; $num1++) {
					if (strlen($num1) == 1) $num1 = "0".$num1;
					if (@is_file("$percorso_cartella_voti/voti$num1.txt")) $ultima_giornata = "";
					else {
						$ultima_giornata = $num1 - 1;
						if (strlen($ultima_giornata) == 1) $ultima_giornata = "0".$ultima_giornata;
						break;
					} # fine else
					} # fine for $num1
					} # if mercato iniziale
					
					if ($stato_mercato != "I" AND $ultima_giornata >= 1) {
					$cerca_valutazione = file("$percorso_cartella_voti/voti$ultima_giornata.txt");
					$calciatori = file("$percorso_cartella_dati/calciatori.txt");
					if (@is_file("$percorso_cartella_voti/voti$ultima_giornata.txt")) {
					$cerca_valutazione = file("$percorso_cartella_voti/voti$ultima_giornata.txt");
					$frase_voti = "Dati aggiornati all'ultima giornata";
					}
					else {
					$ultima_giornata--;
					$cerca_valutazione = file("$percorso_cartella_voti/voti$ultima_giornata.txt");
					$frase_voti = "<font color='red'>Dati dell'ultima giornata ancora non presenti.</font><br/> Valutazione alla giornata $ultima_giornata";
					$blocco=1;
					}
					}
					else {
					$cerca_valutazione = file("$percorso_cartella_dati/calciatori.txt");
					$calciatori = file("$percorso_cartella_dati/calciatori.txt");
					$frase_voti = "Dati di precampionato";
					}
					
					echo "<br/><table align='center' width='98%' bgcolor='$sfondo_tab' cellpadding='10' cellspacing='0' border='0' class='border'><tr><td class='testa1'>Acquisto calciatori</td></tr><tr><td align='center'><br/><u>$frase_voti</u><br/>";
					if ($mercato_libero == "NO" AND $xsquadra_ok != "NO") {
					
					echo "<center><font class='evidenziato'><b>Attenzione!!!</b><br/>Confermando la procedura &eacute; irreversibile</font>.<br/>Procedere con cura leggendo attentamente tutti i messaggi che sono visualizzati.</center><br/><br/>";
					
					$trovato = "NO";
					$offribile = "SI";
					$soldi_spesi = 0;
					$num_calciatori_posseduti = 0;
					echo "<br/><table width='90%' border='1' cellspacing='2' cellpadding='2' class='border' align='center' bgcolor='$sfondo_tab'>
					<tr><td class='testa'>Num.</td>
					<td class='testa'>Nome</td>
					<td class='testa'>Ruolo</td>
					<td class='testa'>Costo</td>
					<td class='testa'>Proprietario</td>
					<td class='testa'>Tempo rimasto</td></tr>";
					
					$num_calciatori = count($mercato);
					for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
					$dati_calciatore = explode(",", $mercato[$num1]);
					$numero = $dati_calciatore[0];
					$proprietario = $dati_calciatore[4];
					
					if ($proprietario == $_SESSION['utente']) {
					$soldi_spesi = $soldi_spesi + $dati_calciatore[3];
					$num_calciatori_posseduti++;
					} # fine if ($proprietario == $_SESSION['utente'])
					
					if ($num_calciatore == $numero) {
					$trovato = "SI";
					$nome = $dati_calciatore[1];
					$nome = preg_replace("#\"#","",$nome);
					$ruolo = $dati_calciatore[2];
					$costo = $dati_calciatore[3];
					$proprietario_vero = $proprietario;
					$tempo_off = $dati_calciatore[5];
					$anno_off = substr($tempo_off,0,4);
					$mese_off = substr($tempo_off,4,2);
					$giorno_off = substr($tempo_off,6,2);
					$ora_off = substr($tempo_off,8,2);
					$minuto_off = substr($tempo_off,10,2);
					$secondo_off =substr($tempo_off,12,2);
					$adesso = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));
					$sec_restanti = mktime($ora_off,$minuto_off,0,$mese_off,$giorno_off,$anno_off) - $adesso;
					
					if ($sec_restanti < 1) {
					$tempo_restante = "COMPRATO";
					$offribile = "NO";
					$trovato = "SI";
					} # fine if ($sec_restanti < 1)
					else {
					$tempo_restante="";
					$giorni=floor($sec_restanti/86400);
					$secondi_resto=$sec_restanti-($giorni*86400); 
					$ore=floor($secondi_resto/3600);
					$secondi_resto=$sec_restanti-($giorni*86400)-($ore*3600);
					$minuti= floor($secondi_resto/60);
					$secondi_resto = $sec_restanti-($giorni*86400)-($ore*3600)-$minuti*60;
					
					if ($giorni > 0) {
					if ($giorni > 1) $tempo_restante .= $giorni." giorni";
					else $tempo_restante .= $giorni." giorno";
					}
					
					if ($ore > 0) {
					if ($tempo_restante != "") $tempo_restante .= ", ";
					if ($ore > 1) $tempo_restante .= $ore." ore";
					else $tempo_restante .= $ore." ora";
					}
					
					if ($minuti > 0) {
					if ($tempo_restante != "") $tempo_restante .= ", ";
					if ($minuti > 1) $tempo_restante .= $minuti." minuti";
					else $tempo_restante .= $minuti." minuto";
					}
					
					if ($giorni == 0 AND $ore == 0 AND $minuti == 0 AND $secondi_resto > 0) $tempo_restante .= $secondi_resto." secondi";
					$vecchio_proprietario = $dati_calciatore[6];
					$vecchio_costo = $dati_calciatore[7];
					$nuovo_costo = $dati_calciatore[8];
					} # fine else if ($sec_restanti < 0)
					
					if ($vecchio_proprietario) { $proprietario_mostra = "$proprietario <font size='-2'>(precedente offerta di $vecchio_proprietario)</font>"; }
					else { $proprietario_mostra = $proprietario; }
					if ($nuovo_costo) { $costo_mostra = $nuovo_costo; }
					else { $costo_mostra = $costo; }
					
					$tempo=$anno_off.", ".$mese_off."-1, ".$giorno_off.", ".$ora_off.", ".$minuto_off.", ".$secondo_off; #formato 2012, 8-1, 02, 13, 14
					countdown($numero,$tempo);
					
					
					echo"<tr><td align='center'>$numero</td>
					<td>$nome</td>
					<td align='center'>$ruolo</td>
					<td align='center'>$costo_mostra</td>
					<td align='center'>$proprietario_mostra</td>
					<td align='center'><div id='$numero'></div></td></tr>";
					} # fine if ($num_calciatore == $numero)
					} # fine for $num1
					
					if ($trovato != "SI") {
					$nuova_offerta = "SI";
					$num_calciatori = count($calciatori);
					
					for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
					$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori[$num1]);
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
					echo"<tr><td>$numero</td>
					<td>$nome</td>
					<td align='center'>$ruolo</td>
					<td align='center'>----</td>
					<td align='center'>----</td>
					<td align='center'>----</td></tr>";
					} # fine if ($num_calciatore == $numero)
					} # fine for $num1
					} # fine if ($trovato != "SI")
					} # fine 	if ($mercato_libero == "NO" AND $xsquadra_ok != "NO")
					
					else {
					
					if ($stato_mercato != "I") $calciatori = @file("$percorso_cartella_voti/voti$ultima_giornata.txt");
					else $calciatori = @file("$percorso_cartella_dati/calciatori.txt");
					echo "<center><font class='evidenziato'><b>Attenzione!!!</b><br/>L'offerta rappresenta un impegno vincolante ed irreversibile.<br/>Una volta che si conferma non &eacute; possibile ritirare o recedere dall'impegno, a meno che l'offerta non sia superata da un altro giocatore.<br/><br/>
					Eventuali errori o ripensamenti potranno essere sistemati nel mercato di riparazione.<br/><br/>Procedere con cura leggendo attentamente tutti i messaggi che sono visualizzati.</font></center><br/><br/>";
					
					echo "<br/><table width='80%' border='1' cellspacing='2' cellpadding='2' class='border' align='center' bgcolor='$sfondo_tab'>
					<tr><td class='testa'>Num.</td>
					<td class='testa'>Nome</td>
					<td class='testa'>Ruolo</td>
					<td class='testa'>Val.</td>
					<td class='testa'>Squadra</td></tr>";
					
					$trovato = "NO";
					$offribile = "SI";
					$soldi_spesi = 0;
					$num_calciatori_posseduti = 0;
					$num_calciatori_mercato = count($mercato);
					
					for ($num1 = 0 ; $num1 < $num_calciatori_mercato ; $num1++) {
					$dati_calciatore = explode(",", $mercato[$num1]);
					$numero = $dati_calciatore[0];
					$proprietario = $dati_calciatore[4];
					
					if ($proprietario == $_SESSION['utente']) {
					$soldi_spesi = $soldi_spesi + $dati_calciatore[3];
					$num_calciatori_posseduti++;
					} # fine if ($proprietario == $_SESSION['utente'])
					} # fine for $num1
					
					###################################################
					$num_calciatori = count($calciatori);
					
					for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
					$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori[$num1]);
					$numero = $dati_calciatore[0];
					$proprietario = $dati_calciatore[4];
					
					if ($num_calciatore == $numero) {
					$trovato = "SI";
					$nome = $dati_calciatore[2];
					$nome = togli_acapo($nome);
					$ruolo = $dati_calciatore[5];
					$xsquadra = $dati_calciatore[3];
					$xsquadra = togli_acapo($xsquadra);
					$costo = $dati_calciatore[27];
					$nome = ereg_replace("\"","",$nome);
					$xsquadra = ereg_replace("\"","",$xsquadra);
					
					if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
					if ($ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
					if ($ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
					if ($ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
					if ($ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
					if ($ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";
					
					echo"<tr><td align='center'>$numero</td>
					<td>$nome</td>
					<td align='center'>$ruolo</td>
					<td align='center'>$costo</td>
					<td align='center'>$xsquadra</td></tr>";
					break;
					
					} # fine if ($num_calciatore == $numero)
					} # fine for $num1
					
					####################################################
					
					if ($trovato != "SI") {
					$nuova_offerta = "SI";
					$calciatori = file("$percorso_cartella_voti/calciatori.txt");
					$num_calciatori = count($calciatori);
					
					for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
					$dati_calciatore = explode($separatore_campi_file_calciatori, $calciatori[$num1]);
					$numero = $dati_calciatore[($num_colonna_numcalciatore_file_calciatori-1)];
					$numero = togli_acapo($numero);
					
					if ($num_calciatore == $numero) {
					$trovato = "SI";
					$nome = $dati_calciatore[($num_colonna_nome_file_calciatori-1)];
					$nome = togli_acapo($nome);
					$nome = ereg_replace("\"","",$nome);
					$s_ruolo = $dati_calciatore[($num_colonna_ruolo_file_calciatori-1)];
					$s_ruolo = togli_acapo($s_ruolo);
					$ruolo = $s_ruolo;
					if ($considera_fantasisti_come != "P" and $considera_fantasisti_come != "D" and $considera_fantasisti_come != "C" and $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
					if ($s_ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
					if ($s_ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
					if ($s_ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
					if ($s_ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
					if ($s_ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";
					echo"<tr><td align='center'>$numero</td>
					<td>$nome</td>
					<td align='center'>$ruolo</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td></tr>";
					} # fine if ($num_calciatore == $numero)
					} # fine for $num1
					} # fine if ($trovato != "SI")
					} # fine else if ($mercato_libero == "NO" AND $xsquadra_ok == "SI")
					
					if ($trovato != "SI") {
					$offribile = "NO";
					echo "<tr><td colspan='6' align='center'>Giocatore inesistente, sei un BARO!</td></tr>";
					} # fine if ($trovato != "SI")
					
					echo "</table>";
					
					if ($nuova_offerta == "SI" and $stato_mercato == "S") {
					$offribile = "NO";
					echo "<br/><center><font class='evidenziato'>Il mercato &eacute; <b>sospeso</b> in questo momento.<font></center><br/>";
					} # fine if ($nuova_offerta == "SI" and $stato_mercato == "S")
					
					if ($stato_mercato == "C") {
					$offribile = "NO";
					echo "<br/><center><font class='evidenziato'>Il mercato &eacute; <b>chiuso</b> in questo  momento.</font></center><br/>";
					} # fine if ($stato_mercato == "C")
					
					$num_calciatori_comprabili = $max_calciatori - $num_calciatori_posseduti;
					$np = 0; $nd = 0; $nc = 0; $nf = 0; $na = 0;
					$calciatori = @file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
					$num_calciatori = count($calciatori);
					for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
					$dati_calciatori[$num1] = explode(",", $calciatori[$num1]);
					$dati_calciatore = $dati_calciatori[$num1];
					$ruolo = $dati_calciatore[2];
					if ($_SESSION['utente'] == $proprietario) {
					if ($ruolo == "P") $np++;
					else if ($ruolo == "D") $nd++;
					else if ($ruolo == "C") $nc++;
					else if ($ruolo == "F") $nf++;
					else if ($ruolo == "A") $na++;
					} # fine if ($proprietario == $_SESSION['utente'])
					}
					if ($max_calciatori != $num_calciatori_posseduti) {
					
					$schema_giocatori = "$np$nd$nc$nf$na";
					$verifica_sg = "";
					$num_giocons = count($composizione_squadra);
					for ($num1 = 0 ; $num1 < $num_giocons ; $num1++) {
					$verifica_sg .= "$composizione_squadra[$num1]<br />";
					
					} # fine for $num1
					
					$error="";
					
					switch ($ruolos) {
					case "P": {
					if ($np >= substr($verifica_sg,0,1)) { 
					$error="<center><br/><br/><h4>Hai superato il limite massimo di acquisti per questo ruolo ($np)</center></h4>";
					$offribile = "NO";}
					break;	}
					case "D":{
					if ($nd >= substr($verifica_sg,1,1))  {
					$error="<center><br/><br/><h4>Hai superato il limite massimo di acquisti per questo ruolo ($nd)</center></h4>";
					$offribile = "NO";}
					break;}	
					case "C":{
					if ($nc >= substr($verifica_sg,2,1))  {
					$error="<center><br/><br/><h4>Hai superato il limite massimo di acquisti per questo ruolo ($nc)</center></h4>";
					$offribile = "NO";}
					break;}	
					case "F":{
					if ($considera_fantasisti_come == "F") {
					if ($nf >= substr($verifica_sg,3,1))  {
					$error="<center><br/><br/><h4>Hai superato il limite massimo di acquisti per questo ruolo ($nf)</center></h4>";
					$offribile = "NO";}
					}
					break;}
					case "A":	{		
					if ($na >= substr($verifica_sg,4,1))  {
					$error="<center><br/><br/><h4>Hai superato il limite massimo di acquisti per questo ruolo ($na)</center></h4>";
					$offribile = "NO";}
					break;}		
					}
					
					echo $error;
					
					}	
					
					$ifile = file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
					@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $ifile[$_SESSION['uid']]);
					
					$surplus = $ocrediti;
					$variazioni = $ovariazioni;
					$soldi_spendibili = $soldi_iniziali + $surplus + $variazioni - $soldi_spesi;
					
					if ($vecchio_proprietario == $_SESSION['utente'] and $vecchio_proprietario != $proprietario_vero) {
					$togliere_surplus = $vecchio_costo -  $costo;
					$frase_togliere = " (meno $togliere_surplus Fanta-Euro per acquistare questo giocatore)";
					} # fine if ($vecchio_proprietario == $_SESSION['utente'] and ...)
					
					if ($num_calciatori_comprabili <= 0 or $soldi_spendibili <= 0) { $offribile = "NO"; }
					
					echo "<center><br/>FantaEuro ancora da spendere: <b>$soldi_spendibili</b> $frase_togliere.<br/>
					Numero di calciatori ancora comperabili: <b>$num_calciatori_comprabili</b>.</center><br/>";
					
					
					$costo_mostra_min=$costo_mostra+1;
					
					if ($offribile == "SI" AND $stato_mercato == "I") {
					echo "<center><br/><form method='post' action='inserisci_offerta.php'>
					Fai una offerta per <b>$nome</b> di
					<input type='text' name='valore_offerta' size='8' value='$costo_mostra_min' />
					Fanta-Euro.<br/>
					<input type='hidden' name='num_calciatore' value='$num_calciatore' />
					<input type='submit' name='invia' value='Invia' />
					</form></center>";
					} # fine if ($offribile == "SI"...
					elseif ($offribile == "SI" AND $stato_mercato == "P") {
					echo "<center><br/><form method='post' action='inserisci_offerta.php'>
					Fai una offerta per <b>$nome</b> di
					<input type='text' name='valore_offerta' size='8' value='$costo_mostra_min' />
					Fanta-Euro.<br/>
					<input type='hidden' name='num_calciatore' value='$num_calciatore' />
					<input type='submit' name='invia' value='Invia' />
					</form></center>";
					} # fine if ($offribile == "SI"...
					elseif ($offribile == "SI" AND $stato_mercato == "A") {
					
					##### Controlla numero ultima giornata
					
					$ultima_giornata = ultima_giornata_giocata();
					
					if ($ultima_giornata == "00") $cerca_valutazione = file("$percorso_cartella_dati/calciatori.txt");
					else $cerca_valutazione = file("$percorso_cartella_voti/voti$ultima_giornata.txt");
					$num_cer_val = count($cerca_valutazione);
					
					for ($num2 = 0 ; $num2 < $num_cer_val ; $num2++) {
					$dati_cervalcal = explode($separatore_campi_file_calciatori, $cerca_valutazione[$num2]);
					$num_cervalcal = $dati_cervalcal[($num_colonna_numcalciatore_file_calciatori-1)];
					$num_cervalcal = togli_acapo($num_cervalcal);
					
					if ($num_cervalcal == $num_calciatore) {
					$valore_offerta = $dati_cervalcal[($num_colonna_valore_calciatori-1)];
					$valore_offerta = togli_acapo($valore_offerta);
					break;
					}
					}
					#####################
					
					if ($soldi_spendibili >= $valore_offerta) {
					$offribile = "NO";
					echo "<center><br/><form method='POST' action='inserisci_acquisto.php'>
					Il valore del calciatore <b>$nome</b> ($num_calciatore) che vorresti acquistare &eacute; di <b>$valore_offerta</b> FantaEuro.<br/><br/>
					<input type='hidden' name='valore_offerta' value='$valore_offerta' />
					<input type='hidden' name='num_calciatore' value='$num_calciatore' />
					<input type='submit' name='invia' value='Conferma acquisto' />
					</form></center>";
					}
					else if ($tempo_restante < 1) echo "Il valore del calciatore <b>$nome</b> ($num_calciatore) che vorresti acquistare &eacute; di <b>$valore_offerta</b> FantaEuro.<br/>Tempo Scaduto, il giocatore &eacute; stato assegnato.";			
					else echo "Il valore del calciatore <b>$nome</b> ($num_calciatore) che vorresti acquistare &eacute; di <b>$valore_offerta</b> FantaEuro.<br/>Non hai crediti sufficienti per acquistarlo.";
					
					} # fine elseif
					
					if ($soldi_spendibili <= 0) echo "<center><br/><br/><h4>Non hai piu' crediti !!!!</h4><br/></center>"; 
					if($stato_mercato == "P") echo "<center><h4>Sei in ASTA PERENNE. Per fare delle offerte dovresti prima vendere un calciatore!</h4></center>"; 
					
					echo "</td></tr></table>";
					} # fine if ($chiusura_giornata != 1)
					else {
					echo "<br/><table align='center' bgcolor='$sfondo_tab' cellpadding='10' cellspacing='0' border='0' class='border'><tr><td class='testa'>Giornata chiusa</td></tr><tr><td>";
					echo "Non &eacute; pi&ugrave; consentito effettuare operazioni per questa giornata!<br/>Attendere fino a quando viene creata la prossima giornata.</td></tr></table>";
					}
					
					} # fine if ($_SESSION...)
					else header("location: logout.php?logout=2");
					
					echo "</td></tr></table>";
					include("./footer.php");
					?>					