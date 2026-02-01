<?php
session_start();
include("conexion.php");

/*********************************
 * SEGURIDAD POR ROL
 *********************************/
if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], ['GERENTE', 'SUPERVISOR'])) {
    header("Location: index.php");
    exit;
}

/*********************************
 * VALIDAR ID
 *********************************/
if (!isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: clientes.php");
    exit;
}

/*********************************
 * ACTUALIZAR CLIENTE
 *********************************/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_cliente        = intval($_POST['id_cliente']);
    $curp_ine          = trim($_POST['curp_ine']);
    $nombre            = trim($_POST['nombre']);
    $apellido          = trim($_POST['apellido']);
    $fecha_nacimiento  = $_POST['fecha_nacimiento'];
    $direccion         = trim($_POST['direccion']);
    $numero_exterior   = trim($_POST['numero_exterior']);
    $colonia           = trim($_POST['colonia']);
    $telefono          = trim($_POST['telefono']);
    $negocio           = trim($_POST['negocio']);
    $observaciones     = trim($_POST['observaciones']);
    $autoriza_credito  = $_POST['autoriza_credito'];
    $id_asesor         = intval($_POST['id_asesor']);

    // 🔹 SOLO EL GERENTE PUEDE CAMBIAR FECHA DE REGISTRO
    if ($_SESSION['rol'] === 'GERENTE') {
        $fecha_registro = $_POST['fecha_registro'];
    } else {
        // Si no es gerente, conservamos la original
        $stmt_tmp = $conexion->prepare("SELECT fecha_registro FROM clientes WHERE id_cliente = ?");
        $stmt_tmp->bind_param("i", $id_cliente);
        $stmt_tmp->execute();
        $tmp = $stmt_tmp->get_result()->fetch_assoc();
        $fecha_registro = $tmp['fecha_registro'];
    }

    $stmt = $conexion->prepare("
        UPDATE clientes SET
            curp_ine = ?,
            nombre = ?,
            apellido = ?,
            fecha_nacimiento = ?,
            direccion = ?,
            numero_exterior = ?,
            colonia = ?,
            telefono = ?,
            negocio = ?,
            observaciones = ?,
            autoriza_credito = ?,
            id_asesor = ?,
            fecha_registro = ?
        WHERE id_cliente = ?
    ");

    $stmt->bind_param(
        "sssssssssssisi",
        $curp_ine,
        $nombre,
        $apellido,
        $fecha_nacimiento,
        $direccion,
        $numero_exterior,
        $colonia,
        $telefono,
        $negocio,
        $observaciones,
        $autoriza_credito,
        $id_asesor,
        $fecha_registro,
        $id_cliente
    );

    if ($stmt->execute()) {
        header("Location: clientes.php?ok=1");
        exit;
    } else {
        $error = "Error al actualizar el cliente";
    }
}

/*********************************
 * OBTENER DATOS CLIENTE
 *********************************/
$id_cliente = intval($_GET['id']);

$stmt = $conexion->prepare("
    SELECT *
    FROM clientes
    WHERE id_cliente = ?
    LIMIT 1
");

$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    header("Location: clientes.php");
    exit;
}

$cliente = $resultado->fetch_assoc();

/*********************************
 * ASESORES
 *********************************/
$asesores = $conexion->query("
    SELECT id_empleado, nombre, apellido
    FROM empleados
    WHERE rol = 'ASESOR'
    ORDER BY nombre
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente | Préstamos JE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<?php include("menu.php"); ?>

<div class="container mt-4">

<h3 class="mb-3">Editar Cliente</h3>

<?php if (isset($error)) { ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php } ?>

<div class="card shadow">
<div class="card-header bg-warning">
    <strong>Información del cliente</strong>
</div>

<div class="card-body">
<form method="POST">

<input type="hidden" name="id_cliente" value="<?= $cliente['id_cliente'] ?>">

<div class="row mb-3">
    <div class="col-md-4">
        <label class="form-label">CURP / INE</label>
        <input type="text" name="curp_ine" class="form-control"
               value="<?= htmlspecialchars($cliente['curp_ine']) ?>" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control"
               value="<?= htmlspecialchars($cliente['nombre']) ?>" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Apellido</label>
        <input type="text" name="apellido" class="form-control"
               value="<?= htmlspecialchars($cliente['apellido']) ?>" required>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-3">
        <label class="form-label">Fecha nacimiento</label>
        <input type="date" name="fecha_nacimiento" class="form-control"
               value="<?= $cliente['fecha_nacimiento'] ?>">
    </div>

    <div class="col-md-3">
        <label class="form-label">Autoriza crédito</label>
        <select name="autoriza_credito" class="form-select">
            <option value="SI" <?= $cliente['autoriza_credito']=='SI'?'selected':'' ?>>SI</option>
            <option value="NO" <?= $cliente['autoriza_credito']=='NO'?'selected':'' ?>>NO</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label">Asesor</label>
        <select name="id_asesor" class="form-select">
            <?php while ($a = $asesores->fetch_assoc()) { ?>
                <option value="<?= $a['id_empleado'] ?>"
                    <?= $cliente['id_asesor']==$a['id_empleado']?'selected':'' ?>>
                    <?= $a['nombre'].' '.$a['apellido'] ?>
                </option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="col-md-3">
    <label class="form-label">Fecha de Registro</label>

    <?php if ($_SESSION['rol'] === 'GERENTE'): ?>
        <input type="date" name="fecha_registro" class="form-control"
               value="<?= date('Y-m-d', strtotime($cliente['fecha_registro'])) ?>">
    <?php else: ?>
        <input type="date" class="form-control"
               value="<?= date('Y-m-d', strtotime($cliente['fecha_registro'])) ?>"
               disabled>
        <input type="hidden" name="fecha_registro"
               value="<?= date('Y-m-d', strtotime($cliente['fecha_registro'])) ?>">
    <?php endif; ?>
</div>

<div class="row mb-3 mt-3">
    <div class="col-md-4">
        <label class="form-label">Dirección</label>
        <input type="text" name="direccion" class="form-control"
               value="<?= htmlspecialchars($cliente['direccion']) ?>">
    </div>

    <div class="col-md-2">
        <label class="form-label">Número ext.</label>
        <input type="text" name="numero_exterior" class="form-control"
               value="<?= htmlspecialchars($cliente['numero_exterior']) ?>">
    </div>

    <div class="col-md-3">
        <label class="form-label">Colonia</label>
        <input type="text" name="colonia" class="form-control"
               value="<?= htmlspecialchars($cliente['colonia']) ?>">
    </div>

    <div class="col-md-3">
        <label class="form-label">Teléfono</label>
        <input type="text" name="telefono" class="form-control"
               value="<?= htmlspecialchars($cliente['telefono']) ?>">
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Negocio donde trabaja</label>
    <input type="text" name="negocio" class="form-control"
           value="<?= htmlspecialchars($cliente['negocio']) ?>">
</div>

<div class="mb-3">
    <label class="form-label">Observaciones</label>
    <textarea name="observaciones" class="form-control" rows="3"><?= htmlspecialchars($cliente['observaciones']) ?></textarea>
</div>

<div class="d-flex justify-content-between">
    <a href="clientes.php" class="btn btn-secondary">⬅ Cancelar</a>
    <button type="submit" class="btn btn-primary">💾 Guardar Cambios</button>
</div>

</form>
</div>
</div>

</div>
</body>
</html>
