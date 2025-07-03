<?php
$connection = require("dbfactory.php");

return $mysquli;



$descricao = $_POST['description'];

//Insert
if($result - $mysqli ->
query (@'INSERT INTO  todo (description) VALUES($descricao);')){
    echo "Return row are:" . $result -> num_rows;
    //free result
    //$result -> free_result();
}



$mysqli -> close();

?>