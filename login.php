<?php 
// TODO: Implementar un inicio de sesión sencillo por medio de un input haga el subimt por medio de un formulario POST
sesion_start();

// Verifica si el usuario ya ha iniciado sesión
if(isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo APP_PATH; ?>css/styles.css">
    <title>Iniciar Sesión</title>
</head>
<body class="login-body">
    <div class="background"></div>
    <div class="card"></div>
        <img class="logo" src="imgs/login.svg" alt="Login icon"/>
        <h2>Iniciar Sesión</h2>
        <form class="form">
            <input type="email" placeholder="Username"/>
            <input type="password" placeholder="Password"/>
            <button>Entrar</button>
        </form>
        <footer>
            No estás registrado? <a href="register.php">Regístrate</a>
        </footer>
</body>
</html>
