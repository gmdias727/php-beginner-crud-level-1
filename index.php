<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO - Read Records </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    
    <!-- Custom CSS -->
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>
</head>
<body>
    <!-- Container -->
    <div class="container">
        <div class="page-header">
            <h1>Ler produtos</h1>
        </div>
    
    <!-- PHP code goes here -->
    <?php

    // incluir banco de dados
    include 'config/database.php';

    $action = isset($_GET['action']) ? $_GET['action'] : "";
    
    // se foi redirecionado do delete.php
    if($action=='deleted'){
        echo "<div class='alert alert-success'>Registro deletado com sucesso</div>";
    }



    // selecionar todos os dados
    $query = "SELECT id, name, description, price FROM products ORDER BY id DESC";
    $stmt = $con->prepare($query);
    $stmt->execute();

    // é dessa maneira que se retorna a contagem de colunas
    $num = $stmt->rowCount();

    // link para criar formulário de gravação
    echo "<a href='create.php' class='btn btn-primary m-b-1em'> Create New Product <a>";

    // verifica se foram encontradas gravações maiores que zero
    if($num > 0){
        // dados do banco estarão aqui
        echo "<table class='table table-hover table-responsive table-bordered'>"; // começo da mesa
        
        // criando nosso cabeçalho
        echo "<tr>";
            echo "<th> ID </th>";
            echo "<th> Nome </th>";
            echo "<th> Descrição </th>";
            echo "<th> Preço </th>";
            echo "<th> Ações </th>";
        echo "</tr>";

        // recuperar couteúdo da tabela
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extrai a linha/fila
            // isso apenas fará $row['primeiroNome'] para
            // apenas $primeiroNome 

            extract($row);

            // Cria uma nova linha na tabela por cada gravação
            echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$name}</td>";
                echo "<td>{$description}</td>";
                echo "<td> $ {$price}</td>";
                
                echo "<td>";

                // ler uma gravação
                echo "<a href='read_one.php?id={$id}' class='btn btn-info m-r-1em'> Ler </a>";

                // iremos usar estes links na proxima parte
                echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'> Editar </a>";
            
                // iremos usar estes links na proxima parte
                echo "<a href='#' onclick='delete_user({$id});' class='btn btn-danger'> Deletar </a>";

                echo "</tr>";

            echo "</tr>"; 
        }

        // fim da tabela
        echo "</table>";
    
    } else {
        // caso não encontre gravações 
        echo "<div class='alert alert-danger'> Nenhuma gravação encontrada </div>";
    }


?>

    </div> <!-- end of container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
    // confirme gravação à deletar
    function delete_user(id){
        var answer = confirm('Tem certeza?');
        if (answer){
            // se o usuário confirmou,
            // passa o ID para o delete.php e executa
            //  a query para apagar
            window.location = 'delete.php?id=' + id;
        }
    }
</script>

</body>
</html>