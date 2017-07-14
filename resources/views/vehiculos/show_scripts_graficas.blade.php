Chart.defaults.global.defaultFontFamily = "Rubik";

  var marksCanvas = document.getElementById("marksChart");

  var marksData = {
    labels: ["Costos Mantenimiento", "Costos Operación", "Consumibles", "Costos Seguros",  "Varios", "Margen"],
    datasets: [{
      label: "CLASE C",
      backgroundColor: "rgba(0,165,175,0.3)",
      borderColor: "rgba(0,165,175,1)",
      data: [
      {!! 
          $sim_gasto->inversion
          + $sim_gasto->llantas_completas 
          + $sim_gasto->motor_caja_trasmision
          + $sim_gasto->ajuste_pintura
          + $sim_gasto->rodamiento
          + $sim_gasto->cojineria_vidrios
          + $sim_gasto->lavado
          + $sim_gasto->carroceria
      !!}, 
      {!! 
          $sim_gasto->salario_conductor
          + $sim_gasto->prestaciones_sociales
          + $sim_gasto->seguridad_social
       !!},
       {!! 
          ($sim_gasto->acpm_galon * $sim_gasto->galones_kilometro * 10)
          + $sim_gasto->aceites_filtros
          + $sim_gasto->aditivos
          + $sim_gasto->baterias
       !!}, 
      {!! 
          $sim_gasto->soat
          + $sim_gasto->tecnicomecanica
          + $sim_gasto->revision_bimensual
          + $sim_gasto->contractual
          + $sim_gasto->extracontractual
       !!},
       
      {!! 
          $sim_gasto->impuesto_rodamiento
          + $sim_gasto->impuesto_semaforizacion
          + $sim_gasto->parqueo
          + $sim_gasto->tramites_varios
          + $sim_gasto->administracion
          + $sim_gasto->plan_reposicion_equipo
          + $sim_gasto->sistema_comunicacion
          + $sim_gasto->gps
          + $sim_gasto->otros
       !!},
       {!! $valores['margen'] !!}
      ]
    }, 
     /* 
    {
      label: "Promedio",
      backgroundColor: "rgba(0,0,200,0.2)",
      data: [50, 50, 50, 50, 50,50]
    }
    */
    ]
  };

  var radarChart = new Chart(marksCanvas, {
    type: 'radar',
    data: marksData
  });

  // donas pequeñas /////////////////////////////////////////

 

  Morris.Donut({
    element: 'donut-alfa',
    data: [
      {label: "Inversión", value: {!! $sim_gasto->inversion !!} },
      {label: "Llantas completas", value: {!! $sim_gasto->llantas_completas !!} },
      {label: "Motor caja de trasmisión", value: {!! $sim_gasto->motor_caja_trasmision !!} },
      {label: "Ajuste de pintura", value: {!! $sim_gasto->ajuste_pintura !!}, },
      {label: "Rodamiento", value: {!! $sim_gasto->rodamiento !!} },
      {label: "Cojineria / vidrios", value: {!! $sim_gasto->cojineria_vidrios !!}, },
      {label: "Lavado", value: {!! $sim_gasto->lavado !!} },
      {label: "Carroceria", value: {!! $sim_gasto->carroceria !!} }
    ],
    colors:[
              "#9C27B0",
              "#673AB7",
              "#2196F3",
              "#00BCD4",
              "#8BC34A",
              "#FFC107",
              "#FF5722",
              "#E91E63",
              "#03A9F4"
              ]
  });

  Morris.Donut({
    element: 'donut-beta',
    data: [
      {label: "Impuesto rodamiento", value: {!! $sim_gasto->impuesto_rodamiento !!} },
      {label: "Impuesto semaforización", value: {!! $sim_gasto->impuesto_semaforizacion !!} },
      {label: "Parqueo", value: {!! $sim_gasto->parqueo !!} },
      {label: "Tramites varios", value: {!! $sim_gasto->tramites_varios !!}, },
      {label: "Administración", value: {!! $sim_gasto->administracion !!} },
      {label: "Plan reposición equipo", value: {!! $sim_gasto->plan_reposicion_equipo !!}, },
      {label: "Sistema comunicación", value: {!! $sim_gasto->sistema_comunicacion !!} },
      {label: "Gps", value: {!! $sim_gasto->gps !!} },
      {label: "Otros", value: {!! $sim_gasto->otros !!} }
    ],
    colors:[
              "#9C27B0",
              "#673AB7",
              "#2196F3",
              "#00BCD4",
              "#8BC34A",
              "#FFC107",
              "#FF5722",
              "#E91E63",
              "#03A9F4",
              "#333"
              ]
  });

  Morris.Donut({
    element: 'donut-delta',
    data: [
      {label: "Salario Conductor", value: {!! $sim_gasto->salario_conductor !!} },
      {label: "Prestaciones Sociales", value: {!! $sim_gasto->prestaciones_sociales !!} },
      {label: "Seguridad social", value: {!! $sim_gasto->seguridad_social !!} }
    ],
    colors:[
              "#9C27B0",
              "#673AB7",
              "#2196F3"
              ]
  });

  Morris.Donut({
    element: 'donut-lamda',
    data: [
      {label: "Combustible (10km)", value: {!! ($sim_gasto->acpm_galon * $sim_gasto->galones_kilometro * 10) !!} },
      {label: "Aceites / Filtros", value: {!! $sim_gasto->aceites_filtros !!} },
      {label: "Auditivos", value: {!! $sim_gasto->aditivos !!} },
      {label: "Baterias", value: {!! $sim_gasto->baterias !!}, }
    ],
    colors:[
              "#00BCD4",
              "#8BC34A",
              "#FFC107",
              "#FF5722",
              "#E91E63",
              "#03A9F4",
              "#9C27B0"
              ]
  });


   Morris.Donut({
    element: 'donut-omega',
    data: [
      {label: "Soat", value: {!! $sim_gasto->soat !!} },
      {label: "Técnicomecánica", value: {!! $sim_gasto->tecnicomecanica !!} },
      {label: "Revisión Bimensual", value: {!! $sim_gasto->revision_bimensual !!} },
      {label: "Contratactual", value: {!! $sim_gasto->contractual !!}, },
      {label: "Extracontractual", value: {!! $sim_gasto->extracontractual !!} }
    ],
    colors:[
              "#9C27B0",
              "#2196F3",
              "#00BCD4",
              "#FF5722",
              "#03A9F4"
              ]
  });