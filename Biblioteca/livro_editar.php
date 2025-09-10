<?php 
include 'conexao.php'; 
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM Livro WHERE Id=$id");
$livro = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Livro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h2>Editar Livro</h2>
    <form method="POST" action="livro_atualizar.php">
      <input type="hidden" name="id" value="<?php echo $livro['Id']; ?>">
      <input type="text" name="titulo" class="form-control mb-2" value="<?php echo $livro['Titulo']; ?>" required>
      <input type="text" name="descricao" class="form-control mb-2" value="<?php echo $livro['Descricao']; ?>" required>
      <input type="text" name="autor" class="form-control mb-2" value="<?php echo $livro['Autor']; ?>" required>
      <button type="submit" class="btn btn-primary">Atualizar</button>
      <a href="livro_listar.php" class="btn btn-secondary">Cancelar</a>
    </form>
  </div>
</body>
