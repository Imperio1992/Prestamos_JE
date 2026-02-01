<?php
// 🔐 Roles permitidos
$roles_permitidos = ['GERENTE', 'ASESOR'];
include("seguridad.php");

include("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar Cliente</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

<?php include("menu.php"); ?>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Buscar Cliente</h4>
        </div>

        <div class="card-body">

            <form method="GET" class="mb-4">
                <label class="form-label">Buscar por nombre</label>
                <input type="text" name="nombre" class="form-control" required>
                <button class="btn btn-primary mt-3">Buscar</button>
            </form>

            <?php
            if (isset($_GET['nombre'])) {

                $nombre = $_GET['nombre'];

                $res = $conexion->query("
                    SELECT * FROM clientes 
                    WHERE nombre LIKE '%$nombre%'
                ");

                while ($row = $res->fetch_assoc()) {
            ?>
                <div class="border rounded p-3 mb-3">

                    <b><?= $row['nombre']." ".$row['apellido'] ?></b><br>
                    Estatus: <?= $row['estatus'] ?><br>

                    <a href="bloquear.php?id=<?= $row['id_cliente'] ?>" 
                       class="btn btn-danger btn-sm mt-2">
                        Bloquear
                    </a>

                    <a href="estado_cuenta.php?id=<?= $row['id_cliente'] ?>" 
                       target="_blank"
                       class="btn btn-primary btn-sm mt-2">
                        Estado de Cuenta (PDF)
                    </a>

                </div>
            <?php
                }
            }
            ?>

        </div>
    </div>

</div>

</body>
</html>
