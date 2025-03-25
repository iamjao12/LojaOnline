<!DOCTYPE html>
<?php
include_once './functions/bd.php';
session_start();
$bd = conectar();
$cod = filter_input(INPUT_GET, "codigo_prod", FILTER_SANITIZE_SPECIAL_CHARS);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => 1
        ];
    }

    header("Location: pagprod.php?codigo_prod=$cod");
    exit;
}

// Verificar se o formulário foi enviado para atualizar o carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if ($quantity > 0) {
        $_SESSION['cart'][$product_id]['quantity'] = $quantity;
    } else {
        unset($_SESSION['cart'][$product_id]);
    }

    header("Location: pagprod.php?codigo_prod=$cod");
    exit;
}

$query = "SELECT * FROM produto p JOIN imagem i ON i.codigo_prod = p.codigo_prod WHERE p.codigo_prod=$cod";
$resultado = $bd->query($query);
$prod = $resultado->fetch();

$imagens_query = "SELECT * FROM imagem WHERE codigo_prod=$cod";
$imagens_resultado = $bd->query($imagens_query);
$imagens = $imagens_resultado->fetchAll();
?>
<html lang="en">
<head>
    <style>
        body{
            font-family: Arial, sans-serif;
        }
        .carousel {
            position: relative;
            max-width: 640px;
            margin: auto;
        }
        .carousel img {
            display: none;
            width: 100%;
            height: auto;
        }
        .carousel img:first-child {
            display: block;
        }
        .prev, .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
        }
        .prev {
            left: 0;
        }
        .next {
            right: 0;
        }
        .cart-icon {
            position: fixed;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
        .cart-icon img {
            width: 50px;
            height: 50px;
        }
        .cart-box {
            display: none;
            position: fixed;
            top: 70px;
            right: 10px;
            width: 300px;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .cart-item h4, .cart-item p {
            margin: 5px;
        }
        .cart-box button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .cart-box button:hover {
            background-color: #45a049;
        }
        .back-button button {
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$prod["nome_pro"]?></title>
</head>
<body>
    <div class="back-button">
        <a href="indexuser.php"><button>Voltar</button></a>
    </div>
    <div class="carousel">
        <?php foreach ($imagens as $imagem): ?>
            <img src="imagens/<?=$imagem['nome_arquivo']?>" alt="<?=$prod['nome_pro']?>">
        <?php endforeach; ?>
        <div class="prev" onclick="plusSlides(-1)">&#10094;</div>
        <div class="next" onclick="plusSlides(1)">&#10095;</div>
    </div>
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function showSlides(n) {
            var i;
            var slides = document.querySelectorAll(".carousel img");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex-1].style.display = "block";
        }
    </script>
    <div class="tituloprod">
        <h1><?=$prod["nome_pro"]?></h1>
    </div>
    <div class="descprod">
        <p>Descrição: <?=$prod["descricao"]?></p>
    </div>
    <div class="quantidade-em-estoque">
        <p>Quantidade em estoque: <?=intval($prod["quantidade"])?></p>
    </div>
    <div class="valorprod">
        <h2>R$ <?=$prod["valor_unitario"]?></h2>
    </div>
    <form method="post">
        <input type="hidden" name="product_id" value="<?=$prod['codigo_prod']?>">
        <input type="hidden" name="product_name" value="<?=$prod['nome_pro']?>">
        <input type="hidden" name="product_price" value="<?=$prod['valor_unitario']?>">
        <button type="submit" name="add_to_cart" style="padding: 10px 20px; background-color: #71129E; color: white; border: none; cursor: pointer; margin-top: 10px;">Adicionar ao carrinho</button>
    </form>
    <div class="cart-icon" onclick="toggleCartBox()">
        <img src="./imagens/cart-icon.png" alt="Carrinho">
    </div>
    <div class="cart-box" id="cartBox">
    <h3>Carrinho</h3>
    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <?php foreach ($_SESSION['cart'] as $id => $item): ?>
            <div class="cart-item" id="cart-item-<?=$id?>">
                <h4><?=$item['name']?></h4>
                <p>R$ <?=$item['price']?></p>
                <div class="quantity-controls">
                    <form method="post" style="display: inline;">
                        <input type="hidden" name="product_id" value="<?=$id?>">
                        <input type="hidden" name="quantity" value="<?=$item['quantity'] - 1?>">
                        <button type="submit" name="update_cart" style="background-color: #71129E; margin-bottom: 20px;">-</button>
                    </form>
                    <span id="quantity-<?=$id?>"><?=$item['quantity']?></span>
                    <form method="post" style="display: inline;">
                        <input type="hidden" name="product_id" value="<?=$id?>">
                        <input type="hidden" name="quantity" value="<?=$item['quantity'] + 1?>">
                        <button type="submit" name="update_cart" style="background-color: #71129E; margin-bottom: 20px;">+</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
        <form method="post" action="checkout.php">
            <button type="submit" name="finalizar_compra" style="margin-top: 10 px;background-color: #71129E">Finalizar Compra</button>
        </form>
    <?php else: ?>
        <p>Seu carrinho está vazio.</p>
    <?php endif; ?>
</div>
    <script>
        function toggleCartBox() {
            var cartBox = document.getElementById('cartBox');
            if (cartBox.style.display === 'none' || cartBox.style.display === '') {
                cartBox.style.display = 'block';
            } else {
                cartBox.style.display = 'none';
            }
        }
    </script>
</body>
</html>
