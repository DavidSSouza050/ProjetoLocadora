<?php
    //Ativa o recurso de variavel de sessão
    require_once('./usuario_verificado.php');
    //pegando as permissões
    require_once('./util/consultar_permissoes.php');
    //upload de foto
    require_once('./util/upload_imagem.php');
    //formatar proco
    require_once('./util/formatar_preco.php');
    //chamando a função para validação
    $permissoes = consultarPermissoes();
    //banco
    require_once('../db/conexao.php');
    $conexao = conexaoMysql();

    if($permissoes['produtos'] == 0){
        header("Location: index.php");
    }
    //criando varivais
    $btn = 'Cadastrar';
    $btnLimpar = 'Limpar';
    $titulo_filme = null;
    $duracao = null;
    $cod_classificacao = 0;
    $cod_distribuidora = 0;
    $preco_filme = null;
    $sinopse = null;
    $img_filme = null;

    //Limpar caixas
    if(isset($_POST['limpar_produto'])){
        header("Location: cms_produtos.php");
    }
    //cadastrar e atualiozar o produto
    if(isset($_POST['Cadastrar_produto'])){
        $titulo_filme = trim($_POST['titulo_filme']);
        $duracao = trim($_POST['duracao_filme']);
        $cod_classificacao = trim($_POST['sle_classificacao']);
        $cod_distribuidora = trim($_POST['sle_distribuidora']);
        $preco_filme = trim($_POST['preco_filme']);
        $sinopse = trim($_POST['txt_sinopse']);
        
        $img_filme = move_image($_FILES['fle_imagem_filme'], './img/imagem_filme/');

        //verificando se as caixas estão vazias
        if($titulo_filme == "" || $duracao == "" || $cod_classificacao == "null"  || $cod_distribuidora == "null"  || $preco_filme == "" || $sinopse == ""){
            echo("<script>alert('Preencha Todas as caixas.')</script>");
            echo("<script>window.location='cms_produtos.php';</script>");
        }else{
            if($img_filme != null){
                $sql = "INSERT INTO tbl_filme (titulo_filme, descricao, preco_filme, imagem_filme, duracao, cod_classificacao, cod_distribuidora) 
                        VALUES ('".addslashes($titulo_filme)."', '".addslashes($sinopse)."', REPLACE('".$preco_filme."', ',', '.' ),
                                '".$img_filme."', '".addslashes($duracao)."', ".$cod_distribuidora.", ".$cod_distribuidora.")";
                //echo($sql);
                if(mysqli_query($conexao, $sql)){
                    header('Location: cms_produtos.php');
                }else{
                    echo($sql);
                }
            }else{
                echo("<script>alert('Selecione uma Imagem.')</script>");
                echo("<script>window.location='cms_produtos.php';</script>");
            }
        }
           
    }elseif(isset($_POST['Atualizar_produto'])){
        $titulo_filme = $_POST['titulo_filme'];
        $duracao = $_POST['duracao_filme'];
        $cod_classificacao = $_POST['sle_classificacao'];
        $cod_distribuidora = $_POST['sle_distribuidora'];
        $preco_filme = $_POST['preco_filme'];
        $sinopse = $_POST['txt_sinopse'];
        
        $img_filme = move_image($_FILES['fle_imagem_filme'], './img/imagem_filme/');

       //verificando se as caixas estão vazias
        if($titulo_filme == "" || $duracao == "" || $cod_classificacao == "null"  || $cod_distribuidora == "null"  || $preco_filme == "" || $sinopse == ""){
            echo("<script>alert('Preencha Todas as caixas.')</script>");
            echo("<script>window.location='cms_produtos.php';</script>");
        }else{
            if($img_filme != null){
                $sql = "UPDATE tbl_filme SET titulo_filme = '".$titulo_filme."',
                                             descricao = '".$sinopse."',
                                             preco_filme = REPLACE('".$preco_filme."', ',', '.' ),
                                             imagem_filme = '".$img_filme."',
                                             duracao = '".$duracao."',
                                             cod_classificacao = ".$cod_classificacao.",
                                             cod_distribuidora = ".$cod_distribuidora."
                                             WHERE cod_filme =".$_SESSION['atualizar_filme'];  
                //echo($sql);
                if(mysqli_query($conexao, $sql)){
                    $foto_antiga = $_SESSION['imagem_antiga_filme'];
                    $caminho_foto_antiga = './img/imagem_filme/'.$foto_antiga;
                    unlink($caminho_foto_antiga);
                    unset($_SESSION['atualizar_filme']);
                    header('Location: cms_produtos.php');
                }else{
                    echo($sql);
                }
            }else{
                $sql = "UPDATE tbl_filme SET titulo_filme = '".$titulo_filme."',
                descricao = '".$sinopse."',
                preco_filme = REPLACE('".$preco_filme."', ',', '.' ),
                duracao = '".$duracao."',
                cod_classificacao = ".$cod_classificacao.",
                cod_distribuidora = ".$cod_distribuidora."
                WHERE cod_filme =".$_SESSION['atualizar_filme'];  
                //echo($sql);
                if(mysqli_query($conexao, $sql)){
                    unset($_SESSION['atualizar_filme']);
                    header('Location: cms_produtos.php');
                }else{
                   echo($sql);
                }
    
            }    
        }
    }

    //excluir e editar o produto
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $codigo_produto = $_GET['id'];

        if($modo == 'excluir'){
            
            $sqlExcluir = "SELECT status_produto FROM tbl_filme WHERE cod_filme =".$codigo_produto;
            $select = mysqli_query($conexao, $sqlExcluir);
            if($rsDelete = mysqli_fetch_array($select)){
                if($rsDelete['status_produto'] == 0){

                    $sqlDelete = "DELETE FROM tbl_filme WHERE cod_filme =".$codigo_produto;
                    if(mysqli_query($conexao, $sqlDelete)){
                        $foto = $_GET['nome_imagem'];
                        $apagar_na_pasta = "./img/imagem_filme/".$foto;
                        unlink($apagar_na_pasta);
                        header('Location: cms_produtos.php');
                    }else{
                        echo($sqlDelete);
                    }
                }else{
                    echo("<script>alert('Primeira desative Este Produto.')</script>");
                    echo("<script>window.location='cms_produtos.php';</script>");
                }
            }

        }elseif($modo == 'excluirRelacao'){ //← RELAÇÃO COM O FILME
            $codigo_diretor = $_GET['id_diretor'];
            //excluindo a relção entre filme e diretor
            $sql = "DELETE FROM tbl_filme_diretor WHERE cod_diretor =".$codigo_diretor." AND cod_filme =".$codigo_produto;  
            
            if(mysqli_query($conexao, $sql)){
                header('Location: cms_produtos.php');
            }else{
                //echo $sql;
            }
        }elseif($modo == 'excluirRelacaoGenero'){ //← RELAÇÃO COM O FILME
            $codigo_genero = $_GET['id_genero'];
            //excluindo a relção entre filme e genero
            $sql = "DELETE FROM tbl_filme_genero_categoria WHERE cod_genero =".$codigo_genero." AND cod_filme =".$codigo_produto;  
            
            if(mysqli_query($conexao, $sql)){
                header('Location: cms_produtos.php');
            }else{
                echo $sql;
            }
        }elseif($modo == 'editar'){

            $sql = "SELECT filme.cod_filme,
                            filme.titulo_filme, 
                            filme.descricao, 
                            filme.preco_filme, 
                            filme.imagem_filme, 
                            filme.duracao, 
                            classificacao.cod_classificacao, 
                            classificacao.classificacao, 
                            distribuidora.cod_distribuidora, 
                            distribuidora.distribuidora
                            FROM tbl_filme as filme INNER JOIN tbl_classificacao as classificacao
                            ON filme.cod_classificacao = classificacao.cod_classificacao INNER JOIN tbl_ditribuidora as distribuidora
                            ON filme.cod_distribuidora = distribuidora.cod_distribuidora
                            WHERE cod_filme =".$codigo_produto;

            $select = mysqli_query($conexao, $sql);

            if($rsEditar = mysqli_fetch_array($select)){
                $titulo_filme = $rsEditar['titulo_filme'];
                $sinopse = $rsEditar['descricao'];
                $preco_filme = colocar_virgula($rsEditar['preco_filme']);
                $img_filme = $rsEditar['imagem_filme'];
                $duracao = $rsEditar['duracao'];
                $cod_classificacao = $rsEditar['cod_classificacao'];
                $classificacao = $rsEditar['classificacao'];
                $cod_distribuidora = $rsEditar['cod_distribuidora'];
                $distribuidora = $rsEditar['distribuidora'];
                $cod_filme = $rsEditar['cod_filme'];
                $btn = 'Atualizar';
                $btnLimpar = 'Cancelar';
                $_SESSION['atualizar_filme'] = $cod_filme;
                $_SESSION['imagem_antiga_filme'] = $rsEditar['imagem_filme'];
            }

        }


    }



    // ADICIONAR E ATUALIZAR A RELAÇÃO COM O FILME do diretor
    if(isset($_POST['Salvar_adicionar'])){ // ← ADICIONAR FILME AO DIRETOR 
        $cod_filme = $_POST['sle_filme'];
        $cod_diretor = $_POST['sle_diretor'];
       
       
        //Verificando se não há caixa nula
        if($cod_filme != null || $cod_diretor != null){
            //Verificando se o diretor já está com aquele filme
            $sqlBuscarFilmeDiretor = "SELECT cod_filme, cod_diretor FROM tbl_filme_diretor WHERE cod_filme =".$cod_filme." AND cod_diretor=".$cod_diretor;
            $select = mysqli_query($conexao, $sqlBuscarFilmeDiretor);
            if($rsResposta = mysqli_fetch_array($select)){
                if($rsResposta['cod_filme'] == $cod_filme && $rsResposta['cod_diretor'] == $cod_diretor){  
                    echo("<script>
                            alert('Não pode cadastrar o mesmo filme.'); 
                            window.location ='cms_produtos.php';        
                        </script>");
                } 

            }else{

                $sql = "INSERT INTO tbl_filme_diretor (cod_filme, cod_diretor) 
                                    VALUES  (".$cod_filme.",".$cod_diretor.")";
                if(mysqli_query($conexao, $sql)){
                        header('Location: cms_produtos.php');
                }else{
                    //se nada disso for ele valida o cadastramento que deu invalido
                    echo("<script>
                        alert('Selecione um diretor e um filme que não estejam cadastrados');
                        window.location.href = 'cms_produtos.php';
                    </script>");
                }
            }
        }else{
            echo("<script>
                        alert('Selecione um diretor e um filme');
                        window.location.href = 'cms_produtos.php';
                    </script>");
        }
       

        
    }elseif(isset($_POST['Atualizar_adicionar'])){ // ← Atualizar relçao com o filme  
        $cod_filme = $_POST['sle_filme'];
        $cod_diretor = $_POST['sle_diretor'];

        //varificando se as caixas estão vazias
        if($cod_filme == null || $cod_diretor == null){
                echo("<script>
                    alert('Selecione um filme e um diretor');
                    window.location.href = 'cms_produtos.php';
                </script>");
        }else{
            //Verificando se ja essiste essa relação do a diretor com o filme
            $sqlBuscarFilmeDiretor = "SELECT cod_filme, cod_diretor FROM tbl_filme_diretor WHERE cod_filme =".$cod_filme." AND cod_diretor =".$cod_diretor;
            $select = mysqli_query($conexao, $sqlBuscarFilmeDiretor);
            if($rsResposta = mysqli_fetch_array($select)){
                if($rsResposta['cod_filme'] == $cod_filme && $rsResposta['cod_diretor'] == $cod_diretor){  
                echo("<script>
                        alert('Não pode atualizar com o mesmo filme.'); 
                        window.location='cms_produtos.php';        
                    </script>");
                } 
            }else{
                $sql = "UPDATE tbl_filme_diretor SET cod_diretor =".$cod_diretor."
                                                WHERE cod_diretor =".$_SESSION['id_diretor']." AND cod_filme =".$_SESSION['id_filme'];

                if(mysqli_query($conexao, $sql)){
                    //Limpando as variaveis de sessão apos o up date
                    unset($_SESSION['id_diretor']);
                    unset($_SESSION['id_filme']);
                    header('Location: cms_produtos.php');                   
                }else{
                    echo $sql;
                }  
            }                          

        }
                     
    }


    //ADICIONAL UM GENERO PARA O FILME
    if(isset($_POST['Salvar_adicionar_genero'])){ // ← ADICIONAR FILME AO GENRO 
        $cod_filme = $_POST['sle_filme'];
        $cod_genero = $_POST['sle_genero'];
       
        if($cod_filme != null || $cod_genero != null){
            //Verificando se o genero já está com aquele filme
            $sqlBuscarFilmeGenero = "SELECT cod_filme, cod_genero FROM tbl_filme_genero_categoria WHERE cod_filme =".$cod_filme." AND cod_genero =".$cod_genero;
            $select = mysqli_query($conexao, $sqlBuscarFilmeGenero);
            if($rsResposta = mysqli_fetch_array($select)){
                if($rsResposta['cod_filme'] == $cod_filme && $rsResposta['cod_genero'] == $cod_genero){  
                    echo("<script>
                            alert('Não pode cadastrar dois generos iguais.'); 
                            window.location ='cms_produtos.php';        
                        </script>");
                } 

            }else{

                $sql = "INSERT INTO tbl_filme_genero_categoria (cod_filme, cod_genero) 
                                    VALUES  (".$cod_filme.",".$cod_genero.")";
                if(mysqli_query($conexao, $sql)){
                        header('Location: cms_produtos.php');
                }else{
                    //se nada disso for ele valida o cadastramento que deu invalido
                    echo("<script>
                        alert('Selecione um genero e um filme que não estejam cadastrados');
                        window.location.href = 'cms_produtos.php';
                    </script>");
                }
            }
        }else{
            echo("<script>
                        alert('Selecione um genero e um');
                        window.location.href = 'cms_produtos.php';
                    </script>");
        }
        

        
    }elseif(isset($_POST['Atualizar_adicionar_genero'])){ // ← Atualizar relçao com o filme  
        $cod_filme = $_POST['sle_filme'];
        $cod_genero = $_POST['sle_genero'];

        //varificando se as caixas estão vazias
        if($cod_filme == null || $cod_genero == null){
                echo("<script>
                    alert('Selecione um filme e um genero');
                    window.location.href = 'cms_produtos.php';
                </script>");
        }else{
            //Verificando se ja essiste essa relação do a genero com o filme
            $sqlBuscarFilmeGenero = "SELECT cod_filme, cod_genero FROM tbl_filme_genero_categoria WHERE cod_filme =".$cod_filme." AND cod_genero =".$cod_genero;
            $select = mysqli_query($conexao, $sqlBuscarFilmeGenero);
            if($rsResposta = mysqli_fetch_array($select)){
                if($rsResposta['cod_filme'] == $cod_filme && $rsResposta['cod_genero'] == $cod_genero){  
                    echo("<script>
                            alert('Não pode atualizar filme com um genero ja relacionado.'); 
                            window.location='cms_produtos.php';        
                        </script>");
                } 
            }else{
                $sql = "UPDATE tbl_filme_genero_categoria SET cod_genero =".$cod_genero."
                                                WHERE cod_genero =".$_SESSION['id_genero']." AND cod_filme =".$_SESSION['id_filme'];

                if(mysqli_query($conexao, $sql)){
                    //Limpando as variaveis de sessão apos o up date
                    unset($_SESSION['id_genero']);
                    unset($_SESSION['id_filme']);
                    header('Location: cms_produtos.php');                   
                }else{
                    echo $sql;
                }  
                
            }                          

        }
                     
    }


    if(isset($_POST['Salvar_adicionar_categoria'])){
        $cod_filme = $_POST['sle_filme'];
        $cod_categoria = $_POST['sle_categoria'];

        if($cod_categoria != null || $cod_filme != null){
            //Verificando se o categoria já está com aquele filme
            $sqlBuscarFilmeCategoria = "SELECT cod_filme, cod_genero, cod_categoria FROM tbl_filme_genero_categoria WHERE cod_filme =".$cod_filme;
            $select = mysqli_query($conexao, $sqlBuscarFilmeCategoria);
            if($rsResposta = mysqli_fetch_array($select)){
                if($rsResposta['cod_filme'] != null && $rsResposta['cod_genero'] != null){  
                    if($rsResposta['cod_categoria'] != $cod_categoria){
                        $sql = "UPDATE tbl_filme_genero_categoria set cod_categoria = ".$cod_categoria." WHERE cod_filme =".$cod_filme;
                        if(mysqli_query($conexao, $sql)){
                                header('Location: cms_produtos.php');
                        }else{
                            //se nada disso for ele valida o cadastramento que deu invalido
                            echo("<script>
                                alert('Selecione uma categoria e um filme que não estejam Relacionados');
                                window.location.href = 'cms_produtos.php';
                            </script>");
                        }
                    }else{
                        echo("<script>
                            alert('Já existe Este relacionamento.'); 
                            window.location ='cms_produtos.php';        
                        </script>");
                    }
                   
                } 

            }else{
                echo("<script>
                    alert('Primeiro coloque um genero no filme.'); 
                    window.location ='cms_produtos.php';        
                </script>");
            }
        }else{
            echo("<script>
                alert('Selecione um filme e uma categoria');
                window.location.href = 'cms_produtos.php';
            </script>");
        }

    }



?>
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
        <script>
            //desativando modal
            $(document).ready(function(){
                $('#fachar_modal_fale_conosco').click(function(){
                    $('#conteiner').fadeOut(300);
                });
            });
            // ativando modal
            $(document).ready(function(){
                $('.visualizar').click(function(){
                    $('#conteiner').fadeIn(300);
                });
            });

//          atribuindo um filme a um diretor
            function colocardiretor(modo, codigo){
                $.ajax({
                    type:'GET',
                    url: "./modais/cms_modal_colocar_filme_diretor.php",
                    data:{modo:modo, codigo:codigo},
                    success: function(dados){
                        $('#modal').html(dados);
                    },
                })
            }
            // função que vai consultar os diretores de um filme
            function consultarDiretor(codigo){
                $.ajax({
                    type:'GET',
                    url: "./modais/cms_modal_consultar_diretor.php",
                    data:{codigo:codigo},
                    success: function(dados){
                        $('#modal').html(dados);
                    },
                })
            }

//          atribuindo um filme a um genero
            function colocargenero(modo, codigo_filme, codigo_genero){
                $.ajax({
                    type:'GET',
                    url: "./modais/cms_modal_colocar_genero_categoria_no_filme.php",
                    data:{modo:modo, codigo_filme:codigo_filme, codigo_genero:codigo_genero},
                    success: function(dados){
                        $('#modal').html(dados);
                    },
                })
            }
//          consultando os generos de um filme
            function consultarGenero(codigo){
                $.ajax({
                    type:'GET',
                    url: "./modais/cms_modal_consultar_genero.php",
                    data:{codigo:codigo},
                    success: function(dados){
                        $('#modal').html(dados);
                    },
                })
            }
//          colocancando a categoria
            function colocarcategoria(modo, codigo){
                $.ajax({
                    type:'GET',
                    url: "./modais/cms_modal_colocar_categoria.php",
                    data:{modo:modo, codigo:codigo},
                    success: function(dados){
                        $('#modal').html(dados);
                    },
                })
            }



        </script>
    </head>
    <body>
        <!-- contender da modal que vai abrir para mostrar o cliente por completo -->
        <div id="conteiner">
            <!-- div com o objetivo de fechar a modal -->
            <div id="segurar_fechar_modal" class="center">
                <figure>
                    <div id="fechar_modal">
                        <a href="#" class="img-size" id="fachar_modal_fale_conosco">
                            <img   class="img-size" src="./img/icone_sair.png" alt="sair da modal" title="sair da modal">
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
            <div  id="conteudo_paginas_conteudo">

                 <!-- caixa que vai conter outras paginas relacionadas sobre a empresa                 -->
                 <div id="menu_card_cadastro">
                    
                    <div class="itens_card_cadastro visualizar" onclick="colocardiretor('Salvar', 0)">
                        Adicionar Diretor
                    </div>      
                    <div class="itens_card_cadastro formataDiv_cadadostro visualizar" onclick="colocargenero('Salvar', 0, 0)">
                        Adicionar Genero e Categoria
                    </div>

                </div>
                
                <!-- vai mostrar todos os sobres cadastrados -->
                <div id="segura_table_conteudo">
                    <!-- card que ira cadastrar o produto -->
                    <form name="frm_cadatrar_produto" method="POST" action="cms_produtos.php" enctype="multipart/form-data">
                        <div id="card_cadastrar_produto">
                    
                            <div class="segura_caixas_produto">
                                <div class="segura_txt_produto">
                                    <h4>Titulo Do Filme</h4>
                                    <input type="text" class="txt_produto" value="<?php echo($titulo_filme)?>" placeholder="Ex: A vida dos mortos" name="titulo_filme" id="titulo-produto">
                                
                                </div>
                                <div class="segura_txt_produto">
                                    <h4>Duração</h4>
                                    <input type="text" class="txt_produto"  value="<?php echo($duracao)?>" placeholder="Ex: 150 Minutos"  name="duracao_filme" id="duracao-filme">

                                </div>
                            </div>

                            <div class="segura_caixas_produto">
                                <div class="segura_txt_produto">
                                    <h4>Classificacao</h4>

                                    <select name="sle_classificacao" class="txt_produto">
                                        
                                        <?php
                                            if($modo == 'editar'){
                                        ?>
                                        <option value="<?php echo($cod_classificacao)?>"><?php echo($classificacao)?></option>
                                        <?php
                                            }else{
                                        ?>
                                        <option value="null">Classificação</option>
                                        <?php
                                            }
                                            $sql = "SELECT cod_classificacao, classificacao FROM tbl_classificacao WHERE cod_classificacao <> ".$cod_classificacao;
                                            $select = mysqli_query($conexao, $sql);

                                            while($rsClassificacao = mysqli_fetch_array($select)){
                                        ?>
                                        <option value="<?php echo($rsClassificacao['cod_classificacao'])?>"><?php echo($rsClassificacao['classificacao'])?></option>
                                        <?php
                                            }
                                        ?>
                                    
                                    </select>
                                
                                </div>
                                <div class="segura_txt_produto">
                                    <h4>Distribuidora</h4>
                                    
                                    <select name="sle_distribuidora"  class="txt_produto">

                                        <?php
                                            if($modo == "editar"){
                                        ?>
                                        <option  value="<?php echo($cod_distribuidora)?>"><?php echo($distribuidora)?></option>

                                        <?php
                                            }else{
                                        ?>
                                        <option value="null">Distribuidora</option>
                                        <?php
                                            }
                                            $sqlDistribuidora = "SELECT cod_distribuidora, distribuidora FROM tbl_ditribuidora WHERE cod_distribuidora <> ".$cod_distribuidora;
                                            $select = mysqli_query($conexao, $sqlDistribuidora);
                                            while($rsDistribuidora = mysqli_fetch_array($select)){
                                        ?>
                                        <option value="<?php echo($rsDistribuidora['cod_distribuidora'])?>"><?php echo($rsDistribuidora['distribuidora'])?></option>
                                        <?php
                                            }
                                        ?>
                                    
                                    </select>

                                    <!-- icone para adicionar a Distribuidora -->
                                    <div class="adicionar icon iconSemMargin">
                                        <a href="cms_distribuidora.php">
                                            <img src="./img/icon_add.png" class="img-size" alt="Adicionar" title="Adicionar Distribuidora">
                                        </a>
                                    </div>
                                
                                </div>
                            </div>

                            <div class="segura_caixas_produto">
                                <div class="segura_txt_produto">
                                    <h4>Preço</h4>
                                    <input type="text" value="<?php echo($preco_filme)?>" class="txt_produto" placeholder="Ex: 35,20"  name="preco_filme" id="preco-filme">
                                
                                </div>
                                <div class="segura_txt_produto">
                                    <h4>Imagem</h4>
                                    <input type="FILE" name="fle_imagem_filme">
                                </div>
                        
                            </div>
                        
                            <div id="segura_imagem_sinopse">
                                <?php
                                    
                                    if($img_filme != null){
                                ?>
                                <div id="segura_img_filme">
                                    <img src="./img/imagem_filme/<?php echo($img_filme)?>" class="img-size" alt="Produto">
                                </div>
                                <div id="segura_botoes_filme">
                                    <div class="ver_atributos_filme visualizar center" onclick="consultarGenero(<?php echo($cod_filme)?>)">
                                       Generos 
                                    </div>
                                    <div class="ver_atributos_filme visualizar center" onclick="consultarDiretor(<?php echo($cod_filme)?>)">
                                       Diretores
                                    </div>
                                    <div class="ver_atributos_filme visualizar center">
                                       Categorias
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>

                                <textarea id="txt_produto_sinopse" placeholder="Sinopse" class="center scrollTexto" name="txt_sinopse"><?php echo($sinopse)?></textarea>

                                <div id="segura_botao_ator">
                                    <input type="submit" value="<?php echo($btn);?>" name="<?php echo($btn.'_produto');?>" id="cadastrar_produto" class="botao_cadastro_usuario"> 
                                    <input type="submit" value="<?php echo($btnLimpar);?>" name="limpar_produto" id="limpar_produto" class="botao_cadastro_usuario"> 
                                </div>
                            
                            </div>
                        </div>
                    </form>



                    <?php
                        $sql = "SELECT  filme.cod_filme,
                        filme.titulo_filme,
                        filme.status_produto,
                        filme.imagem_filme,
                        filme.duracao,
                        filme.preco_filme,
                        classificacao.classificacao,
                        distribuidora.distribuidora
                        FROM tbl_filme as filme INNER JOIN tbl_classificacao as classificacao
                        ON filme.cod_classificacao = classificacao.cod_classificacao INNER JOIN tbl_ditribuidora as distribuidora
                        ON filme.cod_distribuidora = distribuidora.cod_distribuidora GROUP BY cod_filme";

                        $select = mysqli_query($conexao, $sql);

                        while($rsProduto = mysqli_fetch_array($select)){
                    
                    ?>
                    <div class="card_filme_produto center">
                        <figure>
                            <div class="img_filme_produto">
                                <img src="./img/imagem_filme/<?php echo($rsProduto['imagem_filme'])?>" class="img-size" alt="Produto">
                            </div>
                        </figure>
                        <!-- div que vai segurar os atributos da filme -->
                        <div class="atributos_filme_produto">
                            <!-- div com o titulo do filme -->
                            <div class="titulo_filme_produto">
                                <?=$rsProduto['titulo_filme']?>
                            </div>
                            <!-- divs que estarão o diretor, genero, classificacao e distribuidora -->
                            <div class="segura_atributos_produto">
                                <div class="atributos_produto">
                                    Preço: <?php
                                        $preco = colocar_virgula($rsProduto['preco_filme']);
                                        echo ($preco);
                                    ?>
                                </div>
                                <div class="atributos_produto">
                                    Duração: <?=$rsProduto['duracao']?>
                                </div>
                            </div>
                            <div class="segura_atributos_produto">
                                <div class="atributos_produto">
                                    Classificação: <?=$rsProduto['classificacao']?>
                                </div>
                                <div class="atributos_produto">
                                    Distribuidora: <?=$rsProduto['distribuidora']?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="filme_produto">
                            <div class="opcoes_produto center">
                                <?php
                                    $img = $rsProduto['status_produto'] == 0 ? 'icon_nao_ativo.png' : 'icon_ativo.png';
                                    $altEtitle = $rsProduto['status_produto'] == 0 ? 'Não ativo' : 'Ativo';
                                ?>
                                <img src="./img/<?php echo($img)?>" onclick="ativarDesativar('filme_mes', <?php echo($rsFilme_mes['status'])?>,<?php echo($rsFilme_mes['cod_filme'])?>)" class="img-size icon iconSemMargin" alt="<?php echo($altEtitle)?>" title="<?php echo($altEtitle)?>">
                            </div>
                            <div class="opcoes_produto center">
                                <a href="?modo=editar&id=<?php echo($rsProduto['cod_filme'])?>" >
                                    <img src="./img/icon_edit.png"  class="img-size icon iconSemMargin" alt="Editar" title="Editar Produto">
                                </a>
                            </div>
                            <div class="opcoes_produto center">
                                <a href="?modo=excluir&id=<?php echo($rsProduto['cod_filme'])?>&nome_imagem=<?php echo($rsProduto['imagem_filme'])?>">
                                    <img src="./img/icon_delete.png" onclick="return confirm('Deseja reamente excluir o(a) <?php echo($rsProduto['titulo_filme']);?>')" class="img-size border-radius-img icon iconSemMargin" alt="Deletar" title="Deletar Produto">
                                </a>   
                            </div>
                            
                        </div>
                    
                    </div>
                    <?php
                        }
                    ?>

                </div>

            </div>


            <!-- footer do cms -->
           <?php require_once('./cms_footer.php');?>
        </div>


    </body>
</html>
