//reaproveitar validação de email

const nome = document.getElementById('nome');
const email = document.getElementById('email');
const formulario = document.getElementById('formLogin');
const senhas = document.querySelectorAll('input[type=password]');
const alertDiv = document.getElementById('alert_wrapper');
var verNome = false;
var verEmail = false;

var verificador = true;

//Verifica disponibilidade do nome de usuario
nome.onblur = function () {
    console.log('Saiu do foco');
    let dados = new FormData(formulario);
    if (nome.value != "") {
        fetch('http://localhost/TCC/login/verNome', {
            method: 'POST',
            body: dados,

        })
            .then(function (response) {
                if (response.status == 202) {
                    console.log(response.status);
                    nome.style.border = '';
                    verNome = nome;
                    nome.placeholder = "Nome de usuário";
                } else {
                    console.log(response.status);
                    verNome = false;
                    nome.value = "";
                    nome.placeholder = "Nome de usuário já em uso";
                    nome.style.border = '1px solid red';
                }
            })
    }
};

//Verifica a disposição do email
email.onblur = function () {
    console.log('Saiu do foco');
    let dados = new FormData(formulario);
    if (validaEmail(email)) {
        if (email.value != "") {
            fetch('http://localhost/TCC/login/verEmail', {
                method: 'POST',
                body: dados,

            })
                .then(function (response) {
                    if ((response.status == 202) || (email.value.trim() == '')) {
                        console.log(response.status);
                        email.style.border = '';
                        verEmail = true;
                        email.placeholder = "Email";
                    } else {
                        verEmail = false;
                        email.style.border = '1px solid red';
                        email.value = "";
                        email.placeholder = "Email já em uso";
                    }
                })
        }
    } else {
        email.style.border = '1px solid red';
        email.value = "";
        email.placeholder = "Insira um formato correto de email";
    }
};



//Valida formato email
function validaEmail(emailElement) {
    var usuario = emailElement.value.substring(0, emailElement.value.indexOf("@"));
    var dominio = emailElement.value.substring(emailElement.value.indexOf("@")+1, emailElement.value.length);

    if ((usuario.length >= 1) &&
        (dominio.length >= 3) && 
        (usuario.search("@")==-1) &&
        (dominio.search("@")==-1) &&
        (usuario.search(" ")==-1) &&
        (dominio.search(" ")==-1) &&
        (dominio.search(".")!=-1) &&
        (dominio.indexOf(".")>=1)&&
        (dominio.lastIndexOf(".") < dominio.length - 1)) 
         {
        return true;
    } else {
        return false;
        
    }
}
