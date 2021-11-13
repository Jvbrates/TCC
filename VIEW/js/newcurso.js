//Preenche select Instituições

let instituicoesPromise = await fetch('http://localhost/TCC/instituicoes/getAll').then
    (
        res => res.json()

    )

    instituicoesPromise.forEach(preencheInstituições);

    function preencheInstituições(array) {
        let option = document.createElement('option');
        option.innerHTML = array.nomeInstituicao;
        option.value = array.idInstituicao;
        console.log(array)
        document.getElementById('instituicoes').appendChild(option);
    }

//Preenche Select Cidades


async function preencheUF(json) {
    let uf = document.getElementById('UF');

    let array = await json.json();
    array.forEach(el => {
        console.log('aaa')
        let opt = document.createElement('option');
        opt.id = el.idESTADO;
        opt.textContent = el.UF;
        uf.appendChild(opt);
    })
    cidadePromise(document.getElementById('UF'));
    uf.addEventListener('change', cidadePromise);

}


async function preencheCidade(json) {
    let cidade = document.getElementById('cidade');
    cidade.textContent = ''//??? textContent ou htmlcontent
    let array = await json.json();
    array.forEach(el => {

        let opt = document.createElement('option');
        opt.value = el.idCidade;
        opt.textContent = el.nome;
        cidade.appendChild(opt);
    })

}

function cidadePromise() {
    let cidadeId = document.getElementById('UF').childNodes[document.getElementById('UF').selectedIndex + 1].id;
    console.log(cidadeId);
    fetch('http://localhost/TCC/cursos/cidades/' + cidadeId, { method: 'GET' }).then(preencheCidade)
}

var ufPromise = fetch('http://localhost/TCC/cursos/getUF').then(preencheUF)

//Tipo Curso

let tipoPromise = await fetch('http://localhost/TCC/cursos/getTipos').then
    (
        r => r.json()
    )
tipoPromise.forEach(function (array) {

    let option = document.createElement('option');
    option.textContent = array.nome;
    option.value = array.idTIPOCURSO;
    document.getElementById('tipoCurso').appendChild(option);
}
)



