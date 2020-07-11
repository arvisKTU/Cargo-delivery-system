<?php
//nustatymai.php

define("DB_SERVER", "localhost");
define("DB_USER", "stud");
define("DB_PASS", "stud");
define("DB_NAME", "stud");


$user_roles=array(      // vartotojų rolių vardai lentelėse ir  atitinkamos userlevel reikšmės
	"Administratorius"=>"4",
	"Uzsakovas"=>"3",
	"Vezejas"=>"2",);   // galioja ir vartotojas "guest", kuris neturi userlevel
define("DEFAULT_LEVEL","Vezejas");  // kokia rolė priskiriama kai registruojasi
define("MID_LEVEL","Uzsakovas");  // kokia rolė priskiriama kai registruojasi
define("ADMIN_LEVEL","Administratorius");  // kas turi vartotojų valdymo teisę

?>