export { boasvindas };
function boasvindas() {
    fetch(
        'http://localhost/TCC/user/user',
        {
            credentials: "same-origin"
        })
    .then(res => res.json())
    .then(json => {
        document.getElementById('Bemvindo').textContent = json.nome
    })
    }