<?php
// 🔐 Solo GERENTE puede bloquear
$roles_permitidos = ['GERENTE'];
include("seguridad.php");

include("conexion.php");

// Validar que venga el ID
if (!isset($_GET['id'])) {
    echo "ID no válido";
    exit;
}

$id = intval($_GET['id']);

// Bloquear cliente
$conexion->query("
    UPDATE clientes 
    SET estatus = 'BLOQUEADO' 
    WHERE id_cliente = $id
");

// Redirigir con mensaje
header("Location: buscar_cliente.php");
exit;
