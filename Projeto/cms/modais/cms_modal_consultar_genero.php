<?php
    //startando a varivael de sessa
    require_once('../usuario_verificado.php');
    //pegando o banco 
    require_once('../../db/conexao.php');
    $conexao = conexaoMysql();

    $cod_filme = $_GET['codigo']
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
                    genero.genero
                    FROM tbl_filme as filme INNER JOIN tbl_filme_genero_categoria as filme_genero_categoria
                    ON filme.cod_filme = filme_genero_categoria.cod_filme INNER JOIN tbl_genero as genero
                    ON filme_genero_categoria.cod_genero = genero.cod_genero WHERE filme.cod_filme = ".$cod_filme;
            $select = mysqli_query($conexao, $sql);                    
            while($rsgenero = mysqli_fetch_array($select)){
        ?>
        <tr class="tbody">
            <td>
                <?= $rsgenero['genero']?>
                <?php
                    //varivaeis para atualização
                    $_SESSION['id_filme'] = $cod_filme;
                    $_SESSION['id_genero'] = $rsgenero['cod_genero'];
                ?>
            </td>
            <td>
                 
            <a href="?modo=excluirRelacaoGenero&id_genero=<?php echo($rsgenero['cod_genero']);?>&id=<?php  echo($cod_filme);?>">
                <img src="./img/icon_delete.png" class="img-size icon" onclick="return confirm('Deseja reamente excluir está relação?')" alt="Excluir Relação" title="Excluir Relação">
            </a>

            <img src="./img/icon_edit.png"  onclick="colocargenero('Atualizar', <?php echo($cod_filme)?>, <?php echo($rsgenero['cod_genero'])?>)" class="img-size icon" alt="Editar relação" title="Editar Relação"> 

            </td>
        </tr>
        <?php
            }
        ?>
    </table>
</div>