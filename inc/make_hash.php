<?php // LOL

if (isset($_GET['password'])) {
	$hash = md5($_GET['password']);
	echo "Password: <br>" . $_GET['password'] . "<p>Hash: <br>" . $hash;
} else {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
Password: 
  <input type="text" name="password" >
<input type="submit">
</form>
</body>
</html>
<?php } ?>
