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
      <title>Vežėjai</title>
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
                     include('vezejasMeniu.php');
                  }
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
         <a class="btn btn-primary" href="registerNewUser.php" role="button">Naujas vežėjas</a>
         <h2 class="text-center">Vežėjai</h2>
         <input type="form-control" id="myInput" onkeyup="myFunction()" placeholder="Ieškokite vežėjų.." title="Type in a name">
         <table class="table table-striped" id="myTable">
            <thead>
               <tr>
                  <th>Vardas</th>
                  <th>Pavardė</th>
                  <th>Asmens kodas</th>
                  <th>Gimimo metai</th>
                  <th>Telefono numeris</th>
                  <th>Paštas</th>
				  <th>Užsisakęs naujienlaiškius</th>
                  <th> </th>
                  <th> </th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $sql= "SELECT * FROM vezejas";
                  $result = mysqli_query($dbc, $sql);
                  if ($result) {
                      while ($row = mysqli_fetch_assoc($result)) {
                          $id=$row['asmens_kodas'];
                      echo "  <tr><td>".$row['vardas'].
                      "</td><td>".$row['pavarde'].
                      "</td><td>".$row['asmens_kodas'].
                      "</td><td>".$row['gimimo_metai'].
                      "</td><td>".$row['telefonas'].
                      "</td><td>".$row['e_pastas'].
						  "</td><td>".$row['uzsisakes_naujienlaiskius'].
                      "</td><td> 
                      <form action='procsalintivezeja.php' method='POST'> 
                      <input type=\"hidden\" name=\"asmens_kodas\" value=" . $row['asmens_kodas'] . ">
                      <input onclick=\"return confirm('Ar tikrai norite ištrinti');\" type='submit'name='salinti' value='Trinti'>
                      </form>
                      </td>
                      <td> 
                      <form action='redaguotivezeja.php' method='POST'> 
                      <input type=\"hidden\" name=\"vartotojo_vardas\" value=" . $row['vartotojo_vardas'] . ">
                      <input type=\"hidden\" name=\"vardas\" value=" . $row['vardas'] . ">
                      <input type=\"hidden\" name=\"pavarde\" value=" . $row['pavarde'] . ">
                      <input type=\"hidden\" name=\"asmens_kodas\" value=" . $row['asmens_kodas'] . ">
                      <input type=\"hidden\" name=\"gimimo_metai\" value=" . $row['gimimo_metai'] . ">
                      <input type=\"hidden\" name=\"telefono_numeris\" value=" . $row['telefonas'] . ">
                      <input type=\"hidden\" name=\"elektroninis_pastas\" value=" . $row['e_pastas'] . ">
					  <input type=\"hidden\" name=\"uzsisakes_naujienlaiskius\" value=" . $row['uzsisakes_naujienlaiskius'] . ">
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