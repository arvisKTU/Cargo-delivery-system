<?php
    session_start();
    include("nustatymai.php");
    if (isset($_SESSION['prisijunges'])) {
        
        if($_SESSION['teises']>=$user_roles[DEFAULT_LEVEL])
        {
            $dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Unable to connect to db");

            $prenumeruota = "";
			$vardas = $_SESSION['vartotojo_vardas'];
			$sql1="SELECT * FROM vezejas WHERE vezejas.vartotojo_vardas = '$vardas'";
			   $result1 = mysqli_query($dbc, $sql1);
                  if ($result1) {
                     while ($row1 = mysqli_fetch_assoc($result1)) {
							$usr_id=$row1['id'];
					 }
				  }
			$sql2="SELECT * FROM vezejas WHERE vezejas.id = '$usr_id'";
			   $result2 = mysqli_query($dbc, $sql2);
                  if ($result2) {
                     while ($row2 = mysqli_fetch_assoc($result2)) {
							$prenumeruota=$row2['uzsisakes_naujienlaiskius'];
					 }
				  }
			if($prenumeruota=="Ne")
			{
            $sql = "UPDATE vezejas
            SET
            uzsisakes_naujienlaiskius='Taip',
			prenumeruota=CURRENT_TIMESTAMP
			
            WHERE id='$usr_id'";
                    $result=mysqli_query($dbc, $sql);
			}
			else 
			$sql = "UPDATE vezejas
            SET
            uzsisakes_naujienlaiskius='Ne'
			
            WHERE id='$usr_id'";
                    $result=mysqli_query($dbc, $sql);
			echo $result;
                    if(!$result)
                    {
                        $_SESSION['fail']="Prenumerata nesėkminga";
                        header("location:naujienlaiskiai.php");	
                    }
                    else
                    {
                        $_SESSION['success']="Prenumerata sėkminga";
                        header("location:naujienlaiskiai.php");	
                        exit;
                    }                   
            }        
    } 
    else 
    {
        die("Negalima");
    }
?>