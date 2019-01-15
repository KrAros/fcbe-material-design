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
$escludi_controllo = $_GET['escludi_controllo'];

if ($escludi_controllo != "SI") require_once ("./controlla_pass.php");
else require ("./dati/dati_gen.php");

include("./header.php");

$data_busta_chiusa = @join('', @file("./dati/data_buste_".$_SESSION['torneo']."_0.txt"));
$data_busta_precedente = @join('', @file("./dati/data_buste_precedente_".$_SESSION['torneo']."_0.txt"));
if ($_SESSION['valido'] == "SI" or $escludi_controllo == "SI") {
	require ("./menu.php");

	######################################
	##### Controlla numero ultima giornata

	if ($stato_mercato != "I") {
		for ($num1 = 1; $num1 < 40; $num1++) {
			if (strlen($num1) == 1) $num1 = "0".$num1;
			if (@is_file("$percorso_cartella_voti/voti$num1.txt")) $ultima_giornata=0;
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
			$frase_voti = "Dati aggiornati all'ultima giornata <b>$ultima_giornata</b>";
		}
		else {
			$ultima_giornata--;
			$cerca_valutazione = file("$percorso_cartella_voti/voti$ultima_giornata.txt");
			$frase_voti = "<font color=red>Dati dell'ultima giornata ancora non presenti.</font><br/> Valutazione alla giornata <b>$ultima_giornata</b>";
			$blocco=1;
		}
	}
	else {
		$cerca_valutazione = @file("$percorso_cartella_dati/calciatori.txt");
		$calciatori = @file("$percorso_cartella_dati/calciatori.txt");
		$frase_voti = "Dati relativi al precampionato.";
	}

	#######################################

	$num_calciatori = count($cerca_valutazione);
	$layout = "<table summary='Calciatori' width='100%' align='center' bgcolor='$sfondo_tab' id='t1' class='sortable'>
	<caption>Elenco calciatori<br/>$frase_voti</caption>
	<tr><th>&nbsp;&nbsp;Numero&nbsp;&nbsp;</th>
	<th width='30%'>Nome</th>
	<th>Ruolo</th>
	<th>Operazioni</th>
	<th>Valutazione</th>";

	if ($mercato_libero == "SI") $layout .="<th width='15%'>Costo iniziale</th>";
	else $layout .="<th width='15%'>Proprietario</th>";

	$layout .="<th width='20%'>Squadra</th></tr>";

	for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {

		$valore_mercato = " - ";

		$dati_calciatore = explode($separatore_campi_file_calciatori, $cerca_valutazione[$num1]);
		$numero = $dati_calciatore[($num_colonna_numcalciatore_file_calciatori-1)];
		$numero = trim($numero);
		$numgio = $dati_calciatore[1];
		$nome = stripslashes($dati_calciatore[($num_colonna_nome_file_calciatori-1)]);
		$nome = trim($nome);
		$nome = ereg_replace("\"","",$nome);
		$s_ruolo = $dati_calciatore[($num_colonna_ruolo_file_calciatori-1)];
		$s_ruolo = trim($s_ruolo);
		$ruolo = $s_ruolo;
		$valutazione = $dati_calciatore[($num_colonna_valore_calciatori-1)];
		$valutazione = trim($valutazione);
		$xsquadra = $dati_calciatore[($num_colonna_squadra_file_calciatori-1)];
		$xsquadra = trim($xsquadra);
		$xsquadra = ereg_replace("\"","",$xsquadra);
		$attivo = $dati_calciatore[($ncs_attivo-1)];
		$attivo = trim($attivo);

		if ($considera_fantasisti_come != "P" AND $considera_fantasisti_come != "D" AND $considera_fantasisti_come != "C" AND $considera_fantasisti_come != "A") $considera_fantasisti_come = "F";
		if ($s_ruolo == $simbolo_fantasista_file_calciatori) $ruolo = $considera_fantasisti_come;
		if ($s_ruolo == $simbolo_portiere_file_calciatori) $ruolo = "P";
		if ($s_ruolo == $simbolo_difensore_file_calciatori) $ruolo = "D";
		if ($s_ruolo == $simbolo_centrocampista_file_calciatori) $ruolo = "C";
		if ($s_ruolo == $simbolo_attaccante_file_calciatori) $ruolo = "A";

		if ($ruolo == $ruolo_guarda or $ruolo_guarda == "tutti") {
			$num_cer_val = count($calciatori);

			for ($num2 = 0 ; $num2 < $num_cer_val ; $num2++) {
				$dati_cervalcal = explode($separatore_campi_file_calciatori, $calciatori[$num2]);
				$num_cervalcal = $dati_cervalcal[($num_colonna_numcalciatore_file_calciatori-1)];
				$num_cervalcal = trim($num_cervalcal);

				if ($num_cervalcal == $numero) {
					$costo = $dati_cervalcal[($num_colonna_valore_calciatori-1)];
					$costo = trim($costo);
					break;
				}
				else $costo = "-";

			}

			$proprietario = "<font color='navy' size='1'>Svincolato</font>";
			$propr_c = "";
			$props = "";
			$calciatori_merc = @file($percorso_cartella_dati."/mercato_".$_SESSION[torneo]."_".$_SESSION[serie].".txt");
			$num_calciatori_merc = count($calciatori_merc);
			$n = $num_calciatori_merc -1;

			for ($num2 = 0 ; $num2 < $num_calciatori_merc ; $num2++) {
				$dati_calciatore_merc = explode(",", $calciatori_merc[$num2]);
				$numero_merc = $dati_calciatore_merc[0];
				$proprietario_merc = $dati_calciatore_merc[4];
				$tempo_off = $dati_calciatore_merc[5];
				$tempo_off_mer=0;

				if ($numero_merc == $numero) {
					$props .= "$proprietario_merc ";
					if ($proprietario_merc == $_SESSION['utente']) {
						$propr_c = $proprietario_merc;
					}
					if ($stato_mercato != "B") $proprietario = "<font color='red' size='-2'>$proprietario_merc</font>";
					$tempo_off_mer = $tempo_off;
                    if ($stato_mercato == "B" )   {
                        $proprietario = "<font color='red' size='-2'>". $_SESSION['utente']." </font>";
						if ($propr_c != $_SESSION['utente'] AND (double)substr($tempo_off_mer,0,12) <= (double)substr($data_busta_precedente,0,12) ) {
							$proprietario = "<font color='red' size='-2'>$proprietario_merc</font>";
							$azione = "<a >Venduto</a>"; 
						}
                    }
                    
				}
			} # fine for $num2

			if ($mercato_libero == "NO"){
				if ($stato_mercato == "B"){
		            $ultima_riga = explode(",",$calciatori_merc[$n]);
            if($ultima_riga[0]=="" AND $n > 1) $diff_giri = $ultima_riga[1] - $data_busta_chiusa;
            else $diff_giri = 0;
            if (strlen($tempo_off_mer)==16) $tempo_off_mer = substr($tempo_off_mer,0,12);
            $diff = $tempo_off_mer - $data_busta_chiusa;
					if($propr_c == $_SESSION['utente'] AND ($diff == "0" OR $diff == $diff_giri)){ $azione = "Acquisito nella Busta";
					$proprietario = "<font color='red' size='-2'>$_SESSION[utente]</font>";
				}
				elseif ($propr_c == $_SESSION['utente']) $azione = "Inserito nella Busta";
elseif ($propr_c != $_SESSION['utente'] AND ($diff == 0 OR $diff == $diff_giri)){
                         $azione = "<a href=\"scambia.php?num_calciatore=$numero&amp;altro_utente=$proprietario_merc\" class=\"user\">scambia</a>";
                         $proprietario = "<font color='red' size='-2'>$propr_c</font>";
                    }
                    
				elseif ($propr_c != $_SESSION['utente'] AND !isset($azione)){
                 $azione = "<a href=\"busta_offerta.php?num_calciatore=$numero&valutazione=$valutazione&xsquadra_ok=$xsquadra_ok&mercato_libero=$mercato_libero\" class=user>offri</a>";
                 $proprietario = "<font color='navy' size='1'>Svincolato</font>";
                }      
              //  elseif ($propr_c != $_SESSION['utente']) $azione = "<a href=\"busta_offerta.php?num_calciatore=$numero&valutazione=$valutazione&xsquadra_ok=$xsquadra_ok&mercato_libero=$mercato_libero\" class=user>offri</a>";
                 

                //elseif (isset($dati_calciatore_merc[4])) $azione = "Venduto";
			} #fine if ($stato_mercato=B)
			elseif ($proprietario == "<font color='navy' size='1'>Svincolato</font>" AND $stato_mercato == "I") $azione = "<a href='offerta.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=$xsquadra_ok&amp;mercato_libero=$mercato_libero' class='user'>offri</a>";
			elseif ($proprietario == "<font color='navy' size='1'>Svincolato</font>" AND $stato_mercato == "B") $azione = "<a href='busta_offerta.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=$xsquadra_ok&amp;mercato_libero=$mercato_libero' class='user'>offri con busta</a>";
			elseif ($proprietario == "<font color='navy' size='1'>Svincolato</font>" AND $stato_mercato == "R") $azione = "<a href='compra.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=$xsquadra_ok' class='user'>compra</a>";
			elseif ($proprietario == "<font color='navy' size='1'>Svincolato</font>" AND $stato_mercato == "P") $azione = "<a href='offerta.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=$xsquadra_ok&amp;mercato_libero=$mercato_libero' class='user'>offri</a>";
			elseif ($proprietario == "<font color='navy' size='1'>Svincolato</font>" AND $stato_mercato == "A") $azione = "<a href='offerta.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=$xsquadra_ok&amp;mercato_libero=$mercato_libero' class='user'>offri</a>";
			elseif ($_SESSION['utente'] != $propr_c AND $stato_mercato == "B") $azione = "<a href='busta_offerta.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=$xsquadra_ok&amp;mercato_libero=$mercato_libero' class='user'>offri con busta</a>";
			elseif ($_SESSION['utente'] != $propr_c AND $stato_mercato == "I") $azione = "<a href='offerta.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=$xsquadra_ok&amp;mercato_libero=$mercato_libero' class='user'>offri</a>";
			elseif ($_SESSION['utente'] != $propr_c AND $stato_mercato == "P") $azione = "<a href='offerta.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=$xsquadra_ok&amp;mercato_libero=$mercato_libero' class='user'>offri</a>";
			elseif ($_SESSION['utente'] != $propr_c AND $stato_mercato == "S") $azione = "<a href='scambia.php?num_calciatore=$numero&amp;altro_utente=$proprietario_merc' class='user'>scambia</a>";
			elseif ($_SESSION['utente'] != $propr_c AND $stato_mercato == "A") $azione = "<a href='scambia.php?num_calciatore=$numero&amp;altro_utente=$proprietario_merc' class='user'>scambia</a>";

			elseif ($_SESSION['utente'] == $propr_c AND $stato_mercato == "B") $azione = "<a href='busta_vendi.php?num_calciatore=$numero' class='user'>togli dalla busta</a>";
			elseif ($_SESSION['utente'] == $propr_c AND $stato_mercato == "I") $azione = "<a href='vendi.php?num_calciatore=$numero' class='user'>vendi</a>";
			elseif ($_SESSION['utente'] == $propr_c AND $stato_mercato == "R") $azione = "<a href='vendi.php?num_calciatore=$numero' class='user'>vendi</a>";
			elseif ($_SESSION['utente'] == $propr_c AND $stato_mercato == "A") $azione = "<a href='vendi.php?num_calciatore=$numero' class='user'>vendi</a>";
			elseif ($_SESSION['utente'] == $propr_c AND $stato_mercato == "P") $azione = "<a href='vendi.php?num_calciatore=$numero' class='user'>vendi</a>";

			else $azione = "-";
		}
		elseif ($mercato_libero == "SI") {
			if ($xsquadra_ok == "NO" AND $_SESSION['utente'] != $propr_c) $azione = "<a href='compra.php?num_calciatore=$numero&amp;valutazione=$valutazione&amp;xsquadra_ok=NO' class='user'>compra</a>";
			elseif ($stato_mercato == "I" AND $_SESSION['utente'] == $propr_c) $azione = "<a href='vedi_vendi_subito.php?num_calciatore=$numero' class='user'>svincola</a>";
			elseif ($stato_mercato == "I" AND $_SESSION['utente'] != $propr_c) $azione = "<a href='compra.php?num_calciatore=$numero&amp;valutazione=$valutazione' class='user'>compra</a>";
			elseif ($stato_mercato == "R" AND $_SESSION['utente'] == $propr_c) $azione = "<a href='vedi_vendi_subito.php?num_calciatore=$numero' class='user'>svincola</a>";
			elseif ($stato_mercato == "A" AND $_SESSION['utente'] != $propr_c) $azione = "<a href='cambi_tra.php?num_calciatore=$numero' class='user'>cambi</a>";
			else $azione = "-";
		}
		else $azione = "Errore di configurazione";

		if ($stato_mercato == "C") $azione = "Mercato chiuso";
		if ($attivo == "0")  $azione = "<font color='red'><b>Trasferito</b></font>";
		if ($num1 % 2) $colore="#FFFFFF"; else $colore="$colore_riga_alt";
		if ($blocco == 1) $azione = "<font color='red'>Attendere aggiornamento</font>";

		if ($stato_mercato != "I") $link_info = "<a href='stat_calciatore.php?num_calciatore=$numero&amp;ruolo_guarda=$ruolo_guarda' class='user'>$numero</a>";
		else $link_info = "<u>$numero</u>";

		if ($stato_mercato == "A" AND $mercato_libero == "SI" AND $props AND $pallinogiallo == "SI") $info = "<img src='./immagini/info1.gif' style='border:0; margin:0;' title='$props' alt='$props' />";

		$layout .="<tr bgcolor=$colore>
		<td align='center'>$link_info</td>
		<td align='left'>&nbsp;$nome $info</td>
		<td align='center'>&nbsp;$ruolo</td>
		<td align='center'>&nbsp;$azione</td>
		<td align='center'>".intval($valutazione)."</td>";

		if ($mercato_libero == "SI") $layout .="<td align='center'>".intval($costo)."</td>";
		else $layout .="<td align='center'>&nbsp;$proprietario</td>";

		$layout .="<td align='center'><a href='tab_squadre_tra.php?vedi_squadra=$xsquadra' class='user'>$xsquadra</a></td></tr>";
	} # fine if ($ruolo == $ruolo_guarda or ...)
	UNSET($azione,$nome,$propr_c,$ruolo,$valutazione,$costo,$proprietario,$xsquadra,$props,$info);
} # fine for $num1
$layout .="</table>";
tabella_squadre_tra();
echo "<script type='text/javascript' src='./inc/js/ordina_tabella.js'></script>";
echo $layout;
} # fine if ($pass_errata != "SI")
include("./footer.php");
?>