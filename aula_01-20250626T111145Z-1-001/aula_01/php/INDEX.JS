// REMOVER PESSOA
async function removerPessoa(elemento) {    
    var elementoRemover = document.querySelector("#" + elemento);
    elementoRemover.remove();    

    // idpessoa vem do id do elemento (tirando o prefixo, ex: "p1" -> 1)
    await removerBanco(elemento.substring(1, elemento.length));    
    console.log("Removido ID:", elemento);
}

async function removerBanco(idPessoa) {
    await fetch('http://localhost:8080/delete.php?idpessoa=' + idPessoa, {
        method: 'DELETE'
    })
    .then((response) => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.text();
    })
    .then((data) => {
        console.log('Resposta backend:', data);
    })
    .catch((error) => {
        console.error('Erro no fetch:', error);
    });    
}


// ATUALIZAR PESSOA
async function atualizarPessoa(elemento) {
    var elementoAtualizar = document.querySelector("#" + elemento);

    // Pegando os valores dos inputs
    var nome     = elementoAtualizar.querySelector(".valor-nome").value;
    var cpf      = elementoAtualizar.querySelector(".valor-cpf").value;
    var endereco = elementoAtualizar.querySelector(".valor-endereco").value;

    console.log("Atualizando:", nome, cpf, endereco);

    await atualizarBanco(
        elemento.substring(1, elemento.length), // idpessoa
        nome,
        cpf,
        endereco
    );
}

async function atualizarBanco(idPessoa, nome, cpf, endereco) {
    await fetch('http://localhost:8080/update.php', {
        method: 'PUT',
        headers: {
            'Content-type': 'application/json; charset=UTF-8',
        },
        body: JSON.stringify({
            "idpessoa": idPessoa,
            "nome": nome,
            "cpf": cpf,
            "endereco": endereco
        })
    })
    .then((response) => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then((data) => {
        console.log('Resposta backend:', data);
    })
    .catch((error) => {
        console.error('Erro no fetch:', error);
    });  
}
