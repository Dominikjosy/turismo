<?php
session_start();
include "db.php";

// Validar usuario
if (!isset($_SESSION["usuario"])) {
    $_SESSION["usuario"] = "Invitado";
}
$usuario = $_SESSION["usuario"];

// Precios de los platos
$precios = [
    'Ceviche' => 25,
    'Arroz Chaufa' => 45,
    'Tacu Tacu con Lomo' => 35,
    'Lomo Saltado' => 35
];

// Obtener reservas del usuario
$stmt = $conn->prepare("SELECT mesa, restaurante, plato FROM reservas WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

$reservas = [];
$total = 0;
while ($row = $result->fetch_assoc()) {
    $plato = $row['plato'] ?? '';
    $precio = isset($precios[$plato]) ? $precios[$plato] : 0;
    $row['precio'] = $precio;
    $total += $precio;
    $reservas[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago de Reserva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
        }
        .card {
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.10);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card p-4">
                    <h2 class="mb-4 text-center">Detalle de Pago</h2>
                    <?php if (count($reservas) === 0): ?>
                        <div class="alert alert-warning text-center">❌ No tienes mesas reservadas.</div>
                    <?php else: ?>
                        <ul class="list-group mb-3">
                            <?php foreach ($reservas as $res): ?>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Mesa <strong class="ms-2"><?php echo $res['mesa']; ?></strong>
                                    <span class="ms-3 badge bg-primary"><?php echo ucfirst($res['restaurante']); ?></span>
                                    <?php if (!empty($res['plato'])): ?>
                                        <span class="ms-3 badge bg-success"><?php echo htmlspecialchars($res['plato']); ?></span>
                                        <span class="ms-3 badge bg-warning text-dark">S/ <?php echo $res['precio']; ?></span>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="alert alert-info text-end">
                            <strong>Total a pagar: S/ <?php echo $total; ?></strong>
                        </div>
                    <?php endif; ?>
                    <div class="d-flex justify-content-center gap-2 mt-4">
                        <a href="menu.php" class="btn btn-primary">
                            <i class="bi bi-arrow-left"></i> Volver al menú
                        </a>
                        <a href="login.php" class="btn btn-success">
                            <i class="bi bi-house-door"></i> Ir al Inicio
                        </a>
                        <button type="button" class="btn btn-warning"
                            onclick="
                                <?php
                                    $hayReserva = count($reservas) > 0;
                                    $hayPago = false;
                                    foreach ($reservas as $res) {
                                        if (!empty($res['plato']) && isset($precios[$res['plato']]) && $precios[$res['plato']] > 0) {
                                            $hayPago = true;
                                            break;
                                        }
                                    }
                                    if (!$hayReserva) {
                                        echo "alert('No hay reserva, lo sentimos');";
                                    } elseif ($hayReserva && $hayPago && count($reservas) > 0) {
                                        echo "alert('¡Su pago y su reserva fueron exitosos!');";
                                    } elseif ($hayPago) {
                                        echo "alert('¡Su pago fue exitoso!');";
                                    } elseif ($hayReserva) {
                                        echo "alert('¡Su mesa fue reservada!');";
                                    }
                                ?>
                            ">
                            <i class="bi bi-cash-coin"></i> Pagar y Reservar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>