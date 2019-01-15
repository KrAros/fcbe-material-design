<?php
/* preleviamo l'anno corrente */
$anno = date("Y");

/* preleviamo il mese corrente */
$mese = date("m");

/* troviamo quanti giorni ha il mese corrente */
$n_giorni = date("t",mktime(0, 0, 0, $mese, 1, $anno));
$primo_giorno =  date("w",mktime(0, 0, 0, $mese, 1, $anno));
$ultimo_giorno = date("w", mktime(0, 0, 0, $mese, $n_giorni, $anno));

/*
Il parametro w restituisce il giorno della settimana,
numerico, i.e. "0" (Domenica) a "6" (Sabato).
Per noi è Domenica è 7
*/
if ($primo_giorno == 0) $primo_giorno = 7;
if ($ultimo_giorno == 0) $ultimo_giorno = 7;

/*
In questo modo troviamo quanti spazi devono essere
messi dopo l'ultimo giorno del mese per riempiere
la tabella
*/
$n_spazi = 7-$ultimo_giorno;

/* giorni della settimana */
$giorni = array("Lun", "Mar", "Mer", "Gio", "Ven", "Sab", "Dom");

/* Mesi */
$nome_mesi = array("Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre" );

/* tabella intestazione */
$tabella = "<table border=\"0\">";

$tabella .= "<tr><th colspan=\"7\"><center><b><i>"
.$nome_mesi[(int)$mese-1]."</i></b>
</center></th></tr>";
$tabella .= "<tr>";

/* Giorni nella tabella */
for ($i=0;$i<7;$i++){
	$tabella .= "<td><i>".$giorni[$i]."</i></td>";
}

/* Se il mese non incomincia da lunedì riempiamo la tabella con degli spazi */
$tabella .= "</tr>";
$y=1;
$tabella .= "<tr>";
for ($i=0;$i<$n_giorni+$primo_giorno+$n_spazi-1;$i++){
	if ($i%7==0 and $i!=0){
		$tabella .= "</tr><tr>";
	}
	if($i<$primo_giorno-1)
	$tabella .= "<td><center> &nbsp;</center></td>";
	else {
		if($y<$n_giorni+1){
			/* Mettiamo in grossetto il giorno corrente */
			if($y == (int)date("d"))
			$tabella .= "<td><center><b>".$y."</b></center></td>";
			else $tabella .= "<td><center>".$y."</center></td>";
			$y++;
		}
		/* Riempiamo con degli spazi per finire l'ultima riga */
		else $tabella .= "<td><center>&nbsp;</center></td>";
	}
}
$tabella .= "</tr></table>";

echo $tabella;
?>