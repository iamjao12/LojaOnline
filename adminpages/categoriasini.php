<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Categorias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        a {
            text-decoration: none;
        }
        button {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #71129E;
            color: #fff;
            font-size: 14px;
            margin-right: 5px;
            transition: background-color 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Categorias</h1>
        <a href="../admin.php"><button>Voltar</button></a>
        <a href="novacategoria.php"><button>Adicionar Categoria</button></a>
        <table>
            <thead>
                <tr>
                    <th>Identificação</th>
                    <th>Categoria</th>
                    <th>Edição</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once '../functions/bd.php';
                    $bd = conectar();
                    $consulta = "select * from categoria order by id";
                    $resultado = $bd->query($consulta);
                    while($cat = $resultado->fetch()){
                        echo "<tr>";
                        echo "<td>".$cat["id"]."</td>";
                        echo "<td>".$cat["nome"]."</td>";
                        echo "<td>";
                        echo "<a href='editarcategoria.php?id=".$cat['id']."'><button>Editar</button></a>";
                        echo "<a href='excluircategoria.php?id=".$cat['id']."'><button>Excluir</button></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    $resultado = null;
                    $bd = null;
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
