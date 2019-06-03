<?php   
    //varivel de sessão
    require_once('./usuario_verificado.php');
    //banco
    require_once('../db/conexao.php');
    $conexao = conexaoMysql();
    //move foto
    require_once('./util/upload_imagem.php');

    //pegando as permissões
    require_once('./util/consultar_permissoes.php');
    //chamando a função para validação
    $permissoes = consultarPermissoes();

    if($permissoes['conteudo'] == 0){
        header("Location: index.php");
    }


    //CADASTRAR E ATUALIZAR ATOR
    if(isset($_POST['Cadastrar_ator'])){
        //pegando o ator cadastrado
        $nome = trim($_POST['nome_ator']);
        $nascionalidade = trim($_POST['nascionalidade_ator']);
        $atividade = trim($_POST['ativadade_ator']);
        /** usando o explode para formatar a data*/
        $dataNasci = explode("/", $_POST['data_naci_ator']) == true ? explode("/", $_POST['data_naci_ator']) : false;
        $dataNasci_certo = $dataNasci[2]."-".$dataNasci[1]."-".$dataNasci[0];
        //*****/
        $bio = trim($_POST['biografia_ator']);
        
        // usando uma função para cadastrar a imagem
        $foto_ator = move_image($_FILES['fle_ator'], './img/imagem_ator/');

        //Verificando se todas as caixas estão preenchidas corretamente
        if($nome == "" || $nascionalidade == "" || $atividade  == "" || $dataNasci == false || $bio == ""){
            echo("<script>
                alert('Preencha todas as caixas necessárias e corretamente. Lembre-se de colocar a data na metodologia Brasileira');
                window.location.href = 'cms_atores.php';
            </script>");
        }else{
            if($foto_ator != null){
                // se tudo correr como planejado, ele inserie na tabela
                $sql = "INSERT INTO tbl_ator (nome_ator, nascionalidade, atividade, data_nacimento, biografia, imagem_ator)
                VALUES ('".$nome."', '".$nascionalidade."', '".$atividade."', '".$dataNasci_certo."' ,'".$bio."', '".$foto_ator."')";
    
                if(mysqli_query($conexao, $sql)){
                    header('Location: cms_atores.php');
                }else{
                    echo($sql);
                }
            }else{
                //
                echo("<script>alert('Erro ao mover a imagem para o Servidor Obs:Lembre-se de escolher uma imagem com as exteções corrtas (jpg, png, jpeg,  jfif) e preencha todas as caixas.')</script>");
                echo("<script>window.location='cms_atores.php';</script>");
            }
        }
  

    }elseif(isset($_POST['Atualizar_ator'])){

        //pegando todos os atributos do ator
        $nome = $_POST['nome_ator'];
        $nascionalidade = $_POST['nascionalidade_ator'];
        $atividade = $_POST['ativadade_ator'];
        /** usando o explode para formatar a data de nascimento*/
        $dataNasci = explode("/",$_POST['data_naci_ator']);
        $dataNasci_certo = $dataNasci[2]."-".$dataNasci[1]."-".$dataNasci[0];
        //*****/
        $bio = $_POST['biografia_ator'];
        //usando uma função para cadastrar a imagem do atoe
        $foto_ator = move_image($_FILES['fle_ator'], './img/imagem_ator/');

        if($nome == "" || $nascionalidade == "" || $atividade  == "" || $dataNasci == false || $bio == ""){
            echo("<script>
                alert('Preencha todas as caixas necessárias e corretamente. Lembre-se de colocar a data na metodologia Brasileira');
                window.location.href = 'cms_atores.php';
            </script>");
        }else{
            
            if($foto_ator != null){
                //atulizando com a imagem do ator 
                $sql = "UPDATE tbl_ator SET nome_ator='".$nome."',
                                            nascionalidade ='".$nascionalidade."',
                                            atividade = '".$atividade."',
                                            data_nacimento = '".$dataNasci_certo."',
                                            biografia = '".$bio."',
                                            imagem_ator = '".$foto_ator."'
                                            WHERE cod_ator =".$_SESSION['cod_ator'];
            
                if(mysqli_query($conexao, $sql)){
                    header('Location: cms_atores.php');
                    unlink('./img/imagem_ator/'.$_SESSION['foto_antiga_ator']);
                    unset($_SESSION['cod_ator']);
                }else{
                    echo($sql);
                }
            
            
            }else{
                //Atulizando ator sem imagem
                $sql = "UPDATE tbl_ator SET nome_ator='".$nome."',
                                            nascionalidade ='".$nascionalidade."',
                                            atividade = '".$atividade."',
                                            data_nacimento = '".$dataNasci_certo."',
                                            biografia = '".$bio."'
                                            WHERE cod_ator =".$_SESSION['cod_ator'];
            
                 if(mysqli_query($conexao, $sql)){
                    header('Location: cms_atores.php');
                    unset($_SESSION['cod_ator']);
                }else{
                    echo($sql);
                }
            }

        }
        

    }

    //APADAR O ATOR OU SUA RELAÇÃO COM O FILME
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $codigo = $_GET['id'];
        $codigo_filme = $_GET['id_filme'];

        if($modo == 'excluir'){ // ← excluir ator
            //verificando se o ator está ativo
            $sql = "SELECT imagem_ator, status FROM tbl_ator WHERE cod_ator =".$codigo;
            $select = mysqli_query($conexao, $sql);

            if($rsExcluirAtor = mysqli_fetch_array($select)){

                if($rsExcluirAtor['status'] == 0){
                    //excluindo o ator desativo 
                    $sql = "DELETE FROM tbl_ator WHERE cod_ator =".$codigo;

                    if(mysqli_query($conexao, $sql)){
                        unlink('./img/imagem_ator/'.$rsExcluirAtor['imagem_ator']);
                        header('Location: cms_atores.php');
                    }
                }else{
                    echo("<script>alert('Primeiro ative outro ator para excluir este')</script>");
                    echo("<script>window.location='cms_atores.php';</script>");
                }

            }
            
        }elseif($modo == 'excluirRelacao'){ //← RELAÇÃO COM O FILME
            //excluindo a relção entre filme e ator
            $sql = "DELETE FROM tbl_filme_ator WHERE cod_ator =".$codigo." AND cod_filme =".$codigo_filme;  
            
            if(mysqli_query($conexao, $sql)){
                header('Location: cms_atores.php');
            }else{
                //echo $sql;
            }
        }

    }

    // ADICIONAR E ATUALIZAR A RELAÇÃO COM O FILME
    if(isset($_POST['Salvar_adicionar'])){ // ← ADICIONAR FILME AO ATOR 
        $cod_filme = $_POST['sle_filme'];
        $cod_ator = $_POST['sle_ator'];
       
        //Verificando se o ator já está com aquele filme
        $sqlBuscarFilmeAotr = "SELECT cod_filme, cod_ator FROM tbl_filme_ator WHERE cod_filme =".$cod_filme." AND cod_ator =".$cod_ator;
        $select = mysqli_query($conexao, $sqlBuscarFilmeAotr);
        if($rsResposta = mysqli_fetch_array($select)){
            if($rsResposta['cod_filme'] == $cod_filme && $rsResposta['cod_ator'] == $cod_ator){  
                echo("<script>
                        alert('Não pode cadastrar o mesmo filme.'); 
                        window.location ='cms_atores.php';        
                    </script>");
            } 

        }else{

            $sql = "INSERT INTO tbl_filme_ator (cod_filme, cod_ator) 
                                VALUES  (".$cod_filme.",".$cod_ator.")";
            if(mysqli_query($conexao, $sql)){
                    header('Location: cms_atores.php');
            }else{
                //se nada disso for ele valida o cadastramento que deu invalido
                echo("<script>
                    alert('Selecione um ator e um filme que não estejam adastrados');
                    window.location.href = 'cms_atores.php';
                </script>");
            }
        }

        
    }elseif(isset($_POST['Atualizar_adicionar'])){ // ← Atualizar relçao com o filme  
        $cod_filme = $_POST['sle_filme'];
        $cod_ator = $_POST['sle_ator'];

        //varificando se as caixas estão vazias
        if($cod_filme == null || $cod_ator == null){
                echo("<script>
                    alert('Selecione um filme e um ator');
                    window.location.href = 'cms_atores.php';
                </script>");
        }else{
            //Verificando se ja essiste essa relação do a ator com o filme
            $sqlBuscarFilmeAotr = "SELECT cod_filme, cod_ator FROM tbl_filme_ator WHERE cod_filme =".$cod_filme." AND cod_ator =".$cod_ator;
            $select = mysqli_query($conexao, $sqlBuscarFilmeAotr);
            if($rsResposta = mysqli_fetch_array($select)){
                if($rsResposta['cod_filme'] == $cod_filme && $rsResposta['cod_ator'] == $cod_ator){  
                echo("<script>
                        alert('Não pode atualizar com um filme que já esteja cadastrado.'); 
                        window.location='cms_atores.php';        
                    </script>");
                } 
            }else{
                $sql = "UPDATE tbl_filme_ator SET cod_filme =".$cod_filme."
                                                WHERE cod_ator =".$_SESSION['id_ator']." AND cod_filme =". $_SESSION['id_filme'];

                if(mysqli_query($conexao, $sql)){
                    //Limpando as variaveis de sessão apos o up date
                    header('Location: cms_atores.php');
                    unset($_SESSION['id_ator']);
                    unset($_SESSION['id_filme']);
                    
                }else{
                    echo $sql;
                }  
            }                          

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

//          cadastrando um ator
            function cadastrarEvisualizarator(modo, codigo){
                $.ajax({
                    type: "GET",
                    url: "./modais/cms_modal_cadastrar_ator.php",
                    data:{modo:modo, codigo:codigo},
                    success: function(dados){
                        $('#modal_larga').html(dados);
                    }

                });
            }
//          atribuindo um filme a um ator
            function colocarAtor_filme(modo, codigo_ator, codigo_filme){
                $.ajax({
                    type:'GET',
                    url: "./modais/cms_modal_colocar_ator_filme.php",
                    data:{modo:modo, codigo_ator:codigo_ator, codigo_filme:codigo_filme},
                    success: function(dados){
                        $('#modal_larga').html(dados);
                    },
                })
            }
//             ativando e desativando ator
            function ativarDesativar(pagina, status, codigo){
                $.ajax({
                    type:'GET',
                    url: "./util/ativar_desativar.php",
                    data:{pagina:pagina, status:status, codigo:codigo},
                    complete: function(response){
                        location.reload();
                    },
                })
            }

        
        </script>

    </head>
    <body>
        <!-- cnotender da modal que vai abrir para mostrar o cliente por completo -->
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
            <div id="modal_larga" class="center">
                
            </div>
        </div>

        <!-- div que está segurando tudo -->
        <div id="conteudo_cms" class="center">
            <!-- header que está com o logo e o titulo -->
            <?php require_once('./cms_header.php');?>

            <!-- caixa com o menu e o nome do usuario -->
           <?php require_once('./cms_menu_paginas_usuario.php');?>
            
        
           
            <!-- conteudo do menu do cms -->
            <div id="conteudo_paginas_conteudo">
                <!-- caixa que vai conter outras paginas relacionadas sobre a empresa                 -->
                <div id="menu_card_cadastro">
                    
                    <div class="itens_card_cadastro visualizar" onclick="cadastrarEvisualizarator('Cadastrar', 0)">
                        Cadastrar ator
                    </div>      
                    <div class="itens_card_cadastro visualizar" onclick="colocarAtor_filme('Salvar', 0, 0)">
                        Adicionar filme
                    </div>      

                </div>
                
                <!-- vai mostrar todos os sobres cadastrados -->
                <div id="segura_table_conteudo">

                    <?php
                        $sql="SELECT * FROM tbl_ator";
                        $select = mysqli_query($conexao, $sql);

                        while($rsAtor = mysqli_fetch_array($select)){
                    ?>



                    <!-- card que vai mostrar o nome e a história do ator -->
                    <div class="card_ator center">
                        <figure>
                            <div class="imagem_ator">
                                <img src="./img/imagem_ator/<?php echo($rsAtor['imagem_ator'])?>" class="img-size" alt="<?php echo($rsAtor['imagem_ator'])?>">
                            </div>
                        </figure>
                        
                        <div class="nome_bio_ator">
                            <div class="nome_ator">
                                <?php echo($rsAtor['nome_ator'])?>
                            </div>
                            <div class="bio_ator scrollTexto">
                                
                                <?php echo($rsAtor['biografia'])?>
                                
                            </div>
                        </div>
                        
                        <figure>
                            <div class="caixa_opcoes">
                                <img src="./img/icon_edit.png"  onclick="cadastrarEvisualizarator('Atualizar', <?php echo($rsAtor['cod_ator'])?>)" class="img-size icon visualizar" alt="Editar Ator" title="Editar Ator">
                            </div>
                        </figure>
                        
                        <figure>
                            <div class="caixa_opcoes">
                                <a href="?modo=excluir&id=<?php echo($rsAtor['cod_ator'])?>">
                                    <img src="./img/icon_delete.png" class="img-size icon" onclick="return confirm('Deseja reamente excluir o(a) <?php echo($rsAtor['nome_ator']);?>')" alt="Excluir Ator" title="Excluir Ator">
                                </a>
                            </div>
                        </figure>

                        <?php
                            $img = $rsAtor['status'] == 1 ? 'icon_ativo.png' : 'icon_nao_ativo.png';
                            $altEtitle = $rsAtor['status'] == 1 ? 'Desativar Ator do mês' : 'Ativar Ator do mês';
                        ?>
                        <figure>
                            <div class="caixa_opcoes">
                                <img src="./img/<?php echo($img)?>" onclick="ativarDesativar('ator', <?php echo($rsAtor['status'])?>, <?php echo($rsAtor['cod_ator'])?>)" class="img-size icon" alt="<?php echo($altEtitle)?>" title="<?php echo($altEtitle)?>">
                            </div>
                        </figure>    
                        
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