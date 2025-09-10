<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Inserir Livro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h2>Inserir Livro</h2>
    <form method="POST">
      <input type="text" name="titulo" class="form-control mb-2" placeholder="Título" required>
      <input type="text" name="descricao" class="form-control mb-2" placeholder="Descrição" required>
      <input type="text" name="autor" class="form-control mb-2" placeholder="Autor" required>
      <button type="submit" class="btn btn-success">Salvar</button>
      <a href="livro_listar.php" class="btn btn-secondary">Voltar</a>
    </form>
  </div>
</body>
</html>

<?php
if ($_POST) {
  $titulo = $_POST['titulo'];
  $descricao = $_POST['descricao'];
  $autor = $_POST['autor'];

  $sql = "INSERT INTO Livro (Titulo, Descricao, Autor) VALUES ('$titulo','$descricao','$autor')";
  if ($conn->query($sql) === TRUE) {
    header("Location: livro_listar.php");
    exit;
  } else {
    echo "Erro: " . $conn->error;
  }
}
?>
