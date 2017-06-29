<script>
  
    $(document).ready(function () {  
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
        });
    });

    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });

     $(".rutaname").on('change',function(e){ 
          var sel_name = $(e.target).val();
          var ruta     = buscar_ruta(sel_name);
         

                      
        });


    $(function(){
        // Crea el elemento factura
        $("#agregar-factura").on('click', function(){
            var elemento = $('<div class="form-group col-sm-3" id="form-factura">{!! Form::label('factura[]', 'Factura') !!}<div class="input-group"><span class="input-group-addon">CR0000</span>{!! Form::text('factura[]', null, ['class' => 'form-control texto-right', 'required']) !!}<span class="input-group-btn eliminar-factura"><button class="btn btn-danger" type="button"><i class="fa fa-times"></i></button></span></div></div>');
           // $("#form-factura").clone().appendTo("#space-factura").fadeIn("slow");
            elemento.appendTo('#space-factura');
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
            var elemento = $('<div class="form-descuento"><div class="form-group col-sm-6 col-xl-6">{!! Form::label('desc_tipo', 'Tipo / Valor (Descuento)') !!}<div class="input-group"><span class="input-group-addon select-addon-custom" style="width: 30% !important">{!! Form::select('desc_tipo[]', $selectores['descuento_id'], null, ['class' => 'form-control select2', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*', 'required']) !!}</span><span class="input-group-addon"><i class="fa fa-usd"></i></span>{!! Form::text('desc_valor[]', null, ['class' => 'form-control texto-right', 'required']) !!}<span class="input-group-btn eliminar-factura"><button class="btn btn-danger" type="button"><i class="fa fa-times"></i></button></span></div></div></div>');
           // $("#form-factura").clone().appendTo("#space-factura").fadeIn("slow");
            elemento.appendTo('#space-descuento');
            //console.log(elemento);
            //reactivar select2
            $(".select2").select2({
              tags: false, // permite insertar texto
              language: {noResults: function() {return "No se encontraron coincidencias";}, searching: function() {return "Buscando..";}
                    },
              placeholder: 'Seleccionar...',      
              allowClear: true
            });

        });
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
                console.log(data);
                // console.log(data['valor_sugerido']);    
                
                //console.log($('input[name^="valor_final"]').eq(1).val());
                $('input[name^="predefinido"]').each(function( key, value ) {
                    if ($(this).val() == 'yes') {
                      //alert('final: '+ruta);
                      console.log("ruta: "+ruta_id);
                      console.log("selector: "+$('select[name^="ruta_nombre"]').eq(key).val());
                      console.log($('input[select^="ruta_nombre"]').eq(key).val() == ruta_id);
                      if ($('input[select^="ruta_nombre"]').eq(key).val() == ruta_id) {

                          $('input[name^="valor_final"]').eq(key).val(data['valor_sugerido']);

                          console.log(data['valor_sugerido']);
                          
                      }
                      
                    }
                    //alert( key + ": " + value + " valor: "+$(this).val() );
                   // alert($(this).val());
                });  
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