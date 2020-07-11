<?php
    session_start();
    include("nustatymai.php");
    if (isset($_SESSION['prisijunges'])) {
        
        if($_SESSION['teises']>=$user_roles[DEFAULT_LEVEL])
        {
            $dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Unable to connect to db");

			$id = $_POST['id'];
            $busena = "Vykdomas";
			 $kodas = $_POST['kodas'];
			$vardas = $_SESSION['vartotojo_vardas'];
			$fk_vezejai=$_SESSION['id'];
			$sql1="SELECT * FROM vezejas WHERE vezejas.vartotojo_vardas = '$vardas'";
			   $result1 = mysqli_query($dbc, $sql1);
                  if ($result1) {
                     while ($row1 = mysqli_fetch_assoc($result1)) {
							$usr_id=$row1['id'];
					 }
				  }	
            $sql = "UPDATE krovinys
            SET
            busena='$busena',
            fk_vezejai='$usr_id'
			
            WHERE id='$id'";
                    $result=mysqli_query($dbc, $sql);
			echo $result;
                    if(!$result)
                    {
                        $_SESSION['fail']="Nepavyko paimti užsakymo";
                        header("location:krovinys.php");	
                    }
                    else
                    {
						$sql3="SELECT * FROM krovinys WHERE id = '$id'";
			       $result3 = mysqli_query($dbc, $sql3);
                  if ($result3) {
                     while ($row3 = mysqli_fetch_assoc($result3)) {
							$kodas=$row3['kodas'];
					 }
				  }
					 $sql2="UPDATE naujienlaiskiai SET busena= '$busena' WHERE krovinio_kodas='$kodas'";
			         $result2 = mysqli_query($dbc, $sql2);
                        $_SESSION['success']="Užsakymas sėkmingai paimtas";
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