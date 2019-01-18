<?php
	#########################################################
	#### Massimo 5 minuti (300 sec) per svolgere l'operazione 
	ini_set('max_execution_time', 300); 
	
	#############################################################
	#### Pesco il file remoto e seleziono la directory temporanea 
	$remote_file_url = 'https://github.com/KrAros/fcbe-material-design/archive/master.zip'; 
	$local_file = './new-version.zip';
	
	######################################
	#### Copio il file da Github al server 
	$copy = copy($remote_file_url, $local_file);
	if(!$copy){
		## Fallisce
		$data = array("copy" => 0);
		}else{
		## Successo - continua unzip
		$copy = 1;
	}
	
	##################################################################################
	#### Funzione per copiare il contenuto dalla cartella temporanea a quella corretta
	function recurse_copy($src,$dst) {
		$dir = opendir($src);
		@mkdir($dst);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($src . '/' . $file) ) {
					recurse_copy($src . '/' . $file,$dst . '/' . $file);
				}
				else {
					copy($src . '/' . $file,$dst . '/' . $file);
				}
			}
		}
		closedir($dir);
	}
	
	## Cartella temporanea
	$s = './fcbe-material-design-master';
	
	## Root del sito
	$c = '.../';
	
	################################################################
	#### Funzione per eliminare la cartella temporanea di estrazione
	
	function rmdir_recursive($dir) {
		foreach(scandir($dir) as $file) {
			if ('.' === $file || '..' === $file) continue;
			if (is_dir($dir.'/'.$file)) rmdir_recursive($dir.'/'.$file);
			else unlink($dir.'/'.$file);
		}
		rmdir($dir);
	}
	
	if($copy == 1){
		
		$path = pathinfo(realpath($local_file), PATHINFO_DIRNAME);
		
		###################################################
		####Inizia unzip e determino quali file non copiare
		$zip = new ZipArchive;
		$res = $zip->open($local_file);
		if($res === TRUE){
			$zip->deleteName('fcbe-material-design-master/dati/dati_gen.php');
			$zip->deleteName('fcbe-material-design-master/dati/categorie_file.csv');
			$zip->deleteName('fcbe-material-design-master/dati/cms_conf.php');
			$zip->deleteName('fcbe-material-design-master/dati/notizie_file.csv');
			$zip->deleteName('fcbe-material-design-master/dati/pagine_file.csv');
			$zip->deleteName('fcbe-material-design-master/dati/testi.php');
			$zip->close();
			$zip->open($local_file);
			$zip->extractTo( $path );
			$zip->close();
			recurse_copy($s,$c);
			rmdir_recursive($s);
			## Successo
			$data = array("unzip" => 1);
			## Cancello lo zip
			unlink($local_file);
			} else {
			## Errore
			$data = array("unzip" => 0);
			## Elimino zip potenzialmente corrotto
			unlink($local_file);
		}
	}
	## Invio a JSON data
	echo json_encode($data);
?>