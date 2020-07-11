<!DOCTYPE html>
<html>
   <?php
      session_start();
      ?>
   <head>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
         integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
         crossorigin="anonymous">
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Login</title>
      <head>
   <body>
      <div class="jumbotron text-center">
         <h1>Kroviniai</h1>
      </div>
      <div class="container">
         <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto">
               <?php

                         include('neprisijungesMeniu.php');  
                    ?>
            </ul>
         </nav>
      </div>
      <div class="container">
         <?php
            if(isset($_SESSION['registersuccess']))
            {
               echo 
               "<div class=\"alert alert-success\">
                  <strong>".$_SESSION['registersuccess']." !</strong>
               </div>";
               unset($_SESSION['registersuccess']);
            }   
            if(isset($_SESSION['loginerror']))
            {
               echo 
               "<div class=\"alert alert-danger\">
                  <strong>".$_SESSION['loginerror']." !</strong>
               </div>";
               unset($_SESSION['loginerror']);
            }   
            ?>
         <form class="form" action="proclogin.php" method="POST">
            <div class="row justify-content-md-center">
               <div class="col-md-auto">
                  <label>Vartotojo vardas :</label>
                  <div class="form-group">
                     <input type="text" id="vartotojo_vardas" name="vartotojo_vardas" required/>
                  </div>
               </div>
            </div>
            <div class="row justify-content-md-center">
               <div class="col-md-auto">
                  <label>Slaptažodis :</label>
                  <div class="form-group">
                     <input type="password" id="slaptazodis" name="slaptazodis" required/>
                  </div>
               </div>
            </div>
            <div class="row justify-content-md-center">
               <div class="col-md-auto">
                  <div class="form-group">
                     <input type="radio" name="tipas" value="vezejas" checked> Vežėjas<br>
                     <input type="radio" name="tipas" value="uzsakovas"> Užsakovas<br>
                  </div>
               </div>
            </div>
            <div class="row justify-content-md-center">
               <div class="form-group ">
                  <div class="col-md-auto col-sm-offset-2" >
                     <button type="submit" class="btn btn-primary btn-block login-button">Prisijungti</button>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </body>
</html>