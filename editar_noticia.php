<?php
session_start();
include("conexion.php");

if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] !== "admin") {
    header("Location: login.php");
    exit();
}

$id = $_GET["id"];

$result = mysqli_query($conexion, "SELECT * FROM noticias WHERE id=$id");
$noticia = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar noticia</title>
<link rel="icon" type="image/png" href="Imagenes/logo.png">
<link rel="apple-touch-icon" href="Imagenes/logo.png"> 
<link rel="stylesheet" href="css/index.css">

<style>
.container{
    max-width:700px;
    margin:30px auto;
    padding:20px;
}

.card{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
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
    border:none;
    padding:10px 15px;
    border-radius:8px;
    cursor:pointer;
    width:100%;
    font-weight:bold;
}

button:hover{
    background:#2c5f8a;
}

img{
    margin:10px 0;
    border-radius:10px;
}
</style>

</head>

<body>

<header>
  <a href="panel_admin.php">
    <img src="Imagenes/logo.png" class="logo">
  </a>

  <h1>Editar Noticia</h1>
</header>

<div class="container">

<div class="card">

<form action="actualizar_noticia.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?php echo $noticia['id']; ?>">

<label>Título</label>
<input type="text" name="titulo" value="<?php echo htmlspecialchars($noticia['titulo']); ?>" required>

<label>Contenido</label>
<textarea name="contenido" rows="6" required><?php echo htmlspecialchars($noticia['contenido']); ?></textarea>

<?php if(!empty($noticia["imagen"])){ ?>
    <p>Imagen actual:</p>
    <img src="uploads/<?php echo $noticia["imagen"]; ?>" width="200">
<?php } ?>

<input type="file" name="imagen">

<button type="submit">Actualizar noticia</button>

</form>

</div>

</div>

</body>
</html>