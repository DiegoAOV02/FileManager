<?php

require "config.php";

// Se obtiene el nombre del archivo a partir de la variable URL nombre.
$nombre = filter_input(INPUT_GET, "nombre");
if (!$nombre) {  // Si no existe el parámetro.
    http_response_code(400);  // Regresamos error 400 = Bad Request.
    exit();  // Fin de la ejecución.
}

// Obtenemos la ruta completa del archivo, en la carpeta de archivos subidos.
$rutaArchivo = DIR_UPLOAD . $nombre;
if (!file_exists($rutaArchivo)) {   // Si no exite el archivo.
    http_response_code(404);  // Regresamos error 404 = Not Found.
    exit();  // Fin de la ejecución.
}

$tamaño = filesize($rutaArchivo);  // Tamaño del archivo en bytes.
$extension = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));  // Extensión del archivo.

// Determinamos el content-type a partir de la extensión del archivo.
$contentType = 
        array_key_exists($extension, $CONTENT_TYPES_EXT) ? 
        $CONTENT_TYPES_EXT[$extension] : $CONTENT_TYPES_EXT["bin"];

// Especificamos el tipo de respuesta.
header("Content-Type: $contentType");

// Definimos un header que contiene el nombre del archivo.
header("Content-Disposition: inline; filename=\"$nombre\"");

// Enviamos el tamaño de la respuesta, que será el tamaño del archivo.
header("Content-Length: $tamaño");

// Enviamos el archivo como respuesta.
readfile($rutaArchivo);

// Verificar si se proporcionó el nombre del archivo
if (!isset($_GET['nombre'])) {
    die("Error: No se proporcionó el nombre del archivo.");
}

// Obtener el nombre del archivo desde la URL
$nombreArchivo = $_GET['nombre'];

// Mostrar el archivo si existe
if (file_exists("uploads/$nombreArchivo")) {
    // Mostrar el archivo según su tipo MIME
    $tipoMIME = mime_content_type("uploads/$nombreArchivo");
    header("Content-Type: $tipoMIME");
    readfile("uploads/$nombreArchivo");
} else {
    die("Error: El archivo no existe.");
}