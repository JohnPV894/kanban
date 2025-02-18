<?php
require __DIR__ ."/../../vendor/autoload.php";


$clienteMongoDB = new MongoDB\Client("mongodb+srv://santiago894:P5wIGtXue8HvPvli@cluster0.6xkz1.mongodb.net/");

try{ 
      $dbs = $clienteMongoDB->listDatabases(); 
      #echo "conecto correctamente";
}
catch(Exception $e){
      echo "fallo al conectar a mongo";
      exit();
}

$BD_kanban= $clienteMongoDB->selectDatabase("kanban");
$coleccion_sesiones= $BD_kanban->selectCollection("sesiones");

function registrarUsuario($coleccion, $usuario, $clave) {
   if (empty($usuario) || empty($clave)) {
         echo "Faltan datos para el registro";
         return false;
   }

   // Verificar si el usuario ya existe
   $usuarioExistente = $coleccion->findOne(["usuario" => $usuario]);
   if ($usuarioExistente) {
         echo "El usuario ya está registrado";
         return false;
   }

   try {
         $nuevoUsuario = [
               "usuario" => $usuario,
               "clave" => $clave 
         ];

         $coleccion->insertOne($nuevoUsuario);
         return true;
   } catch (\Throwable $th) {
         echo "Error al registrar usuario";
         return false;
   }
}

// Detectar si la petición es para login o registro
if ($_SERVER["REQUEST_METHOD"] === "POST") {

         // PROCESO DE REGISTRO
         $registroExitoso = registrarUsuario($coleccion_sesiones, $_POST['usuario'], $_POST['clave']);
         if ($registroExitoso) {
               header("Location: http://localhost:3000/src/frontend/login.html");
               exit();
         }else{
               header("Location: http://localhost:3000/src/frontend/registro.html");
               exit();
         }
    
}


?>



