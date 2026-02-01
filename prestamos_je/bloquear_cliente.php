<?php
// 🔐 SOLO GERENTE Y SUPERVISOR
$roles_permitidos = ['GERENTE', 'SUPERVISOR'];
include("seguridad.php");
include("conexion.php");

$id_cliente = intval($_GET['id'] ?? $_POST['id_cliente'] ?? 0);
if ($id_cliente === 0) {
    header("Location: clientes.php");
    exit;
}

/*********************************
 * OBTENER CLIENTE
 *********************************/
$stmt = $conexion->prepare("
    SELECT nombre, apellido
    FROM clientes
    WHERE id_cliente = ?
");
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$cliente = $stmt->get_result()->fetch_assoc();

if (!$cliente) {
    header("Location: clientes.php");
    exit;
}

/*********************************
 * PROCESAR BLOQUEO
 *********************************/
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dias   = intval($_POST['dias_bloqueo']);
    $motivo = trim($_POST['motivo_bloqueo']);

    if ($dias <= 0) {
        $error = "Selecciona un tiempo válido de bloqueo";
    } elseif ($motivo === "") {
        $error = "El motivo del bloqueo es obligatorio";
    } else {

        $fecha_bloqueo    = date('Y-m-d');
        $fecha_desbloqueo = date('Y-m-d', strtotime("+$dias days"));

        $stmt = $conexion->prepare("
            UPDATE clientes
            SET 
                estatus = 'BLOQUEADO',
                fecha_bloqueo = ?,
                dias_bloqueo = ?,
                fecha_desbloqueo = ?,
                motivo_bloqueo = ?
            WHERE id_cliente = ?
        ");

        // TIPOS CORRECTOS: s = string | i = int
        $stmt->bind_param(
            "sissi",
            $fecha_bloqueo,
            $dias,
            $fecha_desbloqueo,
            $motivo,
            $id_cliente
        );

        $stmt->execute();

        header("Location: clientes.php?bloqueado=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bloquear Cliente | Préstamos JE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-danger text-white text-center">
                    <h5>Bloquear Cliente</h5>
                </div>

                <div class="card-body">

                    <p>
                        Cliente:
                        <strong><?= htmlspecialchars($cliente['nombre']." ".$cliente['apellido']) ?></strong>
                    </p>

                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <input type="hidden" name="id_cliente" value="<?= $id_cliente ?>">

                        <div class="mb-3">
                            <label class="form-label">Tiempo de bloqueo</label>
                            <select name="dias_bloqueo" class="form-select" required>
                                <option value="">Seleccione...</option>
                                <option value="15">15 días</option>
                                <option value="30">30 días</option>
                                <option value="60">60 días</option>
                                <option value="90">90 días</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Motivo del bloqueo</label>
                            <textarea
                                name="motivo_bloqueo"
                                class="form-control"
                                rows="3"
                                required></textarea>
                        </div>

                        <button class="btn btn-danger w-100 mb-2">
                            🔒 Confirmar Bloqueo
                        </button>

                        <a href="clientes.php" class="btn btn-secondary w-100">
                            ⬅ Cancelar
                        </a>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
