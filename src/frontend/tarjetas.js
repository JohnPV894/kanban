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
            console.log(phpJSON[i]);
            
            let tarjetaHTML = `
                  <div class="tarea">
                        
                        <div class="nombre">${phpJSON[i].nombre}</div>
                        <div class="descripcion" >${phpJSON[i].descripcion}</div>
                        <div class="estado" >${phpJSON[i].estado}</div>
                        <div class="contenedorCreador">creador: <var class="creador">${phpJSON[i].creador}</var></div>
                        
                        
                        <div class="participantes" >${phpJSON[i].participantes}</div>
      
                        <div class="contenedorEditarFormulario">
                              <input type="button" value="Editar" id="editarFormulario">
                              <form action="/src/backend/eliminarTarjeta.php" method="post">
                              <input type="hidden" value="${phpJSON[i]._id["$oid"]}" name="idEliminar" >
                              <input type="submit" value="Eliminar" id="eliminarFormulario">
                              </form>
                        </div>

                  </div>
            `;
      
            switch (phpJSON[i].estado.toLowerCase().trim()) {
                  case "idea":
                        $(".idea").append(tarjetaHTML);
                        break;
                  case "to do":
                        $(".todo").append(tarjetaHTML);
                        break;
                  case "doing":
                        $(".doing").append(tarjetaHTML);
                        break;
                  case "done":
                        $(".done").append(tarjetaHTML);
                        break;
                  default:
                        console.error(`La tarjeta "${phpJSON[i].nombre}" con _id "${phpJSON[i]._id}" tiene un estado inválido`);
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
      $("#enviarFormulario").click(function (e) { 
            $(".contenedorFormulario").fadeOut();
            window.location.reload();
      });

      //FORMULARIO DE EDITAR TAREA
      $("#editarFormulario").click(function (e) { 
            //let nombre  = $(".nombre").val();
            //let creador = $(".creador").val();
            //let estado = $(".estado").val();
            //let descripcion = $(".descripcion").val();
            //let participantes  = $(".participantes").val();
            //$("body").append(`
            //<div class="contenedorFormulario">
            //      <form action="/src/backend/editarTarjetas.php" method="POST">
            //            <h1>Creando Nueva Tarea</h1>
            //            <h3>Titulo</h3>
            //            <input type="text" placeholder="${nombre}" name="nombre">
            //            <h3>Descripcion</h3>
            //            <textarea name="descripcion"  placeholder="${descripcion}" id=""></textarea>
//
            //            <h3>Estado</h3>
            //            <input type="text" placeholder="estado" name="${estado}">
            //            <h3>FF</h3>
            //            <input type="date" placeholder="va"><input type="date" placeholder="Fecha De Fin">
            //            <h3>Participantes</h3>
            //            <select name="participantes[]" id="selectParticipantes"  multiple>
            //                  <!---->
            //            </select>
            //      
            //            <input type="submit" value="Enviar">
            //            <input type="reset" value="Cancelar" id="cancelarFormulario">
            //      </form>
            //</div>
            //`);
            $(".contenedorFormularioEditar").fadeIn();
            
      });
      $("#cancelarFormularioEditar").click(function (e) { 
            $(".contenedorFormularioEditar").fadeOut();
            
      });

      


});
