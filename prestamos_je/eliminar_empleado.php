<?php
// 🔐 SOLO GERENTE
$roles_permitidos = ['GERENTE'];
include("seguridad.php");
include("conexion.php");

// Validar ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: empleados.php");
    exit;
}

$id_empleado = intval($_GET['id']);

// 🔍 Verificar que exista el empleado
$existe = $conexion->prepare("
    SELECT id_empleado 
    FROM empleados 
    WHERE id_empleado = ?
");
$existe->bind_param("i", $id_empleado);
$existe->execute();
$res = $existe->get_result();

if ($res->num_rows === 0) {
    header("Location: empleados.php");
    exit;
}

// 🚫 Verificar si tiene préstamos asociados
$prestamos = $conexion->prepare("
    SELECT id_prestamo 
    FROM prestamos 
    WHERE id_empleado = ?
    LIMIT 1
");
$prestamos->bind_param("i", $id_empleado);
$prestamos->execute();
$tienePrestamos = $prestamos->get_result()->num_rows > 0;

if ($tienePrestamos) {
    // ❌ NO eliminar si tiene préstamos
    header("Location: empleados.php?error=prestamos");
    exit;
}

// 🗑️ ELIMINAR DEFINITIVAMENTE
$eliminar = $conexion->prepare("
    DELETE FROM empleados 
    WHERE id_empleado = ?
");
$eliminar->bind_param("i", $id_empleado);

if ($eliminar->execute()) {
    header("Location: empleados.php?eliminado=1");
} else {
    header("Location: empleados.php?error=1");
}

exit;
