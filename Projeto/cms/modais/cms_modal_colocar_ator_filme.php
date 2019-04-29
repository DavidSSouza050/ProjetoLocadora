<?php
    //pegando o banco 
    require_once('../../db/conexao.php');
    $conexao = conexaoMysql();

    $modo = $_GET['modo'];
    $id_ator = null;
    $id_filme = null;
    $cod_ator = 0;
    $cod_filme = 0;

    if($modo == 'Salvar'){
        $btn = $modo;
    }elseif($modo == 'Atualizar'){
        $btn = $modo;
        $id_ator = $_GET['codigo_ator'];
        //selecionando ator e filme para edição
        $_SESSION['cod_ator'] = $id_ator;
        $sql = "SELECT ator.cod_ator,
                ator.nome_ator,
                filme.titulo_filme,
                filme.cod_filme
                FROM tbl_ator AS ator INNER JOIN tbl_filme_ator as filme_ator
                ON ator.cod_ator = filme_ator.cod_ator INNER JOIN tbl_filme AS filme
                ON filme.cod_filme = filme_ator.cod_filme";
        $select = mysqli_query($conexao, $sql);

        if($rsFilme_ator = mysqli_fetch_array($select)){
            $cod_ator = $rsFilme_ator['cod_ator'];
            $nome_ator = $rsFilme_ator['nome_ator'];
            $cod_filme = $rsFilme_ator['cod_filme'];
            $titulo_filme = $rsFilme_ator['titulo_filme'];
        }

    }

?>

<!-- card que vai colocar ator em um filme -->
<div id="card_colocar_ator" class="center">
    <form name="frm_adicionar_ator" method="POST" action="cms_atores.php">
        <!-- div que vai segurar os atores e os filmes cadastrados -->
        <div class="segura_combo_colocar_ator_filme">
            <select name="sle_filme" class="txt_ator">

                <?php
                    if($modo == 'Atualizar'){
                ?>
                    <option value="<?php echo($cod_filme)?>"><?php echo($titulo_filme)?></option>        
                <?php
                }else{
                ?>
                    <option value="null">Selecione um filme</option>
                <?php
                }
                //trazendo os filmes do banco
                    $sql = "SELECT cod_filme, titulo_filme FROM tbl_filme WHERE cod_filme <> ".$cod_filme;
                    $select = mysqli_query($conexao, $sql);
                while ($rsTitulo_filme = mysqli_fetch_array($select)) {    
                ?>
                <option value="<?php echo($rsTitulo_filme['cod_filme']);?>"><?php echo($rsTitulo_filme['titulo_filme']);?></option>
                <?php 
                    }
                ?>
            </select>
        </div>
        <div class="segura_combo_colocar_ator_filme">
            <select name="sle_ator" class="txt_ator">

                <?php
                    if($modo == 'Atualizar'){
                ?>
                    <option value="<?php echo($cod_ator)?>"><?php echo($nome_ator)?></option>        
                <?php
                }else{
                ?>
                    <option value=null>Selecione um(a) ator(a)</option>
                <?php
                    }
                    if($modo != 'Atualizar'){
                //trzendo os atores do banco
                    $sqlAtor = "SELECT cod_ator,nome_ator FROM tbl_ator WHERE cod_ator <> ".$cod_ator;
                    $selectAtor = mysqli_query($conexao, $sqlAtor);
                while($rsNomeAtor = mysqli_fetch_array($selectAtor)){
                ?>
                    <option value="<?php echo($rsNomeAtor['cod_ator']);?>"><?php echo($rsNomeAtor['nome_ator']);?></option>
                <?php
                    }
                }
                ?>
        
            </select>
        </div>

        <div class="segura_combo_colocar_ator_filme">
            <input type="submit" value="<?php echo($btn)?>" name="<?php echo($btn)?>_adicionar" class="botao_adicionar_filme">
        </div>
    </form>

</div>