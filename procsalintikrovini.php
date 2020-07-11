<?php
    session_start();
    include("nustatymai.php");
    $busena="Pasalintas";
    $busena2="";
    if (isset($_SESSION['prisijunges'])) {
        
        if($_SESSION['teises']>=$user_roles[MID_LEVEL])
        {
            $dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Unable to connect to db");
                $id=$_POST["id"];
			$sql3="SELECT * FROM krovinys WHERE id = '$id'";
			       $result3 = mysqli_query($dbc, $sql3);
                  if ($result3) {
                     while ($row3 = mysqli_fetch_assoc($result3)) {
							$kodas=$row3['kodas'];
						    $busena2=$row3['busena'];
					 }
				  }
					 $sql2="UPDATE naujienlaiskiai SET busena= '$busena' WHERE krovinio_kodas='$kodas'";
			         $result2 = mysqli_query($dbc, $sql2);
					if($busena2!="Vykdomas")
					{
                    $sql = "DELETE FROM krovinys WHERE id=$id";
                    $result=mysqli_query($dbc, $sql);
					}
                    if(!$result)
                    {
                        $_SESSION['fail']="Krovinys nepašalintas, nes yra vykdomas";
                        header("location:krovinys.php");	
                    }
                    else
                    {
                        $_SESSION['success']="Krovinys pašalintas";
                        header("location:krovinys.php");	
                        exit;
                    }                   
                    
    } 
    else 
    {
        die("Negalima");
    }
}
?>