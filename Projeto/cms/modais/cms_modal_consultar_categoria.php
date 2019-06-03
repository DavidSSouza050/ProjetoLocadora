<?php
    //startando a varivael de sessa
    require_once('../usuario_verificado.php');
    //pegando o banco 
    require_once('../../db/conexao.php');
    $conexao = conexaoMysql();

    $cod_filme = $_GET['codigo_filme'];
?>
<div id="segura_table_consultar">
    <table id="table_cem">
        <tr id="thead">
            <td>
               Generos
            </td>
            <td>
                Opções
            </td>
        </tr>
        <?php
            $sql = "SELECT genero.cod_genero,
                    categoria.categoria,
                    categoria.cod_categoria
                    FROM tbl_filme as filme INNER JOIN tbl_filme_genero_categoria as filme_genero_categoria
                    ON filme.cod_filme = filme_genero_categoria.cod_filme INNER JOIN tbl_genero as genero
                    ON filme_genero_categoria.cod_genero = genero.cod_genero INNER JOIN tbl_categoria as categoria
                    ON filme_genero_categoria.cod_categoria = categoria.cod_categoria
                    WHERE filme.cod_filme = ".$cod_filme;

            $select = mysqli_query($conexao, $sql);                    
            while($rscategoria = mysqli_fetch_array($select)){
        ?>
        <tr class="tbody">
            <td>
                <?= $rscategoria['categoria']?>
                <?php
                    //varivaeis para atualização
                    $_SESSION['id_filme'] = $cod_filme;
                    $_SESSION['id_genero'] = $rscategoria['cod_genero'];
                    $_SESSION['id_categoria'] = $rscategoria['cod_categoria'];
                ?>
            </td>
            <td>
                 
            <a href="?modo=excluirRelacaoCategoria&id_categoria=<?php echo($rscategoria['cod_genero']);?>&id=<?php  echo($cod_filme);?>">
                <img src="./img/icon_delete.png" class="img-size icon" onclick="return confirm('Deseja reamente excluir está relação?')" alt="Excluir Relação" title="Excluir Relação">
            </a>

            <img src="./img/icon_edit.png"  onclick="colocargenero('AtualizarCategoria', <?php echo($cod_filme)?>, <?php echo($rscategoria['cod_genero'])?>, <?php echo($rscategoria['cod_categoria'])?>)" class="img-size icon" alt="Editar relação" title="Editar Relação"> 

            </td>
        </tr>
        <?php
            }
        ?>
    </table>
</div>