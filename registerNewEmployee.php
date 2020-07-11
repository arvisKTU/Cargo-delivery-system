<!DOCTYPE html>
<html>
<?php
   session_start(); 
   include("nustatymai.php");
   if(isset($_SESSION['prisijunges']))
   {
       if($_SESSION['teises']>=$user_roles[ADMIN_LEVEL]){
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
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
    crossorigin="anonymous">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Pridėti užsakovą</title>
         
    <head>

    <body>
        <div class="jumbotron text-center">
             <h1>Kroviniai</h1>
        </div>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                 <ul class="navbar-nav mr-auto">
                 <?php
                      include('adminMeniu.php');
                  ?>
                </ul>
            </nav>
        </div>    
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
      
        $teises = "3";
        $vartotojo_vardas = "";
        $vardas = "";
        $pavarde = "";
        $pareigos = "";
        $slaptazodis= "";
      if ($_SERVER["REQUEST_METHOD"] == "POST")
      {
        $teises = 3;
        $vartotojo_vardas = strtolower($_POST['vartotojo_vardas']);
        $vardas = $_POST['vardas'];
        $pavarde = $_POST['pavarde'];
        $pareigos = $_POST['pareigos'];
        $slaptazodis = $_POST['slaptazodis'];

        $sql =  "SELECT * FROM uzsakovas WHERE vartotojo_vardas = '$vartotojo_vardas'";
        $result=mysqli_query($dbc,$sql);
       
        if (!$result) {
            $_SESSION['error']="Could not successfully run query from DB: " . mysql_error();
        }
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['error']= "Toks vartotojo vardas sistemoje jau yra";
        }
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
            $_SESSION['do']="procRegisterNewEmployee.php"; 
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
                                <label>Pareigos:</label>
                                <div class="form-group">
                                    <input type="text" id="pareigos" name="pareigos" value="<?php echo $pareigos; ?>" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <label>Slaptasžodis :</label>
                                <div class="form-group">
                                    <input type="password" minlength="6" id="slaptazodis" name="slaptazodis" value="<?php echo $slaptazodis; ?>" required/>
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