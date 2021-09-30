//Como sera uma cópia de newINstituições.js devem haver varias funcoes repetidas que podem ser reaproveitadas depois
defaults = [];
let a = function () {
    fetch('http://localhost/TCC/instituicoes/getFull/' + document.URL.substring(document.URL.lastIndexOf('/')))
        .then(function (json) {
            return json.json();

        })
        .then(resposta => {
            //console.log(resposta)
            document.querySelector('input[name="nomeInstituicao"]').value = Object.values(resposta)[0]['nomeInstituicao'];
            defaults.push(Object.values(resposta)[0]['nomeInstituicao']);

            document.querySelector('input[name="fone"]').value = Object.values(resposta)[0]['fone'];
            defaults.push(Object.values(resposta)[0]['fone']);

            document.querySelector('input[name="emailInstituicao"]').value = Object.values(resposta)[0]['email'];
            defaults.push(Object.values(resposta)[0]['email']);

            document.querySelector('input[name="site"]').value = Object.values(resposta)[0]['site'];
            defaults.push(Object.values(resposta)[0]['site']);


            document.querySelector('input[name="endereco"]').value = Object.values(resposta)[0]['endereco'];
            defaults.push(Object.values(resposta)[0]['endereco']);


            document.querySelector('textarea[name="Sobre"]').value = Object.values(resposta)[0]['sobre'];
            defaults.push(Object.values(resposta)[0]['sobre']);






            let coord = Object.values(resposta)[0]['localizacao'];
            //console.log(parseFloat(coord.substring(0, coord.indexOf('|'))));
            defaults.push(coord.substring(0, coord.indexOf('|')))
            defaults.push(coord.substring(coord.indexOf('|') + 1))
            data = {
                lat: parseFloat(coord.substring(0, coord.indexOf('|'))),
                lng: parseFloat(coord.substring(coord.indexOf('|') + 1)),

            }
            document.getElementById('Latitude').value = data.lat;
            document.getElementById('Longitude').value = data.lng;







        })
}




var data = { lat: 0, lng: 0 };
a()
function InfoBox(controlDiv, map) {
    // Set CSS for the control border.
    var InfoDiv = document.createElement('div');
    InfoDiv.style.boxShadow = 'rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px';
    InfoDiv.id = "infoid";
    InfoDiv.style.backgroundColor = '#fff';
    InfoDiv.style.border = '2px solid #fff';
    InfoDiv.style.borderRadius = '2px';
    InfoDiv.style.marginBottom = '22px';
    InfoDiv.style.marginTop = '10px';
    InfoDiv.style.textAlign = 'center';
    controlDiv.appendChild(InfoDiv);



    // Set CSS for the control interior Quem sabe inutil.
    var text = document.createElement('div');
    text.style.color = 'rgb(25,25,25)';
    text.style.fontFamily = 'Roboto,Arial,sans-serif';
    text.style.fontSize = '100%';
    text.style.padding = '6px';
    text.textContent = 'De dois cliques para marcar a posição no mapa';
    InfoDiv.appendChild(text);
}




function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: -29.12662114186217, lng: -56.55512613653415 },
        zoom: 9,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            mapTypeIds: [
                google.maps.MapTypeId.ROADMAP,
                google.maps.MapTypeId.SATELLITE
            ]
        }


        ,
        styles: [{
            featureType: 'poi',
            stylers: [{ visibility: 'off' }]  // Turn off POI.
        },
        {
            featureType: 'transit.station',
            stylers: [{ visibility: 'off' }]  // Desliga opções onibus, bicicleta, carro, a pé...
        }],
        disableDoubleClickZoom: true,
        streetViewControl: false,
    });


    var infoBoxDiv = document.createElement('div');
    infoBoxDiv.id = "infoboxdiv";

    infoBoxDiv.addEventListener('mouseover', function (e) {
        e.preventDefault();
        infoBoxDiv.style.opacity = 0;
        window.setTimeout(function () {
            infoBoxDiv.style.display = 'none';
        }, 700);
    })


    InfoBox(infoBoxDiv, map);

    map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(infoBoxDiv);
    var marker = new google.maps.Marker({

        title: "Hello World!",
        position: data,
    });

    marker.setMap(map);
    // Retorna cordenadas do ponto no mapa
    map.addListener('dblclick', function (e) {
        data.lat = e.latLng.lat();
        data.lng = e.latLng.lng();
        marker.setPosition(data);
        if ((data.lat != 0) && (data.lng != 0)) {
            //console.log(data);
            document.getElementById('Latitude').value = data.lat;
            document.getElementById('Longitude').value = data.lng;
        }

    });

}
//TODO verificações de email, empty e correção de cordenadas vazias no javascritp

function vericas() {
    editados = []
    defaults.forEach((element, index) => {

        //console.log(element != document.querySelectorAll('input, textarea')[index].value)
        if (element != document.querySelectorAll('input, textarea')[index].value) {
            editados.push(index);
        };
        
    });
    //console.log(editados);
        return editados;

}



function envia() {
    
    if (vericas().length > 0) {
        text= 'Tem certeza que deseja salvar as alterações?\n Você alterous os campos:\n';
        vericas().forEach(element => {
            text+= document.querySelectorAll('input, textarea')[element].placeholder+";\n"
            
            //console.log(text);
            
            
        })
        if(window.confirm(text)){
            document.getElementsByTagName('form')[0].action = document.getElementsByTagName('form')[0].action + document.URL.substring(document.URL.lastIndexOf('/'));
            document.getElementsByTagName('form')[0].submit();
        }
        
    }
    
}