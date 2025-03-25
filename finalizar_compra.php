<?php 
session_start();
include_once './functions/bd.php';
$bd = conectar();
$newNumeroCompra = null;
$cpfcnpj = isset($_SESSION['ADMIN']) ? $_SESSION['ADMIN'] : (isset($_SESSION['USER']) ? $_SESSION['USER'] : null);
if ($cpfcnpj == null) {
    $erro = "O usuário precisa se cadastrar no sistema para fazer uma compra";
    header("location:login.php?erro=$erro");
    exit; 
}
$data = date('Y-m-d');
$queryLastId = "SELECT MAX(numero_compra) AS last_id FROM compra";
$resultLastId = $bd->query($queryLastId);
$lastId = $resultLastId->fetch(PDO::FETCH_ASSOC)['last_id'];
$newNumeroCompra = $lastId + 1;

$totalCompra = 0;
foreach ($_SESSION['cart'] as $productId => $product) {
    $preco_prod = $product['price'];
    $quant = $product['quantity'];
    $totalCompra += $preco_prod * $quant;
}

    // Inserção na tabela compra
    $insertQuery = "INSERT INTO compra (numero_compra, data, cpf_cnpj_cli, valor_compra) VALUES (:numero_compra, :data, :cpf_cnpj_cli, :valor_compra)";
    $insertStmt = $bd->prepare($insertQuery);
    $insertStmt->bindParam(':numero_compra', $newNumeroCompra, PDO::PARAM_INT);
    $insertStmt->bindParam(':data', $data, PDO::PARAM_STR);
    $insertStmt->bindParam(':cpf_cnpj_cli', $cpfcnpj, PDO::PARAM_STR);
    $insertStmt->bindParam(':valor_compra', $totalCompra, PDO::PARAM_STR);
    $insertStmt->execute();

    if (!$insertStmt->rowCount() > 0) {
        $erro = "Compra não realizada - Erro INS - Compra";
        header("location:indexuser?erro=$erro");
        exit;
    }

foreach ($_SESSION['cart'] as $productId => $product) {
    $nome_prod = $product['name'];
    $preco_prod = $product['price'];
    $quant = $product['quantity'];
    $total = $preco_prod * $quant;

    // Retirada do estoque
    $query = "UPDATE produto SET quantidade = quantidade - :quant WHERE codigo_prod = :productId";
    $stmt = $bd->prepare($query);
    $stmt->bindParam(':quant', $quant, PDO::PARAM_INT);
    $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
    $stmt->execute();
    $ver1 = $stmt->rowCount();
    if (!$ver1 > 0) {
        echo "Erro ao atualizar a quantidade para o produto: $nome_prod<br>";
        $erro = "Compra não realizada - Erro UPD";
        header("location:indexuser?erro=$erro");
        exit;
    }
    // Inserção dos itens na tabela itemcompra
    $insertItemQuery = "INSERT INTO itemcompra (numero_compra, codigo_prod, valor, quantidade) VALUES (:numero_compra, :codigo_prod, :valor, :quantidade)";
    $insertItemStmt = $bd->prepare($insertItemQuery);
    $insertItemStmt->bindParam(':numero_compra', $newNumeroCompra, PDO::PARAM_INT);
    $insertItemStmt->bindParam(':codigo_prod', $productId, PDO::PARAM_INT);
    $insertItemStmt->bindParam(':valor', $preco_prod, PDO::PARAM_STR);
    $insertItemStmt->bindParam(':quantidade', $quant, PDO::PARAM_INT);
    $insertItemStmt->execute();

    if (!$insertItemStmt->rowCount() > 0) {
        $erro = "Compra não realizada - Erro INS - Item-Compra";
        header("location:indexuser?erro=$erro");
        exit;
    }
}
    $bd = null;
    function clearCart() {
        unset($_SESSION['cart']);
    }
    clearCart();
    header("location:confirmacao.php");
    exit;