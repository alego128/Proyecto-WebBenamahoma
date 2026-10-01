<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST["usuario"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $password_confirm = $_POST["password_confirm"];

    if (empty($usuario) || empty($email) || empty($password) || empty($password_confirm)) {
        $error = "Todos los campos son obligatorios.";
    } elseif ($password !== $password_confirm) {
        $error = "Las contraseñas no coinciden.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Insertamos usuario con email y rol turista
        $stmt = mysqli_prepare($conexion, "INSERT INTO usuarios (usuario, email, password, rol) VALUES (?, ?, ?, 'turista')");
        mysqli_stmt_bind_param($stmt, "sss", $usuario, $email, $hash);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: login.php?registro=1");
            exit();
        } else {
            $error = "El usuario o correo ya existe, o hubo un error.";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Benamahoma</title>
    <link rel="icon" type="image/png" href="Imagenes/logo.png">
  	<link rel="apple-touch-icon" href="Imagenes/logo.png"> 
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<header>
    <a href="index.php">
        <img src="Imagenes/logo.png" alt="Logo de Benamahoma" class="logo" />
    </a>
    <h1>Área de Registro</h1>
</header>

<div class="login-container">
    <div class="login-box">
        <h2>Crear Cuenta</h2>

        <?php
        if (isset($error)) {
            echo "<p style='color:red; font-size:0.9rem;'>$error</p>";
        }
        ?>

        <form method="POST" action="">
            <label for="usuario"><b>Usuario</b></label>
            <input type="text" id="usuario" name="usuario" placeholder="Introduce tu usuario" required>

            <label for="email"><b>Correo electrónico</b></label>
            <input type="email" id="email" name="email" placeholder="ejemplo@correo.com" required>

            <label for="password"><b>Contraseña</b></label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>

            <label for="password_confirm"><b>Confirmar contraseña</b></label>
            <input type="password" id="password_confirm" name="password_confirm" placeholder="••••••••" required>

            <button type="submit" class="btn-entrar">Registrarse</button>
        </form>

        <p style="margin-top: 15px; font-size: 0.9rem; color: #2c3e50;">
            ¿Ya tienes cuenta?
            <a href="login.php" style="color: #4682b4; text-decoration: underline;">Inicia sesión aquí</a>
        </p>
    </div>
</div>

<footer>
    © 2026 Benamahoma | Registro de Usuarios
</footer>

</body>
</html>
