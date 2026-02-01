<?php
session_start();
include("conexion.php");

/* ============================
   SELECCIÓN DE EMPLEADO
============================ */
if (isset($_GET['empleado'])) {
    $_SESSION['empleado_activo'] = (int)$_GET['empleado'];
}
$id_empleado = $_SESSION['empleado_activo'] ?? 0;

/* ============================
   LISTA DE EMPLEADOS
============================ */
$empleados = $conexion->query("
    SELECT id_empleado, nombre, apellido
    FROM empleados
    WHERE estatus='ACTIVO'
    ORDER BY nombre
");

/* ============================
   INGRESO EFECTIVO
============================ */
if (isset($_POST['ingreso_efectivo'])) {
    $monto = floatval($_POST['monto']);
    $stmt = $conexion->prepare("
        INSERT INTO caja (tipo, concepto, medio, monto, id_empleado)
        VALUES ('ENTRADA','INGRESO EFECTIVO','EFECTIVO',?,?)
    ");
    $stmt->bind_param("di", $monto, $id_empleado);
    $stmt->execute();
}

/* ============================
   INGRESO BANCO
============================ */
if (isset($_POST['ingreso_banco'])) {
    $monto = floatval($_POST['monto']);
    $stmt = $conexion->prepare("
        INSERT INTO caja (tipo, concepto, medio, monto, id_empleado)
        VALUES ('ENTRADA','INGRESO BANCA MOVIL','BANCO',?,?)
    ");
    $stmt->bind_param("di", $monto, $id_empleado);
    $stmt->execute();
}

/* ============================
   GASTOS / DEDUCCIONES
============================ */
if (isset($_POST['gasto'])) {
    $concepto = $_POST['concepto'];
    $medio    = $_POST['medio'];
    $monto    = floatval($_POST['monto']);

    $stmt = $conexion->prepare("
        INSERT INTO caja (tipo, concepto, medio, monto, id_empleado)
        VALUES ('SALIDA',?,?,?,?)
    ");

    $stmt->bind_param("ssdi", $concepto, $medio, $monto, $id_empleado);
    $stmt->execute();
}

/* =====================================================
   🔥 NUEVO: RETIRO DE GANANCIAS AUTOMÁTICO (TU MODELO)
===================================================== */
if (isset($_POST['retirar_ganancia'])) {

    // Calcular caja actual
    $res = $conexion->query("
        SELECT IFNULL(SUM(CASE WHEN tipo='ENTRADA' THEN monto ELSE -monto END),0) AS total
        FROM caja
        WHERE id_empleado = $id_empleado
    ");
    $row = $res->fetch_assoc();
    $caja_actual = floatval($row['total']);

    if ($caja_actual < 30000) {
        $_SESSION['mensaje'] = "❌ No hay suficiente dinero para retirar ganancias.";
    } else {

        // Retiro total = 30,000
        // 25,000 para propietario
        $stmt = $conexion->prepare("
            INSERT INTO caja (tipo, concepto, medio, monto, id_empleado)
            VALUES ('SALIDA','RETIRO GANANCIA PROPIETARIO','EFECTIVO',?,?)
        ");
        $m1 = 25000;
        $stmt->bind_param("di", $m1, $id_empleado);
        $stmt->execute();

        // 5,000 para asesor
        $stmt = $conexion->prepare("
            INSERT INTO caja (tipo, concepto, medio, monto, id_empleado)
            VALUES ('SALIDA','BONO GANANCIA ASESOR','EFECTIVO',?,?)
        ");
        $m2 = 5000;
        $stmt->bind_param("di", $m2, $id_empleado);
        $stmt->execute();

        $_SESSION['mensaje'] = "✅ Se retiraron $30,000 de ganancias (25,000 propietario + 5,000 asesor).";
    }

    header("Location: estatus_empleado.php");
    exit;
}

/* ============================
   FUNCIONES
============================ */
function totalCaja($c,$id,$medio=null){
    $f = $medio ? "AND medio='$medio'" : "";
    return $c->query("
        SELECT IFNULL(SUM(CASE WHEN tipo='ENTRADA' THEN monto ELSE -monto END),0) t
        FROM caja WHERE id_empleado=$id $f
    ")->fetch_assoc()['t'];
}

function cobranza($c,$id,$cond){
    return $c->query("
        SELECT IFNULL(SUM(pa.monto_pagado),0) t
        FROM pagos pa
        INNER JOIN prestamos pr ON pa.id_prestamo=pr.id_prestamo
        WHERE pr.id_empleado=$id $cond
    ")->fetch_assoc()['t'];
}

function totalPrestamos($c,$id){
    return $c->query("
        SELECT IFNULL(SUM(total_pagar),0) t
        FROM prestamos
        WHERE estado='ACTIVO' AND id_empleado=$id
    ")->fetch_assoc()['t'];
}

/* ============================
   TOTALES
============================ */
$caja_total = totalCaja($conexion,$id_empleado);
$efectivo   = totalCaja($conexion,$id_empleado,'EFECTIVO');
$banco      = totalCaja($conexion,$id_empleado,'BANCO');
$prestamos_total = totalPrestamos($conexion,$id_empleado);

$hoy    = cobranza($conexion,$id_empleado,"AND pa.fecha_pago=CURDATE()");
$semana = cobranza($conexion,$id_empleado,"AND YEARWEEK(pa.fecha_pago,1)=YEARWEEK(CURDATE(),1)");
$mes    = cobranza($conexion,$id_empleado,"AND MONTH(pa.fecha_pago)=MONTH(CURDATE()) AND YEAR(pa.fecha_pago)=YEAR(CURDATE())");
$anio   = cobranza($conexion,$id_empleado,"AND YEAR(pa.fecha_pago)=YEAR(CURDATE())");

$esSabado = date('N') == 6;
$bonoDisponible = ($semana >= 30000 && $esSabado);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Estatus de Caja</title>
<style>
body{font-family:Segoe UI;background:#eef1f5;padding:20px}
.container{max-width:1300px;margin:auto}
.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:15px}
.card{background:#fff;padding:18px;border-radius:10px;box-shadow:0 2px 6px rgba(0,0,0,.1)}
.big{font-size:1.6em;font-weight:bold}
.btn{background:#2c3e50;color:#fff;padding:10px;border:none;border-radius:6px;cursor:pointer}
.fixed{max-height:320px;overflow:auto}
select,input{width:100%;padding:8px}
table th{text-align:left}
.alert{padding:10px;margin:10px 0;border-radius:6px}
.alert-success{background:#eafaf1;color:#0f5132}
</style>
</head>

<body>
<div class="container">

<a href="empleados.php" class="btn">⬅ Regresar</a>

<h2>📊 Estatus de Caja</h2>

<?php if(isset($_SESSION['mensaje'])): ?>
<div class="alert alert-success">
<?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?>
</div>
<?php endif; ?>

<form method="GET" class="card">
<select name="empleado" onchange="this.form.submit()">
<option value="">-- Selecciona empleado --</option>
<?php while($e=$empleados->fetch_assoc()): ?>
<option value="<?=$e['id_empleado']?>" <?=($e['id_empleado']==$id_empleado?'selected':'')?>>
<?=$e['nombre']." ".$e['apellido']?>
</option>
<?php endwhile; ?>
</select>
</form>

<div class="grid">
<div class="card"><h3>🏦 Caja</h3><div class="big">$<?=number_format($caja_total,2)?></div></div>
<div class="card"><h3>💵 Efectivo</h3><div class="big">$<?=number_format($efectivo,2)?></div></div>
<div class="card"><h3>📱 Banco</h3><div class="big">$<?=number_format($banco,2)?></div></div>
<div class="card"><h3>💳 Préstamos Activos</h3><div class="big">$<?=number_format($prestamos_total,2)?></div></div>
</div>

<!-- 🔥 BOTÓN DE RETIRO DE GANANCIA SOLO SI CAJA ≥ 50,000 -->
<?php if ($caja_total >= 50000): ?>
<div class="card" style="background:#fff3cd;margin-top:15px">
<h3>💰 Retiro de Ganancias</h3>
<p>Tu caja alcanzó <b>$50,000 o más</b>. Puedes retirar <b>$30,000</b> y dejar <b>$20,000</b> para seguir prestando.</p>
<form method="POST">
<input type="hidden" name="retirar_ganancia" value="1">
<button class="btn">Retirar $30,000 de Ganancia</button>
</form>
</div>
<?php endif; ?>

<div class="grid">
<div class="card"><h3>📆 Hoy</h3><div class="big">$<?=number_format($hoy,2)?></div></div>
<div class="card"><h3>🗓 Semana</h3><div class="big">$<?=number_format($semana,2)?></div></div>
<div class="card"><h3>📅 Mes</h3><div class="big">$<?=number_format($mes,2)?></div></div>
<div class="card"><h3>📈 Año</h3><div class="big">$<?=number_format($anio,2)?></div></div>
</div>

<div class="card">
<h3>➕ Ingreso</h3>
<form method="POST" class="grid">
<input type="hidden" name="ingreso_efectivo">
<input type="number" step="0.01" name="monto" placeholder="Monto efectivo" required>
<button class="btn">Agregar Efectivo</button>
</form>
<form method="POST" class="grid" style="margin-top:10px">
<input type="hidden" name="ingreso_banco">
<input type="number" step="0.01" name="monto" placeholder="Monto banca móvil" required>
<button class="btn">Agregar Banco</button>
</form>
</div>

<div class="card">
<h3>➖ Gasto / Deducción</h3>
<form method="POST" class="grid">
<input type="hidden" name="gasto">
<select name="concepto">
<option>GASOLINA</option>
<option>DESPONCHES</option>
<option>FALTANTE</option>
<option>GASTOS GENERALES</option>
<option>TIEMPO AIRE 📱</option>
</select>
<select name="medio">
<option>EFECTIVO</option>
<option>BANCO</option>
</select>
<input type="number" step="0.01" name="monto" required>
<button class="btn">Registrar</button>
</form>
</div>

<?php if($bonoDisponible): ?>
<div class="card" style="background:#eafaf1">
<h3>🎁 Bono Disponible</h3>
<form method="POST">
<input type="hidden" name="gasto">
<input type="hidden" name="concepto" value="BONO">
<input type="hidden" name="medio" value="EFECTIVO">
<input type="hidden" name="monto" value="5000">
<button class="btn">Cobrar Bono</button>
</form>
</div>
<?php endif; ?>

<div class="card fixed">
<h3>📋 Historial</h3>
<table width="100%">
<tr>
<th>Fecha</th>
<th>Tipo</th>
<th>Concepto</th>
<th>Medio</th>
<th>Monto</th>
<th>Cliente</th>
</tr>
<?php
$h = $conexion->query("
SELECT 
    c.fecha,
    c.tipo,
    c.concepto,
    c.medio,
    c.monto,
    CONCAT(cl.nombre,' ',cl.apellido) AS cliente_nombre
FROM caja c
LEFT JOIN prestamos p 
    ON p.id_empleado = c.id_empleado 
    AND p.monto_prestado = c.monto
    AND DATE(p.fecha_inicio) = DATE(c.fecha)
LEFT JOIN clientes cl 
    ON cl.id_cliente = p.id_cliente
WHERE c.id_empleado = $id_empleado
ORDER BY c.fecha DESC
");

while($r=$h->fetch_assoc()):
?>
<tr>
<td><?=date('d/m/Y H:i',strtotime($r['fecha']))?></td>
<td><?=$r['tipo']?></td>
<td><?=$r['concepto']?></td>
<td><?=$r['medio']?></td>
<td>$<?=number_format($r['monto'],2)?></td>
<td><?= $r['cliente_nombre'] ?? '-' ?></td>
</tr>
<?php endwhile; ?>
</table>
</div>

</div>
</body>
</html>
