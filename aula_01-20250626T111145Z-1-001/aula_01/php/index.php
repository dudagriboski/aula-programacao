<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $mysqli = new mysqli("localhost", "root", "root", "prog00");
    ?>
    <form action="processar.php" method="post">
        <label for ="todo-description"> Descriçao da tarefa:</label>
        <Iput name = "description" id="todo-description" type="text">
            <button type="submit">Enviar<button>


</form>
</body>
</html>
