<?php
##################################################################################
#    FANTACALCIOBAZAR EVOLUTION
#    Copyright (C) 2003-2006 by Antonello Onida (fantacalciobazar@sassarionline.net)
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
require_once("./dati/dati_gen.php");
require_once("./inc/funzioni.php");

$tornei = @file($percorso_cartella_dati."/tornei.php");
$num_tornei = count($tornei);
$layout = "<table cellpadding='20'><caption>Tornei in corso</caption>
<tr><th colspan='2'>Sono di seguito elencati i tornei in corso di svolgimento, con i dettagli di gioco.</th></tr>";

	for ($num1 = 1 ; $num1 < $num_tornei; $num1++) {
	@list($otid, $otdenom, $otpart, $otserie, $otmercato_libero, $ottipo_calcolo, $otgiornate_totali, $otritardo_torneo, $otcrediti_iniziali, $otnumcalciatori, $otcomposizione_squadra, $temp1, $temp2, $temp3, $temp4, $otstato, $otmodificatore_difesa, $otschemi, $otmax_in_panchina, $otpanchina_fissa, $otmax_entrate_dalla_panchina, $otsostituisci_per_ruolo, $otsostituisci_per_schema,  $otsostituisci_fantasisti_come_centrocampisti, $otnumero_cambi_max, $otrip_cambi_numero, $otrip_cambi_giornate, $otrip_cambi_durata, $otaspetta_giorni, $otaspetta_ore, $otaspetta_minuti, $otnum_calciatori_scambiabili, $otscambio_con_soldi, $otvendi_costo, $otpercentuale_vendita, $otsoglia_voti_primo_gol, $otincremento_voti_gol_successivi, $otvoti_bonus_in_casa, $otpunti_partita_vinta, $otpunti_partita_pareggiata, $otpunti_partita_persa, $otdifferenza_punti_a_parita_gol, $otdifferenza_punti_zero_a_zero, $otmin_num_titolari_in_formazione, $otpunti_pareggio, $otpunti_pos, $otreset_scadenza) = explode(",", $tornei[$num1]);
	
		$file = @file($percorso_cartella_dati."/utenti_".$otid.".php");
		$linee = count($file);
		$num_giocatori = 0;
	
		for($numx = 1 ; $numx < $linee; $numx++) {
		@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$numx]);
			if ($otorneo == $otid) $num_giocatori++;
		}
		if ($otpart==0) ($otpart="nessun limite");
		if ($otstato != "Z") {
		$layout .= "<tr><td valign='top'><b>ID torneo: $otid<br/>
		Denominazione: $otdenom</b><br/>
		Numero partecipanti: $otpart<br/>
		Giocatori attualmente iscritti: $num_giocatori<br/>
		Numero serie $otserie<br/>
		Mercato libero: $otmercato_libero<br/>
		Tipo calcolo: $ottipo_calcolo<br/>
		Giornate totali: $otgiornate_totali<br/>
		Ritardo inizio: $otritardo_torneo<br/>
		Crediti iniziali: $otcrediti_iniziali<br/>
		Composizione rosa: $otnumcalciatori<br/>
		Composizione rosa: $otcomposizione_squadra<br/>
		Stato mercato: $otstato<br/>
		Modificatore difesa: $otmodificatore_difesa<br/>
		Schemi applicabili: $otschemi<br/> 
		Giocatori in panchina: $otmax_in_panchina<br/> 
		Panchina fissa: $otpanchina_fissa<br/> 
		Max sostituzioni: $otmax_entrate_dalla_panchina<br/> 
		Sostituzioni per ruolo: $otsostituisci_per_ruolo<br/> 
		Sostituzioni per schema: $otsostituisci_per_schema<br/>  
		Fantasisti per centrocampisti: $otsostituisci_fantasisti_come_centrocampisti<br/> 
		Da definire: $temp1,$temp2,$temp3,$temp4
		</td><td valign='top'>";
	
			if($otmercato_libero == "SI"){
			$layout .= "ID torneo: $otid<br/>
			<u>Mercato libero: giocatori condivisi e cambi stile magiccampionato</u>.<br/>
			Numero massimo di cambi:$otnumero_cambi_max<br/> 
			Cambi in riparazione: $otrip_cambi_numero<br/> 
			Giornate di riparazione: $otrip_cambi_giornate<br/> 
			Durata riparazione: $otrip_cambi_durata<br/>
			<br /><u>Dati utili per gli scontri diretti</u><br/>
			Soglia voti primo gol: $otsoglia_voti_primo_gol<br/> 
			Incremento voti gol successivo: $otincremento_voti_gol_successivi<br/> 
			Bonus in casa: $otvoti_bonus_in_casa<br/> 
			Punti partita vinta: $otpunti_partita_vinta<br/> 
			Punti partita pareggiata: $otpunti_partita_pareggiata<br/> 
			Punti partita persa: $otpunti_partita_persa<br/> 
			Differenza punti a parita gol: $otdifferenza_punti_a_parita_gol<br/> 
			Differenza punti zero a zero: $otdifferenza_punti_zero_a_zero<br/> 
			Titolari minimi a referto: $otmin_num_titolari_in_formazione<br/><br/> 
			<u>Dati per i campionati a punti per posizione di giornata.</u><br/>
			Punti pareggio: $otpunti_pareggio<br/> 
			Punti per posizione: $otpunti_pos";
			}
			elseif($otmercato_libero == "NO"){
			$layout .= "ID torneo: $otid<br/>
			<u>Asta iniziale, e scambio, acquisti e vendite secondo il classico modo di gioco</u><br/>
			Tempo attesta asta: giorni $otaspetta_giorni<br/> 
			Tempo attesta asta: ore $otaspetta_ore<br/> 
			Tempo attesta asta: minuti $otaspetta_minuti<br/> 
			Max scambi: $otnum_calciatori_scambiabili<br/> 
			Scambi con crediti: $otscambio_con_soldi<br/> 
			Vendita al costo: $otvendi_costo<br/> 
			Percentuale di vendita: $otpercentuale_vendita<br/>
			<br /><u>Dati utili per gli scontri diretti</u><br/>
			Soglia voti primo gol: $otsoglia_voti_primo_gol<br/> 
			Incremento voti gol successivo: $otincremento_voti_gol_successivi<br/> 
			Bonus in casa: $otvoti_bonus_in_casa<br/> 
			Punti partita vinta: $otpunti_partita_vinta<br/> 
			Punti partita pareggiata: $otpunti_partita_pareggiata<br/> 
			Punti partita persa: $otpunti_partita_persa<br/> 
			Differenza punti a parita gol: $otdifferenza_punti_a_parita_gol<br/> 
			Differenza punti zero a zero: $otdifferenza_punti_zero_a_zero<br/> 
			Titolari minimi a referto: $otmin_num_titolari_in_formazione<br/><br/> 
			<u>Dati per i campionati a punti per posizione di giornata.</u><br/>
			Punti pareggio: $otpunti_pareggio<br/> 
			Punti per posizione: $otpunti_pos";
			}
			else $layout .= "<b>Torneo non ancora definito</b>";
		$layout .= "</td></tr>";
		} # fineif ($otstato != "Z") 
	} # fine for $num1
$layout .= "</table>";
include("./header.php");
echo "
<div class='contenuto'>
	<div id='articoli'>
	$layout
	</div>
</div>";
include("./footer.php");
?>