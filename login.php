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
    	<h1><a href="index.php">Control de Liga de Fútbol UNITEC
</a></h1>
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
				  if(isset($_SESSION['usuario']) || isset($_SESSION['isAdmin'])) :
				?>
                <li><a href="cp.php">Control Panel </a></li>
                <li><a href="?logout=1">Cerrar SesiÓn </a></li>
                <?php
				endif;
				
				if(!isset($_SESSION['username'])) :
				?>
                <li id="active"><a href="login.php">Iniciar SesiÓn </a></li>
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
    <table>
    <tr>
    	<td style="padding-right:55%">
        <?php
		if(!isset($_SESSION['username'])):
		?>
    	<h1>Iniciar Sesión</h1>
        <form action="login_submit.php" method="post">
        <ul>
        <li><input type="text" name="username_l" placeholder="Usuario" pattern="[a-zA-Z0-9_-]{3,30}" title="A-Z 0-9 solamente!" required="required"/></li>
        <li><input type="password" name="userpass_l" placeholder="Password" pattern="[a-zA-Z0-9_-]{3,30}" title="A-Z 0-9 solamente!" required="required"/></li>
        <li><input type="submit" name="submit_l" value="Ingresar" /></li>
        </ul>
        </form>
        </td>
        
        <td>
        
        <h1>Crear una cuenta</h1>
        <form action="register_submit.php" method="post">
        <ul>
        <li><input type="text" name="username_r" Placeholder="Usuario" pattern="[a-zA-Z0-9_-]{3,30}" title="A-Z 0-9 solamente!" required="required"/></li>
        <li><input type="password" name="userpass_r" placeholder="password (Min. 6 chars.)" pattern="[a-zA-Z0-9_-]{6,30}" required="required"/></li>
        <li>Fecha de nacimiento </br> </br> 
        <table>
        
		<tr><td>Año</td><td>Mes</td><td>Día</td></tr>
		<tr>
		<td><?php echo createYears(1900, 2020, 'birth_year', 2010); ?></td>

		<td><?php echo createMonths('birth_month', 4); ?></td>

		<td><?php echo createDays('birth_day', 20); ?></td> 
        </tr>
        </table>
        
        <li><input type="text" name="name_r" placeholder="Nombre" pattern="[a-zA-Z]{1,30}" title="Ingresar solo letras!" required="required"/></li>
        <li><input type="text" name="apellido_r" placeholder="Apellido" pattern="[a-zA-Z]{1,30}" title="Ingresar solo letras!" required="required"/></li>
        <li><input type="text" name="cuenta_r" placeholder="No. Cuenta (8 digitos)" pattern="[0-9]{8}" title="Ingresar solo 0-9"  required="required"/></li>
        <li><input type="email" name="email_r" placeholder="Correo" title="Ingresar un correo valido!" required="required"/></li>
        <li><input type="text" name="telefono_r" Placeholder="Teléfono" title="Minimo 6 digitos, solo numeros!" pattern="[0-9]{6,}" required="required"/></li>
       
        <li><input type="submit" name="submit_r" value="Crear" /></li>
        </ul>
        </form>
        </td>
        </tr>
        </table>
        <?php
		else:
		
		echo("<h1> La sesion ya ha sido iniciada. </h1></br>");
		
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
