<?php
    session_start();
    include("nustatymai.php");
    if (isset($_SESSION['prisijunges'])) {
        
        if($_SESSION['teises']>=$user_roles[MID_LEVEL])
        {
            $dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Unable to connect to db");
            $vardas = $_POST['vardas'];
            $pavarde = $_POST['pavarde'];
            $asmens_kodas = $_POST['asmens_kodas'];
            $gimimo_metai = $_POST['gimimo_metai'];
            $telefono_numeris = $_POST['telefono_numeris'];
            $elektroninis_pastas = $_POST['elektroninis_pastas'];

            $sql = "UPDATE vezejas
            SET vardas='$vardas',
            pavarde='$pavarde',
            gimimo_metai='$gimimo_metai',
            telefonas='$telefono_numeris',
            e_pastas='$elektroninis_pastas'
            WHERE asmens_kodas='$asmens_kodas'";
                    $result=mysqli_query($dbc, $sql);
                    if(!$result)
                    {
                        $_SESSION['fail']="Duomenys nepakeisti.";
                        header("location:vezejai.php");	
                    }
                    else
                    {
                        $_SESSION['success']="Duomenys pakeisti.";
                        header("location:vezejai.php");	
                        exit;
                    }                   
            }        
    } 
    else 
    {
        die("Negalima");
    }
?>