<?php
    require_once('./db/conexao.php');
    $conexao =  conexaoMysql();
    //pegando a função de desconto
    require_once('./cms/util/formatar_preco.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <title>Locadora Acme Tunes</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/styleFonte.css" />
        <link rel="shortcut icon" href="img/iconeDeAbaACME.png" type="image/x-png">
        <script src="js/jssor.slider-27.5.0.min.js"></script>
        <script src="js/jquery-1.11.3.min.js"></script>
        <script>
            //abrindo a modal
            $(document).ready(function(){
                // ativando modal
                
                $('.visualizar').click(function(){
                    $('#conteiner_produto').fadeIn(300);
                });

                $('#fechar_modal_produto').click(function(){
                    $('#conteiner_produto').fadeOut(300);
                });    

                $('#txtBusca').on('keyup', function(){
                    if($(this).val() != ""){
                        if($(this).val().length > 3){
                            pesquisar($(this).val(), 'normal');
                        }
                    }else{
                        filtrar(0,0, 'normal');  
                    }
                });

                $('#txtBusca_mobile').on('keyup', function(){
                    if($(this).val() != ""){
                        if($(this).val().length > 3){
                            pesquisar($(this).val(), 'normal');
                        }
                    }else{
                        filtrar(0,0, 'normal');  
                    }
                });

     
                filtrar(0,0,'normal');
                
            });

            function filtrar(categoria, subcategoria, modo){
                    $.ajax({
                        type: "GET",
                        url: "./util/filtrar_filmes.php",
                        data:{categoria:categoria, subcategoria:subcategoria, modo:modo},
                        success: function(dados){
                            $('#segura_podutos').html(dados);
                            // console.log(dados);
                        }
                    });
                }

            function pesquisar(texto, modo){
                $.ajax({
                    type:"GET",
                    url: "./util/pesquisa.php",
                    data:{texto:texto, modo:modo},
                    success: function(dados){
                        $('#segura_podutos').html(dados);
                       // console.log(dados);
                    }
                });
            }

           

            function executar(){
                var texto = document.getElementById('txtBusca').value;//pegnado o valor da caixa
                var lista = document.getElementById('historico');// pegando todas as options da datalist
                var adicionar = true;// colocando o valor verdadeiro
                
                var opt = document.createElement('option');// variavel vai criar as options

                for(var i=0; i < lista.options.length; i++){//verificando se não existe a palavra da caixa
                    if(texto == lista.options[i].value){// se exister ele não adicionar
                        adicionar = false;
                    }
                }

                if(adicionar == true ){ // se não existir ele adicionar com o valor digitado na caixa
                    opt.value = texto;
                    lista.appendChild(opt);
                }

            }
        
        </script>

    </head>
    <body>


        <!-- contender da modal que vai abrir para mostrar o cliente por completo -->
        <div id="conteiner_produto">
            <!-- modal que vai suportar tudo o conteudo -->
            <div id="modal_produto" class="center">
                
            </div>
        </div>


        <!-- div que vai segurar as categorias -->
        <div class="segura_menu_categoria">
            <div class="segura_categoria scrollTexto">

                <div class="categoria_item">
                    <div class="segura_categoria_item" onclick="filtrar(0, 0, 'normal')" >
                        Todos
                    </div>                      
                </div>

                <?php
                    $sql = "SELECT cod_categoria, categoria
                            FROM tbl_categoria WHERE status = 1";
                    $select = mysqli_query($conexao, $sql);

                    while($rsCategoria = mysqli_fetch_array($select)){
                        $cod_categoria = $rsCategoria['cod_categoria'];
                ?>
                <div class="categoria_item">
                    <div class="segura_categoria_item" onclick="filtrar(<?php echo($cod_categoria)?>, 0, 'normal')" >
                        <?=$rsCategoria['categoria']?>
                    </div>
                    <div class="aparece_subcategoria_mobile">
                        <img src="./img/icon_seta_submenu.png" class="img-size" alt="Mostra Sub Menu" title="Submenu">
                    </div>

                    <div class="segura_subcategoria esconder_subMenu_mobile scrollTexto center">
                        <?php
                            $sqlsubcategoria = "SELECT genero.cod_genero, genero.genero
                            FROM tbl_filme_genero_categoria as subCat INNER JOIN tbl_genero as genero
                            ON subCat.cod_genero = genero.cod_genero INNER JOIN tbl_categoria as categoria
                            ON categoria.cod_categoria = subCat.cod_categoria WHERE categoria.cod_categoria = ".$cod_categoria." GROUP BY genero.cod_genero";
                            
                            $selectSubCategoria = mysqli_query($conexao, $sqlsubcategoria);

                            while($rsSubcategoria = mysqli_fetch_array($selectSubCategoria)){
                        ?>
                        <div class="subcategoria_item displayNome center" onclick="filtrar(<?php echo($cod_categoria)?>, <?=$rsSubcategoria['cod_genero']?>, 'normal')" >
                           <?= $rsSubcategoria['genero']?>
                        </div>
                        <?php
                            }
                        ?>
                    </div>                        

                </div>
            <?php
                }
            ?>
            </div>
            <div class="fechar_menu_mobile">

            </div>
        </div>


        <!-- header em outra pagina -->
        <?php require_once('./header.php')?>

        <div class="slider center">
            <!-- slider -->
            <?php require_once("with-jquery.php"); ?>
            <!-- Redes socicais -->
            <div class="caixa_rede_social">
                <figure>
                    <div class="rede_social">
                        <img  class="img-size " src="./img/facebook.png" alt="Logo do facebook" title="logo do facebook">
                    </div>
                </figure>
                <figure>
                    <div class="rede_social">   
                        <img class="border-img" src="img/pinterest.png" alt="logo do pinterest" title="logo do pinterest">
                    </div>
                </figure>
                <figure>
                    <div class="rede_social">
                        <img class="border-img img-size" src="img/twitter.png" alt="logo do instagram" title="logo do twitter">
                    </div>
                </figure>
            </div>
        </div>

        <!-- mobile -->
        <figure>
            <div id="imagem_mobile">
                <img src="./img/imagem_mobile.jpg" class="img-size" alt="imagem_mobile">
            </div>    
        </figure>
        <!-- fim fa imagem mobile-->
        
        <div class="conteudo center">
            <!-- aqui começa a sessação dos filmes  -->
            <div class="item_conteudo">
                <div class="caixa_item">
                    <!-- menu de filtro  -->
                    <nav class="menu_item">
                        <ul class="ul_menu_item">
                            <li class="li_menu_item">
                                <div class="categoria_segura_item" onclick="filtrar(0, 0, 'normal')" >
                                    Todos
                                </div>
                            </li>
                            <?php 
                                $sql="SELECT cod_categoria, categoria 
                                      FROM tbl_categoria WHERE status = 1";
                                $select1 = mysqli_query($conexao, $sql);
                                while($rsCategoria = mysqli_fetch_array($select1)){
                                    $cod_categoria = $rsCategoria['cod_categoria'];
                            ?>

                            <li class="li_menu_item">
                                <div class="categoria_segura_item" onclick="filtrar(<?php echo($rsCategoria['cod_categoria'])?>, 0, 'normal')" >
                                    <?=$rsCategoria['categoria']?>
                                </div>
                                <div class="aparece_subCategoria">
                                    <img src="./img/icon_seta_submenu.png" class="img-size" alt="Mostra Sub Menu" title="Submenu">
                                </div>
                            
                                <ul class="ul_subMenu esconder_subMenu scrollTexto">
                                    <?php
                                    $sqlsubcategoria1 = "SELECT genero.cod_genero, genero.genero
                                                        FROM tbl_filme_genero_categoria as subCat INNER JOIN tbl_genero as genero
                                                        ON subCat.cod_genero = genero.cod_genero INNER JOIN tbl_categoria as categoria
                                                        ON categoria.cod_categoria = subCat.cod_categoria WHERE categoria.cod_categoria = ".$cod_categoria." GROUP BY genero.cod_genero";
                                    $selectSubCetgoria1 = mysqli_query($conexao, $sqlsubcategoria1);
                                    while($rsSubcategoria1 = mysqli_fetch_array($selectSubCetgoria1)){                                                        
                                    ?>
                                    <li class="li_subMenu center">
                                        <div class="segura_subcategoria" onclick="filtrar(<?=$cod_categoria?>, <?=$rsSubcategoria1['cod_genero']?>, 'normal')">
                                            <?=$rsSubcategoria1['genero']?>
                                        </div>
                                    </li>
                                    <?php
                                    }
                                    ?>
                                </ul>    
                                
                            </li>
                            <?php
                                }
                            ?>
                            
                            
                        </ul>
                    </nav>  
                </div>
                
                

                <!-- imagem que vai chamar o menu de categoria -->
                <div id="open_categoria" class="back-size">
                    <img src="./img/iconfinder_filter_299094.png" class="border-radius-img img-size" alt="Filtrar" >
                </div>

               

               
                <!-- caixa que segura as card -->
                <div class="caixa_produto">
                    <div id="segura_barra_pesquisa">
                        <!-- barra de pesquisa -->
                        <div id="divBusca" class="center">
                            <input type="text" id="txtBusca" list="historico" placeholder="Buscar..."/>
                            <input type="image" src="./img/icon_lupa.png" id="btnBusca" onclick="executar()" alt="Submit" title="Pesquisar"/>
                            <datalist id="historico">
                                <option value="Era"></option>
                                <option value="Ação"></option>
                                <option value="Comédia"></option>
                                <option value="Romantica"></option>
                                <option value="Romance"></option>
                            </datalist>
                        </div>
                    </div>
                    <div id="segura_podutos">
                        
                    </div>

                   
                </div>  
            </div>
        </div>
        
        <!-- footer em outra pagina -->
        <?php require_once('./footer.php')?>

    </body>
</html>