<?php
include_once './functions/bd.php';
$bd = conectar();
session_start();
$cpfcnpj=filter_input(INPUT_POST,"cpfcnpj",FILTER_SANITIZE_SPECIAL_CHARS);
$senha=filter_input(INPUT_POST,"senha",FILTER_SANITIZE_SPECIAL_CHARS);
$senhacrypt=sha1($senha);
$query = "select cpf_cnpj_cli , senha_cli from cliente where cpf_cnpj_cli = '$cpfcnpj' and senha_cli = '$senhacrypt' ";
$resultado = $bd -> query($query);
if($resultado->rowCount()==1){
    if ($cpfcnpj === '46868613814' && $senhacrypt === sha1('1234')) {
        $_SESSION['ADMIN'] = $cpfcnpj;
    }else {
        $_SESSION['USER'] = $cpfcnpj; 
    }
    header("location:indexuser.php"); 
}else{
    $erro = "CPF/CNPJ e/ou senha inválidos";
    header("location:login.php?erro=$erro");  
}