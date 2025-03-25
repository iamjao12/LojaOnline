<!DOCTYPE html>
<?php
include_once './functions/bd.php';
$bd = conectar();
session_start();
if (isset($_SESSION['ADMIN'])) {
    $cpf_cnpj_cli = $_SESSION['ADMIN']; 
} elseif (isset($_SESSION['USER'])) {
    $cpf_cnpj_cli = $_SESSION['USER']; 
} else {
    $cpf_cnpj_cli = ''; 
}
$consulta = "SELECT * FROM compra WHERE cpf_cnpj_cli='$cpf_cnpj_cli' ORDER BY numero_compra";
$resultado = $bd -> query($consulta);

$consulta_cli = "SELECT nome_cli FROM cliente WHERE cpf_cnpj_cli = '$cpf_cnpj_cli'";
$resultado_cli = $bd->query($consulta_cli);
$nome_cli = $resultado_cli->fetchColumn(); 
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos do Cliente</title>
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
    <div class="container">
        <h2>Pedidos do cliente: <?=$nome_cli?></h2>
        <div class="back-button">
            <a href="indexuser.php"><button>Voltar</button></a>
        </div>
        <?php if ($resultado->rowCount() > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Número da Compra</th>
                    <th>Data da Compra</th>
                    <th>CPF do Cliente</th>
                    <th>Valor da Compra</th>
                    <th>Detalhes</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($ped = $resultado->fetch()){
                    echo "<tr>";
                    echo "<td>".$ped["numero_compra"]."</td>";
                    echo "<td>".$ped["data"]."</td>";
                    echo "<td>".$ped["cpf_cnpj_cli"]."</td>";
                    echo "<td> R$ ".$ped["valor_compra"]."</td>";
                    echo "<td><a href='itenscompra.php?numero_compra=".$ped['numero_compra']."'><button>Itens da Compra</button></a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>Você ainda não tem pedidos.</p>
        <?php endif; ?>
    </div>
</body>
</html>
