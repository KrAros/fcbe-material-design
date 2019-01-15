<?php
##################################################################################
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


if ($stato_mercato == "B") {

// Variabili da impostare
$filename = "$percorso_cartella_dati/mercato_".$_SESSION['torneo']."_".$_SESSION['serie'].".txt"; // Path completo del file
$sep = ","; // Separatore tra elementi della stessa riga
$index_date = 5; // Posizione della data in una riga (parte da 0)
$index_value = 3; // Posizione dell'importo della busta in una riga (parte da 0)
$index_id = 0; //posizione dell'ID dell'oggetto
//
$lista_offerte_identiche = array();  
$lista_calciatori = array();
$box_data->data = "";
$box_data->valore = 0;

$fd = fopen ( $filename, "r" );

if ( $fd === false ) die; // Muore se non riesce ad aprire il file

// Ciclo sulle righe
while ( !feof ( $fd ) )
{
    // Legge la riga corrente
    $line = fgets ( $fd );
    
    // Splitta la riga in un array a seconda del separatore
    $list_line_data = explode ( $sep, $line );
    
    // Estrae i dati interessanti
    $cur_date = $list_line_data[$index_date];
    $cur_value = $list_line_data[$index_value];
    $cur_id = $list_line_data[$index_id];
    if (isset ($lista_calciatori[$cur_id])) {
if ($cur_value > $lista_calciatori[$cur_id][$index_value])     $lista_calciatori[$cur_id] = $list_line_data;
    //Fix Offerte Identiche
    //elseif ($cur_value == $lista_calciatori[$cur_id][$index_value] and $cur_date < $lista_calciatori[$cur_id][$index_date])
    elseif ($cur_value == $lista_calciatori[$cur_id][$index_value]) {
     $lista_offerte_identiche[$cur_id]['offerta'] = $cur_value;
     unset($lista_calciatori[$cur_id]);
    }
    //$lista_calciatori[$cur_id] = $list_line_data;
    else continue;
    }

elseif (isset ($lista_offerte_identiche[$cur_id]) and $cur_value > $lista_offerte_identiche[$cur_id]['offerta'] )  $lista_calciatori[$cur_id] = $list_line_data;
elseif (isset ($lista_offerte_identiche[$cur_id]) and $cur_value <= $lista_offerte_identiche[$cur_id]['offerta'] ) continue;
else (!isset ($lista_offerte_identiche[$cur_id]) $lista_calciatori[$cur_id] = $list_line_data;
}

fclose ( $fd );

$fd = fopen ("$percorso_cartella_dati/buste_aperte.txt" , "w" );
foreach ($lista_calciatori as $line) {
    $line[5]=$data_busta_chiusa."\n";
    fwrite ($fd,implode($sep,$line));
    }
fclose ($fd);


############## Copia di mercato.txt in buste_chiuse.txt

        
        $newfile = "$percorso_cartella_dati/buste_chiuse.txt";
        $aperte = "$percorso_cartella_dati/buste_aperte.txt";
        copy($filename, $newfile);
        unlink($filename);
        copy($aperte, $filename);
        
#########################################################

require ("./a_menu.php");

echo "<center><b>Le buste sono state aperte.<br>
Se hai bisogno di fare un altro giro di buste chiuse, devi controllare
che l'ultima riga del file mercato.txt sia cos&igrave:\",$data_busta_chiusa\"<br>
Se non &egrave; cos&igrave, aggiungila alla fine del file.</b></center><br>\n";

include ("./footer.php");

} # if ($stato_mercato == "B")
?>
