const cep = document.getElementById('txt_cep');
const logradouro = document.getElementById('txt_logradouro');
const bairro = document.getElementById('txt_bairro');
const cidade = document.getElementById('txt_cidade');
const numero = document.getElementById('txt_numero');
const estado = document.getElementById('txt_estado');

const btn_cadastrar_loja = document.getElementById('cadastrar_sobre');

// MANIPULANDO URL
const trazerEndereco = () =>{
    // pagando o valor da variavel
    let numeroCep = cep.value;
   // alert(numeroCep);
   //ultilizando ajax para mandar dados para o php
    $.ajax({
        type:"GET",
        url:"./util/getEndereco.php",
        data:{numeroCep:numeroCep},
        complete: function(response){
            let json_endereco = JSON.parse(response.responseText);
            console.log(json_endereco);
            preencherEndereco(json_endereco);
            numero.focus();            
        },
        error:function(){
            alert("Cep insuficiente");
        }
    });

   
};

//função que está preenchendo os campos de endereço
const preencherEndereco= (dadosJson) =>{
    logradouro.value = dadosJson.logradouro;
    bairro.value = dadosJson.bairro;
    cidade.value = dadosJson.cidade;
    estado.value = dadosJson.estado;
}


// VALIDAÇÃO

const mascaraCep = (event) =>{
    cep.maxLength = 9;
    if(event.keyCode != 8 && event.keyCode != 127){ // liberando a a deletação dos digitos
        let texto = cep.value;// atribuindo o conteudo da caixa para a veriavel texto
        texto = texto.replace(/[^0-9]/g,"");// libera apenas digitos
     
        texto = texto.replace(/(.{5})/, "$1-");

        cep.value = texto;// a caixa recebe a variavel com a explessão regular para exculta o que é permitido
    }
}

const mascNumero = (event) => {
    numero.maxLength = 4;
    if(event.keyCode != 8 && event.keyCode != 127){ // liberando a a deletação dos digitos
        let texto = numero.value;// atribuindo o conteudo da caixa para a veriavel texto
        texto = texto.replace(/[^0-9A-Za-z]/g,"");// libera apenas digitos e letras
    
        numero.value = texto;// a caixa recebe a variavel com a explessão regular para exculta o que é permitido
    }
}

const bloquearDigitacao = (caixa) =>{
    caixa.readonly = true;
}

//listener da caixa
cep.addEventListener('change', trazerEndereco);
//colocando mascara
cep.addEventListener("keyup", (event) => mascaraCep(event));
numero.addEventListener("keyup", (event) => mascNumero(event));
//bloquendo as caixas para de ditação
// logradouro.addEventListener('change', bloquearDigitacao(logradouro));
// bairro.addEventListener('change', bloquearDigitacao(bairro));
// estado.addEventListener('change', bloquearDigitacao(estado));
// cidade.addEventListener('change', bloquearDigitacao(cidade));
