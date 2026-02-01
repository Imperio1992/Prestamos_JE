<?php
include("seguridad.php");
include("conexion.php");
include("validar_cliente.php");

/* ============================
   FUNCIONES DE CAJA
============================ */
function totalCaja($c,$id,$medio=null){
    $f = $medio ? "AND medio='$medio'" : "";
    return $c->query("
        SELECT IFNULL(SUM(CASE WHEN tipo='ENTRADA' THEN monto ELSE -monto END),0) t
        FROM caja WHERE id_empleado=$id $f
    ")->fetch_assoc()['t'];
}

/* ===============================
   CLIENTES SEGÚN ROL
=============================== */
if ($_SESSION['rol'] === 'ASESOR') {

    $clientes = $conexion->query("
        SELECT DISTINCT c.id_cliente, c.nombre, c.apellido
        FROM clientes c
        INNER JOIN prestamos p ON p.id_cliente = c.id_cliente
        WHERE p.id_empleado = ".$_SESSION['id_empleado']."
        ORDER BY c.nombre
    ");

} else {

    $clientes = $conexion->query("
        SELECT id_cliente, nombre, apellido 
        FROM clientes 
        WHERE estatus='ACTIVO'
        ORDER BY nombre
    ");
}

// Guardamos clientes en arreglo para JS
$clientes_array = [];
while ($c = $clientes->fetch_assoc()) {
    $clientes_array[] = $c;
}

/* ===============================
   EMPLEADOS (SOLO GERENTE)
=============================== */
$empleados_array = [];
if ($_SESSION['rol'] === 'GERENTE') {
    $empleados = $conexion->query("
        SELECT id_empleado, nombre, apellido 
        FROM empleados 
        WHERE estatus='ACTIVO'
        ORDER BY nombre
    ");

    while ($e = $empleados->fetch_assoc()) {
        $e['efectivo'] = totalCaja($conexion, $e['id_empleado'], 'EFECTIVO');
        $e['banco'] = totalCaja($conexion, $e['id_empleado'], 'BANCO');
        $empleados_array[] = $e;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nuevo Préstamo | Préstamos JE</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<script>
let clientes = <?php echo json_encode($clientes_array); ?>;
let empleados = <?php echo json_encode($empleados_array); ?>;

function seleccionarCliente() {
    let input = document.getElementById("buscarCliente").value;
    let hiddenInput = document.getElementById("clienteId");

    let encontrado = clientes.find(c => 
        (c.id_cliente + " - " + c.nombre + " " + c.apellido) === input
    );

    if (encontrado) {
        hiddenInput.value = encontrado.id_cliente;
        document.getElementById("errorCliente").style.display = "none";
    } else {
        hiddenInput.value = "";
        document.getElementById("errorCliente").style.display = "block";
    }
}

function mostrarSaldoAsesor() {
    let id = document.getElementById("empleadoSelect").value;
    let efectivoSpan = document.getElementById("saldoEfectivo");
    let bancoSpan = document.getElementById("saldoBanco");

    let emp = empleados.find(e => e.id_empleado == id);

    if (emp) {
        efectivoSpan.innerText = "$" + parseFloat(emp.efectivo).toFixed(2);
        bancoSpan.innerText = "$" + parseFloat(emp.banco).toFixed(2);

        document.getElementById("saldoCaja").style.display = "block";
        document.getElementById("saldoEfectivoBase").value = emp.efectivo;
        document.getElementById("saldoBancoBase").value = emp.banco;
    } else {
        document.getElementById("saldoCaja").style.display = "none";
    }
}

function calcularDescuento() {
    let montoPrestamo = parseFloat(document.getElementById("montoPrestamo").value) || 0;
    let descEfectivo = parseFloat(document.getElementById("descEfectivo").value) || 0;

    let totalDescontado = descEfectivo;
    let descBanco = 0;

    if (descEfectivo > montoPrestamo) {
        descEfectivo = montoPrestamo;
        document.getElementById("descEfectivo").value = montoPrestamo;
    }

    descBanco = montoPrestamo - descEfectivo;
    totalDescontado = descEfectivo + descBanco;

    document.getElementById("descBanco").value = descBanco.toFixed(2);
    document.getElementById("totalDescuento").innerText = "$" + totalDescontado.toFixed(2);
}

function validarAntesEnviar() {
    let montoPrestamo = parseFloat(document.getElementById("montoPrestamo").value) || 0;
    let descEfectivo = parseFloat(document.getElementById("descEfectivo").value) || 0;
    let descBanco = parseFloat(document.getElementById("descBanco").value) || 0;

    if (descEfectivo + descBanco !== montoPrestamo) {
        alert("⚠️ El total descontado debe ser igual al monto del préstamo.");
        return false;
    }

    return true;
}
</script>
</head>

<body class="bg-light">

<div class="container mt-4">
<?php include("menu.php"); ?>

<div class="card shadow">
<div class="card-header bg-primary text-white">
<h4 class="mb-0">Nuevo Préstamo</h4>
</div>

<div class="card-body">

<form method="POST" onsubmit="return validarAntesEnviar()">

<!-- BUSCADOR -->
<div class="mb-2">
<label class="form-label">Buscar cliente</label>
<input type="text"
id="buscarCliente"
class="form-control"
list="listaClientes"
placeholder="Escribe nombre, apellido o ID..."
onchange="seleccionarCliente()"
required>

<datalist id="listaClientes">
<?php foreach ($clientes_array as $c): ?>
<option value="<?= $c['id_cliente']." - ".$c['nombre']." ".$c['apellido'] ?>">
<?php endforeach; ?>
</datalist>

<input type="hidden" name="cliente" id="clienteId">

<div id="errorCliente" class="text-danger mt-1" style="display:none;">
⚠️ Debes seleccionar un cliente válido de la lista.
</div>
</div>

<!-- EMPLEADO -->
<?php if ($_SESSION['rol'] === 'GERENTE') { ?>
<div class="mb-3">
<label class="form-label">Empleado</label>
<select name="empleado" id="empleadoSelect" class="form-select" required onchange="mostrarSaldoAsesor()">
<option value="">Selecciona empleado</option>
<?php foreach ($empleados_array as $e) { ?>
<option value="<?= $e['id_empleado'] ?>">
<?= $e['nombre']." ".$e['apellido'] ?>
</option>
<?php } ?>
</select>
</div>

<div id="saldoCaja" class="alert alert-info" style="display:none;">
<b>Saldo del asesor:</b><br>
💵 Efectivo: <span id="saldoEfectivo"></span><br>
🏦 Banco: <span id="saldoBanco"></span>
</div>

<input type="hidden" id="saldoEfectivoBase">
<input type="hidden" id="saldoBancoBase">

<?php } else { ?>
<input type="hidden" name="empleado" value="<?= $_SESSION['id_empleado'] ?>">
<?php } ?>

<!-- MONTO -->
<div class="mb-3">
<label class="form-label">Monto a prestar</label>
<input type="number" name="monto" id="montoPrestamo" class="form-control" required min="100" oninput="calcularDescuento()">
</div>

<div class="mb-3">
<label>Descontar de EFECTIVO</label>
<input type="number" id="descEfectivo" name="descEfectivo" class="form-control" oninput="calcularDescuento()" min="0">
</div>

<div class="mb-3">
<label>Descontar de BANCO</label>
<input type="number" id="descBanco" name="descBanco" class="form-control" readonly>
</div>

<div class="alert alert-secondary">
Total a descontar: <b id="totalDescuento">$0.00</b>
</div>

<button class="btn btn-success w-100">
Crear Préstamo
</button>
</form>

<?php
if ($_POST) {

$id_cliente  = intval($_POST['cliente']);
$id_empleado = intval($_POST['empleado']);
$monto_original = floatval($_POST['monto']);
$desc_efectivo = floatval($_POST['descEfectivo']);
$desc_banco = floatval($_POST['descBanco']);

// SALDOS ACTUALES
$saldo_efectivo = totalCaja($conexion, $id_empleado, 'EFECTIVO');
$saldo_banco = totalCaja($conexion, $id_empleado, 'BANCO');

// VALIDACIÓN DE SALDO
if ($desc_efectivo > $saldo_efectivo || $desc_banco > $saldo_banco) {
    echo "<div class='alert alert-danger mt-4'>❌ Saldo insuficiente.</div>";
    exit;
}

// VALIDAR LÍMITE DE CRÉDITO
$monto = puedePrestar($id_cliente, $monto_original);

// CÁLCULOS
$interes = $monto * 0.20;
$total = $monto + $interes;
$pago_diario = $total / 20;
$fecha_inicio = date('Y-m-d');

// INSERTAR PRÉSTAMO
$conexion->query("
INSERT INTO prestamos
(id_cliente, id_empleado, monto_prestado, interes, total_pagar, pago_diario, fecha_inicio, estado)
VALUES
($id_cliente, $id_empleado, $monto, $interes, $total, $pago_diario, '$fecha_inicio', 'ACTIVO')
");

$numero_credito = $conexion->insert_id;
$concepto = "PRESTAMO #$numero_credito";

// DESCONTAR EFECTIVO
$stmt = $conexion->prepare("
INSERT INTO caja (tipo, concepto, medio, monto, id_empleado)
VALUES ('SALIDA', ?, 'EFECTIVO', ?, ?)
");
$stmt->bind_param("sdi", $concepto, $desc_efectivo, $id_empleado);
$stmt->execute();

// DESCONTAR BANCO
$stmt = $conexion->prepare("
INSERT INTO caja (tipo, concepto, medio, monto, id_empleado)
VALUES ('SALIDA', ?, 'BANCO', ?, ?)
");
$stmt->bind_param("sdi", $concepto, $desc_banco, $id_empleado);
$stmt->execute();

// NUEVOS SALDOS
$nuevo_efectivo = $saldo_efectivo - $desc_efectivo;
$nuevo_banco = $saldo_banco - $desc_banco;

// DATOS DEL CLIENTE
$cliente = $conexion->query("
SELECT nombre, apellido 
FROM clientes 
WHERE id_cliente = $id_cliente
")->fetch_assoc();

echo "
<div class='alert alert-success mt-4'>
<h5>Préstamo creado correctamente</h5>
<b>Cliente:</b> {$cliente['nombre']} {$cliente['apellido']}<br>
<b>N° Crédito:</b> $numero_credito<br><br>
<b>Monto:</b> $$monto<br>
<b>Interés:</b> $$interes<br>
<b>Total a pagar:</b> $$total<br>
<b>Pago diario:</b> $$pago_diario<br><br>
✔️ Descuento aplicado:<br>
💵 -$$desc_efectivo EFECTIVO (Nuevo saldo: $$nuevo_efectivo)<br>
🏦 -$$desc_banco BANCO (Nuevo saldo: $$nuevo_banco)
</div>

<script>
document.getElementById('saldoEfectivo').innerText = '$' + parseFloat($nuevo_efectivo).toFixed(2);
document.getElementById('saldoBanco').innerText = '$' + parseFloat($nuevo_banco).toFixed(2);
</script>
";
}
?>

</div>
</div>
</div>

</body>
</html>
