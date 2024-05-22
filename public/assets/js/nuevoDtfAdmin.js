var formularioCrearDTf = document.getElementById('formularioCrearDTf');
var porcentajeDtf = document.getElementById('porcentaje');
var fechaDesde = document.getElementById('fechaDesde');
var fechaHasta = document.getElementById('fechaHasta');

function formatoPorcentaje(){
    Inputmask('99.99%').mask(porcentajeDtf);
    
    porcentajeDtf.style.textAlign= "center";
} 

formatoPorcentaje();

//Valida que los campos no estén vacios
formularioCrearDTf.addEventListener('submit', (event)=>{
    event.preventDefault();

    if(porcentajeDtf.value != "" && !isNaN(porcentajeDtf.value.slice(0,-1)) && fechaDesde.value != "" && fechaHasta.value != "" ){
            Swal.fire({
                icon: "warning",
                title: "¿Confirmas que la información es correcta?",
                    showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: "Confirmar" 
            })
            .then((result) => {
                if (result.isConfirmed) {
                formularioCrearDTf.submit();
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