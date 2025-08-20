<?php
$connection = require("dbfactory.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $endereco = $_POST['endereco'];
        
        $stmt = $connection->prepare("UPDATE pessoa SET nome=?, cpf=?, endereco=? WHERE idpessoa=?");
        $stmt->bind_param("sssi", $nome, $cpf, $endereco, $id);
        $stmt->execute();
        $stmt->close();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $id = $_GET['id'];
    $stmt = $connection->prepare("DELETE FROM pessoa WHERE idpessoa=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

$connection->close();
?>
