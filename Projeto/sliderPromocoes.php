    <!-- #region Jssor Slider Begin -->
    <!-- Generator: Jssor Slider Maker -->
    <!-- Source: https://www.jssor.com -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/styleSliderPromocoes.css" />
    <script src="./js/sliderPromocoes.js"></script>

    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:960px;height:480px;overflow:hidden;visibility:hidden;background-color:#24262e;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="./img/sliderPromocoes/spin.svg" alt="imagem de carregamento" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:240px;width:720px;height:480px;overflow:hidden;">
            
            <?php
                //declarando as variaveis 
                $imagens = (array) null; // array de imagens da pasta
                $numDeImagens = (int) null; // varivael que vai servir de posicionamento das imagens

                $caminho = "./img/sliderPromocoes";//caminho da pasta onde está as imagens que sarão usadas
                $diretorio = dir($caminho);//quandando a execulção da dir 

                while($arquivo = $diretorio -> read()){ // acada vez que o while, a variavel arquivo resebe uma imagen        

                    array_push($imagens, $arquivo);// populando a arrey com as imagnes obtidas
                }


                $carregarImagem = array_search('spin.svg', $imagens);//acha o indice da imagem de carregar o slider
                unset($imagens[$carregarImagem]); // exclui da array o indice da imagem de carregamento
                $imagens = array_slice($imagens, 2); // Faz que a array comece pela a posição 2 tirando dois itens (./ e ../)
                $numDeImagens = count($imagens); // conta o total de de numeros da array, que corresponde as imagens

                $diretorio -> close(); // fecha a pasta / diretorio 


                for($i = 0; $i < $numDeImagens; $i++){ // Adiciona as imagens no slider
            ?>
                <div>
                    <img data-u="image" src="img/sliderPromocoes/<?php echo($imagens[$i]) ?>" alt="Imagem <?php echo($imagens[$i]) //associa a imagem com o seu indice e coloca na tag img?>" />
                    <img data-u="thumb" src="img/sliderPromocoes/<?php echo($imagens[$i]) ?>" alt="Imagem thumb <?php echo($imagens[$i]) //associa a imagem com o seu indice e coloca na tag img?>"/>
                </div>
            <?php
            }          
            ?>
        </div>
        <!-- Thumbnail Navigator -->
        <div data-u="thumbnavigator" class="jssort101" style="position:absolute;left:0px;top:0px;width:240px;height:480px;background-color:#000;" data-autocenter="2" data-scale-left="0.75">
            <div data-u="slides">
                <div data-u="prototype" class="p" style="width:99px;height:66px;">
                    <div data-u="thumbnailtemplate" class="t"></div>
                    <svg viewbox="0 0 16000 16000" class="cv">
                        <circle class="a" cx="8000" cy="8000" r="3238.1"></circle>
                        <line class="a" x1="6190.5" y1="8000" x2="9809.5" y2="8000"></line>
                        <line class="a" x1="8000" y1="9809.5" x2="8000" y2="6190.5"></line>
                    </svg>
                </div>
            </div>
        </div>
        <!-- Arrow Navigator -->
        <div data-u="arrowleft" class="jssora093" style="width:50px;height:50px;top:0px;left:270px;" data-autocenter="2">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                <polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline>
                <line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora093" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                <polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline>
                <line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line>
            </svg>
        </div>
    </div>
    <!-- #endregion Jssor Slider End -->
