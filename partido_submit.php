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
                <li id="active"><a href="dashboard.php">Dashboard</a></li>
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
		if($_SESSION['isAdmin']==1){
			
			if(@$_POST['submit_partido']){
			$fecha_partido = $_POST['match_year'] . "-" . $_POST['match_month'] . "-" . $_POST['match_day'];
			$create_query = "INSERT INTO partidos (IdTorneo, IdEquipoA, IdEquipoB, FechaPartido, Lugar, Jornada) 
			VALUES(" . $_POST['id_torneo']. ", ".$_POST['id_equipo1'] . ", " . $_POST['id_equipo2'] . ", '" . $fecha_partido . "', '"
			. $_POST['lugar_partido'] . "', '" . $_POST['jornada_partido'] . "');";
				if($mysqli->query($create_query)){
					echo("<h1> Se ha guardado el partido. </h1> </br>");
					header("Refresh:0; url=dashboard.php");
				}
			echo("</br>");
			}//end submit
			
			if(@$_POST['borrar_partido']){
				$DeleteQuery = "DELETE FROM partidos WHERE IdPartido=" . $_POST['id_partido'] . "; ";
				if($mysqli->query($DeleteQuery)){
				echo("<h1>Se ha borrado el partido. </h1>");	
				header("Refresh:0; url=dashboard.php");
				}
			}
			
			if(@$_POST['guardar_partido']){
				$fecha_partido = $_POST['match_year'] . "-" . $_POST['match_month'] . "-" . $_POST['match_day'];
				$UpdateQuery = "UPDATE partidos SET IdEquipoA=" . $_POST['id_equipo1']
				. ", IdEquipoB =" . $_POST['id_equipo2'] . ", FechaPartido='" . $fecha_partido . "', Lugar='"
				. $_POST['lugar_partido'] . "', Jornada='" . $_POST['jornada_partido'] . "'"
				 ." WHERE IdPartido=" . $_POST['id_partido'] . "; ";
				if($mysqli->query($UpdateQuery)){
				echo("<h1>Se ha guardado el partido. </h1>");	
				header("Refresh:0; url=dashboard.php");
				}else{
					echo("<h1>Hubo un error al modificar. Asegurese que no sean el mismo equipo.</h1>");	
				}
			}
			
		}else{
		
		echo("<h1>No tiene los permisos suficientes para acceder a esta pagina. </h1> </br>");
        
		//header("Refresh:0; url=index.php");
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
