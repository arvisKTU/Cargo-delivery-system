<?php
    session_start();
    include("nustatymai.php");
    if (isset($_SESSION['prisijunges'])) {
        
        if($_SESSION['teises']>=$user_roles[ADMIN_LEVEL])
        {
            $dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Unable to connect to db");
            
            $teises = $_POST['teises'];
            $vardas = $_POST['vardas'];
            $pavarde = $_POST['pavarde'];
            $pareigos = $_POST['pareigos'];
            $vartotojo_vardas = $_POST['vartotojo_vardas'];

            $sql = "UPDATE uzsakovas
            SET vardas='$vardas',
            pavarde='$pavarde',
            teises='$teises',
            pareigos='$pareigos'
            WHERE vartotojo_vardas='$vartotojo_vardas'";
                    $result=mysqli_query($dbc, $sql);
                    if(!$result)
                    {
                        echo $sql;
                        $_SESSION['fail']="Duomenis nepakeisti.";
                        header("location:uzsakovai.php");	
                    }
                    else
                    {
                        $_SESSION['success']="Duomenis pakeisti.";
                        header("location:uzsakovai.php");	
                        exit;
                    }                   
            }        
    } 
    else 
    {
        die("Negalima");
    }
?>