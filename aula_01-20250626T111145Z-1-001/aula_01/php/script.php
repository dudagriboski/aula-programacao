<?php

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

// Função para atualizar pessoa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];

    $connection = require("dbfactory.php");
    $stmt = $connection->prepare("UPDATE pessoa SET nome = ?, cpf = ?, endereco = ? WHERE Idpessoa = ?");
    $stmt->bind_param("sssi", $nome, $cpf, $endereco, $id);

    if ($stmt->execute()) {
        echo "Pessoa atualizada com sucesso.";
    } else {
        echo "Erro ao atualizar pessoa.";
    }

    $stmt->close();
    $connection->close();
}

// Função para excluir pessoa
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'] ?? null;
    
    if ($id !== null) {
        $connection = require("dbfactory.php");
        $stmt = $connection->prepare("DELETE FROM pessoa WHERE Idpessoa = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Pessoa excluída com sucesso.";
        } else {
            echo "Erro ao excluir pessoa.";
        }

        $stmt->close();
        $connection->close();
    }
}

// Função para exibir todas as pessoas
function Recuperar() {
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
?>
