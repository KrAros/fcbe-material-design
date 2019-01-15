<?php
##################################################################################
#    FANTACALCIOBAZAR
#    Copyright (C) 2003 - 2005 by Antonello Onida (fantacalcio@sassarionline.net)
#    Copyright (C) 2001 - 2002 by Marco Maria Francesco De Santis (marcods@gmx.net)
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
require ("./menu.php");

	echo "<center><h4>Totale cambi effettuati</h4></center>";
	echo"<br/><table align=\"center\" bgcolor=\"$sfondo_tab1\" cellpadding=\"5\"><tr valign=\"top\"><td>";
	$file = file($percorso_cartella_dati."/utenti_".$_SESSION["torneo"].".php");
	$linee = sizeof($file);
	echo"<table align=\"center\" class=\"border\" bgcolor=\"$sfondo_tab\">
<tr><td class=\"testa\"></td><td class=\"testa\">&nbsp;Cambi&nbsp;</tr>";
		for($num2 = 1 ; $num2 < $linee; $num2++) {
		@list($outente, $opass, $opermessi, $oemail, $ourl, $osquadra, $otorneo, $oserie, $ocitta, $ocrediti, $ovariazioni, $ocambi, $oreg) = explode("<del>", $file[$num2]);
			if ($outente != "admin") {
			$soprannome_squadra = $osquadra;

				if (!$soprannome_squadra) $soprannome_squadra = "Squadra di $outente";

			$mercato = @file($percorso_cartella_dati."/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt");
			$conta_mercato = count($mercato);
				for ($num3 = 0 ; $num3 < $conta_mercato; $num3++) {
				$dati_mercato = explode(",", $mercato[$num3]);
				$numero = $dati_mercato[0];
				$nome = $dati_mercato[1];
				$ruolo = $dati_mercato[2];
				$costo = $dati_mercato[3];
				$proprietario = $dati_mercato[4];
				$scadenza = $dati_mercato[5];
					if ($outente == $dati_mercato[4]){
					$num_calc++;
					$tot_costi = $tot_costi + $dati_mercato[3];
					}
				} # fine for $num3

				if ($num2 % 2) $color=$colore_riga_alt;
				else $color="#FFFFFF";

				echo "<tr bgcolor=\"$color\"><td align=\"left\"><b>$outente</b> <font size=\"-2\" color=\"$sfondo_tab2\">($osquadra)</font></td><td align=\"center\">$ocambi</td><td align=\"center\"></tr>";
				$num_calc = 0;
				$tot_costi = 0;
			}
		}
		echo "</table><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";



require ("./footer.php");
?>