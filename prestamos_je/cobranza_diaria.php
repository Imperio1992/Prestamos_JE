<?php
$roles_permitidos = ['GERENTE', 'ASESOR'];
include("seguridad.php");
include("conexion.php");

/* =========================
   ASESOR ACTIVO
========================= */
$asesor_seleccionado = $_GET['asesor'] ?? '';

if ($_SESSION['rol'] === 'ASESOR') {
    $asesor_seleccionado = $_SESSION['id_empleado'];
}

/* =========================
   LISTA ASESORES (GERENTE)
========================= */
$asesores = [];
if ($_SESSION['rol'] === 'GERENTE') {
    $res = $conexion->query("
        SELECT id_empleado, nombre, apellido
        FROM empleados
        WHERE rol='ASESOR' AND estatus='ACTIVO'
    ");
    while ($a = $res->fetch_assoc()) $asesores[] = $a;
}

/* =========================
   SI NO HAY ASESOR → NO DATOS
========================= */
$resumen = $cobradoHoy = $caja = ['0'=>0];
$prestamos = null;

if ($asesor_seleccionado != '') {

    /* =========================
       RESUMEN SOLO DEL ASESOR
    ========================= */
    $resumen = $conexion->query("
        SELECT 
            SUM(pr.total_pagar) AS total_prestamos,
            SUM(pr.pago_diario) AS total_cobro_diario,
            SUM(pr.total_pagar * 0.20 / 1.20) AS ganancia
        FROM prestamos pr
        WHERE pr.estado='ACTIVO'
          AND pr.id_empleado=".(int)$asesor_seleccionado
    )->fetch_assoc();

    /* =========================
       COBRADO HOY (ASESOR)
    ========================= */
    $cobradoHoy = $conexion->query("
        SELECT SUM(pa.monto_pagado) AS cobrado_hoy
        FROM pagos pa
        INNER JOIN prestamos pr ON pa.id_prestamo=pr.id_prestamo
        WHERE pa.fecha_pago=CURDATE()
          AND pr.id_empleado=".(int)$asesor_seleccionado
    )->fetch_assoc();

    /* =========================
       DINERO EN CAJA (ASESOR)
    ========================= */
    $caja = $conexion->query("
        SELECT 
            SUM(CASE WHEN tipo='ENTRADA' THEN monto ELSE 0 END) -
            SUM(CASE WHEN tipo='SALIDA' THEN monto ELSE 0 END) AS caja
        FROM caja
        WHERE id_empleado=".(int)$asesor_seleccionado
    )->fetch_assoc();

    /* =========================
       PRESTAMOS DEL ASESOR
    ========================= */
    $prestamos = $conexion->query("
        SELECT 
            pr.id_prestamo,
            c.nombre,
            c.apellido,
            pr.total_pagar,
            IFNULL(SUM(pa.monto_pagado),0) AS pagado,
            pr.pago_diario
        FROM prestamos pr
        INNER JOIN clientes c ON pr.id_cliente=c.id_cliente
        LEFT JOIN pagos pa ON pr.id_prestamo=pa.id_prestamo
        WHERE pr.estado='ACTIVO'
          AND pr.id_empleado=".(int)$asesor_seleccionado."
        GROUP BY pr.id_prestamo
    ");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Cobranza Diaria</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<?php include("menu.php"); ?>

<div class="container mt-4">

<?php if ($asesor_seleccionado != ''): ?>
<!-- =========================
     TARJETAS (SOLO ASESOR)
========================= -->
<div class="row mb-4">
<?php
$cards = [
    ["Total Préstamos", $resumen['total_prestamos'], 'primary'],
    ["Cobro Diario", $resumen['total_cobro_diario'], 'success'],
    ["Ganancia 20%", $resumen['ganancia'], 'warning'],
    ["Cobrado Hoy", $cobradoHoy['cobrado_hoy'], 'success'],
    ["Dinero en Caja", $caja['caja'], 'dark']
];
foreach ($cards as $c) { ?>
<div class="col-md-2">
<div class="card text-center">
<div class="card-body">
<h6><?= $c[0] ?></h6>
<h4 class="text-<?= $c[2] ?>">
$<?= number_format($c[1] ?? 0,2) ?>
</h4>
</div>
</div>
</div>
<?php } ?>
</div>
<?php endif; ?>

<div class="card shadow">
<div class="card-header bg-success text-white">
<h4>Cobranza Diaria</h4>
</div>
<div class="card-body">

<?php if ($_SESSION['rol'] === 'GERENTE'): ?>
<form method="GET" class="mb-3">
<select name="asesor" class="form-select" onchange="this.form.submit()">
<option value="">-- Selecciona asesor --</option>
<?php foreach ($asesores as $a): ?>
<option value="<?= $a['id_empleado'] ?>" <?= $asesor_seleccionado==$a['id_empleado']?'selected':'' ?>>
<?= $a['nombre']." ".$a['apellido'] ?>
</option>
<?php endforeach; ?>
</select>
</form>
<?php endif; ?>

<?php if ($asesor_seleccionado == ''): ?>
<div class="alert alert-info text-center">
Selecciona un asesor para ver su cobranza
</div>
<?php else: ?>

<form action="registrar_cobros.php" method="POST">
<table class="table table-bordered">
<thead class="table-dark">
<tr>
<th>Cliente</th>
<th>Total</th>
<th>Pagado</th>
<th>Saldo</th>
<th>Pago Diario</th>
<th>Cobro</th>
</tr>
</thead>
<tbody>

<?php while ($p = $prestamos->fetch_assoc()):
$saldo = $p['total_pagar'] - $p['pagado']; ?>
<tr>
<td><?= $p['nombre']." ".$p['apellido'] ?></td>
<td>$<?= number_format($p['total_pagar'],2) ?></td>
<td>$<?= number_format($p['pagado'],2) ?></td>
<td><b>$<?= number_format($saldo,2) ?></b></td>
<td>$<?= number_format($p['pago_diario'],2) ?></td>
<td>
<input type="number"
name="pagos[<?= $p['id_prestamo'] ?>]"
class="form-control form-control-sm"
min="0" max="<?= $saldo ?>">
</td>
</tr>
<?php endwhile; ?>

</tbody>
</table>

<button class="btn btn-success btn-lg">💰 Cobro</button>
</form>

<?php endif; ?>

</div>
</div>
</div>

</body>
</html>
