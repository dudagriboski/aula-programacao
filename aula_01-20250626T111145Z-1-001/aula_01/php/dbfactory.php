<?php
    $mysqli = new mysqli("localhost","root","root","prog_2");

if ($mysqli->connect_errno) {
    die("Falha na conexão com o MySQL: " . $mysqli->connect_error);
}

return $mysqli;
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    }
    return $mysqli;
?>
