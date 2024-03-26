<?php

// Importacion de archivo de configuración PHP
include_once 'config.php';
require_once 'login_helper.php';

$tituloPagina = "Manejador de archivos"; // Variable para el título de la página (Sólo se usa una vez)

// Verifica que el usuario esté autenticado
if(!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
$esAdmin = $user['esAdmin'];

// Directorio para almacenamiento de archivos.
$directorio = "uploads/";
$archivos = array_diff(scandir($directorio), array('..', '.'));

?>

<!--Este archivo se llama login pero es el index de la aplicación, esto debido a problemas con xampp-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?=APP_ROOT?>css/styles.css" rel="stylesheet" type="text/css" /> 
    <title><?php echo $tituloPagina; ?></title>
</head>
<body>

    <div class="header">
        <h1><?php echo $tituloPagina; ?></h1>
    </div>
    
    <div class="header-container">
        <!-- Mario bros div-->
        <div class="brick one"></div>
        <div class="tooltip-mario-container">
            <div class="box"></div>
            <div class="mush"></div>
        </div>
        <div class="brick two"></div>
        <!-- End mario bros div-->
    </div>

    <div class="row">

        <div class="leftcolumn">
            <div id="subir-archivo" class="card">
                <?php if($esAdmin)?>
                <h2>Subir archivo</h2>
                <ul>
                    <li>Imágenes: jpg, jpeg, png, gif</li>
                    <li>Documentos: pdf</li>
                </ul>
                <form action="subir_archivo.php" method="post" enctype="multipart/form-data">
                <button>
                    <span class="transition"></span>
                    <span class="gradient"></span>
                    <span class="label">Subir archivo</span>
                </button>
            </div>

        </div> <!-- leftcolumn -->        


</body>
</html>