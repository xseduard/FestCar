function sidebar_colapsado(){
  var ventana_ancho = $(window).width();
  var ventana_alto = $(window).height();
  if (ventana_ancho < 1369) {
    $("body").addClass("sidebar-collapse"); 
  } 
}