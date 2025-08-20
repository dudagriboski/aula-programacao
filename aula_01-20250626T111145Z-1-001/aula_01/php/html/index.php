<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Pessoa</title>
</head>
<body>
    <?php
        function Salvar($nome, $cpf, $endereco){
            $connection = require("dbfactory.php");                        
            $sql = "INSERT INTO pessoa (nome, cpf, endereco) VALUES ('$nome', '$cpf', '$endereco')";
            $connection->query($sql);
            $connection->close();
        }

        function Recuperar(){
            $connection = require("dbfactory.php");
            $sql = "SELECT idpessoa, nome, cpf, endereco FROM pessoa";
            $result = $connection->query($sql);

            echo "<table border='1'>";
            echo "<tr><th>Nome</th><th>CPF</th><th>Endereço</th><th>Ações</th></tr>";

            while ($row = $result->fetch_assoc()) {  
                $rowid = "'" . $row["idpessoa"] . "'";       
                $nome = $row["nome"];
                $cpf = $row["cpf"];
                $endereco = $row["endereco"];

                echo "<tr id='pessoa_" . $row["idpessoa"] . "'>"                        
                        . "<td><input type='text' class='valor-nome' value='$nome'/></td>"
                        . "<td><input type='text' class='valor-cpf' value='$cpf'/></td>"
                        . "<td><input type='text' class='valor-endereco' value='$endereco'/></td>"
                        . "<td>"
                            . "<button onclick=removerPessoa($rowid)>Remover</button> "
                            . "<button onclick=atualizarPessoa($rowid)>Atualizar</button>"
                        . "</td>"                                            
                    . "</tr>";
            }
            echo "</table>";

            $connection->close();
        }

        // POST -> insere
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = htmlspecialchars($_POST['nome']); 
            $cpf = htmlspecialchars($_POST['cpf']); 
            $endereco = htmlspecialchars($_POST['endereco']); 

            if(!empty($nome) && !empty($cpf) && !empty($endereco)){
                Salvar($nome, $cpf, $endereco);
            }
            Recuperar();           
        }

        // GET -> lista
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            Recuperar();        
        }

        // DELETE -> remover
        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $idRemover = $_GET['id']; 
            echo "Pegou para remover: ". $idRemover;           
        }
    ?>
    
    <form method="post">
        <label for="nome">Nome:</label>
        <input name="nome" id="nome" type="text" required>

        <label for="cpf">CPF:</label>
        <input name="cpf" id="cpf" type="text" required>

        <label for="endereco">Endereço:</label>
        <input name="endereco" id="endereco" type="text" required>

        <button type="submit">Enviar</button>
    </form> 
</body>
<script src="/js/index.js"></script>
</html>
