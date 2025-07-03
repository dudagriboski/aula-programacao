<?php
$mysqli = new mysqli("localhost", "root", "root", "prog_2");

if($mysqli -> connect_errno){
    echo "Failed to connect to MySQL:"  . $mysqli -> connect_erro;
}
return $mysqli;
?>