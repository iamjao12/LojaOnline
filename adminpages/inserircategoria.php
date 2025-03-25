<?php
$id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST,"nome",FILTER_SANITIZE_SPECIAL_CHARS);
include_once '../functions/bd.php';
$bd = conectar();
$query = " insert into categoria (id, nome ) values ('$id' , '$nome' ) ";
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
        header("location:novacategoria.php?id=$id&nome=$nome&erro=$erro");
        die();
    }
$bd = null;
header("location:categoriasini.php");
