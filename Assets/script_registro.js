alert("Inicio");
const nombre = document.getElementById("nombre");
const pepito = document.getElementById("pepito");
const especialidad = document.getElementById("especialidad");
const casa = document.getElementById("casa");
const pass = document.getElementById("pass");
const form = document.getElementById("registro");
const mensajes = document.getElementById("warnings");
const mensajeGeneral = document.getElementById("msgGeneral");

form.addEventListener("submit", e=>{
    e.preventDefault()
    let warnings = ""
    let errorNombre = false, errorEsp = false, errorCasa = false, errorPass = false

    if(nombre.value.length < 7){
        warnings += ("Nombre muy corto, ingrese el nombre y apellido porfavor <br>")
        errorNombre = true
    }
    if(especialidad.value.length <= 2 ){
        warnings += ("Ingrese la especialidad <br>")
        errorEsp = true
    }
    if(casa.value.length <= 2){
        warnings += ("Ingrese la casa de salud a la que pertenece <br>")
        errorCasa = true
    }
    if(pass.value.length < 7){
        warnings += ("Ingrese una contraseña mayor a 7 caracteres <br>")
        errorPass = true
    }
    if (errorNombre || errorEsp || errorCasa || errorPass){
        let er = "ERROR DE INGRESO <br> <br>"
        mensajeGeneral.innerHTML = er
        mensajes.innerHTML = warnings
    
    }
    if (errorNombre==false && errorEsp==false && errorCasa==false && errorPass==false){
        mensajeGeneral.innerHTML = "Datos correctos"
        mensajes.innerHTML = ""
        stop()
    }
})

