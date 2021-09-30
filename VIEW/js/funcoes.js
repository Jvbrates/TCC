
export function loadCSS(filename) {
    var file = document.createElement("link");
    file.setAttribute("rel", "stylesheet");
    file.setAttribute("type", "text/css");
    file.setAttribute("href", filename);
    document.head.appendChild(file);
}

export function confirma(id) {
    if(window.confirm('Você tem certeza que deseja fazer isso?')){
        window.location.href = "http://localhost/TCC/instituicoes/dell/"+id;
    }
}
    