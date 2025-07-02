<?php

$mysqli = new mysqli("localhost", "root", "root", "prog_2");

if($mysqli -> connect_error){
    echo "Failed to connect to MySQL:".$mysqli -> connect_error;
    exit();
}

if ($result = $mysqli -> query(@"INSERT INTO todo (idtodo, description) VALUES ((select max(idtodo)+1 from todo),
                         'fazer ola mundo no php.');")){
echo "Returned rows are: " . $result -> num_rows;
$result -> free_result();
}

$mysqli -> close();

?>