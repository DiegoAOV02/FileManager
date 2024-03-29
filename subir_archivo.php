<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
$esAdmin = $user['esAdmin'];

// Para que el folder de archivos pueda ser manipulable, es necesario darle los permisos con los siguientes comandos:
/* 
    chmod -R 777 archivos/ 
*/

$directorio = "archivos/";

// Verificar si se ha enviado un archivo
if (isset($_FILES['file'])) {
    $nombreArchivo = $_FILES['file']['name'];
    $tipoArchivo = $_FILES['file']['type'];
    $tamañoArchivo = $_FILES['file']['size'];
    $nombreGuardado = isset($_POST['nombre']) && !empty($_POST['nombre']) ? $_POST['nombre'] : $nombreArchivo;

    // Validar que sea el tipo de archivo que se permite
    $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
    $permitidos = array('jpg', 'jpeg', 'png', 'gif', 'pdf');
    if (!in_array($extension, $permitidos)) {
        echo ("Error: Solo se permiten archivos de Imagen y PDF.");
    }

    // El archivo no puede tener el mismo nombre que otro, mandar advertencia
    if (file_exists($directorio . $nombreGuardado)) {
        echo "Advertencia: Ya existe un archivo con el nombre '$nombreGuardado'. Por favor, cambie el nombre del archivo.";
    } else {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $directorio . $nombreGuardado)) {
            echo "El archivo se subió correctamente.";
            header('Location: index.php');
            exit;
        } else {
            echo "Error no se subió correctamente el archivo.";
        }
    }
}
?>