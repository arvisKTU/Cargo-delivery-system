<?php
   session_start(); 
   include("nustatymai.php");
   if(isset($_SESSION['prisijunges'])&& isset($_POST['asmens_kodas']))
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
      <title>Vežėjo redagavimas</title>
   </head>
   <body>
      <div class="jumbotron text-center">
         <h1>Kroviniai</h1>
      </div>
      <div class="container">
         <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto">
               <?php
                  if($_SESSION['teises'] == $user_roles[ADMIN_LEVEL])
                  {
                    include('adminMeniu.php');
                  }
                  else
                  {
                    include('uzsakovasMeniu.php');  
                  }
                  ?>
            </ul>
         </nav>
         <div class="container">
        <?php
        if(isset($_SESSION['registerdbcerror']))
        {
            echo 
            "<div class=\"alert alert-danger\">
                <strong>".$_SESSION['registerdbcerror']." !</strong>
            </div>";
            unset($_SESSION['registerdbcerror']);
        }
        $vartotojo_vardas="";
        $vardas = "";
        $pavarde = "";
        $asmens_kodas = "";
        $gimimo_metai = "";
        $telefono_numeris = "";
        $elektroninis_pastas = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST")
      {
        $vartotojo_vardas = $_POST['vartotojo_vardas'];
        $vardas = $_POST['vardas'];
        $pavarde = $_POST['pavarde'];
        $asmens_kodas = $_POST['asmens_kodas'];
        $gimimo_metai = $_POST['gimimo_metai'];
        $telefono_numeris = $_POST['telefono_numeris'];
        $elektroninis_pastas = $_POST['elektroninis_pastas'];

        if(!preg_match("/^((86|\+3706)\d{7})$/", $telefono_numeris)) {
            $_SESSION['registererror']="neteisingai ivestas telefono numeris";
          }
        if(isset($_SESSION['registererror']))
        {
            echo 
            "<div class=\"alert alert-danger\">
                <strong>".$_SESSION['registererror']." !</strong>
            </div>";
            unset($_SESSION['registererror']);
        }
        else
        {
            $_SESSION['do']="procRedaguotiVezejoDuomenis.php"; 
            $_SESSION['goodData']="Patvirtinkite registracija. Duomenys tinkami.";
            
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
                                <label>Vartotojo vardas :</label>
                                <div class="form-group">
                                    <input type="text" name="vartotojo_vardas" value="<?php echo $vartotojo_vardas; ?>" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <label>Vardas:</label>
                                <div class="form-group">
                                    <input type="text" id="vardas" name="vardas" value="<?php echo $vardas; ?>" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <label>Pavarde:</label>
                                <div class="form-group">
                                    <input type="text" id="pavarde" name="pavarde" value="<?php echo $pavarde; ?>" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <label>Asmens kodas:</label>
                                <div class="form-group">
                                    <input type="number" readonly="readonly" id="asmens_kodas"  name="asmens_kodas"  value="<?php echo $asmens_kodas; ?>" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <label>Gimimo metai:</label>
                                <div class="form-group">
                                    <input type="date" id="gimimo_metai" name="gimimo_metai" value="<?php echo $gimimo_metai; ?>" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <label>Telefonas :</label>
                                <div class="form-group">
                                    <input type="text" id="telefono_numeris" name="telefono_numeris" value="<?php echo $telefono_numeris; ?>" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <label>Elektroninis paštas :</label>
                                <div class="form-group">
                                    <input type="email"  id="elektroninis_pastas" name="elektroninis_pastas" value="<?php echo $elektroninis_pastas; ?>" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="form-group ">
                                  <div class="col-md-auto col-sm-offset-2" >
							          <button type="submit" id="but" class="btn btn-primary btn-block login-button">Patvirtinti</button>
						        </div>
                            </div>
                        </div>
					</form>
		</div>
   </body>
</html>