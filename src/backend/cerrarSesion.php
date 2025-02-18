<?php
if ($_SERVER["REQUEST_METHOD"] === "GET") {
   session_start(); // iniciamos las sessiones


   session_destroy(); //destruye la session
   
   // Redirigir al usuario a la página de inicio
   header("Location: http://localhost:3000/src/frontend/login.html");
   exit;
}

?>