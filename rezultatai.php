<?php
   session_start(); 
   include("nustatymai.php");
   if(isset($_SESSION['prisijunges']))
   {
       if($_SESSION['teises']>=$user_roles[DEFAULT_LEVEL]){
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
      <title>Apklausų rezultatai</title>
   </head>
   <body>
      <div class="jumbotron text-center">
         <h1>Apklausa</h1>
      </div>
      <div class="container">
         <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto">
               <?php
                     if($_SESSION['teises'] == $user_roles[DEFAULT_LEVEL])
                     {
                        include('naudotojasMeniu.php');
                     }
                     if($_SESSION['teises'] == $user_roles[MID_LEVEL]){
                           include('darbuotojasMeniu.php');
                     }
                     if($_SESSION['teises'] == $user_roles[ADMIN_LEVEL]){
                        include('adminMeniu.php');
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
         <h2 class="text-center">Apklausos</h2>
         <input type="form-control" id="myInput" onkeyup="myFunction()" placeholder="Ieškokite apklausų.." title="Type in a name">
         <table class="table table-striped" id="myTable">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Pavadinimas </th>
                  <th> </th>
                  <th> </th>
               </tr>
            </thead>
            <tbody>
               <?php
               if($_SESSION['teises'] == $user_roles[MID_LEVEL] || $_SESSION['teises'] == $user_roles[ADMIN_LEVEL]){
              
                  $sql= "SELECT * FROM apklausa";
                  $result = mysqli_query($dbc, $sql);
                  if ($result) {
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr><td>".$row['id'].
                      "</td><td>".$row['pavadinimas'].
                      "</td><td> 
                      </td><td> 
                      <form action='apklausosRezultatai.php' method='POST'> 
                      <input type=\"hidden\" name=\"pavadinimas\" value=" . $row['pavadinimas'] . ">
                      <input type=\"hidden\" name=\"id\" value=" . $row['id'] . ">
                      <input type=\"hidden\" name=\"klausimas1_id\" value=" . $row['klausimas1_id'] . ">
                      <input type=\"hidden\" name=\"klausimas2_id\" value=" . $row['klausimas2_id'] . ">
                      <input type=\"hidden\" name=\"klausimas3_id\" value=" . $row['klausimas3_id'] . ">
                      <input type=\"hidden\" name=\"klausimas4_id\" value=" . $row['klausimas4_id'] . ">
                      <input type=\"hidden\" name=\"klausimas5_id\" value=" . $row['klausimas5_id'] . ">
                      <input type=\"hidden\" name=\"klausimas6_id\" value=" . $row['klausimas6_id'] . ">
                      <input type=\"hidden\" name=\"klausimas7_id\" value=" . $row['klausimas7_id'] . ">
                      <input type=\"hidden\" name=\"klausimas8_id\" value=" . $row['klausimas8_id'] . ">
                      <input type=\"hidden\" name=\"klausimas9_id\" value=" . $row['klausimas9_id'] . ">
                      <input type=\"hidden\" name=\"klausimas10_id\" value=" . $row['klausimas10_id'] . ">
                      <input  type='submit' name='redaguoti' value='Rezultatai'>
                      </form>
                      </td></tr>";
                      }
                  }
               }
               if($_SESSION['teises'] == $user_roles[DEFAULT_LEVEL]){
              
                  $sql= "SELECT * FROM apklausa";
                  $result = mysqli_query($dbc, $sql);
                  if ($result) {
                      while ($row = mysqli_fetch_array($result)) {
                      echo "<tr><td>".$row['id'].
                      "</td><td>".$row['pavadinimas'].
                      "</td><td> 
                      <form action='dalyvautiApklausoje.php' method='POST'> 
                      <input type=\"hidden\" name=\"pavadinimas\" value=" . $row['pavadinimas'] . ">
                      <input type=\"hidden\" name=\"id\" value=" . $row['id'] . ">
                      <input type=\"hidden\" name=\"klausimas1_id\" value=" . $row['klausimas1_id'] . ">
                      <input type=\"hidden\" name=\"klausimas2_id\" value=" . $row['klausimas2_id'] . ">
                      <input type=\"hidden\" name=\"klausimas3_id\" value=" . $row['klausimas3_id'] . ">
                      <input type=\"hidden\" name=\"klausimas4_id\" value=" . $row['klausimas4_id'] . ">
                      <input type=\"hidden\" name=\"klausimas5_id\" value=" . $row['klausimas5_id'] . ">
                      <input type=\"hidden\" name=\"klausimas6_id\" value=" . $row['klausimas6_id'] . ">
                      <input type=\"hidden\" name=\"klausimas7_id\" value=" . $row['klausimas7_id'] . ">
                      <input type=\"hidden\" name=\"klausimas8_id\" value=" . $row['klausimas8_id'] . ">
                      <input type=\"hidden\" name=\"klausimas9_id\" value=" . $row['klausimas9_id'] . ">
                      <input type=\"hidden\" name=\"klausimas10_id\" value=" . $row['klausimas10_id'] . ">
                      <input  type='submit' name='dalyvauti' value='Dalyvauti apklausoje'>
                      </form>
                      </td></tr>";
                      }
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
             td = tr[i].getElementsByTagName("td")[1];
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