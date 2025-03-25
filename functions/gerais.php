<?php
function ListaSelecao($dados, $vetorTitulos, $escolha = 0){
    foreach($dados as $linha){
        echo "<option value='" . $linha[$vetorTitulos[0]] . "' ";
        echo $linha[$vetorTitulos[0]] == $escolha ? ' selected ':"";
        echo ">" , $linha[$vetorTitulos[1]] , "</option>"; 
    }
}
