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
				  if(isset($_SESSION['username']) || isset($_SESSION['isAdmin'])) :
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
		include "includes.php";
		connectDB();
		
		
		$username=$_POST['username_l'];
		$password=$_POST['userpass_l'];

		$clean_username = strip_tags(stripslashes($username));
		$clean_password = strip_tags(stripslashes($password));
		
		$login_query = "SELECT * FROM usuarios WHERE Usuario='" . $clean_username . "' AND password=md5('" . $clean_password . "');";
		
		$query_res = $mysqli->query($login_query);
		$row_cnt = $query_res->num_rows;
		
		
		if($row_cnt==1){
			
			$query_row = mysqli_fetch_assoc($query_res);
			$_SESSION['username'] = $clean_username;
			$_SESSION['loggedin'] = true; 
			$_SESSION['isAdmin'] = $query_row['EsAdmin'];	
			
			echo("<h1>Logged in as " . $_SESSION['username'] . "!</h1> </br>");
			if($_SESSION['isAdmin']==1){		
				echo("Sesion iniciada como administrador. </br>");
			}
			
		}else{
			echo("<h1> No se ha podido ingresar. </h1>
			<p>Favor revisar que su nombre de usuario y contrasena estan correctos</br>
				y vuelva a intentarlo. </p> </br>");
			
		}
		
		
		
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
