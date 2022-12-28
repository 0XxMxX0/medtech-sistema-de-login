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

    if(senhaValue != ''){
        if(loginValue != ''){
            let botaoClass = botao.className = "btn_entrar";
        }
    }
}
