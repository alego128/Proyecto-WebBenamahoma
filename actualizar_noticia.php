<?php
session_start();
include("conexion.php");

if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] !== "admin") {
    header("Location: login.php");
    exit();
}

$id = $_POST["id"];
$titulo = $_POST["titulo"];
$contenido = $_POST["contenido"];

// buscar imagen actual
$res = mysqli_query($conexion, "SELECT imagen FROM noticias WHERE id=$id");
$row = mysqli_fetch_assoc($res);

$imagen = $row["imagen"];

// si suben nueva imagen
if(isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0){

    if (!file_exists("uploads")) {
        mkdir("uploads", 0777, true);
    }

    $imagen = time() . "_" . basename($_FILES["imagen"]["name"]);

    move_uploaded_file($_FILES["imagen"]["tmp_name"], "uploads/".$imagen);
}

$sql = "UPDATE noticias 
        SET titulo=?, contenido=?, imagen=? 
        WHERE id=?";

$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "sssi", $titulo, $contenido, $imagen, $id);
mysqli_stmt_execute($stmt);

header("Location: panel_admin.php");
exit();
?>