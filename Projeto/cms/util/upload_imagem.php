<?php

function move_image($foto, $diretorio){
    /*Upload de imagem*/
    //constantes
    $arquivos_permitidos = array(".jpg",".jpeg", ".png");
    
    //pegando o nome da imagem
    $foto_empresa = $foto['name'];
    //tamanho da imagem
    $tamanho_imagem = $foto['size'];
    //tranformando em kbytes 
    $tamanho_imagem = round($tamanho_imagem/1024);
    //guardando a extenção do arquivo
    $extensao_foto = strrchr($foto_empresa, ".");
    //guardando o nome do arquivo com o pathinfo
    $nome_foto = pathinfo($foto_empresa, PATHINFO_FILENAME);
    //criptografando nome com a hora do pc
    $arquivo_criptografado = sha1(uniqid(time()).$nome_foto);
    /*CRIAMOS O NOME (JÁ CRIPTOGRAFADO) COM A EXTESÃO COM O NOME DO ARQUIVO QUE SERÁ ENVIADO PARA O SERVIDOR*/
    $foto_banco = $arquivo_criptografado . $extensao_foto;

    //validando a foto com a extasão e o tamanho 
    if(in_array($extensao_foto, $arquivos_permitidos)){
        //tamanho do arquivo (não pode ser maior de 10mb)
        if($tamanho_imagem <= 10000 ){

            $arquivo_tmp = $foto['tmp_name'];

            if(move_uploaded_file($arquivo_tmp, $diretorio.$foto_banco)){
                return $foto_banco;
            }else{
                return null;
            }
        }else{  
            echo("<script>alert('Tamanho da imagem maior que o permitido (10MB)')</script>");
            echo("<script>window.location='cms_sobre_empresa.php';</script>");
        }
    }else{
        return null;
    }
}
    
?>


