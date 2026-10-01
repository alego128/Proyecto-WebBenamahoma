<?php
session_start();
include("conexion.php");

if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] !== "admin") {
    header("Location: login.php");
    exit();
}

$titulo = $_POST["titulo"];
$contenido = $_POST["contenido"];

$imagen = "";

// subir imagen
if(isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0){

    if (!file_exists("uploads")) {
        mkdir("uploads", 0777, true);
    }

    $imagen = time() . "_" . basename($_FILES["imagen"]["name"]);

    move_uploaded_file(
        $_FILES["imagen"]["tmp_name"],
        "uploads/" . $imagen
    );
}

// INSERT seguro
$sql = "INSERT INTO noticias (titulo, contenido, imagen) VALUES (?, ?, ?)";

$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "sss", $titulo, $contenido, $imagen);

mysqli_stmt_execute($stmt);

// redirigir
header("Location: panel_admin.php?ok=1");
exit();
?>