<?php
   session_start(); 
   include("nustatymai.php");
   if(isset($_SESSION['prisijunges']))
   {
       if($_SESSION['teises']>=$user_roles[MID_LEVEL]){
           $dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Unable to connect to db");
           if(!$dbc)
           {die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
       }
       else
           die("Negalima");
   }
   else
       die("Negalima");
   ?>
<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
         integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
         crossorigin="anonymous">
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Krovinio redagavimas</title>
   </head>
   <body>
      <div class="jumbotron text-center">
         <h1>Kroviniai</h1>
      </div>
      <div class="container">
         <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto">
               <?php
                        if($_SESSION['teises'] == $user_roles[DEFAULT_LEVEL])
                        {
                            include('vezejasMeniu.php');
                        }
                        if($_SESSION['teises'] == $user_roles[MID_LEVEL]){
                            include('uzsakovasMeniu.php');
                        }
                        if($_SESSION['teises'] == $user_roles[ADMIN_LEVEL]){
                            include('adminMeniu.php');
                        }
                  ?>
            </ul>
         </nav>
         <div class="container">
        <?php
        if(isset($_SESSION['fail']))
        {
            echo 
            "<div class=\"alert alert-danger\">
                <strong>".$_SESSION['fail']." !</strong>
            </div>";
            unset($_SESSION['fail']);
        }
        $id = "";
        $kodas = "";
        $marsrutas = "";
        $terminas = "";
        $busena = "";
        $fk_vezejai = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST")
      {
        $id = $_POST['id'];
        $kodas = $_POST['kodas'];
        $marsrutas = $_POST['marsrutas'];
        $terminas = $_POST['terminas'];
        $busena = $_POST['busena'];
        $fk_vezejai = $_POST['fk_vezejai'];

        if(isset($_SESSION['error']))
        {
            echo 
            "<div class=\"alert alert-danger\">
                <strong>".$_SESSION['error']." !</strong>
            </div>";
            unset($_SESSION['error']);

        }
        else
        {
            $_SESSION['do']="procVykdytiUzsakyma.php"; 
            $_SESSION['goodData']="Patvirtinkite registracija. Duomenys tinkami";
            
        }
        if(isset($_SESSION['goodData']))
        {
            echo 
            "<div class=\"alert alert-success\">
                <strong>".$_SESSION['goodData']." !</strong>
            </div>";
            unset($_SESSION['goodData']);

        }
    }
                       



    // define variables and set to empty values
      ?>
		</div>
   </body>
</html>