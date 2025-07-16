<?php
$mysqli = new mysqli("localhost", "root", "root", "prog_2");

if ($mysqli->connect_errno) {
    echo "Erro na conexão com MySQL: " . $mysqli->connect_error;
    exit;
}

return $mysqli;
?>
