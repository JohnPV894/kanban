<?php
session_start();
if (empty($_SESSION["sesionActual"])) {
      header("Location: http://localhost:3000/src/frontend/login.html");
      exit;
}
header("Location: http://localhost:3000/src/frontend/inicio.html");
?>