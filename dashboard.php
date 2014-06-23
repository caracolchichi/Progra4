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
        <li><input type="text" name="tournament_info" placeholder="Informacion o notas extra" size="60" /></li>
        <li><input type="submit" name="submit_crear_torneo" value="Crear" /></li>
        
        </ul>
        </form>
        
        <h1>Torneos Existentes </h1>
        
        
        <?php
		$select_torneos = "SELECT * FROM torneo;";
		if($result = $mysqli->query($select_torneos)) :
			
			while($row = $result->fetch_assoc()):
			
			
			//begin table modify/delete - partidos
			?>
            <table>
            <tr>
            
            <td>
            <?php
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
        
        </td>
        <td>
        <h2>Partidos: </h2>
        <form action="partido_submit.php" method="post">
        <input type="hidden" name="id_torneo" value='<?php echo($row['IdTorneo']); ?>' />
        <ul>
        <li>Equipo A: 
        <select name="id_equipo1" required>
        <option value="">Equipo 1</option>
        <?php
		$team_query = "SELECT equipo.NombreEquipo, equipo.IdEquipo, 
		jugadores.IdTorneo FROM equipo JOIN jugadores on equipo.IdCapitan = jugadores.IdJugador
		 WHERE jugadores.IdTorneo=" . $row['IdTorneo'] .";";
		 $teams_result = $mysqli->query($team_query);
		 
		 while($team_row = $teams_result->fetch_assoc())
			{
    		echo("<option value='{$team_row['IdEquipo']}'>{$team_row['NombreEquipo']}</option> \n");
			} 
			
		?>
        </select>         
        </li>
        <li>
        Equipo B:
        <select name="id_equipo2" required>
        <option value="">Equipo 2</option>
        <?php
        $team_query = "SELECT equipo.NombreEquipo, equipo.IdEquipo, 
		jugadores.IdTorneo FROM equipo JOIN jugadores on equipo.IdCapitan = jugadores.IdJugador
		 WHERE jugadores.IdTorneo=" . $row['IdTorneo'] .";";
		 $teams_result = $mysqli->query($team_query);
		 
		 while($team_row = $teams_result->fetch_assoc())
			{
    		echo("<option value='{$team_row['IdEquipo']}'>{$team_row['NombreEquipo']}</option> \n");
			} 
			
		?>
        </select>
        </li>
        <li>
        	<table>
            <tr>
            <td> Fecha del partido  :</td>
        	<td><?php echo createYears(2014, 2040, 'match_year', 2014); ?></td>

			<td><?php echo createMonths('match_month', 1); ?></td>

			<td><?php echo createDays('match_day', 1); ?></td>
            </tr>
            </table>
        </li>
        <li>
        <input type="text" pattern="[a-zA-Z0-9 ]{1,50}" name="lugar_partido" placeholder="Lugar" required="required" />
        <input type="text" pattern="[a-zA-Z0-9 ]{1,30}" name="jornada_partido" placeholder="Jornada" required="required" />
        </li>
        
        </ul>
        <input type="submit" name="submit_partido" value="Crear Partido" />
        </form>
        
        <h2>Partidos existentes: </h2>
        <?php
        $select_partidos_existentes = "SELECT * FROM partidos WHERE IdTorneo=" . $row['IdTorneo'] . ";";
		$result_partidos_existentes = $mysqli->query($select_partidos_existentes);
		
		while($row_pex = $result_partidos_existentes->fetch_assoc()):
		
		//modify-delete partido
		$query_nombre1 = "SELECT * FROM equipo where IdEquipo=" . $row_pex['IdEquipoA']. ";";
		$res_nom1 = $mysqli->query($query_nombre1);
		$row_nom1 = $res_nom1->fetch_assoc();
		$Nombre1 = $row_nom1['NombreEquipo'];
		$query_nombre2 = "SELECT * FROM equipo where IdEquipo=" . $row_pex['IdEquipoB']. ";";
		$res_nom2 = $mysqli->query($query_nombre2);
		$row_nom2 = $res_nom2->fetch_assoc();
		$Nombre2 = $row_nom2['NombreEquipo'];
		?>
        
        <form action="partido_submit.php" method="post">
        <input type="hidden" name="id_torneo" value='<?php echo($row['IdTorneo']); ?>' />
        <input type="hidden" name="id_partido" value='<?php echo($row_pex['IdPartido']); ?>' />
        <ul>
        <li> <?php echo($Nombre1 . " vs. " . $Nombre2); ?> </li>
        <li>Nuevo Equipo A: 
        <select name="id_equipo1" required>
        <option value="">Equipo 1</option>
        <?php
		$team_query = "SELECT equipo.NombreEquipo, equipo.IdEquipo, 
		jugadores.IdTorneo FROM equipo JOIN jugadores on equipo.IdCapitan = jugadores.IdJugador
		 WHERE jugadores.IdTorneo=" . $row['IdTorneo'] .";";
		 $teams_result = $mysqli->query($team_query);
		 
		 while($team_row = $teams_result->fetch_assoc())
			{
    		echo("<option value='{$team_row['IdEquipo']}'>{$team_row['NombreEquipo']}</option> \n");
			} 
			
		?>
        </select>         
        </li>
        <li>
        Equipo B:
        <select name="id_equipo2" required>
        <option value="">Equipo 2</option>
        <?php
        $team_query = "SELECT equipo.NombreEquipo, equipo.IdEquipo, 
		jugadores.IdTorneo FROM equipo JOIN jugadores on equipo.IdCapitan = jugadores.IdJugador
		 WHERE jugadores.IdTorneo=" . $row['IdTorneo'] .";";
		 $teams_result = $mysqli->query($team_query);
		 
		 while($team_row = $teams_result->fetch_assoc())
			{
    		echo("<option value='{$team_row['IdEquipo']}'>{$team_row['NombreEquipo']}</option> \n");
			} 
			
			$datepartido = new DateTime($row_pex['FechaPartido']);

			$yearpartido = $datepartido->format('Y');
			$monthpartido = $datepartido->format('m');
			$daypartido = $datepartido->format('d');
			
		?>
        </select>
        </li>
        <li>
        	<table>
            <tr>
            <td> Fecha del partido  :</td>
        	<td><?php echo createYears(2014, 2040, 'match_year', $yearpartido); ?></td>

			<td><?php echo createMonths('match_month', $monthpartido); ?></td>

			<td><?php echo createDays('match_day', $daypartido); ?></td>
            </tr>
            </table>
        </li>
        <li>
        <input type="text" value='<?php echo($row_pex['Lugar']); ?>' pattern="[a-zA-Z0-9 ]{1,50}" name="lugar_partido" placeholder="Lugar" required="required" />
        <input type="text" value='<?php echo($row_pex['Jornada']); ?>' pattern="[a-zA-Z0-9 ]{1,30}" name="jornada_partido" placeholder="Jornada" required="required" />
        </li>
        
        </ul>
        <input type="submit" name="guardar_partido" value="Guardar" /> <input type="submit" name="borrar_partido" value="Borrar" />
        </form>
        --------------------------------------
        <?php
		endwhile;
		?>
        
        </td>
        
        </table>
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
