var usuarioInput = document.getElementById('usuario');
var dependeciaInput = document.getElementById('dependecia');
var tipoUsuarioInput = document.getElementById('tipoUsuario');
var nombreCompletoInput = document.getElementById('nombreCompleto');
var correoInput = document.getElementById('correo');
var contraseñaInput = document.getElementById('contraseña');
var usuarioInputImg = document.getElementById('usuarioImg');

var formularioCrearUsuario = document.getElementById('formularioCrearUsuario');

//Valida que los campos no estén vacios
formularioCrearUsuario.addEventListener('submit', (event)=>{
    event.preventDefault();

    if(usuarioInput.value != "" && dependeciaInput.value != "Seleccionar Mes" && tipoUsuarioInput.value != "Tipo de Usuario" && nombreCompletoInput.value != "" && correoInput.value != "" && contraseñaInput.value != ""){
        //let valorUsuarioInput = usuarioInput.value;
        if(usuarioInput.value.length < 6){
            return;
        }else{
            Swal.fire({
                title: "¿Seguro que deseas guardar el usuario?",
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
        }

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

//Valida si el usuario ingresado ya existe y si no está el campo vacio
usuarioInput.addEventListener('change', function(){
    var urlBase = window.location.protocol + '//' + window.location.hostname;

    if(usuarioInput.value == ""){
        usuarioInputImg.src = urlBase + "/liquidador/public/assets/img/invalid.png"
    }else if(usuarioInput.value.length < 6){
        usuarioInputImg.src = urlBase + "/liquidador/public/assets/img/invalid.png"
    } else{
        fetch('crearUsuario/usuarioExiste', {
            method: 'POST',
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            body: `usuario=${usuarioInput.value}`,           
        })
        .then(async response => {
            //Se guarda la respuesta del servidor
            const data = await response.json()
            if (data.usuarioExiste) {
                usuarioInputImg.src = urlBase + "/liquidador/public/assets/img/invalid.png"
            } else {
                usuarioInputImg.src = urlBase + "/liquidador/public/assets/img/check.png"
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });        
    }
});
  

