<?php
    //Ativa o recurso de variavel de sessão
    require_once('./usuario_verificado.php');
   

function consultarPermissoes(){
     /*pagangando o banco*/
     require_once('../db/conexao.php');
     $conexao = conexaoMysql();
    

    //select para verificar quais são as permissães deste usuario
    $sql = "SELECT  usuario.nome_usuario,
                    usuario.cod_usuario,
                    nivel.cod_nivel,
                    nivel.nome_nivel,
                    nivel.adm_conteudo,
                    nivel.adm_fale_conosco,
                    nivel.adm_produto,
                    nivel.adm_usuario
                    FROM tbl_nivel_usuario as nivel INNER JOIN tbl_usuario as usuario
                    ON nivel.cod_nivel = usuario.cod_nivel WHERE usuario.cod_usuario =".$_SESSION['cod_usuario_logado'];
                
    $select = mysqli_query($conexao, $sql);

    if($rspermisao = mysqli_fetch_array($select)){
        $nome_usuario_logado = $rspermisao['nome_usuario'];
        $cod_usuario_locado = $rspermisao['cod_usuario'];
        $cod_nivel = $rspermisao['cod_nivel'];
        $adm_conteudo = $rspermisao['adm_conteudo'];
        $adm_fale_conosco = $rspermisao['adm_fale_conosco'];
        $adm_produto = $rspermisao['adm_produto'];
        $adm_usuario = $rspermisao['adm_usuario'];
    }

    return array(
        "usuario" => $adm_usuario,
        "conteudo" => $adm_conteudo,
        "fale_conosco" => $adm_fale_conosco,
        "produtos" => $adm_produto,
        "nome_logado" => $nome_usuario_logado,
        "cod_logado" => $cod_usuario_locado,
        "cod_nivel_logado" => $cod_nivel
    );


}

?>