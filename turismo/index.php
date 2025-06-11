<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg,rgb(110, 130, 196) 0%,rgb(54, 99, 143) 100%);
      min-height: 100vh;
    }
    .login-card {
      border-radius: 18px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.10);
      background: #fff;
      border: 2px solid #0d6efd1a;
    }
    .btn-info {
      background: linear-gradient(90deg, #0d6efd 60%, #4f8cff 100%);
      border: none;
      font-weight: 600;
      letter-spacing: 0.5px;
      border-radius: 20px;
      box-shadow: 0 2px 8px #0d6efd33;
      transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
    }
    .btn-info:hover {
      background: linear-gradient(90deg, #2563eb 60%, #60a5fa 100%);
      color: #fff;
      transform: scale(1.04);
      box-shadow: 0 4px 16px #0d6efd44;
    }
    .login-img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
      margin: 0 auto 18px auto;
      display: block;
      box-shadow: 0 2px 12px #0d6efd33;
      border: 3px solid #0d6efd33;
      background: #e0e7ff;
    }
    .input-group-text {
      font-size: 1.3rem;
      border-radius: 12px 0 0 12px;
    }
    .form-control {
      border-radius: 0 12px 12px 0;
    }
    .register-link {
      transition: color 0.2s;
    }
    .register-link:hover {
      color: #2563eb !important;
      text-decoration: underline !important;
    }
  </style>
</head>
<body style="min-height:100vh;">
  <div class="d-flex align-items-center justify-content-center" style="min-height:100vh;">
    <div class="card p-4 shadow login-card" style="width: 25rem;">
      <img src="img/logo.jpg" alt="Usuario" class="login-img">
      <h4 class="mb-4 text-center text-primary fw-bold">Iniciar Sesión</h4>
      <form action="login.php" method="post">
        <div class="input-group mb-3">
          <span class="input-group-text bg-info text-white">📧</span>
          <input type="text" class="form-control" name="usuario" placeholder="Correo" required>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text bg-info text-white">🔒</span>
          <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required>
        </div>
        <button type="submit" class="btn btn-info text-white w-100 mb-2">
          <i class="bi bi-box-arrow-in-right"></i> ENTRAR
        </button>
      </form>
      <div class="text-center mt-2">
        <a href="register.php" class="text-decoration-none text-info fw-semibold register-link">
          <i class="bi bi-person-plus"></i> Regístrate
        </a>
      </div>
      <div class="text-center mt-3">
        <!-- Botón para mostrar la encuesta -->
        <button class="btn btn-success fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#modalEncuesta">
          <i class="bi bi-clipboard-check"></i> Encuesta
        </button>
      </div>

      <!-- Modal de la encuesta -->
      <div class="modal fade" id="modalEncuesta" tabindex="-1" aria-labelledby="modalEncuestaLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content" style="border-radius:18px;">
            <div class="modal-header">
              <h5 class="modal-title" id="modalEncuestaLabel">Encuesta de Satisfacción</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="enviar_encuesta.php">
                  <div class="mb-3">
                      <label class="form-label">¿Cómo calificarías nuestra página?</label>
                      <select name="calificacion" class="form-select" required>
                          <option value="">Selecciona una opción</option>
                          <option value="Excelente">Excelente</option>
                          <option value="Buena">Buena</option>
                          <option value="Regular">Regular</option>
                          <option value="Mala">Mala</option>
                      </select>
                  </div>
                  <div class="mb-3">
                      <label class="form-label">¿Qué te gustaría mejorar?</label>
                      <textarea name="comentario" class="form-control" rows="3" placeholder="Tu comentario..."></textarea>
                  </div>
                  <div class="mb-3">
                      <label class="form-label">Tu correo (opcional):</label>
                      <input type="email" name="correo" class="form-control" placeholder="ejemplo@correo.com">
                  </div>
                  <div class="d-grid">
                      <button type="submit" class="btn btn-info text-white fw-bold" style="border-radius: 20px;">
                          <i class="bi bi-send"></i> Enviar Encuesta
                      </button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Agrega Bootstrap JS si no lo tienes ya -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </div>
  </div>
</body>
</html>