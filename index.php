<?php
session_start();
require_once 'login_helper.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
$esAdmin = $user['esAdmin'];

// Directorio donde se almacenan los archivos
$directorio = "uploads/";
$archivos = array_diff(scandir($directorio), array('..', '.'));

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Archivos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Administrador de Archivos</h1>

        <?php if ($esAdmin): ?>
            <div class="form-container">
                <br>
                <h2>Subir Nuevo Archivo</h2>
                <form action="subir_archivo.php" method="post" enctype="multipart/form-data" class="form-container">
                    <div class="file-input-container">
                        <input type="file" name="file" id="file" required>
                    </div>
                    <div class="nombre_arch">
                        <input type="text" name="nombre" placeholder="Nombre del archivo (opcional)">
                    </div>
                    <input type="submit" value="Subir" class="submit-button">
                </form>
            </div>
        <?php endif; ?>

        <h2>Listado de Archivos</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre del Archivo</th>
                    <th>Tamaño del Archivo (KB)</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!is_null($archivos)) {
                    foreach ($archivos as $archivo) {
                        $rutaArchivo = $directorio . $archivo;
                        $tamañoKB = round(filesize($rutaArchivo) / 1024, 2); 
                        echo "<tr>";
                        echo "<td><a href='$rutaArchivo'>$archivo</a></td>";
                        echo "<td>$tamañoKB KB</td>";
                        if ($esAdmin) {
                            echo "<td><button class='delete-button' onclick='deleteFile(\"$archivo\")'>Eliminar</button></td>";
                        } else {
                            echo "<td>No tiene permisos</td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No hay archivos para mostrar.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <a href="logout.php" class="logout-button">Cerrar Sesión</a>

    <script>
        function deleteFile(filename) {
            if (confirm("¿Desea borrar el archivo " + filename + "?")) {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "borrar_archivo.php?archivo=" + filename, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert(xhr.responseText); 
                        location.reload(); // Recargar la página lol
                    }
                };
                xhr.send();
            }
        }
    </script>
</body>
</html>