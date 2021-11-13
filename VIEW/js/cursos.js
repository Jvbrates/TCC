import { loadCSS, confirma } from '../js/funcoes.js';

loadCSS("css/instituicoes.css");



var varivel = await fetch('http://localhost/TCC/cursos/get',
    {
        method: 'GET',
        credentials: 'same-origin'
    }).then(
        function (el) {
            return el.json();
        }
    )




function precnheLinha(obj) {
    console.log(obj);
    let linha = tbody.insertRow();
    //linha = window.linha;
    linha.insertCell().innerHTML = obj.CURSO;
    linha.insertCell().innerHTML = obj.INSTITUIÇÂO;
    linha.insertCell().innerHTML = obj.CIDADE;
    let acoes = linha.insertCell();
    acoes.innerHTML += '<input type=checkbox class="visivel" id="' + obj.idCurso + '"  >'
    acoes.innerHTML += '<a type="button" id="' + obj.idCurso + '" class="btn btn-primary view"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/></svg></a>';
    acoes.innerHTML += '<a type="button" id="' + obj.idCurso + '" href="#" class="btn btn-success update"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg></a>';
    acoes.innerHTML += '<a type="button" id="' + obj.idCurso + '"class="btn btn-danger delete" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash " viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg></a>';
    obj.visivel == "0" ? document.getElementById(obj.idCurso).checked = false : document.getElementById(obj.idCurso).checked = true;
}
var table = document.getElementById('js-table');
var tbody = table.createTBody();

varivel.forEach(precnheLinha);


//checkbox
let visivelCheckbox = Array.prototype.slice.call(document.getElementsByClassName('visivel'));

visivelCheckbox.forEach(el => {

    el.addEventListener('click', input => {

        console.log('input');//Aqui vai a função que altera a visibilidade
        visivelFetch(el);
    })
});

async function visivelFetch(input) {
    let data = new FormData();
    data.append('check', input.checked);
    console.log(input.checked);
    await fetch('http://localhost/TCC/cursos/visivel/' + input.id, {
        method: 'POST',
        credentials: 'same-origin',
        body: data,
    }).then(

        tst => {
            if (tst.ok) {
                console.log('Funcionando');
            } else {


            }
        }
    )
}

//Delete


let deleteArray = Array.prototype.slice.call(document.getElementsByClassName('delete'));




deleteArray.forEach(el => {

    el.addEventListener('click', input => {
        {
            if(confirm('Você tem certeza?')){
                el.parentElement.parentElement.remove();
            fetch('http://localhost/TCC/cursos/delete/' + el.id, {
                method: 'DELETE',
                credentials: 'same-origin',
            }).then(
        
                tst => {
                    if (tst.ok) {
                        console.log(el.parentElement);
                    } else {
        
        
                    }
                }
            )
            }
            
        }
    });
});

//Update

let updateArray = Array.prototype.slice.call(document.getElementsByClassName('update'));

updateArray.forEach( el => {
    el.addEventListener('click', update => {
        update.preventDefault();
        window.location.href = 'http://localhost/TCC/cursos/update/?id='+el.id;
    })//TODO padronizar parametros em variaveis de url
})

// View
let viewArray = Array.prototype.slice.call(document.getElementsByClassName('view'));

viewArray.forEach( el => {
    el.addEventListener('click', view => {
        view.preventDefault();
        window.location.href = 'http://localhost/TCC/cursos/view/'+el.id;
    })//TODO padronizar parametros em variaveis de url
})