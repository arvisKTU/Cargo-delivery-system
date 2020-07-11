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
		  if(strlen($kodas)!=6 || !is_numeric($kodas))
        {
            $_SESSION['error']= "Kodas turi būti 6 skaitmenų skaičius";
        }
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
            $_SESSION['do']="procRedaguotiKrovini.php"; 
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
     
                    <form class="form" name ="theForm" id = "myForm" method="POST" action="<?php 
                    if(isset($_SESSION['do']))
                    {
                        echo $_SESSION['do'];
                        unset($_SESSION['do']);
                    }
                    else
                    {
                        echo htmlspecialchars($_SERVER["PHP_SELF"]);
                    }?>"> 
                        <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <label>ID :</label>
                                <div class="form-group">
                                    <input type="number" id="id" name="id" value="<?php echo $id; ?>" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <label>Kodas :</label>
                                <div class="form-group">
                                    <input type="text" id="kodas" name="kodas" value="<?php echo $kodas; ?>" required/>
                                </div>
                            </div>
                        </div>
						<div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <label>Marštutas :</label>
                                <div class="form-group">
                                    <input type="text" id="marsrutas" name="marsrutas" value="<?php echo $marsrutas; ?>" required/>
                                </div>
                            </div>
                        </div>
						<div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <label>Terminas :</label>
                                <div class="form-group">
                                    <input type="number" id="terminas" name="terminas" value="<?php echo $terminas; ?>" required/>
                                </div>
                            </div>
                        </div>
						 <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <label>Būsena :</label>
                                <div class="form-group">
                                    <input type="text" id="busena" name="busena" value="<?php echo $busena; ?>" readonly/>
                                </div>
                            </div>
                        </div>
						<div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <label>Vežėjas :</label>
                                <div class="form-group">
                                    <input type="number" id="fk_vezejai" name="fk_vezejai" value="<?php echo $fk_vezejai; ?>" readonly/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row justify-content-md-center">
                            <div class="form-group ">
                                  <div class="col-md-auto col-sm-offset-2" >
							          <button type="submit" id="but" class="btn btn-primary btn-block login-button">Registruoti</button>
						        </div>
                            </div>
                        </div>
					</form>
		</div>
   </body>
</html>