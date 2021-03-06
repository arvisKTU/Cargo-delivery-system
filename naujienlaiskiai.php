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
      <title>Kroviniai</title>
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
         <?php
         if($_SESSION['teises'] == $user_roles[MID_LEVEL] || $_SESSION['teises'] == $user_roles[ADMIN_LEVEL]){
            ?>
         <a class="btn btn-primary" href="naujasKrovinys.php" role="button">Pridėti krovinį</a>
         <?php
         }
         ?>
         
         <h2 class="text-center">Naujienlaiškiai</h2>
         <input type="form-control" id="myInput" onkeyup="myFunction()" placeholder="Ieškokite Naujienlaiškių.." title="Type in a name">
         <table class="table table-striped" id="myTable">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Žinutė </th>
				   <th>Data </th>
                  <th> </th>
                  <th> </th>
               </tr>
            </thead>
            <tbody>
               <?php
               if($_SESSION['teises'] == $user_roles[DEFAULT_LEVEL] || $_SESSION['teises'] == $user_roles[ADMIN_LEVEL] ){
              	  $vez_vard=$_SESSION['vartotojo_vardas'];
				  $sql1= "SELECT * FROM vezejas WHERE vartotojo_vardas = '$vez_vard'";
                  $result1 = mysqli_query($dbc, $sql1);
                  if ($result1) {
                      while ($row1 = mysqli_fetch_assoc($result1)) {
						  $prenumeruoja=$row1['uzsisakes_naujienlaiskius'];
						  $prenumeratosLaikas=$row1['prenumeruota'];
					  }
				  }
				  if($prenumeruoja=="Taip")
				  {
					   echo
					   "<form action='procPrenumeruoti.php' method='POST'> 
                      <input onclick=\"return confirm('Ar norite atšaukti naujienlaiškių prenumeratą?');\" type='submit'name='nebeprenumeruoti' value='Atšaukti prenumeratą'>
                      </form>";
                  $sql= "SELECT * FROM naujienlaiskiai";
                  $result = mysqli_query($dbc, $sql);
                  if ($result) {
                      while ($row = mysqli_fetch_assoc($result)) {
					  $laiskoLaikas=$row['data'];
					  $busena=$row['busena'];
					  if($laiskoLaikas>$prenumeratosLaikas && $busena=="Ieskoma vezejo")
					  {
                      echo "<tr><td>".$row['id'].
                      "</td><td>".$row['zinute'].
					  "</td><td>".$row['data'].
                      "</td><td> 
                      </td></tr>";
					  }
                      }
                  }
				  }
				   else
					   echo
					   "<form action='procPrenumeruoti.php' method='POST'> 
                      <input onclick=\"return confirm('Ar norite prenumeruoti naujienlaiškius?');\" type='submit'name='prenumeruoti' value='Prenumeruoti naujienlaiškius'>
                      </form>";
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