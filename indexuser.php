<?php
include_once './functions/bd.php';
$bd = conectar();
session_start();
 
$erro=filter_input(INPUT_GET,"erro",FILTER_SANITIZE_SPECIAL_CHARS);
 
if (isset($_SESSION['ADMIN'])) {
    $cpf_cnpj_cli = $_SESSION['ADMIN'];
} elseif (isset($_SESSION['USER'])) {
    $cpf_cnpj_cli = $_SESSION['USER'];
} else {
    $cpf_cnpj_cli = '';
}
 
$consulta_cli = "SELECT nome_cli FROM cliente WHERE cpf_cnpj_cli = '$cpf_cnpj_cli'";
$resultado_cli = $bd->query($consulta_cli);
$nome_cli = $resultado_cli->fetchColumn();
 
$consulta = "SELECT p.*, i.nome_arquivo
              FROM produto p
              JOIN imagem i ON i.codigo_prod = p.codigo_prod
              WHERE i.codigo_img = (SELECT MIN(codigo_img) FROM imagem WHERE codigo_prod = p.codigo_prod)
              AND quantidade > 0 
              AND p.id_status = 2
              ORDER BY p.codigo_prod ";
$resultado = $bd->query($consulta);
 
$admin_link = isset($_SESSION['ADMIN']) ? "<a href='admin.php'><button>ADMIN</button></a>" : "";
$sair = (isset($_SESSION['USER']) || isset($_SESSION['ADMIN'])) ? "<form method='post'><button type='submit' name='logout'>Sair</button></form>" : "";

if (isset($_POST['logout'])) {
    session_destroy();
    header("location:login.php");
    exit;
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
</head>
 
<style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}
 
.header {
  width: 100%;
  height: 80px;
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  display: flex;
  align-items: center;  
  justify-content: space-between;
}
 
.logo {
  color: #71129E;
  font-size: 2rem;
  font-weight: bold;
  text-decoration: none;
  margin-left: 30px;
}
 
.user-area {
  display: flex;
  align-items: center;
  margin-right: 100px;
}
 
.user-name {
  margin-right: 10px;
}
 
.user-name a {
  color: #000;
}
 
button {
  background-color: #71129E;
  color: #fff;
  padding: 5px 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
 
.product-list {
  display: flex;
  flex-wrap: wrap;
  margin: 20px 0;
}
 
.product-item {
  width: 30%;
  margin: 10px;
  text-align: center;
}
 
.product-image {
  max-width: 100%;
  max-height: 200px;
}
 
.product-name a {
  color: #000;
  text-decoration: none;
}
 
.product-description {
  margin-bottom: 10px;
}
 
.product-price {
  font-weight: bold;
}
.cart-icon {
  margin-left: 20px;
  margin-right: 20px;
  cursor: pointer;
  width: 50px;
  height: 50px;
}
.buttons{
  align-items: center;
}
</style>

<body>
    <header class="header">
        <div>
            <h2 class="logo">J&I</h2>
        </div>
    <?php if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) { ?>
      <div class="buttons">
        <div class="login-options">
            <a href="login.php"><button>Login</button></a>
            <a href="registro.php"><button>Registrar</button></a>
        </div>
    <?php } ?>
        <div class="user-area">
            <span class="user-name">Usuário: <?php echo "<a href='pedidos.php'>$nome_cli</a>"; ?></span>
            <?php echo $admin_link; ?>
            <a href="checkout.php"><img src="./imagens/cart-icon.png" alt="Cart" class="cart-icon"></a>
            <?php echo $sair; ?>
        </div>
      </div>
    </header>
 
    <div class="error-message">
        <?php echo $erro; ?> </div>
 
    <div class="product-list">
        <?php while ($prod = $resultado->fetch()) { 
            $diretorio = "imagens/";
            $caminho_imagem = $diretorio . $prod['nome_arquivo'];
            echo "<div class='product-item'>";
              echo "<a href='pagprod.php?codigo_prod=".$prod['codigo_prod']."'>";
              echo "<img src='$caminho_imagem' alt='" . $prod['nome_arquivo'] . "' style='max-width: 300px;'>";
              echo "</a>";
              echo "<h2 class='product-name'><a href='pagprod.php?codigo_prod=".$prod['codigo_prod']."'>".$prod['nome_pro']."</a></h2>";
              echo "<p class='product-description'>".$prod['descricao']."</p>";
              echo "<h2 class='product-price'>R$ ".$prod['valor_unitario']."</h2>";
            echo "</div>";
        }
        ?>
        </div>
 
</body>
</html>

