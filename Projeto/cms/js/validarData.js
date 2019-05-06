const data_nasci_ator = document.getElementById('data_naci_ator');



const mascaraData = (event) => {
    data_nasci_ator.maxLength = 10;
    if(event.keyCode != 8 && event.keyCode != 127){ // liberando a a deletação dos digitos
        let texto = data_nasci_ator.value;// atribuindo o conteudo da caixa para a veriavel texto
        texto = texto.replace(/[^0-9]/g,"");// libera apenas digitos 
        
        texto = texto.replace(/(..)/,"$1/");
        texto = texto.replace(/(.{5})/,"$1/");

        data_nasci_ator.value = texto;// a caixa recebe a variavel com a explessão regular para exculta o que é permitido
    }
}







//colocando mascara
data_nasci_ator.addEventListener("keyup", (event) => mascaraData(event));
