<?php
    // entrando No banco
    require_once('./db/conexao.php');
    $conexao = conexaoMysql();
 
    $logradouro = null;
    $bairro = null;
    $cidade = null;
    $estado = null;
    $numero = null;
    $endereco_pronto = null;

    if(isset($_GET['cod_loja'])){
        $cod_loja = $_GET['cod_loja'];
        $sql="SELECT endereco.logradouro,
                endereco.bairro,
                cidade.cidade,
                estado.uf,
                loja.cod_loja,
                loja.status,
                endereco.numero
                FROM tbl_loja as loja INNER JOIN tbl_endereco AS endereco 
                ON loja.cod_endereco = endereco.cod_endereco INNER JOIN tbl_cidade as cidade
                ON endereco.cod_cidade = cidade.cod_cidade INNER JOIN tbl_estado as estado
                ON cidade.cod_estado = estado.cod_estado WHERE cod_loja =".$cod_loja;
                
        $select = mysqli_query($conexao, $sql);
        if($rsEnderco = mysqli_fetch_array($select)){
            $logradouro = $rsEnderco['logradouro'];
            $bairro = $rsEnderco['bairro'];
            $cidade = $rsEnderco['cidade'];
            $estado = $rsEnderco['uf'];
            $numero = $rsEnderco['numero'];
            
            $cidade = strtolower($cidade);
            $cidade = ucwords($cidade);

            $endereco = $numero.$logradouro.$bairro.$cidade.$estado;    
            $endereco = explode(" ", $endereco);
            for($i = 0; $i < count($endereco); $i++){
                $endereco_pronto .= $endereco[$i];
            }
           //echo($endereco);
        }

        

    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
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
                <div id="iFrame_maps" class="center">
                    <iframe src="https://maps.google.com/maps?width=700&amp;height=440&amp;hl=en&amp;q=<?php echo($endereco_pronto);?>&amp;ie=UTF8&amp;t=&amp;z=10&amp;iwloc=B&amp;output=embed" id="maps"  allowfullscreen></iframe>
                </div>
            </div>
            <div id="caixa_coodernadas" class="scrollTexto">
                <!-- a com cada codernada das lojas cadastradas -->
                
                <?php
                    $sql = "SELECT endereco.logradouro,
                                    endereco.bairro,
                                    cidade.cidade,
                                    estado.estado,
                                    loja.cod_loja,
                                    loja.status,
                                    endereco.numero
                                    FROM tbl_loja as loja INNER JOIN tbl_endereco AS endereco 
                                    ON loja.cod_endereco = endereco.cod_endereco INNER JOIN tbl_cidade as cidade
                                    ON endereco.cod_cidade = cidade.cod_cidade INNER JOIN tbl_estado as estado
                                    ON cidade.cod_estado = estado.cod_estado";

                    $select = mysqli_query($conexao, $sql);
                while($rsLoja = mysqli_fetch_array($select)){
                    if($rsLoja['status'] == 1){
                        $cidade = strtolower($rsLoja['cidade']);
                        $cidade = ucwords($cidade);            
                ?>
                <a href='?cod_loja=<?php echo($rsLoja['cod_loja'])?>'>
                    <div class='coodernadas center'>
                       <?php echo($rsLoja['logradouro'])?>, <?php echo($rsLoja['bairro'])?>, <?php echo($cidade)?>, <?php echo($rsLoja['estado'])?>, Nº <?php echo($rsLoja['numero'])?>
                    </div>
                </a>    
                <?php
                    }
                }
                ?>
               
                <!-- fim das coodernadas -->
                       
            </div>
        </div>


        <!-- mobile -->
        <div id="caixa_lojas_mobile">            
             <div id="caixa_iFrame_maps_mobile">
            <!-- coordenadas frame para pqgar as coodenadas  -->
                <div id="iFrame_maps_mobile" class="center">
                    <iframe src="https://maps.google.com/maps?width=700&amp;height=440&amp;hl=en&amp;q=<?php echo($endereco_pronto);?>&amp;ie=UTF8&amp;t=&amp;z=10&amp;iwloc=B&amp;output=embed" id="maps_mobile"  allowfullscreen></iframe>
                </div>
            </div>
            <div id="caixa_coodernadas_mobile" class="scrollTexto">
                <!-- a com cada codernada das lojas cadastradas  -->
                
                <?php
                    $sql = "SELECT endereco.logradouro,
                                    endereco.bairro,
                                    cidade.cidade,
                                    estado.estado,
                                    loja.cod_loja,
                                    loja.status,
                                    endereco.numero
                                    FROM tbl_loja as loja INNER JOIN tbl_endereco AS endereco 
                                    ON loja.cod_endereco = endereco.cod_endereco INNER JOIN tbl_cidade as cidade
                                    ON endereco.cod_cidade = cidade.cod_cidade INNER JOIN tbl_estado as estado
                                    ON cidade.cod_estado = estado.cod_estado";

                    $select = mysqli_query($conexao, $sql);
                while($rsLoja = mysqli_fetch_array($select)){
                    if($rsLoja['status'] == 1){
                        $cidade = strtolower($rsLoja['cidade']);
                        $cidade = ucwords($cidade);            
                ?>
                <a href='?cod_loja=<?php echo($rsLoja['cod_loja'])?>'>
                    <div class='coodernadas_mobile center'>
                       <?php echo($rsLoja['logradouro'])?>, <?php echo($rsLoja['bairro'])?>, <?php echo($cidade)?>, <?php echo($rsLoja['estado'])?>, Nº <?php echo($rsLoja['numero'])?>
                    </div>
                </a>    
                <?php
                    }
                }
                ?>
               
               
                       
            </div>
        </div>




        <?php require_once('./footer.php')?>
    </body>

</html>