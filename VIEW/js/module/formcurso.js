export { preencheInstituições, preencheUF, preencheCidade, preencheTipo };  //FIXME Corrigir esta merda

function preencheInstituições() {
    fetch('http://localhost/TCC/instituicoes/getAll').then
        (
            res => res.json()

        ).then(json => {

            json.forEach(el => {
                let option = document.createElement('option');
                option.innerHTML = el.nomeInstituicao;
                option.value = el.idInstituicao;
                console.log(el)
                document.getElementById('instituicoes').appendChild(option);

            });


        }

        )
}

//Preenche UF
function preencheUF() {
    let uf = document.getElementById('UF');
    return fetch('http://localhost/TCC/cursos/getUF')
        .then(res => res.json())
        .then(json => {
            json.map(el => {
                let opt = document.createElement('option');
                opt.id = el.idESTADO;
                opt.textContent = el.UF;
                uf.appendChild(opt);
            })
        })
        .then(function () { console.log(document.getElementById('UF').childNodes[document.getElementById('UF').selectedIndex + 1].id) });
}


//Preenche Cidade
async function preencheCidade(UFid) {



    let cidade = document.getElementById('cidade');
    cidade.textContent = '';
    
    return await fetch('http://localhost/TCC/cursos/cidades/' + UFid, { method: 'GET' })
        .then(res => res.json())
        .then(json => {
            json.map(el => {
                let opt = document.createElement('option');
                opt.value = el.idCidade;
                opt.textContent = el.nome;
                console.log('Dentro do append child')
                cidade.appendChild(opt);
            })
            return json.idCidade;
        })
    

}

//TODO avaliar a possibilidade de usar Promise.all com display para implementar skeleton load

//Preenche Tipo Curso

function preencheTipo() {
    fetch('http://localhost/TCC/cursos/getTipos')
        .then(res => res.json())
        .then(json => {
            json.map(el => {
                let option = document.createElement('option');
                option.textContent = el.nome;
                option.value = el.idTIPOCURSO;
                document.getElementById('tipoCurso').appendChild(option);
            })
        })
}