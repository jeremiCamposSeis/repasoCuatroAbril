const BASE_URL = document.getElementById("urlBase").value;


function Addusuario() {


    if (document.getElementById("seccionFormulario").style.display === 'none' || document.getElementById("seccionFormulario").style.display === '') {
        document.getElementById("seccionFormulario").style.display = "block"
    } else {

        document.getElementById("seccionFormulario").style.display = "none"
    }
}

function verificarTexto(input){

    const valor=input.value;
    const ultimoDig=valor[valor.length-1];

    if(!isNaN(ultimoDig)){

        input.value = valor.slice(0, -1);

    }



    

 }


 function verificarNum(input){

    const valor=input.value;
    const ultimoDig=valor[valor.length-1];

    if(isNaN(ultimoDig)){

        input.value = valor.slice(0, -1);

    }



    

 }


 function verificarCedulaingreso(input) {
    const valor = input.value;
    //alert("yay");
    const ultimodig = valor[valor.length - 1];
   

if (isNaN(ultimodig)) {
    input.value = valor.slice(0, -1);
    //console.log(valor);


}

    if (valor.length > 10) {
        input.value = valor.slice(0, 10);

    }

/*
    if (valor.length == 10) {
        //input.value=valor.slice(0,10);
        // alert(valor);

        verificarCedula();
    }
*/


}


function updateGetU(dat)
{

    // alert(dat);
    var dato = dat;

    //console.log(BASE_URL);

    $.ajax({
        url: BASE_URL + '/updateU',
        type: 'POST',
        data: {
            idU: dato
        },
        success: function (resultado) {
            console.log("Respuesta: " + resultado);

            resultado.forEach(function (item, index) {
                //(`Elemento ${index + 1}:`);
                document.getElementById("nombreMod").value = item.USU_NOMBRE;
                document.getElementById("apellidoMod").value = item.USU_APELLIDO;
                document.getElementById("cedulaMod").value = item.USU_IDENTIFICACION;
                document.getElementById("correoMod").value = item.USU_CORREO;
            });
        },
        error: function (xhr, status, error) {
            console.error("El error encontrado es: " + error);
        }
    });

    document.getElementById("cedulaMod").disabled = true;


}

function actualizarU() {

    let nombre = document.getElementById("nombreMod").value;
    let apellido = document.getElementById("apellidoMod").value;
    let cedula = document.getElementById("cedulaMod").value;
    let correo = document.getElementById("correoMod").value;

    let dato = {
        n: nombre,
        a: apellido,
        c: cedula,
        e: correo,
    }

    $.ajax({

        url: BASE_URL + '/actualizarU',
        type: 'POST',
        data: dato,
        success: function (resultado) {
            console.log("Respuesta: " + resultado);
            alert(resultado);
            window.location.href=BASE_URL+'index';
          //  window.location.href=BASE_URL;

        },
        error: function (xhr, status, error) {
            console.error("El error encontrado es: " + error);
        }







    });





}



function eliminarU(dat) {


    if (confirm("seguro de que quiere dar de baja a este usuario")) {
         // alert(dat);
         var dato = dat;
    
         //console.log(BASE_URL);
     
         $.ajax({
             url: BASE_URL + 'eliminarU',
             type: 'POST',
             data: {
                 idU: dato
             },
             success: function (resultado) {
                alert(resultado);
                window.location.href=BASE_URL+'index';
             },
             error: function (xhr, status, error) {
                 console.error("El error encontrado es: " + error);
             }
         });
    } else {
    
        alert("dato conservado");
        
    }
      
    
    
    }