<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include("conexion.php");

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario  = trim($_POST['usuario']);
    $password = $_POST['password'];

    $stmt = $conexion->prepare("
        SELECT id_usuario, usuario, password, rol, id_empleado
        FROM usuarios
        WHERE usuario = ?
        LIMIT 1
    ");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $u = $res->fetch_assoc();

        if (password_verify($password, $u['password'])) {
            $_SESSION['id_usuario']  = $u['id_usuario'];
            $_SESSION['usuario']     = $u['usuario'];
            $_SESSION['rol']         = $u['rol'];
            $_SESSION['id_empleado'] = $u['id_empleado'];

            header("Location: index.php");
            exit;
        } else {
            $error = "Usuario o contraseña incorrectos";
        }
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login | Préstamos JE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="height:100vh;">

<div class="card shadow p-4" style="width:360px;">

    <!-- LOGO -->
    <div class="text-center mb-3">
        <img src="img/logo.jpeg" alt="Préstamos JE" style="height:90px;">
    </div>

    <h4 class="text-center mb-3">Iniciar sesión</h4>

    <?php if ($error != "") { ?>
        <div class="alert alert-danger text-center">
            <?= $error ?>
        </div>
    <?php } ?>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" name="usuario" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">
            Iniciar sesión
        </button>

    </form>

    <div class="text-center mt-3 text-muted" style="font-size:13px;">
        Préstamos JE © <?= date('Y') ?>
    </div>

</div>

</body>
</html>
