<?php
if(isset($_FILES["nome"])){
    $arquivo = $_FILES["nome"];
    $nome = $arquivo["name"];
}

include_once '../../functions/bd.php';
$bd=conectar();

$codigo_img=filter_input(INPUT_POST,"id",FILTER_SANITIZE_SPECIAL_CHARS);
$cod_prod=filter_input(INPUT_GET,"codigo_prod",FILTER_SANITIZE_SPECIAL_CHARS);

$query = " insert into imagem ( codigo_img , codigo_prod , nome_arquivo ) values ( '$codigo_img' , '$cod_prod' , '$nome' )";

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
        header("location:loadIMG.php?id=$codigo_img&codigo_prod=$cod_prod&nome=$nome&erro=$erro");
        die();
    }
$bd = null;
header("location:../produtos/produtosini.php"); 