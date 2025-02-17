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
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $propietarioTarjeta = $_SESSION["sesionActual"]["id"];
      $nombreTarjeta = $_POST["nombre"];
      $descripcionTarjeta = $_POST["descripcion"];
      $estadoTarjeta = "Idea";
      $participantesTarjeta = $_POST["participantes"];

      if (empty($nombreTarjeta) || empty($descripcionTarjeta) || empty($estadoTarjeta) || empty($participantesTarjeta)) {
            exit();
      };

      $nuevaTarjeta=array(
            "creador" =>$propietarioTarjeta,
            "nombre"=> $nombreTarjeta,
            "descripcion"=> $descripcionTarjeta,
            "estado"=> $estadoTarjeta,
            "participantes"=> $participantesTarjeta //Objetivo almacenar una lista de _id de las sesiones asosiadas a estar tarjeta
      );
      echo json_encode($nuevaTarjeta);
      $coleccion_sesiones->insertOne($nuevaTarjeta);

      header("Location: http://localhost:3000/src/frontend/inicio.html");
      exit;
} 
?>