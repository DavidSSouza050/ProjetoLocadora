<?php
    //Ativar varivael de sessão
    session_start();
    //pegando o banco 
    require_once('../../db/conexao.php');
    $conexao = conexaoMysql();
    //pegando variaveis via get
    $modo = $_GET['modo'];
    $codigo = $_GET['codigo'];
    //variaveis de caixas
    $cep = null;
    $logradouro = null;
    $bairro = null;
    $numero = null;
    $cidade = null;
    $estado = null;

    if($modo == 'Cadastrar'){
        $btn = 'Cadastrar';
    }elseif($modo == 'Atualizar'){
        $btn = 'Atualizar';

        $_SESSION['atulizar_endereco'] = $codigo;
        $sql = "SELECT endereco.*,
                cidade.cidade,
                estado.estado
                FROM tbl_endereco AS endereco INNER JOIN tbl_cidade AS cidade
                ON endereco.cod_cidade = cidade.cod_cidade	INNER JOIN tbl_estado as estado
                ON cidade.cod_estado = estado.cod_estado WHERE endereco.cod_endereco = ".$codigo;
        $selecet = mysqli_query($conexao, $sql);
        if($rsEndereco = mysqli_fetch_array($selecet)){
            $cep = $rsEndereco['cep'];
            $logradouro = $rsEndereco['logradouro'];
            $bairro = $rsEndereco['bairro'];
            $numero = $rsEndereco['numero'];
            $cidade = $rsEndereco['cidade'];
            $estado = $rsEndereco['estado'];
        }
    }




?>
<div id="card_cadastrar_loja" class="center">
    <form name="frm_loja" method="post" action="cms_lojas.php">    
        <div class="card_txt_modal_lojas">
            <!-- divs que vai ter as caixas de texto e vão se trocar de lugar para estilização -->
            <div class="segura_txt_1">
                Cep: <input type="text" value="<?php echo($cep);?>" class="txt_lojas" name="txt_cep" id="txt_cep">    
            </div>

            <div class="segura_txt_2">
                Numero: <input type="text" value="<?php echo($numero);?>"  class="txt_lojas"  name="txt_numero" id="txt_numero"> 
            </div>
            
        </div>
        <div class="card_txt_modal_lojas">
            <!-- divs que vai ter as caixas de texto e vão se trocar de lugar para estilização -->
            <div class="segura_txt_2">
                logradouro:<input  type="text"  value="<?php echo($logradouro);?>" class="txt_lojas"  name="txt_logradouro" id="txt_logradouro">     
            </div>

            <div class="segura_txt_1">
                Bairro: <input type="text"  value="<?php echo($bairro);?>" class="txt_lojas"   name="txt_bairro" id="txt_bairro" >        
            </div>
            
        </div>
        <div class="card_txt_modal_lojas">
            <!-- divs que vai ter as caixas de texto e vão se trocar de lugar para estilização -->
            <div class="segura_txt_1">
                Cidade: <input type="text"  value="<?php echo($cidade);?>" class="txt_lojas"  name="txt_cidade" id="txt_cidade" >
            </div>

            <div class="segura_txt_2">
                Estado: <input type="text" value="<?php echo($estado);?>" class="txt_lojas"  name="txt_estado" id="txt_estado" >
            </div>
        </div>
        <div id="segura_botao_loja">
            <input type="submit" value="<?php echo($btn);?>" name="<?php echo($btn.'_loja'); ?>" id="cadastrar_sobre" class="botao_cadastro_usuario"> 
        </div>
    </form>
</div>
<script src="./js/geral.js"></script>