<?php

require_once ("./controlla_pass.php");
include("./header.php");


if ($_SESSION['valido'] == "SI" AND $_SESSION['permessi'] >= 0 ) {
	if ($_SESSION['permessi'] == 5) require ("./a_menu.php");
	elseif ($_SESSION['permessi'] <= 4) require ("./menu.php");

	echo "<table summary='Registro mercato' width='100%' align='center' class='border' cellpadding='10' bgcolor='$sfondo_tab'>
	<caption>Invio logo utente</caption>
	<tr><td valign ='top' align='left'>";
	
		
	$uploadpath = 'immagini/loghi/';      // directory to store the uploaded files
	$max_size = 256;          // maximum file size, in KiloBytes
	$alwidth = 1500;            // maximum allowed width, in pixels
	$alheight = 1500;           // maximum allowed height, in pixels
	$allowtype = array('gif', 'jpg','png');        // allowed extensions

	
	if (!is_dir($uploadpath)) {
		mkdir($uploadpath, 0775, true);
		echo "Creata cartella caricamento loghi: $uploadpath!<br />";
	}

	if (!is_writable($uploadpath)) echo "La cartella $uploadpath non &egrave; scrivibile!<br /> Impostare CHMOD 775.<br />";
	if (!is_readable($uploadpath)) echo "La cartella $uploadpath non &egrave; leggibile!<br /> Impostare CHMOD 775.<br />";
	
	echo "<center>Form upload per il logo utente. <br />Sono supportate le seguenti estensioni: $allowtype[0] - $allowtype[1] - $allowtype[2] <br /><br />
	Dimensione consentita: $max_size Kb<br /><br />";
	
if(isset($_FILES['fileup']) && strlen($_FILES['fileup']['name']) > 1) {
  $sepext = explode('.', strtolower($_FILES['fileup']['name']));
  $type = end($sepext);       // gets extension
  $uploadpath = $uploadpath.$_SESSION['utente'].".jpg";    // gets the file name
  list($width, $height) = getimagesize($_FILES['fileup']['tmp_name']);     // gets image width and height
  $err = '';         // to store the errors

  // Checks if the file has allowed type, size, width and height (for images)
  if(!in_array($type, $allowtype)) $err .= 'Il file <b>'. $_FILES['fileup']['name']. '</b> ha un estensione non valida';
  if($_FILES['fileup']['size'] > $max_size*1000) $err .= '<br/>La dimensione massima del file &egrave;: '. $max_size. ' KB.';
  if(isset($width) && isset($height) && ($width >= $alwidth || $height >= $alheight)) $err .= '<br/>Il file deve essere massimo: '. $alwidth. ' x '. $alheight;

  // If no errors, upload the image, else, output the errors
  if($err == '') {
	if(file_exists($_SESSION['utente'].".jpg")) unlink($_SESSION['utente'].".jpg");
    if(move_uploaded_file($_FILES['fileup']['tmp_name'], $uploadpath)) { 
      echo 'File: <b>'. basename( $_FILES['fileup']['name']). '</b> caricato correttamente:';
      echo '<br/>File tipo: <b>'. $_FILES['fileup']['type'] .'</b>';
      echo '<br />Dimensione: <b>'. number_format($_FILES['fileup']['size']/1024, 3, '.', '') .'</b> KB';
      #if(isset($width) && isset($height)) echo '<br/>Image Width x Height: '. $width. ' x '. $height;
      #echo '<br/><br/>Image address: <b>http://'.$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['REQUEST_URI']), '\\/').'/'.$uploadpath.'</b>';
    }
    else echo '<b>Impossibile caricare il file.</b>';
  }
  else echo $err;
}

	echo "<form ENCTYPE='multipart/form-data' action='logo_upload.php' method='POST'>
	<input type='file' name='fileup'><br /><br />
	<input type='submit' name='submit' value='Upload'>
	</form><br />";
	$contro= $uploadpath.$_SESSION['utente'].".jpg";
	if(file_exists($contro)){
		echo "<img src='$contro' border='1' />";
		}
		
}
include ("./footer.php");
?>