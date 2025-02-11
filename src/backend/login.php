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

function validarSesion($coleccion,$usuario,$clave) {

 
      if (empty($coleccion) || empty($usuario) || empty($clave)) {
           echo "Faltan parametros en la funcion validarSesion";

      }
      try {
            $consulta=$coleccion->findOne([
                  "usuario"=>$usuario
            ]);
            if ($consulta["clave"]===$clave) {
            //Guardando en una sesion los datos del usuario para luego identificar facilmente que tarjetas puede ver 
                  #Crear una sesion
                  session_start();
                  #Organizar Datos del usuario
                  $datosUsuario= array(
                        "id" => (string) $consulta["_id"],
                        "usuario"=>$consulta["usuario"],
                        "clave"=>$consulta["clave"]
                  );
                  #Guardar datos del usuario
                  $_SESSION["sesionActual"]=$datosUsuario;
                  return true;
            }else{
                  echo "contraseña o correo incorrecto";
                  return false;

            }
      } catch (\Throwable $th) {
            echo "contraseña o correo incorrecto";
            return false;
      }
      


}




if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $comprobarCredencialesSesion = validarSesion($coleccion_sesiones,$_POST['usuario'],$_POST['clave']);
  
      if($comprobarCredencialesSesion==true){

            header("Location: http://localhost:3000/src/frontend/inicio.html");
            exit;
      }
} 
header("Location: http://localhost:3000/src/frontend/login.html");
            exit;
?>
