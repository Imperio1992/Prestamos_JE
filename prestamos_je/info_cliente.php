<?php
include("conexion.php");

$id = $_GET['id'];

$cliente = $conexion->query("
    SELECT nombre, apellido, estatus 
    FROM clientes 
    WHERE id_cliente=$id
")->fetch_assoc();

$prestamos = $conexion->query("
    SELECT 
        SUM(total_pagar) AS total,
        IFNULL(SUM(p.monto_pagado),0) AS pagado
    FROM prestamos pr
    LEFT JOIN pagos p ON pr.id_prestamo = p.id_prestamo
    WHERE pr.id_cliente=$id AND pr.estado!='PAGADO'
")->fetch_assoc();

$saldo = $prestamos['total'] - $prestamos['pagado'];

echo "
<b>Cliente:</b> {$cliente['nombre']} {$cliente['apellido']}<br>
<b>Estatus:</b> {$cliente['estatus']}<br>
<b>Saldo pendiente:</b> $".number_format($saldo,2)."
";
?>
