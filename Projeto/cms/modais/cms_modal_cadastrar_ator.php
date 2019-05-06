<?php
    //Ativa o recurso de variavel de sessão
    require_once('../usuario_verificado.php');
    /*pagangando o banco*/
    require_once('../../db/conexao.php');
    $conexao = conexaoMysql();
    //variaveis
    $modo = $_GET['modo'];
    $codigo = $_GET['codigo'];
    $nome = null;
    $nascionalidade = null;
    $atividade = null;
    $data_nasci_certo = null;
    $bio = null;
    $imagem_ator = null;

    if($modo == 'Cadastrar'){ // ← passando a modal para  cadastrar
        $btn = $modo;

    }elseif($modo == 'Atualizar'){// ← passando a modal para  Atualizar
        $btn = $modo;

        $_SESSION['cod_ator'] = $codigo;
        $sql = "SELECT * FROM tbl_ator WHERE cod_ator =".$codigo;
        $select = mysqli_query($conexao, $sql);

        if($rsAtor = mysqli_fetch_array($select)){
            $nome = $rsAtor['nome_ator'];        
            $nascionalidade = $rsAtor['nascionalidade'];
            $atividade = $rsAtor['atividade'];
            //usando explode para formatar a data
            $data_nasci = explode("-", $rsAtor['data_nacimento']);
            $data_nasci_certo = $data_nasci[2]."/".$data_nasci[1]."/".$data_nasci[0];
            //**************** 
            $bio = $rsAtor['biografia'];   
            $imagem_ator = $rsAtor['imagem_ator'];    
            
            $_SESSION['foto_antiga_ator'] = $imagem_ator;
        }


    }

?>


<!-- card para cadastro de ator  -->
<div id="card_cadastrar_ator" class="center">
    <form name="frm_ator" method="post" action="cms_atores.php" enctype="multipart/form-data">
        <!-- caixa com o nome do ator e sua nacionalidade -->
        <div class="segura_caixa_ator">
            <div class="caixa_ator">
                <h5>Nome:</h5>
                <input type="text" maxLength='40'  value="<?php echo($nome)?>" class="txt_ator" name="nome_ator" id="nome-ator">
            </div>
            <div class="caixa_ator">
                <h5>Nacionalidade:</h5>
                <input type="text" class="txt_ator"  maxLength='40' value="<?php echo($nascionalidade)?>" name="nascionalidade_ator" id="nascionalidade-ator">
            </div>
        </div>
        <!-- caixa com Atividades e data de nascimento do ator -->
        <div class="segura_caixa_ator">
            <div class="caixa_ator">
                <h5>Atividades:</h5>
                <input type="text" class="txt_ator" maxLength='90' value="<?php echo($atividade)?>" name="ativadade_ator" id="atividade-ator">
            </div>
            <div class="caixa_ator">
                <h5>Data de Nascimento:</h5>
                <input type="text" class="txt_ator" maxLength='10' placeholder="EX.:00/00/0000" value="<?php echo($data_nasci_certo)?>" name="data_naci_ator" id="data_naci_ator">
            </div>
        </div>
        <!-- caixa com a biografia e a imagem do ator -->
        <div id="segura_textArea_ator">
            <div class="caixa_ator">    
                <h5>Biografia:</h5>
                <textArea id="textArea_ator" maxLength='6000'  class="scrollTexto"  name="biografia_ator" id="biografia-ator" ><?php echo($bio)?></textArea>
            </div>
            <div class="caixa_ator">    
                <h5>Imagem:</h5>
                <input type="file" name="fle_ator" id="fle-ator" >

            </div>
        </div>
        

        <div class="segura_caixa_ator">

            <div id="segura_botao_ator">
                <input type="submit" value="<?php echo($btn);?>" name="<?php echo($btn.'_ator'); ?>" id="cadastrar_ator" class="botao_cadastro_usuario"> 
            </div>


            <div id="segura_table_ator" class="scrollTexto">
                
                <table id="table_modal_nivel">
                <?php
                    //SELECT para verificar se exister filme adicionado neste ator
                    $sql = "SELECT filme.titulo_filme,
                                    filme.cod_filme,
                                    ator.cod_ator
                            FROM tbl_filme AS filme INNER JOIN tbl_filme_ator as filme_ator
                            ON filme.cod_filme = filme_ator.cod_filme JOIN tbl_ator AS ator
                            ON 	ator.cod_ator = filme_ator.cod_ator WHERE ator.cod_ator =".$codigo;
                    $select = mysqli_query($conexao, $sql);

                    while($rsFilmeAtor = mysqli_fetch_array($select)){

                        if($rsFilmeAtor['titulo_filme'] != ""){
                ?>


                    <tr id="thead_nivel">
                        <td>
                            Filme Participado
                        </td>
                        <td>
                            opções
                        </td>
                    </tr>
            

                    <tr class="tbody_nivel">
                        <td>
                            <?php echo($rsFilmeAtor['titulo_filme'])?>
                        </td>
                        <td>
                            
                            <a href="?modo=excluirRelacao&id=<?php echo($rsFilmeAtor['cod_ator']);?>&id_filme=<?php  echo($rsFilmeAtor['cod_filme']);?>">
                                <img src="./img/icon_delete.png" class="img-size icon" onclick="return confirm('Deseja reamente excluir essa relação?')" alt="Excluir Relação" title="Excluir Relação">
                            </a>

                            <img src="./img/icon_edit.png"  onclick="colocarAtor_filme('Atualizar', <?php echo($rsFilmeAtor['cod_ator'])?>)" class="img-size icon" alt="Editar relação" title="Editar Relação"> 

                        </td>
                    </tr>

                    <?php
                        }
                    }
                    ?>
                </table>
                
            </div>

            
            
        </div>
        

    </form>
    
    
          
 
    <?php
        if($imagem_ator != null){
    ?>
        <div id="segura_imagem_ator">
            <img src="./img/imagem_ator/<?php echo($imagem_ator)?>" class="img-size" alt="<?php echo($imagem_ator)?>">
        </div>
    <?php
        }
    ?>
</div>
<script src="./js/validarData.js"></script>