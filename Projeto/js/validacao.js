const btn_enviar = document.getElementById('btn_enviar_contato');

const txtNome = document.getElementById('txt_nome');
const txtTelefone = document.getElementById('txt_telefone');
const txtCelular = document.getElementById('txt_celular');
const txtEmail = document.getElementById('txt_email');
const txthome = document.getElementById('txt_home');
const txtFacebook = document.getElementById('txt_facebook');
const txtProfissao = document.getElementById('txt_profissao');
const txtAreaObs = document.getElementById('txtArea_observacao');
const cmbAssunto = document.getElementById('selectAssunto');


const validacao = () =>{
    const validarNome = () =>{
        er = /[^(a-zA-Z Á-ÿ)]+/;
        return er.test(txtNome.value);
    }
    const validarProfissao = () =>{
        er = /[^(a-zA-Z Á-ÿ)]+/;
        return er.test(txtProfissao.value);
    }

    const emailValido = (email) =>{
        const er = /^([a-zA-z][a-z0-9._-]+@([a-z]+[.]?)+)[a-z]$/;
        return er.test(email.value);
    }

    const celularValidado = () =>{
        const er = /\([0-9]{2}\) [0-9]{5}-[0-9]{4}/;
        return er.test(txtCelular.value);
    }

    //(11) 97709-9609
    
    if(txtAreaObs.value == ""){
        txtAreaObs.classList.add('erro');
        txtAreaObs.placeholder = "Escrava Alguma Mensagem";
    }else{
        txtAreaObs.classList.remove('erro');
    }

    if(cmbAssunto.value == ""){
        cmbAssunto.style.color = '#ff0000';
    }else{
        cmbAssunto.classList.remove('#000000');
    }

    if(celularValidado() || txtCelular.value == ""){
        txtCelular.classList.add('erro');
        txtCelular.placeholder = "Cel.:(00) 90000-0000*";
    }else{
        txtCelular.classList.remove('erro');
    }

    if(validarProfissao() || txtProfissao.value == ""){
        txtProfissao.classList.add('erro');
        txtProfissao.placeholder = "Profissão*";
    }else{
        txtProfissao.classList.remove('erro');
    }

    if(!emailValido(txtEmail.value) || txtNome.value == ""){
        txtEmail.classList.add('erro');
        txtNome.placeholder = "Email*";
    }else{
        txtNome.classList.remove('erro');
    }

    if(validarNome() || txtNome.value == ""){
        txtNome.classList.add("erro");
        txtNome.placeholder = "Nome*";
    }else{
        txtNome.classList.remove('erro');
    }

}






// mascaras em Expresão regular 

const mascNomeProfissao = () => {
    if(event.keyCode != 8 && event.keyCode != 127){    
        let texto = txtNome.value;
        let textoP = txtProfissao.value;

        texto = texto.replace(/[^a-zA-Z À-ÿ]/g,"");    
        textoP = textoP.replace(/[^a-zA-Z À-ÿ]/g,"");

        txtNome.value = texto;
        txtProfissao.value = textoP;
    }
}


const mascTelefone = (event) =>{
    txtTelefone.maxLength = "14";
    if(event.keyCode != 8 && event.keyCode != 127){
        let texto = txtTelefone.value;
        texto = texto.replace(/[^0-9]/g,"");
        
        texto = texto.replace(/(.)/,"($1");
        texto = texto.replace(/(.{3})/,"$1)");
        texto = texto.replace(/(.{4})/,"$1 ");
        texto = texto.replace(/(.{9})/,"$1-");

        txtTelefone.value = texto;
    }
    
}


const mascCelular = (event) =>{
    txtCelular.maxLength = "15";

    if(event.keyCode != 8 && event.keyCode != 127){
        let texto = txtCelular.value;
        texto = texto.replace(/[^0-9]/g,"");
        texto = texto.replace(/(.)/,"($1");
        texto = texto.replace(/(.{3})/,"$1)");
        texto = texto.replace(/(.{4})/,"$1 ");
        texto = texto.replace(/(.{10})/,"$1-");
        txtCelular.value = texto;
    }
    
}











btn_enviar.addEventListener("click", validacao);

txtNome.addEventListener("keyup", (event) => mascNomeProfissao(event));
txtTelefone.addEventListener("keyup", (event) => mascTelefone(event));
txtCelular.addEventListener("keyup", (event) => mascCelular(event));
txtProfissao.addEventListener("keyup", (event) => mascNomeProfissao(event));




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