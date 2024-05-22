var indiceIpc = document.getElementById('indice');

function formatoIndice(){
    Inputmask('999.99').mask(indiceIpc);
    
    indiceIpc.style.textAlign= "center";
} 

formatoIndice();