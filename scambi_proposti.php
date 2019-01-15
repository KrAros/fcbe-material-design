<?php
##################################################################################
#    FANTACALCIOBAZAR EVOLUTION
#    Copyright (C) 2003 - 2010 by Antonello Onida
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

if ($_SESSION['valido'] == "SI") {
        require ("./menu.php");

        $calciatori = @file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
        $num_calciatori = count($calciatori);

        for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
                $dati_calciatore = explode(",", $calciatori[$num1]);
                $numero = $dati_calciatore[0];
                $nome = $dati_calciatore[1];
                $nomi[$numero] = $nome;
        } # fine for $num1

        echo "<table summary='scambi' width='100%' class='border' border='1' cellspacing='2' cellpadding='5' align='center' bgcolor='$sfondo_tab'>
        <caption>Proposte di scambio in corso</caption>
        <tr><td class='testa'>Richiedente</td>
        <td class='testa'>Offerta dello scambio</td>
        <td class='testa'>Offerte per</td>
        <td class='testa'>Richieste dello scambio</td>
        <td class='testa'>Tempo rimasto</td>
        <td class='testa'>Opzione</td></tr>";

        $scambi_proposti = @file($percorso_cartella_dati."/scambi_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
        $num_scambi_proposti = count($scambi_proposti);
        for ($num1 = 0 ; $num1 < $num_scambi_proposti ; $num1++) {
                $dati_scambio = explode(",", $scambi_proposti[$num1]);
                $id_scambio = $dati_scambio[0];
                $utente_offerente = $dati_scambio[1];
                $calciatori_offerti = $dati_scambio[2];
                $calciatori_offerti = explode(";", $calciatori_offerti);
                $num_calciatori_offerti = count($calciatori_offerti);
                $soldi_offerti = $dati_scambio[3];
                $utente_richiesto = $dati_scambio[4];
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

                if ($sec_restanti > 0) {
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
                        for ($num2 = 0 ; $num2 < $num_calciatori_offerti ; $num2++) {
                                $numero = $calciatori_offerti[$num2];
                                $nome = $nomi[$numero];
                                if ($nome == "") $nome = "???";
                                if ($num2 == 0) $offerta = $nome;
                                else $offerta .= ", ".$nome;
                        } # fine for $num2
                        if ($soldi_offerti != 0) $offerta .= ", ".$soldi_offerti." Fanta-Euro";
                        for ($num2 = 0 ; $num2 < $num_calciatori_richiesti ; $num2++) {
                                $numero = $calciatori_richiesti[$num2];
                                $nome = $nomi[$numero];
                                if ($nome == "") $nome = "???";
                                if ($num2 == 0) $richiesta = $nome;
                                else $richiesta .= ", ".$nome;
                        } # fine for $num2
                        if ($soldi_richiesti != 0) $richiesta .= ", ".$soldi_richiesti." Fanta-Euro";

                        if ($utente_richiesto == $_SESSION['utente']) $accetta = "<a href='scambio_accetta.php?id_scambio=$id_scambio' class=user>accetta</a> - <a href='scambio_cancella.php?id_scambio=$id_scambio&referente=uno' class='user'>rifiuta</a>";
                        elseif ($utente_offerente == $_SESSION['utente']) $accetta = "<a href='scambio_cancella.php?id_scambio=$id_scambio&referente=due' class='user'>cancella</a>";
                        else $accetta = "&nbsp; - &nbsp;";

                        echo "<tr><td align='left'>$utente_offerente</td>
                        <td align='left'>$offerta</td>
                        <td align='left'>$utente_richiesto</td>
                        <td align='left'>$richiesta</td>
                        <td align='center'>$tempo_restante</td>
                        <td align='center'>$accetta</td></tr>";
						$tempo_restante="";
                } # fine if ($sec_restanti > 0)

        } # fine for $num1

        echo "</table><br/><br/><br/><br/><p align='justify' class='evidenziato' style='PADDING-LEFT: 30px; PADDING-RIGHT: 30px; PADDING-TOP: 30px; PADDING-BOTTOM: 30px;' >Attenzione: la procedura consente di scambiare max 3 giocatori per un numero diverso (1 o 2); le parti interessate ad uno scambio di questo tipo dovranno necessariamente ristabilire la quota stabilita di <b>$max_calciatori</b> calciatori in mercato. <br/><br/>Chi, a seguito di una operazione di mercato sbilanciata, si trover&agrave; ad aver meno calciatori di quelli necessari dovr&agrave; essere in possesso di crediti sufficienti per successivi acquisti, altrimenti non potr&agrave; effettuare modifiche nella squadra. Dovr&agrave; cos&igrave; vendere uno o pi&ugrave; calciatori e con il ricavato ristabilire il numero necessario.<br/><br/>Chi si troverebbe nella situazione di avere pi&ugrave; di <b>$max_calciatori</b> calciatori non potr&agrave; effettuare lo scambio prima di aver ceduto il numero necessario di calciatori.</p>";

} # fine if ($pass_errata != "SI")
else echo"<meta http-equiv='refresh' content='0; url=logout.php'>";

echo "</td></tr></table>";

include("./footer.php");
?>