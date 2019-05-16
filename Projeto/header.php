<link rel="stylesheet" type="text/css" media="screen" href="css/styleHeader.css" />
<header id="header_computador">
    <div class="conteudo_header center">
       <!-- logo do site na header -->
        <figure class="logo">
            <div class="logo" >
                <a href="index.php" class="alinhafigura">
                    <img class="img-size" src="./img/logoAcme.png" alt="logo Acme" title="Voltar para a pagina inicial">
                </a>                    
            </div>
        </figure>
        <!-- menu com os links -->
        <nav class="menu">
            <ul>
                <li class="liHeader">
                    <a href="ator.php">
                        Ator
                    </a>
                </li>
                <li class="liHeader">
                    <a href="lojas.php">
                       Lojas
                    </a>
                </li>
                <li class="liHeader">
                    <a href="promocoes.php">
                        Promoções
                    </a>
                </li>
                <li class="liHeader">
                    <a href="filmeDoMes.php">
                        Filme do Mês
                    </a>
                </li>
                <li class="liHeader">
                    <a href="contato.php">
                       Fale Conosco
                    </a>
                </li>
                <li class="liHeader">
                    <a href="sobre.php">
                        Sobre
                    </a>
                </li>
            </ul>
        </nav>
        <!-- caixas para login -->
        <form name="frm_cadastro" method="POST" action="./login/login.php">
            <div class="login">
                <div class="login_usuario">
                    <h2>Usuario:</h2>
                    <input class="caixaTexto" type="text" name="txt_login_usuario">
                </div>
                <div class="login_senha">
                    <h2>Senha:</h2>
                    <input class="caixaTexto" type="password" name="txt_login_senha">
                    <input type="submit" class="botao_usuario" name="btn_confirmar" value="OK">
                </div>
            </div>
        </form>
    </div>
</header>

<!-- esponsivo -->
<header id="header_modile">

    <nav class="segura_menu_mobile back-size">
        <!-- <ul id="ul_menu_mobile">
           
        </ul> -->
    </nav>
    
    <figure>
        <div class="logo_site_mobile">
            <img class="img-size zindexzero" src="./img/logoAcme.png" alt="logo Acme" title="Voltar para a pagina inicial">
        </div>
    </figure>
</header>

<!-- segurando o conteudo -->
<div class="segura_conteudo ">

</div>

