<?php
   session_start(); 
   include("nustatymai.php");
      $dbc = mysqli_connect("localhost", "stud", "stud", "stud") or die("Unable to connect to db");
   if(!$dbc)
   {die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
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
      <title>Login</title>
   </head>
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
         
         <h2 class="text-center">Kroviniai</h2>
         <input type="form-control" id="myInput" onkeyup="myFunction()" placeholder="Ieškokite krovinių.." title="Type in a name">
         <table class="table table-striped" id="myTable">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Kodas </th>
				   <th>Maršrutas </th>
				   <th>Terminas </th>
				   <th>Būsena </th>
				   <th>Vežėjas </th>
                  <th> </th>
                  <th> </th>
               </tr>
            </thead>
            <tbody>
               <?php
              
                  $sql= "SELECT * FROM krovinys";
                  $result = mysqli_query($dbc, $sql);
                  if ($result) {
                      while ($row = mysqli_fetch_array($result)) {
						   $vez_id = $row['fk_vezejai'];
						  $sql1="SELECT * FROM vezejas WHERE vezejas.id = '$vez_id'";
			  				 $result1 = mysqli_query($dbc, $sql1);
                  				if ($result1) {
                    			 while ($row1 = mysqli_fetch_assoc($result1)) {
										$vez_vard=$row1['vartotojo_vardas'];
					 }
				  }	
                      echo "<tr><td>".$row['id'].
                      "</td><td>".$row['kodas'].
					  "</td><td>".$row['marsrutas'].
					  "</td><td>".$row['terminas'].
					  "</td><td>".$row['busena'].
					  "</td><td>".$vez_vard.
                      "</td><td>";
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