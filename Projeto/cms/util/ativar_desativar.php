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
        
        if($pagina == 'sobre_empresa' && $status == 0){
            $tabela = 'tbl_sobre'; //pasando a tabela que sera editada
            $codigo = $_GET['codigo'];//passando o codigo que sera editado
            $campo_tabela = 'cod_sobre';//passando a coluna que vai servir de referencia para a edição
            $status = 1; //desativando o sobre 

            $sql="UPDATE ".$tabela." SET ativo = 0 WHERE ".$campo_tabela." > 0 ";
            
            if(mysqli_query($conexao, $sql)){
                //echo('AEE POXA FOI ESSA PARADA');
            }else{
                //echo($sql.'\n');
            }            

        }

        $sql = "UPDATE ".$tabela." SET ativo = ".$status." WHERE ".$campo_tabela." = ".$codigo;

        if(mysqli_query($conexao, $sql)){
            //echo("nao sei");
        }else{
           // echo($sql);
        }
    }











?>