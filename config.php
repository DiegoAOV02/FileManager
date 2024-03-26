<?php

// ROOT DE LA APLICACIÓN
define('APP_ROOT', "/FileManager/");

// RUTA FÍSICA DE LA APLICACIÓN
define('APP_PATH', "/Applications/XAMPP/xamppfiles/htdocs/FileManager/");

// Ruta de almacenamiento de archivos
define('UPLOADS_DIR', "/Applications/XAMPP/xamppfiles/htdocs/FileManager/uploads/");

// Archivos permitidos
$allowed_files = array('jpg', 'jpeg', 'png', 'gif', 'pdf');

// Función de verificación de archivos
function is_filetype_allowed($filename) {
    global $allowed_files;
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    return in_array(strtolower($ext), $allowed_files);
}

?>