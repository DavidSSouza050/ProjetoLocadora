<?php

    //statar as Variaveis de sessao
    session_start();
    //variavel de conexao com o banco
    require_once('../db/conexao.php');
    $conexao = conexaoMysql();

    if(!isset($_GET['logout'])){

        if(isset($_POST['btn_confirmar'])){
            //verificando se existe o usuario
            $login_nome_email = trim($_POST['txt_login_usuario']);
            $senha = trim($_POST['txt_login_senha'] == "" ? "" : md5($_POST['txt_login_senha']));
            
            //verificando se aquele usuario existe
            $sql = "SELECT usuario.cod_usuario, usuario.nome_usuario, usuario.status as status_usuario, nivel.status as status_nivel
                    FROM tbl_usuario as usuario LEFT JOIN tbl_nivel_usuario as nivel
                    ON usuario.cod_nivel = nivel.cod_nivel
                    WHERE (email = '".addslashes($login_nome_email)."' OR nome_usuario = '".addslashes($login_nome_email)."')
                    AND senha = '".addslashes($senha)."'";
    
            $select = mysqli_query($conexao,$sql);
            if($rsLogado = mysqli_fetch_array($select)){
                if($rsLogado['status_usuario'] == 1 && $rsLogado['status_nivel'] == 1){
                    $_SESSION['cod_usuario_logado'] = $rsLogado['cod_usuario'];
                    header("Location: ../cms/");
                }else{
                    echo("<script>
                        alert('Usuario Não ativo ou nivel não Ativo');
                        window.location.href = '../';
                    </script>");  
                }
                
               
            }else{
                echo("<script>
                    alert('Senha ou usuario incorretos');
                    window.location.href = '../';
                </script>");
            }
            
    
    
        }
    
    
    }else{
        session_destroy();
        header('Location: ../');
    }

    

?>