<?php

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {    
    $id = $_GET['id'] ?? null;    
    if ($id !== null) {
        $connection = require("dbfactory.php");
        $sql = @"DELETE FROM Todo WHERE IdTodo = $id"; 
        $connection->query($sql);
        $connection -> close();        
    }    
} else {
    echo "This script only handles DELETE requests.";
}
?>