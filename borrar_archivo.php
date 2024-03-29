<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
$directorio = "archivos/";

if (isset($_GET['archivo'])) {
    $archivo = $_GET['archivo'];
    $rutaArchivo = $directorio . $archivo;

    if (file_exists($rutaArchivo)) {
        if (unlink($rutaArchivo)) {
            echo "El archivo '$archivo' se eliminó correctamente.";
        } else {
            echo "Error al intentar eliminar el archivo.";
        }
    } else {
        echo "El archivo '$archivo' no existe.";
    }
} else {
    echo "No se proporcionó un nombre de archivo.";
}
?>