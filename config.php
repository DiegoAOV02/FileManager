<?php

// ROOT DE LA APLICACIÓN
define("APP_ROOT", "FileManager/");

// RUTA FÍSICA DE LA APLICACIÓN
define("APP_PATH", "/Applications/XAMPP/xamppfiles/htdocs/FileManager/");

// Ruta de almacenamiento de archivos
define("DIR_UPLOAD", "/Applications/XAMPP/xamppfiles/htdocs/FileManager/archivos/");

// Archivos permitidos
$CONTENT_TYPEX_EXT = [
    "jpg" => "image/jpeg",
    "jpeg" => "image/jpeg",
    "gif" => "image/gif",
    "png" => "image/png",
    "json" => "application/json",
    "pdf" => "application/pdf",
    "bin" => "application/octet-stream"
];