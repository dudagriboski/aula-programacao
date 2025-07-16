<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoa</title>
</head>
<body>
    <h1>Cadastrar Pessoa</h1>
    <form method="post" action="processar.php">
        <label for="nome">Nome:</label>
        <input name="nome" id="nome" type="text" required><br><br>

        <label for="cpf">CPF:</label>
        <input name="cpf" id="cpf" type="text" required><br><br>

        <label for="endereco">Endereço:</label>
        <input name="endereco" id="endereco" type="text" required><br><br>

        <button type="submit">Salvar</button>
    </form>

    <br><br>
    <a href="processar.php">Ver lista de pessoas cadastradas</a>
</body>
</html>
