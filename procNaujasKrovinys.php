<?php
session_start();
include("nustatymai.php");
if(isset($_SESSION['prisijunges']))
{
    if($_SESSION['teises']>=$user_roles[MID_LEVEL]){
        $dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Unable to connect to db");
        if(!$dbc)
        {die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }

$dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Unable to connect to db");

        $kodas = $_POST['kodas'];
        $marsrutas = $_POST['marsrutas'];
        $terminas = $_POST['terminas'];
        $busena = "Ieskoma vezejo";
        $fk_vezejai = 0;
        

$sql =  "INSERT INTO krovinys (kodas,marsrutas,terminas,busena,fk_vezejai)
VALUES('$kodas','$marsrutas','$terminas','$busena','$fk_vezejai')";
		
if(!mysqli_query($dbc,$sql))
{   
    echo mysqli_error($dbc);
    $_SESSION['error']="Neteisingi duomenys.".mysqli_error($dbc);
    header('Location: krovinys.php');
    exit;
}		
		
else
{
	$sql1 =  "INSERT INTO naujienlaiskiai (zinute,busena,krovinio_kodas)
    VALUES('Uzregistruojas naujas krovinys - kodas: $kodas, marsrutas: $marsrutas, terminas: $terminas','$busena','$kodas')";
	mysqli_query($dbc,$sql1);
    $_SESSION['success']="Krovinys užregistruotas.";
    header('Location: krovinys.php');
    exit;
 }
    }
    else
        die("Negalima");
        exit;
}
else
    die("Negalima");
    exit;


 
?>