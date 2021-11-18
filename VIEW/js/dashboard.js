import { boasvindas } from './module/boasvindas.js';
import { loadCSS } from './module/funcoes.js';

loadCSS('css/dashboard.css');
boasvindas();


fetch('http://localhost/TCC/home/dados', {
    credentials:'same-origin'
})
.then(res => res.json())
.then(json => {
    document.getElementById('user').textContent = json.Usuarios;
    document.getElementById('inst').textContent = json.Instituicoes;
    document.getElementById('cursos').innerHTML = json.CursosAtv+'<span class="display-6" id="cursosTotal" >('+json.Cursos+')</span></h1><br>'
})