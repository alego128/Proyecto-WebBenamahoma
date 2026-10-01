<?php
session_start();
include("conexion.php");

// Verificar que el usuario está logueado
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}

// Recoger datos del formulario
$comentario = $_POST["comentario"] ?? "";
$puntuacion = $_POST["puntuacion"] ?? "";

// Validar datos
if (empty($comentario) || empty($puntuacion)) {
    header("Location: index.php");
    exit();
}

// Obtener el ID del usuario logueado
$stmt = mysqli_prepare($conexion, "SELECT id FROM usuarios WHERE usuario = ?");
mysqli_stmt_bind_param($stmt, "s", $_SESSION["usuario"]);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$usuario = mysqli_fetch_assoc($resultado);

if (!$usuario) {
    header("Location: index.php");
    exit();
}

$usuario_id = $usuario["id"];

// Insertar reseña
$stmt = mysqli_prepare($conexion, 
    "INSERT INTO resenas (usuario_id, comentario, puntuacion) VALUES (?, ?, ?)"
);

mysqli_stmt_bind_param($stmt, "isi", $usuario_id, $comentario, $puntuacion);
mysqli_stmt_execute($stmt);

// Volver al inicio
header("Location: index.php");
exit();
?>