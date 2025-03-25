<?php
$id = filter_input(INPUT_GET,"id", FILTER_SANITIZE_SPECIAL_CHARS);
include_once '../functions/bd.php';
$bd = conectar();
$query = "delete from categoria where id ='$id' ";
$bd -> beginTransaction();
$i = $bd -> exec($query);
if($i != 1){
    $bd -> rollBack();
}else{
    $bd -> commit();
}
$bd = null;
header("location:categoriasini.php");
