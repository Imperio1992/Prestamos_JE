<?php
include("conexion.php");

$id = $_GET['id'];

$conexion->query("
UPDATE prestamos 
SET estado='PAGADO' 
WHERE id_prestamo=$id
");

echo "Préstamo liquidado";
?>
