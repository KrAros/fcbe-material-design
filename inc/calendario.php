<?php

if (isset($_GET['n_mese'])) $n_mese = $_GET['n_mese'];
if (isset($_GET['anno'])) $anno = $_GET['anno'];
if (!isset($n_mese)) {
    $n_mese=date(n);
}
if (!isset($anno)) {
    $anno = date(Y);
}

$mese = date(n, mktime(0, 0, 0, $n_mese, 1, $anno));
if ($mese==1) $mesetesto = "gennaio";
if ($mese==2) $mesetesto = "febbraio";
if ($mese==3) $mesetesto = "marzo";
if ($mese==4) $mesetesto = "aprile";
if ($mese==5) $mesetesto = "maggio";
if ($mese==6) $mesetesto = "giugno";
if ($mese==7) $mesetesto = "luglio";
if ($mese==8) $mesetesto = "agosto";
if ($mese==9) $mesetesto = "settembre";
if ($mese==10) $mesetesto = "ottobre";
if ($mese==11) $mesetesto = "novembre";
if ($mese==12) $mesetesto = "dicembre";

if ($mese==1) $mesetestop = "gen";
if ($mese==2) $mesetestop = "feb";
if ($mese==3) $mesetestop = "mar";
if ($mese==4) $mesetestop = "apr";
if ($mese==5) $mesetestop = "mag";
if ($mese==6) $mesetestop = "giu";
if ($mese==7) $mesetestop = "lug";
if ($mese==8) $mesetestop = "ago";
if ($mese==9) $mesetestop = "set";
if ($mese==10) $mesetestop = "ott";
if ($mese==11) $mesetestop = "nov";
if ($mese==12) $mesetestop = "dic";

$giornodelmese = date(t, mktime(0, 0, 0, $n_mese, 1, $anno)) ;
$day_text = date(D, mktime(0, 0, 0, $n_mese, 1, $anno));
?>
<style type="text/css">
.tdday { font-family: Verdana, Arial, Helvetica, sans-serif;
                  background-color: #0000ff;
                  font-weight: normal;
                  font-size: 9px;
                  width: 26px;
                  line-height: 20px;
                  color: #ffffff;
                  vertical-align: middle;
                  text-align: center;
}
.tdtoday { font-family: Verdana, Arial, Helvetica, sans-serif;
                  background-color: lightgreen;
                  font-weight: bold;
                  font-size: 10px;
                  line-height: 16px;
                  width: 26px;
                  color: #000000;
                  vertical-align: middle;
                  text-align: center;
}

.tdheading { font-family: Verdana, Arial, Helvetica, sans-serif;
                  background-color: #a0a0a0;
                  font-weight: bold;
                  font-size: 10px;
                  line-height: 20px;
                  color: #ffffff;
                  vertical-align: middle;
                  text-align: center;
}
.tddate { font-family: Verdana, Arial, Helvetica, sans-serif;
                  background-color: #f0f0f0;
                  font-weight: normal;
                  font-size: 10px;
                  line-height: 16px;
                  width: 26px;
                  color: #000000;
                  vertical-align: middle;
                  text-align: center;
 }
.caltable { border: #a0a0a0;
                   border-style: solid;
                   border-top-width: 1px;
                   border-right-width: 1px;
                   border-bottom-width: 1px;
                   border-left-width: 1px;
                   margin-bottom: 0px;
                   margin-top: 0px;
                   margin-right: 0px;
                   margin-left: 0px;
                   padding-top: 0px;
                   padding-right: 0px;
                   padding-bottom: 0px;
                   padding-left: 0px
}
</style>
<table width='97%'>
<caption><?php echo $mesetesto." ".$anno; ?></caption>
<tr>
<td class='tdday'>lun</td><td class='tdday'>mar</td><td class='tdday'>mer</td><td class='tdday'>gio</td><td class='tdday'>ven</td><td class='tdday'>sab</td><td class='tdday'>dom</td>
</tr>
<tr>
<?php
$day_of_wk = date(w, mktime(0, 0, 0, $n_mese, 1, $anno));

if ($day_of_wk <> 1){
	for ($i=1; $i<$day_of_wk; $i++) { 
   	echo "<td class='tddate'>&nbsp;</td>"; 
   	}
}

for ($date_of_mth = 1; $date_of_mth <= $giornodelmese; $date_of_mth++) {

	if ($day_of_wk = 0){
   		echo "<tr>"; 
	}
    $day_text = date(D, mktime(0, 0, 0, $n_mese, $date_of_mth, $anno));
    $date_no = date(j, mktime(0, 0, 0, $n_mese, $date_of_mth, $anno));
    $day_of_wk = date(w, mktime(0, 0, 0, $n_mese, $date_of_mth, $anno));
   if ( $date_no ==  date(j) &&  $n_mese == date(n) )	{
   	echo "<td class='tdtoday'>".$date_no."</td>"; 
   	}
   else	{ 
   	echo "<td class='tddate'>".$date_no."</td>";  
   	}
   If ( $day_of_wk == 0 ) { echo "</tr><tr>"; }
   If ( $day_of_wk <= 6 && $date_of_mth == $giornodelmese ) {
   	for ( $i = $day_of_wk ; $i <= 6; $i++ ) {
     echo "<td class='tddate'>&nbsp;</td>"; 
     }
	echo "</tr>";
	}
}
echo "</table>";
?>