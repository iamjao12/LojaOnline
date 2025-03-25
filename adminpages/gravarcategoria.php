<?php
$id = filter_input(INPUT_POST,"id", FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST,"nome", FILTER_SANITIZE_SPECIAL_CHARS);

include_once '../functions/bd.php';
$bd = conectar();
$query = "update categoria set nome='$nome' where id='$id' ";
$bd -> beginTransaction();
$i = $bd -> exec($query);
if($i != 1){
    $bd -> rollBack();
}else{
    $bd -> commit();
}
$bd = null;
header("location:categoriasini.php");

