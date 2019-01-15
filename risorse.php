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
session_start();
header("Cache-control: private");
require_once("./dati/dati_gen.php");
require_once("./inc/funzioni.php");
require("./header.php");
?>
<div class="contenuto">
<div id="articoli">
<div id="sinistra">
<div class="articoli_s">

<?php
unset($filesmcc);
for ($num = 1; $num < 40; $num++) {
	if (strlen($num) == 1) $num = "0".$num;
	$percorso = "dati/2010/MCC$num.txt";
	if (is_file("$percorso")) {
		$filesmcc .= " - <a href='$percorso' target='_blank'>$num</a>";
	} # fine if
	else break;
} # fine for $num

unset($filesvcl);
for ($num = 0; $num < 40; $num++) {
	if (strlen($num) == 1) $num = "0".$num;
	$percorso = "dati/2010/VCL$num.txt";
	if (is_file("$percorso")) {
		$filesvcl .= " - <a href='$percorso' target='_blank'>$num</a>";
	} # fine if
	else break;
} # fine for $num

unset($filesvme);
for ($num = 0; $num < 40; $num++) {
	if (strlen($num) == 1) $num = "0".$num;
	$percorso = "dati/2010/VME$num.txt";
	if (is_file("$percorso")) {
		$filesvme .= " - <a href='$percorso' target='_blank'>$num</a>";
	} # fine if
	else break;
} # fine for $num

echo"<p style='float: left; margin: 0; padding-right: 10px;'>";
immagine_casuale(none,0,0);
echo "</p>";
?>

<br /><br />
<h2>Risorse del FantaCalcioBazar Evolution</h2>
<br /><br />
Fantacalciobazar &egrave; una piattaforma gestionale completa per tornei di fantacalcio sul web, tramite interfaccia di amministrazione e gestione, totalmente online. Viene rilasciato gratuitamente sotto licenza GNU/GPL.
<br /><br />
Il programma &egrave; una procedura completa per la gestione di campionati personalizzabile, con la possibilit&agrave; di gestire tutte le fasi direttamente on-line, acquisto, vendite, scambi e scambi, calcolo voti e classifica.
<br /><br />
Attualmente non utilizza database (i dati vengono registrati su file, ma &egrave;, prevista una futura implementazione), quindi funziona sulla maggior parte dei server gratuiti con supporto per PHP su internet, come per esempio Altervista che ci ospita.
<br /><br />
Pu&ograve; esse configurato per gestire un campionato a scontri diretti o stile Gazzetta, con o senza asta.
<br /><br />
Altre caratteristiche:<br />
- completamente in italiano;<br />
- configurazione semplice, anche via web;<br />
- login con password crittografata e log dei collegamenti;<br />
- selezioni e calcoli automatici;<br />
- editoriale, messaggi e sondaggi e molto altro.
<br /><br />
<img src="./immagini/palloncino.gif" alt="" style="vertical-align: middle;" hspace="15" />&nbsp;&nbsp;&nbsp;download <b>FantaCalcioBazar Evolution 1.5</b><br /> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://fantacalciobazar.sssr.it/websvn" title="Sviluppo">Sviluppo, files, manuale, tracking e subversion</a><br /><br />
<img src="./immagini/palloncino.gif" alt="" style="vertical-align: middle;" hspace="15" />&nbsp;&nbsp;&nbsp;download dati - <a href="dati/calciatori.txt">calciatori.txt (<?php if (file_exists($percorso_cartella_dati."/calciatori.txt")) echo "agg. ".date("d-m-Y H:i:s", filemtime($percorso_cartella_dati."/calciatori.txt")); ?>)</a> <b>(stagione 2010-2011 - <a href='evoluzioni.php?tv=MCC'>statistiche</a>)</b> <?php echo "$filesmcc"; ?> &nbsp;- <a href="votiout.php">Storico voti</a><br /><br />

<img src="./immagini/palloncino.gif" alt="" style="vertical-align: middle;" hspace="15" />&nbsp;&nbsp;&nbsp;download voti Champions League <b>(stagione 2010-2011 - <a href='evoluzioni.php?tv=VCL'>statistiche</a>)</b> <?php echo "$filesvcl"; ?><br /><br />

<img src="./immagini/palloncino.gif" alt="" style="vertical-align: middle;" hspace="15" />&nbsp;&nbsp;&nbsp;<a href="http://fantacalciobazar.sssr.it/wiki/" title='Wiki manuale'>Wiki Mmanuale</a> - <a href="https://docs.google.com/Doc?docid=0AUjBHYxAGNsTZDl2YnRkdl81MDU3bmJ4cGMy" title="Manuale lato Utente" target="_blank"><b>Manuale lato utente</b></a> - <a href="https://docs.google.com/Doc?docid=0Aff07cDc0fB3ZGRoZm14bmdfMTUwcDhrNHYzYzk" title="Manuale lato amministratore" target="_blank"><b>Manuale lato amministratore</b></a> <br /><br />

<img src="./immagini/palloncino.gif" alt="" style="vertical-align: middle;" hspace="15" />&nbsp;&nbsp;&nbsp;<a href="./doc/cambiamenti.txt"  title="file cambiamenti.txt" target="_blank">file cambiamenti.txt</a> - <a href="./licenza.php" title="Licenza">licenza GNU/GPL v2</a>
</div>
</div></div>
<?php
echo "<div id='destra'>";
include("./menu_i.php");
echo "</div>";
include("./footer.php");
?>