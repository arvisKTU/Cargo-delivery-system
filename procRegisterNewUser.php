<?php
session_start();
include("nustatymai.php");
if(isset($_SESSION['prisijunges']))
{
    if($_SESSION['teises']>=$user_roles[MID_LEVEL]){
        $dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Unable to connect to db");
        if(!$dbc)
        {die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }

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
$uzsisakes_naujienlaiskius = "Ne";		
var_dump($_POST);

$slaptazodis = md5($slaptazodis);

//Tikrinu ar toks vartotojas jau yra

$sql =  "INSERT INTO vezejas (teises, vartotojo_vardas,slaptazodis, vardas, pavarde, asmens_kodas, gimimo_metai, telefonas,e_pastas,uzsisakes_naujienlaiskius,prenumeruota)
VALUES('$usrlvl', '$vartotojo_vardas','$slaptazodis', '$vardas', '$pavarde', '$asmens_kodas', '$gimimo_metai', '$telefono_numeris','$elektroninis_pastas','Ne',NULL)";
if(!mysqli_query($dbc,$sql))
{   
    $_SESSION['registracijanesekminga']="Neteisingi duomenys.".mysqli_error($dbc);
    header('Location: registerNewUser.php');
    exit;
}
else
{
    $_SESSION['success'] = "Vežėjas užregistruotas.";
    header('Location: vezejai.php');
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