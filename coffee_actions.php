<?php
/* 
Copyright: Emir Plicanic
Product: COFFEE CSS 1.0
*/

error_reporting(0);
session_start();
include("./inc/scr_functions.php");
///place code to protect the page from unauthorized access here



$action = $_REQUEST['action'];
$arrid = $_REQUEST['arrid'];
$file = $_REQUEST['file']; 
if($_REQUEST['file'] != ""){
	$_SESSION['file_path'] = trim($file);
}
//sessions
$snames = $_SESSION['style_names'];
$sstyles = $_SESSION['style_styles'];

$previous = $arrid - 1;
switch($action){

	case "browse":
		include("./inc/file_browser.php");
		echo "<div id=\"fileBrowser\">";
		new FileBrowser();
		echo "</div>";
	break;
	
	break;
	case "load":
		//if no style loaded load
		if($_REQUEST['file'] !=""){
			$_SESSION['mystyles'] ="";
			$lines = file($file);
			foreach ($lines as $line_num => $line) {
				if(stristr($line, '@charset') === FALSE) {
				  $_SESSION['mystyles'] .= trim($line);
				}
			}
		}
		$tok = strtok($_SESSION['mystyles'], "{}");
		$sarray = array();
		$spos = 0;
		while ($tok !== false) {
			$sarray[$spos] = $tok;
			$spos++;	
		   $tok = strtok("{}");
		}
		$size = count($sarray);
		//separate css style names from the actual styles
		$snames = array();
		$sstyles = array();
		$npos = 0;
		$sstl = 0;
		for($i = 0; $i<$size; $i++){
			if ($i % 2 == 0) { 
				if(strstr($sarray[$i],"__ut")===FALSE){
					$snames[$npos] = $sarray[$i];
				}
					$npos++;
				
			}else{
				$sstyles[$sstl] = $sarray[$i];
				$sstl++;
			}	
		}
		
		//store names and styles in a session
		$_SESSION['style_names'] = $snames;
		$_SESSION['style_styles'] = $sstyles;
		put_styles_together($_SESSION['style_names'], $_SESSION['style_styles']);
		//create style list
		$nsize = count($snames);
?>		
  <ul>
  	<li style="padding:5px; list-style:none;">
    
	<?php 
	if($_SESSION['file_path'] == ""){
	?>
	<a href="a_stra.php" onclick="javascript:getContent('coffee_actions.php', 'action=browse', 'load_styles', '', '');"><img src="./immagini/edit-style.gif" alt="Load Style" title="Load Style" align="absmiddle" border="0" /></a>  <strong><a href="a_stra.php" onclick="javascript:getContent('coffee_actions.php', 'action=browse', 'load_styles', '', '');">Load Style</a></strong>
    <?php
	}else{
	?>
    <a href="a_stra.php" onclick="javascript:getContent('coffee_actions.php', 'action=browse', 'load_styles', '', '');"><img src="./immagini/edit-style.gif" alt="Load Style" title="Load Style" align="absmiddle" border="0" />
    <strong>
    <?php
	
	$opened_file = $_SESSION['file_path'];
	$paths = explode( "/", $opened_file);
	$nr_of_dirs = count($paths);
	$file_dir = $nr_of_dirs-1;
	echo $paths[$file_dir];
	}
	?>
    </a>
    </strong></li>
  </ul>
    <ul id="styles">
<?php for($n = 0; $n<$nsize; $n++){
			if(trim($snames[$n]!="")){
			echo "<li><a href=\"javascript:getContent('coffee_actions.php','action=load_style&arrid=".$n."', 'load_styles','','');\">".$snames[$n]."</a></li>";
			}
		}  ?>  
    </ul>
    <div id="style_control"><a href="javascript:getContent('coffee_actions.php', 'action=load', 'styles_panel');getContent('coffee_actions.php', 'action=textarea','load_text','','');" style="float:right;"><img src="./immagini/refresh.gif" alt="Refresh" title="Refresh" border="0" /></a>  <a href="javascript:getContent('coffee_actions.php','action=add_new_style', 'load_styles','','');"><img src="./immagini/add-style.gif" alt="Add Style" title="Add Style" border="0" /></a> </div>		
<?php		
	//&file=<?php echo $_SESSION['file_path'];


	break;
	
	case "load_style":

		if($arrid != ""){ 
		$illigal = array("#",".");
		$styl = str_replace($illigal, "", $snames[$arrid]); 
		
		//updated all styles
		put_styles_together($_SESSION['style_names'], $_SESSION['style_styles']);
		
		
		$done = explode(";",$sstyles[$arrid]);
		$size = count($done);
		
		//
		//display table
		echo "<form name=\"sel_styles\" id=\"sel_styles\" method=\"post\" action=\"javascript:update_styles();\">";
		echo "<table cellspacing=\"2\" cellpadding=\"1\" border=\"0\" width=\"100%\" id=\"styles_table\">
		<tbody>";
		echo "<tr><th colspan=\"4\"><a href=\"javascript:getContent('coffee_actions.php', 'action=delete_style&arrid=".$arrid."', 'styles_panel'); getContent('coffee_actions.php','action=load_style&arrid=".$previous."', 'load_styles','','');getContent('coffee_actions.php', 'action=textarea', 'load_text', '', ''); getContent('coffee_actions.php', 'action=load', 'styles_panel');\" ><img src=\"./immagini/remove-style.gif\" alt=\"Delete\" title=\"Delete\" border=\"0\" style=\"margin-top:3px;\" align=\"right\" /></a>	
		Editing: <input type=\"text\" class='style_input' name=\"classname\" size=\"30\" value=\"".$snames[$arrid]."\" />


	</th></tr>";
		//$browse = "";
		for($i = 0; $i<$size; $i++){
		
			$n = explode(":", $done[$i]);
			if($it==0){ 
				echo "<tr>";
			}
				if(trim($n[1]) !="" && strstr($n[0],"/")===FALSE && strstr($n[0],"__ut")===FALSE){
				$good_value = stripslashes(trim($n[1]));
				if($n[0] == "background" || $n[0] == "background-image" || $n[0] == "background-attachment"){
					$browse = "<a href=\"javascript:doWin('./inc/stra_get_image.php', '".$n[0]."');\"><img src=\"./immagini/image.gif\"  align=\"absmiddle\" border=\"0\" /></a>";
				}else{
					$browse = "";				
				} 
				echo "<td align='right'  class=\'style_name\'>".$n[0].": </td><td><input type='text' size='15' class='style_input'  name='".$n[0]."' id='".$n[0]."' value='".rtrim($good_value,";")."' />".$browse."</td>";
				}
		
			$it++;
			if($it == 2){ 
				echo "</tr>"; 
				$it=0;
			}
		}
		echo "</tbody></table>";
		css_groups();
		echo "<div id=\"new_styles\"></div>";
		echo "<input name=\"arrid\" type=\"hidden\" value=\"".$arrid."\" /><input name=\"action\" type=\"hidden\" value=\"add_style\" />";
		echo "</form>";
	}

	
	break;
	
	case "add_style":
		//update styles
		$sstyles[$arrid] = "";		
		foreach ($_REQUEST as $key => $value ) {
		 
		 	//make sure unnecessary submits are stripped
			if($key != "submit" && $key != "action" && $key != "arrid" && $key != "PHPSESSID" && $key != "classname" && $key != "new_name" && $key != "new_style" && trim($value) != "" && strstr($key,"__ut")===FALSE){
				$property = $key;
				$values = $value;
				if($key == "new_name"){
					$property = $value;
				}
				if($key == "new_style"){
					$values = $value;
				}
				$sstyles[$arrid] .= $property.":".$values.";";
			}
		}
		if($_REQUEST['new_name']!=""){
			$sstyles[$arrid] = $sstyles[$arrid]." ".$_REQUEST['new_name'].":".$_REQUEST['new_style'].";";
		}	
		
		//update name
		$snames[$arrid] = trim($_REQUEST['classname']);
		
		$_SESSION['style_names'] = $snames;
		$_SESSION['style_styles'] = $sstyles;
		if($arrid != ""){ 
		$illigal = array("#",".");
		$styl = str_replace($illigal, "", $snames[$arrid]); 
		
		//updated all styles
		put_styles_together($_SESSION['style_names'], $_SESSION['style_styles']);
		
		$done = explode(";",$sstyles[$arrid]);
		$size = count($done);
		

		//display table
		echo "<form name=\"sel_styles\" id=\"sel_styles\" method=\"post\" action=\"javascript:update_styles();\">";
		echo "<table cellspacing=\"2\" cellpadding=\"1\" border=\"0\"  width=\"100%\" id=\"styles_table\">
		<tbody>";
		echo "<tr><th colspan=\"4\"><a href=\"javascript:getContent('coffee_actions.php', 'action=delete_style&arrid=".$arrid."', 'styles_panel'); getContent('coffee_actions.php','action=load_style&arrid=".$previous."', 'load_styles','','');getContent('coffee_actions.php', 'action=textarea', 'load_text', '', '');getContent('coffee_actions.php', 'action=load', 'styles_panel');\" ><img src=\"./immagini/remove-style.gif\" alt=\"Delete\" title=\"Delete\" border=\"0\" style=\"margin-top:3px;\" align=\"right\" /></a>
		Editing: <input type=\"text\" class='style_input' name=\"classname\"  size=\"30\" value=\"".$snames[$arrid]."\" />

	</th></tr>";
		for($i = 0; $i<$size; $i++){
			$n = explode(":", $done[$i]);
			if($it==0){ 
				echo "<tr>";
			}
				if(trim($n[1]) !="" && strstr($n[0],"/")===FALSE && strstr($n[0],"__ut")===FALSE){
				$good_value = stripslashes(trim($n[1])); 
				if($n[0] == "background" || $n[0] == "background-image" || $n[0] == "background-attachment"){
					$browse = "<a href=\"javascript:doWin('./inc/stra_get_image.php', '".$n[0]."');\"><img src=\"./immagini/image.gif\" width=\"22\" height=\"15\" align=\"absmiddle\" border=\"0\" /></a>";
				}else{
					$browse = "";				
				} 
				echo "<td align='right'  class=\'style_name\'>".$n[0].": </td><td><input type='text' size='15' class='style_input'  name='".$n[0]."' id='".$n[0]."' value='".rtrim($good_value,";")."'>".$browse."</td>";
				}
		
			$it++;
			if($it == 2){ 
				echo "</tr>"; 
				$it=0;
			}
		}
		echo "</tbody></table>";
		css_groups();
		echo "<div id=\"new_styles\"></div>";
		echo "<input name=\"arrid\" type=\"hidden\" value=\"".$arrid."\" /><input name=\"action\" type=\"hidden\" value=\"add_style\" />";
		echo "</form>";	//<input name=\"submit\" type=\"submit\" value=\"Apply\" />	
		}
	break;
	
	case "textarea":
		//updated all styles
		if($_REQUEST['css_textarea'] !=""){
			$tok = strtok($_REQUEST['css_textarea'], "{}");
			$sarray = array();
			$spos = 0;
			while ($tok !== false) {
				$sarray[$spos] = $tok;
				$spos++;	
			   $tok = strtok("{}");
			}
			$size = count($sarray);
			//separate css style names from the actual styles
			$snames = array();
			$sstyles = array();
			$npos = 0;
			$sstl = 0;
			for($i = 0; $i<$size; $i++){
				if ($i % 2 == 0) { 
					if(strstr($sarray[$i],"__ut")===FALSE){
						$snames[$npos] = $sarray[$i];
					}
						$npos++;
					
				}else{
					$sstyles[$sstl] = $sarray[$i];
					$sstl++;
				}	
			}
			
			//store names and styles in a session
			$_SESSION['style_names'] = $snames;
			$_SESSION['style_styles'] = $sstyles;
		}
		?>
        <form id="css_ta" name="css_ta" method="post" action="javascript:update_textarea();">
            <textarea name="css_textarea" id="css_textarea" cols="46" rows="14"><?php echo put_styles_together($_SESSION['style_names'], $_SESSION['style_styles']); ?></textarea>
            <br />
            <input name="action" type="hidden" value="textarea" />
<input name="submit" type="submit" value="Update" />

        </form>
        
        <?php
	break;
	
	case "save_style":
	foreach ($_REQUEST as $key => $value ) {
	
	//make sure unnecessary submits are stripped
	if($key != "submit" && $key != "action" && $key != "arrid" && $key != "PHPSESSID" && $key != "classname" && $key != "new_name" && $key != "new_style" && trim($value) != ""  && strstr($key,"__ut")===FALSE){
		$property = $key;
		$values = stripslashes($value);
		if($key == "new_name"){
			$property = $value;
		}
		if($key == "new_style"){
			$values = $value;
		}
		$sstyles[$arrid] .= $property.":".$values.";";
	}
	}
	if($_REQUEST['new_name']!=""){
	$sstyles[$arrid] = $sstyles[$arrid]." ".$_REQUEST['new_name'].":".$_REQUEST['new_style'].";";
	}	
	
	//update name
	$snames[$arrid] = trim($_REQUEST['classname']);
	$_SESSION['style_names'] = $snames;
		
	$_SESSION['style_styles'] = $sstyles;
	$all_styles = put_styles_together($_SESSION['style_names'], $_SESSION['style_styles']);
	
	$tok = strtok($_SESSION['mystyles'], "{}");
	$sarray = array();
	$spos = 0;
	while ($tok !== false) {
		$sarray[$spos] = $tok;
		$spos++;	
	   $tok = strtok("{}");
	}
	$size = count($sarray);
	//separate css style names from the actual styles
	$snames = array();
	$sstyles = array();
	$npos = 0;
	$sstl = 0;
	for($i = 0; $i<$size; $i++){
		if ($i % 2 == 0) { 
			$snames[$npos] = $sarray[$i];
			$npos++;
		}else{
			$sstyles[$sstl] = $sarray[$i];
			$sstl++;
		}	
	}	
	
	$nsize = count($snames);
	$openfile = fopen($_SESSION['file_path'],"w+");	
	for($n = 0; $n<$nsize; $n++){
		if(trim($sstyles[$n]) != "" && trim($snames[$n]) != ""){
			$line = trim($snames[$n])."{\r".trim($sstyles[$n])."\r}";
			fwrite($openfile, $line);
			if($n!=$nsize-1){
				fwrite($openfile, "\r");
			}
		}
	}
	fclose($openfile);
	$opened_file = $_SESSION['file_path'];
	$paths = explode( "/", $opened_file);
	$nr_of_dirs = count($paths);
	$file_dir = $nr_of_dirs-1;
	echo "Saved: ".$paths[$file_dir];
		
	break;
	
	case "add_new_style":
		//add key to names array
		$stack_names = $_SESSION['style_names'];
		$stack_names[]= " ";
		$_SESSION['style_names'] = $stack_names;
		
		//add key to styles array
		$stack_styles = $_SESSION['style_styles'];
		$stack_styles[]= " ";
		$_SESSION['style_styles'] = $stack_styles;		
		
		
		$snames = $_SESSION['style_names'];
		$sstyles = $_SESSION['style_styles'];
		
		$arraycount = count($snames);
		$arrid = $arraycount-1;

		$illigal = array("#",".");
		$styl = str_replace($illigal, "", $snames[$arrid]); 
		
		//updated all styles
		put_styles_together($_SESSION['style_names'], $_SESSION['style_styles']);
		
		$done = explode(";",$sstyles[$arrid]);
		$size = count($done);
			
		echo "<form name=\"sel_styles\" id=\"sel_styles\" method=\"post\" action=\"javascript:update_styles();\">";
		echo "<table cellspacing=\"2\" cellpadding=\"1\" border=\"0\"  width=\"100%\" id=\"styles_table\">
		<tbody>";
		echo "<tr><th colspan=\"4\"> Selector: <input type=\"text\" class='style_input' name=\"classname\" size=\"30\"  />
	</th></tr>";
		for($i = 0; $i<$size; $i++){
			$n = explode(":", $done[$i]);
			if($it==0){ 
				echo "<tr>";
			}
				if(trim($n[1]) !="" && strstr($n[0],"/")===FALSE && strstr($n[0],"__ut")===FALSE){
				$good_value = stripslashes(trim($n[1])); 
				
				if($n[0] == "background" || $n[0] == "background-image" || $n[0] == "background-attachment"){
					$browse = "<a href=\"javascript:doWin('./inc/stra_get_image.php', '".$n[0]."');\"><img src=\"./immagini/image.gif\" width=\"22\" height=\"15\" align=\"absmiddle\" border=\"0\" /></a>";
				}else{
					$browse = "";				
				} 				
				
				echo "<td align='right'  class=\'style_name\'>".$n[0].": </td><td><input type='text' size='15' class='style_input'  name='".$n[0]."' id='".$n[0]."' value='".rtrim($good_value,";")."' /></td>";
				}
		
			$it++;
			if($it == 2){ 
				echo "</tr>"; 
				$it=0;
			}
		}
		echo "</tbody></table>";
		css_groups();
		echo "<div id=\"new_styles\"></div>";
		echo "<input name=\"arrid\" type=\"hidden\" value=\"".$arrid."\" /><input name=\"action\" type=\"hidden\" value=\"add_style\" />";
		echo "</form>";
		
	
	break;
	
	case "delete_style":
	
		unset($snames[$arrid]);
		unset($sstyles[$arrid]);
		$_SESSION['style_names'] = $snames;
		$_SESSION['style_styles'] = $sstyles;
	break;
}


?>