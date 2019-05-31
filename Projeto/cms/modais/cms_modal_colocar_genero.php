<?php
    //startando a varivael de sessa
    require_once('../usuario_verificado.php');
    //pegando o banco 
    require_once('../../db/conexao.php');
    $conexao = conexaoMysql();

    $modo = $_GET['modo'];
    $id_genero = null;
    $id_filme = null;
    $cod_genero = 0;
    $cod_filme = 0;

    if($modo == 'Salvar'){ // passando modal para cadastra
        $btn = $modo;
    }elseif($modo == 'Atualizar'){// passando modal para atualizar primeiro ele busca depois na pagina que a modal foi chamada ele atualiza
        $btn = $modo;
        $id_filme = $_GET['codigo_filme'];
        $id_genero = $_GET['codigo_genero'];

        //fazendo select para trazer o genero eo filme
        $sql = "SELECT filme.titulo_filme,
                filme.cod_filme,
                genero.cod_genero,
                genero.genero
                FROM tbl_filme as filme INNER JOIN tbl_filme_genero_categoria as filme_genero_categoria
                ON filme.cod_filme = filme_genero_categoria.cod_filme INNER JOIN tbl_genero as genero
                ON filme_genero_categoria.cod_genero = genero.cod_genero WHERE filme.cod_filme =".$id_filme." AND genero.cod_genero =".$id_genero;

        $select = mysqli_query($conexao, $sql);
        if($rsFilme_genero = mysqli_fetch_array($select)){//← pegando o genero e o filme
            $cod_genero = $rsFilme_genero['cod_genero'];
            $nome_genero = $rsFilme_genero['genero'];
            $cod_filme = $rsFilme_genero['cod_filme'];          
            $titulo_filme = $rsFilme_genero['titulo_filme'];

            //selecionando ator e filme para edição
            $_SESSION['id_genero'] = $cod_genero;
            $_SESSION['id_filme'] = $cod_filme;
        }

    }

?>

<!-- card que vai colocar ator em um filme -->
<div id="card_colocar_ator" class="center">
    <form name="frm_adicionar_genero" method="POST" action="cms_produtos.php">
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
                 //verificando se não é para atualizar para atualizar se for para atulizar ele coloca o id que vem da modal cms_modal_cadastrar_genero.php
                 if($modo != 'Atualizar'){
                //trazendo os filmes do banco
                    $sql = "SELECT cod_filme, titulo_filme FROM tbl_filme WHERE cod_filme <> ".$cod_filme;
                    $select = mysqli_query($conexao, $sql);
                while ($rsTitulo_filme = mysqli_fetch_array($select)) {    
                ?>
                <option value="<?php echo($rsTitulo_filme['cod_filme']);?>"><?php echo($rsTitulo_filme['titulo_filme']);?></option>
                <?php 
                    }
                }
                ?>
            </select>
        </div>
        <div class="segura_combo_colocar_ator_filme">
            <select name="sle_genero" class="txt_ator">

                <?php
                    if($modo == 'Atualizar'){
                ?>
                    <option value="<?php echo($cod_genero)?>"><?php echo($nome_genero)?></option>        
                <?php
                }else{
                ?>
                    <option value=null>Selecione um genero</option>
                <?php
                    }
                   
                    //trzendo os atores do banco
                    $sqlGenero = "SELECT cod_genero,genero FROM tbl_genero WHERE cod_genero <> ".$cod_genero;
                    $selectgenero= mysqli_query($conexao, $sqlGenero);
                while($rsNomegenero = mysqli_fetch_array($selectgenero)){
                ?>
                    <option value="<?php echo($rsNomegenero['cod_genero']);?>"><?php echo($rsNomegenero['genero']);?></option>
                <?php
                    }
                ?>
        
            </select>
            
        </div>

        <div class="segura_combo_colocar_ator_filme">
            <input type="submit" value="<?php echo($btn)?>" name="<?php echo($btn)?>_adicionar_genero" class="botao_adicionar_filme">
        </div>
    </form>

</div>