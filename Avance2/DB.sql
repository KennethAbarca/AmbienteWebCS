-- Crear la base de datos (si no existe)
CREATE DATABASE IF NOT EXISTS reduccion_desperdicio;
USE reduccion_desperdicio;

-- Tabla de Usuarios

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Tabla de Recetas
CREATE TABLE IF NOT EXISTS recetas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    instrucciones TEXT NOT NULL,
    ingredientes TEXT NOT NULL
);

-- Tabla de Donaciones
CREATE TABLE IF NOT EXISTS donaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_donante VARCHAR(255) NOT NULL,
    alimento VARCHAR(255) NOT NULL,
    cantidad INT NOT NULL,
    fecha DATE NOT NULL,
    punto_recoleccion VARCHAR(255) NOT NULL
);

 

INSERT INTO usuarios (nombre, email, password) VALUES
('Juan Pérez', 'juan@example.com', '$2y$10$EjemploDeHashDeContraseña'), 
('María Gómez', 'maria@example.com', '$2y$10$EjemploDeHashDeContraseña');


INSERT INTO recetas (nombre, instrucciones, ingredientes) VALUES
('Sopa de Verduras', 'Cocer verduras y agregar caldo', 'zanahoria, papa, cebolla'),
('Ensalada de Frutas', 'Cortar frutas y mezclar con miel', 'manzana, fresa, banana');


INSERT INTO donaciones (nombre_donante, alimento, cantidad, fecha, punto_recoleccion) VALUES
('Pedro López', 'Manzanas', 10, '2024-12-18', 'Paseo de las Flores'),
('Ana Ruiz', 'Tomates', 5, '2024-12-18', 'Lincoln Plaza');
