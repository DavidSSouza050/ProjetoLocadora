<?php
    //Ativa o recurso de variavel de sessão
    session_start();
    /*pagangando o banco*/
    require_once('../../db/conexao.php');
    $conexao = conexaoMysql();
    //variaveis
    $modo = $_GET['modo'];
    $id = $_GET['codigo'];
    $titulo_sobre = null;
    $texto_sobre = null;

    if($modo == 'Atualizar'){
        $btn = 'Atualizar';
        
        $_SESSION['id_sobre'] = $id;
        $sql = "SELECT * FROM tbl_sobre WHERE cod_sobre = ".$id;
        $select = mysqli_query($conexao, $sql);
        if($rsSobre = mysqli_fetch_array($select)){
            $titulo_sobre = $rsSobre['titulo_sobre'];
            $texto_sobre = $rsSobre['texto_sobre'];
            $nome_foto_sobre = $rsSobre['imagem_sobre'];

            $_SESSION['nome_img'] = $nome_foto_sobre;
        }


    }elseif($modo == 'Cadastrar'){
        $btn = 'Cadastrar';
    }
  
?>        
<div id="card_cadastrar_sobre" class="center">
    <form name="frm_cadatrar_sobre" method="POST" action="cms_sobre_empresa.php" enctype="multipart/form-data">
        <div id="segura_titulo_imagem">
            <div id="caixa_titulo">
                Titulo:<input type="text" value="<?php echo($titulo_sobre)?>" id="text_cadastro_titulo" name="txt_titulo_sobre">
            </div>
            <div id="caixa_imagem">
                <input type="file" name="fle_imagem" >
            </div>
        </div>
        <div id="segura_textArea">
            <textArea class="scrollTexto" placeholder="Texto Sobre" id="textA_sobre" name="textA_sobre"><?php echo($texto_sobre)?></textArea>
        </div>
        <div id="segura_botao_sobre">
            <input type="submit" value="<?php echo($btn)?>" name="<?php echo($btn.'_sobre') ?>" id="cadastrar_sobre" class="botao_cadastro_usuario"> 
        </div>
    </form>
    <?php
        if(isset($nome_foto_sobre)){      
    ?>
    <div id="foto_sobre">
        <img class="img-size" src="img/imagem_sobre/<?php echo($nome_foto_sobre)?>" alt="<?php echo($nome_foto_sobre);?>" title="<?php echo($nome_foto_sobre);?>">
    </div>
    <?php 
        }
    ?>
</div>
