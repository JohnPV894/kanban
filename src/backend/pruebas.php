<?php
session_start();
if (!empty($_POST["participantes[]"])) {
      $participantesSeleccionados = array($_POST["participantes[]"]);
      echo json_encode($participantesSeleccionados); // Muestra un array con los valores seleccionados
}
?>