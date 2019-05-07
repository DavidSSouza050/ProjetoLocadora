<?php

function colocar_virgula($preco_com_ponto){
    $preco_sendo_modificado = explode(".",$preco_com_ponto);//pegando e proço e transformando em array
    $preco_modificado = $preco_sendo_modificado[0].",".substr(round($preco_sendo_modificado[1]), 0, 2);// colocando o ponto no preco
    return $preco_modificado;
}

function calcular_preco($porcentagem_desconto, $preco){
    // calculando desconto
    $preco_descontado =  $preco * ($porcentagem_desconto/100);
    $desconto =  $preco - $preco_descontado;
    //Tirando o ponto e adicionando a virgula
    $desconto_com_ponto = explode(".",$desconto);
    if(!isset($desconto_com_ponto[1])){
        $desconto_sem_ponto = $desconto_com_ponto[0].",00"; 
    }else{
        $desconto_sem_ponto = $desconto_com_ponto[0].",".substr($desconto_com_ponto[1], 0, 2);
    }

    return $desconto_sem_ponto;
}


?>