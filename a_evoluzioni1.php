<?php
##################################################################################
#	FANTACALCIOBAZAR EVOLUTION
#	Copyright (C) 2003-2006 by Antonello Onida (fantacalciobazar@sassarionline.net)
#
#	Prego leggere i file allegati crediti.txt e licenza.txt
##################################################################################
require_once("./dati/dati_gen.php");
require_once("./inc/funzioni.php");
include("./header.php");

	$v = @file($percorso_cartella_dati."/2005/MCC".$n.".txt");

    $key = "this is a secret key";
    $input = "Let us meet at 9 o'clock at the secret place.";

    $td = mcrypt_module_open('tripledes', '', 'ecb', '');
    $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
    mcrypt_generic_init($td, $key, $iv);
    $encrypted_data = mcrypt_generic($td, $input);
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);

include("./footer.php");
?>