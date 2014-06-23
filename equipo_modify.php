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
                <li><a href="dashboard.php">Dashboard</a></li>
                <?php
				  endif;
				  if(isset($_SESSION['username']) || isset($_SESSION['isAdmin'])) :
				?>
                <li id="active"><a href="cp.php">Control Panel </a></li>
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
			
			//Begin Capitan
			if(isset($_POST['nombre_capitan'])
				    && isset($_POST['cuenta_capitan'])
					&& isset($_POST['carrera_capitan'])
					&& isset($_POST['celular_capitan'])
					&& isset($_POST['mail_capitan'])){
						echo("In!");
					
					
					
				$select_capitan = "SELECT * FROM jugadores WHERE Cuenta=" . $_POST['cuenta_capitan'] . " and IdTorneo=" . $_POST['id_torneo'] .";";
					$result_capitan = $mysqli->query($select_capitan);
					$row_capitan = $result_capitan->fetch_assoc();
					
					if($result_capitan->num_rows ==0 || ( $result_capitan->num_rows ==1 && $row_capitan['IdEquipo']==$_POST['IdEquipo'])){
						
						$NombreJugador = $_POST['nombre_capitan'];
						$BirthDate = $_POST['year_capitan'] . "-" . 
						$_POST['month_capitan'] . "-" . $_POST['day_capitan'];
						$Cuenta = $_POST['cuenta_capitan'];
						$CarreraJugador = $_POST['carrera_capitan'];
						$Celular = $_POST['celular_capitan'];
						$Mail = $_POST['mail_capitan'];
						
						$update_captain_query = "UPDATE jugadores SET Nombre='" . $NombreJugador 
						. "', FechaNacimiento='" . $BirthDate
						. "', Cuenta='" . $Cuenta
						."', Carrera='" . $CarreraJugador
						."', Telefono='" . $Celular
						."', Correo='" . $Mail
						. "' WHERE IdJugador=" . $_POST['IdCapitan'] . ";" ;	
						$mysqli->query($update_captain_query);
						
						
						
					}//end if res < 1
					else{
						goto exitlabel;	
					}
					
					}//end if is set
			
			
			
			//End Capitan
			
			for ($entry_counter=1; $entry_counter<$row_torneo['NumeroJugadores']; $entry_counter++) :
			
				if(@$_POST['nombre_jugador' . $entry_counter] != NULL
				    && @$_POST['cuenta_jugador' . $entry_counter] != NULL
					&& $_POST['carrera_jugador' . $entry_counter] != NULL
					&& $_POST['celular_jugador' . $entry_counter] != NULL
					&& $_POST['mail_jugador' . $entry_counter] != NULL
					&& !isset($_POST['checkbox_borrar' . $entry_counter])
					&& @$_POST['IdJugador' . $entry_counter]==NULL){
						
					
					
					
					$select_player = "SELECT * FROM jugadores WHERE Cuenta='" 
					. $_POST['cuenta_jugador'. $entry_counter] . "' and IdTorneo=" . $_POST['id_torneo'] .";";
					$result_player = $mysqli->query($select_player);
					
					if($result_player->num_rows ==0){
						echo("No. Cuenta " . $_POST['cuenta_jugador' . $entry_counter] .  " valida </br>");
						$NombreJugador = $_POST['nombre_jugador'. $entry_counter];
						$BirthDate = $_POST['year_jugador' . $entry_counter] . "-" . 
						$_POST['month_jugador' . $entry_counter] . "-" . $_POST['day_jugador' . $entry_counter];
						$Cuenta = $_POST['cuenta_jugador' . $entry_counter];
						$CarreraJugador = $_POST['carrera_jugador' . $entry_counter];
						$Celular = $_POST['celular_jugador' . $entry_counter];
						$Mail = $_POST['mail_jugador' . $entry_counter];
						
						$insert_player_query = "INSERT INTO jugadores (IdEquipo, IdTorneo, Nombre, Correo, Telefono, FechaNacimiento, Cuenta, Carrera) VALUES(" 
						. $_POST['IdEquipo'] . ", "
						. $IdTorneo . ", '" . $NombreJugador . "', '" . $Mail . "', '" . $Celular . "', '" . $BirthDate . "', '"
						. $Cuenta . "', '" . $CarreraJugador . "');";
						$mysqli->query($insert_player_query);
						
					}//end if res ==0
					else{
						echo("El jugador con el numero de cuenta " . $_POST['cuenta_jugador'. $entry_counter] . " ya esta en un equipo. </br>");	
					}
					
					
				}// end isset
				else{
					if(@$_POST['nombre_jugador' . $entry_counter] != NULL
				    && @$_POST['cuenta_jugador' . $entry_counter] != NULL
					&& $_POST['carrera_jugador' . $entry_counter] != NULL
					&& $_POST['celular_jugador' . $entry_counter] != NULL
					&& $_POST['mail_jugador' . $entry_counter] != NULL
					&& !isset($_POST['checkbox_borrar' . $entry_counter])
					&& @$_POST['IdJugador' . $entry_counter]!=NULL){
						
					
					
					
				$select_jugador = "SELECT * FROM jugadores WHERE Cuenta=" . $_POST['cuenta_jugador'. $entry_counter] . " and IdTorneo=" . $_POST['id_torneo'] .";";
					$result_jugador = $mysqli->query($select_jugador);
					$row_jugador = $result_jugador->fetch_assoc();
					
					if($result_jugador->num_rows ==0 || ( $result_jugador->num_rows ==1 && $row_jugador['IdEquipo']==$_POST['IdEquipo'])){
						
						$NombreJugador = $_POST['nombre_jugador' . $entry_counter];
						$BirthDate = $_POST['year_jugador'. $entry_counter] . "-" . 
						$_POST['month_jugador'. $entry_counter] . "-" . $_POST['day_jugador'. $entry_counter];
						$Cuenta = $_POST['cuenta_jugador'. $entry_counter];
						$CarreraJugador = $_POST['carrera_jugador'. $entry_counter];
						$Celular = $_POST['celular_jugador'. $entry_counter];
						$Mail = $_POST['mail_jugador'. $entry_counter];
						
						$update_jugador_query = "UPDATE jugadores SET Nombre='" . $NombreJugador 
						. "', FechaNacimiento='" . $BirthDate
						. "', Cuenta='" . $Cuenta
						."', Carrera='" . $CarreraJugador
						."', Telefono='" . $Celular
						."', Correo='" . $Mail
						. "' WHERE IdJugador=" . $_POST['IdJugador'. $entry_counter] . ";" ;	
						$mysqli->query($update_jugador_query);
						
						
						
					}//if num rows ==0
					
					}//end update
					else{
					if(isset($_POST['checkbox_borrar' . $entry_counter]) && $_POST['IdJugador' . $entry_counter]){
						$delete_jugador = "DELETE FROM jugadores where IdJugador=" . $_POST['IdJugador' . $entry_counter] . ";";
						$mysqli->query($delete_jugador);
						
					}//end borrar
					}//end else
					
				}
				
				
		?>
        
        <?php
				
			endfor;
			
			header("Refresh:0; url=cp.php");
		elseif(isset($_SESSION['username']) && @$_POST['delete_equipo']):
			$delete_equipo = "DELETE FROM equipo where IdEquipo=" . $_POST['IdEquipo'] . ";";
			$mysqli->query($delete_equipo);
			$delete_jugadores = "delete from jugadores where IdEquipo=" . $_POST['IdEquipo'] . ";";
			$mysqli->query($delete_jugadores);
			
			echo("<h1>Se ha borrado el equipo. </h1>");	
			header("Refresh:0; url=cp.php");
		
		echo("</br>");
		else:
		exitlabel:
		echo("<h1>Se ha producido un error en la registracion del equipo. Vuelva a la pagina anterior, verifique que las personas no esten registradas en otros equipos e intentelo de nuevo.</h1>");
		
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
