<?php

    if(isset($_GET["codigo"])){
        $codigo = $_GET["codigo"];

        //conexão com o banco
        require_once('../../db/conexao.php');
        $conexao = conexaoMysql();
       
        $sql = "SELECT * FROM tbl_fale_conosco WHERE codigo = ".$codigo;
        $select = mysqli_query($conexao, $sql);

        if($rsContato=mysqli_fetch_array($select)){
            
            $nome = $rsContato['nome'];
            $telefone = $rsContato['telefone'] == "" ? "Não colocou": $rsContato['telefone'];
            $celular = $rsContato['celular'];
            $email = $rsContato['email'];
            $homePage = $rsContato['homePage'] == "" ? "Não colocou" : $rsContato['homePage'];
            $facebook = $rsContato['facebook'] == "" ? "Não colocou" : $rsContato['facebook'] ;
            $assunto = $rsContato['assunto'];
            $mensagem = $rsContato['mensagem'];
            $sexo = $rsContato['sexo'] == 'F' ? "Feminino" : "Masculino" ;
            $profissao = $rsContato['profissao'];
        }
    }

?>

<!-- table para colocar os dados na modal do fale conosco -->



<table id="tabela_modal_fale_conosco">
    <tr id="thead_modal_fale_conosco">
        <td colspan='2'>
            <?php echo($assunto)?> de <?php echo($nome)?>
        </td>
    </tr>
    <tr class="tbody_modal_fale_conosco">
        <td>
            Nome:
        </td>
        <td>
            <?php echo($nome);?>
        </td>
    </tr>
    <tr class="tbody_modal_fale_conosco">
        <td>
            Telefone:
        </td>
        <td>
            <?php echo($telefone);?>
        </td>
    </tr>
    <tr class="tbody_modal_fale_conosco">
        <td>
            Celular:
        </td>
        <td>
            <?php echo($celular);?>
        </td>
    </tr>
    <tr class="tbody_modal_fale_conosco">
        <td>
            Email:
        </td>
        <td>
            <?php echo($email);?>
        </td>
    </tr>
    <tr class="tbody_modal_fale_conosco">
        <td>
            HomePage:
        </td>
        <td>
            <?php echo($homePage);?>
        </td>
    </tr>
    <tr class="tbody_modal_fale_conosco">
        <td>
            Facebook:
        </td>
        <td>
            <?php echo($facebook);?>
        </td>
    </tr>
    <tr class="tbody_modal_fale_conosco">
        <td>
            Sexo:
        </td>
        <td>
            <?php echo($sexo);?>
        </td>
    </tr>
    <tr class="tbody_modal_fale_conosco">
        <td>
            Profissão:
        </td>
        <td>
            <?php echo($profissao);?>
        </td>
    </tr>
    <tr class="tbody_modal_fale_conosco">
        <td>
            Assunto:
        </td>
        <td>
            <?php echo($assunto);?>
        </td>
    </tr>
    <tr class="tbody_modal_fale_conosco">
        <td>
            Messagem:
        </td>
        <td>
            <textArea disabled id="textArea_modal_fale_conosco" class="scrollTexto"><?php echo($mensagem)?></textArea>
        </td>
    </tr>

</table>