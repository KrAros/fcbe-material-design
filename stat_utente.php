<?PHP
##################################################################################
#    FANTACALCIOBAZAR
#    Copyright (C) 2003-2004 by Antonello Onida (hiteck@libero.it)
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

$parla = "NO";
include("./controlla_pass.php");
include("header.php");

for ($num1 = "01" ; $num1 < 40 ; $num1++) {
	if (strlen($num1) == 1) $num1 = "0".$num1;
	$giornata_controlla = "giornata$num1";
	if (!@is_file("$percorso_cartella_dati/$giornata_controlla")) break;
	else $giornata_ultima = $num1;
} # fine for $num1

echo "<center><h3>Giornata $giornata_ultima</h3></center>";

$tab_utenti = "<table class=border width=\"95%\" border=1 cellpadding=3 align=center><tr>";
$num_giocatori=count($pass);
$dim_col = 100/$num_giocatori;
reset($pass);

	for($num1 = 0 ; $num1 < $num_giocatori; $num1++) {
	$giocatore = key($pass);
	$nome_posizione[$num1] = $giocatore;
	$soprannome_squadra = @file("$percorso_cartella_dati/squadra_$giocatore");
	$soprannome_squadra[3] = togli_acapo($soprannome_squadra[3]);

		if ($soprannome_squadra[3]) {
		$nome_squadra_memo[$giocatore] = $soprannome_squadra[3];
		$soprannome_squadra = $soprannome_squadra[3];
		} # fine if ($soprannome_squadra[3])
		else {
		$soprannome_squadra = "Squadra";
		$nome_squadra_memo[$giocatore] = $giocatore;
		} # fine else if ($soprannome_squadra[3])

	$tab_utenti.= "<td colspan=2 width=\"$dim_col%\" valign=top align=center><b>$soprannome_squadra di $giocatore</b></td>";
	next($pass);
	} # fine for $num1

$tab_utenti .= "</tr></table>";



echo "$tab_utenti";


echo "<center><br/><a href=\"javascript:history.back();\" class=menu><b>Torna indietro</b></a></center>";

include("footer.php");
?>