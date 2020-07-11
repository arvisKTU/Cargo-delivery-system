<!DOCTYPE html>
<html>
<?php
    session_start();
		include("nustatymai.php");
        // values passed via login page
        $dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Unable to connect to db");
?>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
    crossorigin="anonymous">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Registracija</title>
         
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
        if(isset($_SESSION['registerdbcerror']))
        {
            echo 
            "<div class=\"alert alert-danger\">
                <strong>".$_SESSION['registerdbcerror']." !</strong>
            </div>";
            unset($_SESSION['registerdbcerror']);
        }
      
      $vartotojo_vardas = "";
        $vardas = "";
        $pavarde = "";
        $slaptazodis = "";
        $asmens_kodas = "";
        $gimimo_metai = "";
        $telefono_numeris = "";
        $elektroninis_pastas = "";
      if ($_SERVER["REQUEST_METHOD"] == "POST")
      {
        $vartotojo_vardas = strtolower($_POST['vartotojo_vardas']);
        $vardas = $_POST['vardas'];
        $pavarde = $_POST['pavarde'];
        $slaptazodis = $_POST['slaptazodis'];
        $asmens_kodas = $_POST['asmens_kodas'];
        $gimimo_metai = $_POST['gimimo_metai'];
        $telefono_numeris = $_POST['telefono_numeris'];
        $elektroninis_pastas = $_POST['elektroninis_pastas'];
        if(strlen($asmens_kodas)!=11)
        {
            $_SESSION['registererror']= "Asmens kodas įvestas neteisingai";
        }
        else
        {
            $sql =  "SELECT * FROM vezejas WHERE asmens_kodas = '$asmens_kodas'";
            $result=mysqli_query($dbc,$sql);
            if (!$result) {
                $_SESSION['registererror']="Could not successfully run query from DB: " . mysql_error();
            }
            if (mysqli_num_rows($result) == 1) {
                $_SESSION['registererror']= "Asmens kodas įvestas neteisingai";
            }
        }
        $sql =  "SELECT * FROM vezejas WHERE vartotojo_vardas = '$vartotojo_vardas'";
        $result=mysqli_query($dbc,$sql);
        if(!preg_match("/^((86|\+3706)\d{7})$/", $telefono_numeris)) {
            $_SESSION['registererror']="neteisingai ivestas telefono numeris";
          }
        if (!$result) {
            $_SESSION['registererror']="Could not successfully run query from DB: " . mysql_error();
        }
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['registererror']= "Toks vartotojo vardas sistemoje jau yra";
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
            $_SESSION['do']="procregister.php"; 
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
                    }

                    ?>"> 
                        <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <label>Vartotojo vardas :</label>
                                <div class="form-group">
                                    <input type="text" id="vartotojo_vardas" name="vartotojo_vardas" value="<?php echo $vartotojo_vardas; ?>" required/>
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
                                    <input type="number" id="asmens_kodas"  name="asmens_kodas"  value="<?php echo $asmens_kodas; ?>" required/>
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
                            <div class="col-md-auto">
                                <label>Slaptažodis :</label>
                                <div class="form-group">
                                    <input type="password"   minlength="8" id="slaptazodis" name="slaptazodis" value="<?php echo $slaptazodis; ?>" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="form-group ">
                                  <div class="col-md-auto col-sm-offset-2" >
							          <button type="submit" id="but" class="btn btn-primary btn-block login-button">Registruotis</button>
						        </div>
                            </div>
                        </div>
					</form>
		</div>
     </body>
</html>