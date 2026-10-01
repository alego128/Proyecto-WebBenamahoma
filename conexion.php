<?php
$servidor = "sql111.infinityfree.com";
$usuario_db = "if0_41848609";
$pass_db = "TheKillerr128";
$nombre_db = "if0_41848609_Benamahoma_db";

$conexion = mysqli_connect($servidor, $usuario_db, $pass_db, $nombre_db);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conexion, "utf8mb4");
?>