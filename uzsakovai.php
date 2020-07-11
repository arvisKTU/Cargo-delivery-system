<?php
   session_start(); 
   include("nustatymai.php");
   if(isset($_SESSION['prisijunges']))
   {
       if($_SESSION['teises']>=$user_roles[ADMIN_LEVEL]){
   $dbc = mysqli_connect("localhost", "stud", "stud", "stud") or die("Unable to connect to db");
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
      <title>Užsakovai</title>
   </head>
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
         <?php
            if(isset($_SESSION['success']))
            {
               echo 
               "<div class=\"alert alert-success\">
                  <strong>".$_SESSION['success']." !</strong>
               </div>";
               unset($_SESSION['success']);
            }   
            if(isset($_SESSION['fail']))
            {
               echo 
               "<div class=\"alert alert-danger\">
                  <strong>".$_SESSION['fail']." !</strong>
               </div>";
               unset($_SESSION['fail']);
            }  
            ?>
         <br>
         <a class="btn btn-primary" href="registerNewEmployee.php" role="button">Pridėti užsakovą</a>
         <h2 class="text-center">Užsakovai</h2>
         <input type="form-control" id="myInput" onkeyup="myFunction()" placeholder="Ieškokite vežėjų.." title="Type in a name">
         <table class="table table-striped" id="myTable">
            <thead>
               <tr>
                  <th>Vartotojo vardas</th>
                  <th>Vardas</th>
                  <th>Pavardė</th>
                  <th>Pareigos</th>
                  <th> </th>
                  <th> </th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $sql= "SELECT * FROM uzsakovas";
                  $result = mysqli_query($dbc, $sql);
                  if ($result) {
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr><td>".$row['vartotojo_vardas'].
                      "</td><td>".$row['vardas'].
                      "</td><td>".$row['pavarde'].
                      "</td><td>".$row['pareigos'].
                      "</td><td> 
                      <form action='procsalintiuzsakova.php' method='POST'> 
                      <input type=\"hidden\" name=\"vartotojo_vardas\" value=" . $row['vartotojo_vardas'] . ">
                      <input onclick=\"return confirm('Ar tikrai norite ištrinti');\" type='submit'name='salinti' value='Trinti'>
                      </form>
                      </td>
                      <td> 
                      <form action='redaguotiuzsakova.php' method='POST'> 
                      <input type=\"hidden\" name=\"teises\" value=" . $row['teises'] . ">
                      <input type=\"hidden\" name=\"vartotojo_vardas\" value=" . $row['vartotojo_vardas'] . ">
                      <input type=\"hidden\" name=\"vardas\" value=" . $row['vardas'] . ">
                      <input type=\"hidden\" name=\"pavarde\" value=" . $row['pavarde'] . ">
                      <input type=\"hidden\" name=\"pareigos\" value=" . $row['pareigos'] . ">
                      <input  type='submit' name='redaguoti' value='Redaguoti'>
                      </form>
                      </td></tr>";
                      }
                  }
                  ?>
            </tbody>
         </table>
      </div>
      </div>
      <script>
         function myFunction() {
         var input, filter, table, tr, td, i;
         input = document.getElementById("myInput");
         filter = input.value.toUpperCase();
         table = document.getElementById("myTable");
         tr = table.getElementsByTagName("tr");
         for (i = 0; i < tr.length; i++) {
             td = tr[i].getElementsByTagName("td")[0];
             if (td) {
             if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                 tr[i].style.display = "";
             } else {
                 tr[i].style.display = "none";
             }
             }       
         }
         }
      </script>
   </body>
</html>