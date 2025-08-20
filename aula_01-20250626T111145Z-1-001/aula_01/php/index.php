<?php
function Salvar($nome, $cpf, $endereco){
    $connection = require("dbfactory.php");
    $stmt = $connection->prepare("INSERT INTO pessoa (nome, cpf, endereco) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $cpf, $endereco);

    if ($stmt->execute()) {
        echo "Pessoa inserida com sucesso.";
    } else {
        echo "Erro ao inserir pessoa.";
    }

    $stmt->close();
    $connection->close();
}
function Recuperar(){
    $connection = require("dbfactory.php");
    $sql = "SELECT idpessoa, nome, cpf, endereco FROM pessoa";
    $result = $connection->query($sql);

    echo "<table>";
    echo "<thead><tr><th>Nome</th><th>CPF</th><th>Endereço</th><th>Ações</th></tr></thead>";
    echo "<tbody>";

    while ($row = $result->fetch_assoc()) {
        $rowid = $row["idpessoa"];
        $nome = $row["nome"];
        $cpf = $row["cpf"];
        $endereco = $row["endereco"];

        echo "<tr id='pessoa_" . $row["idpessoa"] . "'>"                        
                . "<td><input type='text' class='valor-nome' value='$nome'/></td>"
                . "<td><input type='text' class='valor-cpf' value='$cpf'/></td>"
                . "<td><input type='text' class='valor-endereco' value='$endereco'/></td>"
                . "<td>"
                    . "<button onclick='removerPessoa($rowid)'>Remover</button> "
                    . "<button onclick='atualizarPessoa($rowid)'>Atualizar</button>"
                . "</td>"                                            
            . "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

    $connection->close();
}
function Atualizar($id, $nome, $cpf, $endereco){
    $connection = require("dbfactory.php");
    $stmt = $connection->prepare("UPDATE pessoa SET nome = ?, cpf = ?, endereco = ? WHERE idpessoa = ?");
    $stmt->bind_param("sssi", $nome, $cpf, $endereco, $id);

    if ($stmt->execute()) {
        echo "Pessoa atualizada com sucesso.";
    } else {
        echo "Erro ao atualizar pessoa.";
    }

    $stmt->close();
    $connection->close();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $nome = htmlspecialchars($_POST['nome']);
        $cpf = htmlspecialchars($_POST['cpf']);
        $endereco = htmlspecialchars($_POST['endereco']);
        Atualizar($id, $nome, $cpf, $endereco);
    } else {
        $nome = htmlspecialchars($_POST['nome']);
        $cpf = htmlspecialchars($_POST['cpf']);
        $endereco = htmlspecialchars($_POST['endereco']);
        Salvar($nome, $cpf, $endereco);
    }
}

Recuperar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Pessoa</title>
    
</head>
<body>
    <h1>Cadastro de Pessoa</h1>

    <form method="post">
        <label for="nome">Nome:</label>
        <input name="nome" id="nome" type="text" required>

        <label for="cpf">CPF:</label>
        <input name="cpf" id="cpf" type="text" required>

        <label for="endereco">Endereço:</label>
        <input name="endereco" id="endereco" type="text" required>

        <button type="submit">Enviar</button>
    </form>

    <hr>

    <h2>Lista de Pessoas Cadastradas</h2>

    <script>
        function removerPessoa(id) {
            if (confirm('Tem certeza que deseja excluir essa pessoa?')) {
                fetch(`/script.php?id=${id}`, {
                    method: 'DELETE',
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    document.getElementById(`pessoa_${id}`).remove(); 
                })
                .catch(error => console.error('Erro ao excluir:', error));
            }
        }

        function atualizarPessoa(id) {
            const nome = document.querySelector(`#pessoa_${id} .valor-nome`).value;
            const cpf = document.querySelector(`#pessoa_${id} .valor-cpf`).value;
            const endereco = document.querySelector(`#pessoa_${id} .valor-endereco`).value;
            fetch('/index.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${id}&nome=${nome}&cpf=${cpf}&endereco=${endereco}`,
            })
            .then(response => response.text())
            .then(data => {
                alert('Pessoa atualizada com sucesso!');
                console.log(data);
                location.reload();  
            })
            .catch(error => console.error('Erro ao atualizar:', error));
        }
    </script>
</body>
</html>
