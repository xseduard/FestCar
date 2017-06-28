<!-- timeline item -->
                  @if($documentos['tarjetaoperacion'] != false)
                    <li class="time-label">
                          <span class="bg-aqua">
                            Tarjeta Operación
                          </span>
                    </li>
                      <li>
                        <i class="fa fa-plus bg-aqua"></i>
                        <div class="timeline-item">
                          <span class="time" title="Última modificación"><i class="fa fa-clock-o"></i> {!! $documentos['tarjetaoperacion']->updated_at->diffForHumans() !!}</span>

                          <h3 class="timeline-header no-border"> Codigo <a href="#">{!! $documentos['tarjetaoperacion']->codigo !!} </a> </h3>

                          <div class="timeline-body">
                              <table class="table table-custom-posed">                                
                                  <tr>
                                    <td><strong>Razón social</strong></td>
                                    <td><strong>Modalidad</strong></td>
                                    <td><strong>Radio de Acción</strong></td>
                                    <td><strong>Inicio</strong></td>
                                    <td><strong>Final</strong></td>
                                    <td rowspan="2" class="porcentaje_chart"> {!! round($documentos['tarjetaoperacion']->dias_actual_diferencia * 100 / $documentos['tarjetaoperacion']->dias_diferencia, 2); !!} % </td>
                                    <td rowspan="2" width="64px" style="padding-left: 0px;" title="{!!$documentos['tarjetaoperacion']->dias_actual_diferencia," / ",$documentos['tarjetaoperacion']->dias_diferencia; !!} Días">
                                         <span class="pie" data-peity='{ "fill": ["#00b0a3", "#d2d6de"],  "innerRadius": 28, "radius": 32 }'>{!! $documentos['tarjetaoperacion']->dias_actual_diferencia !!}/{!! $documentos['tarjetaoperacion']->dias_diferencia !!}</span>            
                                    </td>

                                  </tr>
                                  <tr>
                                    <td>{!! $documentos['tarjetaoperacion']->razon_social_empresa !!}</td>
                                    <td>{!! $documentos['tarjetaoperacion']->modalidad_servicio !!}</td>
                                    <td>{!! $documentos['tarjetaoperacion']->radio_accion !!}</td>                                  
                                    <td>{!! $documentos['tarjetaoperacion']->fecha_vigencia_inicio->format('d-M-Y') !!}</td>                                  
                                    <td>{!! $documentos['tarjetaoperacion']->fecha_vigencia_final->format('d-M-Y') !!}</td>                                  
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
                      <h3 class="timeline-header no-border"><span class="text-red"> 
                        <b>Tarjeta de Operación:</b> No se encuentra registrada o esta vencida, <a href='/tarjetaOperacions/create' target='_blank'>Registrar aquí</a>
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  @endif

                  <!--final item -->