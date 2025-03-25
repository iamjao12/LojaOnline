<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ADMIN</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Página do administrador</h2>
        <a href="indexuser.php"><button>Página Inicial</button></a>
        <a href="adminpages/categoriasini.php"><button>Categorias</button></a>
        <a href="adminpages/produtos/produtosini.php"><button>Produtos</button></a>
    </div>
</body>
</html>
