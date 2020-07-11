<?php
   session_start();
   include("nustatymai.php");
   $dbc = mysqli_connect("localhost", "stud", "stud", "stud") or die("Unable to connect to db");
   if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
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
      <title>Pagrindinis</title>
   </head>
   <body>
      <div class="jumbotron text-center">
         <h1>Kroviniai</h1>
      </div>
      <div class="container">
         <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto">
               <?php
                  if(isset($_SESSION['prisijunges']))
                     {
                         if($_SESSION['teises'] == $user_roles[ADMIN_LEVEL])
                         {
                            include('adminMeniu.php');
                         }
                         elseif($_SESSION['teises'] == $user_roles[MID_LEVEL])
                         {
                             include('uzsakovasMeniu.php');   
                         }
                         else
                         {
                             include('vezejasMeniu.php');   
                         }
                     }
                     else
                     {
                         include('neprisijungesMeniu.php');  
                     }
                    ?>
            </ul>
         </nav>
</div>
                           <div class="row justify-content-md-center">
                              <div></div>
                                 <div class="col-md-auto">
                                 <label>Krovinių pervežimo sistema</label>
                                 <div class="form-group">
                                 <label>Darbą atliko : ArvydasBruklys IFF-6/8</label>
                              </div>
                            </div>
   </body>
</html>