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
		if(@$_SESSION['isAdmin']==1) :
		?>
        <h1>Crear un nuevo torneo </h1> </br>
        <form action="torneo_create.php" method="post">
        <ul>
        <li><input type="text" name="tournament_name" placeholder="Nombre del torneo" pattern="[a-zA-Z0-9_- ]{1,30}" title="A-Z 0-9 solamente!" required="required"/></li>
        <li><input type="text" name="tournament_format" placeholder="Formato" pattern="[a-zA-Z0-9_- ]{1,30}" title="A-Z 0-9 solamente!" required="required"/></li>
        <li>Numero de jugadores por equipo: <input type="number" min="5" max="25" name="number_players" required="required"/> </li>
        <li>
        <table>
        
		<tr><td>    </td><td>Año</td><td>Mes</td><td>Día</td></tr>
        
		<tr>
        <td> Fecha Inicial </td>
		<td><?php echo createYears(2014, 2040, 'initial_year', 2014); ?></td>

		<td><?php echo createMonths('initial_month', 1); ?></td>

		<td><?php echo createDays('initial_day', 1); ?></td> 
        </tr>
        
        <tr>
        <td> Fecha Limite Inscripcion  </td>
        <td><?php echo createYears(2014, 2040, 'inscription_year', 2014); ?></td>

		<td><?php echo createMonths('inscription_month', 1); ?></td>

		<td><?php echo createDays('inscription_day', 1); ?></td>
        </tr>
        
        <tr>
        <td> Fecha Limite de Cambios  </td>
        <td><?php echo createYears(2014, 2040, 'changes_year', 2014); ?></td>

		<td><?php echo createMonths('changes_month', 1); ?></td>

		<td><?php echo createDays('changes_day', 1); ?></td>
        </tr>
        
        <tr>
        <td> Fecha Final </td>
        <td><?php echo createYears(2014, 2040, 'final_year', 2014); ?></td>

		<td><?php echo createMonths('final_month', 1); ?></td>

		<td><?php echo createDays('final_day', 1); ?></td>
        </tr>
        
        
        </table>
        </li>
        <li><input type="text" name="tournament_rama" placeholder="Rama" /></li>
        <li><input type="text" name="tournament_info" placeholder="Informacion o notas extra" /></li>
        <li><input type="submit" name="submit_crear_torneo" value="Crear" /></li>
        
        </ul>
        </form>
        
        <h1>Torneos Existentes </h1>
        
        
        <?php
		$select_torneos = "SELECT * FROM torneo;";
		if($result = $mysqli->query($select_torneos)) :
			
			while($row = $result->fetch_assoc()):
			echo("<h2> " . $row['Nombre'] . "</h2> </br>");
			?>
            
            
			<form action="torneo_modify.php" method="post">
            <input type="hidden" name="id_torneo" value='<?php echo($row['IdTorneo']); ?>'  />
        <ul>
        <li><input type="text" value='<?php echo($row['Nombre']); ?>' name="tournament_name" placeholder="" pattern="[a-zA-Z0-9_- ]{1,30}" title="A-Z 0-9 solamente!" required="required"/></li>
        <li><input type="text" value='<?php echo($row['FormatoTorneo']); ?>' name="tournament_format" placeholder="Formato" pattern="[a-zA-Z0-9_- ]{1,30}" title="A-Z 0-9 solamente!" required="required"/></li>
        <li>Numero de jugadores por equipo: <input type="number" min="5" max="25" value='<?php echo($row['NumeroJugadores']); ?>' name="number_players" required="required"/> </li>
        <table>
        
		<tr><td>    </td><td>Año</td><td>Mes</td><td>Día</td></tr>
        
		<tr>
        <td> Fecha Inicial </td>
		<td><?php 
		$datetime = new DateTime($row['FechaInicio']);

		$year = $datetime->format('Y');
		$month = $datetime->format('m');
		$day = $datetime->format('d');
		
		echo createYears(2014, 2040, 'initial_year', $year); ?></td>

		<td><?php echo createMonths('initial_month', $month); ?></td>

		<td><?php echo createDays('initial_day', $day); ?></td> 
        </tr>
        
        <tr>
        <td> Fecha Limite Inscripcion  </td>
        <td><?php 
		
		$datetime = new DateTime($row['FechaLimiteInscripcion']);

		$year = $datetime->format('Y');
		$month = $datetime->format('m');
		$day = $datetime->format('d');
		
		echo createYears(2014, 2040, 'inscription_year', $year); ?></td>

		<td><?php echo createMonths('inscription_month', $month); ?></td>

		<td><?php echo createDays('inscription_day', $day); ?></td>
        </tr>
        
        <tr>
        <td> Fecha Limite de Cambios  </td>
        <td><?php  
		
		$datetime = new DateTime($row['FechaLimiteCambios']);

		$year = $datetime->format('Y');
		$month = $datetime->format('m');
		$day = $datetime->format('d');
		
		echo createYears(2014, 2040, 'changes_year', $year); ?></td>

		<td><?php echo createMonths('changes_month', $month); ?></td>

		<td><?php echo createDays('changes_day', $day); ?></td>
        </tr>
        
        <tr>
        <td> Fecha Final </td>
        <td><?php 
		
		$datetime = new DateTime($row['FechaFinal']);

		$year = $datetime->format('Y');
		$month = $datetime->format('m');
		$day = $datetime->format('d');
		
		echo createYears(2014, 2040, 'final_year', $year); ?></td>

		<td><?php echo createMonths('final_month', $month); ?></td>

		<td><?php echo createDays('final_day', $day); ?></td>
        </tr>
        
        
        </table>
        </li>
        <li><input type="text" value='<?php echo($row['Rama']);  ?>' name="tournament_rama" placeholder="Rama" /></li>
        <li><input type="text" value='<?php echo($row['InfoTorneo']);  ?>' name="tournament_info" placeholder="Informacion o notas extra" /></li>
        </ul>
       <input type="submit" name="modify_torneo" value="Modificar" /> <input type="submit" name="delete_torneo" value="Eliminar" />
        
        
        </form>
        ---------------------------------------
        
            
            
            
			
			
			
			<?php
			endwhile;
		
		endif;
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
