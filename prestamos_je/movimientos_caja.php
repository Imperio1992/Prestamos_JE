<?php
session_start();
include("seguridad.php");
include("conexion.php");

$id_empleado = $_SESSION['id_empleado'] ?? 0;

/* =========================
   PROCESAR FORMULARIOS
========================= */
if (isset($_POST['accion'])) {

    $monto = floatval($_POST['monto']);

    /* ===== INGRESO EFECTIVO ===== */
    if ($_POST['accion'] === 'ingreso_efectivo') {

        $stmt = $conexion->prepare("
            INSERT INTO caja (tipo, monto, concepto, medio, id_empleado)
            VALUES ('ENTRADA', ?, 'INGRESO EFECTIVO', 'EFECTIVO', ?)
        ");
        $stmt->bind_param("di", $monto, $id_empleado);
        $stmt->execute();
    }

    /* ===== INGRESO BANCO ===== */
    if ($_POST['accion'] === 'ingreso_banco') {

        $stmt = $conexion->prepare("
            INSERT INTO caja (tipo, monto, concepto, medio, id_empleado)
            VALUES ('ENTRADA', ?, 'INGRESO BANCO', 'BANCO', ?)
        ");
        $stmt->bind_param("di", $monto, $id_empleado);
        $stmt->execute();
    }

    /* ===== GASTOS / DEDUCCIONES ===== */
    if ($_POST['accion'] === 'gasto') {

        $concepto = $_POST['concepto'];
        $medio    = $_POST['medio'];

        $stmt = $conexion->prepare("
            INSERT INTO caja (tipo, monto, concepto, medio, id_empleado)
            VALUES ('SALIDA', ?, ?, ?, ?)
        ");
        $stmt->bind_param("dssi", $monto, $concepto, $medio, $id_empleado);
        $stmt->execute();
    }
}

/* =========================
   TOTALES
========================= */
function totalCaja($conexion, $id, $medio = null) {
    $filtro = $medio ? "AND medio='$medio'" : "";
    return $conexion->query("
        SELECT IFNULL(SUM(CASE WHEN tipo='ENTRADA' THEN monto ELSE -monto END),0) total
        FROM caja WHERE id_empleado=$id $filtro
    ")->fetch_assoc()['total'];
}

$efectivo = totalCaja($conexion, $id_empleado, 'EFECTIVO');
$banco    = totalCaja($conexion, $id_empleado, 'BANCO');
$caja     = $efectivo + $banco;
?>
