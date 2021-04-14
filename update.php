<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update a Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1> Atualizar produto </h1>
        </div>

        <?php
// recupere o valor do parâmetro, nesse caso, o ID de gravação
// isset() é uma função do PHP usada para verificar se está presente ou não
$id = isset($_GET['id']) ? $_GET['id'] : die('Erro: ID de gravação não encontrado');

// incluir conexão com banco de dados
include 'config/database.php';

// Ler dado de gravação atual
try {

    // preparar seleção de query
    $query = "SELECT id, name, description, price FROM products WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare($query);

    // este é o primeiro ponto de interrogação
    $stmt->bindParam(1, $id);

    // executa a query
    $stmt->execute();

    // armazena a linha recuperada em uma variável.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // valor para preencherem nosso formulário
    $name = $row['name'];
    $description = $row['description'];
    $price = $row['price'];

} catch (PDOException $exception) {
    // mostra erro
    die('Erro: ' . $exception->getMessage());
}
?>

        <!-- Checa se o formulário foi preenchido -->
        <?php

if ($_POST) {
    try {
        // escreva uma query de atualização
        // neste caso que temos muitos campos
        // a serem passados, portanto é melhor
        // rotulá-los e não usar pontos de interrogação

        $query = "UPDATE products
                                SET name=:name, description=:description, price=:price
                                WHERE id = :id";

        // preparar query para execução
        $stmt = $con->prepare($query);

        // valores postados
        $name = htmlspecialchars(strip_tags($_POST['name']));
        $description = htmlspecialchars(strip_tags($_POST['description']));
        $price = htmlspecialchars(strip_tags($_POST['price']));

        // aninhar parâmetros
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id', $id);

        // executa a query
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Gravação atualizada com sucesso. </div>";
        } else {
            echo "<div class='alert alert-danger'> Não foi possível atualizar, tente novamente.</div>";
        }

        // mostrar erros
    } catch (PDOException $exception) {
        die('Erro: ' . $exception->getMessage());
    }
}

?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="POST">
            <table class="table table-hover table-responsive table-bordered">
                <tr>
                    <td>Nome</td>
                    <td><input type='text' name='name' value='<?php echo htmlspecialchars($name, ENT_QUOTES); ?>' class="form-control"> </td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td> <textarea name="description" class="form-control"> <?php echo htmlspecialchars($description, ENT_QUOTES); ?> </textarea> </td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td><input type='text' name='price' value='<?php echo htmlspecialchars($price, ENT_QUOTES); ?>'> </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Salvar' class='btn btn-primary'>
                        <a href='index.php' class="btn btn-danger">Voltar ler produtos</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>