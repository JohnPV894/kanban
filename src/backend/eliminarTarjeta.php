<?php
require __DIR__ . "/../../vendor/autoload.php";

$clienteMongoDB = new MongoDB\Client("mongodb+srv://santiago894:P5wIGtXue8HvPvli@cluster0.6xkz1.mongodb.net/");
$BD_kanban = $clienteMongoDB->selectDatabase("kanban");
$coleccion_tarjetas = $BD_kanban->selectCollection("tablero");

// ID en formato string
$idAEliminar = $_POST["idEliminar"]; 

// Llamar a la función
eliminarDocumentoPorId($coleccion_tarjetas, $idAEliminar);
function eliminarDocumentoPorId($coleccion, $idString) {
   if (empty($idString)) {
       echo "El ID proporcionado está vacío.";
       return false;
   }

   try {
       // Convertir el string a ObjectId
       $idObjeto = new MongoDB\BSON\ObjectId($idString);

       // Intentar eliminar el documento
       $resultado = $coleccion->deleteOne(["_id" => $idObjeto]);

   } catch (Exception $e) {
       echo "Error al eliminar el documento: " . $e->getMessage();
       return false;
   }
   return true;
}

// Llamar a la función
eliminarDocumentoPorId($coleccion_tarjetas, $idAEliminar);
header("Location: http://localhost:3000/src/frontend/inicio.html");
exit;
?>