<?php
require __DIR__ . "/../../vendor/autoload.php";

$clienteMongoDB = new MongoDB\Client("mongodb+srv://santiago894:P5wIGtXue8HvPvli@cluster0.6xkz1.mongodb.net/");
$BD_kanban = $clienteMongoDB->selectDatabase("kanban");
$coleccion_tarjetas = $BD_kanban->selectCollection("tablero");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["idEditar"])) {
    $idTarjeta = $_POST["idEditar"];
    $nombre = $_POST["nombre"] ?? null;
    $descripcion = $_POST["descripcion"] ?? null;
    $estado = $_POST["estado"] ?? null;
    $participantes = $_POST["participantes"] ?? null;

    if (editarTarjeta($coleccion_tarjetas, $idTarjeta, $nombre, $descripcion, $estado, $participantes)) {
        header("Location: http://localhost:3000/src/frontend/inicio.html");
        exit;
    } else {
        echo "No se pudo actualizar la tarjeta.";
    }
} else {
    echo "Solicitud inválida.";
}

function editarTarjeta($coleccion, $idString, $nombre, $descripcion, $estado, $participantes) {
    if (empty($idString)) {
        echo "El ID proporcionado está vacío.";
        return false;
    }

    try {
        $idObjeto = new MongoDB\BSON\ObjectId($idString);

        // Crear un array con los campos a actualizar
        $datosActualizar = [];
        if ($nombre !== null) $datosActualizar["nombre"] = $nombre;
        if ($descripcion !== null) $datosActualizar["descripcion"] = $descripcion;
        if ($estado !== null) $datosActualizar["estado"] = $estado;
        if ($participantes !== null) $datosActualizar["participantes"] = $participantes;

        if (empty($datosActualizar)) {
            echo "No hay datos para actualizar.";
            return false;
        }

        $resultado = $coleccion->updateOne(
            ["_id" => $idObjeto], 
            ['$set' => $datosActualizar]
        );

        return $resultado->getModifiedCount() > 0;
    } catch (Exception $e) {
        echo "Error al actualizar la tarjeta: " . $e->getMessage();
        return false;
    }
}
header("Location: http://localhost:3000/src/frontend/inicio.html");
?>
