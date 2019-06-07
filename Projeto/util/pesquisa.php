<script src="js/jquery-1.11.3.min.js"></script>
<script>
    function visualizarProduto(modo, codigo){
        $.ajax({
            type: 'GET',
            url: './modais/modal_produto.php',
            data:{modo:modo, codigo:codigo},
            success: function(dados){
                $('#modal_produto').html(dados);
                $('#conteiner_produto').fadeIn(300);
                //console.log(dados);
            }
        });
    }
</script>
<?php

    //pegando a função de desconto
    require_once('../cms/util/formatar_preco.php');
    require_once('../db/conexao.php');
    $conexao =  conexaoMysql();
    
    if(isset($_GET['texto'])){
        $texto = str_replace(" ", "%", $_GET['texto']);
        $texto = "%".$texto."%";
        $modo = $_GET['modo'];

      if($modo == 'normal'){

            $sql = "SELECT  
                DISTINCT filme.cod_filme,
                filme.titulo_filme,
                filme.preco_filme,                                           
                concat(SUBSTRING(filme.descricao, 1, 110), ' ...') as descricao,
                filme.imagem_filme,
                promocao.status as status_promocao
                FROM tbl_promocao as promocao right JOIN tbl_filme as filme
                ON filme.cod_filme = promocao.cod_filme LEFT JOIN tbl_filme_genero_categoria as filme_genero_cat
                ON filme.cod_filme = filme_genero_cat.cod_filme LEFT JOIN tbl_genero as genero
                ON filme_genero_cat.cod_genero = genero.cod_genero LEFT JOIN tbl_categoria as categoria
                ON filme_genero_cat.cod_categoria = categoria.cod_categoria
                WHERE filme.status_produto = 1 AND (filme.titulo_filme LIKE '$texto' OR filme.descricao LIKE '$texto')";
                $dados = null;
                $select = mysqli_query($conexao, $sql);
                while($rsFilme = mysqli_fetch_array($select)){
                    if($rsFilme['status_promocao'] == null || $rsFilme['status_promocao'] == 0){  
                        $dados = $dados .
                            "
                                    <div class='produto'>
                                        <div class='produto_caixa_imagem'>
                                            <figure>
                                                <div class='produto_imagem center'>
                                                    <img class='img-size' src='./cms/img/imagem_filme/".$rsFilme['imagem_filme']."' alt=".$rsFilme['imagem_filme'].">
                                                </div>
                                            </figure>
                                        </div>
                                        <div class='produto_caixa_descricao'>
                                            <p><span class='formata_atributo'>Nome:</span>".$rsFilme['titulo_filme']."</p>
                                            <p><span class='formata_atributo'>Descrição:</span>".$rsFilme['descricao']."</p>
                                            <p><span class='formata_atributo'>Preço:</span> 
                                                ".$preco = colocar_virgula($rsFilme['preco_filme'])."
                                                
                                            </p>
                                        </div>
                                        <div class='produto_caixa_detalhes visualizar'>
                                            <div class='botao_detalhes formata_atributo visualizar' onclick='visualizarProduto(".'"normal"'.", ".$rsFilme['cod_filme'].")'>
                                                Detalhes
                                            </div>
                                        </div>
                                    </div>



                                
                                    <div class='produto_mobile center'>
                                        <div class='produto_caixa_imagem_mobile'>
                                            <figure>
                                                <div class='produto_imagem_mobile center'>
                                                    <img class='img-size' src='./cms/img/imagem_filme/".$rsFilme['imagem_filme']."' alt=".$rsFilme['imagem_filme'].">
                                                </div>
                                            </figure>
                                        </div>
                                        <div class='produto_caixa_descricao_mobile'>
                                            <p><span class='formata_atributo_mobile'>Nome:</span> ".$rsFilme['titulo_filme']." </p>
                                            <p><span class='formata_atributo_mobile'>Descrição:</span> ".$rsFilme['descricao']." </p>
                                            <p><span class='formata_atributo_mobile'>Preço:</span> 
                                                    ".$preco = colocar_virgula($rsFilme['preco_filme'])."
                                                    
                                                </p>
                                        </div>
                                        <div class='produto_caixa_detalhes_mobile'>
                                            <a href='./modais/pagina_modal_responsivo.php?modo=normal&codigo=".$rsFilme['cod_filme']."'>
                                                <div class='botao_detalhes_mobile formata_atributo_mobile'>   
                                                    Detalhes
                                                </div>
                                            </a>
                                        </div>
                                    </div>";
                        
                }
            }
        
        }elseif($modo == 'promocao'){
            $sql = "SELECT DISTINCT filme.titulo_filme,
                    filme.preco_filme, 
                    filme.cod_filme,                          
                    concat(SUBSTRING(filme.descricao, 1, 110), ' ...') as descricao,
                    filme.imagem_filme,
                    promocao.status as status_promocao,
                    promocao.porcentagem_desconto as desconto
                    FROM tbl_promocao as promocao right JOIN tbl_filme as filme
                    ON filme.cod_filme = promocao.cod_filme LEFT JOIN tbl_filme_genero_categoria as filme_genero_cat
                    ON filme.cod_filme = filme_genero_cat.cod_filme LEFT JOIN tbl_genero as genero
                    ON filme_genero_cat.cod_genero = genero.cod_genero LEFT JOIN tbl_categoria as categoria
                    ON filme_genero_cat.cod_categoria = categoria.cod_categoria
                    WHERE filme.status_produto = 1 AND (filme.titulo_filme LIKE '$texto' OR filme.descricao LIKE '$texto')";

            $dados = null;
            $select = mysqli_query($conexao, $sql);
            while($rsFilme = mysqli_fetch_array($select)){
                if($rsFilme['status_promocao'] == 1){  
                    $dados = $dados . 
                    "
                        <div class='produto_promocao'>
                            <div class='produto_caixa_imagem'>
                                <figure>
                                    <div class='produto_imagem center'>
                                        <img class='img-size' src='./cms/img/imagem_filme/".$rsFilme['imagem_filme']."' alt='".$rsFilme['imagem_filme']."'>
                                    </div>
                                </figure>
                            </div>
                            <div class='produto_caixa_descricao_promocao'>
                                <p><span class='formata_atributo'>Nome:</span>".$rsFilme['titulo_filme']."</p>
                                <p><span class='formata_atributo'>Descrição:</span> ".$rsFilme['descricao']."</p>
                                <div class='caixa_preco_promocoes'>
                                    <div class='preco_promocoes'>
                                    
                                        <span class='formata_atributo'>De:</span> <del>".$preco = colocar_virgula($rsFilme['preco_filme'])."</del>
                                    </div>
                                    <div class='preco_promocoes'>
                        
                                        <span class='formata_atributo'>Por:</span> ".$preco_com_desconto = calcular_preco($rsFilme['desconto'], $rsFilme['preco_filme'])."
                                    </div>                            
                                </div>
                            </div>
                            <div class='produto_caixa_detalhes'>
                                <div class='botao_detalhes formata_atributo visualizar' onclick='visualizarProduto(".'"promocao"'.", ".$rsFilme['cod_filme']."'>
                                    Detalhes
                                </div>
                            </div>
                        </div>


                        <!-- cards dos filmes a venda e em promoção mobile -->
                        <div class='produto_promocao_mobile center'>
                            <div class='produto_caixa_imagem_mobile'>
                                <figure>
                                    <div class='produto_imagem_mobile center'>
                                        <img class='img-size' src='./cms/img/imagem_filme/".$rsFilme['imagem_filme']."' alt='".$rsFilme['imagem_filme']."'>
                                    </div>
                                </figure>
                            </div>
                            <div class='produto_caixa_descricao_promocao_mobile'>
                                <p><span class='formata_atributo_mobile'>Nome:</span> ".$rsFilme['titulo_filme']."</p>
                                <p><span class='formata_atributo_mobile'>Descrição:</span> ".$rsFilme['descricao']."</p>
                                <div class='caixa_preco_promocoes_mobile'>
                                    <div class='preco_promocoes_mobile'>
                    
                                        <span class='formata_atributo_mobile'>De:</span> <del>".$preco = colocar_virgula($rsFilme['preco_filme'])."</del>
                                    </div>
                                    <div class='preco_promocoes_mobile'>
                                        
                                        <span class='formata_atributo_mobile'>Por:</span> ".$preco_com_desconto = calcular_preco($rsFilme['desconto'], $rsFilme['preco_filme'])."
                                    </div>                            
                                </div>
                            </div>
                            <div class='produto_caixa_detalhes_mobile'>
                                <a href='./modais/pagina_modal_responsivo.php?modo=promocao&codigo=".$rsFilme['cod_filme']."'> 
                                    <div class='botao_detalhes_mobile formata_atributo_mobile' >
                                        Detalhes
                                    </div>
                                </a>
                            </div>
                        </div>
                    
                    
                    
                    ";
                }
            }
        } 
        

        echo($dados);


    }


?>