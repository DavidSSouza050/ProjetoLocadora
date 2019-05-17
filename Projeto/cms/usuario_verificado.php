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
    
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
?>