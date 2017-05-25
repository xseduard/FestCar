$(".eliminar-registro").onclick(function() {
    alertEliminar();
  });

function main(){
 alertEliminar();
 swal("Deleted!", "Your imaginary file has been deleted.", "success");

}

 function alertEliminar() {
   swal({   
      title: "Are you sure?",   
      text: "You will not be able to recover this imaginary file!",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Yes, delete it!",   
      closeOnConfirm: false }, function(){   
        swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
        return false;
        });
return false;
 }

 function validarConsulta() {
    var c = 0, j = 0;
    $(".input-sm").each(function (iter, item) {
        var campo = $(item).attr('id');
        var valor = $(item).val();
        if (valor === '' || valor === undefined) {
            c++;
        } else {
            j++;
        }
    });
    if (j >= 1) {
        return true;
    } else {
        mensaje('Advertencia', 'Debe ingresar al menos un criterio de busqueda.');
        return false;
    }
}