var data = { lat: 0, lng: 0 };

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
            console.log(data);
            document.getElementById('lat').value = data.lat;
            document.getElementById('long').value = data.lng;
        }

    });

}
//TODO verificações de email, empty e correção de cordenadas vazias no javascritp




function envia(){
    document.getElementsByTagName('form')[0].submit();
}