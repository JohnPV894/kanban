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
/*
if (!class_exists('MongoDB\BSON\ObjectId')) {
      die('La clase MongoDB\BSON\ObjectId no está disponible.');
  }
*/
$BD_kanban= $clienteMongoDB->selectDatabase("kanban");
$coleccion_sesiones= $BD_kanban->selectCollection("tablero");

#if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $id = trim("67a4fd87ac86dba1082add60");

      $idTarjeta = new MongoDB\BSON\ObjectId($id);

      
      echo json_encode( $coleccion_sesiones->findOne(["_id"=>$idTarjeta]) );
      #header("Location: http://localhost:3000/src/frontend/inicio.html");
      exit;
#} 

#Verificar que se solicite una peticion POST al servidor
if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $id = $_POST["id"];
      $titulo = $_POST["nombre"];
      $descripcion = $_POST["descripcion"];
      
}


#Hacer una consulta a la bd datos reemplazamos todos los datos por los nuevos datos donde la ID sea igual que la id que recibe  
/*
 */
?>