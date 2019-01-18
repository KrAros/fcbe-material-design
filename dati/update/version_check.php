<?php
	
	############################################
	#### Controllo l'ultima versione disponibile
	
	$version = file_get_contents('https://raw.githubusercontent.com/KrAros/fcbe-material-design/master/dati/update/VERSION');
	$version = explode(".", $version);
	$major = $version[0];
	$minor = $version[1];
	$revision = $version[2];
	$revision = explode("-", $revision);
	$channel = $revision[1];
	$revision = $revision[0];
	$vnum = $major.$minor.$revision;
	//echo $major.$minor.$revision;
	
	#################################
	#### Controllo la versione locale
	
	$version_loc = file_get_contents('./VERSION');
	$version_loc = explode(".", $version_loc);
	$major_loc = $version_loc[0];
	$minor_loc = $version_loc[1];
	$revision_loc = $version_loc[2];
	$revision_loc = explode("-", $revision_loc);
	$channel_loc = $revision_loc[1];
	$revision_loc = $revision_loc[0];
	$user_vnum = $major_loc.$minor_loc.$revision_loc;
	//echo $major_loc.$minor_loc.$revision_loc;
	
	if($user_vnum == $vnum){
		// data
		$data = array("version" => 0);
		} else {
		// data
		$data = array("version" => $vnum);
	}
	## Invio a JSON data
	echo json_encode($data);
?>