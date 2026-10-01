<?php
session_start();

// Si el usuario ya inició sesión, redirigir según tipo
if (isset($_SESSION["usuario"])) {
    if ($_SESSION["tipo"] === "admin") {
        header("Location: panel_admin.php");
    } else {
        header("Location: index.php");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Acceso - Benamahoma</title>
    <link rel="icon" type="image/png" href="Imagenes/logo.png">
  	<link rel="apple-touch-icon" href="Imagenes/logo.png"> 
    <link rel="stylesheet" href="css/index.css" />
</head>
<body>

<header>
    <a href="index.php">
        <img src="Imagenes/logo.png" alt="Logo de Benamahoma" class="logo" />
    </a>
    <h1>Área de Acceso</h1>
</header>

<div class="login-container">
    <div class="login-box">
        <h2>Iniciar Sesión</h2>

        <?php
        if (isset($_GET["error"])) {
            echo "<p style='color:red; font-size:0.9rem;'>Usuario o contraseña incorrectos</p>";
        }
        if (isset($_GET["registro"])) {
            echo "<p style='color:green; font-size:0.9rem;'>Registro exitoso, ya puedes iniciar sesión</p>";
        }
        ?>

        <form action="validar.php" method="POST">
            <label for="usuario"><b>Usuario</b></label>
            <input type="text" id="usuario" name="usuario" placeholder="Introduce tu usuario" required>

            <label for="password"><b>Contraseña</b></label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>

            <button type="submit" class="btn-entrar">Entrar al Sistema</button>
        </form>

        <p style="margin-top: 15px; font-size: 0.9rem; color: #2c3e50;">
            ¿No tienes cuenta? 
            <a href="registro.php" style="color: #4682b4; text-decoration: underline;">Regístrate aquí</a>
        </p>

        <p style="margin-top: 20px; font-size: 0.8rem; color: #7f8c8d;">
            Acceso restringido a personal autorizado.
        </p>
    </div>
</div>

<footer>
    © 2026 Benamahoma | Panel de Control
</footer>

</body>
</html>
