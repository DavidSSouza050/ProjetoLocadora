<?php
    //Ativa o recurso de variavel de sessão
    require_once('./usuario_verificado.php');
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
        <script src="./js/jquery-1.11.3.min.js"></script>
        <script src="./js/jscharting.js"></script>
        <script>
			$(document).ready(function(){
				const chart = new JSC.Chart("chartDiv", {
					xAxis_scale_type: "Qualitative",
					yAxis_label_text: "Filmes Mais Clickados",
					defaultPoint_label_text: "%yValue",
					defaultSeries_palette: "default",
					annotations: [
						{
							position: "top",
							label_text: "RELATÓRIO DE FILMES MAIS VISITADOS"
						}
					],
					height: 600,
					defaultSeriesType: 'column',
					title: { 
						label: { 
							text: "Relatório de Filmes"
						}
					},
					series: [
						{
							name: 'Filmes',
							defaultPoint: {opacity: 1},
							type: "column",							
							tooltip:{
								
							},
							points: [
								<?php
									require_once('../db/conexao.php');
									$conexao = conexaoMysql();
								
									$sql = "SELECT * FROM tbl_filme WHERE status_produto = 1
									ORDER BY clicks DESC LIMIT 5 ";
									$select = mysqli_query($conexao, $sql);
									while($filme = mysqli_fetch_array($select)){
								?>
								{name:'<?php echo($filme["titulo_filme"]) ?>', y:<?php echo($filme["clicks"]) ?>, tooltip: "<b>%name</b><br> <b>Acesso:</b> %yValue <br> <b>Percentual:</b> %percentOfSeries%"},
								<?php 
									}
								?>
							]
						}
					]
				});
				$("#brandingLogo").css("display", "none");
			});
		</script>
    </head>
    <body>
        

        <!-- div que está segurando tudo -->
        <div id="conteudo_cms" class="center">
            <!-- header que está com o logo e o titulo -->
            <?php require_once('./cms_header.php');?>

            <!-- caixa com o menu e o nome do usuario -->
           <?php require_once('./cms_menu_paginas_usuario.php');?>
        

            <!-- conteudo do menu do cms -->
            <div id="menu_de_adm">
                <!-- <img src="./img/CMS_Color.png" class="img-size" alt="Imagem_cms">     -->
                <div id="chartDiv" ></div>    
            </div>


            <!-- footer do cms -->
           <?php require_once('./cms_footer.php');?>
        </div>


    </body>
</html>