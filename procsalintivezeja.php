<?php
    session_start();
    include("nustatymai.php");
    if (isset($_SESSION['prisijunges'])) {
        
        if($_SESSION['teises']>=$user_roles[MID_LEVEL])
        {
            $dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Unable to connect to db");
                $salinamasvezejas=$_POST["asmens_kodas"];

                $sql= "SELECT *
                FROM krovinys 
                INNER JOIN vezejas ON krovinys.fk_vezejai='$salinamasvezejas'";
             
                $result=mysqli_query($dbc, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $_SESSION['fail']="Vežėjas negali būti pašalintas nes turi krovinių";
                        header("location:vezejai.php");	
                }
                else{
                    $sql = "DELETE FROM vezejas WHERE asmens_kodas=$salinamasvezejas";
                    $result=mysqli_query($dbc, $sql);
                    if(!$result)
                    {
                        $_SESSION['fail']="Vežėjas nepašalintas, sql klaida";
                        header("location:vezejai.php");	
                    }
                    else
                    {
                        $_SESSION['success']="Vežėjas pašalintas";
                        header("location:vezejai.php");	
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