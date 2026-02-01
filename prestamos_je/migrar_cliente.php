<?php
$roles_permitidos = ['GERENTE'];
include("seguridad.php");
include("conexion.php");

// ============================
// VALIDAR ID
// ============================
$id_cliente = intval($_GET['id'] ?? 0);
if ($id_cliente == 0) {
    header("Location: clientes.php");
    exit;
}

// ============================
// OBTENER CLIENTE + ASESOR ACTUAL
// ============================
$cliente = $conexion->query("
    SELECT 
        c.id_cliente,
        c.nombre,
        c.apellido,
        c.id_asesor,
        e.nombre AS asesor_nombre,
        e.apellido AS asesor_apellido
    FROM clientes c
    INNER JOIN empleados e ON c.id_asesor = e.id_empleado
    WHERE c.id_cliente = $id_cliente
")->fetch_assoc();

if (!$cliente) {
    header("Location: clientes.php");
    exit;
}

// ============================
// OBTENER ASESORES (NOMBRE COMPLETO)
// ============================
$asesores = $conexion->query("
    SELECT id_empleado, nombre, apellido
    FROM empleados
    WHERE rol = 'ASESOR' AND estatus = 'ACTIVO'
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Migrar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<?php include("menu.php"); ?>

<div class="container mt-4">

<div class="card shadow">
    <div class="card-header bg-warning">
        <h4 class="mb-0">Migrar Cliente</h4>
    </div>

    <div class="card-body">

        <p><b>Cliente:</b> <?= $cliente['nombre']." ".$cliente['apellido'] ?></p>
        <p><b>Asesor actual:</b>
            <?= $cliente['asesor_nombre']." ".$cliente['asesor_apellido'] ?>
        </p>

        <form method="POST">
            <label class="form-label">Nuevo Asesor</label>
            <select name="nuevo_asesor" class="form-select mb-3" required>
                <?php while ($a = $asesores->fetch_assoc()) { ?>
                    <option value="<?= $a['id_empleado'] ?>"
                        <?= $a['id_empleado'] == $cliente['id_asesor'] ? 'disabled' : '' ?>>
                        <?= $a['nombre']." ".$a['apellido'] ?>
                    </option>
                <?php } ?>
            </select>

            <button class="btn btn-success w-100">
                Migrar Cliente
            </button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nuevo = intval($_POST['nuevo_asesor']);
            $anterior = $cliente['id_asesor'];

            if ($nuevo != $anterior) {

                // ACTUALIZAR CLIENTE
                $conexion->query("
                    UPDATE clientes
                    SET id_asesor = $nuevo
                    WHERE id_cliente = $id_cliente
                ");

                // GUARDAR HISTORIAL
                $conexion->query("
                    INSERT INTO historial_clientes
                    (id_cliente, asesor_anterior, asesor_nuevo, autorizado_por)
                    VALUES
                    ($id_cliente, $anterior, $nuevo, ".$_SESSION['id_usuario'].")
                ");

                echo "<div class='alert alert-success mt-3'>
                    Cliente migrado correctamente
                </div>";
            }
        }
        ?>

        <a href="clientes.php" class="btn btn-secondary mt-3">
            ⬅ Volver
        </a>

    </div>
</div>

</div>

</body>
</html>
