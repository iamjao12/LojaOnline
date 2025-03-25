<!DOCTYPE html>
<?php
include_once './functions/bd.php';
$cpfcnpj=filter_input(INPUT_POST,"cpfcnpj",FILTER_SANITIZE_SPECIAL_CHARS);
$senha=filter_input(INPUT_POST,"senha",FILTER_SANITIZE_SPECIAL_CHARS);
$erro=filter_input(INPUT_GET,"erro",FILTER_SANITIZE_SPECIAL_CHARS);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <style>
body{
  background-image: url(./imagens/Design\ sem\ nome.jpg);
  background-size: cover;
  background-repeat: no-repeat;
}
 
.voltar{
  border: none;
  background: none;
  font-size: 20px;
}
 
.bemvindo{
  text-align: center;
  color: black;
  font-size: 30px;
  font-family: Arial, Sans-serif;
  top: 0px;
  margin-right: 63px;
}
 
.container{
  background-color: white;
  width: 360px;
  height: 390px;
  top:80px;
  margin-top: 100px;
  margin-left: auto;
  margin-right: auto;
  border-radius: 30px;
}
 
.cpfnome{
left: 45px;
top: 90px;
color: black;
font-size: 20px;
font-family: Fira Code;
font-weight: 633;
margin-left: 20px;
 
}
 
.cpf{
left: 45px;
top: 115px;  
background-color: #cfcfcf;
height: 20px;
width: 310px;
border: none;
border-radius: 5px;
margin-left: 20px;
}
 
.senhanome{
left: 45px;
top: 160px;  
color: black;
font-size: 20px;
font-family: Fira Code;
font-weight: 633;
margin-left: 20px;
 
}
 
.senha {
left: 45px;
top: 185px;
background-color: #cfcfcf;
height: 20px;
width: 310px;
border: none;
border-radius: 5px;
margin-left: 20px;
}
 
.login {
background-image: url(./imagens/Design\ sem\ nome.jpg);
color: white;
font-size: 18px;
font-family: Fira Code;
height: 25px;
width: 310px;
border: none;
border-radius: 5px;
margin-top: 10px;
margin-left: 25px
}
 
.cadastrese{
left: 55px;
top: 360px;
text-align: center;
color: black;
font-size: 15px;
font-family: Fira Code;
font-weight: bold;
margin-top: 7rem;
}
 
.cadastresenome{
    color:purple;
    text-decoration-line: none;
}
 
.header{
  display: flex;
  align-items: center;
  justify-content: space-evenly;
}
 
.erro{
  margin-left: 80px;
}
 
</style>
    <body>
    <div class='container'>
      <div class="header">
        <a href="indexuser.php"><button  class='voltar'><</button></a>
        <h2 class=bemvindo> Bem-vindo(a)!</h2>
      </div>
      <form action="loginuser.php" method="post">
          <label class='cpfnome'>CPF/CNPJ:</label>
          <input class='cpf' type="text" name="cpfcnpj" value="<?=$cpfcnpj?>">
      <div>
      <br>
        <label class='senhanome'>Senha:</label>
      <br>
        <input class='senha' type="password" name="senha" value="<?=$senha?>">
      </div>
        <input class='login' type="submit" value="Login">
      <div class='erro'>
        <?=$erro?>
      </div>
          <div class= cadastrese>
          Ainda não tem uma conta? <a href="registro.php" class=cadastresenome>Cadastre-se!
          </div>
        </form>
      </div>
    </body>
</html>