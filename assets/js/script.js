let pathAtualCompleto = window.location.pathname
let partesDoPath = pathAtualCompleto.split('/');

let nomeArquivoAtual = partesDoPath[3];

// Itera sobre os links na barra de navegação

let linksNavbar = document.querySelectorAll('.nav-link');

console.log(nomeArquivoAtual)

linksNavbar.forEach(function(link) {

    var linkHref = link.getAttribute('href');
    
    console.log("=============")
    console.log(linkHref)
    console.log(nomeArquivoAtual)
    console.log("=============")
    // Verifica se o link corresponde à página atual
    if (linkHref == nomeArquivoAtual) {

        console.log('entrou')
        link.classList.add('active')
    }
  });


const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
