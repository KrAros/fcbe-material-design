<?php
session_start();

//functions

function put_styles_together($names, $styles){
	$ssize = count($styles);
		
	for($i = 0; $i<$ssize; $i++){
		$clean = str_replace(";\r\n", ";", $styles[$i]);
		$clean = str_replace(";;", ";", trim($clean));
		$s = str_replace(";", ";\r\n", stripslashes($clean)); 
		if(trim($names[$i]) !="" && strstr($names[$i],"__ut")===FALSE){
			$complete_style = trim($complete_style)."\r\n".trim($names[$i])."{\r".trim($s)."\r}\r\n";
		}
	}
	$_SESSION['mystyles'] = $complete_style;
	return stripslashes($complete_style);
}

function css_groups(){
?>
<ul id="css_groups">
  <li><a href="javascript:type_styles();">Type</a></li>
  <li><a href="javascript:box_styles();">Box</a></li>
  <li><a href="javascript:background_styles();">Background</a></li>
  <li><a href="javascript:border_styles();">Border</a></li>
  <li><a href="javascript:block_styles();">Block</a></li>
  <li><a href="javascript:list_styles();">List</a></li>
  <li><a href="javascript:position_styles();">Position</a></li>
</ul>
<?php
}

?>