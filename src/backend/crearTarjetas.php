<?php
require __DIR__ ."/../../vendor/autoload.php";


$clienteMongoDB = new MongoDB\Client("mongodb+srv://santiago894:P5wIGtXue8HvPvli@cluster0.6xkz1.mongodb.net/");;

try{ 
      $dbs = $clienteMongoDB->listDatabases(); 
      #echo "conecto correctamente";
}
catch(Exception $e){
      echo "fallo al conectar a mongo";
      exit();
}

$BD_kanban= $clienteMongoDB->selectDatabase("kanban");
$coleccion_sesiones= $BD_kanban->selectCollection("tablero");

?>