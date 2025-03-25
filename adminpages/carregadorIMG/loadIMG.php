<!DOCTYPE html>
<?php
    $id_prod=filter_input(INPUT_GET,"codigo_prod",FILTER_SANITIZE_SPECIAL_CHARS);
    $erro=filter_input(INPUT_GET,"erro",FILTER_SANITIZE_SPECIAL_CHARS);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Adicionar Imagem</title>
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
        <div>
            <?=$erro?>
        </div>
        <div class="container">
        <a href="../produtos/editarproduto.php?codigo_prod=<?=$id_prod?>"><button>Voltar</button></a>
        <form action="carregar.php?codigo_prod=<?=$id_prod?>" method="POST" enctype="multipart/form-data">
            <div>
                <label>Identificação da imagem</label>
                <input type="text" name="id"/>
            </div>
            <div>
                <label>Arquivo</label>
                <input type="file" accept="image/png,image/jpeg" name="nome"/>
            </div>
            <input type="submit" value="Enviar"/>
        </form>
        </div>
    </body>
</html>