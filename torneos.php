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
                <li   id="active"><a href="torneos.php">Torneo</a></li>
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
        $select_torneos = "SELECT * FROM torneo ORDER BY FechaLimiteCambios DESC;";
		if($result = $mysqli->query($select_torneos)) :
			
			while($row = $result->fetch_assoc()):
        	echo("<h1> " . $row['Nombre'] . " </h1>");
			
        ?>
        	<p>
            <b>Formato: </b> <?php echo($row['FormatoTorneo']);  ?> </br>
            <b>Rama: </b> <?php echo($row['Rama']);  ?> </br>
            <b>Fecha inicial: </b><?php echo($row['FechaInicio']); ?> </br>
        	<b>Fecha limite de inscripcion:</b> <?php echo($row['FechaLimiteInscripcion']); ?> </br>
            <b>Fecha limite de cambios de equipos:</b> <?php echo($row['FechaLimiteCambios']); ?> </br>
            <b>Fecha de finalizacion:</b> <?php echo($row['FechaFinal']); ?> </br>
            <b>Notas: </b> </br> <?php echo($row['InfoTorneo']);  ?> </br>
        	</p>
            <?php
				$present_date = new DateTime();
				$present_date = $present_date->format('Y-m-d');
				$limit_date = new DateTime($row['FechaLimiteInscripcion']);
				$limit_date = $limit_date->format('Y-m-d');
				if(isset($_SESSION['username']) && $present_date<$limit_date) :
				$username_query = "SELECT * FROM usuarios WHERE Usuario='" . $_SESSION['username'] . "';";
				$username_fetch = $mysqli->query($username_query);
				$user_row = $username_fetch->fetch_assoc();
			?>
            <form action="torneos_register.php" method="post" />
            <input type="hidden" name="id_torneo" value='<?php echo($row['IdTorneo']); ?>' />
            <input type="hidden" name="id_usuario" value='<?php echo($user_row['IdUsuario']); ?>' />
            <input type="submit" name="register_submit" value="Registrarse" />
            </form>
            
        <?php
			endif;
			endwhile;
		
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
