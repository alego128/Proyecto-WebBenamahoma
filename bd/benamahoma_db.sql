-- Crear base de datos
CREATE DATABASE IF NOT EXISTS benamahoma_db 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;

USE benamahoma_db;

-- Crear tabla usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(20) NOT NULL DEFAULT 'turista',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar usuario alejandro (admin)
-- Contraseña: alego
INSERT INTO usuarios (usuario, email, password, rol) VALUES 
('alejandro', 'ale.gonzalez.roman@gmail.com', '$2y$10$wL6MSYhfu2bRq0X3t7A5ROkb3h5s1JeS3/T0wG7OZ9tH6Js8v3tK2', 'admin');

-- Insertar usuario profesor (admin)
-- Contraseña: profe
INSERT INTO usuarios (usuario, email, password, rol) VALUES 
('profesor', 'profesor@gmail.com', '$2y$10$xOm9g9YAuyZjzmQ/3C1fgO/U2zSfVjIJc5n/LdFv9NVeMGvdXOEHO', 'admin');

-- Crear tabla reseñas
CREATE TABLE resenas (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT UNSIGNED NOT NULL,
    comentario TEXT NOT NULL,
    puntuacion INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;