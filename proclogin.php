<?php
	session_start();
	include("nustatymai.php");
	// values passed via login page
	$dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Unable to connect to db");
    
	$vartotojo_vardas = strtolower($_POST['vartotojo_vardas']);
    $slaptazodis = $_POST['slaptazodis'];
    $tipas = $_POST['tipas'];
	
	// prevent mysql injection
	//$slaptazodis = md5($slaptazodis);
    
    if($tipas=="uzsakovas")
    {
        if($vartotojo_vardas!="admin")
        {
            $slaptazodis = md5($slaptazodis);
        }
        $sql ="SELECT * from uzsakovas WHERE vartotojo_vardas = '$vartotojo_vardas' and slaptazodis = '$slaptazodis'";
        $result=mysqli_query($dbc,$sql);
        if (!$result) {
            $_SESSION['loginerror']="Could not successfully run query from DB: " . mysql_error();
            header('location: login.php');
            exit;
        }
        if (mysqli_num_rows($result) == 0) {
            $_SESSION['loginerror']= "Tokio užsakovo nėra";
            header('location: login.php');
            exit;
        }
        else
        {
            $row = mysqli_fetch_array($result); 
            mysqli_free_result($result);
            if($row['vartotojo_vardas'] == $vartotojo_vardas && $row['slaptazodis'] == $slaptazodis ){
                $_SESSION['prisijunges'] = true;
                $_SESSION['vartotojo_vardas'] = $vartotojo_vardas;
                $_SESSION['teises'] = $row['teises'];
                header('location: index.php');
    
            }else{
                $_SESSION['loginerror']='Tokio užsakovo nera';
                header('location: login.php');
                
            }
        }

           

        
       
    }
    else
    {
        $slaptazodis = md5($slaptazodis);
        $sql = "SELECT * from vezejas WHERE vartotojo_vardas = '$vartotojo_vardas' and slaptazodis = '$slaptazodis'";
        $result=mysqli_query($dbc,$sql);
        
        if (!$result) {
            $_SESSION['loginerror']="Could not successfully run query  from DB: " . mysql_error();
            header('location: login.php');
            exit;
        }
        if (mysqli_num_rows($result) == 0) {
            $_SESSION['loginerror']= "Tokio vežėjo nėra";
            header('location: login.php');
            exit;
        }
        else{
            $row = mysqli_fetch_array($result);
            var_dump($row);
            mysqli_free_result($result);
            if($row['vartotojo_vardas'] == $vartotojo_vardas && $row['slaptazodis'] == $slaptazodis){
                $_SESSION['prisijunges'] = true;
                $_SESSION['vartotojo_vardas'] = $vartotojo_vardas;
                $_SESSION['teises'] = $row['teises'];
                $_SESSION['id'] = $row['asmens_kodas '];
                header('location: index.php');
    
            }else{
                $_SESSION['loginerror']='Tokio vežėjo nėra';
               // header('location: login.php');
                
            }
        }
        

    }
    
?>