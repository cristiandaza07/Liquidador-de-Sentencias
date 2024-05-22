
var formularioCrearIpc = document.getElementById('formularioCrearIpc');
var indiceIpc = document.getElementById('indice');
var año = document.getElementById('año');
var mes = document.getElementById('mes');

function formatoIndice(){
    Inputmask('999.99').mask(indiceIpc);
    
    indiceIpc.style.textAlign= "center";
} 

formatoIndice();

//Valida que los campos no estén vacios
formularioCrearIpc.addEventListener('submit', (event)=>{
    event.preventDefault();

    console.log(mes.value)
    if(indiceIpc.value != "" && !isNaN(indiceIpc.value) && año.value != "" && mes.value != "Seleccionar Mes" ){
            Swal.fire({
                icon: "warning",
                title: "¿Confirmas que la información es correcta?",
                    showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: "Confirmar" 
            })
            .then((result) => {
                if (result.isConfirmed) {
                    formularioCrearIpc.submit();
                } else if (result.isDenied) {
                    return;
                }      
            });
    }else{
        Swal.fire({
            icon: "warning",
            title: "Verifica los campos",
            padding: '30px',
            width: '350px',
            heightAuto: true
        });   
    }
});