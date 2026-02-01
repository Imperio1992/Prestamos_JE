<?php
// 🔐 SOLO GERENTE
$roles_permitidos = ['GERENTE'];
include("seguridad.php");
include("conexion.php");

$id_cliente = intval($_GET['id'] ?? 0);
if ($id_cliente == 0) {
    header("Location: clientes.php");
    exit;
}

// VALIDAR QUE EXISTA
$existe = $conexion->query("
    SELECT id_cliente 
    FROM clientes 
    WHERE id_cliente = $id_cliente
");

if ($existe->num_rows == 0) {
    header("Location: clientes.php");
    exit;
}

// BLOQUEO POR MAL HISTORIAL
$conexion->query("
    UPDATE clientes
    SET estatus = 'MAL_HISTORIAL',
        fecha_bloqueo = CURDATE()
    WHERE id_cliente = $id_cliente
");

header("Location: clientes.php?bloqueado=1");
exit;
