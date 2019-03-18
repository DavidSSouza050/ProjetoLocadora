<?php
    require_once('./db/conexao.php');
    $conexao = conexaoMysql();

    if(isset($_POST['btn_limpar_contato'])){
        header('Location: contato.php');
    }

    if(isset($_POST['btn_enviar_contato'])){
       $nome = trim($_POST["txt_nome"]);
       $telefone = trim($_POST["txt_telefone"]);
       $nome = trim($_POST["txt_nome"]);
       $celular = trim($_POST["txt_celular"]);
       $email = trim($_POST["txt_email"]);
       $homePage = trim($_POST["txt_home"]);
       $facebook = trim($_POST["txt_facebook"]);
       $rdoSexo = trim($_POST["rdo_sexo"]);
       $profissao = trim($_POST["txt_profissao"]);
       $sugestaoCritica = trim($_POST["txtArea_sugestao"]);
       $obs = trim($_POST["txtArea_observacao"]);

       $sql = " INSERT INTO tbl_contato (nome, telefone, celular, email, homePage, facebook, sugestaoCritica, informacoesProduto, sexo, profissao)
                                    VALUES ('".$nome."', '".$telefone."', '".$celular."', '".$email."', '".$homePage."', '".$facebook."', '".$sugestaoCritica."',
                                    '".$obs."', '".$rdoSexo."', '".$profissao."');";

        // echo($sql);

        if(mysqli_query($conexao, $sql)){
            /*Redireciona para uma nova pagina*/
            echo("<script>alert('Obrigado por contatar-mos')</script>");

        }else{
            echo("
                <script>
                    alert('erro no Cadastro');
                </script>
            ");
        }
       

    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="UTF-8" name="format-detection" content="telephone=no">
        <title>Contato</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/styleFonte.css" />
        <link rel="shortcut icon" href="img/iconeDeAbaACME.png" type="image/x-png">
    </head>
    <body>
       <?php require_once('./header.php')?>
        
       <section id="caixa_segura_contato" class="center">
           <h2 hidden>Contato</h2>
           <form name="frm_contato" method="POST" action="contato.php" >
                <div id="caixa_contato">
                    <div class="caixa_Input_text">
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/user.png" alt="Icone de usuario">
                            </div>
                        </figure>
                        <input class="inputContato" type="text" id="txt_nome" name="txt_nome" required placeholder="Nome"  >
                    </div>
                    <div class="caixa_Input_text">
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/telefoneContato.png" alt="Icone de Telefone">
                            </div>
                        </figure>
                        <input class="inputContato" type="tel" name="txt_telefone" id="txt_telefone" placeholder="Tel.:(00) 0000-0000">
                    </div>
                    <div class="caixa_Input_text">
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/celular.png" alt="Icone de Celular">
                            </div>
                        </figure>
                        <input class="inputContato" type="tel" required name="txt_celular" id="txt_celular" placeholder="Cel.:(00) 90000-0000">
                    </div>
                    <div class="caixa_Input_text">
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/email.png" alt="Icone de Email">
                            </div>
                        </figure>
                        <input class="inputContato" type="email" name="txt_email" id="txt_email" required placeholder="Email">
                    </div>
                    <div class="caixa_Input_text">
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/home.png" alt="Icone de Home">
                            </div>
                        </figure>
                        <input class="inputContato" type="url" name="txt_home" id="txt_home" placeholder="URL De uma pagina">
                    </div>
                    <div class="caixa_Input_text">
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/facebook-logo.png" alt="Icone de facebook">
                            </div>
                        </figure>
                        <input class="inputContato" type="url" name="txt_facebook" id="txt_facebook" placeholder="URL da pagina facebook">
                    </div>
                </div>
                <div id="caixa_contato_esquerda">
                    <div class="caixa_Input_radio">
                       <input  type="radio" name="rdo_sexo" required  value="M" id="masculino"><label for="masculino" class="radio_contato">Masculino</label>
                       <input type="radio" name="rdo_sexo"  required value="F" id="feminino"><label for="feminino" class="radio_contato" >Feminino</label>
                    </div>
                    <div class="caixa_Input_text">
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/grupo.png" alt="Icone de Profissão">
                            </div>
                        </figure>
                        <input class="inputContato" type="text" name="txt_profissao" id="txt_profissao" required placeholder="Profissão">
                    </div>
                    <div class="caixa_text_area">
                        <textarea class="textArea_cotato center scrollTexto" name="txtArea_sugestao" id="txtArea_sugestao"  placeholder="Sujestão ou Criticas"></textarea>
                    </div>
                    <div class="caixa_text_area">
                        <textarea class="textArea_cotato center scrollTexto" name="txtArea_observacao" id="txtArea_observacao" placeholder="Observações do Pruduto"></textarea>
                    </div>
                    <div id="caixa_boato_contato" class="center">
                        <input type="submit"  class="botao_contato" name="btn_enviar_contato"  value="Enviar→">
                        <input type="submit"  class="botao_contato" name="btn_limpar_contato"  value="Limpar">
                    </div>                    
                </div>
           </form>
       </section>

        <?php require_once('./footer.php')?>
        <script src="./js/validacao.js"></script>
    </body>
</html>