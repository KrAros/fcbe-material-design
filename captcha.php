<?
    session_start();
    $stringa = md5(microtime());
    $risultato = substr($stringa, 0, 5);
    $immagine = imagecreatefromjpeg("./inc/rec/captcha.jpg");
    $testo = imagecolorallocate($immagine, 255, 255, 255);
    imagestring($immagine, 5, 17, 7, $risultato, $testo);
    $_SESSION['CONTROLLO'] = $risultato;
    header("Content-type: image/jpeg");
    imagejpeg($immagine);
?>