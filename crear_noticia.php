<?php
session_start();
include("conexion.php");

// seguridad admin
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] !== "admin") {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel Admin - Benamahoma</title>
<link rel="icon" type="image/png" href="Imagenes/logo.png">
<link rel="apple-touch-icon" href="Imagenes/logo.png"> 
<link rel="stylesheet" href="css/index.css">

<style>
.container{
    max-width:1000px;
    margin:30px auto;
    padding:20px;
}

.card{
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
    margin-bottom:25px;
}
    
input, textarea{
    width:100%;
    padding:10px;
    margin:10px 0;
    border-radius:8px;
    border:1px solid #ccc;
}

button{
    background:#4682b4;
    color:white;
    padding:10px 15px;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

button:hover{
    background:#2c5f8a;
}

.noticia{
    padding:15px;
    margin:10px 0;
    border-bottom:1px solid #ddd;
}

.actions a{
    text-decoration:none;
    padding:5px 10px;
    border-radius:5px;
    color:white;
    margin-right:5px;
}

.edit{ background:#4682b4; }
.delete{ background:#e74c3c; }
</style>

</head>

<body>

<header>
  <a href="index.php">
    <img src="Imagenes/logo.png" class="logo">
  </a>

  <h1>Panel de Administración</h1>

</header>

<div class="container">

<!-- ================= CREAR NOTICIA ================= -->
<div class="card">
    <h2>📰 Crear nueva noticia</h2>

    <form action="guardar_noticia.php" method="POST" enctype="multipart/form-data">

        <input type="text" name="titulo" placeholder="Título de la noticia" required>

        <textarea name="contenido" placeholder="Contenido..." rows="5" required></textarea>

        <input type="file" name="imagen">

        <button type="submit">Publicar noticia</button>

    </form>
</div>

<!-- ================= LISTAR NOTICIAS ================= -->
<div class="card">
    <h2>📢 Noticias publicadas</h2>

    <?php
    $result = mysqli_query($conexion, "SELECT * FROM noticias ORDER BY fecha DESC");

    while($n = mysqli_fetch_assoc($result)){
    ?>

    <div class="noticia">

        <h3><?php echo htmlspecialchars($n["titulo"]); ?></h3>
        <small><?php echo $n["fecha"]; ?></small>

        <p><?php echo nl2br(htmlspecialchars($n["contenido"])); ?></p>

        <?php if(!empty($n["imagen"])){ ?>
            <img src="uploads/<?php echo $n["imagen"]; ?>" width="200">
        <?php } ?>

        <div class="actions">

            <a class="edit" href="editar_noticia.php?id=<?php echo $n['id']; ?>">
                ✏ Editar
            </a>

            <a class="delete"
               onclick="return confirm('¿Eliminar esta noticia?')"
               href="borrar_noticia.php?id=<?php echo $n['id']; ?>">
                🗑 Borrar
            </a>

        </div>

    </div>

    <?php } ?>

</div>

</div>

</body>
</html>