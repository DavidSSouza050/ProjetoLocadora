<?php
    //startando a varivael de sessa
    require_once('../usuario_verificado.php');
    //pegando o banco 
    require_once('../../db/conexao.php');
    $conexao = conexaoMysql();

    $modo = $_GET['modo'];
    $id_categoria = null;
    $cod_categoria = 0;
    $cod_genero = 0;

    if($modo == 'Salvar'){ // passando modal para cadastra
        $btn = $modo;
    }elseif($modo == 'Atualizar'){// passando modal para atualizar primeiro ele busca depois na pagina que a modal foi chamada ele atualiza
        $btn = $modo;
        $id_genero = $_GET['codigo_genero'];
        $id_categoria = $_GET['codigo_categoria'];

        //fazendo select para trazer o categoria eo filme
        $sql = "SELECT genero.cod_genero, genero.genero,
                        categoria.cod_categoria, categoria.categoria
                        FROM tbl_genero as genero INNER JOIN tbl_subcategoria_categoria as subcategoria_categoria
                        ON genero.cod_genero = subcategoria_categoria.cod_genero INNER JOIN tbl_categoria as categoria
                        ON subcategoria_categoria.cod_categoria = categoria.cod_categoria WHERE categoria.cod_categoria = ".$id_categoria." AND genero.cod_genero =".$id_genero;

        $select = mysqli_query($conexao, $sql);
        if($rsgenero_categoria = mysqli_fetch_array($select)){//← pegando o categoria e o filme
            $cod_categoria = $rsgenero_categoria['cod_categoria'];
            $nome_categoria = $rsgenero_categoria['categoria'];
            $cod_genero = $rsgenero_categoria['cod_genero'];          
            $nome_genero = $rsgenero_categoria['genero'];

            //selecionando ator e genero para edição
            $_SESSION['id_categoria'] = $cod_categoria;
            $_SESSION['id_genero'] = $cod_genero;
        }

    }

?>

<!-- card que vai colocar ator em um filme -->
<div id="card_colocar_ator" class="center">
    <form name="frm_adicionar_genero_na_categoria" method="POST" action="cms_categoria.php">
        <!-- div que vai segurar os atores e os filmes cadastrados -->
        <div class="segura_combo_colocar_ator_filme">
            <select name="sle_genero" class="txt_ator">

                <?php
                    if($modo == 'Atualizar'){
                ?>
                    <option value="<?php echo($cod_genero)?>"><?php echo($nome_genero)?></option>        
                <?php
                }else{
                ?>
                    <option value="null">Selecione um genero</option>
                <?php
                    }
                   
                    //trzendo os atores do banco
                    $sqlGenero = "SELECT cod_genero, genero FROM tbl_genero WHERE cod_genero <> ".$cod_genero;
                    $selectgenero= mysqli_query($conexao, $sqlGenero);
                while($rsNomegenero = mysqli_fetch_array($selectgenero)){
                ?>
                    <option value="<?php echo($rsNomegenero['cod_genero']);?>"><?php echo($rsNomegenero['genero']);?></option>
                <?php
                    }
                ?>
        
            </select>     
            <div class="adicionar icon iconSemMargin">
               <a href="cms_genero.php">
                    <img src="./img/icon_add.png" class="img-size" alt="Adicionar" title="Adicionar genero">
               </a>
            </div>
        </div>
        <div class="segura_combo_colocar_ator_filme">
            <select name="sle_categoria" class="txt_ator">

                <?php
                    if($modo == 'Atualizar'){
                ?>
                    <option value="<?php echo($cod_categoria)?>"><?php echo($nome_categoria)?></option>        
                <?php
                }else{
                ?>
                    <option value= "null" >Selecione uma categoria</option>
                <?php
                    }
                   if($modo != 'Atualizar'){
                    //trzendo os atores do banco
                    $sqlcategoria = "SELECT cod_categoria,categoria FROM tbl_categoria WHERE cod_categoria <> ".$cod_categoria;
                    $selectcategoria= mysqli_query($conexao, $sqlcategoria);
                while($rsNomecategoria = mysqli_fetch_array($selectcategoria)){
                ?>
                    <option value="<?php echo($rsNomecategoria['cod_categoria']);?>"><?php echo($rsNomecategoria['categoria']);?></option>
                <?php
                    }
                   }
                ?>
        
            </select>
        
        </div>

        <div class="segura_combo_colocar_ator_filme">
            <input type="submit" value="<?php echo($btn)?>" name="<?php echo($btn)?>_adicionar_genero_categoria" class="botao_adicionar_filme">
        </div>
    </form>

</div>