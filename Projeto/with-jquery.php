
    <!-- #region Jssor Slider Begin -->
    <!-- Generator: Jssor Slider Maker -->
    <!-- Source: https://www.jssor.com -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/styleSlider.css" />
    <script src="./js/sliderIndex.js"></script>
    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:500px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/slider/spin.svg" alt="Imagem de Loading"/>
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:400px;overflow:hidden;">
            <?php
                //declarando as variaveis 
                $imagens = (array) null; // array de imagens da pasta
                $numDeImagens = (int) null; // varivael que vai servir de posicionamento das imagens

                $caminho = "./img/slider";//caminho da pasta onde está as imagens que sarão usadas
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
                    <img data-u="image" src="img/slider/<?php echo($imagens[$i]) ?>" alt="Imagem <?php echo($imagens[$i])?>" />
                    <img data-u="thumb" src="img/slider/<?php echo($imagens[$i]) ?>" alt="Imagem thumb <?php echo($imagens[$i])?>"/>
                </div>
            <?php
                }          
                
            ?>
        </div>
        <!-- Thumbnail Navigator -->
        <div data-u="thumbnavigator" class="jssort101" style="position:absolute;left:0px;bottom:0px;width:980px;height:100px;background-color:#000;" data-autocenter="1" data-scale-bottom="0.75">
            <div data-u="slides">
                <div data-u="prototype" class="p" style="width:190px;height:90px;">
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
        <div data-u="arrowleft" class="jssora106" style="width:60px;height:60px;top:180px;left:20px;" data-scale="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="c" cx="8000" cy="8000" r="6260.9"></circle>
                <polyline class="a" points="7930.4,5495.7 5426.1,8000 7930.4,10504.3 "></polyline>
                <line class="a" x1="10573.9" y1="8000" x2="5426.1" y2="8000"></line>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora106" style="width:60px;height:60px;top:180px;right:20px;" data-scale="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="c" cx="8000" cy="8000" r="6260.9"></circle>
                <polyline class="a" points="8069.6,5495.7 10573.9,8000 8069.6,10504.3 "></polyline>
                <line class="a" x1="5426.1" y1="8000" x2="10573.9" y2="8000"></line>
            </svg>
        </div>
    </div>
    <!-- #endregion Jssor Slider End -->

