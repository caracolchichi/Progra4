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
                <li   id="active"><a href="calendario.php">Calendario</a></li>
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

		<!-- Creacion del Calendario -->
		<?php
					include 'classes/calendar.php';
					 
					$month = isset($_GET['m']) ? $_GET['m'] : NULL;
					$year  = isset($_GET['y']) ? $_GET['y'] : NULL;
					 
					$calendar = Calendar::factory($month, $year);
					 
					 //utilizar estos eventos como referencia para los nuestros
					 
					 $partidos_query = "SELECT p.IdPartido, 
       					e.NombreEquipo AS EquipoA,
       					e2.NombreEquipo AS EquipoB, 
						p.FechaPartido
  						FROM partidos p INNER JOIN equipo e
    					ON p.IdEquipoA = e.IdEquipo INNER JOIN equipo e2 
    					ON p.IdEquipoB = e2.IdEquipo;";	
					$res =  $mysqli->query($partidos_query);
					
					while($row = $res->fetch_assoc()){
							$IdPartido = $row['IdPartido'];
							$event = $calendar->event()
											->condition('timestamp', strtotime($row['FechaPartido']))
											->title('Partido')
											->output("<a href='detalles.php?idpartido=" . $IdPartido . "'> " . $row['EquipoA'] . " vs. " . $row['EquipoB'] . "</a> </br>");
							$calendar->attach($event);
						
					}
					
					 		 
					 
					 
					
					 
					$calendar->standard('today')
						->standard('prev-next');
						
				?>
		
        <table class="calendar">
			<thead>
				<tr class="navigation">
					<th class="prev-month"><a href="<?php echo htmlspecialchars($calendar->prev_month_url()) ?>"><?php echo $calendar->prev_month() ?></a></th>
					<th colspan="5" class="current-month"><?php echo $calendar->month() ?> <?php echo $calendar->year ?></th>
					<th class="next-month"><a href="<?php echo htmlspecialchars($calendar->next_month_url()) ?>"><?php echo $calendar->next_month() ?></a></th>
				</tr>
				<tr class="weekdays">
					<?php foreach ($calendar->days() as $day): ?>
						<th><?php echo $day ?></th>
					<?php endforeach ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($calendar->weeks() as $week): ?>
					<tr>
						<?php foreach ($week as $day): ?>
							<?php
							list($number, $current, $data) = $day;
							 
							$classes = array();
							$output  = '';
							 
							if (is_array($data))
							{
								$classes = $data['classes'];
								$title   = $data['title'];
								$output  = empty($data['output']) ? '' : '<ul class="output"><li>'.implode('</li><li>', $data['output']).'</li></ul>';
							}
							?>
							<td class="day <?php echo implode(' ', $classes) ?>">
								<span class="date" title="<?php echo implode(' / ', $title) ?>"><?php echo $number ?></span>
								<div class="day-content">
									<?php echo $output ?>
								</div>
							</td>
						<?php endforeach ?>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
        <!-- end creacion del calendario -->
        
        
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
