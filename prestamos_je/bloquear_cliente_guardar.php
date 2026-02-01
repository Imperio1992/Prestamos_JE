<?php
$roles_permitidos = ['GERENTE', 'SUPERVISOR'];
include("seguridad.php");
include("conexion.php");

$id_cliente = intval($_POST['id_cliente'] ?? 0);
$duracion   = intval($_POST['duracion'] ?? 0);

if ($id_cliente == 0 || $duracion == 0) {
    header("Location: clientes.php");
    exit;
}

$fecha_bloqueo = date('Y-m-d');
$fecha_fin = date('Y-m-d', strtotime("+$duracion days"));

$conexion->query("
    UPDATE clientes
    SET estatus = 'BLOQUEADO',
        fecha_bloqueo = '$fecha_bloqueo'
    WHERE id_cliente = $id_cliente
");

header("Location: clientes.php?bloqueado=1");
exit;
