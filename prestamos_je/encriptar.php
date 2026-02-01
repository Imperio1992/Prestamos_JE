<?php
include("conexion.php");

$res = $conexion->query("SELECT id_usuario, password FROM usuarios");

while ($u = $res->fetch_assoc()) {

    // Si ya está encriptada, la saltamos
    if (strlen($u['password']) > 20) continue;

    $hash = password_hash($u['password'], PASSWORD_DEFAULT);

    $conexion->query("
        UPDATE usuarios 
        SET password='$hash' 
        WHERE id_usuario={$u['id_usuario']}
    ");
}

echo "Contraseñas encriptadas correctamente";
