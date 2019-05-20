//variavel do botão de enviar
const btn_enviar = document.getElementById('btn_enviar_contato');

//variaveis das caixas
const txtNome = document.getElementById('txt_nome');
const txtTelefone = document.getElementById('txt_telefone');
const txtCelular = document.getElementById('txt_celular');
const txtEmail = document.getElementById('txt_email');
const txthome = document.getElementById('txt_home');
const txtFacebook = document.getElementById('txt_facebook');
const txtProfissao = document.getElementById('txt_profissao');
const txtAreaObs = document.getElementById('txtArea_observacao');
const cmbAssunto = document.getElementById('selectAssunto');


//validação das caixas com expressão regular
const validacao = () =>{
    
    const validarNome = () =>{//função que verifica que o que está escrito etá correto
        er = /[^(a-zA-Z Á-ÿ)]+/;
        return er.test(txtNome.value);
    }
    const validarProfissao = () =>{//função que verifica que o que está escrito etá correto
        er = /[^(a-zA-Z Á-ÿ)]+/;
        return er.test(txtProfissao.value);
    }

    const emailValido = (email) =>{//função que verifica que o que está escrito etá correto
        const er = /^([a-zA-zÁ-ÿ][a-zÁ-ÿ0-9._-]+@([a-z]+[.]?)+)[a-z]$/;
        return er.test(email.value);
    }

    const celularValidado = () =>{//função que verifica que o que está escrito etá correto
        const er = /\([0-9]{2}\) [0-9]{5}-[0-9]{4}/;
        return er.test(txtCelular.value);
    }

    const validarAreaObs = () =>{
        const er = /[^(a-zA-Z Á-ÿ 0-9)]/;
        return er.test(txtAreaObs.value);
    }
    
    //verificar se está tudo correto
    //se não coloca um class erro na caixa requerida
    
    if(validarAreaObs() || txtAreaObs.value == ""){ // verifica se estão tudo conforme e coloca uma class para demostrar o erro caso esteja erredo
        txtAreaObs.classList.add('erro');
        txtAreaObs.placeholder = "Escrava uma Mensagem corretamente";
    }else{
        txtAreaObs.classList.remove('erro');
    }

    if(cmbAssunto.value == ""){// verifica se estão tudo conforme e coloca uma class para demostrar o erro caso esteja erredo
        cmbAssunto.style.color = '#ff0000';
    }else{
        cmbAssunto.classList.remove('#000000');
    }

    if(celularValidado() || txtCelular.value == ""){// verifica se estão tudo conforme e coloca uma class para demostrar o erro caso esteja erredo
        txtCelular.classList.add('erro');
        txtCelular.placeholder = "Cel.:(00) 90000-0000*";
    }else{
        txtCelular.classList.remove('erro');
    }

    if(validarProfissao() || txtProfissao.value == ""){// verifica se estão tudo conforme e coloca uma class para demostrar o erro caso esteja erredo
        txtProfissao.classList.add('erro');
        txtProfissao.placeholder = "Profissão*";
    }else{
        txtProfissao.classList.remove('erro');
    }

    if(!emailValido(txtEmail.value) || txtNome.value == ""){// verifica se estão tudo conforme e coloca uma class para demostrar o erro caso esteja erredo
        txtEmail.classList.add('erro');
        txtNome.placeholder = "Email*";
    }else{
        txtNome.classList.remove('erro');
    }

    if(validarNome() || txtNome.value == ""){// verifica se estão tudo conforme e coloca uma class para demostrar o erro caso esteja erredo
        txtNome.classList.add("erro");
        txtNome.placeholder = "Nome*";
    }else{
        txtNome.classList.remove('erro');
    }

}



// mascaras em Expresão regular 

const mascNomeProfissao = () => {
    if(event.keyCode != 8 && event.keyCode != 127){ // libera a deletação para não validar (del e backSpace)
        let texto = txtNome.value;// atribuindo o conteudo da caixa para a veriavel texto
        let textoP = txtProfissao.value;// atribuindo o conteudo da caixa profissão da caixa para a veriavel texto

        texto = texto.replace(/[^a-zA-Z À-ÿ]/g,""); // atribui a expresão recular para permitir apenas letras
        textoP = textoP.replace(/[^a-zA-Z À-ÿ]/g,"");// atribui a expresão recular para permitir apenas letras

        txtNome.value = texto;  // a caixa recebe a variavel com a explessão regular para exculta o que é permitido
        txtProfissao.value = textoP;  // 
    }
}


const mascTelefone = (event) =>{
    txtTelefone.maxLength = "14";// permiti apenas 14 digitos na caixa
    if(event.keyCode != 8 && event.keyCode != 127){ // liberando a a deletação dos digitos
        let texto = txtTelefone.value;// atribuindo o conteudo da caixa para a veriavel texto
        texto = texto.replace(/[^0-9]/g,"");// libera apenas digitos
        
        texto = texto.replace(/(.)/,"($1");//na primeira casa coloca o '('
        texto = texto.replace(/(.{3})/,"$1)");//na terceira casa colaca o ')'
        texto = texto.replace(/(.{4})/,"$1 ");//na quarta casa coloca 1 espaço
        texto = texto.replace(/(.{9})/,"$1-");// na nona casa coloca um traço para separa as digitos do telefone

        txtTelefone.value = texto;// a caixa recebe a variavel com a explessão regular para exculta o que é permitido
    }
    
}


const mascCelular = (event) =>{
    txtCelular.maxLength = "15";// permiti apenas 14 digitos na caixa

    if(event.keyCode != 8 && event.keyCode != 127){ // liberando a a deletação dos digitos
        let texto = txtCelular.value;// atribuindo o conteudo da caixa para a veriavel texto
        texto = texto.replace(/[^0-9]/g,"");// libera apenas digitos

        texto = texto.replace(/(.)/,"($1");//na primeira casa coloca o '('
        texto = texto.replace(/(.{3})/,"$1)");//na terceira casa colaca o ')'
        texto = texto.replace(/(.{4})/,"$1 ");//na quarta casa coloca 1 espaço
        texto = texto.replace(/(.{10})/,"$1-");// na nona casa coloca um traço para separa as digitos do telefone
        
        txtCelular.value = texto;// a caixa recebe a variavel com a explessão regular para exculta o que é permitido
    }
    
}

//eventos
btn_enviar.addEventListener("click", validacao);// evento que chama a função de validação

txtNome.addEventListener("keyup", (event) => mascNomeProfissao(event));// chama as mascara feita com empressão regular
txtTelefone.addEventListener("keyup", (event) => mascTelefone(event));// chama as mascara feita com empressão regular
txtCelular.addEventListener("keyup", (event) => mascCelular(event));// chama as mascara feita com empressão regular
txtProfissao.addEventListener("keyup", (event) => mascNomeProfissao(event));// chama as mascara feita com empressão regular




function PermitirNumero(caracter){
    if(window.event){
        var numero = caracter.charCode;
    }else{
        var numero = caracter.which;
    };
    //liberabdo numeros
    if(numero < 48 || numero > 57){
        
        if(numero != 40 && numero != 41 && numero != 45){
            return false;
        }
           
    };
}


//validação mobile

//variavel do botão de enviar
const btn_enviar_mobile = document.getElementById('btn_enviar_contato_mobile');

//variaveis das caixas
const txtNome_mobile = document.getElementById('txt_nome_mobile');
const txtTelefone_mobile = document.getElementById('txt_telefone_mobile');
const txtCelular_mobile = document.getElementById('txt_celular_mobile');
const txtEmail_mobile = document.getElementById('txt_email_mobile');
const txthome_mobile = document.getElementById('txt_home_mobile');
const txtFacebook_mobile = document.getElementById('txt_facebook_mobile');
const txtProfissao_mobile = document.getElementById('txt_profissao_mobile');
const txtAreaObs_mobile = document.getElementById('txtArea_observacao_mobile');
const cmbAssunto_mobile = document.getElementById('selectAssunto_mobile');


//validação das caixas com expressão regular
const validacao = () =>{
    
    const validarNome_mobile = () =>{//função que verifica que o que está escrito etá correto
        er = /[^(a-zA-Z Á-ÿ)]+/;
        return er.test(txtNome_mobile.value);
    }
    const validarProfissao_mobile = () =>{//função que verifica que o que está escrito etá correto
        er = /[^(a-zA-Z Á-ÿ)]+/;
        return er.test(txtProfissao_mobile.value);
    }

    const emailValido_mobile = (email_mobile) =>{//função que verifica que o que está escrito etá correto
        const er = /^([a-zA-zÁ-ÿ][a-zÁ-ÿ0-9._-]+@([a-z]+[.]?)+)[a-z]$/;
        return er.test(email_mobile.value);
    }

    const celularValidado_mobile = () =>{//função que verifica que o que está escrito etá correto
        const er = /\([0-9]{2}\) [0-9]{5}-[0-9]{4}/;
        return er.test(txtCelular_mobile.value);
    }

    const validarAreaObs_mobile = () =>{
        const er = /[^(a-zA-Z Á-ÿ 0-9)]/;
        return er.test(txtAreaObs_mobile.value);
    }
    
    //verificar se está tudo correto
    //se não coloca um class erro na caixa requerida
    
    if(validarAreaObs_mobile() || txtAreaObs_mobile.value == ""){ // verifica se estão tudo conforme e coloca uma class para demostrar o erro caso esteja erredo
        txtAreaObs_mobile.classList.add('erro');
        txtAreaObs_mobile.placeholder = "Escrava uma Mensagem corretamente";
    }else{
        txtAreaObs.classList.remove('erro');
    }

    if(cmbAssunto_mobile.value == ""){// verifica se estão tudo conforme e coloca uma class para demostrar o erro caso esteja erredo
        cmbAssunto_mobile.style.color = '#ff0000';
    }else{
        cmbAssunto_mobile.classList.remove('#000000');
    }

    if(celularValidado_mobile() || txtCelular_mobile.value == ""){// verifica se estão tudo conforme e coloca uma class para demostrar o erro caso esteja erredo
        txtCelular_mobile.classList.add('erro');
        txtCelular_mobile.placeholder = "Cel.:(00) 90000-0000*";
    }else{
        txtCelular_mobile.classList.remove('erro');
    }

    if(validarProfissao_mobile() || txtProfissao_mobile.value == ""){// verifica se estão tudo conforme e coloca uma class para demostrar o erro caso esteja erredo
        txtProfissao_mobile.classList.add('erro');
        txtProfissao_mobile.placeholder = "Profissão*";
    }else{
        txtProfissao_mobile.classList.remove('erro');
    }

    if(!emailValido_mobile(txtEmail_mobile.value) || txtEmail_mobile.value == ""){// verifica se estão tudo conforme e coloca uma class para demostrar o erro caso esteja erredo
        txtEmail_mobile.classList.add('erro');
        txtEmail_mobile.placeholder = "Email*";
    }else{
        txtEmail_mobile.classList.remove('erro');
    }

    if(validarNome_mobile() || txtNome_mobile.value == ""){// verifica se estão tudo conforme e coloca uma class para demostrar o erro caso esteja erredo
        txtNome_mobile.classList.add("erro");
        txtNome_mobile.placeholder = "Nome*";
    }else{
        txtNome_mobile.classList.remove('erro');
    }

}



// mascaras em Expresão regular 

const mascNomeProfissao_mobile = () => {
    if(event.keyCode != 8 && event.keyCode != 127){ // libera a deletação para não validar (del e backSpace)
        let texto_mobile = txtNome_mobile.value;// atribuindo o conteudo da caixa para a veriavel texto
        let textoP_mobile = txtProfissao_mobile.value;// atribuindo o conteudo da caixa profissão da caixa para a veriavel texto

        texto_mobile = texto_mobile.replace(/[^a-zA-Z À-ÿ]/g,""); // atribui a expresão recular para permitir apenas letras
        textoP_mobile = textoP_mobile.replace(/[^a-zA-Z À-ÿ]/g,"");// atribui a expresão recular para permitir apenas letras

        txtNome_mobile.value = texto_mobile;  // a caixa recebe a variavel com a explessão regular para exculta o que é permitido
        txtProfissao_mobile.value = textoP_mobile;  // 
    }
}


const mascTelefone_mobile = (event) =>{
    txtTelefone_mobile.maxLength = "14";// permiti apenas 14 digitos na caixa
    if(event.keyCode != 8 && event.keyCode != 127){ // liberando a a deletação dos digitos
        let texto_mobile = txtTelefone_mobile.value;// atribuindo o conteudo da caixa para a veriavel texto
        texto_mobile = _mobile.replace(/[^0-9]/g,"");// libera apenas digitos
        
        texto_mobile = texto_mobile.replace(/(.)/,"($1");//na primeira casa coloca o '('
        texto_mobile = texto_mobile.replace(/(.{3})/,"$1)");//na terceira casa colaca o ')'
        texto_mobile = texto_mobile.replace(/(.{4})/,"$1 ");//na quarta casa coloca 1 espaço
        texto_mobile = texto_mobile.replace(/(.{9})/,"$1-");// na nona casa coloca um traço para separa as digitos do telefone

        txtTelefone_mobile.value = texto_mobile;// a caixa recebe a variavel com a explessão regular para exculta o que é permitido
    }
    
}


const mascCelular_mobile = (event) =>{
    txtCelular_mobile.maxLength = "15";// permiti apenas 14 digitos na caixa

    if(event.keyCode != 8 && event.keyCode != 127){ // liberando a a deletação dos digitos
        let texto_mobile = txtCelular_mobile.value;// atribuindo o conteudo da caixa para a veriavel texto
        texto_mobile = texto_mobile.replace(/[^0-9]/g,"");// libera apenas digitos

        texto_mobile = texto_mobile.replace(/(.)/,"($1");//na primeira casa coloca o '('
        texto_mobile = texto_mobile.replace(/(.{3})/,"$1)");//na terceira casa colaca o ')'
        texto_mobile = texto_mobile.replace(/(.{4})/,"$1 ");//na quarta casa coloca 1 espaço
        texto_mobile = texto_mobile.replace(/(.{10})/,"$1-");// na nona casa coloca um traço para separa as digitos do telefone
        
        txtCelular_mobile_mobile.value = texto_mobile;// a caixa recebe a variavel com a explessão regular para exculta o que é permitido
    }
    
}

//eventos
btn_enviar_mobile.addEventListener("click", validacao);// evento que chama a função de validação

txtNome_mobile.addEventListener("keyup", (event) => mascNomeProfissao_mobile(event));// chama as mascara feita com empressão regular
txtTelefone_mobile.addEventListener("keyup", (event) => mascTelefone_mobile(event));// chama as mascara feita com empressão regular
txtCelular_mobile.addEventListener("keyup", (event) => mascCelular_mobile(event));// chama as mascara feita com empressão regular
txtProfissao_mobile.addEventListener("keyup", (event) => mascNomeProfissao_mobile(event));// chama as mascara feita com empressão regular






//exemplo de validação sem expressão regular e com tabela ascii
// function naoPermitirNumero(caracter){
    
    // if(window.event){
    //     var letra = caracter.charCode;
    // }else{
    //     var letra = caracter.which;
    // };
    // //liberabdo letras maíuscullas
    // if(letra < 65 || letra > 90){
    //     // alert(letra);
    //     //liberando letras minusculas
    //     if(letra < 97 || letra > 122){
    //         //liberando acentuações 
    //         if(letra != 227 && letra != 225 && letra != 168 && letra != 249 && letra != 32){
    //             return false;
    //         };
                    
    //     };

    // };

// };
// para colocar no html é : onkeypress="return naoPermitirNumero(event);"
// espaço  = 32
// 198 = ã
// ~ = 227
// ´ = 225
// 
// 130 = é 
// 160 = á
// 161 = í
// 162 = ó 