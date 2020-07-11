<?php
session_start();
include("nustatymai.php");
if(isset($_SESSION['prisijunges']))
{
    if($_SESSION['teises']>=$user_roles[ADMIN_LEVEL]){
        $dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Unable to connect to db");
        if(!$dbc)
        {die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }

$dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Unable to connect to db");

$teises = 3;
$vartotojo_vardas = strtolower($_POST['vartotojo_vardas']);
$vardas = $_POST['vardas'];
$pavarde = $_POST['pavarde'];
$pareigos = $_POST['pareigos'];
$slaptazodis = $_POST['slaptazodis'];

$slaptazodis = md5($slaptazodis);

//Tikrinu ar toks vartotojas jau yra

$sql =  "INSERT INTO uzsakovas (teises,vartotojo_vardas, slaptazodis, vardas, pavarde, pareigos)
VALUES('$teises','$vartotojo_vardas','$slaptazodis','$vardas','$pavarde','$pareigos')";
echo $sql;
if(!mysqli_query($dbc,$sql))
{   
    echo mysqli_error($dbc);
    $_SESSION['error']="Neteisingi duomenys.".mysqli_error($dbc);
    header('Location: registerNewEmployee.php');
    exit;
}
else
{
    $_SESSION['success']="Užsakovas užregistruotas.";
    header('Location: uzsakovai.php');
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