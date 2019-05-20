<?php
    // linkando a conexão
    require_once('./db/conexao.php');
    $conexao = conexaoMysql();

    //Variaveis
    $nome = null;
    $telefone = null;
    $nome = null;
    $celular = null;
    $email = null;
    $homePage =null;
    $facebook = null;
    $rdoSexo = null;
    $profissao = null;
    $cmb_assunto = null;
    $mensagem = null;

    // limpar as caixas
    if(isset($_POST['btn_limpar_contato'])){
        header('Location: contato.php');
    }

    // ao criar o name vai ser execultado esse codigo
    if(isset($_POST['btn_enviar_contato'])){
        // todos as variaveis para o cadastro
       $telefone = trim($_POST["txt_telefone"]);
       $nome = trim($_POST["txt_nome"]);
       $celular = trim($_POST["txt_celular"]);
       $email = trim($_POST["txt_email"]);
       $homePage = trim($_POST["txt_home"]);
       $facebook = trim($_POST["txt_facebook"]);
       $rdoSexo = trim($_POST["rdo_sexo"]);
       $profissao = trim($_POST["txt_profissao"]);
       $cmb_assunto = trim($_POST["cmb_assunto"]);
       $mensagem = trim($_POST["txtArea_mensagem"]);

        //  depois execulta o codigo sql   
        $sql = " INSERT INTO tbl_fale_conosco (nome, telefone, celular, email, homePage, facebook, assunto, mensagem, sexo, profissao)
                    VALUES ('".addslashes($nome)."', '".addslashes($telefone)."', '".addslashes($celular)."', 
                    '".addslashes($email)."', '".addslashes($homePage)."', '".addslashes($facebook)."', '".addslashes($cmb_assunto)."',
                    '".addslashes($mensagem)."', '".addslashes($rdoSexo)."', '".addslashes($profissao)."');";

        // echo($sql);

        // execulta o sql com a conexão e ver se ta tudo certo para colocar no banco
        if(mysqli_query($conexao, $sql)){
        /*Redireciona para uma nova pagina*/
            header("Location: contato.php");

        }else{
            // se não der certo vez para essa mensagem
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
        <title>Contato</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/styleFonte.css" />
        <link rel="shortcut icon" href="img/iconeDeAbaACME.png" type="image/x-png">
    </head>
    <body>
        <!-- Haeder que está em um php -->
       <?php require_once('./header.php')?>
        
       <div id="caixa_segura_contato" class="center">
           <form name="frm_contato" method="POST" action="contato.php" >
               <!-- caixas apara digitação -->
                <div id="caixa_contato">
                    <div class="caixa_Input_text">
                        <!-- div pra cadastrar o nome -->
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/user.png" alt="Icone de usuario">
                            </div>
                        </figure>
                        <input class="inputContato" type="text" id="txt_nome" name="txt_nome" required placeholder="Nome*" maxLength="100" >
                    </div>
                    <div class="caixa_Input_text">
                        <!-- div para cadastrar o telefone se for preciso -->
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/telefoneContato.png" alt="Icone de Telefone">
                            </div>
                        </figure>
                        <input class="inputContato" type="tel" name="txt_telefone" id="txt_telefone" placeholder="Tel.:00 00000000"  onkeypress="return PermitirNumero(event);">
                    </div>
                    <div class="caixa_Input_text">
                        <!-- div para cadastrar o celular -->
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/celular.png" alt="Icone de Celular">
                            </div>
                        </figure>
                        <input class="inputContato" type="tel" required name="txt_celular" id="txt_celular" placeholder="Cel.:00 900000000*" maxLength="15"   onkeypress="return PermitirNumero(event);">
                    </div>
                    <div class="caixa_Input_text">
                        <!-- div para cadastrar o email -->
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/email.png" alt="Icone de Email">
                            </div>
                        </figure>
                        <input class="inputContato" type="email" name="txt_email" id="txt_email" required placeholder="Email*">
                    </div>
                    <div class="caixa_Input_text">
                        <!-- div para cadastrar a home de uma pagina web -->
                        <figure>                     
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/home.png" alt="Icone de Home">
                            </div>
                        </figure>
                        <input class="inputContato" type="url" maxLength="140" name="txt_home" id="txt_home" placeholder="URL De uma pagina">
                    </div>
                    <div class="caixa_Input_text">
                        <!-- div para cadastrar o facebook -->
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/facebook-logo.png" alt="Icone de facebook">
                            </div>
                        </figure>
                        <input class="inputContato" type="url" maxLength="140" name="txt_facebook" id="txt_facebook" placeholder="URL da pagina facebook">
                    </div>
                </div>

                <!-- segunda div de cadastro -->
                <div id="caixa_contato_esquerda">
                    <div class="caixa_Input_radio">
                        <!-- radios para saber o sexo -->
                       <input  type="radio" name="rdo_sexo" required  value="M" id="masculino"><label for="masculino" class="radio_contato">Masculino</label>
                       <input type="radio" name="rdo_sexo"  required value="F" id="feminino"><label for="feminino" class="radio_contato" >Feminino</label>
                    </div>
                    <div class="caixa_Input_text">
                        <!-- div de cadastro de profissão -->
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/grupo.png" alt="Icone de Profissão">
                            </div>
                        </figure>
                        <input class="inputContato" type="text" maxLength="90" name="txt_profissao" id="txt_profissao" required placeholder="Profissão*">
                    </div>
                    <div class="caixa_cmb">
                        <!-- select para saber o tipo da mensagem -->
                        <select name="cmb_assunto" id="selectAssunto" required>
                            <option value="">Assunto*</option>
                            <option value="Sugestao ou Critica">Sugestao ou Critica</option>
                            <option value="Informação do Produto">Informação do Produto</option>
                        </select>
                    </div>
                    <div class="caixa_text_area">
                        <!-- textarea para a mensagem -->
                        <textarea class="textArea_cotato center scrollTexto" name="txtArea_mensagem" required id="txtArea_observacao" placeholder="Mensagem"></textarea>
                    </div>
                    <div id="caixa_boato_contato" class="center">
                        <!-- botaoes de cadastro -->
                        <input type="submit"  class="botao_contato" id="btn_enviar_contato" name="btn_enviar_contato"  value="Enviar→">
                        <input type="submit"  class="botao_contato" name="btn_limpar_contato"  value="Limpar">
                    </div>                    
                </div>
           </form>
        </div>




        <!-- mobile -->

        <div id="caixa_segura_contato_mobile" class="center">
           <form name="frm_contato" method="POST" action="contato.php" >
               <!-- caixas apara digitação -->
                <div id="caixa_contato_mobile" class="center">
                    <div class="caixa_Input_text_mobile">
                        <!-- div pra cadastrar o nome -->
                        <figure>
                            <div class="iconContatos_mobile">
                                <img class="img-size" src="./img/icon/user.png" alt="Icone de usuario">
                            </div>
                        </figure>
                        <input class="inputContato_mobile" type="text" id="txt_nome_mobile" name="txt_nome" required placeholder="Nome*" maxLength="100" >
                    </div>
                    <div class="caixa_Input_text_mobile">
                        <!-- div para cadastrar o telefone se for preciso -->
                        <figure>
                            <div class="iconContatos_mobile">
                                <img class="img-size" src="./img/icon/telefoneContato.png" alt="Icone de Telefone">
                            </div>
                        </figure>
                        <input class="inputContato_mobile" maxLength="14"  type="tel" name="txt_telefone" id="txt_telefone_mobile" placeholder="Tel.:00 00000000"  onkeypress="return PermitirNumero(event);">
                    </div>
                    <div class="caixa_Input_text_mobile">
                        <!-- div para cadastrar o celular -->
                        <figure>
                            <div class="iconContatos_mobile">
                                <img class="img-size"  src="./img/icon/celular.png" alt="Icone de Celular">
                            </div>
                        </figure>
                        <input class="inputContato_mobile" type="tel" required name="txt_celular" id="txt_celular_mobile" placeholder="Cel.:00 900000000*" maxLength="15"   onkeypress="return PermitirNumero(event);">
                    </div>
                    <div class="caixa_Input_text_mobile">
                        <!-- div para cadastrar o email -->
                        <figure>
                            <div class="iconContatos_mobile">
                                <img class="img-size" src="./img/icon/email.png" alt="Icone de Email">
                            </div>
                        </figure>
                        <input class="inputContato_mobile" type="email" name="txt_email" id="txt_email_mobile" required placeholder="Email*">
                    </div>
                    <div class="caixa_Input_text_mobile">
                        <!-- div para cadastrar a home de uma pagina web -->
                        <figure>                     
                            <div class="iconContatos_mobile">
                                <img class="img-size" src="./img/icon/home.png" alt="Icone de Home">
                            </div>
                        </figure>
                        <input class="inputContato_mobile" type="url" maxLength="140" name="txt_home" id="txt_home_mobile" placeholder="URL De uma pagina">
                    </div>
                    <div class="caixa_Input_text_mobile">
                        <!-- div para cadastrar o facebook -->
                        <figure>
                            <div class="iconContatos_mobile">
                                <img class="img-size" src="./img/icon/facebook-logo.png" alt="Icone de facebook">
                            </div>
                        </figure>
                        <input class="inputContato_mobile" type="url" maxLength="140" name="txt_facebook" id="txt_facebook_mobile" placeholder="URL da pagina facebook">
                    </div>
                </div>

                <!-- segunda div de cadastro -->
                <div id="caixa_contato_esquerda_mobile" class="center">
                    <div class="caixa_Input_radio_mobile center">
                        <!-- radios para saber o sexo -->
                       <input  type="radio" name="rdo_sexo" required  value="M" id="masculino_mobile" class="radio"><label for="masculino_mobile" class="radio_contato_mobile">Masculino</label>
                       <input type="radio" name="rdo_sexo"  required value="F" id="feminino_mobile"  class="radio"><label for="feminino_mobile" class="radio_contato_mobile" >Feminino</label>
                    </div>
                    <div class="caixa_Input_text_mobile center">
                        <!-- div de cadastro de profissão -->
                        <figure>
                            <div class="iconContatos_mobile">
                                <img class="img-size" src="./img/icon/grupo.png" alt="Icone de Profissão">
                            </div>
                        </figure>
                        <input class="inputContato_mobile" type="text" maxLength="90" name="txt_profissao" id="txt_profissao_mobile" required placeholder="Profissão*">
                    </div>
                    <div class="caixa_cmb_mobile">
                        <!-- select para saber o tipo da mensagem -->
                        <select name="cmb_assunto" id="selectAssunto_mobile" required>
                            <option value="">Assunto*</option>
                            <option value="Sugestao ou Critica">Sugestao ou Critica</option>
                            <option value="Informação do Produto">Informação do Produto</option>
                        </select>
                    </div>
                    <div class="caixa_text_area_mobile center">
                        <!-- textarea para a mensagem -->
                        <textarea class="textArea_cotato_mobile center scrollTexto" name="txtArea_mensagem" required id="txtArea_observacao_mobile" placeholder="Mensagem"></textarea>
                    </div>
                    <div id="caixa_boato_contato_mobile" class="center">
                        <!-- botaoes de cadastro -->
                        <input type="submit"  class="botao_contato_mobile" id="btn_enviar_contato_mobile" name="btn_enviar_contato"  value="Enviar→">
                        <input type="submit"  class="botao_contato_mobile" name="btn_limpar_contato"  value="Limpar">
                    </div>                    
                </div>
           </form>
        </div>






        <!-- footer que esta em outro php -->
        <?php require_once('./footer.php')?>

        <script src="./js/validacao.js"></script>
    </body>
</html>