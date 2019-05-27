<?php
    //startando a varivael de sessa
    require_once('../usuario_verificado.php');
    //pegando o banco 
    require_once('../../db/conexao.php');
    $conexao = conexaoMysql();

    $modo = $_GET['modo'];
    $id_diretor = null;
    $id_filme = null;
    $cod_diretor = 0;
    $cod_filme = 0;

    if($modo == 'Salvar'){ // passando modal para cadastra
        $btn = $modo;
    }elseif($modo == 'Atualizar'){// passando modal para atualizar primeiro ele busca depois na pagina que a modal foi chamada ele atualiza
        $btn = $modo;
        $id_filme = $_GET['codigo'];

        //fazendo select para trazer o diretor eo filme
        $sql = "SELECT filme.titulo_filme,
                filme.cod_filme,
                diretor.cod_diretor,
                diretor.diretor
                FROM tbl_filme as filme INNER JOIN tbl_filme_diretor as filme_diretor
                ON filme.cod_filme = filme_diretor.cod_filme INNER JOIN tbl_diretor as diretor
                ON filme_diretor.cod_diretor = diretor.cod_diretor WHERE filme.cod_filme =".$id_filme;
        $select = mysqli_query($conexao, $sql);
        if($rsFilme_ator = mysqli_fetch_array($select)){//← pegando o diretor e o filme
            $cod_diretor = $rsFilme_ator['cod_diretor'];
            $nome_diretor = $rsFilme_ator['diretor'];
            $cod_filme = $rsFilme_ator['cod_filme'];          
            $titulo_filme = $rsFilme_ator['titulo_filme'];

            //selecionando ator e filme para edição
            $_SESSION['id_diretor'] = $cod_diretor;
            $_SESSION['id_filme'] = $cod_filme;
        }

    }

?>

<!-- card que vai colocar ator em um filme -->
<div id="card_colocar_ator" class="center">
    <form name="frm_adicionar_diretor" method="POST" action="cms_produtos.php">
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
                 //verificando se não é para atualizar para atualizar se for para atulizar ele coloca o id que vem da modal cms_modal_cadastrar_ator.php
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
            <select name="sle_diretor" class="txt_ator">

                <?php
                    if($modo == 'Atualizar'){
                ?>
                    <option value="<?php echo($cod_diretor)?>"><?php echo($nome_diretor)?></option>        
                <?php
                }else{
                ?>
                    <option value=null>Selecione um(a) diretor(a)</option>
                <?php
                    }
                   
                    //trzendo os atores do banco
                    $sqldiretor = "SELECT cod_diretor,diretor FROM tbl_diretor WHERE cod_diretor <> ".$cod_diretor;
                    $selectdiretor= mysqli_query($conexao, $sqldiretor);
                while($rsNomeDiretor = mysqli_fetch_array($selectdiretor)){
                ?>
                    <option value="<?php echo($rsNomeDiretor['cod_diretor']);?>"><?php echo($rsNomeDiretor['diretor']);?></option>
                <?php
                    }
                ?>
        
            </select>
            <div class="adicionar icon iconSemMargin">
               <a href="cms_diretor.php">
                    <img src="./img/icon_add.png" class="img-size" alt="Adicionar" title="Adicionar Diretor">
               </a>
            </div>
        </div>

        <div class="segura_combo_colocar_ator_filme">
            <input type="submit" value="<?php echo($btn)?>" name="<?php echo($btn)?>_adicionar" class="botao_adicionar_filme">
        </div>
    </form>

</div>