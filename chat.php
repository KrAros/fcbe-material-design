<?php
$utente = $_GET['utente'];
include_once("./dati/dati_gen.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it-it" lang="it-it" >
<head>
<title>Chat <? echo $titolo_sito." - ".$utente; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Language" content="Italian" />
<meta name="Author" content="Antonello Onida - http://fantacalciobazar.sssr.it" />
<meta name="Description" content="FantacalcioBazar | Il migliore gestore di Fantacalcio on line" />
<meta name="Keywords" content="fantacalciobazar, fantacalcio, semplice, completo, online" />
<meta name="Robots" content="index, follow" />
<link rel="stylesheet" type="text/css" href="inc/ajax-chat/style/style.css" />
<style type="text/css"> html,	body	{ padding: 0px; margin: 0px; } </style>
</head>
<body onload="chat_api_onload('Generale',true,'<? echo $utente ?>', 'pass');">
<?
$vedi_tornei_attivi	= array();
$vedi_tornei_attivi[] = "Generale";
$tornei =	@file("$percorso_cartella_dati/tornei.php");
$num_tornei = 0;
$conta_tornei = count($tornei);
	for($num1	= 0;	$num1 < $conta_tornei; $num1++){
		$num_tornei++;
	}

	for ($num1 = 1	; $num1 <	$num_tornei; $num1++) {
		@list($otid, $otdenom) =	explode(",", $tornei[$num1]);
		$vedi_tornei_attivi[]= $otdenom;
	} # fine for $num1

#$chat_list = array('Principale', 'Stanza 1', 'Stanza 2');
$chat_list = $vedi_tornei_attivi;
$chat_logs = array('add'	=> false,	'get' => false, 'log' =>	false);
$chat_show = array('login' =>	false, 'guest'	=> false);
$chat_path = 'inc/ajax-chat/';
include_once $chat_path.'ajax-chat.php';
?>
</body>
</html>