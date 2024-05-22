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

    if(porcentajeDtf.value != "" && fechaDesde.value != "" && fechaHasta.value != "" ){
            Swal.fire({
                icon: "warning",
                title: "¿Confirmas que la información es correcta?",
                    showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: "Confirmar" 
            })
            .then((result) => {
                if (result.isConfirmed) {
                Swal.fire("Usuario guardado!", "", "success");
                formularioCrearUsuario.submit();
                } else if (result.isDenied) {
                Swal.fire("El usuario no fue creado", "", "info");
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