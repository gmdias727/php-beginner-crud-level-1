<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>

<body>
    <!-- Container -->
    <div class="container">
        <div class="page-header">
            <h1>Create Product</h1>
        </div>
    </div>

    <?php

    if($_POST){

        // incluir conexão com banco de dados
        include "config/database.php";

        try{
            // inserir query
            $query = "INSERT INTO products SET name=:name, description=:description, price=:price, created=:created";

            // preparar query para execução
            $stmt = $con->prepare($query);

            // valores postos
            $name = htmlspecialchars(strip_tags($_POST['name']));
            $description = htmlspecialchars(strip_tags($_POST['description']));
            $price = htmlspecialchars(strip_tags($_POST['price']));
            
            // bind the parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);

            // especifica quando essa gravação foi inserida no banco de dados
            $created = date('Y-m-d H:i:s');
            $stmt->bindParam(':created', $created);
            
            // Executa a query
            if($stmt->execute()){
                echo "<div class='alert alert-success'>Gravação foi salva.</div>";
            } else {
                echo "<div class='alert alert-danger'>Não foi possível salvar a gravação</div>";
            }
        }
        // mostra erro
        catch(PDOException $exception){
            die('ERRO: ' . $exception->getMessage());
        }
    }


    ?>

    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <table class="table table-hover table-responsive table-bordered">
                <tr>
                    <td>Nome</td>
                    <td><input type="text" name="name" class="form-control"></td>
                </tr>
                
                <tr>
                    <td>Descrição</td>
                    <td><textarea name="description" class="form-control"></textarea></td>
                </tr>
                
                <tr>
                    <td>Preço</td>
                    <td><input type="text" name="price" class="form-control"></td>
                </tr>
                
                <tr>
                    <td>
                        <input type="submit" value="Salvar" class="btn btn-primary">
                        <a href="index.php" class="btn btn-danger">Voltar para ler produtos</a>
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