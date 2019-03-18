const txtNome = document.getElementById('txt_nome');
const txtTelefone = document.getElementById('txt_telefone');
const txtCelular = document.getElementById('txt_celular');
const txtemail = document.getElementById('txt_email');
const txthome = document.getElementById('txt_home');
const txtFacebook = document.getElementById('txt_facebook');
const txtProficao = document.getElementById('txt_profissao');
const txtAreaSugentao = document.getElementById('txtArea_sugestao');
const txtAreaObs = dosument.getElementById('txtArea_observacao');


function naoPermitirNumero(caracter){
    
    if(window.event){
        var letra = caracter.charCode;
    }else{
        var letra = caracter.which;
    };
    //liberabdo letras maíuscullas
    if(letra < 65 || letra > 90){
        //liberando letras minusculas
        if(letra < 97 || letra > 122){   
            //liberando letra minusculas com acento
            if(letra != 198 && letra != 32){
                return false;
            };
                    
        };

    };

};
// espaço  = 32
//198 = ã
// 130 = é 
// 160 = á
// 161 = í
// 162 = ó 












// EXEMLO DE EXPREÇÃO REGULAR
// const mascNome = () => {
//     let texto = txtNome.value;

//     texto = texto.replace(/[^a-zA-Z À-ÿ]/g,"");

//     txtNome.value = texto;
// }

// txtNome.addEventListener("keyup", mascNome);