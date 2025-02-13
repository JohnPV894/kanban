"use strict";

async function obtenerPhp(url) {
      // 👇 URL 
      return new Promise((resolve, reject) => {
            fetch(url) 
            .then(response => response.json())
            .then(data => {
                  //console.log(data);
                  
                resolve(data); // Aquí data es el objeto JavaScript parseado
            })
      })
}



//JQUERY
$(document).ready(async function () {
      //Recupero la coleccion Tarjetas de la BD mongo 
      const phpJSON =await obtenerPhp("http://localhost:3000/src/backend/recuperarTarjetas.php");
      const phpParticipantes = await obtenerPhp("http://localhost:3000/src/backend/recuperarParticipantes.php");
      //console.log(phpJSON[0] );
      //$(".cuerpo").append(JSON.stringify(phpJSON));
      for (let i = 0; i < phpJSON.length; i++) {
            console.log(phpJSON[i].estado.toLowerCase().trim());
            
            //console.log(JSON.stringify(phpJSON[i].estado))
            switch (phpJSON[i].estado.toLowerCase().trim()) {
                  case "idea":
                        $(".idea").append(`<div>${phpJSON[i].nombre}</div>`);
                        break;

                  case "to do":
                        $(".todo").append(`<div>${phpJSON[i].nombre}</div>`);
                        break;

                  case "doing":
                        $(".doing").append(`<div>${phpJSON[i].nombre}</div>`);
                        break;

                  case "done":
                        $(".done").append(`<div>${phpJSON[i].nombre}</div>`);
                        break;
                  default:
                        console.error("la tarjeta de nombre:"+phpJSON[i].nombre+"Con _id"+phpJSON[i]._id+" Tiene un estado invalido");

                        break;
            }
            
      }
      for (let i = 0; i < phpParticipantes.length; i++) {

            $("#selectParticipantes").append(`<option value="a">${phpParticipantes[i].usuario}</option>`);
            
      }
      //FORMULARIO DE AGREGAR TAREA
      $("#botonAgregarTarjeta").click(function (e) { 
            $(".contenedorFormulario").fadeIn();
            
      });
      $("#cancelarFormulario").click(function (e) { 
            $(".contenedorFormulario").fadeOut();
            
      });


});
