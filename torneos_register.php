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
                <li  id="active"><a href="torneos.php">Torneo</a></li>
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
		if(isset($_SESSION['username']) && @$_POST['register_submit']):
			$IdTorneo = $_POST['id_torneo'];
			$IdUsuario = $_POST['id_usuario'];
		
		?>	
		<form action="torneos_register_save.php" method="post">	
        <input type="hidden" name="id_torneo" value='<?php echo($IdTorneo); ?>' />
            <input type="hidden" name="id_usuario" value='<?php echo($IdUsuario); ?>' />
           
			<table border="1" >
            <tr>
            <td>
            Nombre del equipo:
            </td>
            <td>
            <input type="text" placeholder="Nombre del equipo" required="required" pattern="[a-zA-Z 0-9-_]{1,30}" name="nombre_equipo" />    
            </td>
            </tr>
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
				<td><input placeholder="Nombre Capitan" pattern="[a-zA-Z ]{1,30}" name="nombre_capitan" type="text" size=28 required="required"></td>
				
                
                <td><?php echo createYears(1900, 2014, 'year_capitan', 1995); ?></td>

				<td><?php echo createMonths('month_capitan', 1); ?></td>

				<td><?php echo createDays('day_capitan', 1); ?></td> 
                
                
				<td><input name="cuenta_capitan" pattern="[0-9]{8}" type="text" size=10 required="required"></td>
				<td><input name="carrera_capitan" pattern="[a-zA-Z ]{1,30}" type="text" size=10 required="required"></td>
				<td><input name="celular_capitan" pattern="[0-9]{8,12}" type="text" size=10 required="required"></td>
				<td><input name="mail_capitan" type="email" size=15 required="required"></td>
				</tr>
			
			<?php
			
			$select_torneo ="SELECT * FROM torneo WHERE IdTorneo=" . $IdTorneo . ";";
			$result = $mysqli->query($select_torneo);
			$row = $result->fetch_assoc();
			
			for ($entry_counter=1; $entry_counter<$row['NumeroJugadores']; $entry_counter++) :
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
			<input type="submit" value="Enviar" name="save_equipo" />
			</form>
		
		
		
		
		
		
		<?php
        
		
		
		
        	echo("</br>");
       
		
		
		
		
		else:
		?>
        <h1>No tiene los permisos suficientes para acceder a esta pagina. </h1> </br>
        
        <?php
		header("Refresh:0; url=torneos.php");
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
