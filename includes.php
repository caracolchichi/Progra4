

<?php 
	if(isset($_GET['logout'])){
		
	session_start();
	
	if(isset($_SESSION['username'])){
			$_SESSION['username'] = false;
			$_SESSION['loggedin'] = false; 
			$_SESSION['isAdmin'] = false;
		session_destroy();
		}
		header("Refresh:0; url=index.php");
	}else{
		
		session_start();	
	}



	function connectDB() {
	global $mysqli;
	
	
	//Conectarse al servidor y seleccionar la base de datos
	$DBServer = 'localhost'; 
	$DBUser   = 'root';
	$DBPass   = 'skullcandy';
	$DBName   = 'torneos';
	
	
	
	//$mysqli = mysqli_connect("mysql10.000webhost.com", "a8250648_TorneoW", "base_datos", "a8250648_torneo");
	$mysqli = mysqli_connect($DBServer, $DBUser, $DBPass, $DBName);
		
	//al fallar:
	
	if(mysqli_connect_errno()){
		printf("Connection failed: %s\n ", mysqli_connect_error());
		exit();
		
	}//End if
				
	}//End connectDB
	
	
	function createYears($start_year, $end_year, $id='year_select', $selected=null)
    {

        /*** the current year ***/
        $selected = is_null($selected) ? date('Y') : $selected;

        /*** range of years ***/
        $r = range($start_year, $end_year);

        /*** create the select ***/
        $select = '<select name="'.$id.'" id="'.$id.'">';
        foreach( $r as $year )
        {
            $select .= "<option value=\"$year\"";
            $select .= ($year==$selected) ? ' selected="selected"' : '';
            $select .= ">$year</option>\n";
        }
        $select .= '</select>';
        return $select;
    }
	
	function createMonths($id='month_select', $selected=null)
    {
        /*** array of months ***/
        $months = array(
                1=>'Enero',
                2=>'Febrero',
                3=>'Marzo',
                4=>'Abril',
                5=>'Mayo',
                6=>'Junio',
                7=>'Julio',
                8=>'Agosto',
                9=>'Septiembre',
                10=>'Octubre',
                11=>'Noviembre',
                12=>'Deciembre');

        /*** current month ***/
        $selected = is_null($selected) ? date('m') : $selected;

        $select = '<select name="'.$id.'" id="'.$id.'">'."\n";
        foreach($months as $key=>$mon)
        {
            $select .= "<option value=\"$key\"";
            $select .= ($key==$selected) ? ' selected="selected"' : '';
            $select .= ">$mon</option>\n";
        }
        $select .= '</select>';
        return $select;
    }
	
	function createDays($id='day_select', $selected=null)
    {
        /*** range of days ***/
        $r = range(1, 31);

        /*** current day ***/
        $selected = is_null($selected) ? date('d') : $selected;

        $select = "<select name=\"$id\" id=\"$id\">\n";
        foreach ($r as $day)
        {
            $select .= "<option value=\"$day\"";
            $select .= ($day==$selected) ? ' selected="selected"' : '';
            $select .= ">$day</option>\n";
        }
        $select .= '</select>';
        return $select;
    }
	
			
	  
?>


