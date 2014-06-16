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
connectDB();
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
                <li><a href="index.php">Home</a></li>
                <li><a href="torneos.php">Torneo</a></li>
                <li><a href="calendario.php">Calendario</a></li>
                <?php
				
				  if(@$_SESSION['isAdmin']==1) :
				?>
                <li  id="active"><a href="dashboard.php">Dashboard</a></li>
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
		if(@$_SESSION['isAdmin']==1) :
		
		$NombreTorneo = strip_tags(stripslashes($_POST['tournament_name']));
		$Formato = strip_tags(stripslashes($_POST['tournament_format']));
		$InitialDate = $_POST['initial_year'] . "-" . $_POST['initial_month'] . "-" . $_POST['initial_day'];
		$InscriptionDate = $_POST['inscription_year'] . "-" . $_POST['inscription_month'] . "-" . $_POST['inscription_day'];
		$ChangesDate = $_POST['changes_year'] . "-" . $_POST['changes_month'] . "-" . $_POST['changes_day'];
		$FinalDate = $_POST['final_year'] . "-" . $_POST['final_month'] . "-" . $_POST['final_day'];
		$Rama = $_POST['tournament_rama'];
		$TournamentInfo = strip_tags(stripslashes($_POST['tournament_info']));
		$NumberPlayers = $_POST['number_players'];
		
		$TournamentCreateQuery = "INSERT INTO torneo (NumeroJugadores, FormatoTorneo, Nombre, FechaLimiteInscripcion, FechaInicio, FechaLimiteCambios, FechaFinal, Rama, InfoTorneo) VALUES(" . $NumberPlayers . ", '" . $Formato . "', '" . $NombreTorneo . "', '" . $InscriptionDate . "', '" . $InitialDate . "', '" . $ChangesDate . "', '" . $FinalDate
		. "', '" . $Rama . "', '" . $TournamentInfo . "');" ;
		
		if($mysqli->query($TournamentCreateQuery)){
			echo("<h1> Se ha creado el torneo " . $NombreTorneo . "! </h1>");	
			header("Refresh:0; url=dashboard.php");
		}else{
			echo("<h1> No se ha podido crear el torneo. </h1> </br>");
		}
		
		
        echo("</br>");
        
        
       
		
		
		
		
		else:
		?>
        <h1>No tiene los permisos suficientes para acceder a esta pagina. </h1> </br>
        
        <?php
		header("Refresh:0; url=index.php");
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
