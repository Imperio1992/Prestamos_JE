<?php
$roles_permitidos = ['GERENTE'];
include("seguridad.php");
include("conexion.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: empleados.php");
    exit;
}

$id = (int) $_GET['id'];

// 1️⃣ Dar de baja empleado
$conexion->query("
    UPDATE empleados 
    SET estatus = 'BAJA'
    WHERE id_empleado = $id
");

// 2️⃣ Deshabilitar usuario relacionado
$conexion->query("
    UPDATE usuarios
    SET estado = 0
    WHERE id_empleado = $id
");

header("Location: empleados.php");
exit;
