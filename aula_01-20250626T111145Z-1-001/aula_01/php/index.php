<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
</head>
<body>
    <?php
 function Salvar($nome, $cpf, $endereco) {
    $connection = require("dbfactory.php");

    $sql = "INSERT INTO pessoa (nome, cpf, endereco) VALUES ('$nome', '$cpf', '$endereco')";
    if ($connection->query($sql)) {
        echo "<p>Pessoa cadastrada com sucesso!</p>";
    } else {
        echo "<p>Erro: " . $connection->error . "</p>";
    }

    $connection->close();
}

function Recuperar() {
    $connection = require("dbfactory.php");

    $sql = "SELECT idpessoa, nome, cpf, endereco FROM pessoa";
    $result = $connection->query($sql);

    echo "<h2>Pessoas cadastradas:</h2>";

    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Nome</th><th>CPF</th><th>Endereço</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['idpessoa']}</td>
                    <td>{$row['nome']}</td>
                    <td>{$row['cpf']}</td>
                    <td>{$row['endereco']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nenhuma pessoa cadastrada.</p>";
    }

    $connection->close();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = htmlspecialchars($_POST["nome"]);
    $cpf = htmlspecialchars($_POST["cpf"]);
    $endereco = htmlspecialchars($_POST["endereco"]);

    if (!empty($nome) && !empty($cpf) && !empty($endereco)) {
        Salvar($nome, $cpf, $endereco);
    }
}


Recuperar();
?>
    <form method="post"  >
        <label for="todo-nome">nome:</label>
        <input name="nome" id="nome" type="text">
             <label for="todo-cpf">cpf:</label>
        <input name="cpf" id="cpf" type="text">
             <label for="todo-endereco">endereço:</label>
        <input name="endereco" id="endereco" type="text">
        <button type="submit">Enviar</button>
    </form> 
</body>
</html>