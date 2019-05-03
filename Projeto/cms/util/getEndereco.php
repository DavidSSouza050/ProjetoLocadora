<?php
    //pegando a conexao
    require_once('../../db/conexao.php');
    $conexao = conexaoMysql();

    if(isset($_GET['endereco'])){

        // tratando para Array
        $arrayEndereco= $_GET['endereco'];
        // atribuindo a variaveis os atributos
        $numeroCep = $arrayEndereco['cep'];
        $logradouro = $arrayEndereco['logradouro'];
        $bairro = $arrayEndereco['bairro'];
        $uf = $arrayEndereco['uf'];
        $cidade = $arrayEndereco['localidade'];
        
        //fazendo select para verificar o estado e a cidade
        $sql = "SELECT e.cod_estado, e.estado,
            c.cod_cidade, c.cidade
            FROM tbl_estado AS e
            INNER JOIN tbl_cidade AS c
            ON c.cod_estado = e.cod_estado
            WHERE e.uf = '".$uf."' AND c.cidade = '".$cidade."'";
        $select = mysqli_query($conexao, $sql);

        //colocando os atributos em uma array
        if($rsEndereco = mysqli_fetch_array($select)){
            $array_endereco = array(
                'cod_estado'=> $rsEndereco['cod_estado'],
                'estado'=> $rsEndereco['estado'],
                'cod_cidade'=> $rsEndereco['cod_cidade'],
                'cidade'=> $rsEndereco['cidade'],
                'logradouro'=> $logradouro,
                'bairro'=> $bairro,
                'cep'=> $numeroCep
            );
        }
        //transformando a array parar json
        $array_endereco = json_encode($array_endereco);
        //mandado a array para ajax
        print_r($array_endereco);

    }


?>