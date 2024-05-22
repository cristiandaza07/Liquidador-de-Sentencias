const formularioGuardar = document.getElementById("formularioGuardar");

//Confrimar que se desa guardar y exportar la liquidación
formularioGuardar.addEventListener('submit', (event) =>{
    event.preventDefault(); 

    Swal.fire({
        title: "Confirmas que deseas guardar y descargar el PDF?",
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: "Confirmar"
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          Swal.fire("Guardado!", "", "success");
          formularioGuardar.submit();
        } else if (result.isDenied) {
          Swal.fire("La liquidación no fue guardada", "", "info");
          return;
        }      
    });
});