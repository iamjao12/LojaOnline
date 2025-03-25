<!DOCTYPE html>
<?php
include_once '../../functions/bd.php';
include_once '../../functions/gerais.php';
$bd = conectar();
$querycat = 'select id , nome from categoria';
$resultado1 = $bd -> query($querycat);
$listaCat = $resultado1 -> fetchAll();

$querystatus = 'select id_status, nome_status from status';
$resultado2 = $bd -> query($querystatus);
$listaSta = $resultado2 -> fetchAll();

    $codigo=filter_input(INPUT_GET,"codigo_prod",FILTER_SANITIZE_SPECIAL_CHARS);
    $nome=filter_input(INPUT_GET,"nome_pro",FILTER_SANITIZE_SPECIAL_CHARS);
    $desc=filter_input(INPUT_GET,"descricao",FILTER_SANITIZE_SPECIAL_CHARS);
    $valoruni=filter_input(INPUT_GET,"valor_unitario",FILTER_SANITIZE_SPECIAL_CHARS);
    $quant=filter_input(INPUT_GET,"quantidade",FILTER_SANITIZE_SPECIAL_CHARS);
    $categoria=filter_input(INPUT_GET,"cat",FILTER_SANITIZE_SPECIAL_CHARS);
    $status=filter_input(INPUT_GET,"status",FILTER_SANITIZE_SPECIAL_CHARS);
    $erro=filter_input(INPUT_GET,"erro",FILTER_SANITIZE_SPECIAL_CHARS);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir produto</title>
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
            margin-bottom: 20px;
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
    <div>
        <?=$erro?>
    </div>
    <div class="container">
    <a href="produtosini.php"><button>Voltar</button></a>
    <form action="inserirproduto.php" method="post">
        <h1>Incluir Produto</h1>
            <div>
                <label>Código do Produto</label>
                <input type="text" name="codigo_prod" value="<?=$codigo?>">
            </div>
            <div>
                <label>Nome do Produto</label>
                <input type="text" name="nome" value="<?=$nome?>">
            </div>
            <div>
                <label>Descrição do Produto</label>
                <input type="text" name="descricao" value="<?=$desc?>">
            </div>
            <div>
                <label>Valor Unitário do Produto</label>
                <input type="text" name="valor_unitario" value="<?=$valoruni?>">
            </div>
            <div>
                <label>Quantidade do Produto</label>
                <input type="number" name="quantidade" value="<?=$quant?>">
            </div>
            <div>
                <label>Categoria do Produto</label>
                <select name="cat">
                <?php ListaSelecao($listaCat, ["id","nome"],$categoria)?>
                </select>
            </div>
            <div>
                <label>Status do Produto</label>
                <select name="status">
                <?php ListaSelecao($listaSta, ["id_status","nome_status"],$status)?>
                </select>
            </div>
            <input type="submit" value="Salvar">
        </form>
    </div>
</body>
</html>