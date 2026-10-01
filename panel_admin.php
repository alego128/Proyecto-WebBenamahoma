<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Benamahoma</title>
    <link rel="icon" type="image/png" href="Imagenes/logo.png">
 	<link rel="apple-touch-icon" href="Imagenes/logo.png"> 
    <link rel="stylesheet" href="css/index.css">
    <style>
        .admin-content {
            padding: 50px 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        .welcome-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-top: 5px solid #4682b4;
        }
        .btn-logout {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 25px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn-logout:hover {
            background-color: #c0392b;
        }
        .admin-grid {
            display: flex;
            gap: 20px;
            margin-top: 30px;
            justify-content: center;
        }
        .admin-option {
            background: #eaf6ff;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #add8e6;
            flex: 1;
        }
    </style>
</head>
<body>

    <header>
        <a href="index.php">
            <img src="Imagenes/logo.png" alt="Logo" class="logo" />
        </a>
        <h1>Panel de Gestión</h1>
    </header>

    <div class="admin-content">
        <div class="welcome-card">
            <?php if(isset($_GET["ok"])) { ?>
    <div class="mensaje-ok">
        ✅ Noticia creada correctamente.
    </div>
<?php } ?>
            <h2>¡Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h2>
            <p>Desde aquí podrás gestionar los contenidos de la web de Benamahoma.</p>
            
            <div class="admin-grid">
                <div class="admin-option">
                    <h3>📢 Noticias</h3>
                    <a href="crear_noticia.php" class="btn-admin">➕ Crear o editar noticia</a>
                </div>

                <div class="admin-option">
                    <h3>📸 Galería</h3>
                    <p>Próximamente: Subir nuevas fotos del entorno.</p>
                </div>
            </div>

            <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
        </div>
    </div>


</body>
</html>