<?php
$connection = require("dbfactory.php");

$descricao=$_POST['description'];


if($result=$connection->query("INSERT INTO todo (description) VALUES ('$descricao')")){
    echo"inserido com sucesso";
}


if($result=$connection->query("SELECT * FROM todo")){
        echo "returned rows are:" .$result -> num_rows;
}
$connection -> close();

?>