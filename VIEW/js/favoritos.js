import { loadCSS, confirma } from '../js/funcoes.js';

loadCSS("css/instituicoes.css");

async function main() {
    await fetch('http://localhost/TCC/user/favoritos/getFav', {
        credentials: 'same-origin'
    })
        .then(res => res.json())
        .then(json => {
            let tbody = document.getElementsByTagName('tbody')[0];
            json.map((value) => {
                let linha = document.createElement('tr');

                let curso = document.createElement('th');
                curso.textContent = value.nomeCurso;

                let instituicao = document.createElement('th');
                instituicao.textContent = value.nomeInstituicao;

                let check = document.createElement('th');
                let checkbox = document.createElement('input');
                checkbox.type = "checkbox";
                checkbox.classList.add('form-check-input');
                checkbox.checked = true;
                checkbox.id = value.idCurso;
                check.appendChild(checkbox);

                linha.appendChild(curso);
                linha.appendChild(instituicao);
                linha.appendChild(check);

                curso.style.cursor = "pointer"
                curso.onclick = ()=>{
                    
                    document.location.href = "http://localhost/TCC/cursos/view/"+value.idCurso
                }
                tbody.appendChild(linha);


            })
        })

    let Checkbox = Array.prototype.slice.call(document.querySelectorAll('.form-check-input:not(#cores)'));
    Checkbox.map(element => {
        element.addEventListener('click', el => {
            fetch('http://localhost/TCC/user/toggleFav/' + element.id, {
                credentials: 'same-origin',
                method: 'POST'
            })
                .then(res => {
                    if (!res.ok) {
                        document.getElementById(element.id).checked = !(document.getElementById(element.id).checked);
                    }
                })
            console.log('Chegado aqui')
            if (!element.checked) {
                element.parentElement.parentElement.remove();
            }
        })

    })

}

main();