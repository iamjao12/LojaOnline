<!DOCTYPE html>
<?php
include_once './functions/bd.php';
$cpfcnpj = filter_input(INPUT_POST, "cpfcnpj", FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_SPECIAL_CHARS);
$rua = filter_input(INPUT_POST, "rua", FILTER_SANITIZE_SPECIAL_CHARS);
$bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS);
$cidade = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_SPECIAL_CHARS);
$cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_SPECIAL_CHARS);
$estado = filter_input(INPUT_POST, "estado", FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS);
$erro = filter_input(INPUT_POST, "erro", FILTER_SANITIZE_SPECIAL_CHARS);
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registrar</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            position: relative;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .container h1{
            margin-top: 75px;
        }
        .container div {
            margin-bottom: 15px;
            margin-top: 15px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .container label {
            margin-bottom: 5px;
        }
        .container input[type="text"],
        .container input[type="number"],
        .container input[type="password"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        .container input[type="submit"],
        .container button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #71129E;
            color: #fff;
            font-size: 16px;
        }
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .back-button a {
            text-decoration: none;
            color: #fff;
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
        .error-message {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="back-button">
        <a href="indexuser.php"><button>Voltar</button></a>
    </div>
    <div class="container">
        <div class="error-message">
            <?= $erro ?>
        </div>
        <h1>Registrar</h1>
        <form action="registraruser.php" method="post">
            <div>
                <label>CPF ou CNPJ</label>
                <input type="text" name="cpfcnpj" value="<?= $cpfcnpj ?>">
            </div>
            <div>
                <label>Nome</label>
                <input type="text" name="nome" value="<?=$nome?>">
            </div>
            <div>
                <label>Número de telefone</label>
                <input type="number" name="numero" value="<?=$numero?>">
            </div>
            <div>
                <label>Rua</label>
                <input type="text" name="rua" value="<?=$rua?>">
            </div>
            <div>
                <label>Bairro</label>
                <input type="text" name="bairro" value="<?=$bairro?>">
            </div>
            <div>
                <label>Cidade</label>
                <input type="text" name="cidade" value="<?=$cidade?>">
            </div>
            <div>
                <label>CEP</label>
                <input type="text" name="cep" value="<?=$cep?>">
            </div>
            <div>
                <label>Estado</label>
                <input type="text" name="estado" value="<?=$estado?>">
            </div>
            <div>
                <label>Senha</label>
                <input type="password" name="senha" value="<?=$senha?>">
            </div>
            <input type="submit" value="Registrar">
        </form>
    </div>
</body>
</html>
