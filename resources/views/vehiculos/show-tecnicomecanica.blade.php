 <!-- timeline item -->
                  @if($documentos['tecnicomecanica'] != false)
                    <li class="time-label">
                          <span class="bg-aqua">
                            Técnicomecánica
                          </span>
                    </li>

                     
                      <li>
                        <i class="fa fa-plus bg-aqua"></i>

                        <div class="timeline-item">
                          <span class="time" title="Última modificación"><i class="fa fa-clock-o"></i> {!! $documentos['tecnicomecanica']->updated_at->diffForHumans() !!}</span>

                          <h3 class="timeline-header no-border"> Codigo control <a href="#">{!! $documentos['tecnicomecanica']->codigo_control !!} </a> </h3>

                          <div class="timeline-body">
                              <table class="table table-custom-posed">                                
                                  <tr>
                                    <td><strong>CDA</strong></td>
                                    <td><strong>Runt</strong></td>
                                    <td><strong>Inicio</strong></td>
                                    <td><strong>Final</strong></td>
                                    <td rowspan="2" class="porcentaje_chart"> {!! round($documentos['tecnicomecanica']->dias_actual_diferencia * 100 / $documentos['tecnicomecanica']->dias_diferencia, 2); !!} % </td>
                                     <td rowspan="2"  width="64px" style="padding-left: 0px;" title="{!!$documentos['tecnicomecanica']->dias_actual_diferencia," / ",$documentos['tecnicomecanica']->dias_diferencia; !!} Días">
                                         <span class="pie" data-peity='{ "fill": ["#00b0a3", "#d2d6de"],  "innerRadius": 28, "radius": 32 }'>{!! $documentos['tecnicomecanica']->dias_actual_diferencia !!}/{!! $documentos['tecnicomecanica']->dias_diferencia !!}</span>            
                                    </td>

                                  </tr>
                                   
                              
                                  <tr>
                                    <td>{!! $documentos['tecnicomecanica']->cda_nombre !!}</td>
                                  <td>{!! $documentos['tecnicomecanica']->consecutivo_runt !!}</td>
                                  <td>{!! $documentos['tecnicomecanica']->fecha_vigencia_inicio->format('d-M-Y') !!}</td>                                  
                                  <td>{!! $documentos['tecnicomecanica']->fecha_vigencia_final->format('d-M-Y') !!}</td>                                  
                                  </tr>
                                  
                              </table>
                          </div>
                        </div>
                      </li>
                  @else
                   @if($documentos['tecnicomecanica'] == 'Vehiculo nuevo')
                     <!-- timeline item -->
                      <li>
                        <i class='fa fa fa-exclamation fa-spin fa-fw bg-red'></i>

                        <div class="timeline-item">
                          <!-- <span class="time"><i class="fa fa-clock-o"></i> Hace 5 minutos</span>-->

                          <h3 class="timeline-header no-border"><span class="text-red"><b>Técnicomecánica</b> No se encuentra registrada o esta vencida, <a href='/tecnicomecanicas/create' target='_blank'>Registrar aquí</a>
                          </h3>
                        </div>
                      </li>
                      <!-- END timeline item -->
                   @else 
                     <li class="time-label">
                          <span class="bg-aqua">
                            Técnicomecánica
                          </span>
                    </li>
                     
                      <li>
                        <i class="fa fa-plus bg-aqua"></i>

                        <div class="timeline-item">
                          <!-- <span class="time"><i class="fa fa-clock-o"></i> Hace 5 minutos</span>-->

                          <h3 class="timeline-header no-border"><span class="text-red"> Vehiculo Nuevo
                          </h3>
                        </div>
                      </li>
                   @endif
                  @endif

                  <!--final item -->