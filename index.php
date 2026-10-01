<?php
session_start();
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bienvenidos a Benamahoma</title>

  <link rel="icon" type="image/png" href="Imagenes/logo.png">
  <link rel="apple-touch-icon" href="Imagenes/logo.png"> 
  <link rel="stylesheet" href="css/index.css"/>
</head>
<body>

<header>
  <a href="index.php">
    <img src="Imagenes/logo.png" alt="Logo de Benamahoma" class="logo" />
  </a>
  
  <h1>Bienvenidos a Benamahoma</h1>

  <?php if(isset($_SESSION["usuario"])) { ?>
    <div class="header-login">

        👤 <?php echo htmlspecialchars($_SESSION["usuario"]); ?>

        <?php if(isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin") { ?>
            <a href="panel_admin.php" style="margin-left:10px; font-weight:bold; color:#4682b4;">
                🛠 Panel admin
            </a>
        <?php } ?>

        <a href="logout.php" style="margin-left:10px;">Cerrar sesión</a>
    </div>

<?php } else { ?>
      <a href="login.php" class="header-login">
          <span class="login-icon">👤</span>
          <span class="login-text">Acceso</span>
      </a>
  <?php } ?>
</header>

<div class="menu-container">
  <a href="historia.html" class="menu-card">
    <img src="Imagenes/Mapa.jpeg" alt="Historia" />
    <h2>Historia</h2>
  </a>

  <a href="fiestas.html" class="menu-card">
    <img src="Imagenes/20-04-15-Moros-y-cristianos-06.jpg" alt="Fiestas" />
    <h2>Fiestas</h2>
  </a>

  <a href="naturaleza.html" class="menu-card">
    <img src="Imagenes/nat.jpg" alt="Naturaleza" />
    <h2>Naturaleza</h2>
  </a>

  <a href="patrimonio.html" class="menu-card">
    <img src="Imagenes/andalucia.jpg" alt="Patrimonio" />
    <h2>Patrimonio</h2>
  </a>

  <a href="servicios.html" class="menu-card">
    <img src="Imagenes/gastronomia.jpg" alt="Servicios" />
    <h2>Servicios</h2>
  </a>
</div>

<section>
  <h2 style="color: #2c3e50; border-bottom: 2px solid #4682b4; padding-bottom: 0.5rem;">
    Mapa de Benamahoma
  </h2>
  <div style="display: flex; justify-content: center; padding: 1rem;">
    <iframe 
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3222.264694674938!2d-5.434379284747945!3d36.753829579957515!2m3!1f0!2f0!3f0!2f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dd6452d08c5ed%3A0x743f3f2b5aa19c47!2sBenamahoma%2C%20C%C3%A1diz!5e0!3m2!1ses!2ses!4v1684444444444" 
      width="80%" 
      height="400" 
      style="border:0; border-radius: 12px; box-shadow: 2px 2px 8px rgba(70,130,180,0.4);" 
      allowfullscreen="" 
      loading="lazy">
    </iframe>
  </div>
</section>

<!-- ================= NOTICIAS ================= -->

<h2 style="color: #2c3e50; text-align:center; margin-top:50px;">
    Últimas Noticias
</h2>

<section class="resenas">

<?php

$queryNoticias = "SELECT * FROM noticias ORDER BY fecha DESC LIMIT 4";

$resultNoticias = mysqli_query($conexion, $queryNoticias);

while($noticia = mysqli_fetch_assoc($resultNoticias)) {

?>

<div class="resena">

    <h3 style="color:#4682b4;">
        <?php echo htmlspecialchars($noticia["titulo"]); ?>
    </h3>

    <?php if($noticia["imagen"] != "") { ?>

        <img 
            src="uploads/<?php echo $noticia["imagen"]; ?>" 
            alt="Imagen noticia"
            style="
                width:100%;
                max-height:300px;
                object-fit:cover;
                border-radius:10px;
                margin:10px 0;
            "
        >

    <?php } ?>

    <p>
        <?php echo nl2br(htmlspecialchars($noticia["contenido"])); ?>
    </p>

    <small style="color:gray;">
        Publicado el <?php echo $noticia["fecha"]; ?>
    </small>

</div>

<?php } ?>

</section>

<!-- ================= RESEÑAS ================= -->
<h2 style="color: #2c3e50; text-align:center; margin-top:40px;">Reseñas de visitantes</h2>
<section class="resenas">

  <?php
  $query = "SELECT r.*, u.usuario 
            FROM resenas r 
            JOIN usuarios u ON r.usuario_id = u.id 
            ORDER BY r.fecha DESC";

  $resultado = mysqli_query($conexion, $query);

  while($fila = mysqli_fetch_assoc($resultado)) {
  ?>
      <div class="resena">
          <h4><?php echo htmlspecialchars($fila["usuario"]); ?></h4>
          <p><?php echo htmlspecialchars($fila["comentario"]); ?></p>
          <p class="estrellas">⭐ <?php echo $fila["puntuacion"]; ?>/5</p>
          <small><?php echo $fila["fecha"]; ?></small>
      </div>
  <?php } ?>
</section>

<?php if(isset($_SESSION["usuario"])) { ?>
<form action="guardar_resena.php" method="POST" class="form-resena">
    <textarea name="comentario" placeholder="Escribe tu reseña..." required></textarea>

    <select name="puntuacion" required>
        <option value="">Puntuación</option>
        <option value="1">1 ⭐</option>
        <option value="2">2 ⭐</option>
        <option value="3">3 ⭐</option>
        <option value="4">4 ⭐</option>
        <option value="5">5 ⭐</option>
    </select>

    <button type="submit">Enviar reseña</button>
</form>
<?php } else { ?>
    <p style="text-align:center; margin:30px 0;">
        <a href="login.php" class="btn-login-resena">
            🔐 Inicia sesión para dejar una reseña
        </a>
    </p>
<?php } ?>

<footer>
    <p>
        &copy; 2026 Benamahoma | Diseño inicial por Alejandro González.
    </p>

    <div class="footer-links">
        <a href="RGPD/privacidad.html">Política de Privacidad</a>

        <a href="RGPD/cookies.html">Política de Cookies</a>

        <a href="RGPD/avisolegal.html">Aviso Legal</a>

        <a href="RGPD/proteccionDatos.html">Protección de datos</a>
    </div>
</footer>

</body>
</html>