<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Contato</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
            <link rel="stylesheet" type="text/css" media="screen" href="css/styleFonte.css" />
            <link rel="shortcut icon" href="img/iconeDeAbaACME.jpg" type="image/x-png">
        <script src="main.js"></script>
    </head>
    <body>
       <?php require_once('./header.php')?>
        
       <div id="caixa_segura_contato" class="center">
           <form name="frm_contato" >
                <div id="caixa_contato">
                    <div class="caixa_Input_text">
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/user.png" alt="Icone de usuario">
                            </div>
                        </figure>
                        <input class="inputContato" type="text" name="txt_nome" placeholder="Nome">
                    </div>
                    <div class="caixa_Input_text">
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/telefoneContato.png" alt="Icone de Telefone">
                            </div>
                        </figure>
                        <input class="inputContato" type="tel" name="txt_telefone" placeholder="Telefone">
                    </div>
                    <div class="caixa_Input_text">
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/celular.png" alt="Icone de Celular">
                            </div>
                        </figure>
                        <input class="inputContato" type="tel" name="txt_celular" placeholder="Celular">
                    </div>
                    <div class="caixa_Input_text">
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/email.png" alt="Icone de Email">
                            </div>
                        </figure>
                        <input class="inputContato" type="email" name="txt_email" placeholder="Email">
                    </div>
                    <div class="caixa_Input_text">
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/home.png" alt="Icone de Home">
                            </div>
                        </figure>
                        <input class="inputContato" type="url" name="txt_home" placeholder="URL De uma pagina">
                    </div>
                    <div class="caixa_Input_text">
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/facebook-logo.png" alt="Icone de facebook">
                            </div>
                        </figure>
                        <input class="inputContato" type="url" name="txt_facebook" placeholder="URL da pagina facebook">
                    </div>
                </div>
                <div id="caixa_contato_esquerda">
                    <div class="caixa_Input_radio">
                       <input  type="radio" name="rdo_sexo" value="M" id="masculino"><label for="masculino" class="radio_contato">Masculino</label>
                       <input type="radio" name="rdo_sexo" value="F" id="feminino"><label for="feminino" class="radio_contato" >Feminino</label>
                    </div>
                    <div class="caixa_Input_text">
                        <figure>
                            <div class="iconContatos">
                                <img class="img-size" src="./img/icon/grupo.png" alt="Icone de Profissão">
                            </div>
                        </figure>
                        <input class="inputContato" type="text" name="txt_facebook" placeholder="Profissão">
                    </div>
                    <div class="caixa_text_area">
                        <textarea class="textArea_cotato center" name="txtArea_sugestao"  placeholder="Sujestão ou Criticas"></textarea>
                    </div>
                    <div class="caixa_text_area">
                        <textarea class="textArea_cotato center" name="txtArea_sugestao"  placeholder="Observações do Pruduto"></textarea>
                    </div>
                    <input id="botao_contato" type="submit" value="Enviar→">
                </div>
           </form>
       </div>

        <?php require_once('./footer.php')?>
    </body>
</html>