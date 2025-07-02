<?php

$mysqli = new mysqli("localhost", "root", "root", "prog_2");

if($mysqli -> connect_error){
    echo "Failed to connect to MySQL:".$mysqli -> connect_error;
    exit();
}

if ($_SERVER['REQUEST_METHOD']=='POST'){
    Somar($_POST['numero1'], $_POST['numero2']);
    Multiplicar($_POST['numero1'], $_POST['numero2']);
    Dividir($_POST['numero1'], $_POST['numero2']);
    Subtrair($_POST['numero1'], $_POST['numero2']);
}

function Somar ($n1, $n2){
    echo $n1 + $n2;
}

function Multiplicar ($n1, $n2){
    echo $n1 * $n2;
}

function Dividir ($n1, $n2){
    echo $n1 / $n2;
}

function Subtrair ($n1, $n2){
    echo $n1 - $n2;}
?>