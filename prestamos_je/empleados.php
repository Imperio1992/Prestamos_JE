<?php
// 🔐 SOLO GERENTE
$roles_permitidos = ['GERENTE'];
include("seguridad.php");
include("conexion.php");
include("menu.php");

// MENSAJES
$mensaje = "";
$tipo = "";

if (isset($_GET['ok'])) {
    $mensaje = "Empleado actualizado correctamente";
    $tipo = "success";
}

if (isset($_GET['eliminado'])) {
    $mensaje = "Empleado eliminado definitivamente";
    $tipo = "success";
}

if (isset($_GET['error']) && $_GET['error'] == 'prestamos') {
    $mensaje = "No se puede eliminar el empleado porque tiene préstamos registrados";
    $tipo = "danger";
}

// BÚSQUEDA
$filtro = "";
if (!empty($_GET['buscar'])) {
    $buscar = $conexion->real_escape_string($_GET['buscar']);
    $filtro = "WHERE e.nombre LIKE '%$buscar%' OR e.apellido LIKE '%$buscar%'";
}

// OBTENER EMPLEADOS + USUARIO
$empleados = $conexion->query("
    SELECT 
        e.id_empleado,
        e.nombre,
        e.apellido,
        e.telefono,
        e.direccion,
        e.rol,
        e.estatus,
        u.usuario
    FROM empleados e
    LEFT JOIN usuarios u ON u.id_empleado = e.id_empleado
    $filtro
    ORDER BY e.estatus, e.nombre
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <h3 class="mb-3">👥 Gestión de Empleados</h3>

    <?php if ($mensaje != "") { ?>
        <div class="alert alert-<?= $tipo ?>">
            <?= $mensaje ?>
        </div>
    <?php } ?>

    <!-- BUSCADOR -->
    <form method="GET" class="mb-3 d-flex">
        <input type="text"
               name="buscar"
               class="form-control me-2"
               placeholder="Buscar por nombre o apellido"
               value="<?= $_GET['buscar'] ?? '' ?>">
        <button class="btn btn-primary">Buscar</button>
    </form>

    <!-- TABLA -->
    <div class="table-responsive">
    <table class="table table-bordered table-hover bg-white shadow-sm align-middle">
        <thead class="table-dark">
            <tr>
                <th>Empleado</th>
                <th>Usuario</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Rol</th>
                <th>Estatus</th>
                <th width="340">Acciones</th>
            </tr>
        </thead>
        <tbody>

        <?php while ($e = $empleados->fetch_assoc()) { ?>
            <tr>
                <td><b><?= $e['nombre']." ".$e['apellido'] ?></b></td>

                <td>
                    <?= $e['usuario'] ?? '<span class="text-danger">SIN USUARIO</span>' ?>
                </td>

                <td><?= $e['telefono'] ?: '-' ?></td>

                <td><?= $e['direccion'] ?: '-' ?></td>

                <td>
                    <span class="badge bg-info text-dark">
                        <?= $e['rol'] ?>
                    </span>
                </td>

                <td>
                    <?php if ($e['estatus'] == 'ACTIVO') { ?>
                        <span class="badge bg-success">ACTIVO</span>
                    <?php } else { ?>
                        <span class="badge bg-secondary">BAJA</span>
                    <?php } ?>
                </td>

                <!-- ACCIONES -->
                <td>

                    <?php if ($e['estatus'] == 'ACTIVO') { ?>

                        <a href="editar_empleado.php?id=<?= $e['id_empleado'] ?>"
                           class="btn btn-warning btn-sm mb-1">
                           ✏️ Editar
                        </a>

                        <a href="baja_empleado.php?id=<?= $e['id_empleado'] ?>"
                           class="btn btn-secondary btn-sm mb-1"
                           onclick="return confirm('¿Dar de baja al empleado?')">
                           Baja
                        </a>

                    <?php } else { ?>

                        <a href="reactivar_empleado.php?id=<?= $e['id_empleado'] ?>"
                           class="btn btn-success btn-sm mb-1"
                           onclick="return confirm('¿Reactivar empleado?')">
                           Reactivar
                        </a>

                    <?php } ?>

                    <!-- 📊 BOTÓN ESTATUS -->
                    <a href="estatus_empleado.php?id=<?= $e['id_empleado'] ?>"
                       class="btn btn-info btn-sm mb-1">
                       📊 Estatus
                    </a>

                    <a href="eliminar_empleado.php?id=<?= $e['id_empleado'] ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('⚠️ ¿Eliminar DEFINITIVAMENTE este empleado? Esta acción no se puede deshacer.')">
                       🗑️ Eliminar
                    </a>

                </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
    </div>

    <a href="index.php" class="btn btn-secondary mt-3">
        ⬅ Volver al inicio
    </a>

</div>

</body>
</html>

