<?php
include 'conexao.php';
$id = $_GET['id'];

$sql = "DELETE FROM Livro WHERE Id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: livro_listar.php");
    exit;
} else {
    echo "Erro: " . $conn->error;
}
?>
