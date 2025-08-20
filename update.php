<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {   
    $connection = require("dbfactory.php");
    $putData = json_decode(file_get_contents('php://input', true));

    $id = $putData->id ?? null;
    $nome = $putData->nome ?? '';
    $cpf = $putData->cpf ?? '';
    $endereco = $putData->endereco ?? '';

    if ($id) {
        $sql = "UPDATE pessoa SET nome = '$nome', cpf = '$cpf', endereco = '$endereco' WHERE idpessoa = $id";

        if ($connection->query($sql)) {
            $response = [
                'success' => true,
                'message' => 'Registro atualizado com sucesso.',
                'data' => $putData
            ];
        } else {
            $response = [
                'success' => false,
                'error' => $connection->error
            ];
        }
    } else {
        $response = [
            'success' => false,
            'error' => 'ID não informado'
        ];
    }

    $connection->close();

    echo json_encode($response);
} else {
    echo json_encode([
        'error' => 'Invalid request method'
    ]);
}
?>