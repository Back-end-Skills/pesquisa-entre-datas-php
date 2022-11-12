<?php include_once 'connection.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Como Pesquisar Entre Datas Com php</title>
</head>
<body>

    <h1>Pesquisar Entre Datas</h1>

    <?php 

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //var_dump($dados);
        
    ?>

    <form action="" method="post">
        <?php 
            $inicio = "";
            if(isset($dados['inicio']))
            {
                $inicio = $dados['inicio'];
            }
            if(isset($dados['final']))
            {
                $inicio = $dados['final'];
            }
        ?>
        <label for="">Data Inicial</label>
        <input type="date" name="inicio" value="<?php echo $dados['inicio']; ?>"><br><br>
        
        <label for="">Data Final</label>
        <input type="date" name="final" value="<?php echo $dados['final']; ?>"><br><br>

        <input type="submit" name="search" value="Pesquisar" />
    </form>

    <?php
        if(!empty($dados['search']))
        {
            //var_dump($dados);
            $query_user = "SELECT * FROM conta WHERE data_create BETWEEN :data_inicio AND :data_final";
            $result = $conn->prepare( $query_user);
            $result->bindParam(':data_inicio', $dados['inicio']);
            $result->bindParam(':data_final', $dados['final']);

            $result->execute();

            while($row_user = $result->fetch(PDO::FETCH_ASSOC)){
                // echo "<pre>"; var_dump($row_user); echo "</pre>";
                
                // Extrai nome da coluna
                extract($row_user);

                // Usar nome da coluna como variável
                echo "Id =  $id_conta <br>";
                echo "Agencia = " . $row_user['codigo_agencia'] . "<br>";

                //Converter a data formato br
                $data_br = date('d-m-Y H:i:s', strtotime($row_user['data_create']));

                echo "Agencia = " . $data_br . "<br>";
                echo "<hr>";
            }
        }
    ?>
    
</body>
</html>