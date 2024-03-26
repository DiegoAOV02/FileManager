<?php 
session_start();
require 'config.php';
require_once 'login_helper.php';

// Verifica que el usuario no esté autenticado
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = autentificar($username, $password);

    if($user) {
        $_SESSION['user'] = $user;
        header('Location: index.php');
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=APP_ROOT?>css/login.css" rel="stylesheet" type="text/css">
    <title>File Manager</title>
</head>
<body>

<div class="container">
    <h1>Iniciar Sesión</h1>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <form id="iguales" action="login.php" method="post" class="login-form">

    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <div class="input-group">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" class="input-field">
    </div>
    <div class="input-group">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" class="input-field">
    </div>
    <br>
    <input type="submit" value="Iniciar Sesión" class="submit-button">
    </form>
</div>

</body>
</html>
