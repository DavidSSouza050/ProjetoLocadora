<?php
    //Ativa o recurso de variavel de sessão
    require_once('./usuario_verificado.php');
    //pegando as permissões
    require_once('./util/consultar_permissoes.php');
    /*pagangando o banco*/
    require_once('../db/conexao.php');
    $conexao = conexaoMysql();
 
    //chamando a função para validação
    $permissoes = consultarPermissoes();

?>

<div id="caixa_menu_nome_usuario_cms">
    <!-- caixa que vai quardar só o menu -->
    <div id="caixa_conteudo_menu_cms">
        <?php

            //verificando se o usuario pode usar usa parte do conteudo 
            if($permissoes['conteudo'] == 1){
        ?>
        <!-- cards do menu -->
        <div class='cardMenu'>  
            <a href="cms_conteudo.php">
                <!-- imagem da pagina -->
                <div class='caixa_img_menu'>
                    <figure>
                        <div class='img_menu_cms center'>
                            <img class='img-size' src='./img/icon_conteudo.png' alt='Contaudo' title='Contaudo'>
                        </div>
                    </figure>
                </div>
                <!-- titulo da pagina -->
                <div class='caixa_nome'>
                    Adm. Conteúdo
                </div>
            </a>
        </div>
        <?php
            }
            //verificando se o usuario pode usar usa parte do conteudo 
            if($permissoes['fale_conosco'] == 1){
        ?>
        <!-- cards do menu -->
        <div class='cardMenu'>  
            
            <a href="cms_fale_conosco.php">
                <!-- imagem da pagina -->
                <div class='caixa_img_menu'>
                    <figure>
                        <div class='img_menu_cms center'>
                            <img class='img-size' src='./img/icon_fale_conosco.png' alt='Fale Conosco' title='Fale Conosco'>
                        </div>
                    </figure>
                </div>
                <!-- titulo da pagina -->
                <div class='caixa_nome'>
                    Adm. Fale conosco
                </div>
            </a>

        </div>
        <?php
            }
            //verificando se o usuario pode usar usa parte do conteudo 
            if($permissoes['produtos'] == 1){
        ?>
        <!-- cards do menu -->
        <div class='cardMenu'>  
            <!-- imagem da pagina -->
            <div class='caixa_img_menu'>
                <figure>
                    <div class='img_menu_cms center'>
                        <img class='img-size' src='./img/icon_produto.png' alt='Produtos' title='Produtos'>
                    </div>
                </figure>
            </div>
            <!-- titulo da pagina -->
            <div class='caixa_nome'>
                Adm. Produtos
            </div>
        </div>
        <?php
            }
            //verificando se o usuario pode usar usa parte do conteudo 
            if($permissoes['usuario'] == 1){
        ?>
        <!-- cards do menu -->
        <div class='cardMenu'>  
            
            <a href="cms_usuario.php">
                <!-- imagem da pagina -->
                <div class='caixa_img_menu'>
                    <figure>
                        <div class='img_menu_cms center'>
                            <img class='img-size' src='./img/icon_usuario.png' alt='Usuários' title='Usuário'>
                        </div>
                    </figure>
                </div>
                <!-- titulo da pagina -->
                <div class='caixa_nome'>
                    Adm. Usuários
                </div>
            </a>

        </div>
        <?php
            }
        ?>
    </div>

    <!-- caixa que vai ficar com  o nome do usuario -->
    <div id="caixa_nome_usuario">
        <div id="nome_usuario">    
            Bem Vindo, <?php echo($permissoes['nome_logado']);?>
        </div>
        <div id="logout">
            <a href="../login/login.php?logout=true">
                <span id="logout_efeito">Logout</span>
            </a>
        </div>
    </div>
</div>