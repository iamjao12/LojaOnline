<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
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
        .back-button {
            position: fixed;
            top: 10px;
            left: 10px;
        }
        .back-button button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #71129E;
            color: #fff;
            font-size: 16px;
        }
        .product {
            display: flex;
            align-items: center;
            margin: 20px 0;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .product img {
            max-width: 100px;
            margin-right: 20px;
        }
        .product h2 {
            margin: 0 0 10px;
        }
        .product p {
            text-align: left;
            margin: 0 0 10px;
        }
        .total, .actions {
            margin: 20px 0;
        }
        .actions button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #71129E;
            color: #fff;
            font-size: 16px;
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="back-button">
        <a href="indexuser.php"><button>Voltar</button></a>
    </div>
    <div class="container">
        <h1>Produtos no Carrinho</h1>
        <?php
        include_once './functions/bd.php';
        $bd = conectar();
        session_start();

        function removeItem($productId) {
            if (isset($_SESSION['cart'][$productId])) {
                unset($_SESSION['cart'][$productId]);
            }
        }

        function clearCart() {
            unset($_SESSION['cart']);
        }

        if (isset($_POST['remove_product_id'])) {
            $productId = $_POST['remove_product_id'];
            removeItem($productId);
        }

        if (isset($_POST['clear_cart'])) {
            clearCart();
        }

        $total = 0;

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $codigo_prod => $item) {
                $query = "SELECT p.nome_pro, p.valor_unitario, i.nome_arquivo
                          FROM produto p 
                          JOIN imagem i ON i.codigo_prod = p.codigo_prod 
                          WHERE p.codigo_prod = $codigo_prod 
                          AND i.codigo_img = (SELECT MIN(codigo_img) FROM imagem WHERE codigo_prod = p.codigo_prod)";
                $resultado = $bd->query($query);
                $prod = $resultado->fetch();

                $diretorio = 'imagens/';
                $caminho_imagem = $diretorio . $prod['nome_arquivo'];

                echo "<div class='product'>";
                echo "<img src='$caminho_imagem' alt='" . $prod['nome_pro'] . "'>";
                echo "<div>";
                echo "<h2>" . $prod["nome_pro"] . "</h2>";
                echo "<p>Quantidade: " . $item['quantity'] . "</p>";
                echo "<p>Preço: R$ " . number_format($prod["valor_unitario"], 2, ',', '.') . "</p>";
                echo "</div>";
                echo "</div>";

                $total += $prod["valor_unitario"] * $item['quantity'];
            }
        } else {
            echo "<p>Nenhum item no carrinho.</p>";
        }
        ?>
        <div class="total">
            <h2>Total: R$ <?= number_format($total, 2, ',', '.') ?></h2>
        </div>
        <div class="actions">
            <?php 
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                echo '<form method="post" action="" style="display: inline;">';
                echo '<button type="submit" name="clear_cart">Limpar Carrinho</button>';
                echo '</form>';
            }
            echo '<form method="post" action="finalizar_compra.php" style="display: inline;">';
            echo '<button type="submit" name="finalizar_compra">Finalizar Compra</button>';
            echo '</form>';
            ?>
        </div>
    </div>
</body>
</html>
