<?php
// 🔐 SOLO GERENTE
$roles_permitidos = ['GERENTE'];
include("seguridad.php");
include("conexion.php");

// SOLO POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: empleados.php");
    exit;
}

// Datos
$id  = $_POST['id'] ?? 0;
$rol = $_POST['rol'] ?? '';

// Roles válidos
$roles_validos = ['ASESOR','SUPERVISOR','GERENTE'];

if ($id == 0 || !in_array($rol, $roles_validos)) {
    header("Location: empleados.php?error=1");
    exit;
}

// Actualizar rol
$stmt = $conexion->prepare("
    UPDATE empleados
    SET rol = ?
    WHERE id_empleado = ?
    AND estatus = 'ACTIVO'
");

if (!$stmt) {
    die("Error en prepare: " . $conexion->error);
}

$stmt->bind_param("si", $rol, $id);
$stmt->execute();

// Regresar
header("Location: empleados.php?ok=1");
exit;
