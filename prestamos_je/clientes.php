<?php
// 🔐 Acceso permitido
$roles_permitidos = ['GERENTE', 'ASESOR', 'SUPERVISOR'];
include("seguridad.php");
include("conexion.php");

/*********************************
 * FILTROS (ROL + BUSCADOR)
 *********************************/
$condiciones = [];

if ($_SESSION['rol'] === 'ASESOR') {
    $condiciones[] = "c.id_asesor = " . intval($_SESSION['id_empleado']);
}

// BUSCADOR
$buscar = trim($_GET['buscar'] ?? '');
if (!empty($buscar)) {
    $buscar_safe = $conexion->real_escape_string($buscar);
    $condiciones[] = "(c.nombre LIKE '%$buscar_safe%' OR c.apellido LIKE '%$buscar_safe%')";
}

// Construir WHERE dinámico
$filtro = "";
if (count($condiciones) > 0) {
    $filtro = "WHERE " . implode(" AND ", $condiciones);
}

/*********************************
 * OBTENER CLIENTES
 *********************************/
$clientes = $conexion->query("
    SELECT 
        c.id_cliente,
        c.nombre,
        c.apellido,
        c.fecha_registro,
        c.estatus,
        c.fecha_desbloqueo,
        e.nombre AS asesor_nombre,
        e.apellido AS asesor_apellido
    FROM clientes c
    INNER JOIN empleados e ON c.id_asesor = e.id_empleado
    $filtro
    ORDER BY c.fecha_registro DESC
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes | Préstamos JE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<?php include("menu.php"); ?>

<div class="container mt-4">
    <h3 class="mb-3">Listado de Clientes</h3>

    <?php if (in_array($_SESSION['rol'], ['GERENTE','SUPERVISOR'])): ?>
        <div class="d-flex justify-content-end mb-3">
            <a href="registrar_cliente.php" class="btn btn-success">➕ Nuevo Cliente</a>
        </div>
    <?php endif; ?>

    <!-- 🔍 BUSCADOR -->
    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-8">
                <input type="text"
                       name="buscar"
                       class="form-control"
                       placeholder="Buscar por nombre (ej. Juan)..."
                       value="<?= htmlspecialchars($buscar) ?>">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary w-100">🔍 Buscar</button>
            </div>
        </div>
    </form>

    <?php if (isset($_GET['bloqueado'])): ?>
        <div class="alert alert-success">Cliente bloqueado correctamente</div>
    <?php endif; ?>

    <?php if (isset($_GET['desbloqueado'])): ?>
        <div class="alert alert-success">Cliente desbloqueado correctamente</div>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Clientes registrados</h5>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Cliente</th>
                        <th>Asesor</th>
                        <th>Fecha registro</th>
                        <th>Estatus</th>
                        <th width="320">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                <?php while ($c = $clientes->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['nombre']." ".$c['apellido']) ?></td>
                        <td><?= htmlspecialchars($c['asesor_nombre']." ".$c['asesor_apellido']) ?></td>
                        <td><?= date("d/m/Y", strtotime($c['fecha_registro'])) ?></td>

                        <td>
                            <?php
                            if ($c['estatus'] === 'ACTIVO') {
                                echo '<span class="badge bg-success">ACTIVO</span>';
                            } elseif ($c['estatus'] === 'MAL_HISTORIAL') {
                                echo '<span class="badge bg-warning text-dark">MAL HISTORIAL</span>';
                            } else {
                                echo '<span class="badge bg-danger">BLOQUEADO</span>';
                            }
                            ?>
                        </td>

                        <td>
                        <?php if (in_array($_SESSION['rol'], ['GERENTE','SUPERVISOR'])): ?>

                            <?php if ($c['estatus'] !== 'BLOQUEADO'): ?>

                                <a href="editar_cliente.php?id=<?= $c['id_cliente'] ?>" class="btn btn-primary btn-sm mb-1">✏️ Modificar</a>
                                <a href="migrar_cliente.php?id=<?= $c['id_cliente'] ?>" class="btn btn-warning btn-sm mb-1">Migrar</a>
                                <a href="bloquear_cliente.php?id=<?= $c['id_cliente'] ?>" class="btn btn-danger btn-sm mb-1">Bloquear</a>

                            <?php else: ?>

                                <?php
                                $hoy = date('Y-m-d');
                                if (!empty($c['fecha_desbloqueo']) && $hoy >= $c['fecha_desbloqueo']):
                                ?>
                                    <a href="desbloquear_cliente.php?id=<?= $c['id_cliente'] ?>"
                                       class="btn btn-success btn-sm"
                                       onclick="return confirm('¿Desbloquear este cliente?')">
                                       🔓 Desbloquear
                                    </a>
                                <?php else: ?>
                                    <span class="badge bg-secondary">
                                        ⏳ Hasta <?= date("d/m/Y", strtotime($c['fecha_desbloqueo'])) ?>
                                    </span>
                                <?php endif; ?>

                            <?php endif; ?>

                        <?php else: ?>
                            <span class="text-muted">Sin acciones</span>
                        <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>

                </tbody>
            </table>
        </div>
    </div>

    <a href="index.php" class="btn btn-secondary mt-3">⬅ Volver al inicio</a>
</div>
</body>
</html>
