<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Torneos de Fútbol Unitec</title>
<link href="http://fonts.googleapis.com/css?family=Abel|Arvo" rel="stylesheet" type="text/css" />
<link href="styles.css" rel="stylesheet" type="text/css" />

</head>
<body>
<!-- begin #container -->
<div id="container">
    <p>
      <!-- begin #header -->
    </p>
    <div id="header">
   	  <h1>&nbsp;</h1>
   	  <h1>&nbsp;</h1>
    	<h1><a href="index.php">Torneos de Fútbol UNITEC</a></h1>
        <div id="navcontainer">
            <ul id="navlist">
                <li><a href="index.php">Home</a></li>
                <li><a href="torneos.php">Torneo</a></li>
                <li><a href="calendario.php">Calendario</a></li>
                <?php
				
				  if(@$_SESSION['isAdmin']==1) :
				?>
                <li><a href="dashboard.php">Dashboard</a></li>
                <?php
				  endif;
				  if(isset($_SESSION['usuario']) || isset($_SESSION['isAdmin'])) :
				?>
                <li><a href="cp.php">Control Panel </a></li>
                <li><a href="?logout=1">Cerrar SesiÓn </a></li>
                <?php
				endif;
				
				if(!isset($_SESSION['username'])) :
				?>
                <li id="active"><a href="login.php">Iniciar SesiÓn </a></li>
                <?php
				endif;
				?>
            </ul>
        </div>
        <div class="clearer"></div>
  </div>
    <!-- end #header -->
    <!-- begin #mainContent -->
    <div id="mainContent">
    	<?php
		if(!isset($_SESSION['username'])):
		include "includes.php";
		connectDB();
		$UserUsuario = $_POST['username_r'];
		$NombreUsuario = $_POST['name_r'];
		$ApellidoUsuario = $_POST['apellido_r'];
		$PasswordUsuario = $_POST['userpass_r'];
		$CuentaUsuario = $_POST['cuenta_r'];
		$CorreoUsuario = $_POST['email_r'];
		$TelefonoUsuario = $_POST['telefono_r'];
		$BirthDay = $_POST['birth_day'];
		$BirthMonth = $_POST['birth_month'];
		$BirthYear = $_POST['birth_year'];
		
		$register_query = 
		"INSERT INTO usuarios (Usuario, NombreUsuario, ApellidoUsuario, Password, 
		CuentaUsuario, CorreoUsuario, TelefonoUsuario, FechaNacimiento, EsAdmin) 
		VALUES ('" .$UserUsuario . "', '" . $NombreUsuario . "', '" . $ApellidoUsuario . "', "
		. "md5('" . $PasswordUsuario ."'), '" . $CuentaUsuario . "', '" 
		. $CorreoUsuario . "', '" . $TelefonoUsuario . "', '" . $BirthYear . "-" . $BirthMonth . "-" . $BirthDay . "', 0);";
		
		
		
		if($mysqli->query($register_query)){
			echo("<h1> Se ha creado el usuario " . $UserUsuario . "! </h1>");	
			
		}else{
			echo("<h1> No se ha podido crear el usuario. </h1>
			<p> Puede ser porque el nombre de usuario no esta disponible. </br>
				Vuelva a intentarlo. </p> </br>");
			
		}
		
		else: 
		echo("<h1> La sesion ya ha sido iniciada. </h1>");
		endif;
		
		?>
        
        
        
        
    </div>
    <!-- end #mainContent -->
    <!-- begin #footer -->
    <div id="footer">
        <p>
            Info de contacto o info miscelanea.
        </p>
    </div>
    <!-- end #footer -->
</div>
<!-- end #container -->
</body>
</html>
