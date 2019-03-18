const txtNome = document.getElementById('txt_nome');
const txtTelefone = document.getElementById('txt_telefone');
const txtCelular = document.getElementById('txt_celular');
const txtEmail = document.getElementById('txt_email');
const txthome = document.getElementById('txt_home');
const txtFacebook = document.getElementById('txt_facebook');
const txtProfissao = document.getElementById('txt_profissao');
const txtAreaSugentao = document.getElementById('txtArea_sugestao');
const txtAreaObs = document.getElementById('txtArea_observacao');








// mascaras em Expresão regular 

const mascNomeProfissao = () => {
    let texto = txtNome.value;
    let textoP = txtProfissao.value;

    texto = texto.replace(/[^a-zA-Z À-ÿ]/g,"");    
    textoP = textoP.replace(/[^a-zA-Z À-ÿ]/g,"");

    txtNome.value = texto;
    txtProfissao.value = textoP;
}


const mascTelefone = () =>{
    txtTelefone.maxLength = "14";
    let texto = txtTelefone.value;
    texto = texto.replace(/[^0-9]/g,"");
    
    texto = texto.replace(/(.)/,"($1");
    texto = texto.replace(/(.{3})/,"$1)");
    texto = texto.replace(/(.{4})/,"$1 ");
    texto = texto.replace(/(.{9})/,"$1-");

    txtTelefone.value = texto;
}


const mascCelular = () =>{
    txtCelular.maxLength = "15";
    let texto = txtCelular.value;
    texto = texto.replace(/[^0-9]/g,"");
    
    texto = texto.replace(/(.)/,"($1");
    texto = texto.replace(/(.{3})/,"$1)");
    texto = texto.replace(/(.{4})/,"$1 ");
    texto = texto.replace(/(.{10})/,"$1-");

    txtCelular.value = texto;
}


const emailValido = (email) =>{
    const er = /^([a-zA-z][a-z0-9._-]+@([a-z]+[.]?)+)[a-z]$/;
    return er.test(email);
}


const removerErro = () =>{
    elemento.classList.remove ("erro");
}






txtEmail.addEventListener("change", () => removerErro(txtEmail));
txtCelular.addEventListener("change", () => removerErro(txtCelular));
txtNome.addEventListener("change", () => removerErro(txtNome));

txtNome.addEventListener("keyup", mascNomeProfissao);
txtTelefone.addEventListener("keyup", mascTelefone);
txtCelular.addEventListener("keyup", mascCelular);
txtProfissao.addEventListener("keyup", mascNomeProfissao);


// function naoPermitirNumero(caracter){
    
//     if(window.event){
//         var letra = caracter.charCode;
//     }else{
//         var letra = caracter.which;
//     };
//     //liberabdo letras maíuscullas
//     if(letra < 65 || letra > 90){
//         // alert(letra);
//         //liberando letras minusculas
//         if(letra < 97 || letra > 122){
//             //liberando acentuações 
//             if(letra != 227 && letra != 225 && letra != 168 && letra != 249 && letra != 32){
//                 return false;
//             };
                    
//         };

//     };

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
