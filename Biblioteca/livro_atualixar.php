<?php
include 'conexao.php';

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$autor = $_POST['autor'];

$sql = "UPDATE Livro SET Titulo='$titulo', Descricao='$descricao', Autor='$autor' WHERE Id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: livro_listar.php");
    exit;
} else {
    echo "Erro: " . $conn->error;
}
?>
