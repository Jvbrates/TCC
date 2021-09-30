<form id="formLogin" method="POST" action="http://localhost/TCC/instituicoes/cad">
    <div class="row">
        <div class="form-group col-xl-12">
            <label for="nomeInstituicao">Nome da Instituição:</label>
            <input type="text" class="form-control" name="nomeInstituicao" placeholder="Nome">
        </div>
        <hr>
    </div>
    <div class="row">
        <label for="Conratos">Contatos:</label>
        <div class="form-group col-xl">
            <input type="text" class="form-control" name="fone" placeholder="Telefone:">
        </div>
        <div class="form-group col-xl">
            <input type="email" class="form-control" name="emailInstituicao" placeholder="email">
        </div>
        <div class="form-group col-xl">
            <input type="text" class="form-control" name="site" placeholder="site">
        </div>
    </div>
    <div class="row">
        <label for="">Endereço: </label>
        <div class="form-group col-xl">
            <input type="text" class="form-control" name="endereco" placeholder="Endereço">
        </div>
    </div>
    <div class="row">
        <label for="">Sobre: </label>
        <div class=" col-xl">
        <textarea id="sobre" class="form-control" name="sobre" placeholder="Sobre a instituição..."></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-xl">
            <div id="map"></div>
        </div>
        <div class="col-xl coordenadas">
            <button class="btn btn-success" onclick="envia()">Cadastrar</button>

            <input type="text" id='lat' name="lat" class="form-control" readonly id="fone" placeholder="Latitude">

            <input type="text" class="form-control" name="long" id="long" readonly placeholder="Longitude">

        </div>
    </div>

</form>

<!---< Carregar Modulo de funções para carregar CSS>-->

<script type="module">
import {loadCSS} from '/TCC/VIEW/js/funcoes.js';
loadCSS("css/newInstituicoes.css");
</script>

<!----Para usar google maps api -->
<script src="js/newInstituicoes.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzSXiSHwnpvLLWATkHSHvMzuAblvSR_co&libraries=visualization&callback=initMap&language=pt"></script>