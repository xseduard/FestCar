

 function alertEliminar(e) {
e.preventDefault();
   swal({   
      title: "¿Estas seguro?",   
      text: "Los registros eliminados no podran volver a restaurarse",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Si, Eliminar!",
      cancelButtonText: "Cancelar",   
      closeOnConfirm: false,
      closeOnCancel: false }, 

function(isConfirm){   
  if (isConfirm) {     
    swal("Eliminado!", "El registro se ha eliminado correctamente.", "success");
    $( "#formEliminar" ).submit();   } 
else {    
    swal("Cancelado", "", "error");
       } 
  });

 }



function ActivarMenu() {

     var paginaURL = window.location.href.substr(window.location.href
.lastIndexOf("/")+1);
     $("#navegacion ul li").each(function(){
          if($(this).attr("ruta") == paginaURL || $(this).attr("ruta") == '' )
          $(this).addClass("active");

     })
}


function main(){
 $(document).on('click', '#btn-eliminar', alertEliminar);
ActivarMenu();
}
$(document).on('ready', main);