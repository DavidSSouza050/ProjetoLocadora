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
                Diretores
            </td>
            <td>
                Opções
            </td>
        </tr>
        <?php
            $sql = "SELECT diretor.cod_diretor,
                    diretor.diretor
                    FROM tbl_filme as filme INNER JOIN tbl_filme_diretor as filme_diretor
                    ON filme.cod_filme = filme_diretor.cod_filme INNER JOIN tbl_diretor as diretor
                    ON filme_diretor.cod_diretor = diretor.cod_diretor WHERE filme.cod_filme = ".$cod_filme;
            $select = mysqli_query($conexao, $sql);                    
            while($rsDiretor = mysqli_fetch_array($select)){
        ?>
        <tr class="tbody">
            <td>
                <?= $rsDiretor['diretor']?>
                <?php
                    //varivaeis para atualização
                    $_SESSION['id_filme'] = $cod_filme;
                    $_SESSION['id_diretor'] = $rsDiretor['cod_diretor'];
                ?>
            </td>
            <td>
                 
            <a href="?modo=excluirRelacao&id_diretor=<?php echo($rsDiretor['cod_diretor']);?>&id=<?php  echo($cod_filme);?>">
                <img src="./img/icon_delete.png" class="img-size icon" onclick="return confirm('Deseja reamente excluir essa relação?')" alt="Excluir Relação" title="Excluir Relação">
            </a>

            <img src="./img/icon_edit.png"  onclick="colocardiretor('Atualizar', <?php echo($cod_filme)?>)" class="img-size icon" alt="Editar relação" title="Editar Relação"> 

            </td>
        </tr>
        <?php
            }
        ?>
    </table>
</div>