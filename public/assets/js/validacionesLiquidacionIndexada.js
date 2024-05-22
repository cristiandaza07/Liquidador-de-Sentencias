const formularioIndexada = document.getElementById("formularioIndexada");

var nombreDemandante = document.getElementById("nombreDemandante");
var numDocumento = document.getElementById("numDocumento");

var valorInicial = document.getElementById("valorInicial");
var labelValorInicial = document.getElementById("labelValorInicial");

var fechaDesde = document.getElementById("fechaDesde");
var labelFechaDesde = document.getElementById("labelFechaDesde");

var fechaHasta = document.getElementById("fechaHasta");
var labelFechaHasta = document.getElementById("labelFechaHasta");

const inputs = document.querySelectorAll('.input');

//Sirve para poner el formato de moneda al campo de 'Valor Inicial' de las liquidaciones
valorInicial.addEventListener('input', function(){
    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        minimumFractionDigits: 0,
        currency: 'USD'
    }) 

    valorInicial.value = valorInicial.value.replace(/[^0-9]/g, "");
    valorInicial.value= formatter.format(valorInicial.value);
});

//Sirve para validar si los campos siguen estando vacios, si lo están se pone en rojo los campos
function validarInput(input) {
    var nombreInput = input.id;
    var primeraLetraMayuscula = input.id.charAt(0).toUpperCase();
    var nombreLabel = "label" + primeraLetraMayuscula + nombreInput.slice(1);
    var label = document.getElementById(nombreLabel);
    
    if (input.value === '') { 
        if(label !== null){
          label.style.color = "#CF1A1A";  
        }       
        input.style.borderColor = '#CF1A1A';
    } else {
        if(label !== null){
            label.style.color = "#333333";
        }    
        input.style.borderColor = '#333333';
    }
}
for (const input of inputs) {
  input.addEventListener('blur', () => validarInput(input));
}

//Sirve para validar que los campos no estén vacios antes de enviar la petición y para darle un color rojo si hay campos vacios
formularioIndexada.addEventListener('submit', (event) => {
    event.preventDefault();
    var submit = true;
    var esNumerico= true;
    const regex = /^[0-9]*$/; 

    if (nombreDemandante.value === '' || !isNaN(nombreDemandante.value)) {
        nombreDemandante.style.border = "2px solid #CF1A1A";
        submit = false;
    }
   
    esNumerico = regex.test(numDocumento.value);
    if (numDocumento.value === '' || !esNumerico) {
        numDocumento.style.border = "2px solid #CF1A1A";
        submit = false;
    }

    if (valorInicial.value === '') {
        labelValorInicial.style.color = "#CF1A1A";
        valorInicial.style.border = "2px solid #CF1A1A";
        submit = false;
    }
    
    if(fechaDesde.value === "") {
        labelFechaDesde.style.color = "#CF1A1A";
        fechaDesde.style.border = "2px solid #CF1A1A";
        submit = false;
    }
    
    if(fechaHasta.value === ""){
        labelFechaHasta.style.color = "#CF1A1A";
        fechaHasta.style.border = "2px solid #CF1A1A";
        submit = false;
    }

    if(!submit){
        Swal.fire({
            icon: "warning",
            title: "Verifica los campos subrayados",
            position: 'top',
            padding: '10px',
            width: '350px',
            heightAuto: true
        });       
        return;
    }

    formularioIndexada.submit(); // Envía el formulario
});
