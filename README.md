# 🛒 Tienda Online de Zapatillas – PHP

Proyecto desarrollado para el módulo **Desarrollo Web en Entorno Servidor** del ciclo formativo  
**Técnico Superior en Desarrollo de Aplicaciones Web (DAW)**.

La aplicación consiste en una tienda online de zapatillas deportivas desarrollada en PHP, siguiendo una arquitectura de tres capas y permitiendo la gestión de usuarios, productos y el proceso de compra.

---

## 🚀 Tecnologías utilizadas

- PHP 8
- MySQL / MariaDB
- HTML5
- CSS3
- Apache (XAMPP)
- GitHub

---

## 🧱 Arquitectura del proyecto

La aplicación está desarrollada siguiendo una **arquitectura de 3 capas**:

- **Capa de presentación**: HTML y CSS (carpeta `public`)
- **Capa de lógica de negocio**: PHP (controladores)
- **Capa de acceso a datos**: PHP + MySQL mediante PDO (modelos)

---

## 👥 Tipos de usuario

### Administrador
- Crear y eliminar productos
- Crear y eliminar usuarios
- Acceso al panel de administración

### Cliente
- Registro e inicio de sesión
- Visualización de productos
- Añadir productos al carrito
- Confirmar compra

---

## 📂 Estructura del proyecto

tienda-zapatillas-php/
│
├── app/
│ ├── config/
│ ├── controllers/
│ └── models/
│
├── public/
│ ├── admin/
│ ├── assets/
│ ├── index.php
│ ├── login.php
│ ├── register.php
│ └── cart.php
│
└── README.md

---

## 🔐 Control de sesiones

La aplicación utiliza **sesiones en PHP** para:
- Mantener el estado del usuario
- Controlar el acceso según el rol (admin / cliente)
- Proteger las rutas administrativas

---

## ▶️ Ejecución del proyecto

1. Clonar el repositorio
2. Copiar el proyecto en la carpeta `htdocs` de XAMPP
3. Importar la base de datos MySQL
4. Iniciar Apache y MySQL desde XAMPP
5. Acceder desde el navegador a:
http://localhost/Zapatillas/tienda-zapatillas-php/public

## ✍️ Autora

Proyecto realizado por Siwar Valentina Karoni Al Jouhari
Curso académico 2025–2026