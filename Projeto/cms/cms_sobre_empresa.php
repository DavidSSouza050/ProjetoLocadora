<?php
    //Ativa o recurso de variavel de sessão
    require_once('./usuario_verificado.php');
    //pegando a conexão de outra pasta
    require_once('../db/conexao.php');
    $conexao = conexaoMysql();
    //pegando a pagina para a função da imagem
    require_once('./util/upload_imagem.php');
    //pegando as permissões
    require_once('./util/consultar_permissoes.php');
    //chamando a função para validação
    $permissoes = consultarPermissoes();
    //validando usuario
    if($permissoes['conteudo'] == 0){
        header("Location: index.php");
    }
   
    
    if(isset($_POST['Cadastrar_sobre'])){// ← cadastrando o sobre da empresa
        $titulo_sobre = trim($_POST['txt_titulo_sobre']);
        $texto_sobre =  trim($_POST['textA_sobre']);       

       $foto_pronta = move_image($_FILES['fle_imagem'], './img/imagem_sobre/');
        //verificando se as caixas estão vazias
       if($titulo_sobre == "" || $texto_sobre == ""){
            echo("<script>alert('Preencha os Campos')</script>");
            echo("<script>window.location='cms_sobre_empresa.php';</script>");

        }else{   
           //verificando se ha imagem
            if($foto_pronta != null){
                $sql = "INSERT INTO tbl_sobre (texto_sobre, titulo_sobre, imagem_sobre)
                VALUES ('".addslashes($texto_sobre)."','".addslashes($titulo_sobre)."', '".addslashes($foto_pronta)."');" ;   
                
                //echo($sql);
                if(mysqli_query($conexao, $sql)){
                    header('Location: cms_sobre_empresa.php');
                }
            }else{
                echo("<script>alert('Erro ao mover a imagem para o Servidor Obs:Lembre-se de escolher uma imagem com as exteções corrtas (jpg, png, jpeg) e preencha todas as caixas.')</script>");
                echo("<script>window.location='cms_sobre_empresa.php';</script>");
            }

        }
        
               
  
    }elseif(isset($_POST['Atualizar_sobre'])){// ← atualizando o sobre da empresa
        $titulo_sobre = $_POST['txt_titulo_sobre'];
        $texto_sobre =  $_POST['textA_sobre'];
        
        $foto_pronta = move_image($_FILES['fle_imagem'], './img/imagem_sobre/');

          //verificando se as caixas estão vazias
        if($titulo_sobre == "" || $texto_sobre == ""){
        echo("<script>alert('Preencha os Campos')</script>");
        echo("<script>window.location='cms_sobre_empresa.php';</script>");

        }else{ 
            if($foto_pronta != null){
                $sql = "UPDATE tbl_sobre set titulo_sobre ='".$titulo_sobre."', 
                                        texto_sobre ='".$texto_sobre."',
                                        imagem_sobre = '".$foto_pronta."'
                                        WHERE cod_sobre = ".$_SESSION['id_sobre'];

                if(mysqli_query($conexao, $sql)){
                    header('Location: cms_sobre_empresa.php');
                    unlink('./img/imagem_sobre/'.$_SESSION['nome_img']);
                    unset($_SESSION['id_sobre']);
                }
        
            }else{
                $sql = "UPDATE tbl_sobre set titulo_sobre ='".$titulo_sobre."', 
                                        texto_sobre ='".$texto_sobre."'
                                        WHERE cod_sobre = ".$_SESSION['id_sobre'];

                if(mysqli_query($conexao, $sql)){
                    header('Location: cms_sobre_empresa.php');
                    unset($_SESSION['id_sobre']);
                }
            }
            
        }
        //echo($sql);
      
    }

    if(isset($_GET['modo'])){ // ← passando o modo para exclusão
        $modo = $_GET['modo'];
        $cod_sobre = $_GET['id'];

        if($modo == 'excluir'){
            //verificando se o nivel está no usuario
            $sql = "SELECT sobre.status from tbl_sobre as sobre WHERE cod_sobre =".$cod_sobre;
            $select=mysqli_query($conexao,$sql);
            //execultando o sql
            if($rsSobreAtivo = mysqli_fetch_array($select)){
                //verificando se está ativado
                if($rsSobreAtivo['status'] == 1){
                    echo("<script>alert('Primeiro ative outro Sobre para excluir este')</script>");
                    echo("<script>window.location='cms_sobre_empresa.php';</script>");
                }elseif($rsSobreAtivo['status'] == 0){
                //se não deleta o sobre     
                    $sqlDelete = "DELETE FROM tbl_sobre WHERE cod_sobre = ".$cod_sobre;
            
                    if(mysqli_query($conexao, $sqlDelete)){
                        /*Redireciona para uma nova pagina*/
                        //apagando a imagem da pasta 
                        $foto = $_GET['nome_foto'];
                        $apaga_imagem = "img/imagem_sobre/".$foto;
                        unlink($apaga_imagem);
                        header("Location: cms_sobre_empresa.php");

                    }else{
                        // se não der certo mostra essa mensagem
                        echo("
                            <script>
                                alert('erro na exclusão');
                            </script>
                        ");
                    }  
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
            $(document).ready(function(){
                $('#fachar_modal_fale_conosco').click(function(){
                    $('#conteiner').fadeOut(300);
                });
            });

            $(document).ready(function(){
                $('.visualizar').click(function(){
                    $('#conteiner').fadeIn(300);
                });
            });
            function cadastrar_sobre(modo, codigo){
                $.ajax({
                    type:'GET',
                    url: "./modais/cms_modal_cadastrar_sobre.php",
                    data:{modo:modo, codigo:codigo},
                    success: function(dados){
                        $('#modal_larga').html(dados);
                    },

                });
            }

            function ativarDesativar(pagina, status, codigo){
                $.ajax({
                    type: 'GET',
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
            <!-- div vom o objetivo de fechar a modal -->
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
                    <div class="itens_card_cadastro visualizar" onclick="cadastrar_sobre('Cadastrar', 0)">
                        Cadastrar sobre
                    </div>      
                </div>
                
                <!-- vai mostrar todos os sobres cadastrados -->
                <div id="segura_table_conteudo">
                    <table id="table">
                        <tr id="thead">
                            <td>
                                Titulo
                            </td>
                            <td>
                                Opções
                            </td>
                        </tr>
                        
                        <?php
                            $sql="SELECT * FROM tbl_sobre";
                            
                            $select = mysqli_query($conexao, $sql);
                            while($rsSobre = mysqli_fetch_array($select)){
                        ?>
                        <tr class="tbody">
                            <td>
                                <?php echo($rsSobre['titulo_sobre'])?>
                            </td>
                            <td>
                               
                                <img  src="./img/icon_edit.png" onclick="cadastrar_sobre('Atualizar', <?php echo($rsSobre['cod_sobre']);?>)" class="icon img-size visualizar" alt="Edição">
                            
                                <a href="?modo=excluir&id=<?php echo($rsSobre['cod_sobre'])?>&nome_foto=<?php echo($rsSobre['imagem_sobre'])?>">
                                    <img src="./img/icon_delete.png" onclick="return confirm('Deseja reamente excluir o(a) <?php echo($rsSobre['titulo_sobre']);?>')" class="icon img-size" alt="Deletar">
                                </a>

                                <?php
                                    $img = $rsSobre['status'] == 0 ? 'icon_nao_ativo.png' : 'icon_ativo.png';
                                    $altEtitle = $rsSobre['status'] == 0 ? 'não ativo' : 'ativo';
                                ?>
                                <img src="./img/<?php echo($img)?>" class="icon img-size" onclick="ativarDesativar('sobre_empresa', <?php echo($rsSobre['status'])?>, <?php echo($rsSobre['cod_sobre'])?>)" alt="<?php echo($altEtitle)?>" title="<?php echo($altEtitle)?>">

                            </td>
                        </tr>
                        <?php
                            }
                        ?>

                    </table>
                </div>
                
            </div>

            <!-- footer do cms -->
           <?php require_once('./cms_footer.php');?>
        </div>


    </body>
</html>