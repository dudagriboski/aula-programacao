<?php
$connection = require("dbfactory.php");

// Inserção (se tiver dados via POST)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nome"])) {
    $nome = $connection->real_escape_string($_POST["nome"]);
    $cpf = $connection->real_escape_string($_POST["cpf"]);
    $endereco = $connection->real_escape_string($_POST["endereco"]);

    $sql = "INSERT INTO Pessoa (nome, cpf, endereco) VALUES ('$nome', '$cpf', '$endereco')";
    if ($connection->query($sql)) {
        echo "<p>Pessoa cadastrada com sucesso!</p>";
    } else {
        echo "<p>Erro ao cadastrar: " . $connection->error . "</p>";
    }
}

// Exibição da tabela
echo "<h2>Lista de Pessoas</h2>";
$result = $connection->query("SELECT * FROM Pessoa");

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Nome</th><th>CPF</th><th>Endereço</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['cpf']}</td>
                <td>{$row['endereco']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>Nenhuma pessoa cadastrada ainda.</p>";
}

$connection->close();
?>
<br><br>
<a href="index.php">Voltar para o formulário</a>
