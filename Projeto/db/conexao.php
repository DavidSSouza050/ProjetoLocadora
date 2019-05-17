<?php

    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);

    function conexaoMysql(){
        //VARIAVEL QUE VAI RECEBER A CONEXÃO COM O BANCO DE DADOS
        $conexao = null;
        
        //Variavaeis para estabelacer a conexão com o banco
        //$server = "localhost";
        $server = "192.168.0.2";
        //$user = "root";
        $user = "pc1020191";
        //$password= "bcd127";
        $password= "senai127";
        //$database = "db_locadora";
        $database = "dbpc1020191";

        $conexao = mysqli_connect($server, $user, $password, $database);
        
        return $conexao;
    }



?>