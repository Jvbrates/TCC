function setTheme(){
    var cor = "light";

    if(localStorage.getItem("theme")){
        if(localStorage.getItem("theme") == "dark"){
            cor = "dark" ;
        }

    }
    else if(!window.matchMedia){
        return false;
    } 
    else if(window.matchMedia("(prefers-color-scheme: dark)").matches){
        cor = "dark";
    }

    if(cor == "dark"){
        document.documentElement.setAttribute("data-theme", "dark");
    }
}
setTheme()