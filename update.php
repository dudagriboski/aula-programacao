<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {   
    $connection = require("dbfactory.php");
<<<<<<< HEAD

   
=======
>>>>>>> b57e35d342e0d8bc47c5dab9f4f796c219437322
    $putData = json_decode(file_get_contents('php://input', true));

    $id = $putData->id ?? null;
    $nome = $putData->nome ?? '';
    $cpf = $putData->cpf ?? '';
    $endereco = $putData->endereco ?? '';

    if ($id) {
<<<<<<< HEAD
  
=======
>>>>>>> b57e35d342e0d8bc47c5dab9f4f796c219437322
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
