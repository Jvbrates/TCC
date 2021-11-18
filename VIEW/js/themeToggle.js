
//Dark Light Switcher
const colorSwitch = document.getElementById('cores');

function switchTheme(e) {
    if (e.target.checked) {
        localStorage.setItem('theme', 'dark');
        document.documentElement.setAttribute('data-theme', 'dark');
        colorSwitch.checked = true;
        document.getElementById('sun').style.color = "var(--bar-color)"
        document.getElementById('moon').style.color = "#F5F8FA"
    } else {
        localStorage.setItem('theme', 'light');
        document.documentElement.setAttribute('data-theme', 'light');
        colorSwitch.checked = false;
        document.getElementById('sun').style.color = "#121212"
        document.getElementById('moon').style.color = "#121212"
    }    
}

colorSwitch.addEventListener('change', switchTheme, false);

if (document.documentElement.getAttribute("data-theme") == "dark"){
    colorSwitch.checked = true;
    document.getElementById('sun').style.color = "var(--bar-color)"
    document.getElementById('moon').style.color = "#F5F8FA"
}

const navbar = document.querySelector('nav');
    console.log(navbar)

    const observer = new IntersectionObserver(
      ([e]) => e.target.classList.toggle('isSticky', e.intersectionRatio < 1), {
        threshold: [1]
      }
    );

    observer.observe(navbar)