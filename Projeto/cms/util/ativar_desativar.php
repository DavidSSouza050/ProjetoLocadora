<?php
    //pegando a conexão de outra pasta
    require_once('../../db/conexao.php');
    $conexao = conexaoMysql();
    

    if(isset($_GET['pagina'])){
        /*Pegando a pagina que está chamando essa função*/
        $pagina = $_GET['pagina'];
        /*pegando o status da tabela
        $status == 1 -> está ativo
        $status == 0 -> não está ativo
        */
        $status = $_GET['status'];
        

        //sobre a empresa
        if($pagina == 'sobre_empresa' && $status == 0){
            $tabela = 'tbl_sobre'; //pasando a tabela que sera editada
            $codigo = $_GET['codigo'];//passando o codigo que sera editado
            $campo_tabela = 'cod_sobre';//passando a coluna que vai servir de referencia para a edição
            $status = 1; //ativa o sobre 
            
            $sql="UPDATE ".$tabela." SET status = 0 WHERE ".$campo_tabela." > 0 ";//Desativar todos
            
            if(mysqli_query($conexao, $sql)){
                //echo('AEE POXA FOI ESSA PARADA');
            }else{
                //echo($sql.'\n');
            }            

        }
        
        //lojas
        if($pagina == 'loja' && $status == 1){
            $tabela = 'tbl_loja';
            $codigo = $_GET['codigo'];
            $campo_tabela = 'cod_loja';
            $status = 0;

        }elseif($pagina == 'loja' && $status == 0){
            $tabela = 'tbl_loja';
            $codigo = $_GET['codigo'];
            $campo_tabela = 'cod_loja';
            $status = 1;

        }

        // ator
        if($pagina == 'ator' && $status == 0){
            $tabela = 'tbl_ator'; //pasando a tabela que sera editada
            $codigo = $_GET['codigo'];//passando o codigo que sera editado
            $campo_tabela = 'cod_ator';//passando a coluna que vai servir de referencia para a edição
            $status = 1; //desativando o sobre 

            $sql="UPDATE ".$tabela." SET status = 0 WHERE ".$campo_tabela." > 0 ";
            
            if(mysqli_query($conexao, $sql)){
                //echo('AEE POXA FOI ESSA PARADA');
            }else{
                //echo($sql.'\n');
            }  
        }
        // filme do mes
        if($pagina == 'filme_mes' && $status == 0){
            $tabela = 'tbl_filme'; //pasando a tabela que sera editada
            $codigo = $_GET['codigo'];//passando o codigo que sera editado
            $campo_tabela = 'cod_filme';//passando a coluna que vai servir de referencia para a edição
            $status = 1; //desativando o sobre 

            $sql="UPDATE ".$tabela." SET status = 0 WHERE ".$campo_tabela." > 0 ";
            
            if(mysqli_query($conexao, $sql)){
                //echo('AEE POXA FOI ESSA PARADA');
            }else{
                //echo($sql.'\n');
            }  

        }

        //promoções ativas
        if($pagina == 'promocao' && $status == 1){
            $tabela = 'tbl_promocao';
            $codigo = $_GET['codigo'];
            $campo_tabela = 'cod_promocao';
            $status = 0;

        }elseif($pagina == 'promocao' && $status == 0){
            $tabela = 'tbl_promocao';
            $codigo = $_GET['codigo'];
            $campo_tabela = 'cod_promocao';
            $status = 1;
            
        }


        $sql = "UPDATE ".$tabela." SET status = ".$status." WHERE ".$campo_tabela." = ".$codigo;

        if(mysqli_query($conexao, $sql)){
            echo("Dnao sei");
        }else{
           // echo($sql);
        }
    }











?>