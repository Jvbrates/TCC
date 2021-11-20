import { loadCSS, confirma } from '../js/funcoes.js';

loadCSS("css/instituicoes.css");

const table = document.getElementById('js-table');
const tbody = table.createTBody();
const del = document.getElementsByClassName('delete');

const calback = element => { // Preenche tabela com valor passado em variavel
    let linha = tbody.insertRow();
    element.tipo == "0" ? element.tipo = "Usuário" : element.tipo = "Moderador";
    Object.values(element).forEach(innerelement => {

        var cell = linha.insertCell();
        cell.innerHTML = innerelement;
    });
    linha.insertCell().innerHTML += '<a type="button" class="btn btn-danger delete" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash " viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg></a>';
    let del = document.getElementsByClassName('delete');
    del[del.length - 1].addEventListener('click', function (s) {
        s.preventDefault();
        deleta(element.nome, this);
    })

}


function deleta(id, element) {
    let data = new FormData();
    data.append('id', id);
    
    if (window.confirm('Você tem certeza?')) {
        fetch("http://localhost/TCC/user/dell/", {
            method: 'POST',
            body: data
        }).then(function () {
            element.parentElement.parentElement.remove();
            console.log(element.parentElement.parentElement);
        }
        )
    }
}

variavel.forEach(calback);
