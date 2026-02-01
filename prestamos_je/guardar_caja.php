<?php
session_start();
include("conexion.php");

$id_empleado = $_SESSION['id_personal'];
$monto   = floatval($_POST['monto']);
$tipo    = $_POST['tipo'];
$medio   = $_POST['medio'];
$concepto = $_POST['concepto'] ?? '';

// ❌ VALIDACIÓN CLAVE
if ($medio === 'BANCO' && $tipo === 'SALIDA') {
    echo "<script>
        alert('❌ En BANCO solo se permiten ENTRADAS');
        window.history.back();
    </script>";
    exit;
}

$stmt = $conexion->prepare("
    INSERT INTO caja (id_empleado, monto, tipo, medio, concepto)
    VALUES (?, ?, ?, ?, ?)
");

$stmt->bind_param("idsss",
    $id_empleado,
    $monto,
    $tipo,
    $medio,
    $concepto
);

$stmt->execute();

header("Location: estatus_caja.php");
