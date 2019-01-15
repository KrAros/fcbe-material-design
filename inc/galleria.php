<?php
##################################################################################
#    FANTACALCIOBAZAR EVOLUTION#    Copyright (C) 2003-2007 by Antonello Onida (fantacalciobazar@sssr.it)
#    Copyright (C) 2001-2002 by Marco Maria Francesco De Santis (marcods@gmx.net)
#
#    This program is free software; you can redistribute it and/or modify
#    it under the terms of the GNU General Public License as published by
#    the Free Software Foundation; either version 2 of the License, or
#    (at your option) any later version.
#
#    This program is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU General Public License for more details.
#
#    You should have received a copy of the GNU General Public License
#    along with this program; if not, write to the Free Software
#    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
##################################################################################

# CONFIGURAZIONE #

// number of images to display as thumbnails if a thumbnail directory exists
// (note that this will be rounded down to an odd number for symmetry.)
$thumb_row = 17;

// file containing optional image descriptions
$pic_info_file="pics.txt";

// thumbnail directory name (no slashes needed)
$thumbnail_dir = "tn";

// language text for various areas...
$lang_back = "indietro";
$lang_next = "avanti";
$lang_of = "di";
$lang_stop_slideshow = "ferma slideshow";
$lang_start_slideshow = "slideshow";
$lang_img_hover = "prossima immagine...";
$lang_img_alt = "slideshow immagine";


// sort images with newest or oldest on top. (this has no effect when pics.txt is used)
// $sort_images = "vecchia";
$sort_images = "nuova";

// set to true to display navigation icons instead of text...
$show_navigation_buttons = "false";
$back_button = "/images/left.gif";
$next_button = "/images/right.gif";

// grab the variables we want set for newer php version compatability
$currentPic = $_GET['currentPic'];
$auto = $_GET['auto'];

# FINE CONFIGURAZIONE #

// check for platform dependent path info... (for windows and mac OSX)
$path = empty($_SERVER['PATH_INFO'])?$_SERVER['PHP_SELF']:$_SERVER['PATH_INFO'];

// check that the user did not change the path...
if (preg_match(':(\.\.|^/|\:):', $dir_immagini)) {
	echo "<b>ERRORE:</b> path non valido.<br/>
    Il nome della cartella non deve contenere .. o : o iniziare con /<br/>";
	exit;
}

if (empty($dir_immagini)) $dir_immagini = ".";

// image / text buttons
if ($show_navigation_buttons == "true") {
	$back_src = "<img src='$back_button' alt='indietro'>";
	$next_src = "<img src='$next_button' alt='avanti'>";
}
else {
	$back_src = "$lang_back";
	$next_src = "$lang_next";
}

	if ( !file_exists("$dir_immagini/$pic_info_file")) {
        $dh = opendir( "$dir_immagini" );
        $pic_info = array();
        $time_info = array();
        while( $file = readdir( $dh ) ) {
								// look for these file types....
                if (preg_match('/(jpg|jpeg|gif|png)$/i',$file)) {
                        $time_info[] = filemtime("$dir_immagini/$file");
                        $pic_info[] = $file;
                }
        }
        if ( $sort_images == "vecchia" ) $sortorder = SORT_ASC;
        elseif ( $sort_images == "nuova" ) $sortorder = SORT_DESC;
        array_multisort($time_info, $sortorder, $pic_info, SORT_ASC, $time_info);
  }
  else $pic_info=file("$dir_immagini/$pic_info_file");

// begin messing with the array
$number_pics = count ($pic_info);
if (($currentPic > $number_pics)||($currentPic == $number_pics)||!$currentPic)
	$currentPic = '0';
$item = explode (";", rtrim($pic_info[$currentPic]));
$last = $number_pics - 1;
$next = $currentPic + 1;
if ($currentPic > 0 ) $back = $currentPic - 1;
else $currentPic = "0";


$blank = empty($item[1])?'&nbsp;':$item[1];

if ($currentPic > 0 ) $nav=$back;
else $nav=$last;
$nav = "<a href='$path?dir_immagini=$dir_immagini&amp;currentPic=$nav'>$back_src</a>";
$current_show = "$path?dir_immagini=$dir_immagini";
$next_link = "<a href='$path?dir_immagini=$dir_immagini&amp;currentPic=$next'>$next_src</a>";

// {{{ ------- EXIF stuff

//get comments from the EXIF data if available...
if(extension_loaded(exif)) {
	$curr_image = "$dir_immagini/$item[0]";
	$all_exif = @exif_read_data($curr_image,0,true);
	$exifhtml = $all_exif['COMPUTED'];
	$comment = $all_exif['COMMENT'][0];
}
// }}}

$image_title = "$item[1]";

// {{{ ------- my_circular($a_images, $currentPic, $thumb_row);

function my_circular($thumbnail_dir, $a_images, $currentPic, $thumb_row, $dir_immagini) {
global $path;
global $auto_url;

// get size of $a_images array...
$number_pics = count($a_images);
// do a little error checking...
if ($currentPic > $number_pics) $currentPic = 0;
if ($currentPic < 0) $currentPic = 0;
if ($thumb_row < 0) $thumb_row = 1;

// check if thumbnail row is greater than number of images...
if ($thumb_row > $number_pics) $thumb_row = $number_pics;

// split the thumbnail number and make it symmetrical...
$half = floor($thumb_row/2);

// show thumbnails
// left hand thumbs
if (($currentPic - $half) < 0) { // near the start...
    $underage = ($currentPic-1) - $half;
    for ( $x=($number_pics-abs($underage+1)); $x<$number_pics; $x++) {
        $next=$x;
        $item = explode (";", rtrim($a_images[$x]));
        $out .= "\n<a href='$path?dir_immagini=$dir_immagini$auto_url&amp;currentPic=$next'><img src='$dir_immagini/$thumbnail_dir/".$item[0]."'></a>";
    }
    for ( $x=0; $x<$currentPic  ; $x++ ) {
        $next=$x;
        $item = explode (";", rtrim($a_images[$x]));
        $out .= "\n<a href='$path?dir_immagini=$dir_immagini$auto_url&amp;currentPic=$next'><img src='$dir_immagini/$thumbnail_dir/".$item[0]."'></a>";
    }
}
else {
    for ( $x=$currentPic-$half; $x < $currentPic; $x++ ) {
        $next=$x;
        $item = explode (";", rtrim($a_images[$x]));
        $out .= "\n<a href='$path?dir_immagini=$dir_immagini$auto_url&amp;currentPic=$next'><img src='$dir_immagini/$thumbnail_dir/".$item[0]."'></a>";
    }
}

// show current (center) image thumbnail...
$item = explode (";", rtrim($a_images[$currentPic]));
$out .= "\n<img src='$dir_immagini/$thumbnail_dir/".rtrim($item[0])."'>";

// array for right side...
if (($currentPic + $half) >= $number_pics) { // near the end
    $overage = (($currentPic + $half) - $number_pics);
    for ( $x=$currentPic+1; $x < $number_pics; $x++) {
        $next=$x;
        $item = explode (";", rtrim($a_images[$x]));
        $out .= "\n<a href='$path?dir_immagini=$dir_immagini$auto_url&amp;currentPic=$next'><img src='$dir_immagini/$thumbnail_dir/".$item[0]."'></a>";
    }
    for ( $x=0; $x<=abs($overage); $x++) {
        $next=$x;
        $item = explode (";", rtrim($a_images[$x]));
        $out .= "\n<a href='$path?dir_immagini=$dir_immagini$auto_url&amp;currentPic=$next'><img src='$dir_immagini/$thumbnail_dir/".$item[0]."'></a>";
    }
}
else {
    for ( $x=$currentPic+1; $x<=$currentPic+$half; $x++ ) {  // right hand thumbs
        $next=$x;
        $item = explode (";", rtrim($a_images[$x]));
        $out .= "\n<a href='$path?dir_immagini=$dir_immagini$auto_url&amp;currentPic=$next'><img src='$dir_immagini/$thumbnail_dir/".$item[0]."'></a>";
    }
}

}
// }}}
// {{{ meta refresh stuff for auto slideshow...
if ($auto == "1") {
        $auto_url = "&amp;auto=1";
        $meta_refresh = "<meta http-equiv='refresh' content='".$ritardo_immagini;
        $meta_refresh .= ";url=".$path."?dir_immagini=".$dir_immagini.$auto_url."&amp;currentPic=".$next."'>";
        $auto_slideshow = "<a href='$path?dir_immagini=$dir_immagini&amp;currentPic=$currentPic'>$lang_stop_slideshow</a>\n";
        }
else {
        $auto_slideshow = "<a href='$path?dir_immagini=$dir_immagini&amp;auto=1&amp;currentPic=$next'>$lang_start_slideshow</a>\n";
}
// }}}

$images = "<a href='$path?dir_immagini=$dir_immagini$auto_url&amp;currentPic=$next'>";
$images .= "<img src='$dir_immagini/$item[0]' alt='$lang_img_alt' title='$lang_img_hover' width=$larghezza_immagine></a>";

if( file_exists( "$dir_immagini/$thumbnail_dir" ) ) {
    my_circular($thumbnail_dir, $pic_info, $currentPic, $thumb_row, $dir_immagini);
}

$image_filename = "$item[0]";

$vedi_galleria1 = "$meta_refresh
	<div>$images</div>
	<div>$image_title $comment</div>
	<div><a href='$current_show'>Inizio</a> | $nav [$next $lang_of $number_pics] $next_link | $auto_slideshow</div>
	<div>$out</div>";

$vedi_galleria = "$meta_refresh
	<div>$images</div>
	<div><a href='$current_show'>Inizio</a> | $nav [$next $lang_of $number_pics] $next_link | $auto_slideshow</div>";

echo $vedi_galleria;
?>