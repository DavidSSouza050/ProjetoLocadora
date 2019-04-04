<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>CMS - SISTEMA DE GERENCIAMENTO DO SITE</title>
        <link rel="stylesheet" type="text/css" media="screen" href="./css/styleCms.css">
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleFonte.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
        <link rel="shortcut icon" href="../img/iconeDeAbaACME.png" type="image/x-png">
    </head>
    <body>
        
        <!-- div que está segurando tudo -->
        <div id="conteudo_cms" class="center">
            <!-- header que está com o logo e o titulo -->
            <?php require_once('./cms_header.php');?>

            <!-- caixa com o menu e o nome do usuario -->
           <?php require_once('./cms_menu_paginas_usuario.php');?>
            
            




            <!-- conteudo do menu do cms -->
            <div id="menu_de_adm">
                <!-- conteudo editavel -->
                <div class="conteudo_editavel">
                  
                    <!-- imagem do conteudo editavel -->
                    <figure>
                        <div class="img_conteudo_editavel">
                            <img class="img-size" src="../img/instagram.png">
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
                          <img class="img-size" src="../img/instagram.png">
                      </div>
                  </figure>
                  
                  <!-- texto do conteudo editavel -->
                  <div class="mensagem_conteudo_editavel">
                      GERENCIAR SOBRE DA EMPRESA
                  </div>
                  
              </div>

              <div class="conteudo_editavel">
                  
                <!-- imagem do conteudo editavel -->
                <figure>
                    <div class="img_conteudo_editavel">
                        <img class="img-size" src="../img/instagram.png">
                    </div>
                </figure>
                
                <!-- texto do conteudo editavel -->
                <div class="mensagem_conteudo_editavel">
                    GERENCIAR SOBRE DA EMPRESA
                </div>
                
            </div>

            <div class="conteudo_editavel">
                  
                <!-- imagem do conteudo editavel -->
                <figure>
                    <div class="img_conteudo_editavel">
                        <img class="img-size" src="../img/instagram.png">
                    </div>
                </figure>
                
                <!-- texto do conteudo editavel -->
                <div class="mensagem_conteudo_editavel">
                    GERENCIAR LOJAS
                </div>
                
            </div>

            <div class="conteudo_editavel">
                  
                <!-- imagem do conteudo editavel -->
                <figure>
                    <div class="img_conteudo_editavel">
                        <img class="img-size" src="../img/instagram.png">
                    </div>
                </figure>
                
                <!-- texto do conteudo editavel -->
                <div class="mensagem_conteudo_editavel">
                    GERENCIAR FILME DO MÊS
                </div>
                
            </div>
            

                
            </div>








            <!-- footer do cms -->
           <?php require_once('./cms_footer.php');?>
        </div>


    </body>
</html>