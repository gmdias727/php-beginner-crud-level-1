<?php
// incluir conexão com banco de dados
include 'config/database.php';

try {
    // pegar ID de registro
    // isset() é uma função usada para verificar se o valor
    // está presente ou não
    $id = isset($_GET['id']) ? $_GET['id'] : die('Erro: ID de registo não encontrado');

    // query de delete/deletar
    $query = "DELETE FROM products WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $id);

    if ($stmt->execute()){
        // redireciona para ler a pagina de registros e
        // falar pro usuário que o registro foi deletado
        header('Location: index.php?action=deleted');
    } else {
        die('Não foi possível apagar registro');
    }

} catch(PDOException $exception) {
    // mostra erro
    die('Erro: ' . $exception->getMessage());
}