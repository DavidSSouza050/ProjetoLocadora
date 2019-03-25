<?php
    $coordenada = '0,0';

    if(isset($_GET['coordenada'])){
        $coordenada = $_GET['coordenada'];

    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="UTF-8" name="format-detection" content="telephone=no"> -->
        <title>Nossas Lojas</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/styleFonte.css" />
        <link rel="shortcut icon" href="img/iconeDeAbaACME.png" type="image/x-png">
    </head>
    <body>
        <?php require_once('./header.php')?>

        <div id="caixa_lojas" class="center">            
            <div id="caixa_iFrame_maps">
                <!-- coordenadas frame para pqgar as coodenadas -->
                <div id="iFrame_maps">
                    <iframe src="https://maps.google.com/maps?width=700&amp;height=440&amp;hl=en&amp;q=<?php echo($coordenada)?>&amp;ie=UTF8&amp;t=&amp;z=10&amp;iwloc=B&amp;output=embed" id="maps"  allowfullscreen></iframe>
                </div>
            </div>
            <div id="caixa_coodernadas" class="scrollTexto">
                <!-- a com cada codernada das lojas cadastradas -->
                <a href='?coordenada=38.838438,-9.168539'>
                    <div class='coodernadas center'>
                        R. Anselmo Braamcamp Freire 4A, 2670-355 Loures, Portugal
                    </div>
                </a>    
                
                <a href='?coordenada=43.701583,-79.396989'>
                    <div class='coodernadas center'>
                        North Toronto, Toronto, ON M4S 2A2, Canadá
                    </div>
                </a>  

                <a href='?coordenada=01050-070'>
                    <div class='coodernadas center'>
                        R. Avanhandava, 81 - Consolação, São Paulo - SP
                    </div>
                </a>  

                <a href='?coordenada=58.572140,25.063491'>
                    <div class='coodernadas center'>
                        Vihtra, 87603 Pärnumaa, Estônia
                    </div>
                </a>  
                <!-- fim das coodernadas -->
                       
            </div>
        </div>




        <?php require_once('./footer.php')?>
    </body>

</html>