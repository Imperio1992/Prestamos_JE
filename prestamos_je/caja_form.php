<form method="POST" action="guardar_caja.php">

    <label>Monto</label>
    <input type="number" step="0.01" name="monto" required>

    <label>Tipo</label>
    <select name="tipo" required>
        <option value="ENTRADA">Entrada</option>
        <option value="SALIDA">Salida</option>
    </select>

    <label>Medio</label>
    <select name="medio" required>
        <option value="EFECTIVO">Efectivo</option>
        <option value="BANCO">Banco</option>
    </select>

    <label>Concepto</label>
    <input type="text" name="concepto">

    <button type="submit">Guardar</button>

</form>
