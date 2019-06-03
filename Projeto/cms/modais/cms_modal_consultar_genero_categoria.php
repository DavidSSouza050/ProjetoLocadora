<?php
    //startando a varivael de sessa
    require_once('../usuario_verificado.php');
    //pegando o banco 
    require_once('../../db/conexao.php');
    $conexao = conexaoMysql();

    $cod_categoria = $_GET['codigo_categoria']
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
            $sql = "SELECT genero.cod_genero, genero.genero
                        FROM tbl_genero as genero INNER JOIN tbl_subcategoria_categoria as subcategoria_categoria
                        ON genero.cod_genero = subcategoria_categoria.cod_genero INNER JOIN tbl_categoria as categoria
                        ON subcategoria_categoria.cod_categoria = categoria.cod_categoria WHERE categoria.cod_categoria = ".$cod_categoria;
            $select = mysqli_query($conexao, $sql);                    
            while($rsgenero = mysqli_fetch_array($select)){
        ?>
        <tr class="tbody">
            <td>
                <?= $rsgenero['genero']?>
                <?php
                    //varivaeis para atualização
                    $_SESSION['id_categoria'] = $cod_categoria;
                    $_SESSION['id_genero'] = $rsgenero['cod_genero'];
                ?>
            </td>
            <td>
                 
            <a href="?modo=excluirRelacao&id_genero=<?php echo($rsgenero['cod_genero']);?>&id=<?php  echo($cod_categoria);?>">
                <img src="./img/icon_delete.png" class="img-size icon" onclick="return confirm('Deseja reamente excluir essa relação?')" alt="Excluir Relação" title="Excluir Relação">
            </a>

            <img src="./img/icon_edit.png"  onclick="colocargenero_categoria('Atualizar', <?php echo($rsgenero['cod_genero'])?>, <?php echo($cod_categoria)?>)" class="img-size icon" alt="Editar relação" title="Editar Relação"> 

            </td>
        </tr>
        <?php
            }
        ?>
    </table>
</div>