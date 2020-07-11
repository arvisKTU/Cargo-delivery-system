<?php
    session_start();
    include("nustatymai.php");
    if (isset($_SESSION['prisijunges'])) {
        
        if($_SESSION['teises']>=$user_roles[ADMIN_LEVEL])
        {
            $dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Unable to connect to db");
                $salinamasUzsakovas=$_POST["vartotojo_vardas"];

                $sql= "SELECT *
                FROM uzsakovas 
                WHERE vartotojo_vardas ='$salinamasUzsakovas'";
                $sql = "DELETE FROM uzsakovas WHERE vartotojo_vardas='$salinamasUzsakovas'";
                
                $result=mysqli_query($dbc, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $sql = "DELETE FROM uzsakovas WHERE vartotojo_vardas='$salinamasUzsakovas'";
                    $_SESSION['fail']=$salinamasUzsakovas;
                        header("location:uzsakovai.php");	
                }
                else{
                    $sql = "DELETE FROM uzsakovas WHERE vartotojo_vardas='$salinamasUzsakovas'";
                    $result=mysqli_query($dbc, $sql);
                    if(!$result)
                        {
                            $_SESSION['fail']="Užsakovas nepašalintas, sql klaida";
                            header("location:uzsakovai.php");	
                        }
                    else
                        {
                            $_SESSION['success']="Užsakovas pašalintas";
                            header("location:uzsakovai.php");	
                            exit;
                        }                   
                    }        
        } 
    else 
    {
        die("Negalima");
    }
}
?>