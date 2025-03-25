<!DOCTYPE html>
<?php
    include_once '../../functions/bd.php';
    $bd = conectar();
    $consulta = "SELECT produto.*, status.nome_status
                    FROM produto
                    INNER JOIN status ON produto.id_status = status.id_status
                    ORDER BY produto.codigo_prod;";
    $resultado = $bd -> query($consulta);
    $erro=filter_input(INPUT_GET,"erro",FILTER_SANITIZE_SPECIAL_CHARS);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        a {
            text-decoration: none;
        }
        button {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 10px;
            background-color: #71129E;
            color: #fff;
            font-size: 14px;
            margin-right: 5px;
            transition: background-color 0.3s ease;
        }
    </style>
    <script>
        function confirmDeletion(event, url) {
            event.preventDefault();
            if (confirm("Você tem certeza que deseja excluir este produto?")) {
                window.location.href = url;
            }
        }
    </script>
</head>
<body>
    <div class="error-message">
        <?=$erro?>
    </div>
    <div class="container">
        <h1>Produtos</h1>
        <a href="../../admin.php"><button>Voltar</button></a>
        <a href="novoproduto.php"><button>Adicionar Produto</button></a>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor Unitário</th>
                    <th>Quantidade</th>
                    <th>Categoria</th>
                    <th>Status</th>
                    <th>Edição</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($prod = $resultado->fetch()){
                        echo "<tr>";
                        echo "<td>";
                        echo $prod["codigo_prod"];
                        echo "</td>";
                        echo "<td>";
                        echo $prod["nome_pro"];
                        echo "</td>";
                        echo "<td>";
                        echo $prod["descricao"];
                        echo "</td>";
                        echo "<td>";
                        echo $prod["valor_unitario"];
                        echo "</td>";
                        echo "<td>";
                        echo $prod["quantidade"];
                        echo "</td>";
                        echo "<td>";
                        echo $prod["id"];
                        echo "</td>";
                        echo "<td>";
                        echo $prod["nome_status"];
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='editarproduto.php?codigo_prod=".$prod['codigo_prod']."'><button>Editar</button></a>";
                        echo "<a href='excluirproduto.php?codigo_prod=".$prod['codigo_prod']."' onclick='confirmDeletion(event, this.href)'><button>Excluir</button></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    $resultado = null;
                    $bd = null;
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
