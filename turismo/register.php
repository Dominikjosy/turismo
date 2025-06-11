<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $correo, $contrasena);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success text-center mt-3'>Registro exitoso. <a href='login.php' class='alert-link'>Inicia sesión</a></div>";
    } else {
        echo "<div class='alert alert-danger text-center mt-3'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.10);
            padding: 2.5rem 2rem;
            max-width: 400px;
            width: 100%;
        }
        .register-title {
            font-weight: 700;
            color: #764ba2;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .btn-custom {
            background: linear-gradient(90deg, #667eea 60%, #764ba2 100%);
            color: #fff;
            border: none;
            border-radius: 20px;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 0.6rem 2rem;
            transition: background 0.2s, transform 0.2s;
        }
        .btn-custom:hover {
            background: linear-gradient(90deg, #5a67d8 60%, #6b21a8 100%);
            transform: scale(1.04);
        }
        .form-control:focus {
            border-color: #764ba2;
            box-shadow: 0 0 0 0.2rem #764ba250;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <h2 class="register-title">Crear Cuenta</h2>
        <form method="post">
            <div class="mb-3">
                <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
            </div>
            <div class="mb-3">
                <input type="email" name="correo" class="form-control" placeholder="Correo" required>
            </div>
            <div class="mb-4">
                <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-custom">Registrarse</button>
            </div>
        </form>
        <div class="text-center mt-3">
            <a href="index.php" class="text-decoration-none" style="color:#764ba2;font-weight:600;">
                ¿Ya tienes cuenta? Inicia sesión
            </a>
        </div>
    </div>
</body>
</html>
