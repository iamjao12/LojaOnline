<?php
include_once '../../functions/bd.php';
$codigo = filter_input(INPUT_POST,"codigo_prod",FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST,"nome",FILTER_SANITIZE_SPECIAL_CHARS);
$desc = filter_input(INPUT_POST,"descricao",FILTER_SANITIZE_SPECIAL_CHARS);
$valoruni = filter_input(INPUT_POST,"valor_unitario",FILTER_VALIDATE_FLOAT);
$quant = filter_input(INPUT_POST,"quantidade",FILTER_SANITIZE_SPECIAL_CHARS);
$categoria = filter_input(INPUT_POST,"cat",FILTER_SANITIZE_SPECIAL_CHARS);
$status = filter_input(INPUT_POST,"status",FILTER_SANITIZE_SPECIAL_CHARS);
$bd = conectar();
$query = " insert into produto (codigo_prod, nome_pro, descricao, valor_unitario, quantidade, id, id_status ) values ('$codigo' , '$nome' , '$desc' , '$valoruni' , '$quant' , '$categoria' , '$status' ) ";
$bd -> beginTransaction();
    try{
    $i = $bd -> exec($query);
    if($i != 1){
        $bd -> rollBack();
    }else{
        $bd -> commit();
    }
    }catch(PDOException $e){
        $bd -> rollBack();
        $bd = null;
        $erro = erros($e->getMessage());
        header("location:novoproduto.php?codigo_prod=$codigo&nome_pro=$nome&descricao=$desc&valor_unitario=$valoruni&quantidade=$quant&cat=$categoria&status=$status&erro=$erro");
        die();
    }
$bd = null;
header("location:produtosini.php"); 