<?php
    function conexaoMysql(){
        //VARIAVEL QUE VAI RECEBER A CONEXÃO COM O BANCO DE DADOS
        $conexao = null;
        
        //Variavaeis para estabelacer a conexão com o banco
        $server = "localhost";
        $user = "root";
        $password= "bcd127";
        $database = "db_locadora";

        $conexao = mysqli_connect($server, $user, $password, $database);
        
        return $conexao;
    }



?>