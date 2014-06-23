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
        <h2><a href="dashboard.php"> Torneos </a>    -    <a href="dashboard_equipos.php"> Equipos </a>
        <?php
		if(@$_SESSION['isAdmin']==1):
			
			$equipo_query = "SELECT * FROM equipo join jugadores on equipo.IdCapitan = jugadores.IdJugador;";
			$equipo_result = $mysqli->query($equipo_query);
		while($equipo_row = $equipo_result->fetch_assoc()):
			
			echo("<h1>". $equipo_row['NombreEquipo'] . " en el torneo \"" . $equipo_row['IdTorneo'] ."\"</h1>");
		
		?>
        	<form action="dashboard_equipos_modify.php" method="post">
            <input type="hidden" name="id_torneo" value='<?php echo($equipo_row['IdTorneo']); ?>' />
            <input type="hidden" name="IdEquipo" value='<?php echo($equipo_row['IdEquipo']); ?>' />
        	<table border="1" >
            <tr>
            <td>
            Nombre del equipo:
            </td>
            <td>
            <input type="text" placeholder="Nombre del equipo" value='<?php echo($equipo_row['NombreEquipo']); ?>' required="required" pattern="[a-zA-Z 0-9-_]{1,30}" name="nombre_equipo" />    
            </td>
            </tr>
            
            <?php
			$select_capitan = "select * from jugadores where IdJugador=" . $equipo_row['IdCapitan'] . ";" ;
			$result_capitan = $mysqli->query($select_capitan);
			$row_capitan = $result_capitan->fetch_assoc();
			?>
            
		<tr>
			<th rowspan="2" style="width:6%">Puesto</th>
			<th rowspan="2">NOMBRE COMPLETO</th>
			<th colspan="7">DATOS PERSONALES</th>
			<tr>
				<th colspan=3>Edad</th>
				<th>No. Cuenta</th>
				<th>Carrera</th>
				<th>Celular</th>
				<th>E-mail</th>
			</tr>
		 </tr>
				<tr>
				<td>Capitan</td>
                <input type="hidden" name="IdCapitan" value='<?php echo($equipo_row['IdCapitan']); ?>' />
				<td><input placeholder="Nombre Capitan" value='<?php echo($row_capitan['Nombre']); ?>' pattern="[a-zA-Z ]{1,30}" name="nombre_capitan" type="text" size=28 required="required"></td>
				
                
                <td>
				<?php
				$datetime = new DateTime($row_capitan['FechaNacimiento']);

				$year = $datetime->format('Y');
				$month = $datetime->format('m');
				$day = $datetime->format('d');
				
				
				echo createYears(1900, 2014, 'year_capitan', $year); ?></td>

				<td><?php echo createMonths('month_capitan', $month); ?></td>

				<td><?php echo createDays('day_capitan', $day); ?></td> 
                
                
				<td><input name="cuenta_capitan" value='<?php echo($row_capitan['Cuenta']); ?>' pattern="[0-9]{8}" type="text" size=10 required="required"></td>
				<td><input name="carrera_capitan" value='<?php echo($row_capitan['Carrera']); ?>' pattern="[a-zA-Z ]{1,30}" type="text" size=10 required="required"></td>
				<td><input name="celular_capitan" value='<?php echo($row_capitan['Telefono']); ?>' pattern="[0-9]{8,12}" type="text" size=10 required="required"></td>
				<td><input name="mail_capitan" value='<?php echo($row_capitan['Correo']); ?>' type="email" size=15 required="required"></td>
				</tr>
			
			<?php
			
			$entry_counter = 1;
			
			$query_torneo = "select * from torneo where IdTorneo=" . $equipo_row['IdTorneo'] . ";";
			$result_torneo = $mysqli->query($query_torneo);
			$row_torneo = $result_torneo->fetch_assoc();
			
			$query_jugadores = "select * from jugadores where IdEquipo=" . $equipo_row['IdEquipo'] . " and IdJugador <> ". $row_capitan['IdJugador'] . ";";
			$result_jugadores = $mysqli->query($query_jugadores);
			if($result_jugadores->num_rows >=1):
			while($row_jugadores = $result_jugadores->fetch_assoc()):
			
			?>
            	<tr>
                <input type="hidden" name='IdJugador<?php echo($entry_counter); ?>' value='<?php echo($row_jugadores['IdJugador']); ?>'>
				<td>Jugador #<?php echo($entry_counter); ?></td>
				<td><input pattern="[a-zA-Z ]{1,30}" value='<?php echo($row_jugadores['Nombre']) ?>' name="nombre_jugador<?php echo($entry_counter); ?>" type="text" pattern="[a-zA-Z ]{1,30}" SIZE=28></td>
				
                <td><?php 
				$datetime = new DateTime($row_jugadores['FechaNacimiento']);

				$year = $datetime->format('Y');
				$month = $datetime->format('m');
				$day = $datetime->format('d');
				
				
				echo createYears(1900, 2014, 'year_jugador' . $entry_counter, $year); ?></td>

				<td><?php echo createMonths('month_jugador' . $entry_counter, $month); ?></td>

				<td><?php echo createDays('day_jugador' . $entry_counter, $day); ?></td> 
				<td><input value='<?php echo($row_jugadores['Cuenta']); ?>' name="cuenta_jugador<?php echo($entry_counter); ?>" type="text" pattern="[0-9]{8}" SIZE=10></td>
				<td><input value='<?php echo($row_jugadores['Carrera']); ?>' name="carrera_jugador<?php echo($entry_counter); ?>" type="text" pattern="[a-zA-Z ]{1,30}" SIZE=10></td>
				<td><input value='<?php echo($row_jugadores['Telefono']); ?>' name="celular_jugador<?php echo($entry_counter); ?>" type="text" pattern="[0-9]{8,12}" SIZE=10></td>
				<td><input value='<?php echo($row_jugadores['Correo']); ?>' name="mail_jugador<?php echo($entry_counter); ?>" type="email" SIZE=15></td>
                <td>Borrar <input type="checkbox" name="checkbox_borrar<?php echo($entry_counter) ?>" /> </td>
				</tr>
            
            
            <?php
			$entry_counter++;
			endwhile;
			endif;
			
			for ($entry_counter= $entry_counter; $entry_counter<$row_torneo['NumeroJugadores']; $entry_counter++) :
			?>
				<tr>
				<td>Jugador #<?php echo($entry_counter) ?></td>
				<td><input pattern="[a-zA-Z ]{1,30}" name="nombre_jugador<?php echo($entry_counter) ?>" type="text" pattern="[a-zA-Z ]{1,30}" SIZE=28></td>
				
                <td><?php echo createYears(1900, 2014, 'year_jugador' . $entry_counter, 1995); ?></td>

				<td><?php echo createMonths('month_jugador' . $entry_counter, 1); ?></td>

				<td><?php echo createDays('day_jugador' . $entry_counter, 1); ?></td> 
				<td><input name="cuenta_jugador<?php echo($entry_counter) ?>" type="text" pattern="[0-9]{8}" SIZE=10></td>
				<td><input name="carrera_jugador<?php echo($entry_counter) ?>" type="text" pattern="[a-zA-Z ]{1,30}" SIZE=10></td>
				<td><input name="celular_jugador<?php echo($entry_counter) ?>" type="text" pattern="[0-9]{8,12}" SIZE=10></td>
				<td><input name="mail_jugador<?php echo($entry_counter) ?>" type="email" SIZE=15></td>
				</tr>
			<?php
			endfor;
		?>
        
</table>
        
        <input type="submit" name="save_equipo" value="Guardar" /> <input type="submit" name="delete_equipo" value="Borrar" />
        </form>
        <?php
		
		
		endwhile;
			
		else:
		echo("<h1>No tiene los suficientes privilegios para acceder a esta pagina. </h1>");
		
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
