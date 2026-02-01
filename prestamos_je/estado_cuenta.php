<?php
include("conexion.php");
require("fpdf.php");

$id_cliente = $_GET['id'];

// Datos del cliente
$cliente = $conexion->query("
    SELECT * FROM clientes WHERE id_cliente=$id_cliente
")->fetch_assoc();

// Préstamos del cliente
$prestamos = $conexion->query("
    SELECT pr.*, 
    IFNULL(SUM(pa.monto_pagado),0) AS pagado
    FROM prestamos pr
    LEFT JOIN pagos pa ON pr.id_prestamo = pa.id_prestamo
    WHERE pr.id_cliente=$id_cliente
    GROUP BY pr.id_prestamo
");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","B",14);

// TÍTULO
$pdf->Cell(0,10,"ESTADO DE CUENTA - PRESTAMOS JE",0,1,"C");
$pdf->Ln(5);

// CLIENTE
$pdf->SetFont("Arial","",11);
$pdf->Cell(0,8,"Cliente: ".$cliente['nombre']." ".$cliente['apellido'],0,1);
$pdf->Cell(0,8,"Telefono: ".$cliente['telefono'],0,1);
$pdf->Cell(0,8,"Direccion: ".$cliente['direccion'],0,1);
$pdf->Ln(5);

// TABLA
$pdf->SetFont("Arial","B",10);
$pdf->Cell(30,8,"Prestamo",1);
$pdf->Cell(30,8,"Monto",1);
$pdf->Cell(30,8,"Pagado",1);
$pdf->Cell(30,8,"Saldo",1);
$pdf->Cell(30,8,"Estado",1);
$pdf->Ln();

$pdf->SetFont("Arial","",10);

while ($p = $prestamos->fetch_assoc()) {
    $saldo = $p['total_pagar'] - $p['pagado'];

    $pdf->Cell(30,8,$p['id_prestamo'],1);
    $pdf->Cell(30,8,"$".$p['total_pagar'],1);
    $pdf->Cell(30,8,"$".$p['pagado'],1);
    $pdf->Cell(30,8,"$".$saldo,1);
    $pdf->Cell(30,8,$p['estado'],1);
    $pdf->Ln();
}

$pdf->Ln(10);
$pdf->Cell(0,8,"Gracias por su preferencia.",0,1,"C");

$pdf->Output();
?>
