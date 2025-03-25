<?php
include_once './functions/bd.php';
$cpfcnpj=filter_input(INPUT_POST,"cpfcnpj",FILTER_SANITIZE_SPECIAL_CHARS);
$nome=filter_input(INPUT_POST,"nome",FILTER_SANITIZE_SPECIAL_CHARS);
$numero=filter_input(INPUT_POST,"numero",FILTER_SANITIZE_SPECIAL_CHARS);
$rua=filter_input(INPUT_POST,"rua",FILTER_SANITIZE_SPECIAL_CHARS);
$bairro=filter_input(INPUT_POST,"bairro",FILTER_SANITIZE_SPECIAL_CHARS);
$cidade=filter_input(INPUT_POST,"cidade",FILTER_SANITIZE_SPECIAL_CHARS);
$cep=filter_input(INPUT_POST,"cep",FILTER_SANITIZE_SPECIAL_CHARS);
$estado=filter_input(INPUT_POST,"estado",FILTER_SANITIZE_SPECIAL_CHARS);
$senha=filter_input(INPUT_POST,"senha",FILTER_SANITIZE_SPECIAL_CHARS);
$senhacrypt = sha1($senha);
session_start();
$bd = conectar();

$ver = "SELECT COUNT(*) FROM cliente WHERE cpf_cnpj_cli = :cpfcnpj";
        $stmt = $bd->prepare($ver);
        $stmt->bindParam(':cpfcnpj', $cpfcnpj);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        
        if ($count > 0) {
            $parametros = http_build_query([
                'erro' => 'CPF ou CNPJ já cadastrado.',
                'cpfcnpj' => $cpfcnpj,
                'nome' => $nome,
                'numero' => $numero,
                'bairro' => $bairro,
                'cidade' => $cidade,
                'cep' => $cep,
                'estado' => $estado,
                'rua' => $rua,
            ]);
            header("location:registro.php?$parametros&erro=$erro");
            exit();
        }

$query = " insert into cliente (cpf_cnpj_cli, nome_cli, numero_cli, bairro_cli, cidade_cli, cep_cli, estado_cli, endereco_cli, senha_cli)"
        . " values ('$cpfcnpj', '$nome', '$numero', '$bairro', '$cidade', '$cep', '$estado', '$rua', '$senhacrypt' ) ; ";
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
        $parametros = http_build_query([
            'erro' => $erro,
            'cpfcnpj' => $cpfcnpj,
            'nome' => $nome,
            'numero' => $numero,
            'bairro' => $bairro,
            'cidade' => $cidade,
            'cep' => $cep,
            'estado' => $estado,
            'rua' => $rua,
        ]);
    
        header("location:registro.php?$parametros&erro=$erro");
        die();
    }
$bd = null;
$_SESSION['USER'] = $cpfcnpj;
header("location:indexuser.php");
exit;