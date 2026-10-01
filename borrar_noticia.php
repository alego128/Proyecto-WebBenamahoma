<?php
session_start();
include("conexion.php");

if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] !== "admin") {
    header("Location: login.php");
    exit();
}

$id = $_GET["id"];

$res = mysqli_query($conexion, "SELECT imagen FROM noticias WHERE id=$id");
$row = mysqli_fetch_assoc($res);

if($row["imagen"] != "" && file_exists("uploads/".$row["imagen"])){
    unlink("uploads/".$row["imagen"]);
}

mysqli_query($conexion, "DELETE FROM noticias WHERE id=$id");

header("Location: panel_admin.php");
exit();
?>