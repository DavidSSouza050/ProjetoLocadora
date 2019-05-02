//atribuição de variaveis
const txt_promocao = document.getElementById('txt_promocao');

//mascaras
const mascaraPorcentagem = (event) =>{
    txt_promocao.maxLength = "2";
    if(event.keyCode != 8 && event.keyCode != 127){ // liberando a a deletação dos digitos
        let texto = txt_promocao.value;// atribuindo o conteudo da caixa para a veriavel texto
      
        texto = texto.replace(/[^0-9]/g,"");// libera apenas digitos e letras
    

        txt_promocao.value = texto;// a caixa recebe a variavel com a explessão regular para exculta o que é permitido
    }
}




//ouvintes
txt_promocao.addEventListener("keyup", (event) => mascaraPorcentagem(event));