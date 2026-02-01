<?php include("conexion.php"); ?>

<form method="GET">
    Nombre / Teléfono / CURP:
    <input type="text" name="dato">
    <button>Buscar</button>
</form>

<?php
if (isset($_GET['dato'])) {
    $dato = $_GET['dato'];

    $res = $conexion->query("
        SELECT * FROM clientes
        WHERE nombre LIKE '%$dato%'
        OR telefono LIKE '%$dato%'
        OR ine_curp LIKE '%$dato%'
    ");

    while ($c = $res->fetch_assoc()) {
        echo "<hr>";
        echo "ID: ".$c['id_cliente']."<br>";
        echo $c['nombre']." ".$c['apellido']."<br>";
        echo "Tel: ".$c['telefono']."<br>";
        echo "Estatus: ".$c['estatus']."<br>";
    }
}
?>
