<?php
    session_start();
    include("nustatymai.php");
    if (isset($_SESSION['prisijunges'])) {
        
        if($_SESSION['teises']>=$user_roles[MID_LEVEL])
        {
            $dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Unable to connect to db");

            $id = $_POST['id'];
            $kodas = $_POST['kodas'];
            $marsrutas = $_POST['marsrutas'];
            $terminas = $_POST['terminas'];
            $busena = $_POST['busena'];
			$fk_vezejai=$_POST['fk_vezejai'];

            $sql = "UPDATE krovinys
            SET kodas='$kodas',
            marsrutas='$marsrutas',
            terminas='$terminas',
            busena='$busena',
            fk_vezejai='$fk_vezejai'
			
            WHERE id='$id'";
                    $result=mysqli_query($dbc, $sql);
                    if(!$result)
                    {
                        $_SESSION['fail']="Duomenys nepakeisti.";
                        header("location:krovinys.php");	
                    }
                    else
                    {
                        $_SESSION['success']="Duomenys pakeisti.";
                        header("location:krovinys.php");	
                        exit;
                    }                   
            }        
    } 
    else 
    {
        die("Negalima");
    }
?>