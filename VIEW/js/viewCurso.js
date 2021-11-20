import { loadCSS } from '/TCC/VIEW/js/funcoes.js';
loadCSS("css/viewCurso.css");

const cursoID = document.URL.split('/')[document.URL.split('/').length - 1];
document.getElementById('fav').style.color = "var(--font-color)";
fetch('http://localhost/TCC/cursos/getFullv/' + cursoID, {
    credentials: 'same-origin'
})
    .then(res => res.json())
    .then(json => {
        
        if (json.log == 0) {
            let check = document.createElement('input');
            document.getElementById('fav').onclick = () => {
            check.click();
            }
            check.style.display = "none";
            check.type = 'checkbox';
            check.classList.add('form-check-input', 'ms-5');
            document.getElementById('contTitulo').appendChild(document.createElement('span').appendChild(check));
            check.checked = false;

            fetch('http://localhost/TCC/user/favoritos/getFav', {
                credentials: 'same-origin'
            })
                .then(res => res.json())
                .then(json => {
                    json.map((value) => {
                        if (value.idCurso == cursoID) {
                            check.checked = true;
                            document.getElementById('fav').style.color = "var(--theme)"
                        } else {
                            document.getElementById('fav').style.color = "var(--font-color)"
                        }
                    })
                })
            check.addEventListener('click', el => {
                fetch('http://localhost/TCC/user/toggleFav/' + cursoID, {
                    credentials: 'same-origin',
                    method: 'POST'
                })
                    .then(res => {
                        if (!res.ok) {
                            document.getElementById(check.id).checked = !(document.getElementById(check.id).checked);
                        }
                    })
                    .then(res => {
                        if(check.checked){
                            console.log('Aqui?')
                            document.getElementById('fav').style.color = "var(--theme)"
                        } else {
                            document.getElementById('fav').style.color = "var(--font-color)"
                        }
                    })

                
            })
        } else if (json.log == 9){
            let check = document.createElement('input');
            document.getElementById('fav').onclick = () => {
                check.click();
                }
                check.style.display = "none";
            check.type = 'checkbox';
            check.classList.add('form-check-input', 'ms-5');
            document.getElementById('contTitulo').appendChild(document.createElement('span').appendChild(check));
            check.checked = false;

            check.onclick  = function(){ window.location.href = "http://localhost/TCC/user/favoritos" }
        }
        console.log(json)
        document.getElementsByTagName('h3')[0].textContent = json[0].nomeCurso;
        document.getElementsByTagName('p')[0].textContent = json[0].Descrição;

        switch (json[0].idtipoCurso) {
            case '1':
                document.querySelectorAll('#info span')[0].textContent = 'Tipo: Profissionalizante';
                break;

            case '2':
                console.log('adfsd');
                document.querySelectorAll('#info span')[0].textContent = 'Tipo: Técnico';
                break;

            case '3':
                document.querySelectorAll('#info span')[0].textContent = 'Tipo: Graduação - Técnologo';
                break;

            case '4':
                document.querySelectorAll('#info span')[0].textContent = 'Tipo: Graduação - Bacharel';
                break;

            case '5':
                document.querySelectorAll('#info span')[0].textContent = 'Tipo: Graduação - Licenciatura';
                break;

            case '6':
                document.querySelectorAll('#info span')[0].textContent = 'Tipo: Pós-graduação - Lato sensu';
                break;

            case '7':
                document.querySelectorAll('#info span')[0].textContent = 'Pós-graduação - Stricto sensu';
                break;
        }

        switch (json[0].modalidade) {
            case '0':
                document.querySelectorAll('#info span')[1].textContent = 'Modalidade: Presencial'
                break;

            case '1':
                document.querySelectorAll('#info span')[1].textContent = 'Modalidade: Ensino à Distancia'
                break;
        }

        switch (json[0].turno) {
            case "0":
                document.querySelectorAll('#info span')[2].textContent = "Turno: Manhã";
                break;
            case "1":
                document.querySelectorAll('#info span')[2].textContent = "Turno: Tarde";
                break;
            case "2":
                document.querySelectorAll('#info span')[2].textContent = "Turno: Noite";
                break;
            case "3":
                document.querySelectorAll('#info span')[2].textContent = "Turno: Integral Matutino";
                break;
            case "4":
                document.querySelectorAll('#info span')[2].textContent = "Turno: Integral Vespertino";
                break;
            case "5":
                document.querySelectorAll('#info span')[2].textContent = "Turno: Flexível";
                break;
        }

        document.querySelectorAll('#info span')[3].textContent += json[0].duracao;
        switch (json[0].tipoDuracao) {
            case "0":
                document.querySelectorAll('#info span')[3].textContent += " Horas";
                break;

            case "1":
                document.querySelectorAll('#info span')[3].textContent += " Semestres";
                break;

            case "2":
                document.querySelectorAll('#info span')[3].textContent += " Anos";
        }

        document.querySelectorAll('#info span')[4].textContent += json[0].CIDADE + ' - ' + json[0].UF

        
        fetch('http://localhost/TCC/instituicoes/getFull/' + json[0].idInstituicao)
            .then(res => res.json())
            .then(json => {
                console.log(json)
                document.getElementById('titulo').textContent = json[0].nomeInstituicao;
                document.getElementById('sobre').textContent = json[0].sobre;

                document.querySelectorAll('#infoI span')[0].textContent += json[0].fone;
                document.querySelectorAll('#infoI span')[1].textContent += json[0].email;
                document.querySelectorAll('#infoI span')[2].innerHTML += "<a href='"+json[0].site+"'>"+json[0].site+"</a>";
                document.querySelectorAll('#infoI span')[3].textContent += json[0].endereco;
                let lat = parseFloat(json[0].localizacao.split('|')[0]);
                let lng = parseFloat(json[0].localizacao.split('|')[1]);
                var map_parameters = { center: { lat: lat, lng: lng }, zoom: 16 };
                var map = new google.maps.Map(document.getElementById('map'), map_parameters);
                var marker = new google.maps.Marker({

                    title: "Hello World!",
                    position: { lat: lat, lng: lng },
                });

                marker.setMap(map);
            })

        let data = new FormData();

        data.append('busca', '');

        data.append('modalidade', '');


        data.append('turno', '');
        data.append('cidade', '')
        data.append('instituicao', json[0].idInstituicao);
        console.log('Pré Search');
        fetch('http://localhost/TCC/home/search', {
            method: 'POST',
            body: data
        })
            .then(res => res.json())
            .then(json => {
                console.log('Algo??');
                resultadoContainer.innerHTML = '';


                json.map((element) => {
                    console.log('aaaa');
                    console.log(element)

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

            console.log('Pos Search');
    })


