<?php
    //pegando a conexao
    require_once('../../db/conexao.php');
    $conexao = conexaoMysql();

    if(isset($_GET['numeroCep'])){
        // pegando o cep que foi passado pelo ajax
        $numeroCep = $_GET['numeroCep'];
        //pegando a API viacep
        $url = 'https://viacep.com.br/ws/'.$numeroCep.'/json/';
        // transformando a api para json
        $endereco_json = file_get_contents($url);
        // tratando para Array
        $endereco_json_para_array= json_decode($endereco_json, true);
        // atribuindo a variaveis os atributos
        $logradouro = $endereco_json_para_array['logradouro'];
        $bairro = $endereco_json_para_array['bairro'];
        $uf = $endereco_json_para_array['uf'];
        $cidade = $endereco_json_para_array['localidade'];
        
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