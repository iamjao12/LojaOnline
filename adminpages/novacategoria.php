<!DOCTYPE html>
<?php
include_once '../functions/bd.php';
    $codigo=filter_input(INPUT_GET,"id",FILTER_SANITIZE_SPECIAL_CHARS);
    $nome=filter_input(INPUT_GET,"nome",FILTER_SANITIZE_SPECIAL_CHARS);
    $erro=filter_input(INPUT_GET,"erro",FILTER_SANITIZE_SPECIAL_CHARS);
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Incluir Categoria</title>
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
    <div class="container">
        <a href="categoriasini.php"><button>Voltar</button></a>
        <form action="inserircategoria.php" method="post">
            <h1>Incluir Categoria</h1>
            <div>
                <label>Identificação</label>
                <input type="text" name="id" value="<?=$codigo?>">
            </div>
            <div>
                <label>Nome da Categoria</label>
                <input type="text" name="nome" value="<?=$nome?>">
            </div>
            <input type="submit" value="Salvar">
        </form>
    </div>
</body>
</html>
