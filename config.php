<?php

// Ruta de la aplicación.
define('APP_PATH', "/FileManager/");

// Ruta de almacenamiento de archivos
define('UPLOADS_DIR', __DIR__ . '/uploads');

// Archivos permitidos
$allowed_files = array('jpg', 'jpeg', 'png', 'gif', 'pdf');

// Función de verificación de archivos
function is_filetype_allowed($filename) {
    global $allowed_files;
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    return in_array(strtolower($ext), $allowed_files);
}

?>