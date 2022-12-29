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
let login = inputs[0];
let senha = inputs[1];
let botao = inputs[2];

function validacaoBotao(){
    loginValue = login.value;
    senhaValue = senha.value;
    let li = document.getElementById('mensagem-aviso');
    let existencia = document.body.contains(li);
    
    if(existencia == true){
        li.style.display = 'none'; 
    }

    if(senhaValue != ''){
        if(loginValue != ''){
            let botaoClass = botao.className = "btn_entrar";
        } else {
            let botaoClass = botao.className = "btn_entrar_off";
        }
    } else {
        let botaoClass = botao.className = "btn_entrar_off";
    }
}

let count = 0;

function estadoDaSenha(elemento) {
    let img = elemento;
    if(count == 1){
        img.src = 'IMG/icon-aberto.png';
        senha.type = 'password';
        count = 0
    } else if(count == 0){
        img.src = 'IMG/icon-fechado.png';
        senha.type = 'text';
        count++;
    }
}