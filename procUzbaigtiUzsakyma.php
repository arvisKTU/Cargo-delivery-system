<?php
    session_start();
    include("nustatymai.php");
    if (isset($_SESSION['prisijunges'])) {
        
        if($_SESSION['teises']>=$user_roles[DEFAULT_LEVEL])
        {
            $dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Unable to connect to db");

			$id = $_POST['id'];
            $busena = "Uzbaigtas";
			$vardas = $_SESSION['vartotojo_vardas'];
			$fk_vezejai=$_SESSION['id'];
			$sql1="SELECT * FROM vezejas WHERE vezejas.vartotojo_vardas = '$vardas'";
			   $result1 = mysqli_query($dbc, $sql1);
                  if ($result1) {
                     while ($row1 = mysqli_fetch_assoc($result1)) {
							$usr_id=$row1['id'];
					 }
				  }
			$sql2="SELECT * FROM krovinys WHERE id = '$id'";
			   $result2 = mysqli_query($dbc, $sql2);
                  if ($result2) {
                     while ($row2 = mysqli_fetch_assoc($result2)) {
							$vzj_id=$row2['fk_vezejai'];
					 }
				  }
			 $vez_vard=$_SESSION['vartotojo_vardas'];
				  $sql2= "SELECT * FROM vezejas WHERE vartotojo_vardas = '$vez_vard'";
                  $result2 = mysqli_query($dbc, $sql2);
                  if ($result2) {
                      while ($row2 = mysqli_fetch_assoc($result2)) {
						  $prenumeruoja=$row2['uzsisakes_naujienlaiskius'];
					  }
				  }
			if($usr_id==$vzj_id)
			{
            $sql = "UPDATE krovinys
            SET
            busena='$busena'
			
            WHERE id='$id'";
                    $result=mysqli_query($dbc, $sql);
			}
                    if(!$result)
                    {
                        $_SESSION['fail']="Negalima užbaigti kito vežėjo užsakymo";
                        header("location:krovinys.php");	
                    }
                    else
                    {
                        $_SESSION['success']="Užsakymas sėkmingai užbaigtas";
                        header("location:krovinys.php");	
                        exit;
                    }                   
            }        
    } 
    else 
    {
        die("Negalima");
    }
?>