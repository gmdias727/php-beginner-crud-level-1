<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO - Read One Record - PHP CRUD Tutorial</title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Read Product</h1>
        </div>
         
        <?php
        
        // passa o valor do parâmetro, nesse caso, a gravação do ID
        // isset() é uma função do PHP usada para verificar se o valor está presente ou não 
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERRO: ID de gravação não encontrado.');

        // incluir conexão com banco de dados
        include 'config/database.php';

        // Ler dado de gravação atual
        try {
            // prepara seleção de query
            $query = "SELECT id, name, description, price FROM products WHERE id = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );

            // este é o primeiro ponto de interrogação
            $stmt->bindParam(1, $id);

            // executa a query
            $stmt->execute();

            // armazena a linha recuperarada em uma variável
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // valores para enxer nosso formulário
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
        
        } catch(PDOException $exception){
            die('ERRO: ' . $exception->getMessage());
        }

        ?>
 
        <table class="table table-hover table-responsive table-bordered">
            <tr>
                <td>Name</td>
                <td><?php echo htmlspecialchars($name, ENT_QUOTES); ?> </td>
            </tr>

            <tr>
                <td>Description</td>
                <td> <?php echo htmlspecialchars($description); ?> </td>
            </tr>

            <tr>
                <td>Price</td>
                <td> <?php echo htmlspecialchars($price, ENT_QUOTES); ?> </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <a href="index.php" class="btn btn-danger">Voltar para ler produtos</a>
                </td>
            </tr>
        </table>
        


    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>