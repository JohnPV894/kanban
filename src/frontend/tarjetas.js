"use strict";

async function obtenerPhp(url) {
      // 👇 URL to your data location
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
      const phpJSON =await obtenerPhp("http://localhost:3000/src/backend/recuperarTarjetas.php")
      //console.log(phpJSON[0] );
      //$(".cuerpo").append(JSON.stringify(phpJSON));
      for (let i = 0; i < phpJSON.length; i++) {
            
            console.log(JSON.stringify(phpJSON[i].estado))
            switch (phpJSON[i].estado) {
                  case "Idea":
                        $(".idea").append(`<div>${phpJSON[i].nombre}</div>`);
                        break;
                  case "To Do":
                        $(".todo").append(`<div>${phpJSON[i].nombre}</div>`);
                        break;
                  case "Doing":
                        $("doing").append(`<div>${phpJSON[i].nombre}</div>`);
                        break;
                  case "Done":
                        $(".done").append(`<div>${phpJSON[i].nombre}</div>`);
                        break;
                  default:
                        
                        break;
            }
            
      }


});
