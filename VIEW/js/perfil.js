var defaults = [];
async function main() {
    await fetch(
        'http://localhost/TCC/user/user',
        {
            credentials: "same-origin"
        }
    ).then(res => res.json())
        .then(json => {
            console.log(json);
            document.getElementById('nome').value = json.nome;
            defaults.push(json.nome);

            document.getElementById('username').value = json.nomeUsuario;
            defaults.push(json.nomeUsuario);

            document.getElementById('email').value = json.emailUsuario;
            defaults.push(json.emailUsuario);

        })

    document.getElementById('editaperfil').addEventListener('click', el => {
        el.preventDefault();
        let fdata = new FormData(document.getElementsByTagName('form')[1]);
        let object = {};
        fdata.forEach((value, key) => object[key] = value);
        let json = JSON.stringify(object);
        console.log(json, object);

        fetch('http://localhost/TCC/user/edit/', {
            credentials: 'same-origin',
            method: 'PUT',
            body: json
        })
            .then(res => {
                if (res.ok) {
                    document.querySelector('#avisoModal  .modal-body').textContent = "Atualizado com sucesso";
                    document.getElementById('btn_modalAviso').click();
                } else {
                    console.log('Falha no update');
                }
            }

            )

    })


    document.getElementById('nsenhaSubmit').addEventListener('click', el => {
        el.preventDefault();
        let fdata = new FormData(document.getElementsByTagName('form')[0]);
        let object = {};
        fdata.forEach((value, key) => object[key] = value);
        let json = JSON.stringify(object);
        console.log(json, object);

        fetch('http://localhost/TCC/user/editsenha/', {
            credentials: 'same-origin',
            method: 'PUT',
            body: json
        })
            .then(res => {
                if (res.ok) {
                    document.getElementById('senhaModal').click()

                    document.querySelector('#avisoModal  .modal-body').textContent = "Senha atualizada com sucesso!";
                    
                    document.getElementById('btn_modalAviso').click();
                    window.location.href = "http://localhost/TCC/login/login"
                } else {
                    
                    document.querySelector('#avisoModal  .modal-body').textContent = "Senha atual incorreta!";
                    
                    document.getElementById('btn_modalAviso').click();
                }
            }

            )

    })


}


main();