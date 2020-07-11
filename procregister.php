<?php
session_start();
include("nustatymai.php");

$usrlvl = $user_roles[DEFAULT_LEVEL];
$dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Unable to connect to db");

$vartotojo_vardas = strtolower($_POST['vartotojo_vardas']);
$vardas = $_POST['vardas'];
$pavarde = $_POST['pavarde'];
$slaptazodis = $_POST['slaptazodis'];
$asmens_kodas = $_POST['asmens_kodas'];
$gimimo_metai = $_POST['gimimo_metai'];
$telefono_numeris = $_POST['telefono_numeris'];
$elektroninis_pastas = $_POST['elektroninis_pastas'];

var_dump($_POST);

$slaptazodis = md5($slaptazodis);

//Tikrinu ar toks vezejas jau yra

$sql =  "INSERT INTO vezejas (teises, vartotojo_vardas,slaptazodis, vardas, pavarde, asmens_kodas, gimimo_metai, telefonas,e_pastas,uzsisakes_naujienlaiskius,prenumeruota)
VALUES('$usrlvl','$vartotojo_vardas','$slaptazodis','$vardas','$pavarde','$asmens_kodas','$gimimo_metai','$telefono_numeris','$elektroninis_pastas','Ne',NULL)";
if(!mysqli_query($dbc,$sql))
{   
    $_SESSION['registracijanesekminga']="Neteisingi duomenys.".mysqli_error($dbc);
    header('Location: register.php');
    exit;
}
else
{
    
    $_SESSION['registersuccess']="Vežėjas užregistruotas.";
    header('Location: login.php');
    exit;
 }
 
?>