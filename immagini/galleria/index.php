<?php

// EasyPhpAlbum - a single script thumbnail gallary with navigation
// Copyright (C) 2004  JF Nutbroek - jfnutbroek@hotmail.com
//
// Version 1.2.2 - June 2005
// Requires PHP4.1.0+ and GDlib1.6+ - Tested with Linux and Windows, Explorer & Firefox
//
// This program is free software; you can redistribute it and/or modify 
// it under the terms of the GNU General Public License as published by 
// the Free Software Foundation; either version 2 of the License, or 
// (at your option) any later version. 
//
// This program is distributed in the hope that it will be useful, 
// but WITHOUT ANY WARRANTY; without even the implied warranty of 
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
// GNU General Public License for more details. 
//
// You should have received a copy of the GNU General Public License 
// along with this program; if not, write to the Free Software 
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA 
//
// ***********************************************************************************************
//
// How to use EasyPhpAlbum:
//
// Include this index.php file in your directory with JPG, PNG or GIF images - thats all!
//
// For multiple albums, create subdirectories and include the index.php script in each subdirectory
//
// htdocs/photoalbums/						- Main directory for your albums
//		 - index.php					- This index.php script
//		 - Vacation Holland 2003			- Subdirectory for your first album
//		 	- index.php				- This index.php script
//			- This is Amsterdam.jpg			- The 1st image of this album
//			- This is Schiphol.jpg			- The 2nd image of this album
//		 - Vacation Holland 2002			- Subdirectory for your 2nd album
//			- index.php				- This index.php script
//			- Me in Amsterdam.jpg			- The 1st image of this album 
//			- Me in the Rijksmuseum.png		- The 2nd image of this album
//
// If you would like to have a specific order for albums or photos start directory & filenames with 001, 002, 003 etc.
// Example directory names: '001 Vacation Holland 2003' and '002 Vacation Holland 2002' etc.
// Example file names: '001 This is Amsterdam.jpg' and '002 This is Schiphol.jpg' etc.
//
// Webserver problems:
//
// If you experience problems with displaying thumbnails, try to set $gd2=true to $gd2=false (see below)
// If it is not possible to create thumbnails, your GD version is not working with PHP, try upgrading to the next version
// If your server does not accept spaces in directory or file names use the underscore '_', it will be replaced by a space
//
// ***********************************************************************************************
// Configuration

// General settings

$gd2=true;						// Set to true if your server has GDLib2+ (for better quality thumbnails)
$title='Galleria del FantaCalcioBazar';					// Page title - leave empty to display directory name
$images_per_page=12;					// Number of photos to display per page
$columns_per_page=4;					// Number of photos next to each other
$thumb_size=180;					// Size in px for thumbnails (min. 30 pixels)
$show_name=false;					// Display file name: true or false (tip: use filename as short description for photo)
$show_details=false;					// Display photo dimensions & filesize: true or false
$show_date=false;					// Display file date: true or false
$show_number=false;					// Display photo number in thumbnail: true or false
$show_binder=true;					// Display binder: true or false
$binder_spacing=8;					// Space between binder-rings in px
$border_width=10;					// Add border around photo - width in px (0=no border)
$show_bordershadow=true;				// Display shadow around border: true or false
$home_page='http://fantacalciobazar.sssr.it';	// Link to another page - leave empty to exclude

// Use Pop-up Window or display photo on page

$popup=false;						// Display photo in popup or on page: true or false
$popup_force_focus=false;				// Set to true to force window on top (only for popup)
$image_resize=true;					// Set to true to resize photo for display: true or false
$image_resizeto=0;					// Size in px for resize (min. 30 pixels) or 0 for auto-resize
$image_inflate=true;					// Allow image to be enlarged: true or false
$image_border=true;					// Display border around photo (only on page): true or false
$copyright='FantaCalcioBazar Evolution';				// Add copyright notice to image (only when $image_resize=true)

// Slideshow

$slideshow=true;					// Enable slideshow (only when $popup=false): true or false
$slideshow_delay=3000;					// Time between slides in milliseconds (1 second = 1000 milliseconds). Minimum 1 second.

// Translations

$language_page='Pagina';					// Text for page number - Change this in your own language
$language_homepage='Home';				// Text for homepage button in menu - change this in your own language
$language_albums='Album';				// Text for amount of albums - change this in your own language
$language_photos='Foto';				// Text for amount of photos - change this in your own language
$language_view='Vedi';					// Text for tooltip - change this in your own language
$language_login='Login';				// Text for login - change this in your own language
$language_logout='Logout';				// Text for logout - change this in your own language
$language_user='Username';				// Text for username - change this in your own language
$language_passw='Password';				// Text for password - change this in your own language
$language_slideshow='inizia slideshow';			// Text for starting slideshow - change this in your own language
$language_stop_slideshow='ferma slideshow';		// Text for stopping slideshow - change this in your own language

// Colors & menu settings

$page_color='#ffffff';					// Page background color
$text_color='#000000';					// Text color
$text_hover_color='#ff0000';				// Text hover color
$title_color='#999999';					// Title color
$border_color='#ffffff';				// Photo background color
$table_color='#ffffff';					// Table backgound color
$item_border_color='#ffffff';				// Border color
$line_color='#000000';					// Color for lines

$menu_line_width='1px';					// Menu border line thickness (top+bottom)
$menu_bar_width='3px';					// Menu bar line thickness (left + right)
$menu_bordertop_color='#000000';			// Menu border top color
$menu_borderbottom_color='#000000';			// Menu border bottom color
$menu_borderleft_color='#000000';			// Menu border left color
$menu_borderright_color='#000000';			// Menu border right color
$menu_bordertop_hover_color='#000000';			// Menu border hover top color
$menu_borderbottom_hover_color='#000000';		// Menu border hover bottom color
$menu_borderleft_hover_color='#000000';			// Menu border hover left color
$menu_borderright_hover_color='#000000';		// Menu border hover right color

$menu_text_color='#000000';				// Menu text color
$menu_texthover_color='#000000';			// Menu text hover color
$menu_background_color='#ffffff';			// Menu background color
$menu_background_hover_color='#cccccc';			// Menu background hover color

// Restrict access - basic authentication
// Add a 'login image' to the restricted directory with a name ending in '_login' to prevent indexing on main page
// Example filename: '000 My login message_login.jpg'

$restrict_access=false;					// Ask for valid login and password: true or false
$users='fred,1234,guest,guest';				// User(s) with access to this album: name,password comma separated

// Shows image with 'Powered by EasyPhpAlbum'

$show_poweredby_easyphpalbum=false;			// Set to true or false

// Create thumbnail files for quicker display - Batch resize your images permanently to better fit the screen
// Change the following options back to false once you have created the thumbnails and/or resized your images!!
// PS: Thumbnails are (re-)created when you open a page of your album. Open all pages then set option to false.

$resizeimages=false;					// Set to true to resize all photos in directory for smaller filesize
$resizeto=640;						// Size in px for resize (min. 30 pixels)
$createcache=true;					// Set to true to create thumbnail photos for quicker display	
//set_time_limit(360);					// Optional: Allow more time for resizing and creation of thumbnails

// End of configuration - Code starts from this line
// ***********************************************************************************************

// Check for valid login - cookie or session
if ($restrict_access) {
	session_start();
	if (isset($_REQUEST['logout'])) {
		session_unset();
		session_destroy();
		setcookie('epa','',time()-3600);
		require_login();
	}
	$valid_users=explode(',',$users);
	foreach ($valid_users as $key => $user)
		$valid_users[$key]=md5($user);
	// Check if cookie data is available and valid
	if (isset($_COOKIE['epa'])) {
		$cookie_data=explode('@',$_COOKIE['epa']);
		if (count($cookie_data)==3) {
			if (in_array($cookie_data[0],$valid_users)) {
				$user_index=array_search($cookie_data[0],$valid_users);
				if ($valid_users[$user_index+1]!=$cookie_data[1])
					require_login();
				else if (md5($_SERVER['HTTP_USER_AGENT'])!=$cookie_data[2])
					require_login();
			} else {
				require_login();
			}
		} else {
			require_login();
		}
	// Check if form data is submitted  and valid
	} else if (isset($_REQUEST['new_user']) && isset($_REQUEST['new_password'])) {
		if (in_array(md5($_REQUEST['new_user']),$valid_users)) {
			$user_index=array_search(md5($_REQUEST['new_user']),$valid_users);
			if ($valid_users[$user_index+1]!=md5($_REQUEST['new_password'])) {
				require_login();
			} else {
				$_SESSION['user']=md5($_REQUEST['new_user']);
				$_SESSION['passw']=md5($_REQUEST['new_password']);
				$_SESSION['agent']=md5($_SERVER['HTTP_USER_AGENT']);
				setcookie('epa',$_SESSION['user'] . '@' . $_SESSION['passw'] . '@' . $_SESSION['agent'],time()+3600);
			}
		} else {
			require_login();
		}
	// Check if current session is valid
	} else if (isset($_SESSION['passw']) && isset($_SESSION['user']) && isset($_SESSION['agent'])) {
		if ($_SESSION['agent']!=md5($_SERVER['HTTP_USER_AGENT']))
			require_login();
		if (in_array($_SESSION['user'],$valid_users)) {
			$user_index=array_search($_SESSION['user'],$valid_users);
			if ($valid_users[$user_index+1]!=$_SESSION['passw'])
				require_login();
		} else {
			require_login();
		}
	// Session data and form data is invalid
	} else {
		require_login();
	}
}

if (isset($_REQUEST['poweredby'])) {
	header("Content-type: image/png");
	imagepng(poweredby_image());
	exit;
}

// Create and output image in specified size
if (isset($_REQUEST['image'])) {
	$image=$_REQUEST['image'];
	$image=str_replace(chr(92),chr(47),getcwd()).'/'.$image;
	if (file_exists($image)) {
		$size=@GetImageSize($image);
		if ($size[2]==1) {
			if (imagetypes() & IMG_GIF) {
	    			$im=@imagecreatefromgif($image);
			} else {
				header("Content-type: image/png");
				imagepng(invalid_image('No GIF support'));
				exit;
			}
		}
		if ($size[2]==2) {
			if (imagetypes() & IMG_JPG) {
	    			$im=@imagecreatefromjpeg($image);
			} else {
				header("Content-type: image/png");
				imagepng(invalid_image('No JPG support'));
				exit;
			}
		}
		if ($size[2]==3)
			$im=@imagecreatefrompng($image);
		if ($size[2]!=1 && $size[2]!=2 && $size[2]!=3) {
			$thumb=invalid_image('Invalid Image');
		} else {
			if ($thumb_size<30)
				$thumb_size=30;
			if (isset($_REQUEST['resize'])) {
				if ($image_resizeto==0 && isset($_REQUEST['screenwidth']))
					$image_resizeto=floor($_REQUEST['screenwidth']/1.6);
				if (!$image_inflate) {
					if ($image_resizeto>$size[0] && $image_resizeto>$size[1])
						$image_resizeto=max($size[0],$size[1]);
				}
				$thumb_size=$image_resizeto;
				$show_number=false;
				$show_binder=false;
				$border_width=0;
				$show_bordershadow=false;
			}
			if ($show_binder)
				$border_offset=3;
			else
				$border_offset=2;
			if ($gd2) {
				if ($size[0]>$size[1])
					$thumb=imagecreatetruecolor($border_width*$border_offset+$thumb_size,$border_width*2+ceil($size[1]/($size[0]/$thumb_size)));
				else
					$thumb=imagecreatetruecolor($border_width*$border_offset+ceil($size[0]/($size[1]/$thumb_size)),$border_width*2+$thumb_size);
			} else {
				if ($size[0]>$size[1])
					$thumb=imagecreate($border_width*$border_offset+$thumb_size,$border_width*2+ceil($size[1]/($size[0]/$thumb_size)));
				else
					$thumb=imagecreate($border_width*$bortider_offset+ceil($size[0]/($size[1]/$thumb_size)),$border_width*2+$thumb_size);
			}
			$black=imagecolorallocate($thumb,0,0,0);
			$white=imagecolorallocate($thumb,255,255,255);
			$gray=imagecolorallocate($thumb,192,192,192);
			$middlegray=imagecolorallocate($thumb,158,158,158);
			$darkgray=imagecolorallocate($thumb,128,128,128);
			imagefill($thumb,0,0,imagecolorallocate($thumb,hexdec(substr($border_color,1,2)),hexdec(substr($border_color,3,2)),hexdec(substr($border_color,5,2))));
			if ($show_binder)
				$bind_offset=4;
			else
				$bind_offset=0;
			if ($show_bordershadow) {
				imagerectangle($thumb,$bind_offset,0,imagesx($thumb)-4,imagesy($thumb)-4,$gray);
				imageline($thumb,$bind_offset+2,imagesy($thumb)-3,imagesx($thumb),imagesy($thumb)-3,$darkgray);
				imageline($thumb,imagesx($thumb)-3,2,imagesx($thumb)-3,imagesy($thumb),$darkgray);
				imageline($thumb,$bind_offset+2,imagesy($thumb)-2,imagesx($thumb),imagesy($thumb)-2,$middlegray);
				imageline($thumb,imagesx($thumb)-2,2,imagesx($thumb)-2,imagesy($thumb),$middlegray);
				imageline($thumb,$bind_offset+2,imagesy($thumb)-1,imagesx($thumb),imagesy($thumb)-1,$gray);
				imageline($thumb,imagesx($thumb)-1,2,imagesx($thumb)-1,imagesy($thumb),$gray);
			}
			if ($gd2)
				imagecopyresampled($thumb,$im,$border_width*($border_offset-1),$border_width,0,0,imagesx($thumb)-($border_offset*$border_width),imagesy($thumb)-2*$border_width,imagesx($im),imagesy($im));
			else
				imagecopyresized($thumb,$im,$border_width*($border_offset-1),$border_width,0,0,imagesx($thumb)-($border_offset*$border_width),imagesy($thumb)-2*$border_width,imagesx($im),imagesy($im));
			if ($show_number && isset($_REQUEST['number']) && isset($_REQUEST['total'])) {
				// Sample some pixels to determine text color
				$colors=array();
				for ($i=5;$i<25;$i++) {
					$indexis=ImageColorAt($thumb,$i,4+ceil($i/5));
					$rgbarray=ImageColorsForIndex($thumb,$indexis);
					array_push($colors,$rgbarray['red'],$rgbarray['green'],$rgbarray['blue']);
				}
				if (array_sum($colors)/count($colors)>180)
					$textcolor=imagecolorallocate($thumb,0,0,0);
				else
					$textcolor=imagecolorallocate($thumb,255,255,255);
				if ($show_binder)
					$number_offset=$border_width*2;
				else
					$number_offset=$border_width;
				if ($border_width==0)
					$number_offset=1;
				imagestring($thumb,1,$number_offset,1,($_REQUEST['number']+1) . '/' . $_REQUEST['total'],$textcolor);
			}
			if ($show_binder) {
				$spacing=floor(imagesy($thumb)/$binder_spacing)-2;
				$offset=floor((imagesy($thumb)-($spacing*$binder_spacing))/2);
				for ($i=$offset;$i<=$offset+$spacing*$binder_spacing;$i+=$binder_spacing) {
					imagefilledrectangle($thumb,8,$i-2,10,$i+2,$black);
					imageline($thumb,11,$i-1,11,$i+1,$darkgray);
					imageline($thumb,8,$i-2,10,$i-2,$darkgray);
					imageline($thumb,8,$i+2,10,$i+2,$darkgray);
					imagefilledrectangle($thumb,0,$i-1,8,$i+1,$gray);
					imageline($thumb,0,$i,8,$i,$white);
					imageline($thumb,0,$i-1,0,$i+1,$gray);
					imagesetpixel($thumb,0,$i,$darkgray);
				}
			}
			if (isset($_REQUEST['resize']) && $copyright!='') {
				$colors=array();
				for ($i=5;$i<ceil(imagesx($thumb)*0.2);$i++) {
					$indexis=ImageColorAt($thumb,$i,imagesy($thumb)-10);
					$rgbarray=ImageColorsForIndex($thumb,$indexis);
					array_push($colors,$rgbarray['red'],$rgbarray['green'],$rgbarray['blue']);
				}
				if (array_sum($colors)/count($colors)>180)
					$textcolor=imagecolorallocate($thumb,0,0,0);
				else
					$textcolor=imagecolorallocate($thumb,255,255,255);
				if ($show_binder)
					$number_offset=$border_width*2;
				else
					$number_offset=$border_width;
				imagestring($thumb,1,$number_offset,imagesy($thumb)-10,' ' . $copyright,$textcolor);
			}
		}
		if (isset($_REQUEST['indexalbum']))
			$main_page=$_REQUEST['indexalbum'];
		else
			$main_page=0;
		if ($size[2]==1) {
			if ($createcache && $main_page>0)
				@imagegif($thumb,substr($image,0,strpos($image,'.')) . '_thumbindex' . '.gif');
			else if ($createcache)
				@imagegif($thumb,substr($image,0,strpos($image,'.')) . '_thumb' . '.gif');
			header("Content-type: image/gif");
			imagegif($thumb);
		} else if ($size[2]==2) {
			if ($createcache && $main_page>0)
				@imagejpeg($thumb,substr($image,0,strpos($image,'.')) . '_thumbindex' . '.jpg',90);
			else if ($createcache)
				@imagejpeg($thumb,substr($image,0,strpos($image,'.')) . '_thumb' . '.jpg',90);
			header("Content-type: image/jpeg");
			imagejpeg($thumb,'',90);
		} else if ($size[2]==3) {
			if ($createcache && $main_page>0)
				@imagepng($thumb,substr($image,0,strpos($image,'.')) . '_thumbindex' . '.png');
			else if ($createcache)
				@imagepng($thumb,substr($image,0,strpos($image,'.')) . '_thumb' . '.png');
			header("Content-type: image/png");
			imagepng($thumb);
		} else {
			header("Content-type: image/png");
			imagepng(invalid_image('Invalid Image'));
		}
	} else {
		header("Content-type: image/png");
		imagepng(invalid_image('File not found'));
	}
	imagedestroy($im);
	imagedestroy($thumb);
	exit;
}

// Resize images permanently
if ($resizeimages) {
	$images=get_images(getcwd());
	if ($images && $resizeto>30) {
		foreach ($images as $image) {
			$size=@GetImageSize($image);
			if ($size[0]>$size[1]) {
				$width=$resizeto;
				$height=ceil($size[1]/($size[0]/$width));
			} else {
				$width=ceil($size[0]/($size[1]/$resizeto));
				$height=$resizeto;
			}
			if ($size[2]==1)
	    			$im=@imagecreatefromgif($image);
			if ($size[2]==2)
	    			$im=@imagecreatefromjpeg($image);
			if ($size[2]==3)
				$im=@imagecreatefrompng($image);
			if ($size[2]==2 || $size[2]==3) {
				if ($gd2) {
					if ($size[0]>$size[1])
						$thumb=imagecreatetruecolor($width,ceil($size[1]/($size[0]/$width)));
					else
						$thumb=imagecreatetruecolor(ceil($size[0]/($size[1]/$height)),$height);
				} else {
					if ($size[0]>$size[1])
						$thumb=imagecreate($width,ceil($size[1]/($size[0]/$width)));
					else
						$thumb=imagecreate(ceil($size[0]/($size[1]/$height)),$height);
				}
				if ($gd2)
					imagecopyresampled($thumb,$im,0,0,0,0,imagesx($thumb),imagesy($thumb),imagesx($im),imagesy($im));
				else
					imagecopyresized($thumb,$im,0,0,0,0,imagesx($thumb),imagesy($thumb),imagesx($im),imagesy($im));
				if ($size[2]==1)
					@imagegif($thumb,str_replace(chr(92),chr(47),getcwd()).'/'.$image) or die('Please enable write access to this directory');
				if ($size[2]==2)
					@imagejpeg($thumb,str_replace(chr(92),chr(47),getcwd()).'/'.$image,90) or die('Please enable write access to this directory');
				if ($size[2]==3)
					@imagepng($thumb,str_replace(chr(92),chr(47),getcwd()).'/'.$image) or die('Please enable write access to this directory');
			}
		}
	imagedestroy($im);
	imagedestroy($thumb);
	}
}

// Detect sub directories - if present; current index.php file is home - otherwise detect directories one level higher
$dir_names=array();
$file_names=array();
$album_show=false;
$total_amount_images=0;
if ($dir=@opendir(getcwd())) {
	while ($file=readdir($dir)) {
		if (($file!='.') && ($file!='..') && is_dir($file) && file_exists($file.'/index.php')) {
			$images=get_images($file);
			if (count($images)!=0) {
				array_push($dir_names,$file);
				array_push($file_names,$file . '/' . $images[0]);
				$album_show=true;
				$total_amount_images=$total_amount_images+count($images);
			}
		}
	}
}
sort($dir_names);
sort($file_names);
$total_amount_albums=count($dir_names);
if (count($dir_names)==0) {
	$dir_names=array();
	if ($dir=@opendir('../')) {
		while ($file=readdir($dir)) {
			if (($file!='.') && ($file!='..') && is_dir('../'.$file) && file_exists('../'.$file.'/index.php') && $file!=substr(getcwd(),-strlen($file))) {
				$images=get_images('../' . $file);
				if (count($images)!=0)
					array_push($dir_names,'../' . $file);
			}
		}
	}
	sort($dir_names);
	$file_names=array();
	$file_names=get_images('./');
	sort($file_names);
}

// Page title
if ($title=='') {
	$title=str_replace(chr(92),chr(47),getcwd());
	$title=str_replace('_',' ',$title);
	$title=substr($title,strrpos($title,chr(47))+1);
	if (ereg("([0-9]{3})",substr($title,0,3)))
		$title=trim(substr($title,3));
}

// Evaluate which thumbnails to show on current page
$max_files=count($file_names);
if (isset($_REQUEST['page']))
 	$page=abs((int) $_REQUEST['page']);
else
	$page=0;
$albumpage=ceil($page/$images_per_page)+1;
$show_files=$page+$images_per_page;
if ($show_files>$max_files)
	$show_files=$max_files;
if ($page==$show_files)
	$page-=$images_per_page;

// Create HTML page
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head><title>$title</title>\n";
echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=ISO-8859-1\" />
<meta http-equiv=\"content-style-type\" content=\"text/css\" />
<meta http-equiv=\"content-script-type\" content=\"text/javascript\" />\n";
// Insert CSS Styles
html_css();

echo "</head><body style=\"margin: 0\">\n";

// Javascript for pop-up window
echo "<form name=\"browser\" method=\"post\" action=\"index.php\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"page\" /><div id=\"content\">\n";
echo "<script type=\"text/javascript\">\n";
echo "var popup=null;\n";
echo "function showpage(page) {\n"; 
echo "document.browser.page.value=page;\n";
echo "if (popup && popup.open) popup.close();\n";
echo "document.browser.submit();\n";
echo "}\n";
echo "function viewer(image,name,width,height) {\n";
if ($popup) {
	// Change image width for auto-adjust
	if ($image_resize && $image_resizeto==0) {
		echo "image_resizeto=screen.width/1.6;\n";
		echo "if (image_resizeto>width && image_resizeto>height)\n";
		echo "	image_resizeto=Math.max(width,height);\n";
		echo "if (width>height) {\n";
			echo "	popup_width=image_resizeto;\n";
			echo "	popup_height=(height/(width/popup_width));\n";
		echo "} else {\n";
			echo "	popup_width=(width/(height/image_resizeto));\n";
			echo "	popup_height=image_resizeto;\n";
		echo "}\n";
		echo "width=popup_width;\n";
		echo "height=popup_height;\n";
	}
	// Center pop-up window on page
	echo "if (popup && popup.open) popup.close();\n";
	echo "var poswx=(screen.width > width ? (screen.width - width)/2 : 0);\n";
	echo "var poswy=(screen.height > height ? (screen.height - height)/3 : 0);\n";
	echo "if (poswx==0 && poswy==0) {\n";
	echo "	popup=window.open(\"\",\"popup\",\"width=\" + (screen.width-10) + \",height=\" + (screen.height-55) + \",status=no,hotkeys=no,menubar=no,toolbar=no,resizable=no,scrollbars=yes,top=\" + poswy + \",left=\" + poswx + \",dependent=yes,alwaysRaised=yes\");\n";
	echo "} else if (poswx==0) {\n";
	echo "	popup=window.open(\"\",\"popup\",\"width=\" + (screen.width-10) + \",height=\" + (height+1) + \",status=no,hotkeys=no,menubar=no,toolbar=no,resizable=no,scrollbars=yes,top=\" + poswy + \",left=\" + poswx + \",dependent=yes,alwaysRaised=yes\");\n";
	echo "} else if (poswy==0) {\n";
	echo "	popup=window.open(\"\",\"popup\",\"width=\" + (width+1) + \",height=\" + (screen.height-55) + \",status=no,hotkeys=no,menubar=no,toolbar=no,resizable=no,scrollbars=yes,top=\" + poswy + \",left=\" + poswx + \",dependent=yes,alwaysRaised=yes\");\n";
	echo "} else {\n";
	echo "	popup=window.open(\"\",\"popup\",\"width=\" + (width+1) + \",height=\" + (height+1) + \",status=no,hotkeys=no,menubar=no,toolbar=no,resizable=no,scrollbars=no,top=\" + poswy + \",left=\" + poswx + \",dependent=yes,alwaysRaised=yes\");\n";
	echo "}\n";
	// Write html to popup window
	if ($popup_force_focus)
		echo "popup.document.write(\"<html><head><title>\" + name + \"</title><meta http-equiv='content-type' content='text/html; charset=ISO-8859-1'><body marginwidth='0' marginheight='0' topmargin='0' leftmargin='0' onBlur='window.focus()'>\");\n";
	else
		echo "popup.document.write(\"<html><head><title>\" + name + \"</title><meta http-equiv='content-type' content='text/html; charset=ISO-8859-1'><body marginwidth='0' marginheight='0' topmargin='0' leftmargin='0'>\");\n";
	if ($image_resize) {
		echo "popup.document.write(\"<img src='index.php?resize=1&image=\" + image + \"&screenwidth=\" + screen.width + \"' border='0'>\");\n";
	} else {
		echo "popup.document.write(\"<img src='\" + image + \"' width='\" + width + \"' height='\" + height + \"' border='0'>\");\n";
	}
	echo "popup.document.write(\"</body></html>\");\n";
	echo "popup.document.close();\n";
	echo "popup.focus();\n";
} else {
	// Display photo on page
	if ($slideshow && isset($_REQUEST['slideshow']))
		echo "location.href='index.php?slideshow=1&showimage=' + escape(image) + '&screenwidth=' + screen.width;\n";
	else
		echo "location.href='index.php?showimage=' + escape(image) + '&screenwidth=' + screen.width;\n";
}
	echo "}\n";
if (isset($_REQUEST['slideshow'])) {
	if (isset($_REQUEST['showimage'])) {
		if (in_array($_REQUEST['showimage'],$file_names)) {
			$forward=array_search($_REQUEST['showimage'],$file_names)+1;
			$count=count($file_names);
			if ($forward==$count)
				$next_slide=$file_names[0];
			else
				$next_slide=$file_names[$forward];
			echo "function starttimer() {\n";
				echo "	id=window.setTimeout(\"viewer('$next_slide','',0,0)\",$slideshow_delay);\n";
			echo "}\n";
		} 
	}
}
echo "</script>\n";
echo "<h1>$title</h1><div class=\"line\">&nbsp;</div><div id=\"leftmargin\">";
echo "<center><table class=\"tablesmaller\">\n";

if (isset($_REQUEST['showimage']) && isset($_REQUEST['screenwidth'])) {
	// Display single photo on page
	$showimage=$_REQUEST['showimage'];
	$showimageurl=rawurlencode($showimage);
	$screenwidth=$_REQUEST['screenwidth'];
	$file_size=floor(filesize($showimage)/1024);
	$file_date=date('Y-m-d H:i',filemtime($showimage));
	$file_name=substr($showimage,0,strpos($showimage,'.'));
	if (ereg("([0-9]{3})",substr($file_name,0,3)))
		$file_name=trim(substr($file_name,3));
	if (strpos($file_name,'/')!=false) 
		$file_name=substr($file_name,0,strpos($file_name,'/'));
	$border='';
	if ($image_border)
		$border="border=\"1\"";
	$onload='';
	if ($slideshow && isset($_REQUEST['slideshow']))
		$onload="onload=\"javascript: starttimer()\"";
	if ($image_resize)
		echo "<tr><td colspan=\"$columns_per_page\" nowrap=\"nowrap\" align=\"center\"><img src='index.php?resize=1&amp;image=$showimageurl&amp;screenwidth=$screenwidth' alt=\"\" $border $onload /></td></tr>\n";
	else
		echo "<tr><td colspan=\"$columns_per_page\" nowrap=\"nowrap\" align=\"center\"><img src=\"$showimage\" alt=\"\" $border $onload /></td></tr>\n";
	$content='';
	if ($show_name==true)
		$content.=str_replace('_',' ',$file_name) . '<br/>';
	if ($show_details==true) {
		$size=@GetImageSize('./' . $showimage);
		$content.=$size[1] . "x" . $size[0] . " / $file_size Kb<br/>";
	}
	if ($show_date==true)
		$content.="$file_date";
	echo "<tr><td colspan=\"$columns_per_page\" class=\"tablecell\">$content</td></tr>\n";
} else {
	// Display thumbnail images
	$colcount=0;
	for ($count=$page;$count<$show_files;$count++) {
		$file_size=floor(filesize($file_names[$count])/1024);
		$file_date=date('Y-m-d H:i',filemtime($file_names[$count]));
		$file_name=substr($file_names[$count],0,strpos($file_names[$count],'.'));
		if (ereg("([0-9]{3})",substr($file_name,0,3)))
			$file_name=trim(substr($file_name,3));
		if (strpos($file_name,'/')!=false) {
			$link=substr($file_names[$count],0,strpos($file_names[$count],'/'));
			$file_name=substr($file_name,0,strpos($file_name,'/'));
		}
		$size=@GetImageSize('./' . $file_names[$count]);
		$image_filename=rawurlencode($file_names[$count]);
		$extension='.' . ltrim(strtolower(substr($file,-4)),'.');
		if ($size[2]==1)
			$extension='.gif';
		if ($size[2]==2)
			$extension='.jpg';
		if ($size[2]==3)
			$extension='.png';
		if ($total_amount_albums>0)
			$thumb_filename=substr($file_names[$count],0,strpos($file_names[$count],'.')) . '_thumbindex' . $extension;
		else
			$thumb_filename=substr($file_names[$count],0,strpos($file_names[$count],'.')) . '_thumb' . $extension;
		$alt=str_replace('_',' ',$file_name);
		if ($image_resize && $size[0]) {
			if ($image_resizeto==0)
				$image_resizeto=$size[0];
			if ($size[0]>$size[1]) {
				$popup_width=$image_resizeto;
				$popup_height=ceil($size[1]/($size[0]/$popup_width));
			} else {
				$popup_width=ceil($size[0]/($size[1]/$image_resizeto));
				$popup_height=$image_resizeto;
			}
		} else if ($size[0]) {
			$popup_width=$size[0];
			$popup_height=$size[1];
		}
		if (!$image_inflate) {
			if ($popup_width>$size[0] || $popup_height>$size[1]) {
				$popup_width=$size[0];
				$popup_height=$size[1];
			}
		}
		if (file_exists($thumb_filename) && !$createcache) {
			if (strpos($file_names[$count],'/')===false && $size[0])
				$content="<a href=\"#link\"><img src=\"$thumb_filename\" onclick=\"viewer('$file_names[$count]','$file_name',$popup_width,$popup_height)\" alt=\"$language_view\" border=\"0\" /></a><br/>";
			else if ($size[0])
				$content="<a href=\"$link/index.php\"><img src=\"$thumb_filename\" alt=\"$language_view $alt\" border=\"0\" /></a><br/>";
			else
				$content="<img src=\"$thumb_filename\" alt=\"\" /><br/>";
		} else {
			if (strpos($file_names[$count],'/')===false && $size[0])
				$content="<a href=\"#link\"><img src=\"index.php?image=$image_filename&amp;number=$count&amp;total=$max_files&amp;indexalbum=$total_amount_albums\" onclick=\"viewer('$file_names[$count]','$file_name',$popup_width,$popup_height)\" alt=\"$language_view\" border=\"0\" /></a><br/>";
			else if ($size[0])
				$content="<a href=\"$link/index.php\"><img src=\"index.php?image=$image_filename&amp;number=$count&amp;total=$max_files&amp;indexalbum=$total_amount_albums\" alt=\"$language_view $alt\" border=\"0\" /></a><br/>";
			else
				$content="<img src=\"index.php?image=$image_filename&amp;number=$count&amp;total=$max_files&amp;indexalbum=$total_amount_albums\" alt=\"\" border=\"0\" /><br/>";
		}
		if ($show_name==true)
			$content.=str_replace('_',' ',$file_name) . '<br/>';
		if ($show_details==true)
			$content.=$size[0] . "x" . $size[1] . " / $file_size Kb<br/>";
		if ($show_date==true)
			$content.="$file_date";
		if ($columns_per_page==1) {
			echo "<tr><td class=\"tablecell\">$content</td></tr>\n";
		} else {
			$colcount+=1;
			if ($colcount==1) {
				echo "<tr><td class=\"tablecell\">$content</td>\n";
			} else if ($colcount<$columns_per_page) {
				echo "<td class=\"tablecell\">$content</td>\n";
			} else {
				echo "<td class=\"tablecell\">$content</td></tr>\n";
				$colcount=0;
			}
		}
		if ($colcount<$columns_per_page && $colcount!=0 && $count==$show_files-1) {
			for ($emptycol=$colcount;$emptycol<$columns_per_page;$emptycol++)
				echo "<td>&nbsp;</td>";
			echo "</tr>\n";
		}
	} // End for
}

echo "<tr><td colspan=\"$columns_per_page\" nowrap=\"nowrap\">&nbsp;</td></tr>\n";

// Page numbers and back & forward browsing
if ($max_files>$images_per_page || isset($_REQUEST['showimage'])) {
	if ($albumpage==1)
		echo "<tr><td nowrap=\"nowrap\" colspan=\"$columns_per_page\">$language_page <a href=\"#link\" onclick=\"showpage(0)\"><u>1</u></a>";
	else
		echo "<tr><td nowrap=\"nowrap\" colspan=\"$columns_per_page\">$language_page <a href=\"#link\" onclick=\"showpage(0)\">1</a>";
	for ($i=$images_per_page;$i<count($file_names);$i+=$images_per_page) {
		$p=ceil($i/$images_per_page)+1;
		if ($albumpage==$p)
			echo " | <a href=\"#link\" onclick=\"showpage($i)\"><u>$p</u></a>";
		else
			echo " | <a href=\"#link\" onclick=\"showpage($i)\">$p</a>";
	}
	// Back & forward browsing (only when slideshow is not active)
	if (!isset($_REQUEST['slideshow'])) {
		if (isset($_REQUEST['showimage'])) {
			if (in_array($_REQUEST['showimage'],$file_names)) {
				$back=array_search($_REQUEST['showimage'],$file_names)-1;
				$forward=$back+2;
				$count=count($file_names);
				if ($back>=0 && $forward<$count)
					echo " | <a href=\"javascript:viewer('$file_names[$back]','',0,0)\"><-</a> <a href=\"javascript:viewer('$file_names[$forward]','',0,0)\">-></a>";
				if ($forward>=$count)
					echo " | <a href=\"javascript:viewer('$file_names[$back]','',0,0)\"><-</a>";
				if ($back<0)
					echo " | <a href=\"javascript:viewer('$file_names[$forward]','',0,0)\">-></a>";
			} 
		}
	}
	if ($slideshow && isset($_REQUEST['showimage']) && isset($_REQUEST['screenwidth'])) {
		$showimage=rawurlencode($_REQUEST['showimage']);
		$screenwidth=$_REQUEST['screenwidth'];
		if (isset($_REQUEST['slideshow']))
			echo " | <a href=\"index.php?showimage=$showimage&amp;screenwidth=$screenwidth\">$language_stop_slideshow</a>";
		else
			echo " | <a href=\"index.php?slideshow=1&amp;showimage=$showimage&amp;screenwidth=$screenwidth\">$language_slideshow</a>";
	}
	echo "</td></tr>\n";
}

echo "</table></center></div><div class=\"line\">&nbsp;</div>\n";

// Bottom menu
echo "<div id=\"bottommenu\"><ul>";
if ($home_page!='')
	echo "<li><a href=\"$home_page\">$language_homepage</a></li>";
if ($total_amount_albums!=0)
	echo "<div id=\"bottomstats\">$language_albums: $total_amount_albums | $language_photos: $total_amount_images</div>";
if (!$album_show) {
	for ($count=0;$count<count($dir_names);$count++) {
		$dir_name=$dir_names[$count];
		if (strpos($dir_names[$count],'/')!=false)
			$dir_name=substr($dir_names[$count],3);
		if (ereg("([0-9]{3})",substr($dir_name,0,3)))
			$dir_name=trim(substr($dir_name,3));
		$dir_name=str_replace('_',' ',$dir_name);
		echo "<li><a href=\"$dir_names[$count]/index.php?\">$dir_name</a></li>\n";
	}
	if ($restrict_access)
		echo "<li><a href=\"index.php?logout=1\">$language_logout</a></li>\n";
}
echo "</ul></div>\n";

if ($show_poweredby_easyphpalbum)
	echo "<p align=\"right\"><a href=\"http://easyphpalbum.sourceforge.net\"><img src=\"index.php?poweredby=1\" border=\"0\" vspace=\"5\" hspace=\"10\" alt=\"\" /></a>\n";

echo "</div></form></body></html>\n";

// Functions

// Create error image
function invalid_image($message) {
	$im=imagecreate(80,75);
	$black=imagecolorallocate($im,0,0,0);
	$yellow=imagecolorallocate($im,255,255,0);
	imagefilledrectangle($im,0,0,80,75,imagecolorallocate($im,255,0,0));
	imagerectangle($im,0,0,79,74,$black);
	imageline($im,0,20,80,20,$black);
	imagefilledrectangle($im,1,1,78,19,$yellow);
	imagefilledrectangle($im,27,35,52,60,$yellow);
	imagerectangle($im,26,34,53,61,$black);
	imageline($im,27,35,52,60,$black);
	imageline($im,52,35,27,60,$black);
	imagestring($im,1,5,5,$message,$black);
	return $im;
}

function poweredby_image() {
	$im=imagecreate(64,20);
	$black=imagecolorallocate($im,0,0,0);
	imagefilledrectangle($im,0,0,64,20,$black);
	imagefilledrectangle($im,1,1,62,18,imagecolorallocate($im,160,160,255));
	imagestring($im,1,2,2,' Powered by',$black);
	imagestring($im,1,2,10,'EasyPhpAlbum',$black);
	return $im;
}

// Read all GIF,JPG,PNG files in directory
function get_images($location) {
	global $restrict_access;
	$file_names=array();
	if ($dir=@opendir("$location/")) {
		while ($file=readdir($dir)) {
			if (($file!='.') && ($file!='..') && !is_dir($file)) {
				$extension=ltrim(strtolower(substr($file,-4)),'.');
				if ($extension=='jpg' || $extension=='jpeg' || $extension=='png' || $extension=='gif') {
					if (!strpos($file,'_thumb')) {
						if ($restrict_access) {
							if (!strpos($file,'_login'))
								array_push($file_names,$file);
						} else {
							array_push($file_names,$file);
						}
					}
				}
			} 
		}
	}
	sort($file_names);
	return($file_names);
}

// Login form
function require_login() {
	global $home_page,$language_homepage,$language_login,$language_user,$language_passw;
	echo "<html><head><title>$language_login</title>\n";
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=ISO-8859-1\"><meta http-equiv=\"content-style-type\" content=\"text/css\"><meta http-equiv=\"content-script-type\" content=\"text/javascript\">\n";
	echo "</head><body marginwidth=\"0\" marginheight=\"0\" topmargin=\"0\" leftmargin=\"0\">\n";
	html_css();
	echo "<div id=\"content\"><form name=\"browser\" method=\"post\" action=\"index.php\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"page\" />\n";
	echo "<h1>$language_login</h1><div class=\"line\">&nbsp;</div><div id=\"leftmargin\"><center>";
	echo "<table class=\"tablesmaller\">\n";
	echo "<tr><td colspan=\"2\" nowrap=\"nowrap\">&nbsp;</td></tr>\n";
	echo "<tr><td nowrap=\"nowrap\">$language_user:</td><td nowrap=\"nowrap\"><input type=\"text\" name=\"new_user\" class=\"input\" /></td></tr>\n";
	echo "<tr><td nowrap=\"nowrap\">$language_passw:</td><td nowrap=\"nowrap\"><input type=\"password\" name=\"new_password\" class=\"input\" /></td></tr>\n";
	echo "<tr><td colspan=\"2\" nowrap=\"nowrap\">&nbsp;</td></tr>\n";
	echo "<tr><td colspan=\"2\" nowrap=\"nowrap\"><input type=\"submit\" name=\"Submit\" value=\"Submit\" class=\"button\" /></td></tr>\n";
	echo "<tr><td colspan=\"2\" nowrap=\"nowrap\">&nbsp;</td></tr>\n";
	echo "</table></center></div><div class=\"line\">&nbsp;</div>";
	if ($home_page!='')
		echo "<div id=\"bottommenu\"><ul><li><a href=\"$home_page\">$language_homepage</a></li></ul></div>";
	echo "</div></form></body></html>\n";
	exit;
}

// CSS code
function html_css() {
	global $page_color, $text_color,$text_hover_color,$title_color,$border_color,$table_color,$item_border_color,$line_color;
	global $menu_line_width,$menu_bar_width,$menu_bordertop_color,$menu_borderbottom_color,$menu_borderleft_color,$menu_borderright_color,$menu_bordertop_hover_color,$menu_borderbottom_hover_color,$menu_borderleft_hover_color,$menu_borderright_hover_color;
	global $menu_text_color,$menu_texthover_color,$menu_background_color,$menu_background_hover_color,$image_border;
	echo "<style type=\"text/css\">\n";
	echo "body {\n";
	echo "	background-color : $page_color;\n";
	echo "	font-size : 76%;\n";
	echo "}\n";
	echo "h1 {\n";
	echo "	background-color : $page_color;\n";
	echo "	color : $title_color;\n";
	echo "	font-family : Tahoma, Arial, Helvetica, sans-serif;\n";
	echo "	padding : 0px 0px 0px 20px;\n";
	echo "	margin : 0;\n";
	echo "	margin-bottom : 10px;\n";
	echo "	font-size : 190%;\n";
	echo "}\n";
	echo "a:link {\n";
	echo "	font-family : Tahoma, Arial, Helvetica, sans-serif;\n";
	echo "	background-color : transparent;\n";
	echo "	color : $text_color;\n";
	echo "	text-decoration : none;\n";
	echo "}\n";
	echo "a:visited {\n";
	echo "	font-family : Tahoma, Arial, Helvetica, sans-serif;\n";
	echo "	background-color : transparent;\n";
	echo "	color : $text_color;\n";
	echo "	text-decoration : none;\n";
	echo "}\n";
	echo "a:hover {\n";
	echo "	font-family : Tahoma, Arial, Helvetica, sans-serif;\n";
	echo "	background-color : transparent;\n";
	echo "	color : $text_hover_color;\n";
	echo "	text-decoration : underline;\n";
	echo "}\n";
	echo "img {\n";
	echo "	margin-bottom : 5px;\n";
	echo "}\n";
	echo ".tablesmaller {\n";
	echo "	margin : 1%;\n";
	echo "	width : 10%;\n";
	echo "	font-family : Tahoma, Arial, Helvetica, sans-serif;\n";
	echo "	background-color : transparent;\n";
	echo "	color : $text_color;\n";
	echo "	font-size : 1em;\n";
	echo "	padding : 1em;\n";
	echo "}\n";
	echo ".tablecell {\n";
	echo "	border : 0.01em solid $item_border_color;\n";
	echo "	background-color : $table_color;\n";
	echo "	padding : 0.5em;\n";
	echo "	font-family : Tahoma, Arial, Helvetica, sans-serif;\n";
	echo "	font-size : 1em;\n";
	echo "	text-align : center;\n";
	echo "	vertical-align : middle;\n";
	echo "}\n";
	echo ".line {\n";
	echo "	border-top : 0.01em solid $line_color;\n";
	echo "	border-bottom : medium none inherit;\n";
	echo "	margin : 0 0 0 2%;\n";
	echo "}\n";
	echo ".input {\n";
	echo "	border: 1px solid $line_color;\n";
	echo "	background-color: $menu_background_color;\n";
	echo "	font-family: Tahoma, Arial, Helvetica, sans-serif;\n";
	echo "	color: $menu_text_color;\n";
	echo "}\n";
	echo ".button {\n";
	echo "	font-family: Arial, Helvetica, sans-serif;\n";
	echo "	background-color: $menu_background_hover_color;\n";
	echo "	color: $menu_text_color;\n";
	echo "	border:1px solid $line_color;\n";
	echo "	padding: 0.1em 0.35em 0.1em 0.35em;\n";
	echo "}\n";
	echo "#leftmargin {\n";
	echo "	margin-left : 20px;\n";
	echo "	text-align : center;\n";
	echo "}\n";
	echo "#content {\n";
	echo "	position : absolute;\n";
	echo "	left : 10px;\n";
	echo "	top : 20px;\n";
	echo "	width : 85%;\n";
	echo "	height : 100%;\n";
	echo "}\n";
	echo "#bottommenu ul {\n";
	echo "	float : left;\n";
	echo "	padding : 0px 0px 0px 5px;\n";
	echo "	margin : 0;\n";
	echo "	font-family : Tahoma, Arial, Helvetica, sans-serif;\n";
	echo "	font-size : 0.9em;\n";
	echo "	color : $menu_text_color;\n";
	echo "}\n";
	echo "#bottommenu ul li {\n";
	echo "	display : inline;\n";
	echo "}\n";
	echo "#bottommenu ul li a {\n";
	echo "	float : left;\n";
	echo "	white-space : nowrap;\n";
	echo "	border-top : $menu_line_width solid $menu_bordertop_color;\n";
	echo "	border-bottom : $menu_line_width solid $menu_borderbottom_color;\n";
	echo "	border-left : $menu_bar_width solid $menu_borderleft_color;\n";
	echo "	border-right : $menu_bar_width solid $menu_borderright_color;\n";
	echo "	padding : 5px 10px 5px 10px;\n";
	echo "	margin-left : 10px;\n";
	echo "	margin-bottom : 10px;\n";
	echo "	background-color : $menu_background_color;\n";
	echo "	text-decoration : none;\n";
	echo "	color : $menu_text_color;\n";
	echo "}\n";
	echo "#bottommenu ul li a:hover {\n";
	echo "	background-color : $menu_background_hover_color;\n";
	echo "	color : $menu_texthover_color;\n";
	echo "	border-top : $menu_line_width solid $menu_bordertop_hover_color;\n";
	echo "	border-bottom : $menu_line_width solid $menu_borderbottom_hover_color;\n";
	echo "	border-left : $menu_bar_width solid $menu_borderleft_hover_color;\n";
	echo "	border-right : $menu_bar_width solid $menu_borderright_hover_color;\n";
	echo "}\n";
	echo "#bottomstats {\n";
	echo "	float : left;\n";
	echo "	white-space : nowrap;\n";
	echo "	border-top : 1px solid $menu_bordertop_color;\n";
	echo "	border-bottom : 1px solid $menu_borderbottom_color;\n";
	echo "	border-left : 1px solid $menu_borderleft_color;\n";
	echo "	border-right : 1px solid $menu_borderright_color;\n";
	echo "	padding : 5px 10px 5px 10px;\n";
	echo "	margin-left : 10px;\n";
	echo "	margin-bottom : 10px;\n";
	echo "	background-color : $menu_background_color;\n";
	echo "	text-decoration : none;\n";
	echo "	color : $menu_text_color;\n";
	echo "}\n";
	echo "</style>\n";
	return;
}

?>
