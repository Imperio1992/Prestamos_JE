<?php
include("seguridad.php");
include("menu.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Principal | Préstamos JE</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <!-- HEADER -->
    <div class="card shadow mb-4">
        <div class="card-body d-flex align-items-center">
            <img src="img/logo.jpeg" alt="Préstamos JE" style="height:80px;" class="me-4">

            <div>
                <h3 class="mb-0">Préstamos JE</h3>
                <small class="text-muted">
                    Bienvenido, <b><?= $_SESSION['usuario'] ?></b>
                    (<?= $_SESSION['rol'] ?>)
                </small>
            </div>
        </div>
    </div>

    <!-- TARJETAS -->
    <div class="row g-4">

        <!-- CLIENTES -->
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h5>Clientes</h5>
                    <p>Registro y administración</p>

                    <a href="registrar_cliente.php" class="btn btn-primary btn-sm mb-1">
                        Nuevo
                    </a>

                    <a href="buscar_cliente.php" class="btn btn-outline-primary btn-sm mb-1">
                        Buscar
                    </a>

                    <?php if ($_SESSION['rol'] == 'GERENTE') { ?>
                        <br>
                        <a href="clientes.php" class="btn btn-warning btn-sm mt-2">
                            Migrar Cliente
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- PRÉSTAMOS -->
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h5>Préstamos</h5>
                    <p>Alta y control</p>
                    <a href="nuevo_prestamo.php" class="btn btn-success btn-sm mb-1">
                        Nuevo Préstamo
                    </a>
                    <a href="historial_cliente.php" class="btn btn-outline-success btn-sm">
                        Historial
                    </a>
                </div>
            </div>
        </div>

        <!-- COBRANZA -->
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h5>Cobranza</h5>
                    <p>Pagos diarios</p>
                    <a href="cobranza_diaria.php" class="btn btn-warning btn-sm">
                        Cobrar
                    </a>
                </div>
            </div>
        </div>

        <!-- EMPLEADOS -->
        <?php if ($_SESSION['rol'] == 'GERENTE') { ?>
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h5>Empleados</h5>
                    <p>Gestión interna</p>
                    <a href="empleados.php" class="btn btn-dark btn-sm mb-1">
                        Administrar
                    </a>
                    
                    <a href="registrar_empleado.php" class="btn btn-outline-dark btn-sm">
                        Nuevo
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>

        <!-- REPORTES -->
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h5>Reportes</h5>
                    <p>PDF / Excel</p>
                    <a href="reporte_diario.php" class="btn btn-secondary btn-sm">
                        Ver
                    </a>
                </div>
            </div>
        </div>

        <!-- SALIR -->
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h5>Sesión</h5>
                    <p>Cerrar sistema</p>
                    <a href="logout.php" class="btn btn-danger btn-sm">
                        Cerrar sesión
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>
