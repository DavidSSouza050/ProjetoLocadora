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
    $cod_categoria = 0;

    if($modo == 'Salvar'){ // passando modal para cadastra
        $btn = $modo;
    }elseif($modo == 'AtualizarGenero'){// passando modal para atualizar primeiro ele busca depois na pagina que a modal foi chamada ele atualiza
        $btn = 'Atualizar';
        $id_filme = $_GET['codigo_filme'];
        $id_genero = $_GET['codigo_genero'];
        $id_categoria = $_GET['codigo_categoria'];

        //fazendo select para trazer o genero eo filme
        $sql = "SELECT filme.titulo_filme,
                filme.cod_filme,
                genero.cod_genero,
                genero.genero,
                categoria.cod_categoria,
                categoria.categoria
                FROM tbl_filme as filme INNER JOIN tbl_filme_genero_categoria as filme_genero_categoria
                ON filme.cod_filme = filme_genero_categoria.cod_filme INNER JOIN tbl_genero as genero
                ON filme_genero_categoria.cod_genero = genero.cod_genero INNER JOIN tbl_categoria as categoria
                ON filme_genero_categoria.cod_categoria = categoria.cod_categoria
                WHERE filme.cod_filme =".$id_filme." AND genero.cod_genero =".$id_genero." AND categoria.cod_categoria =".$id_categoria;

        $select = mysqli_query($conexao, $sql);
        if($rsFilme_genero = mysqli_fetch_array($select)){//← pegando o genero e o filme
            $cod_genero = $rsFilme_genero['cod_genero'];
            $nome_genero = $rsFilme_genero['genero'];
            $cod_filme = $rsFilme_genero['cod_filme'];          
            $titulo_filme = $rsFilme_genero['titulo_filme'];
            $cod_categoria = $rsFilme_genero['cod_categoria'];
            $nome_categoria = $rsFilme_genero['categoria'];
            //selecionando ator e filme para edição
            $_SESSION['id_genero'] = $cod_genero;
            $_SESSION['id_filme'] = $cod_filme;
            $_SESSION['id_categoria'] = $cod_categoria;
        }

    }elseif($modo == 'AtualizarCategoria'){// passando modal para atualizar primeiro ele busca depois na pagina que a modal foi chamada ele atualiza
        $btn = 'Atualizar';
        $id_filme = $_GET['codigo_filme'];
        $id_genero = $_GET['codigo_genero'];
        $id_categoria = $_GET['codigo_categoria'];

        //fazendo select para trazer o genero eo filme
        $sql = "SELECT filme.titulo_filme,
                filme.cod_filme,
                genero.cod_genero,
                genero.genero,
                categoria.cod_categoria,
                categoria.categoria
                FROM tbl_filme as filme INNER JOIN tbl_filme_genero_categoria as filme_genero_categoria
                ON filme.cod_filme = filme_genero_categoria.cod_filme INNER JOIN tbl_genero as genero
                ON filme_genero_categoria.cod_genero = genero.cod_genero INNER JOIN tbl_categoria as categoria
                ON filme_genero_categoria.cod_categoria = categoria.cod_categoria
                WHERE filme.cod_filme =".$id_filme." AND genero.cod_genero =".$id_genero." AND categoria.cod_categoria =".$id_categoria;

        $select = mysqli_query($conexao, $sql);
        if($rsFilme_genero = mysqli_fetch_array($select)){//← pegando o genero e o filme
            $cod_genero = $rsFilme_genero['cod_genero'];
            $nome_genero = $rsFilme_genero['genero'];
            $cod_filme = $rsFilme_genero['cod_filme'];          
            $titulo_filme = $rsFilme_genero['titulo_filme'];
            $cod_categoria = $rsFilme_genero['cod_categoria'];
            $nome_categoria = $rsFilme_genero['categoria'];
            //selecionando ator e filme para edição
            $_SESSION['id_genero'] = $cod_genero;
            $_SESSION['id_filme'] = $cod_filme;
            $_SESSION['id_categoria'] = $cod_categoria;
        }

    }

?>
<script src="../../js/jquery-1.11.3.min.js"></script>
<script>
    $(document).ready(function(){
        $('#sleCategoria').live('change', function(){
            alet('Ola mundo');
        });
    });
    // const select = document.getElementById('sleCategoria') ;

    // select.addEventListener('change', function(){
    //     $('#sleCategoria').css({"backackground-color":"red"});
    // });
   
</script>


<!-- card que vai colocar ator em um filme -->
<div id="card_colocar_ator" class="center">
    <form name="frm_adicionar_genero" method="POST" action="cms_produtos.php">
        <!-- div que vai segurar os atores e os filmes cadastrados -->
        <div class="segura_combo_colocar_ator_filme">
            <select name="sle_filme" class="txt_ator">

                <?php
                    if($modo == 'AtualizarGenero' || $modo == 'AtualizarCategoria'){
                       
                ?>
                    <option value="<?php echo($cod_filme)?>"><?php echo($titulo_filme)?></option>        
                <?php
                        
                    }else{
                ?>
                    <option value="null">Selecione um filme</option>
                <?php
                }
                 //verificando se não é para atualizar para atualizar se for para atulizar ele coloca o id que vem da modal cms_modal_cadastrar_genero.php
                 if($modo != 'AtualizarGenero' ){
                        if($modo != 'AtualizarCategoria'){
                //trazendo os filmes do banco
                    $sql = "SELECT cod_filme, titulo_filme FROM tbl_filme WHERE cod_filme <> ".$cod_filme;
                    $select = mysqli_query($conexao, $sql);
                     while ($rsTitulo_filme = mysqli_fetch_array($select)) {    
                ?>
                <option value="<?php echo($rsTitulo_filme['cod_filme']);?>"><?php echo($rsTitulo_filme['titulo_filme']);?></option>
                <?php 

                        }
                    }
                 }
                ?>
            </select>
        </div>

        <div class="segura_combo_colocar_ator_filme">
            <select name="sle_categoria" id="sleCategoria"  class="txt_ator">

                <?php
                    if($modo == 'AtualizarGenero' || $modo == 'AtualizarCategoria'){
                       
                ?>
                    <option value="<?php echo($cod_categoria)?>"><?php echo($nome_categoria)?></option>        
                <?php
                        
                    }else{
                ?>
                    <option value=null>Selecione uma categoria</option>
                <?php
                    }
                    if($modo != 'AtualizarGenero'){
                    //trzendo os atores do banco
                    $sqlcategoria = "SELECT cod_categoria,categoria FROM tbl_categoria WHERE cod_categoria <> ".$cod_categoria." AND status = 1";
                    $selectcategoria= mysqli_query($conexao, $sqlcategoria);
                        while($rsNomecategoria = mysqli_fetch_array($selectcategoria)){
                ?>
                    <option value="<?php echo($rsNomecategoria['cod_categoria']);?>"><?php echo($rsNomecategoria['categoria']);?></option>
                <?php
                        }
                    }
                ?>
        
            </select>

            <div class="adicionar icon iconSemMargin">
               <a href="cms_categoria.php">
                    <img src="./img/icon_add.png" class="img-size" alt="Adicionar" title="Adicionar categoria">
               </a>
            </div>
        </div>

        <div class="segura_combo_colocar_ator_filme">
            <select name="sle_genero" class="txt_ator">

                <?php
                    if($modo == 'AtualizarGenero' || $modo == 'AtualizarCategoria'){
                        
                ?>
                    <option value="<?php echo($cod_genero)?>"><?php echo($nome_genero)?></option>        
                <?php
                    }else{
                ?>
                    <option value=null>Selecione um genero</option>
                <?php
                    }
                   if($modo != 'AtualizarCategoria'){
                    //trzendo os atores do banco
                    $sqlGenero = "SELECT cod_genero,genero FROM tbl_genero WHERE cod_genero <> ".$cod_genero;
                    $selectgenero= mysqli_query($conexao, $sqlGenero);
                        while($rsNomegenero = mysqli_fetch_array($selectgenero)){
                ?>
                    <option value="<?php echo($rsNomegenero['cod_genero']);?>"><?php echo($rsNomegenero['genero']);?></option>
                <?php
                        }
                    }
                ?>
        
            </select>
            
        </div>


        <div class="segura_combo_colocar_ator_filme">
            <?php 
                if($modo == 'Salvar'){
                    $complemento = '_adicionar_genero';
                }else{
                    $complemento = $modo == 'AtualizarGenero' ? '_adicionar_genero' : '_adicionar_categoria';
                }
            ?>
            <input type="submit" value="<?php echo($btn)?>" name="<?php echo($btn.$complemento)?>" class="botao_adicionar_filme">
        </div>
    </form>

</div>