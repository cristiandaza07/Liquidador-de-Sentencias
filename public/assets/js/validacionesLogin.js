var usuarioInput = document.getElementById("usuario");
var contraseñaInput = document.getElementById("contraseña");

const formularioLogin = document.getElementById('formularioLogin');

formularioLogin.addEventListener('submit', (event)=>{  
    event.preventDefault();

    // Creación de cadena de consulta URL codificada para pasarla al servidor
    const datosIngresados = new URLSearchParams();
    datosIngresados.append('usuario', usuarioInput.value);
    datosIngresados.append('contraseña', contraseñaInput.value);
    
    //Verificamos primero si los campos no están vacios
    if(usuarioInput.value != "" && contraseñaInput.value != ""){
        fetch('verificarUsuario', {
            method: 'POST',
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            body:  datosIngresados.toString()     
        })
        .then(async response => {
            //Se guarda la respuesta del servidor
            const data = await response.json()
    
            if (data.usuarioCorrecto) {
                formularioLogin.submit();
            } else {
                Swal.fire({
                    icon: "warning",
                    title: "Usuario o contraseña incorrecta",
                    padding: '30px',
                    width: '350px',
                    heightAuto: true
                });    
            }
        })
        .catch(error => {
            console.error('Error:', error);
        }); 
    }else{
        Swal.fire({
            icon: "warning",
            title: "Rellena todos los campos",
            padding: '30px',
            width: '350px',
            heightAuto: true
        });   
    }
       
});
  
function validarCampos(){
    if (nombreRegistro.value.length === 0) {
        alert("nombre vacio")
      } else {
        // El input no está vacío
      }
}