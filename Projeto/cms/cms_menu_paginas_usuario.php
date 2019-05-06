<?php
    //Ativa o recurso de variavel de sessão
    require_once('./usuario_verificado.php');
    /*pagangando o banco*/
    require_once('../db/conexao.php');
    $conexao = conexaoMysql();

    $adm_conteudo = 0;
    $adm_fale_conosco = 0;
    $adm_produto = 0;
    $adm_usuario = 0;
    $nome_usuario = "";

    if(isset($_SESSION['cod_usuario_logado'])){

        //select para verificar quais são as permissães deste usuario
        $sql = "SELECT usuario.nome_usuario,
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
            $adm_conteudo = $rspermisao['adm_conteudo'];
            $adm_fale_conosco = $rspermisao['adm_fale_conosco'];
            $adm_produto = $rspermisao['adm_produto'];
            $adm_usuario = $rspermisao['adm_usuario'];
        }



    }
?>
<div id="caixa_menu_nome_usuario_cms">
    <!-- caixa que vai quardar só o menu -->
    <div id="caixa_conteudo_menu_cms">
        <?php
            if($adm_conteudo == 1){
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

            if($adm_fale_conosco == 1){
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

            if($adm_produto == 1){
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

            if($adm_usuario == 1){
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
            Bem Vindo, <?php echo($nome_usuario_logado);?>
        </div>
        <div id="logout">
            <a href="../login/login.php?logout=true">
                <span id="logout_efeito">Logout</span>
            </a>
        </div>
    </div>
</div>