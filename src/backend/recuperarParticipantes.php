<?php
require __DIR__ ."/../../vendor/autoload.php";
#INICIAMOS session, Advertencia si no lo hacemos no podremos acceder a las mismas 
session_start();
echo json_encode($_SESSION["participantes"], JSON_PRETTY_PRINT);
?>