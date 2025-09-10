<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Livros</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h2>📘 Lista de Livros</h2>
    <a href="livro_inserir.php" class="btn btn-success mb-3">+ Novo Livro</a>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th><th>Título</th><th>Descrição</th><th>Autor</th><th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $res = $conn->query("SELECT * FROM Livro");
        while ($row = $res->fetch_assoc()) {
          echo "<tr>
                  <td>{$row['Id']}</td>
                  <td>{$row['Titulo']}</td>
                  <td>{$row['Descricao']}</td>
                  <td>{$row['Autor']}</td>
                  <td>
                    <a href='livro_editar.php?id={$row['Id']}' class='btn btn-primary btn-sm'>Editar</a>
                    <a href='livro_excluir.php?id={$row['Id']}' class='btn btn-danger btn-sm'>Excluir</a>
                  </td>
                </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
