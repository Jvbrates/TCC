import { preencheCidade, preencheInstituições, preencheUF, preencheTipo } from './module/formcurso.js';

async function localização() {
    preencheInstituições();
    preencheTipo();
    await preencheUF();
    await preencheCidade(document.getElementById('UF').childNodes[document.getElementById('UF').selectedIndex + 1].id);
    await edit();

    console.log(defaults)
}

localização();

var defaults = [];
const idCurso = new URLSearchParams(window.location.search).get('id');


async function edit() {

    return await fetch('http://localhost/TCC/cursos/getFull/' + idCurso, {
        method: 'GET',
        credentials: 'same-origin'
    })
        .then(res => res.json())
        .then(async json => {

            console.log(json);

            document.getElementsByTagName('input')[0].value = json.nomeCurso;
            defaults.push(json.nomeCurso);

            document.getElementsByTagName('textarea')[0].value = json.Descrição;
            defaults.push(json.Descrição);
            console.log(document.querySelectorAll('input[type="radio"]')[json.modalidade]);
            document.querySelectorAll('input[type="radio"]')[json.modalidade].checked = true;
            defaults.push(json.modalidade);

            document.querySelector('select').selectedIndex = json.turno;
            defaults.push(json.turno);

            document.querySelector('input[type="number"').value = json.duracao;
            defaults.push(json.duracao);

            document.querySelectorAll('select')[1].selectedIndex = json.tipoDuracao;
            defaults.push(json.tipoDuracao);

            document.getElementById('UF').selectedIndex = parseInt(json.idESTADO) - 1;
            defaults.push(parseInt(json.idESTADO) - 1);

            document.getElementById('cidade').innerHTML = '';

            await preencheCidade(document.getElementById('UF').childNodes[document.getElementById('UF').selectedIndex + 1].id);
            document.querySelector('option[value="' + json.idCIDADE + '"]').selected = true;
            defaults.push(json.idCIDADE);

            document.getElementById('tipoCurso').selectedIndex = parseInt(json.idtipoCurso) - 1;
            defaults.push(json.idtipoCurso);

            document.querySelector('#instituicoes option[value="' + json.idInstituicao + '"]').selected = true;
            defaults.push(json.idInstituicao);

        })

}

document.getElementById("UF").addEventListener('click', el => {
    preencheCidade(document.getElementById('UF').childNodes[document.getElementById('UF').selectedIndex + 1].id);
})



document.querySelector('button[type="submit"]').addEventListener('click', el => {
    el.preventDefault();


    var fdata = new FormData(document.getElementsByTagName('form')[0]);
    var object = {};
    fdata.forEach((value, key) => object[key] = value);
    var json = JSON.stringify(object);
    console.log(json, object);

    fetch('http://localhost/TCC/cursos/edit/'+idCurso, {
        credentials: 'same-origin',
        method: 'PUT',
        body: json
    })//TODO Adicionar MOdal indicando quais foram editados
    // TODO button Editar Inativo até input ser selecionado
    .then( res => {
        if(res.ok){
            document.location.reload();
        } else {
            console.log('Falha no update');
        }
    }
        
    );
})