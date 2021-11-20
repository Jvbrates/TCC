import { loadCSS } from './module/funcoes.js';

loadCSS('css/homepage.css');

import { preencheCidade, preencheInstituições, preencheUF, preencheTipo } from './module/formcurso.js';
async function localização() {
    preencheInstituições();
    await preencheUF();
    await preencheCidade(document.getElementById('UF').childNodes[document.getElementById('UF').selectedIndex + 2].id);
}

localização()


document.getElementById("UF").addEventListener('click', el => {
    preencheCidade(document.getElementById('UF').childNodes[document.getElementById('UF').selectedIndex + 2].id);
})


const botao = document.getElementById('submit');
const resultadoContainer = document.getElementById('resultadoContainer');

submit.addEventListener('click', event => {
    event.preventDefault();

    let form = document.getElementsByTagName('form')[1];
    let data = new FormData();

    data.append('busca', form.getElementsByTagName('input')[0].value);
    data.append('busca', form.getElementsByTagName('input')[0].value);
    if (form.querySelectorAll('input[type="checkbox"]')[0].checked == form.querySelectorAll('input[type="checkbox"]')[1].checked) {
        data.append('modalidade', '');
    } else if (form.querySelectorAll('input[type="checkbox"]')[0].checked) {
        data.append('modalidade', '0');
    } else if (form.querySelectorAll('input[type="checkbox"]')[1].checked) {
        data.append('modalidade', '1');
    }

    data.append('turno', form.getElementsByTagName('select')[0].value);
    data.append('cidade', form.getElementsByTagName('select')[2].value)
    data.append('instituicao', form.getElementsByTagName('select')[4].value);
    data.append('tipo', form.getElementsByTagName('select')[3].value);

    


    fetch('http://localhost/TCC/home/search', {
        method: 'POST',
        body: data
    })
        .then(res => res.json())
        .then(json => {
            resultadoContainer.innerHTML = '';


            json.map((element) => {

                console.log(element)
                console.log('Aqui ficaria o elemento')
                let cursoCard = document.createElement('div');
                cursoCard.classList.add('cursoCard');
                cursoCard.classList.add('card', 'mb-3');

                let row = document.createElement('div');
                row.classList.add('row', 'gp-0', 'p-2');

                let conteudo = document.createElement('div');
                conteudo.classList.add('col-md-12', 'mg-0', 'ps-5', 'cardCont', 'text-center');

                let vr = document.createElement('div');
                vr.classList.add('vr');

                let botao = document.createElement('div');
                botao.id = 'contBotao'

                let cardBody = document.createElement('div');


                botao.classList.add('col-md', 'mg-0');
                botao.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-arrow-right-square" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm4.5 5.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/> </svg>';
                row.onclick = function(){
                    window.location.href = 'http://localhost/TCC/cursos/view/'+element.IdCurso;
                } 
                //Preenche conteudo
                let nome = document.createElement('h5');
                nome.classList.add('card-title', 'text-center', 'highlight');
                nome.textContent = element.CURSO;

                let instituicao = document.createElement('div');
                instituicao.textContent = element.INSTITUIÇÂO;

                let modalidade = document.createElement('div');
                console.log('Aqui ficaria o elemento')
                console.log(element.modalidade)
                switch (element.modalidade) {
                    case '0':

                        modalidade.textContent = 'Modalidade: Presencial'
                        break;

                    case '1':
                        modalidade.textContent = 'Modalidade: Ensino à Distancia'
                        break;
                }

                let tipo = document.createElement('div');
                
                switch (element.idtipoCurso) {
                    case '1':
                        tipo.textContent = 'Tipo: Profissionalizante';
                        break;

                    case '2':
                        tipo.textContent = 'Tipo: Técnico';
                        break;

                    case '3':
                        tipo.textContent = 'Tipo: Graduação - Técnologo';
                        break;

                    case '4':
                        tipo.textContent = 'Tipo: Graduação - Bacharel';
                        break;

                    case '5':
                        tipo.textContent = 'Tipo: Graduação - Licenciatura';
                        break;

                    case '6':
                        tipo.textContent = 'Tipo: Pós-graduação - Lato sensu';
                        break;

                    case '7':
                        tipo.textContent = 'Pós-graduação - Stricto sensu';
                        break;
                }

                let local = document.createElement('div');
                local.textContent = element.CIDADE + " - " + element.UF;

                let turno = document.createElement('div');
                

                    switch (element.turno) {
                        case "0":
                            turno.textContent = "Turno: Manhã";
                            break;
                        case "1":
                            turno.textContent = "Turno: Tarde";
                            break;
                        case "2":
                            turno.textContent = "Turno: Noite";
                            break;
                        case "3":
                            turno.textContent = "Turno: Integral Matutino";
                            break;
                        case "4":
                            turno.textContent = "Turno: Integral Vespertino";
                            break;
                        case "5":
                            turno.textContent = "Turno: Flexível";
                            break;
                    }



                cardBody.appendChild(nome);
                cardBody.appendChild(instituicao);
                cardBody.appendChild(modalidade);
                cardBody.appendChild(tipo);
                cardBody.appendChild(local);
                cardBody.appendChild(turno);
                conteudo.appendChild(cardBody);
                row.appendChild(conteudo);
               
                cursoCard.appendChild(row);
                resultadoContainer.appendChild(cursoCard);
            })



        })
})
