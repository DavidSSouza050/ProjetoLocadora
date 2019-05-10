<?php
    session_start();
    //verificando se a variavel de sessão existe
    if(isset($_SESSION['cod_usuario_logado'])){
        //verificando se é vazia
        if(empty($_SESSION['cod_usuario_logado'])){
            session_destroy();
            header('location: ../');
        }
    }else{
        //se não for nada redireciona para a pagina principal
        session_destroy();
       header('location: ../');
    }

?>