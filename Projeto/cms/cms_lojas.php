<?php   
    //varivel de sessão
    require_once('./usuario_verificado.php');
    //banco
    require_once('../db/conexao.php');
    $conexao = conexaoMysql();


    if(isset($_POST['Cadastrar_loja'])){
        $cep = trim($_POST['txt_cep']);
        $numero = trim($_POST['txt_numero']);
        $logradouro = trim($_POST['txt_logradouro']);
        $bairro = trim($_POST['txt_bairro']);
        $cidade = trim($_POST['txt_cidade']);

        //verificando se nemuma coixa está vazia
        if($cep == "" || $numero == ""){
            echo("<script>
                        alert('Preencha todas as caixas necessárias');
                        window.location.href = 'cms_lojas.php';
                    </script>");
        }else{
    
            //fazendo  conexao para verificar se a um cep para não posibilitar a entrarda de um mesmo cep
            $sql = "SELECT * FROM tbl_endereco WHERE cep ='".$cep."' ";
            $select = mysqli_query($conexao, $sql);
            // trazendo todos os enderesos para verificar se tem o meus cep
            if($rsEndereco = mysqli_fetch_array($select)){
                //verificando se é o mesmo cep
                if($rsEndereco['cep'] == $cep){
                    //alertando o usuario e atualizando a pagina para não cadastrar um ultro endereco
                    echo("<script>alert('Não pode haver Mais de um cep')</script>");
                    echo("<script>window.location='cms_lojas.php';</script>");
                }
            }else{
                //cadastrando o indereco
                $sql = "INSERT INTO tbl_endereco (logradouro, cep, bairro, numero, cod_cidade)
                VALUES ('".$logradouro."', 
                    '".$cep."', 
                    '".$bairro."', 
                    '".$numero."', 
                    (SELECT cod_cidade FROM tbl_cidade WHERE cidade = '".$cidade."'));"; 

                if(mysqli_query($conexao, $sql)){            
                    $codido_endereco = mysqli_insert_id($conexao);
                    $sql = "INSERT INTO tbl_loja (cod_endereco)
                        VALUES (".$codido_endereco.");";
                }

                if(mysqli_query($conexao, $sql)){
                    header('Location: cms_lojas.php');
                }else{
                    echo($sql);
                }
            }
        }  
            
        //******************************************************** */
   

    }elseif(isset($_POST['Atualizar_loja'])){
        $cep = $_POST['txt_cep'];
        $numero = $_POST['txt_numero'];
        $logradouro = $_POST['txt_logradouro'];
        $bairro = $_POST['txt_bairro'];
        $cidade = $_POST['txt_cidade'];

        $sql = "UPDATE tbl_endereco 
                SET cep ='".$cep."',
                numero = '".$numero."',
                logradouro = '".$logradouro."',
                bairro = '".$bairro."',
                cod_cidade = (SELECT cod_cidade FROM tbl_cidade WHERE cidade ='".$cidade."')
                WHERE cod_endereco = ". $_SESSION['atulizar_endereco'];

        if(mysqli_query($conexao, $sql)){
            header('Location: cms_lojas.php');
            echo($_SESSION['atulizar_endereco']);
        }
    }


    //pegando o modo
    if(isset($_GET['modo'])){
        //pegando o modo para excluir
        $modo = $_GET['modo'];
        //pegando o codigo do endereco para excluir junto com a loja
        $codido_endereco = $_GET['id'];

        if($modo == 'excluir'){
            $sql = "DELETE loja.*, 
                    endereco.* 
                    from tbl_loja as loja, tbl_endereco as endereco 
                    WHERE loja.cod_endereco = ".$codido_endereco." 
                    AND endereco.cod_endereco = ".$codido_endereco."";

            if(mysqli_query($conexao, $sql)){
                header('Location: cms_lojas.php');
            }else{
                echo("<script>alert('Não deu certo')</script>");
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

            function cadastrarEvisualizarloja(modo, codigo){
                $.ajax({
                    type: "GET",
                    url: "./modais/cms_modal_loja_cadastro.php",
                    data: {modo:modo, codigo:codigo},
                    success: function(dados){
                        $('#modal_larga').html(dados);
                    }

                });
            }

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
                    <div class="itens_card_cadastro visualizar" onclick="cadastrarEvisualizarloja('Cadastrar', 0)">
                        Cadastrar loja
                    </div>      
                </div>
                
                <!-- vai mostrar todos os sobres cadastrados -->
                <div id="segura_table_conteudo">
                    
                    <table id="table">
                        <tr id="thead">
                            <td>
                                Logradouro
                            </td>
                            <td>
                                Cidade
                            </td>
                            <td>
                                UF
                            </td>
                            <td>
                                Opções
                            </td>
                        </tr>
                        <?php
                            $sql = "SELECT endereco.*,
                                    estado.uf,
                                    cidade.cidade,
                                    loja.cod_loja,
                                    loja.status
                                    FROM	tbl_endereco AS endereco INNER JOIN tbl_loja as loja
                                    ON loja.cod_endereco = endereco.cod_endereco INNER JOIN tbl_cidade as cidade
                                    ON 	endereco.cod_cidade = cidade.cod_cidade INNER JOIN tbl_estado AS estado
                                    ON cidade.cod_estado = estado.cod_estado;";
                            $select = mysqli_query($conexao, $sql);       

                            while($rsLoja = mysqli_fetch_array($select)){
                        ?>
                        <tr class="tbody">
                            <td>
                               <?php echo($rsLoja['logradouro']);?>
                            </td>
                            <td>
                               <?php echo($rsLoja['cidade']);?>
                            </td>
                            <td>
                                <?php echo($rsLoja['uf']);?>
                            </td>
                            <td>
                            
                                <img  src="./img/icon_edit.png" onclick="cadastrarEvisualizarloja('Atualizar', <?php echo($rsLoja['cod_endereco']);?>)" class="icon img-size visualizar" alt="Edição">
                            
                                <a href="?modo=excluir&id=<?php echo($rsLoja['cod_endereco'])?>">
                                    <img src="./img/icon_delete.png" onclick="return confirm('Deseja reamente excluir o essa loja')" class="icon img-size" alt="Deletar">
                                </a>

                                <?php
                                    $img = $rsLoja['status'] == 0 ? 'icon_nao_ativo.png' : 'icon_ativo.png';
                                    $altEtitle = $rsLoja['status'] == 0 ? 'não ativo' : 'ativo';
                                ?>
                                <img src="./img/<?php echo($img)?>" class="icon img-size" onclick="ativarDesativar('loja', <?php echo($rsLoja['status'])?>, <?php echo($rsLoja['cod_loja'])?>)" alt="<?php echo($altEtitle)?>" title="<?php echo($altEtitle)?>">

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