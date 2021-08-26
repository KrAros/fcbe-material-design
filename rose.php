<?php
	##################################################################################
	#    FANTACALCIOBAZAR EVOLUTION
	#    Copyright (C) 2003-2006 by Antonello Onida (fantacalcio@sassarionline.net)
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
	require './libs/Smarty.class.php';
    require './controlla_pass.php';
    $smarty = new Smarty;
    //$smarty->force_compile = true;
    $smarty->debugging = true;
    $smarty->caching = false;
    $smarty->cache_lifetime = 120;
    
    $smarty->assign("TitoloPagina", "Riepilogo rose");
	$ultima_giornata = ultima_giornata_giocata();
	$smarty->assign("Sottotitolo", "Visualizza le rose dei partecipanti");
	

	###############################
	##### FUNZIONE - Crditi rimasti
	##### Restituisce i crediti rimasti all'utente specificato

	class Controller {
		public function crediti_rimasti($utente) {
			extract($GLOBALS);
			$calciatori = file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
			$num_calciatori = count($calciatori);
			for($num2 = 0; $num2 < $num_calciatori; $num2++) {	
				$dati_calciatore = explode(",", $calciatori[$num2]);
				$proprietario = $dati_calciatore[4];
				if ($proprietario == $utente) {
					$soldi_spesi = $soldi_spesi + $dati_calciatore[3];
					$num_calciatori_posseduti++;
					$surplus = INTVAL($ocrediti);
					$variazioni = INTVAL($ovariazioni);
					$soldi_spendibili = $soldi_iniziali + $surplus + $variazioni - $soldi_spesi;
				}
			}
			if ($num_calciatori_posseduti != null) {
				return $soldi_spendibili; 
			} else { 
				return $soldi_iniziali;
			}	
		}
	}
	$smarty->assign('a', new Controller);
	
	##################################
	##### Inizio controllo rose utenti
	
	if ($_SESSION ['valido'] == "SI" and ($stato_mercato != "I" or $stato_mercato != "R" or $_SESSION ['permessi'] == 4)) {		
		$chiusura_giornata = (int) @file($percorso_cartella_dati."/chiusura_giornata.txt");
		$nome_squadra = "tutti";
		$utenti = @file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
		$linee = count($utenti);
		for($num1 = 1; $num1 < $linee; $num1++) {
			@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $utenti [$num1]);
			$user[] = array( 
				"nick" => $outente,
				"n_utenti" => $linee,
				"reg_data" => $oreg,
				"squadra" => $osquadra,
			);	
			
			$contatore_calciatori = 0;
			$lista_calciatori = "";
			$soldi_spesi = 0;
			$num_calciatori_posseduti = 0;
			$np = 0;
			$nd = 0;
			$nc = 0;
			$nf = 0;
			$na = 0;
			$linea_offerto = "";
			$linea_comprato_P = "";
			$linea_comprato_D = "";
			$linea_comprato_C = "";
			$linea_comprato_F = "";
			$linea_comprato_A = "";
			$tab_comprati = "";
			$tab_offerte = "<table class='sortable responsive-table highlight' style='width:100%' cellpadding='10' cellspacing='0' id='t1'>
			<tr><td class='testa'>Num.</td>
			<td class='testa'>Nome giocatore</td>
			<td class='testa'>Ruolo</td>
			<td class='testa'>Costo</td>
			<td class='testa'>Tempo rimasto</td></tr>";
				
			$calciatori = file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
			array_multisort($calciatori,SORT_NUMERIC,SORT_ASC);	# Ordino numericamente, decrescente, per avere data più recente top
			$np = 0;
			$nd = 0;
			$nc = 0;
			$nf = 0;
			$na = 0;
			$num_calciatori = count($calciatori);
			for($num2 = 0; $num2 < $num_calciatori; $num2++) {
				
				$dati_calciatore = explode(",", $calciatori[$num2]);
				$numero = $dati_calciatore[0];
				$ruolo = $dati_calciatore[2];
				$squadra = $dati_calciatore[6];
				$proprietario = $dati_calciatore[4];
				assegna_ruoli('mercato');
				if ($proprietario == $outente) {
					$soldi_spesi = $soldi_spesi + $dati_calciatore[3];
					$num_calciatori_posseduti++;
					if ($ruolo == "P")
						$np++;
					else if ($ruolo == "D")
						$nd++;
					else if ($ruolo == "C")
						$nc++;
					else if ($ruolo == "F")
						$nf++;
					else if ($ruolo == "A")
						$na++;
				
					$surplus = INTVAL($ocrediti);
					$variazioni = INTVAL($ovariazioni);
					$cambi_effettuati = INTVAL($ocambi);
					$soldi_spendibili = $soldi_iniziali + $surplus + $variazioni - $soldi_spesi;
					$nome = stripslashes ($dati_calciatore[1]);
					$ruolo = $dati_calciatore[2];
					$costo = $dati_calciatore[3];
					$tempo_off = $dati_calciatore[5];
					$anno_off = substr($tempo_off,0,4);
					$mese_off = intval(substr($tempo_off,4,2));
					$giorno_off = substr($tempo_off,6,2);
					$ora_off = substr($tempo_off,8,2);
					$minuto_off = substr($tempo_off,10,2);
					$adesso = mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"));
					$sec_restanti = mktime($ora_off,$minuto_off,0,$mese_off,$giorno_off,$anno_off) - $adesso;
					$lista_calciatori[$contatore_calciatori] = $numero;
					$contatore_calciatori++;
					
					#########################################################################
					##### Inserimento statistiche in array per essere richiamati nel template
					$giocatore[] = array( 
						"nome" => $nome, 
						"ruolo" => $ruolo, 
						"squadra" => $squadra, 
						"backruolo" => $backruolo,
						"attivo" => $csattivo,
						"costo" => $valore,
						"valore_attuale" => $stat_valore,
						"proprietario" => $proprietario,
						"costo" => $costo,
					);
				} # Fine if ($proprietario == $outente)echo $soldi_spendibili;
			} # Fine for $num2
		} # Fine for $num1
	} # Fine if ($_SESSION ['valido'] == "SI")
	$smarty->assign("GiocatoriTabella", $giocatore); # $giocatore è la variabile con il compito di far vedere l'elenco calciatori
	$smarty->assign("UserTabella", $user); # $user è la variabile con il compito di far vedere l'elenco calciatori
	$smarty->display('rose.tpl');
?>