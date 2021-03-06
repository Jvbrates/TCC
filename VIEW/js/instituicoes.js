import { loadCSS } from '../js/funcoes.js';

loadCSS("css/instituicoes.css");
//--------------------------------------------------------------
function confirma(id) {
    if(window.confirm('Você tem certeza que deseja fazer isso?')){
       // window.location.href = "http://localhost/TCC/instituicoes/dell/"+id;
       let data = new FormData();
       data.append('id', id);
        fetch("http://localhost/TCC/instituicoes/dell/", {
            method: 'POST',
            body: data
        }).then(function(){
            location.reload();  }
        )
        //location.reload();
    }
}

const table = document.getElementById('js-table');
const tbody = table.createTBody();


let a = function () {
    fetch('http://localhost/TCC/instituicoes/getAll/',{ credentials:"same-origin"})
        .then(function (json) {
            return json.json();

        })
        .then(function (obj) {


            obj.forEach(element => {

                console.log(Object.values(element));
                let row = tbody.insertRow();

                Object.values(element).slice(1).forEach(insideElement => {
                    let cell = row.insertCell();
                    cell.innerHTML = insideElement;


                })
                let cell = row.insertCell();

                cell.innerHTML += '<a type="button" class="btn btn-primary" href="http://localhost/TCC/instituicoes/view/'+Object.values(element)[0]+'" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/></svg></a>';
                cell.innerHTML += '<a type="button" href="http://localhost/TCC/instituicoes/update/'+Object.values(element)[0]+' "class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg></a>';
                cell.innerHTML += '<a type="button" class="btn btn-danger delete" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash " viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg></a>';

                let del = document.getElementsByClassName('delete')
                del[del.length-1].addEventListener('click', function (s) {
                    s.preventDefault();
                    confirma(Object.values(element)[0]);
                })


            });
        })

}
a();

