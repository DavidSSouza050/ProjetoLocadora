<?php

    if(isset($_GET["codigo"])){
        $codigo = $_GET["codigo"];
       

        //conexão com o banco
        require_once('../../db/conexao.php');
        $conexao = conexaoMysql();
       
        $sql = "SELECT u.nome_usuario, 
                       u.email,
                      u.status,
                      n.nome_nivel
                FROM tbl_usuario AS u LEFT JOIN tbl_nivel_usuario AS n
                ON u.cod_nivel = n.cod_nivel WHERE u.cod_usuario =".$codigo;
        
        
        $select = mysqli_query($conexao, $sql);

        if($rsUsuario = mysqli_fetch_array($select)){// buscando o usuario
            
            $nome_usuario = $rsUsuario['nome_usuario'];
            $email_usuario = $rsUsuario['email'];
            $nivel = $rsUsuario['nome_nivel'] == null ? 'Não tem nivel' : $rsUsuario['nome_nivel'];
            $ativo = $rsUsuario['status'] == 0 ? 'Não está ativo' : 'Ativo';
           
        }
    }

?>

<!-- table para colocar os dados na modal do fale conosco -->
<table id="tabela_modal_fale_conosco">
    <tr id="thead_modal_fale_conosco">
        <td colspan='2'>
            Consulta ao usuario <?php echo($nome_usuario);?>
        </td>
    </tr>
    <tr class="tbody_modal_fale_conosco">
        <td>
            Nome:
        </td>
        <td>
            <?php echo($nome_usuario);?>
        </td>
    </tr>
    <tr class="tbody_modal_fale_conosco">
        <td>
            Email:
        </td>
        <td>
            <?php echo($email_usuario);?>
        </td>
    </tr>
    <tr class="tbody_modal_fale_conosco">
        <td>
            Nivel:
        </td>
        <td>
            <?php echo($nivel);?>
        </td>
    </tr>
    <tr class="tbody_modal_fale_conosco">
        <td>
            Ativo:
        </td>
        <td>
            <?php echo($ativo);?>
        </td>
    </tr>

</table>