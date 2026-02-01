<?php
// 🔐 SOLO GERENTE
$roles_permitidos = ['GERENTE'];
include("seguridad.php");
include("conexion.php");

/*********************************
 * VALIDAR ID
 *********************************/
$id_cliente = intval($_GET['id'] ?? 0);
if ($id_cliente === 0) {
    header("Location: clientes.php");
    exit;
}

/*********************************
 * VALIDAR ESTADO Y FECHA
 *********************************/
$stmt = $conexion->prepare("
    SELECT estatus, fecha_desbloqueo
    FROM clientes
    WHERE id_cliente = ?
");
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$cliente = $stmt->get_result()->fetch_assoc();

$hoy = date('Y-m-d');

if (
    !$cliente ||
    $cliente['estatus'] !== 'BLOQUEADO' ||
    empty($cliente['fecha_desbloqueo']) ||
    $hoy < $cliente['fecha_desbloqueo']
) {
    header("Location: clientes.php");
    exit;
}

/*********************************
 * DESBLOQUEAR CLIENTE
 *********************************/
$stmt = $conexion->prepare("
    UPDATE clientes
    SET 
        estatus = 'ACTIVO',
        fecha_bloqueo = NULL,
        fecha_desbloqueo = NULL,
        dias_bloqueo = NULL,
        motivo_bloqueo = NULL
    WHERE id_cliente = ?
");
$stmt->bind_param("i", $id_cliente);
$stmt->execute();

/*********************************
 * REDIRECCIÓN
 *********************************/
header("Location: clientes.php?desbloqueado=1");
exit;
