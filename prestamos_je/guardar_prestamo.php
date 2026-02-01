$conexion->query("
INSERT INTO caja(tipo,monto,concepto,id_empleado)
VALUES('SALIDA',$monto_prestado,'Nuevo préstamo',$id_asesor)
");
