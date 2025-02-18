<?php
session_start();
echo json_encode($_SESSION["sesionActual"],JSON_PRETTY_PRINT);
?>