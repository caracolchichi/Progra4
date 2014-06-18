<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Torneos de Fútbol Unitec</title>
<link href="http://fonts.googleapis.com/css?family=Abel|Arvo" rel="stylesheet" type="text/css" />
<link href="styles.css" rel="stylesheet" type="text/css" />

</head>
<body>
<?php
include 'includes.php';
?>

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
                <li  id="active"><a href="index.php">Home</a></li>
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
                <li><a href="login.php">Iniciar SesiÓn </a></li>
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
    	<!-- Main Content aqui -->
        <?php
		if(isset($_SESSION['username']) && @$_POST['save_equipo']):
		$select_torneo = "SELECT * FROM torneo WHERE IdTorneo=" . $_POST['id_torneo'] .";";
			$IdTorneo = $_POST['id_torneo'];
		
			$result = $mysqli->query($select_torneo);
			$row_torneo = $result->fetch_assoc();
			
			for ($entry_counter=1; $entry_counter<$row_torneo['NumeroJugadores']; $entry_counter++) :
			
				if(isset($_POST['is_registered' . $entry_counter])){
					
					
					
				$select_player = "SELECT * FROM jugadores WHERE Cuenta='" . $_POST['cuenta_jugador'. $entry_counter] . "' and IdTorneo=" . $_POST['id_torneo'] .";";
					$result_player = $mysqli->query($select_player);
					if($result_player->num_rows < 1){
						
					}
				}
		?>
        
        <?php
			endfor;
		else:
		echo("<h1>Se ha producido un error en la creacion del torneo. Vuelva a la pagina anterior e intente de nuevo.</h1>");
		
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
