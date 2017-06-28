 <!-- timeline item -->
                  @if($documentos['soat'] != false)
                    <li class="time-label">
                          <span class="bg-aqua">
                            Seguro Soat 
                          </span>
                    </li>
                      <li>
                        <i class="fa fa-plus bg-aqua"></i>
                        <div class="timeline-item">
                          <span class="time" title="Última modificación"><i class="fa fa-clock-o"></i> {!! $documentos['soat']->updated_at->diffForHumans() !!}</span>

                          <h3 class="timeline-header no-border"> Poliza <a href="#">{!! $documentos['soat']->poliza !!} </a> </h3>

                          <div class="timeline-body">
                              <table class="table table-custom-posed">                                
                                  <tr>
                                    <td><strong>Cédula</strong></td>
                                    <td><strong>Tomador</strong></td>
                                    <td><strong>Entidad</strong></td>
                                    <td><strong>Inicio</strong></td>
                                    <td><strong>Final</strong></td>
                                    <td rowspan="2" class="porcentaje_chart"> {!! round($documentos['soat']->dias_actual_diferencia * 100 / $documentos['soat']->dias_diferencia, 2); !!} % </td>
                                    <td rowspan="2"  width="64px" style="padding-left: 0px;" title="{!!$documentos['soat']->dias_actual_diferencia," / ",$documentos['soat']->dias_diferencia; !!} Días">
                                         <span class="pie" data-peity='{ "fill": ["#00b0a3", "#d2d6de"],  "innerRadius": 28, "radius": 32 }'>{!! $documentos['soat']->dias_actual_diferencia !!}/{!! $documentos['soat']->dias_diferencia !!}</span>            
                                    </td>

                                  </tr>
                                  <tr>
                                    <td>{!! $documentos['soat']->tomador_cedula !!}</td>
                                    <td>{!! $documentos['soat']->tomador_nombre !!}</td>
                                    <td>{!! $documentos['soat']->entidad !!}</td>                                  
                                    <td>{!! $documentos['soat']->fecha_vigencia_inicio->format('d-M-Y') !!}</td>                                  
                                    <td>{!! $documentos['soat']->fecha_vigencia_final->format('d-M-Y') !!}</td>                                  
                                  </tr>
                                  
                              </table>
                          </div>
                        </div>
                      </li>
                  @else
                    <!-- timeline item -->
                  <li>
                    <i class='fa fa fa-exclamation fa-spin fa-fw bg-red'></i>

                    <div class="timeline-item">
                      <!-- <span class="time"><i class="fa fa-clock-o"></i> Hace 5 minutos</span>-->

                      <h3 class="timeline-header no-border"><span class="text-red"><b>Soat:</b> No se encuentra registrado o esta vencido, <a href='/soats/create' target='_blank'>Registrar aquí</a> 
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  @endif

                  <!--final item -->