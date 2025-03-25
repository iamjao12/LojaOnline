<!DOCTYPE html>
<?php
    include_once './functions/bd.php';
    $bd = conectar();

    $id_compra = filter_input(INPUT_GET, "numero_compra", FILTER_SANITIZE_SPECIAL_CHARS);

    $query = "SELECT c.numero_compra, p.nome_pro, ic.valor, ic.quantidade FROM 
            compra c 
        INNER JOIN 
            itemcompra ic ON c.numero_compra = ic.numero_compra 
        INNER JOIN  
            produto p ON ic.codigo_prod = p.codigo_prod 
        WHERE 
            c.numero_compra = '$id_compra'";
    $resultado = $bd->query($query);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itens da Compra: <?=$id_compra?></title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
            position: relative;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #71129E;
            color: #fff;
            font-size: 16px;
            margin: 5px;
        }
        a {
            text-decoration: none;
        }
        .back-button {
            position: fixed;
            top: 10px;
            left: 10px;
        }
    </style>
</head>
<body>
    <div class="back-button">
        <a href="pedidos.php"><button>Voltar</button></a>
    </div>
    <div class="container">
        <h2>Itens da Compra: <?=$id_compra?></h2>
        <table>
            <thead>
                <tr>
                    <th>Número da Compra</th>
                    <th>Nome do Produto</th>
                    <th>Valor do Produto</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($comp = $resultado->fetch()){
                    echo "<tr>";
                    echo "<td>".$comp["numero_compra"]."</td>";
                    echo "<td>".$comp["nome_pro"]."</td>";
                    echo "<td>".$comp["valor"]."</td>";
                    echo "<td>".$comp["quantidade"]."</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
