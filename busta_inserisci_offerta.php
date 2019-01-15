<?php
#################################################################################
#    FANTACALCIOBAZAR
#    Copyright (C) 2003-2007 by Antonello Onida (fantacalcio@sssr.it)
#    Copyright (C) 2001-2002 by Marco Maria Francesco De Santis (marcods@gmx.net)
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
require ("./controlla_pass.php");
require ("./header.php");

    if ($_SESSION['valido'] == "SI") {
    require ("./menu.php");
        $file = file($percorso_cartella_dati."/utenti_".$_SESSION['torneo'].".php");
        ######################################
        ##### Controlla numero ultima giornata

        if ($stato_mercato != "I") {
            for ($num1 = "01" ; $num1 < 50 ; $num1++) {
                if (strlen($num1) == 1) $num1 = "0".$num1;
            $giornata = "giornata$num1";
                if (@is_file("$percorso_cartella_dati/$giornata")) $ultima_giornata = "";
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
            $frase_voti = "<font color=red>Dati dell'ultima giornata ancora non presenti.</font><br> Valutazione alla giornata $ultima_giornata";
            $blocco=1;
            }
        }
        else {
        $cerca_valutazione = file("$percorso_cartella_dati/calciatori.txt");
        $calciatori = file("$percorso_cartella_dati/calciatori.txt");
        $frase_voti = "Dati di precampionato";
        }

    $valore_offerta=intval($valore_offerta);
    $sostituire = "SI";
    $trovato = "NO";
    $inserire = "SI";
    $soldi_spesi = 0;
    $vecchio_proprietario = "";
    $nuovo_costo = "";
    $num_calciatori_posseduti = 0;
    $lock = fopen("$percorso_cartella_dati/mercato.lock","wb+");
    flock($lock,LOCK_EX);

    $calciatori = @file("$percorso_cartella_dati/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
    $num_calciatori = count($calciatori);

        for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {
        $dati_calciatore = explode(",", $calciatori[$num1]);
        $numero = $dati_calciatore[0];
        $proprietario = $dati_calciatore[4];

            if ($proprietario == $_SESSION['utente']) {
            $soldi_spesi = $soldi_spesi + $dati_calciatore[3];
            $num_calciatori_posseduti++;
            } # fine if ($proprietario == $_SESSION['utente'])

            if ($num_calciatore == $numero and $dati_calciatore[4] == $_SESSION['utente']) {
            $nome = $dati_calciatore[1];
            $ruolo = $dati_calciatore[2];
            $trovato = "SI";
            $posizione = $num1;
            $costo = $dati_calciatore[3];
            $proprietario_vero = $proprietario;
            $vecchio_proprietario = $dati_calciatore[6];
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

if ($stato_mercato != "B") {
                if ($sec_restanti < 0) {
                $inserire = "NO";
                $frase .= "Tempo scaduto per questa offerta!<br>";
                } # fine if ($sec_restanti < 0)
} # fine if ($stato_mercato != "B")

                if ($nuovo_costo) { $costo_mostra = $nuovo_costo; }
                else { $costo_mostra = $costo; }
    
        if ($stato_mercato !="B") {
                if ($costo_mostra >= $valore_offerta) {
                $inserire = "NO";
                $frase .= "L'offerta non &egrave; abbastanza alta per comprare il calciatore.<br>";
                } # fine if ($costo >= $valore_offerta)
        } # fine if ($stato_mercato !="B")
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
            } # fine if ($num_calciatore == $numero)
        } # fine for $num1
    } # fine if ($trovato != "SI")

        if ($trovato != "SI") {
        $inserire = "NO";
        $frase .= "Calciatore inesistente, sei un BARO! - $trovato<br>";
        } # fine if ($trovato != "SI")

        if ($num_calciatore == "") {
        $inserire = "NO";
        $frase .= "Calciatore inesistente.<br>";
        } # fine if ($num_calciatore == "")

        if ($nuova_offerta == "SI" and $stato_mercato == "S") {
        $inserire = "NO";
        echo "<center>Il mercato &egrave; <b>sospeso</b> in questo momento.</center><br>";
        } # fine if ($nuova_offerta == "SI" and $stato_mercato == "S")

        if ($stato_mercato == "C") {
        $inserire = "NO";
        echo "<center>Il mercato &egrave; <b>chiuso</b> in questo momento.</center><br>";
        } # fine if ($stato_mercato == "C")

    $verifica_num = ereg_replace("[0-9]","",$valore_offerta);

        if ($verifica_num != "" or $valore_offerta == "" or $valore_offerta == 0) {
        $inserire = "NO";
        $frase .= "L'offerta deve essere un numero intero positivo.<br>";
        } # fine if ($verifica_num != "" or $valore_offerta == "" or $valore_offerta == 0)

    $num_calciatori_comprabili = $max_calciatori - $num_calciatori_posseduti;

    @list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocittà, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$_SESSION['uid']]);
    $surplus = (int) $ocrediti;
    $variazioni = (int) $ovariazioni;

    if ($vecchio_proprietario == $_SESSION['utente'] and $vecchio_proprietario != $proprietario_vero) {
    $surplus = $surplus - $costo + $vecchio_costo;
    } # fine if ($vecchio_proprietario == $_SESSION['utente'])
    $soldi_spendibili = $soldi_iniziali + $surplus + $variazioni - $soldi_spesi;
    if ($num_calciatori_comprabili <= 0 AND $mod != "SI") {
    $inserire = "NO";
    $frase .= "Hai raggiunto il valore massimo di calciatori comperabili.<br>";
    } # fine if ($num_calciatori_comprabili <= 0)
    if ($soldi_spendibili < abs($valore_offerta-$costo_mostra)) {
    $inserire = "NO";
    $frase .= "Errore sul calcolo dei soldi a tua disposizione. Ecco i casi in cui potresti essere caduto:<br><br><br>";
    $frase .= "La tua offerta supera i soldi che hai a disposizione.<br><br><br>";
    //$frase .= "Volevi modificare l'offerta per il calciatore.<br>In questo caso TOGLILO dalla busta chiusa e riproponi l'offerta con l'importo desiderato.<br>";
    } # fine if ($soldi_spendibili <= $valore_offerta)

    if ($inserire == "SI") {
    if ($sostituire == "NO") {
    $posizione == 0;
    $num_calciatori++;
    } # fine if ($sostituire == "NO")
    $file_mercato = fopen("$percorso_cartella_dati/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt","wb+");
    flock($file_mercato,LOCK_EX);
    for ($num1 = 0 ; $num1 < $num_calciatori ; $num1++) {

    if ($posizione == $num1) {
    $anno_attuale = date("Y");
    $mese_attuale = date("m");
    $giorno_attuale = date("d");
    $ora_attuale = date("H");
    $minuto_attuale = date("i");
    $secondo_attuale = date("s");
    
        if ($stato_mercato == "B") $scadenza = date("YmdHis");
        else $scadenza= "0";

    $linea = "$num_calciatore,$nome,$ruolo,$valore_offerta,".$_SESSION['utente'].",$scadenza";

    if ($vecchio_proprietario) {
    $linea .= ",$vecchio_proprietario,$vecchio_costo";
    if ($vecchio_proprietario == $_SESSION['utente']) {
    if ($vecchio_proprietario != $proprietario_vero) { $aggiungi_surplus = $vecchio_costo - $costo; }
    else { $aggiungi_surplus = 0; }
    } # fine if ($vecchio_proprietario == $_SESSION['utente'])
    else {
    if ($vecchio_proprietario == $proprietario_vero) {
    $aggiungi_surplus = $valore_offerta - $vecchio_costo;
    } # fine if ($vecchio_proprietario == $proprietario_vero)
    else { $aggiungi_surplus = $valore_offerta - $costo; }
    } # fine else if ($vecchio_proprietario == $_SESSION['utente'])
$linee = count($file);
for($linea = 0 ; $linea < $linee; $linea++) {
@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$linea]);
    if ($outente == $vecchio_proprietario) $file[$linea] =  $outente."<del>".$opass."<del>".$opermessi."<del>".$oemail."<del>".$ourl."<del>".$osquadra."<del>".$ocitta."<del>".$aggiungi_surplus."<del>".$ovariazioni."<del>".$ocambi."<del>".$oreg;
}

$agg_file = fopen("./dati/utenti_".$_SESSION['torneo'].".php", "wb");
flock($agg_file,LOCK_EX);
$conta= count($file);
for($i = 0; $i < $conta; $i++){
fwrite($agg_file, $file[$i]);
}
flock($agg_file,LOCK_UN);
fclose($agg_file);

# $lockutente = fopen("$percorso_cartella_dati/squadra_$vecchio_proprietario.lock","wb+");
# flock($lockutente,2);
# $linee = @file("$percorso_cartella_dati/squadra_$vecchio_proprietario");
# $filesquadra = fopen("$percorso_cartella_dati/squadra_$vecchio_proprietario","wb+");
# flock($filesquadra,2);
# $num_linee = count($linee);
# if ($num_linee < 1) { $num_linee = 1; }
# $nuovo_surplus = $linee[0] + $aggiungi_surplus;
# $linee[0] = "$nuovo_surplus
# ";
# rewind($filesquadra);
# for ($num2 = 0 ; $num2 < $num_linee ; $num2++) {
# fwrite($filesquadra,$linee[$num2]);
# } # fine for $num2
# flock($filesquadra,3);
# flock($lockutente,3);

} # fine if ($vecchio_proprietario)

fwrite($file_mercato,"$linea\r\n");
    } # fine if ($posizione == $num1)

    else {
    if ($sostituire == "NO") { $num_linea = $num1 - 1; }
    else { $num_linea = $num1; }
    fwrite($file_mercato,$calciatori[$num_linea]);
    } # fine else if ($posizione == $num1)
    } # fine for $num1
    flock($file_mercato,LOCK_UN);
    fclose($file_mercato);
    flock($lock,LOCK_UN);
    echo "<meta http-equiv=\"refresh\" content=\"2; url=mercato.php\">
    <br><br><br><center><h4>Offerta inserita!</h4><center><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br>\n";
    } # fine if ($inserire == "SI");

    else echo "<br><br><br><center><h4>$frase</h4></center><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";


echo "</td></tr></table>";
} # fine if ($_SESSION...)
else echo"<meta http-equiv=\"refresh\" content=\"0; url=logout.php\">";

require("./footer.php");
?>