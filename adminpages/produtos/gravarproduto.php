<?php
$codigo = filter_input(INPUT_POST,"codigo_prod", FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST,"nome", FILTER_SANITIZE_SPECIAL_CHARS);
$desc=filter_input(INPUT_POST,"descricao",FILTER_SANITIZE_SPECIAL_CHARS);
$valoruni=filter_input(INPUT_POST,"valor_unitario",FILTER_SANITIZE_SPECIAL_CHARS);
$quant=filter_input(INPUT_POST,"quantidade",FILTER_SANITIZE_SPECIAL_CHARS);
$categoria=filter_input(INPUT_POST,"cat",FILTER_SANITIZE_SPECIAL_CHARS);
$status = filter_input(INPUT_POST,"status",FILTER_SANITIZE_SPECIAL_CHARS);

include_once '../../functions/bd.php';
$bd = conectar();
$query = " update produto set nome_pro='$nome' , descricao='$desc' , valor_unitario='$valoruni' , quantidade='$quant' , id='$categoria' , id_status='$status' where codigo_prod='$codigo' ";
$bd -> beginTransaction();
$i = $bd -> exec($query);
if($i != 1){
    $bd -> rollBack();
}else{
    $bd -> commit();
}
$bd = null;
header("location:produtosini.php");