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
      #$login ;
      #$datosSesion;
      #$a = array("login"=>$login,"sesion"=>$datosSesion);
 
      if (empty($coleccion) || empty($usuario) || empty($clave)) {
           echo "Faltan parametros en la funcion validarSesion";
          # $a->login= false;
      }
      try {
            $consulta=$coleccion->findOne([
                  "usuario"=>$usuario
            ]);
            if ($consulta["clave"]===$clave) {
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
//function validarSesion($coleccion,$usuario,$clave) {
//      $login = false;
//      $datosSesion = false;
//      if (empty($coleccion) || empty($usuario) || empty($clave)) {
//      echo "Faltan parametros en la funcion validarSesion";
//      $login= false;
//      }
//      try {
//            $consulta=$coleccion->findOne([
//                  "usuario"=>$usuario
//            ]);
//            if ($consulta["clave"]===$clave) {
//                  $login= true;
//            }else{
//                  echo "contraseña o correo incorrecto";
//                  $login= false;
//
//            }
//      } catch (\Throwable $th) {
//            echo "contraseña o correo incorrecto";
//            $login= false;
//      } finally{
//            return array("login"=>$login,"sesion"=> $datosSesion);
//      }
//
//}




if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $comprobarCredencialesSesion = validarSesion($coleccion_sesiones,$_POST['usuario'],$_POST['clave']);
  
      if($comprobarCredencialesSesion==true){
            //Guardando en una sesion los datos del usuario para luego identificar facilmente que tarjetas puede ver 
            #Crear una sesion
            session_start();
            $consulta = $coleccion_sesiones->find([]);
            #Guardar datos del cliente
            $_SESSION["sesionActual"]=array();
            header("Location: http://localhost:3000/src/frontend/inicio.html");
            exit;
      }
} 
header("Location: http://localhost:3000/src/frontend/login.html");
            exit;
?>
