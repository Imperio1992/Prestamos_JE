<?php
// 🔐 SOLO GERENTE
$roles_permitidos = ['GERENTE'];
include("seguridad.php");
include("conexion.php");
include("menu.php");

if (!isset($_GET['id'])) {
    header("Location: empleados.php");
    exit;
}

$id_empleado = (int)$_GET['id'];

// OBTENER EMPLEADO
$emp = $conexion->prepare("
    SELECT *
    FROM empleados
    WHERE id_empleado = ?
");
$emp->bind_param("i", $id_empleado);
$emp->execute();
$empleado = $emp->get_result()->fetch_assoc();

if (!$empleado) {
    header("Location: empleados.php");
    exit;
}

// OBTENER USUARIO (por nombre completo como lo tienes registrado)
$usuario = $conexion->prepare("
    SELECT *
    FROM usuarios
    WHERE rol = ?
    LIMIT 1
");
$usuario->bind_param("s", $empleado['rol']);
$usuario->execute();
$usr = $usuario->get_result()->fetch_assoc();

// GUARDAR CAMBIOS
if ($_POST) {

    // ACTUALIZAR EMPLEADO
    $upd_emp = $conexion->prepare("
        UPDATE empleados SET
            nombre = ?,
            apellido = ?,
            telefono = ?,
            direccion = ?,
            rol = ?
        WHERE id_empleado = ?
    ");

    $upd_emp->bind_param(
        "sssssi",
        $_POST['nombre'],
        $_POST['apellido'],
        $_POST['telefono'],
        $_POST['direccion'],
        $_POST['rol'],
        $id_empleado
    );

    $upd_emp->execute();

    // ACTUALIZAR USUARIO
    if (!empty($_POST['password'])) {
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $upd_usr = $conexion->prepare("
            UPDATE usuarios SET
                usuario = ?,
                password = ?,
                rol = ?
            WHERE usuario = ?
        ");

        $upd_usr->bind_param(
            "ssss",
            $_POST['usuario'],
            $hash,
            $_POST['rol'],
            $usr['usuario']
        );
    } else {
        $upd_usr = $conexion->prepare("
            UPDATE usuarios SET
                usuario = ?,
                rol = ?
            WHERE usuario = ?
        ");

        $upd_usr->bind_param(
            "sss",
            $_POST['usuario'],
            $_POST['rol'],
            $usr['usuario']
        );
    }

    $upd_usr->execute();

    header("Location: empleados.php?ok=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

<div class="card shadow">
    <div class="card-header bg-warning">
        <h4 class="mb-0">✏️ Editar Empleado</h4>
    </div>

    <div class="card-body">

        <form method="POST">

            <h5 class="mb-3">👤 Datos del Empleado</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre</label>
                    <input name="nombre" class="form-control"
                           value="<?= $empleado['nombre'] ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Apellido</label>
                    <input name="apellido" class="form-control"
                           value="<?= $empleado['apellido'] ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Teléfono</label>
                    <input name="telefono" class="form-control"
                           value="<?= $empleado['telefono'] ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Dirección</label>
                    <input name="direccion" class="form-control"
                           value="<?= $empleado['direccion'] ?>">
                </div>
            </div>

            <h5 class="mt-4 mb-3">🔐 Acceso al Sistema</h5>

            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input name="usuario" class="form-control"
                       value="<?= $usr['usuario'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nueva contraseña</label>
                <input type="password" name="password"
                       class="form-control"
                       placeholder="Dejar en blanco para no cambiar">
            </div>

            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select name="rol" class="form-select">
                    <option <?= $empleado['rol']=='ASESOR'?'selected':'' ?>>ASESOR</option>
                    <option <?= $empleado['rol']=='SUPERVISOR'?'selected':'' ?>>SUPERVISOR</option>
                    <option <?= $empleado['rol']=='GERENTE'?'selected':'' ?>>GERENTE</option>
                </select>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">
                    💾 Guardar Cambios
                </button>

                <a href="empleados.php" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

</div>
</body>
</html>
