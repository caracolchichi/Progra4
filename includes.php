<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
PHP
<?php 
	function connectDB() {
	global $mysqli;
	
	//Conectarse al servidor y seleccionar la base de datos
	$mysqli = mysqli_connect("mysql10.000webhost.com", "a8250648_TorneoW", "base_datos", "a8250648_torneo");
	//al fallar:
	if(mysqli_connect_errno()){
		//printf("Connection failed: %s\n ", mysqli_connect_error());
		//exit();
		echo("Error");
	}//End if
	else{
	  echo("Success!");	
	}
			
	}//End connectDB
	
	connectDB();
?>




</body>
</html>