<?php
$expire = 600;
$logfile = $percorso_cartella_dati."/c_vis.log";
$ip = getenv('REMOTE_ADDR');
$visite = 0;
$badhit = false;
$now = time();
$ips = array(array());

if (!file_exists($logfile)) @fopen($logfile,"wb+");

$loggedips = file($logfile);
$visite = trim($loggedips[0]);

for ($i=1; $i< count($loggedips); $i++){
	$loggedips[$i] = trim($loggedips[$i]);
	$ips[$i] = explode('||', $loggedips[$i]);
	if (($ips[$i][0] == $ip) && ($now-$ips[$i][1]< $expire))
	$badhit= true;
}
if ($badhit)
echo "<br />Visitatori: ".$visite;
else{
	$visite++;
	$fp = fopen($logfile, 'w+');
	fputs($fp,"$visite\n");
	for ($i = 1; $i < count($loggedips); $i++){
		if ($now-$ips[$i][1] < $expire)
		fputs($fp, $ips[$i][0]."||".$ips[$i][1]."\n");
	}
	fputs($fp, "$ip||$now\n");
	fclose($fp);
	echo "<br />Visitatori: ".$visite;
}
?>