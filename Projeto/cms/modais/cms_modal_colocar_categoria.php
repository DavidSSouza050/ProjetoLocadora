<?php
    //startando a varivael de sessa
    require_once('../usuario_verificado.php');
    //pegando o banco 
    require_once('../../db/conexao.php');
    $conexao = conexaoMysql();

    $modo = $_GET['modo'];
    $id_categoria = null;
    $id_filme = null;
    $cod_categoria = 0;
    $cod_filme = 0;

    if($modo == 'Salvar'){ // passando modal para cadastra
        $btn = $modo;
    }elseif($modo == 'Atualizar'){// passando modal para atualizar primeiro ele busca depois na pagina que a modal foi chamada ele atualiza
        $btn = $modo;
        $id_filme = $_GET['codigo'];

        //fazendo select para trazer o categoria eo filme
        $sql = "SELECT filme.titulo_filme,
		filme.cod_filme,
		categoria.cod_categoria,
		categoria.categoria
		FROM tbl_genero as genero INNER JOIN tbl_genero_categoria as genero_categoria
		ON genero.cod_genero = genero_categoria.cod_genero INNER JOIN tbl_categoria as categoria
		ON genero_categoria.cod_categoria = categoria.cod_categoria INNER JOIN tbl_filme_genero as filme_genero
        ON genero.cod_genero = filme_genero.cod_genero INNER JOIN tbl_filme as filme
        ON filme_genero.cod_filme = filme.cod_filme  WHERE filme.cod_filme = ".$id_filme." group by categoria.cod_categoria";

        $select = mysqli_query($conexao, $sql);
        if($rsFilme_categoria = mysqli_fetch_array($select)){//← pegando o categoria e o filme
            $cod_categoria = $rsFilme_categoria['cod_categoria'];
            $nome_categoria = $rsFilme_categoria['categoria'];
            $cod_filme = $rsFilme_categoria['cod_filme'];          
            $titulo_filme = $rsFilme_categoria['titulo_filme'];

            //selecionando ator e filme para edição
            $_SESSION['id_categoria'] = $cod_categoria;
            $_SESSION['id_filme'] = $cod_filme;
        }

    }

?>

<!-- card que vai colocar ator em um filme -->
<div id="card_colocar_ator" class="center">
    <form name="frm_adicionar_ator" method="POST" action="cms_produtos.php">
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
                 //verificando se não é para atualizar para atualizar se for para atulizar ele coloca o id que vem da modal cms_modal_cadastrar_categoria.php
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
            <select name="sle_categoria" class="txt_ator">

                <?php
                    if($modo == 'Atualizar'){
                ?>
                    <option value="<?php echo($cod_categoria)?>"><?php echo($nome_categoria)?></option>        
                <?php
                }else{
                ?>
                    <option value=null>Selecione um(a) categoria(a)</option>
                <?php
                    }
                   
                    //trzendo os atores do banco
                    $sqlcategoria = "SELECT cod_categoria,categoria FROM tbl_categoria WHERE cod_categoria <> ".$cod_categoria." AND status = 1";
                    $selectcategoria= mysqli_query($conexao, $sqlcategoria);
                while($rsNomecategoria = mysqli_fetch_array($selectcategoria)){
                ?>
                    <option value="<?php echo($rsNomecategoria['cod_categoria']);?>"><?php echo($rsNomecategoria['categoria']);?></option>
                <?php
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
            <input type="submit" value="<?php echo($btn)?>" name="<?php echo($btn)?>_adicionar_categoria" class="botao_adicionar_filme">
        </div>
    </form>

</div>