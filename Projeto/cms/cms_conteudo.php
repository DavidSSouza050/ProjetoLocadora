
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>CMS - SISTEMA DE GERENCIAMENTO DO SITE</title>
        <link rel="stylesheet" type="text/css" media="screen" href="./css/styleCms.css">
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleFonte.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
        <link rel="shortcut icon" href="../img/iconeDeAbaACME.png" type="image/x-png">
        <script src="../js/jquery-1.11.3.min.js"></script>
    </head>
    <body>
        <!-- cnotender da modal que vai abrir para mostrar o cliente por completo -->
        <div id="conteiner">
            <!-- div vom o objetivo de fechar a modal -->
            <div id="segurar_fechar_modal" class="center">
                <figure>
                    <div id="fechar_modal">
                        <a href="#" class="img-size" id="fachar_modal_fale_conosco">
                            <img class="img-size" src="./img/icone_sair.png" alt="sair da modal" title="sair da modal">
                        </a>
                    </div>
                </figure>
            </div>
            <!-- modal que vai suportar tudo o conteudo -->
            <div id="modal" class="center">
                
            </div>
        </div>

        <!-- div que está segurando tudo -->
        <div id="conteudo_cms" class="center">
            <!-- header que está com o logo e o titulo -->
            <?php require_once('./cms_header.php');?>

            <!-- caixa com o menu e o nome do usuario -->
           <?php require_once('./cms_menu_paginas_usuario.php');?>
        

            <!-- conteudo do menu do cms -->
            <div id="menu_de_adm">
               
                
                <!-- conteudo do menu do cms -->
                <div id="menu_de_adm">
                    <!-- conteudo editavel -->
                    <div class="conteudo_editavel">
                        
                        <!-- imagem do conteudo editavel -->
                        <figure>
                            <div class="img_conteudo_editavel">
                                <img class="img-size" src="./img/gerenciar_ator.png">
                            </div>
                        </figure>
                        
                        <!-- texto do conteudo editavel -->
                        <div class="mensagem_conteudo_editavel">
                            GERENCIAR ATOR EM DESTAQUE
                        </div>
                        
                    </div>

                    <div class="conteudo_editavel">
                        
                        <!-- imagem do conteudo editavel -->
                        <figure>
                            <div class="img_conteudo_editavel">
                                <img class="img-size" src="./img/promocoes.png">
                            </div>
                        </figure>
                        
                        <!-- texto do conteudo editavel -->
                        <div class="mensagem_conteudo_editavel">
                            GERENCIAR PROMOÇÕES
                        </div>
                        
                    </div>

                    <div class="conteudo_editavel">
                        <a href="cms_sobre_empresa.php"> 
                            <!-- imagem do conteudo editavel -->
                            <figure>
                                <div class="img_conteudo_editavel">
                                    <img class="img-size" src="./img/editar_sobre_empresa.png">
                                </div>
                            </figure>

                            <!-- texto do conteudo editavel -->
                            <div class="mensagem_conteudo_editavel">
                                GERENCIAR SOBRE DA EMPRESA
                            </div>
                        </a>
                    </div>

                    <div class="conteudo_editavel">
                        <a href="cms_lojas.php">
                            <!-- imagem do conteudo editavel -->
                            <figure>
                                <div class="img_conteudo_editavel">
                                    <img class="img-size" src="./img/lojas.png">
                                </div>
                            </figure>
                            
                            <!-- texto do conteudo editavel -->
                            <div class="mensagem_conteudo_editavel">
                                GERENCIAR LOJAS
                            </div>
                        </a>
                    </div>

                    <div class="conteudo_editavel">
                        
                        <!-- imagem do conteudo editavel -->
                        <figure>
                            <div class="img_conteudo_editavel">
                                <img class="img-size" src="./img/gerenciar_filme.png">
                            </div>
                        </figure>
                        
                        <!-- texto do conteudo editavel -->
                        <div class="mensagem_conteudo_editavel">
                            GERENCIAR FILME DO MÊS
                        </div>
                        
                    </div>
                </div>

            </div>


            <!-- footer do cms -->
           <?php require_once('./cms_footer.php');?>
        </div>


    </body>
</html>
