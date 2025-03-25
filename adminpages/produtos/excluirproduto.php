<?php
include_once '../../functions/bd.php';
$bd = conectar();

$codigo_prod = filter_input(INPUT_GET, 'codigo_prod', FILTER_SANITIZE_NUMBER_INT);

if ($codigo_prod) {
    $consulta_itemcompra = "SELECT COUNT(*) FROM itemcompra WHERE codigo_prod = :codigo_prod";
    $stmt = $bd->prepare($consulta_itemcompra);
    $stmt->execute([':codigo_prod' => $codigo_prod]);
    $count_itemcompra = $stmt->fetchColumn();

    if ($count_itemcompra > 0) {
        $erro = "Não foi possível excluir este item pois ele foi comprado por um usuário do sistema. Você pode editar o status do produto.";
        header("location:produtosini.php?erro=$erro");
        exit;
    } else {
        try {
            $bd->beginTransaction();
            $consulta_imagens = "DELETE FROM imagem WHERE codigo_prod = :codigo_prod";
            $stmt = $bd->prepare($consulta_imagens);
            $stmt->execute([':codigo_prod' => $codigo_prod]);
            $consulta_produto = "DELETE FROM produto WHERE codigo_prod = :codigo_prod";
            $stmt = $bd->prepare($consulta_produto);
            $stmt->execute([':codigo_prod' => $codigo_prod]);
            $bd->commit();
            header("location:produtosini.php");
        } catch (Exception $e) {
            $bd->rollBack();
            $erro = "Ocorreu um erro ao excluir o produto.";
            header("location:produtosini.php?erro=$erro");
        }
        exit;
    }
} else {
    $erro = "Produto inválido.";
    header("location:produtosini.php?erro=$erro");
    exit;
}
?>
