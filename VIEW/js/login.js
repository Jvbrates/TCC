
const formulario = document.getElementById('formLogin');
const alertDiv = document.getElementById('alert_wrapper');

//configurações para Mensagem de erro - login mal sucedido.
const alerta = document.querySelector('#alerta');
const bsAlert = bootstrap.Alert.getInstance(alerta);

formulario.addEventListener('submit', function (s) {
    s.preventDefault();
    let dados = new FormData(formulario);
    console.log(dados.get('user'));


    fetch('http://localhost/TCC/login/setLogin', {
        method: 'POST',
        body: dados,
          
    })

        .then(function (response) {
            if (response.status == 200) {
                formulario.method = 'post';
                formulario.action = 'http://localhost/TCC/home';
                formulario.submit();
            } else if (response.status == 401) {
                alertDiv.innerHTML = "<div class='alert alert-warning alert-dismissible fade show' id='alerta' role='alert'><span type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></span><strong>Atenção!</strong> Usuário ou senha incorretos.</div> ";
            
            } else { console.log(response.status) }
        })

});