<!DOCTYPE html>
<?php
    include_once '../../functions/bd.php';
    include_once '../../functions/gerais.php';
    $bd = conectar();
    $querycat = 'select id , nome from categoria';
    $resultadocat = $bd -> query($querycat);
    $listaCat = $resultadocat -> fetchAll();

    $querystatus = 'select id_status, nome_status from status';
    $resultado2 = $bd -> query($querystatus);
    $listaSta = $resultado2 -> fetchAll();
    
    $codigo = filter_input(INPUT_GET,"codigo_prod", FILTER_SANITIZE_SPECIAL_CHARS);
    $query = "select * from produto where codigo_prod = '$codigo'";
    $resultado = $bd -> query($query);
    if($resultado->rowCount() == 0){
        $bd = null;
        header("location:produtosini.php");
        die();       
    }  
    $prod = $resultado->fetch();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edição de Categoria</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        div {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="text"]:focus {
            outline: none;
            border-color: #007bff;
        }
        input[type="submit"] {
            background-color: #71129E;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #590f7b;
        }
        a button {
            background-color: #71129E;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
    </style>
    </head>
    <body>
    <div class="container">
    <h1>Edição de Produto</h1>
    <a href="produtosini.php"><button>Voltar</button></a>
    <a href="../carregadorIMG/loadIMG.php?codigo_prod=<?=$codigo?>"><button>Adicionar imagem</button></a>
        <form action="gravarproduto.php" method="post">
            <div>
                <label>Código do Produto</label>
                <input type="text" name="codigo_prod" readonly value="<?=$prod['codigo_prod']?>">
            </div>
            <div>
                <label>Nome do Produto</label>
                <input type="text" name="nome" value="<?=$prod['nome_pro']?>">
            </div>
            <div>
                <label>Descrição do Produto</label>
                <input type="text" name="descricao" value="<?=$prod['descricao']?>">
            </div>
            <div>
                <label>Valor Unitário do Produto</label>
                <input type="text" name="valor_unitario" value="<?=$prod['valor_unitario']?>">
            </div>
            <div>
                <label>Quantidade do Produto</label>
                <input type="number" name="quantidade" value="<?=$prod['quantidade']?>">
            </div>
            <div>
                <label>Categoria do Produto</label>
                <select name="cat">
                <?php ListaSelecao($listaCat, ["id","nome"],$prod['id'])?>
                </select>
            </div>
            <div>
                <label>Status do Produto</label>
                <select name="status">
                <?php ListaSelecao($listaSta, ["id_status","nome_status"],$prod['id_status'])?>
                </select>
            </div>
            <input type="submit" value="Salvar">
        </form>
    </div>
    </body>
</html>