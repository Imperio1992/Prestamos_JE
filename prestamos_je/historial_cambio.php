<?php
$roles_permitidos = ['GERENTE'];
include("seguridad.php");
include("conexion.php");

$historial = $conexion->query("
    SELECT 
        h.fecha,
        c.nombre,
        c.apellido,
        u1.usuario AS anterior,
        u2.usuario AS nuevo,
        u3.usuario AS autorizado
    FROM historial_clientes h
    INNER JOIN clientes c ON h.id_cliente = c.id_cliente
    INNER JOIN usuarios u1 ON h.asesor_anterior = u1.id_usuario
    INNER JOIN usuarios u2 ON h.asesor_nuevo = u2.id_usuario
    INNER JOIN usuarios u3 ON h.autorizado_por = u3.id_usuario
    ORDER BY h.fecha DESC
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Cambios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">

<?php include("menu.php"); ?>

<div class="card shadow">
    <div class="card-header bg-dark text-white">
        <h4>Historial de Migraciones</h4>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Cliente</th>
                <th>Antes</th>
                <th>Ahora</th>
                <th>Autorizó</th>
                <th>Fecha</th>
            </tr>

            <?php while ($h = $historial->fetch_assoc()) { ?>
            <tr>
                <td><?= $h['nombre']." ".$h['apellido'] ?></td>
                <td><?= $h['anterior'] ?></td>
                <td><?= $h['nuevo'] ?></td>
                <td><?= $h['autorizado'] ?></td>
                <td><?= $h['fecha'] ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

</div>
</body>
</html>
