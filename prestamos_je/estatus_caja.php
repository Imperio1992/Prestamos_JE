<?php
session_start();
include("conexion.php");

$id_empleado = $_SESSION['id_personal'];

/* 💵 EFECTIVO (ENTRADAS - SALIDAS) */
$efectivo = $conexion->query("
SELECT IFNULL(SUM(
    CASE 
        WHEN tipo='ENTRADA' THEN monto
        ELSE -monto
    END
),0) total
FROM caja
WHERE id_empleado=$id_empleado
AND medio='EFECTIVO'
")->fetch_assoc()['total'];

/* 🏦 BANCO (SOLO ENTRADAS) */
$banco = $conexion->query("
SELECT IFNULL(SUM(monto),0) total
FROM caja
WHERE id_empleado=$id_empleado
AND medio='BANCO'
AND tipo='ENTRADA'
")->fetch_assoc()['total'];

/* 🧮 TOTAL */
$total_caja = $efectivo + $banco;
?>
