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
                        $(".idea").append(`
                              <div class="tarea">
                              <div class="nombre">${phpJSON[i].nombre}</div>
                              <div class="estado" style="display:none;">${phpJSON[i].estado}</div>
                              <div class="creador">${phpJSON[i].propietario}</div>
                              <div class="descripcion" style="display:none;>${phpJSON[i].descripcion}</div>
                              <div class="participantes" style="display:none;>${phpJSON[i].participantes}</div>
                              <input type="button" value="editar">
                              </div>
                              `);
                        break;

                  case "to do":
                        $(".todo").append(`
                              <div class="tarea">
                              <div class="nombre">${phpJSON[i].nombre}</div>
                              <div class="estado" style="display:none;">${phpJSON[i].estado}</div>
                              <div class="creador">${phpJSON[i].creador}</div>
                              <div class="descripcion" style="display:none;>${phpJSON[i].descripcion}</div>
                              <div class="participantes" style="display:none;>${phpJSON[i].participantes}</div>
                              <input type="button" value="editar">
                              </div>
                              `);
                        break;

                  case "doing":
                        $(".doing").append(`
                              <div class="tarea">
                              <div class="nombre">${phpJSON[i].nombre}</div>
                              <div class="estado" style="display:none;">${phpJSON[i].estado}</div>
                              <div class="creador">${phpJSON[i].creador}</div>
                              <div class="descripcion" style="display:none;>${phpJSON[i].descripcion}</div>
                              <div class="participantes" style="display:none;>${phpJSON[i].participantes}</div>
                              <input type="button" value="editar">
                              </div>
                              `);
                        break;

                  case "done":
                        $(".done").append(`
                              <div class="tarea">
                              <div class="nombre">${phpJSON[i].nombre}</div>
                              <div class="estado" style="display:none;">${phpJSON[i].estado}</div>
                              <div class="creador">${phpJSON[i].creador}</div>
                              <div class="descripcion" style="display:none;>${phpJSON[i].descripcion}</div>
                              <div class="participantes" style="display:none;>${phpJSON[i].participantes}</div>
                              <div><input type="button" value="editar" class="editar" placeholder="editar"></div>
                              </div>
                              `);
                        break;
                  default:
                        console.error("la tarjeta de nombre:"+phpJSON[i].nombre+"Con _id"+phpJSON[i]._id+" Tiene un estado invalido");

                        break;
            }
            
      }
      for (let i = 0; i < phpParticipantes.length; i++) {

            $("#selectParticipantes").append(`<option value="${phpParticipantes[i].id}">${phpParticipantes[i].usuario}</option>`);
            
      }
      //FORMULARIO DE AGREGAR TAREA
      $("#botonAgregarTarjeta").click(function (e) { 
            $(".contenedorFormulario").fadeIn();
            
      });
      $("#cancelarFormulario").click(function (e) { 
            $(".contenedorFormulario").fadeOut();
            
      });

      //FORMULARIO DE EDITAR TAREA
      $("#botonEditarTarjeta").click(function (e) { 
            let nombre  = $(".nombre").val();
            let creador = $(".creador").val();
            let estado = $(".estado").val();
            let descripcion = $(".descripcion").val();
            let participantes  = $(".participantes").val();
            $("body").append(`
            <div class="contenedorFormulario">
                  <form action="/src/backend/editarTarjetas.php" method="POST">
                        <h1>Creando Nueva Tarea</h1>
                        <h3>Titulo</h3>
                        <input type="text" placeholder="${nombre}" name="nombre">
                        <h3>Descripcion</h3>
                        <textarea name="descripcion"  placeholder="${descripcion}" id=""></textarea>

                        <h3>Estado</h3>
                        <input type="text" placeholder="estado" name="${estado}">
                        <h3>FF</h3>
                        <input type="date" placeholder="va"><input type="date" placeholder="Fecha De Fin">
                        <h3>Participantes</h3>
                        <select name="participantes[]" id="selectParticipantes"  multiple>
                              <!---->
                        </select>
                  
                        <input type="submit" value="Enviar">
                        <input type="reset" value="Cancelar" id="cancelarFormulario">
                  </form>
            </div>
            `);
            $(".contenedorFormulario").fadeIn();
            
      });
      $("#cancelarFormulario").click(function (e) { 
            $(".contenedorFormulario").fadeOut();
            
      });

      


});
