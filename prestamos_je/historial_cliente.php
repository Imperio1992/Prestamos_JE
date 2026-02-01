<?php
include("seguridad.php");
include("conexion.php");
include("menu.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial del Cliente | Préstamos JE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0">Historial de Cliente</h4>
    </div>

    <div class="card-body">

        <!-- BUSCAR CLIENTE POR NOMBRE -->
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-6">
                <input type="text" name="nombre" class="form-control"
                       placeholder="Nombre o apellido del cliente" required>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    Ver historial
                </button>
            </div>
        </form>

<?php
if (isset($_GET['nombre'])) {

    $nombre = $conexion->real_escape_string($_GET['nombre']);

    // BUSCAR CLIENTES (AHORA TRAEMOS MÁS DATOS)
    $clientes = $conexion->query("
        SELECT 
            id_cliente, 
            nombre, 
            apellido, 
            telefono,
            direccion,
            estatus
        FROM clientes
        WHERE nombre LIKE '%$nombre%'
           OR apellido LIKE '%$nombre%'
    ");

    if ($clientes->num_rows == 0) {
        echo "<div class='alert alert-danger'>Cliente no encontrado</div>";
        exit;
    }

    while ($c = $clientes->fetch_assoc()) {

        $id_cliente = $c['id_cliente'];
        $nombre_cliente = $c['nombre']." ".$c['apellido'];

        // 🔹 PANEL DE INFORMACIÓN DEL CLIENTE
        echo "
        <div class='card mb-3'>
            <div class='card-header bg-info text-white'>
                <b>Información del Cliente</b>
            </div>
            <div class='card-body'>
                <div class='row'>
                    <div class='col-md-6'>
                        <b>Cliente:</b> $nombre_cliente <br>
                        <b>ID Cliente:</b> $id_cliente <br>
                        <b>Teléfono:</b> {$c['telefono']} <br>
                        <b>Dirección:</b> {$c['direccion']}
                    </div>
                    <div class='col-md-6 text-end'>";

        // ESTATUS DEL CLIENTE
        if ($c['estatus'] === 'ACTIVO') {
            echo "<span class='badge bg-success'>ACTIVO</span>";
        } elseif ($c['estatus'] === 'MAL_HISTORIAL') {
            echo "<span class='badge bg-warning text-dark'>MAL HISTORIAL</span>";
        } else {
            echo "<span class='badge bg-danger'>BLOQUEADO</span>";
        }

        echo "<br><br>";

        // 🔹 BOTÓN NUEVO CRÉDITO (SOLO SI ESTÁ ACTIVO)
        if ($c['estatus'] === 'ACTIVO') {
            echo "
            <a href='nuevo_prestamo.php?id_cliente=$id_cliente'
               class='btn btn-success btn-sm'>
               ➕ Nuevo Crédito
            </a>";
        }

        echo "
                    </div>
                </div>
            </div>
        </div>
        ";

        // PRÉSTAMOS DEL CLIENTE
        $prestamos = $conexion->query("
            SELECT *
            FROM prestamos
            WHERE id_cliente = $id_cliente
            ORDER BY fecha_inicio DESC
        ");

        if ($prestamos->num_rows == 0) {
            echo "<div class='alert alert-warning'>
                    Este cliente no tiene préstamos
                  </div>";
        }

        while ($p = $prestamos->fetch_assoc()) {

            // TOTAL PAGADO
            $pagos = $conexion->query("
                SELECT IFNULL(SUM(monto_pagado),0) AS total_pagado
                FROM pagos
                WHERE id_prestamo = ".$p['id_prestamo']
            );

            $total_pagado = $pagos->fetch_assoc()['total_pagado'];
            $saldo = $p['total_pagar'] - $total_pagado;
?>

        <div class="card mb-3">
            <div class="card-body">

                <h6 class="text-primary">
                    Crédito #<?= $p['id_prestamo'] ?>
                </h6>

                <div class="row">
                    <div class="col-md-4">
                        <b>Monto:</b> $<?= number_format($p['monto_prestado'],2) ?><br>
                        <b>Total:</b> $<?= number_format($p['total_pagar'],2) ?><br>
                        <b>Pago diario:</b> $<?= number_format($p['pago_diario'],2) ?>
                    </div>

                    <div class="col-md-4">
                        <b>Pagado:</b> $<?= number_format($total_pagado,2) ?><br>
                        <b>Saldo:</b> <b>$<?= number_format($saldo,2) ?></b><br>
                        <b>Estado:</b> <?= $p['estado'] ?>
                    </div>

                    <div class="col-md-4">
                        <b>Fecha inicio:</b> <?= $p['fecha_inicio'] ?>
                    </div>
                </div>

<?php
        // BOTÓN RENOVAR (TU MISMA REGLA, SOLO MÁS LIMPIA)
        if ($total_pagado >= ($p['pago_diario'] * 18) && $p['estado'] == 'ACTIVO') {
            echo "
            <a href='nuevo_prestamo.php?renovar=".$p['id_prestamo']."'
               class='btn btn-warning btn-sm mt-2'>
               🔁 Renovar Préstamo
            </a>";
        }
?>

            </div>
        </div>

<?php
        }
    }
}
?>

    </div>
</div>

</div>

</body>
</html>
