<?php
    //pegando a conexao
    require_once('../../db/conexao.php');
    $conexao = conexaoMysql();
    if(isset($_GET['categoria'])){
        $cod_categoria = $_GET['categoria'];

        $sql = "SELECT genero.cod_genero, genero.genero
                FROM tbl_categoria as categoria INNER JOIN tbl_subcategoria_categoria as subCategoria_categoria
                ON categoria.cod_categoria = subCategoria_categoria.cod_categoria INNER JOIN tbl_genero as genero
                ON genero.cod_genero = subCategoria_categoria.cod_genero WHERE categoria.cod_categoria =".$cod_categoria;




        // $subcategoria = (array) [];
        // $subcategorias = (array) [];
        $dados= null;
        $select = mysqli_query($conexao, $sql);
        while($rsSubcategoria = mysqli_fetch_array($select)){
            // $subcategoria = array(
            //     'cod_subcategoria' => $rsSubcategoria['cod_genero'],
            //     'subcategoria' => $rsSubcategoria['genero']
            // );
            // array_push($subcategorias, $subcategoria);
            $dados = $dados . "<option value=".$rsSubcategoria['cod_genero'].">".$rsSubcategoria['genero']."</option>";
        }
        echo($dados);
        // print_r(json_encode(array_filter($subcategorias)));
    }


?>