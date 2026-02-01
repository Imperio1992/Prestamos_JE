<?php
$roles_permitidos = ['GERENTE', 'ASESOR'];
include("seguridad.php");
include("conexion.php");
include("menu.php");

// ============================
// VALIDAR ID
// ============================
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Préstamo inválido");
}

$id = intval($_GET['id']);

// ============================
// DATOS DEL PRÉSTAMO
// ============================
$sql = "
    SELECT 
        pr.id_prestamo,
        c.nombre,
        c.apellido,
        pr.total_pagar,
        pr.pago_diario,
        IFNULL(SUM(pa.monto_pagado),0) AS pagado
    FROM prestamos pr
    INNER JOIN clientes c ON pr.id_cliente = c.id_cliente
    LEFT JOIN pagos pa ON pr.id_prestamo = pa.id_prestamo
    WHERE pr.id_prestamo = $id
    GROUP BY pr.id_prestamo
";

$prestamo = $conexion->query($sql)->fetch_assoc();

if (!$prestamo) {
    die("El préstamo no existe");
}

$saldo = $prestamo['total_pagar'] - $prestamo['pagado'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cobrar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Cobro de préstamo</h5>
    </div>

    <div class="card-body">

        <p><b>Cliente:</b> <?= $prestamo['nombre']." ".$prestamo['apellido'] ?></p>
        <p><b>Saldo actual:</b> $<?= number_format($saldo,2) ?></p>
        <p><b>Pago diario sugerido:</b> $<?= number_format($prestamo['pago_diario'],2) ?></p>

        <?php if ($saldo > 0) { ?>
        <form method="POST" action="registrar_pago.php">
            <input type="hidden" name="id_prestamo" value="<?= $prestamo['id_prestamo'] ?>">

            <label class="form-label">Monto recibido</label>
            <input type="number"
                   name="monto_pagado"
                   step="0.01"
                   class="form-control mb-3"
                   min="1"
                   max="<?= $saldo ?>"
                   required>

            <button class="btn btn-success">Registrar pago</button>
            <a href="cobranza_diaria.php" class="btn btn-secondary">Cancelar</a>
        </form>
        <?php } else { ?>
            <div class="alert alert-success">
                Este préstamo ya está totalmente pagado.
            </div>
            <a href="cobranza_diaria.php" class="btn btn-secondary">Regresar</a>
        <?php } ?>

    </div>
</div>

</div>

</body>
</html>
