<?php
#
# Funzioni CMS Alessia edit 6/11/2007
#
########################################################################################

function mostra_data($data_vis) {

	$anno = substr($data_vis,0,4);
	$mese = substr($data_vis,4,2);
	$giorno = substr($data_vis,6,2);
	$ora = substr($data_vis,8,2);
	$min = substr($data_vis,10,2);

	$data_vis = "$giorno/$mese/$anno $ora:$min";
	return $data_vis;
} # fine function mostra_data($data_vis)


function mostra_dt($data_vis) {

	$anno = substr($data_vis,0,4);
	$mese = substr($data_vis,4,2);
	$giorno = substr($data_vis,6,2);
	$ora = substr($data_vis,8,2);
	$min = substr($data_vis,10,2);

	$data_vis = "<small>$giorno/$mese</small>";
	return $data_vis;
} # fine function mostra_dt($data_vis)

#################################################################################################

function TagliaStringa($stringa, $max_char){
	if(strlen($stringa)>$max_char){
		$stringa_tagliata=substr($stringa, 0,$max_char);
		$last_space=strrpos($stringa_tagliata," ");
		$stringa_ok=substr($stringa_tagliata, 0,$last_space);
		return $stringa_ok."...";
	}else{
	return $stringa;
	}
}

// PulisciQuery: Restituisce la query pulita da parole inutili(congiunzioni etc.)
function PulisciQuery($queryvar){
	// array parole di cui non tener conto nelle ricerche
	$arrayBadWord=Array("lo", "l", "il", "la", "i", "gli", "le", "uno", "un", "una", "un", "su", "sul", "sulla", "sullo", "sull", "in", "nel", "nello", "nella", "nell", "con", "di", "da", "dei", "d",  "della", "dello", "del", "dell", "che", "a", "dal", "&egrave;", "e", "per", "non", "si", "al", "ai", "allo", "all", "al", "o");
	$queryclean=strtolower($queryvar);
		for($a=0;$a<count($arrayBadWord);$a++){
		// sostituisco bad words con espressioni regolari \b ->solo se parole singole, non facenti parti di altre
		$queryclean=preg_replace("/\b".$arrayBadWord[$a]."\b/", "", $queryclean);
		}
	// elimino tutti caratteri non alfanumerici sostituendeli con uno spazio
	$queryclean=preg_replace("/\W/", " ", $queryclean);
	return $queryclean;
	}

// QueryToArray: Restituisce array delle parole chiave da cercare
function QueryToArray($queryvar){
	// pulisco query da parole accessorie e caratteri non alfanumerici
	$querypulita=PulisciQuery($queryvar);
	// costruisco l'array contenente tutte le parole da cercare
	$arraySearch=explode(" ", $querypulita);
	// elimino doppioni dall'array
	$arraySearchUnique=array_unique($arraySearch);
	// elimino valori array vuoti o con solo spazi
	$arrayVuoto=Array(""," ");
	$arrayToReturn=array_diff($arraySearchUnique, $arrayVuoto);
	return $arrayToReturn;
}

// CreaQueryRicerca: Creo la query di ricerca.
// peso titolo se non specificato=5, peso testo se non specificato=3
// searchlevel -> 1 o 0. default 1. Se 0 trova parole non complete. Es. cerchi osso?ok anche ossobuco. Se 1 non succede.
function CreaQueryRicerca($queryvar, $pesotitolo=5, $pesotesto=3, $searchlevel=1){
	// trasformo la stringa in un array di parole da cercare
	$arrayToFind=QueryToArray($queryvar);
	// numero elementi da cercare
	$elementiToFind=count($arrayToFind);
	// punteggio massimo raggiungibile
	$maxPoint=$elementiToFind*$pesotitolo+$elementiToFind*$pesotesto;
	if($elementiToFind==0){
		return "";
	}else{
	$query="select ROUND((";
	$sqlwhere="";
	// ciclo per ogni parola trovata ($Valore)
	foreach($arrayToFind As $Indice => $Valore){
		// se $Valore &egrave; presente in titolo instr(titolo, '$Valore') restituir&agrave; 1 altrimenti 0
		// moltiplico il valore restituito (1 o 0) per il peso della parola (5 per il titolo, 3 per testo)
		if($searchlevel==1){
			// regexp: uso espressioni regolari. [[:<:]] equivale a \b per separare parole
			$query.="((titolo REGEXP '[[:<:]]".$Valore."[[:>:]]')>0)*$pesotitolo+";
			$query.="((testo REGEXP '[[:<:]]".$Valore."[[:>:]]')>0)*$pesotesto+";
			$sqlwhere.="titolo REGEXP '[[:<:]]".$Valore."[[:>:]]' OR testo REGEXP '[[:<:]]".$Valore."[[:>:]]' OR ";
		}else{
		$query.="(instr(titolo, '$Valore')>0)*$pesotitolo+";
		$query.="(instr(testo, '$Valore')>0)*$pesotesto+";
		$sqlwhere.="titolo like '%$Valore%' OR testo like '%$Valore%' OR ";
	}
}
$sqlwhere=substr($sqlwhere, 0, strlen($sqlwhere)-4);
// calcolo la percentuale di rilevanza  --> rilevanza*100/$maxPoint
$query.="0)*100/$maxPoint,2) as rilevanza, ID, titolo from tabella WHERE $sqlwhere order by rilevanza DESC";
return $query;
}
}


function ricerca($testo){
	// stringa da ricercare presa da form.
	//$queryvar="parola1 parola2"; //esempio

	if(isset($_POST['search'])){$queryvar=$_POST['search'];}else{$queryvar="";}

	if(trim($queryvar)=="" || strlen(trim($queryvar))<=3){
		echo "La stringa di ricerca deve contenere pi&ugrave; di 3 caratteri.";
	}else{
	// query da eseguire
	// primo valore passato &egrave; peso delle parole cercate nel titolo, secondo peso parole nel testo
	// terzo valore cercato: 1 o 0: accuratezza ricerca. Se 0 trova parole non complete. Es. cerchi osso?ok anche ossobuco. Se 1 non succede.
	// CreaQueryRicerca($queryvar) -> prende primo e secondo valore di default
	$queryRicerca=CreaQueryRicerca($queryvar, 5, 3, 1);
	// Eseguo la query
	// La query restituisce ID, titolo e % di rilevanza del risultato
	echo $queryRicerca;
}

$word = $_POST['testo'];
$word = stripslashes(trim($word));
$word = strip_tags($word);

global $archivio_dati, $notizie_file, $categorie_file, $pagine_file;

if ($archivio_dati == "csvfile") {
	require_once ("./inc/csvfile.inc.php");
	$lista_notizie			= new csvfile;
	$lista_notizie->name	= $notizie_file;
	$lista_notizie->init();
}
$dati_notizie = array();
$lista_notizie->get_entrylist(0,999, $dati_notizie);
#uasort ($dati_categorie, "cmp");
$conta_id = 1;
$conta_trovato = 0;
$elenco = "<div class='slogan_piccolo'>";

foreach($dati_notizie as $chiave => $valore) {
	if (eregi($word, $valore["ptesto"])) {
		$conta_trovato++;
		#$valore["ptesto"] = eregi_replace($word, "<font class='evidenziato'>\\1 $word</font>", $valore["ptesto"]);
		$elenco .= "|&nbsp;&nbsp;&nbsp;<a href='index.php?notiziaid=$conta_id&amp;evidenzia=$word'>".$valore["ptitolo"]."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- del ".$valore["data_mod"]." di ".$valore["putente"]."<br/>";
	}
	$conta_id++;
}
$elenco .= "</div>";

echo "<center><h2>Risultati ricerca</h2></center>Testo ricercato: <b>$word</b><br/>Risultati trovati: <b>$conta_trovato</b><br/>Sono evidenziati solo i termini che coincidono esattamente in minuscole/MAIUSCOLE.<br/><br/>$elenco";

}


########################################################################################

function agg_pagina() {
	global $data_mod;
	echo"<h2>Aggiungi pagina principale</h2>
	<br/>Sar&agrave; creato un link per ogni pagina aggiunta in testata, perci&ograve; si prega di non eccedere con le pagine attive, e verificare il layout del menu.<br/>
	<form action='a_sito.php?q=2' method='post' enctype='multipart/form-data'>
	<b>titolo link</b> <small>obbligatorio e breve massimo 25 caratteri</small><br/>
	<input type='text' name='ptitolo' size='25' maxlength='25' />
	<br />
	<b>priorit&agrave;</b><br/>
	<input type='text' name='priorita' size='3' maxlength='2' disabled />
	<br />
	<b>Pubblica link pagina</b><br/>
	LINK (in alto)&nbsp;<input type='radio' name='pattivo' value='SI' checked />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	BOX (a destra)&nbsp;<input type='radio' name='pattivo' value='BOX' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	LINK (a sinistra)&nbsp;<input type='radio' name='pattivo' value='LINK' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	NO&nbsp;<input type='radio' name='pattivo' value='NO' />
	<br />
	<b>Contenuto: <small>obbligatorio</small></b><br/>
	<br />
	<textarea name='ptesto' rows='20' cols='120'></textarea>
	<br />
	$data_mod <input type='submit' name='aggiungi' value='aggiungi pagina' />
	</form>";

}

function agg_pagina2() {
	global $archivio_dati, $percorso_cartella_dati, $ptitolo, $priorita, $ptesto, $pattivo, $data_mod, $archivio_dati, $pagine_file;

	if ($archivio_dati == "csvfile"){
		require_once ("./inc/csvfile.inc.php");
		$news_list        = new csvfile;
		$news_list->name  = $pagine_file;
		$news_list->init();
	}

	$ptitolo = trim(stripslashes($ptitolo));
	$ptitolo = htmlentities($ptitolo, ENT_QUOTES);
	$ptesto = trim(stripslashes($ptesto));
	$ptesto = htmlentities($ptesto, ENT_QUOTES);

	if($ptitolo or $ptesto) {
		$new_entry = array();
		$new_entry["data_mod"]	= $data_mod;
		$new_entry["putente"]	= $_SESSION['utente'];
		$new_entry["ptitolo"]	= ereg_replace("(\r\n|\n|\r)", "", $ptitolo);
		$new_entry["ptesto"]	= ereg_replace("(\r\n|\n|\r)", "<br />", $ptesto);
		$new_entry["priorita"]	= $priorita;
		$new_entry["ptodo1"]	= 0;
		$new_entry["ptodo2"]	= 0;
		$new_entry["ptodo3"]	= 0;
		$new_entry["ptodo4"]	= 0;
		$new_entry["ptodo5"]	= 0;
		$new_entry["ptodo6"]	= 0;
		$new_entry["ptodo7"]	= 0;
		$new_entry["ptodo8"]	= 0;
		$new_entry["ptodo9"]	= 0;
		$new_entry["pattivo"]	= $pattivo;

		$red_data = array();
		$num_dates = $news_list->entries();
		$news_list->get_entry(0,$red_data);

		$i = 0;
		while ( $i<$num_dates && $news_stamp < $red_data["news_stamp"] )
		{
			$news_list->get_next_entry( $red_data );
			$i++;
		}
		$news_list->insert($i, $new_entry);

		echo"<h2>Pagina statica creata</h2><br/><hr/>";
		gestione_pagine();
	}
	else echo"<h2>Compilare i campi <B>titolo</b> e <b>contenuto</b></h2>$stringa";
}


function gestione_pagine() {
	global $percorso_cartella_dati, $archivio_dati, $pagine_file, $lp;

	if ( $archivio_dati == "csvfile" ) {
		require_once ("./inc/csvfile.inc.php");
		$news_list        = new csvfile;
		$news_list->name  = $pagine_file;
		$news_list->init();
	}

	$news_per_pagina=25;
	$page = 0;
	$now_stamp = gmmktime();
	if ($lp) $start_pos_count = strip_tags($lp);
	else	$start_pos_count = 1;
	$pos_count = $start_pos_count;
	$pl_pos = 0;
	$num_news  = $news_list->entries();
	if ( $start_pos_count > $num_news) { $news_list->eol = true; }
	$news_data = array();
	$news_list->get_entry( $start_pos_count-1, $news_data );
	$page_break = false;
	$odd_sign = 1;
	echo"<h2>Gestione pagine statiche</h2>
	Sono registrate <b>$num_news</b> pagine.<br/><br/>Per le pagine contrassegnate come attivo viene creato un link in testata, perci&ograve; si prega di non eccedere con le pagine attive, e verificare il layout del menu.<br/><br/>";
	do {
		if ( !$news_list->eol() ) {
			echo '<a href="'.$PHP_SELF.'?q=4&amp;id='.$pos_count.'"><img src="./immagini/edit_entry.gif" alt="MODIFICA" border="0" /></a>&nbsp;&nbsp;'.'<a href="'.$PHP_SELF.'?q=5&amp;id='.$pos_count.'"><img src="./immagini/delete_entry.gif" alt="ELIMINA" border="0" /></a>&nbsp;&nbsp;';

			echo $news_data["ptitolo"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;del ".$news_data["data_mod"]." inserito da ".$news_data["putente"]."&nbsp;&nbsp;&nbsp;Pagina attiva:&nbsp;".$news_data["pattivo"]."<br/><br/>";
			$odd_sign++;
			$news_list->get_next_entry( $news_data );
		}

		$pos_count++;
		$prev_start_pos = $start_pos_count - $news_per_pagina;
		if ($prev_start_pos < 1) $prev_start_pos = 1;
		$next_start_pos = $pos_count;
		$pages = ceil($num_news / $news_per_pagina);
		$page = ceil($start_pos_count / $news_per_pagina);

		if ($start_pos_count == 1 && $pos_count > $news_per_pagina ){
			$page_break = true;
			$nav_left =  '';
			$nav_right = '<a href="'.$PHP_SELF."?q=5&amp;lp=$next_start_pos" . '">seguenti</a>';
		}
		elseif (($pos_count - $start_pos_count) >= $news_per_pagina && !$news_list->eol()) {
			$page_break = true;
			$nav_left =  '<a href="'.$PHP_SELF."?q=5&amp;lp=$prev_start_pos" . '">precedenti</a>';
			$nav_right = '<a href="'.$PHP_SELF."?q=5&amp;lp=$next_start_pos" . '">seguenti</a>';
		}
		elseif ($pos_count > $news_per_pagina && $news_list->eol() ) {
			$page_break = true;
			$nav_left =  '<a href="'.$PHP_SELF."?q=5&amp;lp=$prev_start_pos" . '">precedenti</a>';
			$nav_right = '';
		}

		if ($page_break and $pages > 1) echo "<br/><hr/><center>$nav_left | $page di $pages | $nav_right</center>";

	} while (!$news_list->eol() && !$page_break );
}


function link_pagine() {
	global $archivio_dati, $pagine_file;

	if ($archivio_dati == "csvfile") {
		require_once ("./inc/csvfile.inc.php");
		$lista_pagine			= new csvfile;
		$lista_pagine->name		= $pagine_file;
		$lista_pagine->init();
	}

	$start_pos_count = 1;
	$pos_count = $start_pos_count;
	$num_news  = $lista_pagine->entries();

	if ( $start_pos_count > $num_news) { $lista_pagine->eol = true; }

	$dati_pagina = array();
	$lista_pagine->get_entry( $start_pos_count-1, $dati_pagina );

	do {
		if ( !$lista_pagine->eol() ) {
			if ($dati_pagina["pattivo"] == "SI") {
				echo "<a href='index.php?paginaid=$pos_count'>".$dati_pagina["ptitolo"]."</a>";
			}
			$lista_pagine->get_next_entry($dati_pagina);
		}

		$pos_count++;

	} while (!$lista_pagine->eol());
}


function link_pagine_box() {
	global $archivio_dati, $pagine_file;

	if ($archivio_dati == "csvfile") {
		require_once ("./inc/csvfile.inc.php");
		$lista_pagine			= new csvfile;
		$lista_pagine->name		= $pagine_file;
		$lista_pagine->init();
	}

	$start_pos_count = 1;
	$pos_count = $start_pos_count;
	$num_news  = $lista_pagine->entries();

	if ( $start_pos_count > $num_news) { $lista_pagine->eol = true; }

	$dati_pagina = array();
	$lista_pagine->get_entry( $start_pos_count-1, $dati_pagina );

	do {
		if ( !$lista_pagine->eol() ) {
			if ($dati_pagina["pattivo"] == "BOX") {
				echo "<a href='index.php?paginaid=$pos_count'>".$dati_pagina["ptitolo"]."</a>";
			}
			$lista_pagine->get_next_entry($dati_pagina);
		}

		$pos_count++;

	} while (!$lista_pagine->eol());
}

function link_pagine_link() {
	global $archivio_dati, $pagine_file;

	if ($archivio_dati == "csvfile") {
		require_once ("./inc/csvfile.inc.php");
		$lista_pagine			= new csvfile;
		$lista_pagine->name		= $pagine_file;
		$lista_pagine->init();
	}

	$start_pos_count = 1;
	$pos_count = $start_pos_count;
	$num_news  = $lista_pagine->entries();

	if ( $start_pos_count > $num_news) { $lista_pagine->eol = true; }

	$dati_pagina = array();
	$lista_pagine->get_entry( $start_pos_count-1, $dati_pagina );

	do {
		if ( !$lista_pagine->eol() ) {
			if ($dati_pagina["pattivo"] == "LINK") {
				echo "<br/>&#8226; <a href='index.php?paginaid=$pos_count'>".$dati_pagina["ptitolo"]."</a>";
			}
			$lista_pagine->get_next_entry($dati_pagina);
		}

		$pos_count++;

	} while (!$lista_pagine->eol());
}


function elimina_pagina() {
	global $conferma, $id, $archivio_dati, $pagine_file;

	if ( $archivio_dati == "csvfile" ) {
		require_once ( "./inc/csvfile.inc.php" );
		$lista_pagine			= new csvfile;
		$lista_pagine->name  	= $pagine_file;
		$lista_pagine->init();
	}

	$dati_pagine = array();
	$lista_pagine->get_entry($id-1, $dati_pagine);

	if ($conferma != "SI"){
		echo "<p align='center'><h2>Sei sicuro di voler cancellare la pagina seguente?</h2></p>
		<b>" .$dati_pagine["ptitolo"]. "</b><br/><br/><br/>
		<a href='a_sito.php?q=5&amp;id=$id&amp;conferma=SI'>ELIMINA</a>&nbsp;&nbsp;&nbsp;o&nbsp;&nbsp;&nbsp;
		<a href='a_sito.php?q=3'>annulla</a>
		";
	}
	else {
		$lista_pagine->delete($id-1);
		echo "<h2>Pagina eliminata</h2><br/><hr/>";
		gestione_pagine();
	}
}


function modifica_pagina() {
	global $archivio_dati, $ptitolo, $priorita, $ptesto, $putente, $pattivo, $data_mod, $pagine_file, $conferma, $id;

	if ( $archivio_dati == "csvfile" ) {
		require_once ( "./inc/csvfile.inc.php" );
		$lista_pagine			= new csvfile;
		$lista_pagine->name  	= $pagine_file;
		$lista_pagine->init();
	}

	if($ptitolo or $ptesto) $conferma == "NO";

	$ptitolo = trim(stripslashes($ptitolo));
	$ptitolo = htmlentities($ptitolo, ENT_QUOTES);
	$ptesto = trim(stripslashes($ptesto));
	$ptesto = htmlentities($ptesto, ENT_QUOTES);

	$dati_pagine = array();
	$dati_pagine["data_mod"]	= $data_mod;
	$dati_pagine["putente"]	= $putente;
	$dati_pagine["ptitolo"]	= ereg_replace("(\r\n|\n|\r)", "", $ptitolo);
	$dati_pagine["ptesto"]	= ereg_replace("(\r\n|\n|\r)", "<br/>", $ptesto);
	$dati_pagine["priorita"]	= $priorita;
	$dati_pagine["ptodo1"]	= 0;
	$dati_pagine["ptodo2"]	= 0;
	$dati_pagine["ptodo3"]	= 0;
	$dati_pagine["ptodo4"]	= 0;
	$dati_pagine["ptodo5"]	= 0;
	$dati_pagine["ptodo6"]	= 0;
	$dati_pagine["ptodo7"]	= 0;
	$dati_pagine["ptodo8"]	= 0;
	$dati_pagine["ptodo9"]	= 0;
	$dati_pagine["pattivo"]	= $pattivo;

	if ($conferma == "SI"){
		$lista_pagine->change($id-1,$dati_pagine);
		echo "<h2>Pagina modificata ($id)</h2><br/><hr/>";
		gestione_pagine();
		exit;
	}
	else {

		unset($dati_pagine);
		$dati_pagine = array();
		$lista_pagine->get_entry($id-1, $dati_pagine);
		$ptesto = html_entity_decode($dati_pagine["ptesto"]);
		$ptesto = ereg_replace("(<br/>|<br />|<br>)", "\r\n", $ptesto);

		$V_dati_pagine["data_mod"]	= $dati_pagine["data_mod"];
		$V_dati_pagine["putente"]	= $dati_pagine["putente"];
		$V_dati_pagine["ptitolo"]	= html_entity_decode($dati_pagine["ptitolo"]);
		$V_dati_pagine["ptesto"]		= $ptesto;
		$V_dati_pagine["priorita"]	= $dati_pagine["priorita"];
		$V_dati_pagine["ptodo1"]		= 0;
		$V_dati_pagine["ptodo2"]		= 0;
		$V_dati_pagine["ptodo3"]		= 0;
		$V_dati_pagine["ptodo4"]		= 0;
		$V_dati_pagine["ptodo5"]		= 0;
		$V_dati_pagine["ptodo6"]		= 0;
		$V_dati_pagine["ptodo7"]		= 0;
		$V_dati_pagine["ptodo8"]		= 0;
		$V_dati_pagine["ptodo9"]		= 0;
		$V_dati_pagine["pattivo"]	= $dati_pagine["pattivo"];
		unset($dati_pagine);

		if ($conferma == "NO") echo"<h2>Inserire titolo o testo</h2>";
		echo"<h2>Modifica pagina principale ($id)</h2>
		<br/><br/>Sar&agrave; creato un link per ogni pagina aggiunta in testata, perci&ograve; si prega di non eccedere con le pagine attive, e verificare il layout del menu.<br/><br/>
		<form action='a_sito.php?q=4' method='post' enctype='multipart/form-data'>
		<b>titolo link</b> <small>obbligatorio e breve massimo 25 caratteri</small><br/>
		<input type='text' name='ptitolo' size='25' maxlength='25' value='".$V_dati_pagine["ptitolo"]."' />
		<br />
		<b>utente</b><br/>
		<input type='text' name='putente' size='20' value='".$V_dati_pagine["putente"]."' />
		<br />
		<b>priorit&agrave;</b><br/>
		<input type='text' name='priorita' size='3' maxlength='2' value='".$V_dati_pagine["priorita"]."' disabled />
		<br />
		<b>Pubblica link pagina</b><br/>
		LINK (in alto)&nbsp;<input type='radio' name='pattivo' value='SI' ";
			if ($V_dati_pagine["pattivo"] == "SI") echo "checked";
		echo " />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		BOX (a destra)&nbsp;<input type='radio' name='pattivo' value='BOX' ";
			if ($V_dati_pagine["pattivo"] == "BOX") echo "checked";
		echo" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		LINK (a sinistra)&nbsp;<input type='radio' name='pattivo' value='LINK' ";
			if ($V_dati_pagine["pattivo"] == "LINK") echo "checked";
		echo " />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		NO&nbsp;<input type='radio' name='pattivo' value='NO' ";
			if ($V_dati_pagine["pattivo"] == "NO") echo "checked";
		echo " />
		<br />
		<b>Contenuto: <small>obbligatorio</small></b><br/><br/>
		<textarea name='ptesto' rows='20' cols='120'>".$V_dati_pagine["ptesto"]."</textarea>
		<br/><br/>
		".$V_dati_pagine["data_mod"]."
		<input type='hidden' name='id' value='".$id."' />
		<input type='hidden' name='conferma' value='SI' />
		<input type='submit' name='aggiungi' value='modifica pagina' />
		</form>";
	
	}
}


function pagina($paginaid) {
	global $archivio_dati, $pagine_file;

	if ( $archivio_dati == "csvfile" ) {
		require_once ( "./inc/csvfile.inc.php" );
		$lista_pagine		= new csvfile;
		$lista_pagine->name  	= $pagine_file;
		$lista_pagine->init();
	}
	$paginaid = htmlentities($paginaid);
	$paginaid = strip_tags($paginaid);
	$paginaid = intval($paginaid);

	$dati_pagine = array();
	$lista_pagine->get_entry( $paginaid-1, $dati_pagine );

	if ($dati_pagine["pattivo"] != "NO" ) {
		if ($_SESSION["permessi"] >= 4) $adm_opz = "&nbsp;&nbsp;<small>$paginaid)</small>&nbsp;&nbsp;<a href='a_sito.php?q=4&amp;id=".$paginaid."'>M</a> - <a href='a_sito.php?q=5&amp;id=".$paginaid."'>X</a>";

		$data_vis = $dati_pagine["data_mod"];
		echo "<div><h2>" .html_entity_decode(aggiusta_tag($dati_pagine["ptitolo"])). "</h2><br/>\r\n"
		."<p align='justify'>".html_entity_decode(aggiusta_tag($dati_pagine["ptesto"]))."</p><br/><br/>\r\n"
		."<p class='date'>|&nbsp;Revisione:&nbsp; ".mostra_data($data_vis)."&nbsp;&nbsp;|&nbsp;".$dati_pagine["putente"].$adm_opz."</div>";
	}
	else echo "<h2>Pagina non attiva</h2>";
}


########################################################################################

function agg_categoria() {
	menu_superiore();
	echo"<div class='mdl-cell mdl-cell--12-col'><table class= 'mdl-shadow--2dp boxnews'><tr><td>
	<h1><i class='material-icons'>add_circle</i> Aggiungi Categoria</h1><br>
	<form action='a_sito.php?q=7' method='post' enctype='multipart/form-data'>
		<b>Titolo</b>: <div class='mdl-textfield mdl-js-textfield'><input
	class='mdl-textfield__input'  type='text' name='ptitolo' size='50' maxlength='50' /><label
	class='mdl-textfield__label' for='sample2'>Inserisci...</label></div>
	<input type='hidden' name='pimmagine' size='25' maxlength='25' value='' />
	<br />
	<b>Descrizione categoria:</b> <small>opzionale</small><br/>
	<br/>
	<textarea id='pagetext' name='ptesto' rows='20' cols='120'></textarea>
	<br/><br/>
	<b>Box:</b> <small>opzionale</small><br/>
	<br/>
	<textarea id='pagetext1' name='pbox' rows='7' cols='120'></textarea>
	<br/>
	<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored' type='submit' name='submit' value='aggiungi categoria' />
	</form></td></tr></table></div>";

}


function agg_categoria2() {
	global $archivio_dati, $percorso_cartella_dati, $ptitolo, $ptesto, $pbox, $pimmagine, $data_mod, $categorie_file;

	if ($archivio_dati == "csvfile"){
		require_once ("./inc/csvfile.inc.php");
		$news_list        = new csvfile;
		$news_list->name  = $categorie_file;
		$news_list->init();
	}

	$ptitolo = trim(stripslashes($ptitolo));
	$ptitolo = htmlentities($ptitolo, ENT_QUOTES);
	$ptesto = trim(stripslashes($ptesto));
	$ptesto = htmlentities($ptesto, ENT_QUOTES);
	$pbox = trim(stripslashes($pbox));
	$pbox = htmlentities($pbox, ENT_QUOTES);

	if($ptitolo) {

		$new_entry = array();
		$new_entry["data_mod"]	= $data_mod;
		$new_entry["putente"]	= $_SESSION['utente'];
		$new_entry["ptitolo"]	= ereg_replace("(\r\n|\n|\r)", "", $ptitolo);
		$new_entry["ptesto"]	= ereg_replace("(\r\n|\n|\r)", "", $ptesto);
		$new_entry["pbox"]		= ereg_replace("(\r\n|\n|\r)", "", $pbox);
		$new_entry["pimmagine"]	= $pimmagine;
		$new_entry["ptodo1"]	= 0;
		$new_entry["ptodo2"]	= 0;
		$new_entry["ptodo3"]	= 0;
		$new_entry["ptodo4"]	= 0;
		$new_entry["ptodo5"]	= 0;
		$new_entry["ptodo6"]	= 0;
		$new_entry["ptodo7"]	= 0;
		$new_entry["ptodo8"]	= 0;
		$new_entry["ptodo9"]	= 0;

		$red_data = array();
		$num_dates = $news_list->entries();
		$news_list->get_entry(0,$red_data);

		$i = 0;
		while ( $i<$num_dates && $news_stamp < $red_data["news_stamp"] )
		{
			$news_list->get_next_entry( $red_data );
			$i++;
		}
		$news_list->insert( $i, $new_entry );

		echo"<h2>Categoria creata</h2>";
		gestione_categorie();
	}
	else echo"<h2>I campi necessari non sono stati compilati</h2>";

}


function gestione_categorie() {
	global $percorso_cartella_dati, $archivio_dati, $categorie_file, $lp;

	if ( $archivio_dati == "csvfile" ) {
		require_once ( "./inc/csvfile.inc.php" );
		$news_list        = new csvfile;
		$news_list->name  = $categorie_file;
		$news_list->init();
	}

	$news_per_pagina=25;
	$page = 0;
	$now_stamp = gmmktime();
	if ($lp) $start_pos_count = strip_tags($lp);
	else	$start_pos_count = 1;
	$pos_count = $start_pos_count;
	$pl_pos = 0;

	$num_news  = $news_list->entries();
	if ( $start_pos_count > $num_news) { $news_list->eol = true; }
	$news_data = array();
	$news_list->get_entry( $start_pos_count-1, $news_data );
	$page_break = false;
	$odd_sign = 1;
	menu_superiore();
	echo"<div class='mdl-cell mdl-cell--12-col'><table class= 'mdl-shadow--2dp boxnews'><tr><td>
	<h1><i class='material-icons'>folder</i> Gestione Categorie</h1><br>
	Sono registrate <b>$num_news</b> categorie.<br/><br/>Per le categorie sono inserite come link e descrivono un determinato settore di attivit&agrave;.<br/><br/>
    <table class='mdl-data-table mdl-js-data-table mdl-shadow--2dp'>
	<thead>
		<tr>
			<th class='mdl-data-table__cell--non-numeric'>Nome</th>
			<th>Modifica</th>
			<th>Elimina</th>
		</tr>
	</thead>";
	do {
		if ( !$news_list->eol() ) {
			echo '<tr><td>'.$news_data["ptitolo"].'</td><td><a href="'.$PHP_SELF.'?q=9&amp;id='.$pos_count.'"><img src="./immagini/edit_entry.gif" alt="MODIFICA" border="0" /></a></td><td>'.'<a href="'.$PHP_SELF.'?q=10&amp;id='.$pos_count.'"><img src="./immagini/delete_entry.gif" alt="ELIMINA" border="0" /></a></td></tr>';

			$odd_sign++;
			$news_list->get_next_entry( $news_data );
		}

		$pos_count++;
		$prev_start_pos = $start_pos_count - $news_per_pagina;
		if ($prev_start_pos < 1) $prev_start_pos = 1;
		$next_start_pos = $pos_count;
		$pages = ceil($num_news / $news_per_pagina);
		$page = ceil($start_pos_count / $news_per_pagina);

		if ($start_pos_count == 1 && $pos_count > $news_per_pagina ){
			$page_break = true;
			$nav_left =  '';
			$nav_right = '<a href="'.$PHP_SELF."?q=8&amp;lp=$next_start_pos" . '">seguenti</a>';
		}
		elseif (($pos_count - $start_pos_count) >= $news_per_pagina && !$news_list->eol()) {
			$page_break = true;
			$nav_left =  '<a href="'.$PHP_SELF."?q=8&amp;lp=$prev_start_pos" . '">precedenti</a>';
			$nav_right = '<a href="'.$PHP_SELF."?q=8&amp;lp=$next_start_pos" . '">seguenti</a>';
		}
		elseif ($pos_count > $news_per_pagina && $news_list->eol() ) {
			$page_break = true;
			$nav_left =  '<a href="'.$PHP_SELF."?q=8&amp;lp=$prev_start_pos" . '">precedenti</a>';
			$nav_right = '';
		}

		if ($page_break and $pages > 1) echo "<br/><hr/><center>$nav_left | $page di $pages | $nav_right</center>";

	} while (!$news_list->eol() && !$page_break );
	echo "</table></td></tr></table></div>";
}


function link_categorie() {
	global $archivio_dati, $categorie_file;

	if ( $archivio_dati == "csvfile" ) {
		require_once ( "./inc/csvfile.inc.php" );
		$lista_categorie		= new csvfile;
		$lista_categorie->name	= $categorie_file;
		$lista_categorie->init();
	}

	$dati_categorie = array();
	$lista_categorie->get_entrylist(0,100, $dati_categorie);
	if ($dati_categorie) { 
		uasort ($dati_categorie, "cmp");
		echo "<ul>".$acapo;
			foreach($dati_categorie as $chiave => $valore) {
			$ntitolo = ereg_replace(" ", "%20", $valore["ptitolo"]);
			echo "<li><a href='index.php?categoria=$ntitolo'>".$valore["ptitolo"]."</a></li>".$acapo;
		}
		echo "</ul>".$acapo;
	}
}	


function elimina_categoria() {

	global $conferma, $id, $percorso_cartella_dati, $archivio_dati, $categorie_file;

	if ( $archivio_dati == "csvfile" ) {
		require_once ( "./inc/csvfile.inc.php" );
		$lista_categorie        = new csvfile;
		$lista_categorie->name  = $categorie_file;
		$lista_categorie->init();
	}

	$dati_categorie = array();
	$lista_categorie->get_entry($id-1, $dati_categorie);

	if ($conferma != "SI"){
		echo "<p align='center'><h2>Sei sicuro di voler cancellare la categoria seguente?</h2></p>
		<b>" .$dati_categorie["ptitolo"]. "</b><br/><br/><br/>
		<a href='a_sito.php?q=10&amp;id=$id&amp;conferma=SI'>ELIMINA</a>&nbsp;&nbsp;&nbsp;o&nbsp;&nbsp;&nbsp;
		<a href='a_sito.php?q=8'>annulla</a>";
	}
	else {
		$lista_categorie->delete($id-1);
		echo "<h2>Categoria eliminata</h2><br/><hr/>";
		gestione_categorie();
	}
}


function categoria($categoria) {

	global $archivio_dati, $categorie_file;

	if ( $archivio_dati == "csvfile" ) {
		require_once ( "./inc/csvfile.inc.php" );
		$lista_categorie		= new csvfile;
		$lista_categorie->name  	= $categorie_file;
		$lista_categorie->init();
	}

	$categoria = htmlentities($categoria);
	$categoria = strip_tags($categoria);
	$dati_categorie = array();
	$lista_categorie->get_entrylist(0,100, $dati_categorie);
	$cc = 0;
	foreach($dati_categorie as $chiave => $valore) {
		$cc++;
		if ($categoria == $valore["ptitolo"]) {
			echo "<h2>" .html_entity_decode($valore["ptitolo"]). "</h2><br/>\r\n"
			."<p align='justify'>".html_entity_decode($valore["ptesto"])."</p><br/><br/>\r\n";

			if ($valore["pbox"]) echo "<div class='box'>" . html_entity_decode($valore["pbox"]) . "</div><br /><br />\r\n";
			$data_vis = $valore["data_mod"];

			if ($_SESSION["permessi"] >= 4) $adm_opz = "<a href='a_sito.php?q=9&amp;id=".$cc."'><b>M</b></a> - <a href='a_sito.php?q=10&amp;id=".$cc."'><b>X</b></a>";
			
			echo link_notizie($categoria)."<br /><br /><p class='date'> |&nbsp;".mostra_data($data_vis)."&nbsp;&nbsp;|&nbsp;".$valore["putente"]."&nbsp;&nbsp;&nbsp;".$adm_opz."</p>";
			$trovato = "SI";
			break;
		}
	}
	if ($trovato != "SI") echo "<div class='articolo_s'><h2>Categoria non trovata</h2></div>";
}


function modifica_categoria() {

	global $archivio_dati, $percorso_cartella_dati, $ptitolo, $ptesto, $pbox, $putente, $data_mod, $categorie_file, $conferma, $id;

	if ( $archivio_dati == "csvfile" ) {
		require_once ( "./inc/csvfile.inc.php" );
		$lista_categorie		= new csvfile;
		$lista_categorie->name  	= $categorie_file;
		$lista_categorie->init();
	}

	if($ptitolo) $conferma == "NO";

	$ptitolo = trim(stripslashes($ptitolo));
	$ptitolo = htmlentities($ptitolo, ENT_QUOTES);
	$ptesto = trim(stripslashes($ptesto));
	$ptesto = htmlentities($ptesto, ENT_QUOTES);
	$pbox = trim(stripslashes($pbox));
	$pbox = htmlentities($pbox, ENT_QUOTES);

	$dati_categorie = array();
	$dati_categorie["data_mod"]	= $data_mod;
	$dati_categorie["putente"]	= $putente;
	$dati_categorie["ptitolo"]	= ereg_replace("(\r\n|\n|\r)", "", $ptitolo);
	$dati_categorie["ptesto"]	= ereg_replace("(\r\n|\n|\r)", "", $ptesto);
	$dati_categorie["pbox"]		= ereg_replace("(\r\n|\n|\r)", "", $pbox);
	$dati_categorie["pimmagine"]	= $pimmagine;
	$dati_categorie["ptodo1"]	= 0;
	$dati_categorie["ptodo2"]	= 0;
	$dati_categorie["ptodo3"]	= 0;
	$dati_categorie["ptodo4"]	= 0;
	$dati_categorie["ptodo5"]	= 0;
	$dati_categorie["ptodo6"]	= 0;
	$dati_categorie["ptodo7"]	= 0;
	$dati_categorie["ptodo8"]	= 0;
	$dati_categorie["ptodo9"]	= 0;


	if ($conferma == "SI"){
		$lista_categorie->change($id-1,$dati_categorie);
		echo "<h2>Categoria modificata</h2><br/><hr/>";
		gestione_categorie();

	}
	else {

		unset($dati_categorie);
		$dati_categorie = array();
		$lista_categorie->get_entry($id-1, $dati_categorie);

		$V_dati_categorie["data_mod"]		= $dati_categorie["data_mod"];
		$V_dati_categorie["putente"]		= $dati_categorie["putente"];
		$V_dati_categorie["ptitolo"]		= html_entity_decode($dati_categorie["ptitolo"]);
		$V_dati_categorie["ptesto"]		= html_entity_decode($dati_categorie["ptesto"]);
		$V_dati_categorie["pbox"]		= html_entity_decode($dati_categorie["pbox"]);
		$V_dati_categorie["pimmagine"]	= $dati_categorie["pimmagine"];
		$V_dati_categorie["ptodo1"]		= 0;
		$V_dati_categorie["ptodo2"]		= 0;
		$V_dati_categorie["ptodo3"]		= 0;
		$V_dati_categorie["ptodo4"]		= 0;
		$V_dati_categorie["ptodo5"]		= 0;
		$V_dati_categorie["ptodo6"]		= 0;
		$V_dati_categorie["ptodo7"]		= 0;
		$V_dati_categorie["ptodo8"]		= 0;
		$V_dati_categorie["ptodo9"]		= 0;
		$V_dati_categorie["pattivo"]		= $dati_categorie["pattivo"];

		unset($dati_categorie);

		if ($conferma == "NO") echo"<h2>Inserire titolo o testo</h2>";
		echo"<h2>Modifica categoria <u>".$V_dati_categorie["ptitolo"]."</u></h2><br/><br/>
		<form action='a_sito.php?q=9' method='post' enctype='multipart/form-data'>
		<b>titolo link</b> <small>obbligatorio e breve massimo 40 caratteri</small><br/>
		<input type='text' name='ptitolo' size='40' maxlength='40' value='".$V_dati_categorie["ptitolo"]."' />
		<br />
		<b>utente</b><br/>
		<input type='text' name='putente' size='20' value='".$V_dati_categorie["putente"]."' />
		<br />
		<b>immagine</b><br/>
		<input type='text' name='pimmagine' size='20' value='".$V_dati_categorie["pimmagine"]."' disabled />
		<br />
		<b>Contenuto: <small>obbligatorio</small></b><br/>
		<br/>
		<textarea name='ptesto' rows='20' cols='120'>".$V_dati_categorie["ptesto"]."</textarea>
		<br/>
		<b>Box: <small>opzionale</small></b><br/>
		<br/>
		<textarea name='pbox' rows='20' cols='120'>".$V_dati_categorie["pbox"]."</textarea>
		<br/><br/>
		<input type='hidden' name='id' value='$id' />
		<input type='hidden' name='conferma' value='SI' />
		<input type='submit' name='aggiungi' value='modifica pagina' />
		</form>";
	}
}

########################################################################################
function menu_superiore(){
	echo "<div class='mdl-grid'><div class='mdl-cell mdl-cell--6-col'>
	<table class= 'mdl-shadow--2dp boxest' style='width:100%'><tr><td>
    <div class='mdl-grid'>
    <div class='mdl-cell mdl-cell--12-col'>
         <h1><i class='material-icons'>content_copy</i> Contenuti</h1>
    </div>
    <div class='mdl-cell mdl-cell--3-col box'>
        <i class='material-icons'>create</i> <br><a href='?q=11'>Aggiungi nuova notizia</a>
    </div>
    <div class='mdl-cell mdl-cell--3-col box'>
        <i class='material-icons'>list</i> <br><a href='?q=13'>Gestisci tutte notizie</a>
    </div>
    <div class='mdl-cell mdl-cell--3-col box'>
        <i class='material-icons'>create_new_folder</i> <br><a href='?q=6'>Aggiungi categoria</a>
    </div>
    <div class='mdl-cell mdl-cell--3-col box'>
        <i class='material-icons'>folder</i> <br><a href='?q=8'>Gestisci categorie</a>
    </div>
    </div></td></tr></table></div>
			
<div class='mdl-cell mdl-cell--6-col'>
	<table class= 'mdl-shadow--2dp boxest' style='width:100%'><tr><td>
    <div class='mdl-grid'>
    <div class='mdl-cell mdl-cell--12-col'>
         <h1><i class='material-icons'>dashboard</i> Struttura</h1>
    </div>
    <div class='mdl-cell mdl-cell--3-col box'>
        <i class='material-icons'>add_box</i> <br><a href='?q=1'>Aggiungi pagine al sito</a>
    </div>
    <div class='mdl-cell mdl-cell--3-col box'>
        <i class='material-icons'>pages</i> <br><a href='?q=3'>Gestisci pagine del sito</a>
    </div>
    <div class='mdl-cell mdl-cell--3-col box'>
        <i class='material-icons'>text_format</i> <br><a href='?q=3'>Gestisci testi del sito</a>
    </div>
    <div class='mdl-cell mdl-cell--3-col box'>
        <i class='material-icons'>settings</i> <br><a href='./a_cms_configura.php'>Configurazione del CMS</a>
    </div>
    </div></td></tr></table></div>";
	
}


function agg_notizia() {
	global $archivio_dati, $categorie_file, $sottocategorie_file;

	if ( $archivio_dati == "csvfile" ) {
		require_once ( "./inc/csvfile.inc.php" );
		$lista_categorie		= new csvfile;
		$lista_categorie->name	= $categorie_file;
		$lista_categorie->init();
	}

	$start_pos_count = 1;
	$pos_count = $start_pos_count;
	$num_cat  = $lista_categorie->entries();

	if ( $start_pos_count > $num_cat) { $lista_categorie->eol = true; }

	$dati_categorie = array();
	$lista_categorie->get_entrylist(0,100, $dati_categorie);
	uasort ($dati_categorie, "cmp");

	$vedi_categorie = '<div class="mdl-textfield mdl-js-textfield"><select class="mdl-textfield__input" name="pcategoria">';

	foreach($dati_categorie as $chiave => $valore) {
		$vedi_categorie .= '<option value="'.$valore["ptitolo"].'">'.$valore["ptitolo"].'</option>';
	}

	$vedi_categorie .= '</select></div>';

	if ( $archivio_dati == "csvfile" ) {
		require_once ( "./inc/csvfile.inc.php" );
		$lista_sottocategorie		= new csvfile;
		$lista_sottocategorie->name	= $sottocategorie_file;
		$lista_sottocategorie->init();
	}

	$start_pos_count = 1;
	$pos_count = $start_pos_count;
	$num_subcat  = $lista_sottocategorie->entries();

	if ( $start_pos_count > $num_subcat) { $lista_sottocategorie->eol = true; }

	$dati_sottocategorie = array();
	$lista_sottocategorie->get_entrylist(0,100, $dati_sottocategorie);
	uasort ($dati_sottocategorie, "cmp");

	$vedi_sottocategorie = '<div class="mdl-textfield mdl-js-textfield"><select class="mdl-textfield__input" name="psottocategoria">
	<option value="generale">Generale</option>';

	foreach($dati_sottocategorie as $chiave => $valore) {
		$vedi_sottocategorie .= '<option value="'.$valore["ptitolo"].'">'.$valore["ptitolo"].'</option>';
	}

	$vedi_sottocategorie .= '</select></div>';

	echo"<script language='javascript'>
			function MaxCaratteri(Object, MaxLen) {
	      return (Object.value.length <= MaxLen);
	      }
			</script>";
	menu_superiore();
	echo"<div class='mdl-cell mdl-cell--12-col'><table class= 'mdl-shadow--2dp boxnews'><tr><td>
	<h1><i class='material-icons'>add_circle</i> Aggiungi notizia</h1><br>
	<form action='a_sito.php?q=12' method='post' enctype='multipart/form-data'>
	<b>Titolo</b>: <div class='mdl-textfield mdl-js-textfield'><input
	class='mdl-textfield__input'  type='text' name='ptitolo' size='50' maxlength='50' /><label
	class='mdl-textfield__label' for='sample2'>Inserisci...</label></div>
	
	<label style='padding-left:5px'><b>Categoria:</b></label>
	".$vedi_categorie."

	<label style='padding-left:5px'><b>Appartenenza attivit&agrave;:</b></label>
	".$vedi_sottocategorie."
	<br /><br />
	<b>Abstract:</b> <small>Introduzione o breve notizia - obbligatorio</small><br/>	
	<textarea id='pagetext' name='pabstract' rows='8' cols='120' onkeypress='return MaxCaratteri(this, 1000);'></textarea>
	<br /><br />
	<b>Contenuto notizia:</b><br/>
	<textarea id='pagetext1' name='ptesto' rows='20' cols='120'></textarea>
	<br />
	<b>Box link e altro:</b> <small>opzionale</small><br/>
	<textarea id='pagetext2' name='pbox' rows='10' cols='120'></textarea>
	<br />
	<b>Pubblicazione:</b> <small>Includi l'articolo nella lista notizie</small>&nbsp;&nbsp;&nbsp;
    <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect'>
                <span class='mdl-radio__label'>SI&nbsp;</span>
	            <input class='mdl-radio__button' type='radio' name='pattivo' value='SI' checked />
    </label>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect'>
			<span class='mdl-radio__label'>NO&nbsp;</span>
            <input class='mdl-radio__button' type='radio' name='pattivo' value='NO' />
    </label>

	<br /><br />";
/*	
	echo "<b>Data evento:</b> <small>eventuale nel formato gg-mm-aaaa</small><br/>
	<input type='text' name='pdataeventog' size='2' maxlength='2' />&nbsp;-&nbsp;
	<input type='text' name='pdataeventom' size='2' maxlength='2' />&nbsp;-&nbsp;
	<input type='text' name='pdataeventoa' size='4' maxlength='4' />
	<br />
	<b>titolo evento</b> <small>eventuale massimo 25 caratteri</small><br/>
	<input type='text' name='ptitoloevento' size='25' maxlength='25' />
	<br />
	<b>Breve descrizione evento:</b> <small>opzionale</small><br/>
	<textarea id='pagetext3' name='pdescrevento' rows='3' cols='120'></textarea>
	<br />";

	echo "<b>allega immagine:</b> <small>deve essere gi&agrave; presente nella cartella immagini</small><br/>
	<br />
	<input type='text' name='pimmagine' DISABLED />
	<br />
	<b>file:</b> dimensione massima 1024000 bytes<br/>
	<input type='hidden' name='MAX_FILE_SIZE' value='1024000' />
	<input name='puploadfile' type='file' DISABLED />
	<br />";
*/	
	echo "<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored' type='submit' name='submit' value='aggiungi notizia' />
	</form>
	</div>
	</div></td></tr></table></div>";
}


function agg_notizia2() {
	global $archivio_dati, $percorso_cartella_dati, $ptitolo, $pcategoria, $psottocategoria, $pabstract, $ptesto, $pbox, $pdataeventog, $pdataeventom, $pdataeventoa, $ptitoloevento, $pdescrevento, $pimmagine, $puploadfile, $pattivo, $data_mod, $notizie_file;

	if ($archivio_dati == "csvfile"){
		require_once ("./inc/csvfile.inc.php");
		$news_list        = new csvfile;
		$news_list->name  = $notizie_file;
		$news_list->init();
	}

	$ptitolo = trim(stripslashes($ptitolo));
	$ptitolo = htmlentities($ptitolo, ENT_QUOTES);
	$pabstract = trim(stripslashes($pabstract));
	$pabstract = htmlentities($pabstract, ENT_QUOTES);
	$ptesto = trim(stripslashes($ptesto));
	$ptesto = htmlentities($ptesto, ENT_QUOTES);
	$pbox = trim(stripslashes($pbox));
	$pbox = htmlentities($pbox, ENT_QUOTES);
	$ptitoloevento = trim(stripslashes($ptitoloevento));
	$ptitoloevento = htmlentities($ptitoloevento, ENT_QUOTES);
	$pdescrevento = trim(stripslashes($pdescrevento));
	$pdescrevento = htmlentities($pdescrevento, ENT_QUOTES);
	$pdataevento = trim(stripslashes($pdataevento));
	$pdataevento = htmlentities($pdataevento, ENT_QUOTES);

echo "	if($ptitolo AND $pabstract AND $pcategoria) {";
	if($ptitolo AND $pabstract AND $pcategoria) {

		$new_entry = array();
		$new_entry["data_mod"]		= $data_mod;
		$new_entry["putente"]		= $_SESSION['utente'];
		$new_entry["ptitolo"]		= ereg_replace("(\r\n|\n|\r)", "", $ptitolo);
		$new_entry["ptitolo"]		= ereg_replace("\"", "", $ptitolo);
		$new_entry["pcategoria"]		= $pcategoria;
		$new_entry["psottocategoria"]	= $psottocategoria;
		$new_entry["pabstract"]		= ereg_replace("(\r\n|\n|\r)", "", $pabstract);
		$new_entry["ptesto"]		= ereg_replace("(\r\n|\n|\r)", "", $ptesto);
		$new_entry["pbox"]			= ereg_replace("(\r\n|\n|\r)", "", $pbox);
		$new_entry["pdataevento"]	= $pdataevento;
		$new_entry["ptitoloevento"]	= ereg_replace("(\r\n|\n|\r)", "", $ptitoloevento);
		$new_entry["pdescrevento"]	= ereg_replace("(\r\n|\n|\r)", "", $pdescrevento);
		$new_entry["pimmagine"]		= $pimmagine;
		$new_entry["puploadfile"]	= $puploadfile;
		$new_entry["pattivo"]		= $pattivo;
		$new_entry["ptodo1"]		= 0;
		$new_entry["ptodo2"]		= 0;
		$new_entry["ptodo3"]		= 0;
		$new_entry["ptodo4"]		= 0;
		$new_entry["ptodo5"]		= 0;
		$new_entry["ptodo6"]		= 0;
		$new_entry["ptodo7"]		= 0;
		$new_entry["ptodo8"]		= 0;
		$new_entry["ptodo9"]		= 0;

		$red_data = array();
		$num_dates = $news_list->entries();
		$news_list->get_entry(0,$red_data);

		$i = 0;
		while ( $i<$num_dates && $news_stamp < $red_data["news_stamp"] )
		{
			$news_list->get_next_entry( $red_data );
			$i++;
		}
		$news_list->insert( $i, $new_entry );
		$messaggio = "Notizia inserita";
		echo "<script language='javascript'>top.location.href = 'a_sito.php?q=13&amp;$messaggio';</script>";
		exit;
	}
	else echo"<h2>I campi non erano compilati</h2>";
}


function gestione_notizie() {
	global $percorso_cartella_dati, $archivio_dati, $notizie_file, $lp;

	if ( $archivio_dati == "csvfile" ) {
		require_once ( "./inc/csvfile.inc.php" );
		$news_list        = new csvfile;
		$news_list->name  = $notizie_file;
		$news_list->init();
	}

	$news_per_pagina=25;
	$page = 0;
	$now_stamp = gmmktime();
	if ($lp) $start_pos_count = strip_tags($lp);
	else	$start_pos_count = 1;
	$pos_count = $start_pos_count;
	$pl_pos = 0;

	$num_news  = $news_list->entries();
	if ( $start_pos_count > $num_news) { $news_list->eol = true; }
	$news_data = array();
	$news_list->get_entry( $start_pos_count-1, $news_data );
	$page_break = false;
	$odd_sign = 1;
	echo"<h2>Gestione notizie</h2>
	Sono registrate <b>$num_news</b> notizie.<br/><br/>";
	
	if (isset($messaggio)) echo "<h3>$messaggio</h3><br/>";
	
	do {
		if (!$news_list->eol() AND ($_SESSION["permessi"] >= 4 OR $_SESSION["utente"] == $news_data["putente"])) {
			echo "<a href='a_sito.php?q=14&amp;id=".$pos_count."'>
			<img src='./immagini/edit_entry.gif' alt='MODIFICA' border='0' /></a>&nbsp;&nbsp;
			<a href='a_sito.php?q=15&amp;id=".$pos_count."'>
			<img src='./immagini/delete_entry.gif' alt='ELIMINA' border='0' /></a>&nbsp;&nbsp;";

			echo "<b>".$news_data["ptitolo"]."</b> - ".$news_data["data_mod"]." - ".$news_data["pattivo"]." - ".$news_data["pcategoria"]." - ".$news_data["putente"]."<br/><br/>";
			$odd_sign++;
			$news_list->get_next_entry( $news_data );
		}

		$pos_count++;
		$prev_start_pos = $start_pos_count - $news_per_pagina;
		if ($prev_start_pos < 1) $prev_start_pos = 1;
		$next_start_pos = $pos_count;
		$pages = ceil($num_news / $news_per_pagina);
		$page = ceil($start_pos_count / $news_per_pagina);

		if ($start_pos_count == 1 && $pos_count > $news_per_pagina ){
			$page_break = true;
			$nav_left =  "";
			$nav_right = "<a href='".$PHP_SELF."?q=13&amp;lp=".$next_start_pos."'>seguenti</a>";
		}
		elseif (($pos_count - $start_pos_count) >= $news_per_pagina && !$news_list->eol()) {
			$page_break = true;
			$nav_left =  "<a href='".$PHP_SELF."?q=13&amp;lp=".$prev_start_pos."'>precedenti</a>";
			$nav_right = "<a href='".$PHP_SELF."?q=13&amp;lp=".$next_start_pos."'>seguenti</a>";
		}
		elseif ($pos_count > $news_per_pagina && $news_list->eol() ) {
			$page_break = true;
			$nav_left =  "<a href='".$PHP_SELF."?q=13&amp;lp=".$prev_start_pos."'>precedenti</a>";
			$nav_right = "";
		}

		if ($page_break and $pages > 1) echo "<br/><hr/><center>$nav_left | $page di $pages | $nav_right</center>";

	} while (!$news_list->eol() && !$page_break );
}


function elimina_notizia() {

	global $conferma, $id, $archivio_dati, $notizie_file, $percorso_cartella_dati;

	if ( $archivio_dati == "csvfile" ) {
		require_once ( "./inc/csvfile.inc.php" );
		$lista_notizie			= new csvfile;
		$lista_notizie->name  	= $notizie_file;
		$lista_notizie->init();
	}

	$dati_notizie = array();
	$lista_notizie->get_entry($id-1, $dati_notizie);

	if ($conferma != "SI"){
		echo "<p align='center'><h2>Sei sicuro di voler cancellare la pagina seguente?</h2></p>
		<b>" .$dati_notizie["ptitolo"]. "</b><br/><br/><br/>
		<a href='a_sito.php?q=15&amp;id=$id&amp;conferma=SI'>ELIMINA</a>&nbsp;&nbsp;&nbsp;o&nbsp;&nbsp;&nbsp;
		<a href='a_sito.php?q=13'>annulla</a>";
	}
	else {
		$lista_notizie->delete($id-1);
		$messaggio = "Notizia eliminata";
		echo "<script language='javascript'>top.location.href = 'a_sito.php?q=13&amp;$messaggio';</script>";
		exit;
		;
	}
}



function notizie() {
	global $lp, $news_per_pagina, $archivio_dati, $notizie_file;

	if ( $archivio_dati == "csvfile" ) {
		require_once ( "./inc/csvfile.inc.php" );
		$lista_notizie			= new csvfile;
		$lista_notizie->name	= $notizie_file;
		$lista_notizie->init();
	}

	if (!empty ($HTTP_GET_VARS["page"] ) )
	{ $page = $HTTP_GET_VARS["page"]; }
	else
	{ $page = 0; }

	if ($lp) $start_pos_count = intval(strip_tags($lp));
	else	$start_pos_count = 1;

	$pos_count = $start_pos_count;
	$pl_pos = 0;

	$num_news  = $lista_notizie->entries();
	if ( $start_pos_count > $num_news) { $lista_notizie->eol = true; }
	$news_data = array();
	$lista_notizie->get_entry( $start_pos_count-1, $news_data );
	$page_break = false;

	$odd_sign = 1;
	do {
		if ( !$lista_notizie->eol() )	{
			if ($news_data["pattivo"] == "SI" ) {

				$news_field = "<div class='articolo_s'><h2><a href='".$PHP_SELF."?notiziaid=".$pos_count."'>".$news_data["ptitolo"]."</a></h2><br/>".$acapo;

				$vedi_news_data = html_entity_decode($news_data["pabstract"]);
				
				if (strlen($news_data["ptesto"]) <> 0) $news_continua = "&nbsp;|&nbsp;<a href='".$PHP_SELF."?notiziaid=".$pos_count."'>continua lettura!</a>&nbsp;";

				$news_field .= "<p align='justify'>$vedi_news_data &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>".$acapo;
				$data_vis = $news_data["data_mod"];
				$news_field .= "<p class='date'>";

				$news_field .="&nbsp;|&nbsp;" .mostra_data($data_vis). "&nbsp;|&nbsp;". $news_data["putente"]. "&nbsp;&nbsp;<a href='".$PHP_SELF."?categoria=".$dati_notizie["pcategoria"]."'>".$dati_notizie["pcategoria"]."</a>$news_continua</p></div>".$acapo;
				echo $news_field;
				$odd_sign++;
				unset ($vedi_news_data,$news_continua);
			}

			$lista_notizie->get_next_entry( $news_data );
		}

		$pos_count++;

		$prev_start_pos = $start_pos_count - $news_per_pagina;
		if ($prev_start_pos < 1) $prev_start_pos = 1;

		$next_start_pos = $pos_count;
		$pages = ceil($num_news / $news_per_pagina);
		$page = ceil($start_pos_count / $news_per_pagina);

		if ($start_pos_count == 1 && $pos_count > $news_per_pagina )
		{
			$page_break = true;
			$nav_left =  "";
			$nav_right = "<a href='".$PHP_SELF."?lp=".$next_start_pos."'>precedenti</a>";
		}

		elseif (($pos_count - $start_pos_count) >= $news_per_pagina && !$lista_notizie->eol() )
		{
			$page_break = true;
			$nav_left =  "<a href='".$PHP_SELF."?lp=".$prev_start_pos."'>precedenti</a>";
			$nav_right = "<a href='".$PHP_SELF."?lp=".$next_start_pos."'>successive</a>";
		}

		elseif ($pos_count > $news_per_pagina && $lista_notizie->eol() )
		{
			$page_break = true;
			$nav_left =  "<a href='".$PHP_SELF."?lp=".$prev_start_pos."'>successive</a>";
			$nav_right = "";
		}

		if ($page_break and $pages > 1) echo "<center>$nav_left&nbsp;&nbsp;|&nbsp;&nbsp;$page di $pages&nbsp;&nbsp;|&nbsp;&nbsp;$nav_right</center>".$acapo;

	} while (!$lista_notizie->eol() && !$page_break );

}


function notizia($notiziaid, $evidenzia) {
	global $notiziaid, $evidenzia, $archivio_dati, $notizie_file, $commenti_fb, $like_fb, $dim_comm_fb;

	if (!$notiziaid) $notiziaid=$_GET['notiziaid'];
	$notiziaid = htmlentities($notiziaid);
	$notiziaid = strip_tags($notiziaid);
	$notiziaid = intval($notiziaid);

	if (!$evidenzia) $evidenzia=$_GET['evidenzia'];
	$evidenzia = htmlentities($evidenzia);
	$evidenzia = strip_tags($evidenzia);

	if ( $archivio_dati == "csvfile" ) {
		require_once ( "./inc/csvfile.inc.php" );
		$lista_notizie	= new csvfile;
		$lista_notizie->name = $notizie_file;
		$lista_notizie->init();
	}

	if ($commenti_fb == "SI"){
	$plugin_fb = "<div id='fb-root' style='text-align: left; padding: 10px'></div>
		<script>
		  window.fbAsyncInit = function() {
		    FB.init({appId: 'your app id', status: true, cookie: true,
		             xfbml: true});
		  };
		  (function() {
		    var e = document.createElement('script'); e.async = true;
		    e.src = document.location.protocol +
		      '//connect.facebook.net/it_IT/all.js';
		    document.getElementById('fb-root').appendChild(e);
		  }());
		</script>
		<fb:comments width=".$dim_comm_fb."></fb:comments>";
	}
	else if ($like_fb == "SI") {
			$plugin_fb = "<div id='fb-root'></div>
		<script>
		  window.fbAsyncInit = function() {
		    FB.init({appId: 'your app id', status: true, cookie: true,
		             xfbml: true});
		  };
		  (function() {
		    var e = document.createElement('script'); e.async = true;
		    e.src = document.location.protocol +
		      '//connect.facebook.net/it_IT/all.js';
		    document.getElementById('fb-root').appendChild(e);
		  }());
		</script>
		<fb:like layout='button_count'></fb:like>";
	}
	else $plugin_fb ="";

	$dati_notizie = array();
	$lista_notizie->get_entry( $notiziaid-1, $dati_notizie );
	if ($dati_notizie["pattivo"] != "NO" ) {
		if ($_SESSION["permessi"] >= 4 OR $_SESSION["utente"] == $dati_notizie["putente"]) $adm_opz = "<a href='a_sito.php?q=14&amp;id=".$notiziaid."'><b>M</b></a> - <a href='a_sito.php?q=15&amp;id=".$notiziaid."'><b>X</b></a>";

		if ($evidenzia) {
			$dati_notizie["pabstract"] = eregi_replace("$evidenzia", "<font class='evidenziato'>".strtoupper("$evidenzia")."</font>",$dati_notizie["pabstract"]);	
			$dati_notizie["ptesto"] = eregi_replace("$evidenzia", "<font class='evidenziato'>".strtoupper("$evidenzia")."</font>",$dati_notizie["ptesto"]);
		}
		
		$data_vis = $dati_notizie["data_mod"];
		if (strlen($dati_notizie["pbox"]) >0) $vedi_box = "<div class='slogan_piccolo'>".html_entity_decode($dati_notizie["pbox"])."</div><br/><br/>";

		echo "<div class='articolo'><h2>".html_entity_decode($dati_notizie["ptitolo"])."</h2><br/>".$acapo
		."<div class='slogan'>".html_entity_decode($dati_notizie["pabstract"])."</div><br/>".$acapo
		."<div align='justify'>".html_entity_decode($dati_notizie["ptesto"])."</div><br/><br/>".$acapo
		. $vedi_box.$acapo
		.$plugin_fb."<div class='date'>|&nbsp;".mostra_data($data_vis)."&nbsp;&nbsp;|&nbsp;".$dati_notizie["putente"]."&nbsp;&nbsp;&nbsp;&nbsp;<small>$notiziaid</small>&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$PHP_SELF."?categoria=".$dati_notizie["pcategoria"]."'>".$dati_notizie["pcategoria"]."</a>&nbsp;&nbsp;$adm_opz</div></div>".$acapo;
	}
	else echo "<h2>Notizia non attiva</h2>".$acapo;
}


function link_notizie($categoria) {
	global $archivio_dati, $notizie_file;

	if ($archivio_dati == "csvfile") {
		require_once ("./inc/csvfile.inc.php");
		$lista_notizie			= new csvfile;
		$lista_notizie->name	= $notizie_file;
		$lista_notizie->init();
	}

	$start_pos_count = 1;
	$pos_count = $start_pos_count;
	$num_news  = $lista_notizie->entries();

	if ( $start_pos_count > $num_news) { $lista_notizie->eol = true; }

	$dati_notizia = array();
	$lista_notizie->get_entry( $start_pos_count-1, $dati_notizia );

	if ( !$lista_notizie->eol() )	$altri_link = "";

	do {
		if ( !$lista_notizie->eol() ) {
			if ($dati_notizia["pattivo"] != "NO" and $dati_notizia["pcategoria"] == $categoria) {
				$data_vis = $dati_notizia["data_mod"];
				$altri_link .= mostra_data($data_vis)." - <a href='index.php?notiziaid=$pos_count'>".$dati_notizia["ptitolo"]."</a> - ".$dati_notizia["putente"]."<br/>";
			}
			$lista_notizie->get_next_entry($dati_notizia);
		}
		$pos_count++;
	} while (!$lista_notizie->eol());

	if ($altri_link) echo "<u>Le altre notizie in questa categoria</u><br/>$altri_link";
}

function ultime_notizie($status) {
	global $n_ultime_notizie, $news_per_pagina, $archivio_dati, $notizie_file;

	if ( $archivio_dati == "csvfile" ) {
		require_once ( "./inc/csvfile.inc.php" );
		$lista_notizie			= new csvfile;
		$lista_notizie->name	= $notizie_file;
		$lista_notizie->init();
	}

	if ($status == "tutte") $news_per_pagina = 0;
	$dati_notizie = array();
	$lista_notizie->get_entrylist($news_per_pagina, $n_ultime_notizie-1+$news_per_pagina, $dati_notizie);
	$pos_count = $news_per_pagina;
	$altri_link = "";

	foreach($dati_notizie as $chiave => $valore) {
		if ($valore["pattivo"] != "NO") {
			$data_vis = $valore["data_mod"];
			$pos_count++;
			$altri_link .= "<br />&nbsp;".mostra_dt($data_vis)." - <a href='index.php?notiziaid=$pos_count'>".$valore["ptitolo"]."</a>".$acapo;
		}
	}
	if ($altri_link) $a = "<b><u>Ultime notizie</u></b>".$altri_link;
	# else $a = "$n_ultime_notizie, $news_per_pagina";
	
	return $a;
}


function modifica_notizia() {

	global $archivio_dati, $percorso_cartella_dati, $data_mod, $putente, $ptitolo, $pcategoria, $pabstract, $ptesto, $pbox,  $pdataevento, $ptitoloevento, $pdescrevento, $pimmagine, $puploadfile, $pattivo, $notizie_file, $conferma, $id, $categorie_file;

	if ( $archivio_dati == "csvfile" ) {
		require_once ( "./inc/csvfile.inc.php" );
		$lista_notizie			= new csvfile;
		$lista_notizie->name  	= $notizie_file;
		$lista_notizie->init();
	}

	if($ptitolo) $conferma == "NO";

	// $ptitolo = trim(stripslashes($ptitolo));
	$ptitolo = htmlentities(trim($ptitolo), ENT_QUOTES);
	// $ptesto = trim(stripslashes($ptesto));
	$pabstract = htmlentities(trim($pabstract), ENT_QUOTES);
	$ptesto = htmlentities(trim($ptesto), ENT_QUOTES);
	// $pbox = trim(stripslashes($pbox));
	$pbox = htmlentities(trim($pbox), ENT_QUOTES);
	// $ptitoloevento = trim(stripslashes($ptitoloevento));
	$ptitoloevento = htmlentities(trim($ptitoloevento), ENT_QUOTES);
	// $pdescrevento = trim(stripslashes($pdescrevento));
	$pdescrevento = htmlentities(trim($pdescrevento), ENT_QUOTES);
	// $pdataevento = trim(stripslashes($pdataevento));
	$pdataevento = htmlentities(trim($pdataevento), ENT_QUOTES);
	
	$dati_notizie = array();
	$dati_notizie["data_mod"]		= $data_mod;
	$dati_notizie["putente"]			= $putente;
	$dati_notizie["ptitolo"]			= ereg_replace("(\r\n|\n|\r)", "", $ptitolo);
	$dati_notizie["pcategoria"]		= $pcategoria;
	$dati_notizie["pabstract"]		= ereg_replace("(\r\n|\n|\r)", "", $pabstract);
	$dati_notizie["ptesto"]			= ereg_replace("(\r\n|\n|\r)", "", $ptesto);
	$dati_notizie["pbox"]			= ereg_replace("(\r\n|\n|\r)", "", $pbox);
	$dati_notizie["pdataevento"]		= $pdataevento;
	$dati_notizie["ptitoloevento"]	= ereg_replace("(\r\n|\n|\r)", "", $ptitoloevento);
	$dati_notizie["pdescrevento"]		= ereg_replace("(\r\n|\n|\r)", "", $pdescrevento);
	$dati_notizie["pimmagine"]		= $pimmagine;
	$dati_notizie["puploadfile"]		= $puploadfile;
	$dati_notizie["pattivo"]			= $pattivo;
	$dati_notizie["ptodo1"]			= 0;
	$dati_notizie["ptodo2"]			= 0;
	$dati_notizie["ptodo3"]			= 0;
	$dati_notizie["ptodo4"]			= 0;
	$dati_notizie["ptodo5"]			= 0;
	$dati_notizie["ptodo6"]			= 0;
	$dati_notizie["ptodo7"]			= 0;
	$dati_notizie["ptodo8"]			= 0;
	$dati_notizie["ptodo9"]			= 0;

	if ($conferma == "SI"){
		$lista_notizie->change($id-1,$dati_notizie);
		$messaggio = "Notizia modificata";
		echo "<script language='javascript'>top.location.href = 'a_sito.php?q=13&amp;$messaggio';</script>";
		exit;
	}
	else {

		unset($dati_notizie);
		$dati_notizie = array();
		$lista_notizie->get_entry($id-1, $dati_notizie);

		$pabstract = html_entity_decode($dati_notizie["pabstract"]);
		$ptesto = html_entity_decode($dati_notizie["ptesto"]);
		$pbox = html_entity_decode($dati_notizie["pbox"]);

		$V_dati_notizie["data_mod"]		= $dati_notizie["data_mod"];
		$V_dati_notizie["putente"]		= $dati_notizie["putente"];
		$V_dati_notizie["pcategoria"]		= $dati_notizie["pcategoria"];
		$V_dati_notizie["ptitolo"]		= html_entity_decode($dati_notizie["ptitolo"]);
		$V_dati_notizie["pabstract"]		= $pabstract;
		$V_dati_notizie["ptesto"]		= $ptesto;
		$V_dati_notizie["pbox"]			= $pbox;
		$V_dati_notizie["pdataevento"]	= $dati_notizie["pdataevento"];
		$V_dati_notizie["ptitoloevento"]	= $dati_notizie["ptitoloevento"];
		$V_dati_notizie["pdescrevento"]	= html_entity_decode($dati_notizie["pdescrevento"]);
		$V_dati_notizie["pimmagine"]		= $dati_notizie["pimmagine"];
		$V_dati_notizie["puploadfile"]	= $dati_notizie["puploadfile"];
		$V_dati_notizie["pattivo"]		= $dati_notizie["pattivo"];
		$V_dati_notizie["ptodo1"]		= 0;
		$V_dati_notizie["ptodo2"]		= 0;
		$V_dati_notizie["ptodo3"]		= 0;
		$V_dati_notizie["ptodo4"]		= 0;
		$V_dati_notizie["ptodo5"]		= 0;
		$V_dati_notizie["ptodo6"]		= 0;
		$V_dati_notizie["ptodo7"]		= 0;
		$V_dati_notizie["ptodo8"]		= 0;
		$V_dati_notizie["ptodo9"]		= 0;
		unset($dati_notizie);

		if ( $archivio_dati == "csvfile" ) {
			require_once ( "./inc/csvfile.inc.php" );
			$lista_categorie		= new csvfile;
			$lista_categorie->name	= $categorie_file;
			$lista_categorie->init();
		}

		$start_pos_count = 1;
		$pos_count = $start_pos_count;
		$num_cat  = $lista_categorie->entries();

		if ( $start_pos_count > $num_cat) { $lista_categorie->eol = true; }

		$dati_categorie = array();
		$lista_categorie->get_entrylist(0,100, $dati_categorie);
		uasort ($dati_categorie, "cmp");
		$vedi_categorie = '<select name="pcategoria">';

		foreach($dati_categorie as $chiave => $valore) {
			if ($V_dati_notizie["pcategoria"] == $valore["ptitolo"]) $vedi_categorie .= "<option value='".$valore["ptitolo"]."' selected='selected'>".$valore["ptitolo"]."</option>";
			else $vedi_categorie .= "<option value='".$valore["ptitolo"]."'>".$valore["ptitolo"]."</option>";
		}

		$vedi_categorie .= '</select>';


		if ($conferma == "NO") echo"<h2>Inserire titolo o testo</h2>";

		echo"<h2>Modifica notizia <u>".html_entity_decode($V_dati_notizie["ptitolo"])."</u></h2><br/><br/>
		<form action='a_sito.php?q=14' method='post' enctype='multipart/form-data'>
		<b>titolo</b> <small>obbligatorio e massimo 50 caratteri</small><br/>
		<input type='text' name='ptitolo' size='50' maxlength='50' value='".html_entity_decode($V_dati_notizie["ptitolo"])."' />
		<br />
		<b>categoria:</b> <small>elemento obbligatorio</small><br/>
		<br />".$vedi_categorie."
		<br />
		<b>utente</b><br/>
		<input type='text' name='putente' size='20' value='".$V_dati_notizie["putente"]."' />
		<br />
		<b>Abstract:</b> <small>obbligatorio</small><br/>
		<br />
		<textarea id='pagetext' name='pabstract' rows='20' cols='120'>".html_entity_decode($V_dati_notizie["pabstract"])."</textarea>
		<br />
		<b>Contenuto notizia:</b><br/>
		<br />
		<textarea id='pagetext1' name='ptesto' rows='20' cols='120'>".html_entity_decode($V_dati_notizie["ptesto"])."</textarea>
		<br />
		<b>Box link e altro:</b> <small>opzionale</small><br/>
		<br />
		<textarea id='pagetext2' name='pbox' rows='7' cols='120'>".html_entity_decode($V_dati_notizie["pbox"])."</textarea>
		<br />";
/*		
		echo "<b>Data evento:</b> <small>eventuale nel formato gg/mm/aaaa</small>
		<br />
		<input type='text' name='pdataevento' size='10' maxlength='10' value='".$V_dati_notizie["pdataevento"]."' disabled />
		<br />
		<b>titolo evento</b> <small>eventuale massimo 25 caratteri</small><br/>
		<input type='text' name='ptitoloevento' size='25' maxlength='25' value='".html_entity_decode($V_dati_notizie["ptitoloevento"])."' disabled />
		<br />
		<b>Breve descrizione evento:</b> <small>opzionale</small><br/>
		<br />
		<textarea id='pagetext3' name='pdescrevento' rows='3' cols='120' disabled >".html_entity_decode($V_dati_notizie["pdescrevento"])."</textarea>
		<br />";
*/		
		echo"
		<b>allega immagine:</b> <small>deve essere gi&agrave; presente nella cartella immagini</small><br/>
		<br />
		<input type='text' name='pimmagine' DISABLED />
		<br />
		<b>file:</b> dimensione massima 1024000 bytes<br/>
		<input type='hidden' name='MAX_FILE_SIZE' value='1024000' />
		<input name='puploadfile' type='file' DISABLED />
		<br />
		<b>pubblica pagina:</b> <small>SI include l'articolo nella lista notizie</small><br/>
		<br />
		SI&nbsp;<input type='radio' name='pattivo' value='SI' checked />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO&nbsp;<input type='radio' name='pattivo' value='NO' />
		<br />
		<input type='hidden' name='id' value='".$id."' />
		<input type='hidden' name='conferma' value='SI' />
		<input type='submit' name='submit' value='modifica notizia' />
		</form>";
	}
}
###########################################################################################################
?>