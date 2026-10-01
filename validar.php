<?php
session_start();
include("conexion.php");

// Recoger datos del formulario
$user = $_POST["usuario"] ?? "";
$pass = $_POST["password"] ?? "";

// Comprobar que no estén vacíos
if (empty($user) || empty($pass)) {
    header("Location: login.php?error=1");
    exit();
}

// Buscar usuario en la base de datos (traemos password y rol)
$stmt = mysqli_prepare($conexion, "SELECT password, rol FROM usuarios WHERE usuario = ?");
mysqli_stmt_bind_param($stmt, "s", $user);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

// Verificar si existe el usuario
if ($fila = mysqli_fetch_assoc($resultado)) {

    // Verificar contraseña
    if (password_verify($pass, $fila["password"])) {

        // Guardar sesión
        $_SESSION["usuario"] = htmlspecialchars($user); // protección XSS
        $_SESSION["rol"] = $fila["rol"];

        // Redirigir según rol
        if ($fila["rol"] === "admin") {
            header("Location: panel_admin.php");
        } else {
            header("Location: index.php"); // usuarios normales van a la web
        }
        exit();
    }
}

// Si falla usuario o contraseña
header("Location: login.php?error=1");
exit();

// Cerrar conexiones
mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>
