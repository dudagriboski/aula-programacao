<?php
// Ativa a exibição de erros para facilitar a depuração
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Função para inserir pessoa no banco de dados
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

// Função para recuperar e exibir as pessoas do banco de dados
function Recuperar(){
    $connection = require("dbfactory.php");
    $sql = "SELECT idpessoa, nome, cpf, endereco FROM pessoa";
    $result = $connection->query($sql);

    echo "<table border='1'>";
    echo "<tr><th>Nome</th><th>CPF</th><th>Endereço</th><th>Ações</th></tr>";

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
    echo "</table>";

    $connection->close();
}

// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $nome = htmlspecialchars($_POST['nome']);
    $cpf = htmlspecialchars($_POST['cpf']);
    $endereco = htmlspecialchars($_POST['endereco']);

    // Verifica se os campos não estão vazios
    if (!empty($nome) && !empty($cpf) && !empty($endereco)) {
        // Chama a função para salvar os dados no banco
        Salvar($nome, $cpf, $endereco);
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}

// Após a submissão do formulário ou carregamento da página, exibe a lista de pessoas cadastradas
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
    
    <!-- Formulário de cadastro -->
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

    <!-- Aqui, a tabela será gerada automaticamente a partir da função Recuperar() -->

    <script>
        // Função para remover pessoa
        function removerPessoa(id) {
            if (confirm('Tem certeza que deseja excluir essa pessoa?')) {
                fetch(`/script.php?id=${id}`, {
                    method: 'DELETE',
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    document.getElementById(`pessoa_${id}`).remove();  // Remove a linha da tabela
                })
                .catch(error => console.error('Erro ao excluir:', error));
            }
        }

        // Função para atualizar pessoa
        function atualizarPessoa(id) {
            const nome = document.querySelector(`#pessoa_${id} .valor-nome`).value;
            const cpf = document.querySelector(`#pessoa_${id} .valor-cpf`).value;
            const endereco = document.querySelector(`#pessoa_${id} .valor-endereco`).value;

            fetch(`/script.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${id}&nome=${nome}&cpf=${cpf}&endereco=${endereco}`,
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
            })
            .catch(error => console.error('Erro ao atualizar:', error));
        }
    </script>
</body>
</html>
