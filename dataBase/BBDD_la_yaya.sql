CREATE TABLE Usuario (
    ID_Usuario INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Apellidos VARCHAR(50) NOT NULL,
    Usuario VARCHAR (50) NOT NULL UNIQUE,
    CorreoElectronico VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    FechaRegistro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Rol ENUM('Admin', 'Usuario', 'Moderador') DEFAULT 'Usuario'
);
CREATE TABLE Supermercado (
    ID_Supermercado INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Direccion TEXT NULL,
    Ciudad VARCHAR(50) NOT NULL,
    Pais VARCHAR(50) NOT NULL
);

CREATE TABLE Categoria (
    ID_Categoria INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE Producto (
    ID_Producto INT AUTO_INCREMENT PRIMARY KEY,
    NombreProducto VARCHAR(100) NOT NULL,
    Descripcion TEXT NULL,
    ID_Categoria INT NOT NULL,
    Marca VARCHAR(50) NULL,
    FOREIGN KEY (ID_Categoria) REFERENCES Categoria(ID_Categoria)
);

CREATE TABLE PrecioProducto (
    ID_Precio INT AUTO_INCREMENT PRIMARY KEY,
    ID_Producto INT NOT NULL,
    ID_Supermercado INT NOT NULL,
    Precio DECIMAL(10,2) NOT NULL,
    FechaRegistro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ID_Usuario INT NOT NULL, 
    FOREIGN KEY (ID_Producto) REFERENCES Producto(ID_Producto),
    FOREIGN KEY (ID_Supermercado) REFERENCES Supermercado(ID_Supermercado),
    FOREIGN KEY (ID_Usuario) REFERENCES Usuario(ID_Usuario)
);

CREATE TABLE ListaCompra (
    ID_Lista INT AUTO_INCREMENT PRIMARY KEY,
    ID_Usuario INT NOT NULL,
    NombreLista VARCHAR(100) NOT NULL,
    FechaCreacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ID_Usuario) REFERENCES Usuario(ID_Usuario)
);

CREATE TABLE ListaProductos (
    ID_Lista INT NOT NULL,
    ID_Producto INT NOT NULL,
    Cantidad INT NOT NULL DEFAULT 1,
    PRIMARY KEY (ID_Lista, ID_Producto),
    FOREIGN KEY (ID_Lista) REFERENCES ListaCompra(ID_Lista),
    FOREIGN KEY (ID_Producto) REFERENCES Producto(ID_Producto)
);

-- Ejemplos de campos de las tablas

INSERT INTO Usuario (Nombre, Apellidos, Usuario, CorreoElectronico, Contrasena) VALUES
('Carlos', 'López', 'carloslopez', 'carlos.lopez@email.com', '***'),
('Ana', 'Martínez', 'anamartinez', 'ana.martinez@email.com', '***'),
('Pedro', 'Gómez', 'pedrogomez', 'pedro.gomez@email.com', '***');

INSERT INTO Supermercado (Nombre, Direccion, Ciudad, Pais) VALUES
('Supermercado A', 'Calle 123', 'Madrid', 'España'),
('Supermercado B', 'Avenida Principal 45', 'Barcelona', 'España'),
('Supermercado C', 'Plaza Mayor 7', 'Valencia', 'España');

INSERT INTO Categoria (Nombre) VALUES
('Lácteos'),
('Carnes'),
('Bebidas');

INSERT INTO Producto (NombreProducto, Descripcion, ID_Categoria, Marca) VALUES
('Leche Entera', 'Leche entera 1L', 1, 'Marca A'),
('Pechuga de Pollo', 'Pechuga de pollo fresca', 2, 'Marca B'),
('Coca-Cola 2L', 'Refresco de cola 2 litros', 3, 'Coca-Cola');


INSERT INTO PrecioProducto (ID_Producto, ID_Supermercado, Precio, ID_Usuario) VALUES
(1, 1, 1.20, 1), -- Leche en Supermercado A
(1, 2, 1.15, 2), -- Leche en Supermercado B
(2, 1, 5.50, 3), -- Pechuga de pollo en Supermercado A
(3, 3, 2.00, 1); -- Coca-Cola en Supermercado C


INSERT INTO ListaCompra (ID_Usuario, NombreLista) VALUES
(1, 'Compra semanal'),
(2, 'Cena especial'),
(3, 'Desayuno saludable');


INSERT INTO ListaProductos (ID_Lista, ID_Producto, Cantidad) VALUES
(1, 1, 2), -- 2 unidades de leche en "Compra semanal"
(1, 3, 1), -- 1 Coca-Cola en "Compra semanal"
(2, 2, 3); -- 3 Pechugas de pollo en "Cena especial"


