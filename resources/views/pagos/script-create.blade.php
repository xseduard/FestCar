<script>
  
    $(document).ready(function () {  
      sidebar_colapsado();
        $(".select2").select2({
          tags: false, // permite insertar texto
          language: {noResults: function() {return "No se encontraron coincidencias";}, searching: function() {return "Buscando..";}
                },
          placeholder: 'Seleccionar...',      
          allowClear: true
        });
        $('.datepicker').datepicker({             
            format: 'yyyy-mm-dd',        
            language: 'es',
            calendarWeeks: true,
            weekStart: 1,
        });
    });

    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });


    // Iniciador rutas datos
     $(".rutaname").on('change',function(e){ 
          var sel_name = $(e.target).val();
          buscar_ruta(sel_name);          
        });

     // Iniciador calculos totales
     $(".texto-right").on('keyup',function(e){
        calculos_totales();
      });



    $(function(){
        // Crea el elemento factura
        $("#agregar-factura").on('click', function(){
            var elemento_fac = $('<div class="form-group col-sm-3" id="form-factura">{!! Form::label('factura[]', 'Factura') !!}<div class="input-group"><span class="input-group-addon">CR0000</span>{!! Form::text('factura[]', null, ['class' => 'form-control texto-right', 'required']) !!}<span class="input-group-btn eliminar-factura"><button class="btn btn-danger" type="button"><i class="fa fa-times"></i></button></span></div></div>');
           // $("#form-factura").clone().appendTo("#space-factura").fadeIn("slow");
            elemento_fac.appendTo('#space-factura');
            //console.log(elemento);
        });
     
        // Evento que selecciona la fila y la elimina 
        $(document).on("click",".eliminar-factura",function(){
            var parent = $(this).parents().parents().get(0);
            //console.log(parent);
            $(parent).remove();
        });

        // Crea el elemento descuento
         $("#agregar-descuento").on('click', function(){
            var elemento_desc = $('<div class="form-descuento"><div class="form-group col-sm-6 col-xl-6">{!! Form::label('desc_tipo', 'Tipo / Valor (Descuento)') !!}<div class="input-group"><span class="input-group-addon select-addon-custom" style="width: 30% !important">{!! Form::select('desc_tipo[]', $selectores['descuento_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*', 'required']) !!}</span><span class="input-group-addon"><i class="fa fa-usd"></i></span>{!! Form::text('desc_valor[]', null, ['class' => 'form-control texto-right', 'required']) !!}<span class="input-group-btn eliminar-factura"><button class="btn btn-danger" type="button"><i class="fa fa-times"></i></button></span></div></div></div>');
           // $("#form-factura").clone().appendTo("#space-factura").fadeIn("slow");
            elemento_desc.appendTo('#space-descuento');
            //console.log(elemento);
            //reactivar select2
            $(".select2").select2({
              tags: false, // permite insertar texto
              language: {noResults: function() {return "No se encontraron coincidencias";}, searching: function() {return "Buscando..";}
                    },
              placeholder: 'Seleccionar...',      
              allowClear: true
            });

            // Iniciador rutas datos otra vez DUPLICADO
               $(".rutaname").on('change',function(e){ 
                    var sel_name = $(e.target).val();
                    buscar_ruta(sel_name);          
                  });

               // Iniciador calculos totales otra vez DUPLICADO
               $(".texto-right").on('keyup',function(e){
                  calculos_totales();
                });

        });

         // Crea el elemento factura
        $("#agregar-ruta-predefinida").on('click', function(){
            var elemento_ruta = $('<div class="rutabox">{!! Form::hidden('predefinido[]', 'yes') !!}<div class="form-group col-sm-4">{!! Form::label('ruta_nombre[]', 'Nombre Ruta') !!}{!! Form::select('ruta_nombre[]', $selectores['ruta_id'], null, ['id'=> 'rutaname', 'class'=> 'form-control select2 rutaname', 'style'=> 'width: 100%', 'placeholder'=>'Seleccione...*', 'required']) !!}</div><div class="form-group col-sm-2">{!! Form::label('distancia[]', 'Distancia') !!}<div class="input-group">{!! Form::text('distancia[]', null, ['class'=> 'form-control texto-right', 'placeholder'=>'0', 'readonly']) !!}<span class="input-group-addon">Km</span> </div></div><div class="form-group col-sm-2">{!! Form::label('duracion[]', 'Duración (Ida-Vuelta)') !!}<div class="input-group">{!! Form::text('duracion[]', null, ['class'=> 'form-control texto-right', 'placeholder'=>'0', 'readonly']) !!}<span class="input-group-addon">minutos</span> </div></div><div class="form-group col-sm-2">{!! Form::label('cantidad[]', 'Cantidad') !!}<div class="input-group">{!! Form::text('cantidad[]', null, ['class'=> 'form-control texto-right', 'placeholder'=>'0' , 'required']) !!}<span class="input-group-addon">Viajes</span> </div></div><div class="form-group col-sm-2">{!! Form::label('valor_final[]', 'Valor C/U') !!}<div class="input-group"> <span class="input-group-addon"><i class="fa fa-usd"></i></span>{!! Form::text('valor_final[]', null, ['class'=> 'form-control texto-right', 'placeholder'=>'0' , 'required']) !!}<span class="input-group-btn eliminar-ruta"><button class="btn btn-danger" type="button"><i class="fa fa-times"></i></button></span></div></div></div><div class="clearfix"></div>');

            elemento_ruta.appendTo('#space-ruta');

            $(".select2").select2({
              tags: false, // permite insertar texto
              language: {noResults: function() {return "No se encontraron coincidencias";}, searching: function() {return "Buscando..";}
                    },
              placeholder: 'Seleccionar...',      
              allowClear: true
            });

            // Iniciador rutas datos otra vez DUPLICADO
             $(".rutaname").on('change',function(e){ 
                  var sel_name = $(e.target).val();
                  buscar_ruta(sel_name);          
                });

             // Iniciador calculos totales otra vez DUPLICADO
             $(".texto-right").on('keyup',function(e){
                calculos_totales();
              });
        });
     
        // Evento que selecciona la fila y la elimina 
        $(document).on("click",".eliminar-ruta",function(){
            var parent = $(this).parents().parents().parents().get(0);
            //console.log(parent);
            $(parent).remove();
        });

        ///////////////////  RUTA NO DEFINIDA

             // Crea el elemento factura
        $("#agregar-ruta-nueva").on('click', function(){
            var elemento_ruta = $('<div class="rutabox">{!! Form::hidden('predefinido[]', 'not') !!}<div class="form-group col-sm-4">{!! Form::label('ruta_nombre[]', 'Nombre Ruta') !!}{!! Form::text('ruta_nombre[]', null, ['id'=> 'new_rutaname', 'class'=> 'form-control new_rutaname', 'placeholder'=>'Nueva Ruta', 'required']) !!}</div><div class="form-group col-sm-2">{!! Form::label('distancia[]', 'Distancia') !!}<div class="input-group">{!! Form::text('distancia[]', null, ['class'=> 'form-control texto-right', 'placeholder'=>'0', 'required']) !!}<span class="input-group-addon">Km</span> </div></div><div class="form-group col-sm-2">{!! Form::label('duracion[]', 'Duración (Ida-Vuelta)') !!}<div class="input-group">{!! Form::text('duracion[]', null, ['class'=> 'form-control texto-right', 'placeholder'=>'0', 'required']) !!}<span class="input-group-addon">minutos</span> </div></div><div class="form-group col-sm-2">{!! Form::label('cantidad[]', 'Cantidad') !!}<div class="input-group">{!! Form::text('cantidad[]', 1, ['class'=> 'form-control texto-right', 'placeholder'=>'0', 'required']) !!}<span class="input-group-addon">Viajes</span> </div></div><div class="form-group col-sm-2">{!! Form::label('valor_final[]', 'Valor C/U') !!}<div class="input-group"> <span class="input-group-addon"><i class="fa fa-usd"></i></span>{!! Form::text('valor_final[]', null, ['class'=> 'form-control texto-right', 'placeholder'=>'0', 'required']) !!}<span class="input-group-btn eliminar-ruta"><button class="btn btn-danger" type="button"><i class="fa fa-times"></i></button></span></div></div></div><div class="clearfix"></div>');

            elemento_ruta.appendTo('#space-ruta');

            $(".select2").select2({
              tags: false, // permite insertar texto
              language: {noResults: function() {return "No se encontraron coincidencias";}, searching: function() {return "Buscando..";}
                    },
              placeholder: 'Seleccionar...',      
              allowClear: true
            });

            // Iniciador rutas datos otra vez DUPLICADO
             $(".rutaname").on('change',function(e){ 
                  var sel_name = $(e.target).val();
                  buscar_ruta(sel_name);          
                });

             // Iniciador calculos totales otra vez DUPLICADO
             $(".texto-right").on('keyup',function(e){
                calculos_totales();
              });
        });
     
        // Evento que selecciona la fila y la elimina 
        /*
        $(document).on("click",".eliminar-ruta",function(){
            var parent = $(this).parents().parents().parents().get(0);
            //console.log(parent);
            $(parent).remove();
        });
*/
        /////////////// FIN RURA NO DEFINIDA


         // Evento que selecciona la fila y la elimina 
        $(document).on("click",".eliminar-descuento",function(){
            var parent = $(this).parents().parents().get(0);
            //console.log(parent);
            $(parent).remove();
        });

        //$("input[name*='ruta_nombre']").on('change',function(){ 
       
      

       /*
       function getvalues(){
        var inps = document.getElementsByName('pname[]');
        for (var i = 0; i <inps.length; i++) {
        var inp=inps[i];
            alert("pname["+i+"].value="+inp.value);
        }
        }
*/


    });

    function calculos_totales(){
      console.log('llega');
      var subtotal_rutas = 0;
      var subtotal_descuentos = 0;

     $('input[name^="cantidad"]').each(function( key, value ) {
           
           subtotal_rutas += ( $('input[name^="cantidad"]').eq(key).val() * $('input[name^="valor_final"]').eq(key).val() );
        }); 
      //console.log("rutas: "+subtotal_rutas);
      $('#subtotal').val(subtotal_rutas.toFixed(0));

        var desc_admin = parseFloat($('input[name="desc_admin"]').val()) * parseFloat(subtotal_rutas) / 100;
        var rte_finca  = parseFloat($('input[name="desc_finca"]').val()) * parseFloat(subtotal_rutas) / 100;

        var cuatropormil = parseFloat(0);
        //console.log("check "+$('#cuatro_por_mil').is(':checked'));        
        cuatropormil = parseFloat(subtotal_rutas)*4/1000;
        $('#text_cuatro_por_mil').val(cuatropormil.toFixed(2));     
        //$('#text_cuatro_por_mil').val(0);
          var extra_desc = parseFloat(0);
         $('input[name^="desc_valor"]').each(function( key, value ) {           
           extra_desc +=  parseFloat($('input[name^="desc_valor"]').eq(key).val());
          }); 


      subtotal_descuentos += parseFloat($('input[name="desc_sobrecosto"]').val()) 
      +  parseFloat($('input[name="desc_transaccion"]').val()) 
      +  desc_admin
      +  rte_finca
      +  cuatropormil
      +  extra_desc;

      var total = subtotal_rutas-subtotal_descuentos;
      //console.log("descuentos: "+subtotal_descuentos+" --- "+subtotal_descuentos.toFixed(2));
       $('#total_descuentos').val(subtotal_descuentos.toFixed(2));

       $('#total').val(total.toFixed(2));

       console.log(total.toFixed(2));
    }

    function buscar_ruta(ruta_id){
        console.log('Inicio busqueda'); 
        var id = ruta_id;
        $.ajax({
            data: "id="+id+"&_token={{ csrf_token()}}",
            type: "POST",
            dataType: "json",
            url: "{{ route('ruta.buscarid')}}",
        })
         .done(function( data, textStatus, jqXHR ) {
             if ( console && console.log ) {
                 console.log( ">> La solicitud se ha completado correctamente." );
                // console.log(data);
                // console.log(data['valor_sugerido']);    
                
                //console.log($('input[name^="valor_final"]').eq(1).val());
                $('input[name^="predefinido"]').each(function( key, value ) {
                    if ($(this).val() == 'yes') {
                      //alert('final: '+ruta);
                      
                      if ($('select[name^="ruta_nombre"]').eq(key).val() == ruta_id) {
                          
                          $('input[name^="distancia"]').eq(key).val(data['distancia']);
                          $('input[name^="duracion"]').eq(key).val(data['duracion']);
                          $('input[name^="cantidad"]').eq(key).val(1);
                          $('input[name^="valor_final"]').eq(key).val(data['valor_sugerido']);
                          
                      }
                      
                    }
                    //alert( key + ": " + value + " valor: "+$(this).val() );
                   // alert($(this).val());
                });  

                calculos_totales();
                //fin cambios 

             }            
         })
         .fail(function( jqXHR, textStatus, errorThrown ) {
             if ( console && console.log ) {
                 console.log( "La solicitud a fallado: " +  textStatus);
             }
        });  
         //return ruta_response;

    }

 
</script>