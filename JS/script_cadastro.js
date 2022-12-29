let entrar = document.getElementById('effect-form-logar');
function mouseover(){
    let loginStyle = entrar.style.border = 'none';
}
function mouseout() {
    let loginStyle = entrar.style = 'border-bottom: 4px solid #e5c1eb;';
}

// Validação dos campos para ver se estão vazios
let inputs = document.querySelectorAll('input');
let erro;
let inputClicadoErro;
let clickfora;
// console.log(inputs)
let nome = inputs[0];
let login = inputs[1];
let senha = inputs[2];
let confirmarSenha = inputs[3];
let botao = inputs[4];

function validacaoBotao(){
    nomeValue = nome.value;
    loginValue = login.value;
    senhaValue = senha.value;
    confirmarSenhaValue = confirmarSenha.value;

    if(senhaValue == confirmarSenhaValue){
        let li = document.getElementById('mensagem-aviso');
        let existencia = document.body.contains(li);
        if(existencia == true){
            li.style.display = 'none'; 
        }

        if(nomeValue != ''){
            if( confirmarSenhaValue != ''){
                if(senhaValue != ''){
                    if(loginValue != ''){
                        let botaoClass = botao.className = "btn-on";
                    } else {
                        let botaoClass = botao.className = "btn-off";
                    }
                } else {
                    let botaoClass = botao.className = "btn-off";
                }
            } else {
                let botaoClass = botao.className = "btn-off";
            }
        } else {
            let botaoClass = botao.className = "btn-off";
        }
    } else {
        let botaoClass = botao.className = "btn-off";
    }
};

let count = 0;

function estadoDaSenha(elemento) {
    let id = elemento.id;
    let img = elemento;
    let inputType = inputs[id]

    console.log(img)
    if(count == 1){
        img.src = 'IMG/icon-aberto.png';
        inputType.type = 'password';
        count = 0
    } else if(count == 0){
        img.src = 'IMG/icon-fechado.png';
        inputType.type = 'text';
        count++;
    }
}