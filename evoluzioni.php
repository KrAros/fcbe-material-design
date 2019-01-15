<?php
##################################################################################
#	FANTACALCIOBAZAR EVOLUTION
#	Copyright (C) 2003-2009 by Antonello Onida
#
#	Prego leggere i file allegati crediti.txt e licenza.txt
##################################################################################
session_start();
header ("Cache-control: private");
require_once("./dati/dati_gen.php");
require_once("./inc/funzioni.php");
include("./header.php");
ini_set("memory_limit","-1");

$ug = intval($ug);
$sc = array();
$sct = array();
$d = array();
$v = array();

if($_GET['ianno_stat']) $_SESSION['anno_stat'] = $_GET['ianno_stat'];
if($_GET['itv'] == "MCC" OR $_GET['itv'] == "VCL") $_SESSION['tv'] = $_GET['itv'];
if(!$_SESSION['tv']) $_SESSION['tv'] = "MCC";
if(!$_SESSION['anno_stat']) $_SESSION['anno_stat'] = "2010";

#pr($_SESSION);

# Controlla numero ultima giornata
for($n=1; $n < 40; $n++) {
	if (strlen($n) == 1) $n = "0".$n;
	if (!@is_file($percorso_cartella_dati."/".$_SESSION['anno_stat']."/".$_SESSION['tv'].$n.".txt")) break;
	else $ug = $n;
}

function array_sum_values() {
	$return = array();
	$intArgs = func_num_args();
	$arrArgs = func_get_args();
	if($intArgs < 1) trigger_error('Attenzione: errore nel calcolo dei parametri nella funzione array_sum_values()', E_USER_WARNING);

	foreach($arrArgs as $arrItem) {
		if(!is_array($arrItem)) trigger_error('Attenzione: valori parametri errati nella funzione array_sum_values()', E_USER_WARNING);
		foreach($arrItem as $k => $v) {
			foreach($v as $k1 => $v1) $return[$k1] += $v1;
		}
	}
	return $return;
}

for($n=0; $n <= $ug; $n++) {
	if (strlen($n) == 1) $n = "0".$n;
	$v = file($percorso_cartella_dati."/".$_SESSION['anno_stat']."/".$_SESSION['tv'].$n.".txt");
	$nc = 0; $nc = count($v);
	for ($n2 = 0 ; $n2 <= $nc; $n2++) {
		$d = explode("|", $v[$n2]);
		if(intval($d[0]) != 0){
			$sc[$d[0]][$d[1]]['nome'] = $d[2];
			$sc[$d[0]][$d[1]]['squadra'] = $d[3];
			$sc[$d[0]][$d[1]]['attivo'] = $d[4];
			$sc[$d[0]][$d[1]]['ruolo'] = $d[5];
			$sc[$d[0]][$d[1]]['presenza'] = $d[6];
			$sc[$d[0]][$d[1]]['fv'] = $d[7];
			$sc[$d[0]][$d[1]]['mint'] = $d[8];
			$sc[$d[0]][$d[1]]['mast'] = $d[9];
			$sc[$d[0]][$d[1]]['voto'] = $d[10];
			$sc[$d[0]][$d[1]]['gseg'] = $d[11];
			$sc[$d[0]][$d[1]]['gsub'] = $d[12];
			$sc[$d[0]][$d[1]]['gvit'] = $d[13];
			$sc[$d[0]][$d[1]]['gpar'] = $d[14];
			$sc[$d[0]][$d[1]]['ass'] = $d[15];
			$sc[$d[0]][$d[1]]['amm'] = $d[16];
			$sc[$d[0]][$d[1]]['esp'] = $d[17];
			$sc[$d[0]][$d[1]]['rtir'] = $d[18];
			$sc[$d[0]][$d[1]]['rsub'] = $d[19];
			$sc[$d[0]][$d[1]]['rpar'] = $d[20];
			$sc[$d[0]][$d[1]]['rsba'] = $d[21];
			$sc[$d[0]][$d[1]]['gaut'] = $d[22];
			$sc[$d[0]][$d[1]]['ent'] = $d[23];
			$sc[$d[0]][$d[1]]['tit'] = $d[24];
			$sc[$d[0]][$d[1]]['sv'] = $d[25];
			$sc[$d[0]][$d[1]]['casa'] = $d[26];
			$sc[$d[0]][$d[1]]['val'] = $d[27];
		}
	} 
}

echo "<script type='text/javascript' src='./inc/js/ordina_tabella.js'></script>";
echo "<div style='background-color:white; padding:5px; border: 1px solid #000000; text-align:left; font: 10px arial'>";

if($_SESSION['tv'] == "MCC") echo "<b>Campionato ".$_SESSION['anno_stat']."</b> - <a href='evoluzioni.php?itv=VCL'>Champions League</a> ".$_SESSION['tv'];
elseif($_SESSION['tv'] == "VCL") echo "<a href='evoluzioni.php?itv=MCC'>Campionato</a> - <b>Champions League</b> ".$_SESSION['tv'];
else echo "Errore nella variabile di sessione TV:".$_SESSION['tv'];

if($_SESSION['tv'] == "MCC") echo " - <a href='evoluzioni.php?ianno_stat=2010'>2010</a> - <a href='evoluzioni.php?ianno_stat=2009'>2009</a> - <a href='evoluzioni.php?ianno_stat=2008'>2008</a> - <a href='evoluzioni.php?ianno_stat=2007'>2007</a> - <a href='evoluzioni.php?ianno_stat=2006'>2006</a> - <a href='evoluzioni.php?ianno_stat=2005'>2005</a> - <a href='evoluzioni.php?ianno_stat=2004'>2004</a> - <a href='evoluzioni.php?ianno_stat=2003'>2003</a>";

if ($_GET['q1'] == "nome"){
	echo " - ".$_GET['q2']." anno ".$_SESSION['anno_stat']."/".$_GET['ianno_stat'];
	$ug = intval($ug);
	$totale = array_sum_values($sc[$_GET['q2']]);
	if($totale['voto'] AND $totale['presenza']) $mv = round(($totale['voto']/$totale['presenza']),2);
	if($totale['voto'] AND $totale['presenza']) $mfv = round(($totale['fv']/$totale['presenza']),2);
	$sost = $totale['presenza'] - $totale['tit'];
	$n = ereg_replace("\"","",$sc[$_GET['q2']][$ug]['nome']);
	$s = ereg_replace("\"","",$sc[$_GET['q2']][$ug]['squadra']);

	if ($sc[$_GET['q2']][$ug]['ruolo'] == 0) $r = "Portiere";
	elseif ($sc[$_GET['q2']][$ug]['ruolo'] == 1) $r = "Difensore";
	elseif ($sc[$_GET['q2']][$ug]['ruolo'] == 2) $r = "Centrocampista";
	elseif ($sc[$_GET['q2']][$ug]['ruolo'] == 3) $r = "Attaccante";

	#echo "<pre>";print_r($totale);echo "</pre>";
	echo "<hr/>Nome calciatore: <b>$n</b><br/>";
	if(is_file("./immagini/foto/".$_GET['q2'].".jpg")) echo "<img src='./immagini/foto/".$_GET['q2'].".jpg' alt='".$sc[$_GET['q2']][$ug]['nome']."' align='right' />";
	echo "Ruolo: <a href='?q1=ruolo&amp;q2=".$sc[$_GET['q2']][$ug]['ruolo']."'>$r</a> - Numero: ".$_GET['q2']." - Attivo: ".$sc[$_GET['q2']][$ug]['attivo']."<br/>";
	echo "Valore: ".$sc[$_GET['q2']][$ug]['val']."<br/>";
	echo "Squadra: <a href='?q1=squadra&amp;q2=$s'>$s</a><br/>";
	echo "Presenze: ".$totale['presenza']."<br/>";
	echo "Titolare: ".$totale['tit']."<br/>";
	echo "Subentrato: $sost<br/>";
	echo "Ammonizioni: ".$totale['amm']."<br/>";
	echo "Espulsioni: ".$totale['esp']."<br/>";
	echo "Media voti: $mv<br/>";
	echo "Media fantavoti: $mfv<br/>";

	if (INTVAL(trim($sc[$_GET['q2']][$ug]['ruolo'])) == 0){
		if ($totale['gsub'] AND $totale['presenza']) $gs = round(($totale['gsub']/$totale['presenza']),2);
		echo "Gol subiti: ".$totale['gsub']."<br/>";
		echo "Media gol subiti: $gs<br/>";
		echo "Rigori subiti: ".$totale['rsub']."<br/>";
		echo "Rigori parati: ".$totale['rpar']."<br/>";
		echo "Gol segnati: ".$totale['gseg']."<br/>";
	}
	else {
		if($totale['gseg'] AND $totale['presenza']) $mgs = round(($totale['gseg']/$totale['presenza']),2);
		if($totale['ass'] AND $totale['presenza']) $ma = round(($totale['ass']/$totale['presenza']),2);
		echo "Totale gol: ".$totale['gseg']."<br/>";
		echo "Media gol: $mgs<br/>";
		echo "Rigori tirati: ".$totale['rtir']."<br/>";
		echo "Rigori sbagliati: ".$totale['rsba']."<br/>";
		echo "Totale assist: ".$totale['ass']."<br/>";
		echo "Media assist: $ma<br/>";
	}
	echo "<table id='t1' class='sortable'>
	<tr bgcolor='#f0f0f0'>
	<th>#</th>
	<th>FV</th>
	<th>voto</th>
	<th>val</th>
	<th>att</th>
	<th>gseg</th>
	<th>gsub</th>
	<th>gvit</th>
	<th>gpar</th>
	<th>ass</th>
	<th>amm</th>
	<th>esp</th>
	<th>rtir</th>
	<th>rsub</th>
	<th>rpar</th>
	<th>rsba</th>
	<th>gaut</th>
	<th>pres</th>
	<th>mint</th>
	<th>mast</th>
	<th>ent</th>
	<th>tit</th>
	<th>sv</th>
	<th>cas</th>
	</tr>";
	
	for($n=1; $n <= $ug; $n++) {
		if ($n % 2) $colore="#FFFFFF"; else $colore="$colore_riga_alt";

		echo "<tr align='center' bgcolor='$colore'>
		<td>$n</td>
		<td>".$sc[$_GET['q2']][$n]['fv']."</td>
		<td>".$sc[$_GET['q2']][$n]['voto']."</td>
		<td>".$sc[$_GET['q2']][$n]['val']."</td>
		<td>".$sc[$_GET['q2']][$n]['attivo']."</td>
		<td>".$sc[$_GET['q2']][$n]['gseg']."</td>
		<td>".$sc[$_GET['q2']][$n]['gsub']."</td>
		<td>".$sc[$_GET['q2']][$n]['gvit']."</td>
		<td>".$sc[$_GET['q2']][$n]['gpar']."</td>
		<td>".$sc[$_GET['q2']][$n]['ass']."</td>
		<td>".$sc[$_GET['q2']][$n]['amm']."</td>
		<td>".$sc[$_GET['q2']][$n]['esp']."</td>
		<td>".$sc[$_GET['q2']][$n]['rtir']."</td>
		<td>".$sc[$_GET['q2']][$n]['rsub']."</td>
		<td>".$sc[$_GET['q2']][$n]['rpar']."</td>
		<td>".$sc[$_GET['q2']][$n]['rsba']."</td>
		<td>".$sc[$_GET['q2']][$n]['gaut']."</td>
		<td>".$sc[$_GET['q2']][$n]['presenza']."</td>
		<td>".$sc[$_GET['q2']][$n]['mint']."</td>
		<td>".$sc[$_GET['q2']][$n]['mast']."</td>
		<td>".$sc[$_GET['q2']][$n]['ent']."</td>
		<td>".$sc[$_GET['q2']][$n]['tit']."</td>
		<td>".$sc[$_GET['q2']][$n]['sv']."</td>
		<td>".$sc[$_GET['q2']][$n]['casa']."</td>
		</tr>";
	}
	echo "</table>";
	unset($sc);
}
elseif ($_GET['q1'] == "squadra"){
	echo "<h1>".$_GET['q2']."</h1>";

	$tabella = "<table id='t1' class='sortable'>
	<tr bgcolor='#f0f0f0'>
	<th>Num</th>
	<th>Nome</th>
	<th>Ruolo</th>
	<th>Squadra</th>
	<th>Presenze</th>
	<th>Gol</th>
	<th>Rigori</th>
	<th>Ammonizioni</th>
	<th>Espulsioni</th>
	<th>Valore</th>
	<th>Media FV</th>
	<th>Media voto</th>
	</tr>";

	foreach ($sc as $a => $b){
		$bb = key($b);
		$n = trim(ereg_replace("\"","",$b[$bb]['nome']));
		$s = trim(ereg_replace("\"","",$b[$bb]['squadra']));
		$rn = trim($b[$bb]['ruolo']);
		if ($rn == 0) $r = "Portiere";
		elseif ($rn == 1) $r = "Difensore";
		elseif ($rn == 2) $r = "Centrocampista";
		elseif ($rn == 3) $r = "Attaccante";

		if ($s == $_GET['q2']){
			$totale = array_sum_values($sc[$a]);
			if($totale['presenza'] AND $totale['voto']) $mv = round(($totale['voto']/$totale['presenza']),2);
			if($totale['presenza'] AND $totale['fv']) $mfv = round(($totale['fv']/$totale['presenza']),2);

			$tabella .= "<tr>
			<td align='center'>$a</td>
			<td><a href='?q1=nome&amp;q2=$a'>$n</a></td>
			<td align='center'><a href='?q1=ruolo&amp;q2=$rn'>$r</a></td>
			<td align='center'><a href='?q1=squadra&amp;q2=$s'>$s</a></td>
			<td align='center'>".$totale['presenza']."</td>
			<td align='center'>".$totale['gseg']."</td>
			<td align='center'>".$totale['rtir']."/".$totale['rsba']."</td>
			<td align='center'>".$totale['amm']."</td>
			<td align='center'>".$totale['esp']."</td>
			<td align='center'>".$sc[$a][$ug]['val']."</td>
			<td align='center'>$mfv</td>
			<td align='center'>$mv</td>
			</tr>";
		}
	}
	$tabella .= "</table>";
	echo $tabella;
	}elseif ($_GET['q1'] == "ruolo"){
		echo "<h1>".$_GET['q2']."</h1>";

		$tabella = "<table id='t1' class='sortable'>
		<tr bgcolor='#f0f0f0'>
		<th>Num</th>
		<th>Nome</th>
		<th>Ruolo</th>
		<th>Squadra</th>
		<th>Presenze</th>
		<th>Gol</th>
		<th>Rigori</th>
		<th>Ammonizioni</th>
		<th>Espulsioni</th>
		<th>Valore</th>
		<th>Media FV</th>
		<th>Media voto</th>
		</tr>";

		foreach ($sc as $a => $b){
			$bb = key($b);
			$n = trim(ereg_replace("\"","",$b[$bb]['nome']));
			$s = trim(ereg_replace("\"","",$b[$bb]['squadra']));
			$rn = trim($b[$bb]['ruolo']);
			if ($rn == 0) $r = "Portiere";
			elseif ($rn == 1) $r = "Difensore";
			elseif ($rn == 2) $r = "Centrocampista";
			elseif ($rn == 3) $r = "Attaccante";

			if ($rn == $_GET['q2']){
				$totale = array_sum_values($sc[$a]);
				if($totale['presenza'] AND $totale['voto']) $mv = round(($totale['voto']/$totale['presenza']),2);
				if($totale['presenza'] AND $totale['fv']) $mfv = round(($totale['fv']/$totale['presenza']),2);
				$tabella .= "<tr>
				<td align='center'>$a</td>
				<td><a href='?q1=nome&amp;q2=$a'>$n</a></td>
				<td align='center'><a href='?q1=ruolo&amp;q2=$rn'>$r</a></td>
				<td align='center'><a href='?q1=squadra&amp;q2=$s'>$s</a></td>
				<td align='center'>".$totale['presenza']."</td>
				<td align='center'>".$totale['gseg']."</td>
				<td align='center'>".$totale['rtir']."/".$totale['rsba']."</td>
				<td align='center'>".$totale['amm']."</td>
				<td align='center'>".$totale['esp']."</td>
				<td align='center'>".$sc[$a][$ug]['val']."</td>
				<td align='center'>$mfv</td>
				<td align='center'>$mv</td>
				</tr>";
			}
		}
		$tabella .= "</table>";
		echo $tabella;
	}
	else{
		$tabella = "<table id='t1' class='sortable'>
		<tr bgcolor='#f0f0f0'><th>Num</th><th>Nome</th><th>Ruolo</th><th>Squadra</th></tr>";

		foreach ($sc as $a => $b){
			$bb = key($b);
			$n = trim(ereg_replace("\"","",$b[$bb]['nome']));
			$s = trim(ereg_replace("\"","",$b[$bb]['squadra']));
			$rn = trim($b[$bb]['ruolo']);
			if ($rn == 0) $r = "Portiere";
			elseif ($rn == 1) $r = "Difensore";
			elseif ($rn == 2) $r = "Centrocampista";
			elseif ($rn == 3) $r = "Attaccante";


			$tabella .= "<tr>
			<td align='center'>$a</td>
			<td><a href='?q1=nome&amp;q2=$a'>$n</a></td>
			<td align='center'><a href='?q1=ruolo&amp;q2=$rn'>$r</a></td>
			<td align='center'><a href='?q1=squadra&amp;q2=$s'>$s</a></td>
			</tr>";
		}
		$tabella .= "</table>";
		echo $tabella;
	}
echo "</div>";

echo memory_get_usage();

include("./footer.php");
?>