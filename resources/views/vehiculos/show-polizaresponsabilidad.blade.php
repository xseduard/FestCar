
                   <!-- timeline item -->
                  @if($documentos['polizaresponsabilidad'] != 'notfound')
                    <li class="time-label">
                          <span class="bg-aqua">
                            RCC RCE
                          </span>
                    </li>
                      <li>
                        <i class="fa fa-check bg-aqua"></i>
                        <div class="timeline-item">
                          <span class="time" title="Última modificación"><i class="fa fa-clock-o"></i> {!! $documentos['polizaresponsabilidad']->updated_at->diffForHumans() !!}</span>

                          <h3 class="timeline-header no-border"> Codigo <a href="#">{!! $documentos['polizaresponsabilidad']->codigo !!} </a> </h3>

                          <div class="timeline-body">
                              <table class="table table-custom-posed">                                
                                  <tr>                                   
                                    <td><strong>Inicio vigencia</strong></td>
                                    <td><strong>Final vigencia</strong></td>
                                    <td rowspan="2" class="porcentaje_chart"> {!! round($documentos['polizaresponsabilidad']->dias_actual_diferencia * 100 / $documentos['polizaresponsabilidad']->dias_diferencia, 2); !!} % </td>
                                    <td rowspan="2" width="64px" style="padding-left: 0px;" title="{!!$documentos['polizaresponsabilidad']->dias_actual_diferencia," / ",$documentos['polizaresponsabilidad']->dias_diferencia; !!} Días">
                                         <span class="pie" data-peity='{ "fill": ["#00b0a3", "#d2d6de"],  "innerRadius": 28, "radius": 32 }'>{!! $documentos['polizaresponsabilidad']->dias_actual_diferencia !!}/{!! $documentos['polizaresponsabilidad']->dias_diferencia !!}</span>            
                                    </td>

                                  </tr>
                                  <tr>                                  
                                    <td>{!! $documentos['polizaresponsabilidad']->fecha_vigencia_inicio->format('d-M-Y') !!}</td>                                  
                                    <td>{!! $documentos['polizaresponsabilidad']->fecha_vigencia_final->format('d-M-Y') !!}</td>                                  
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

                      <h3 class="timeline-header no-border"><span class="text-red"> <b> Poliza de responsabilidad (RCC RCE):</b> No se encuentra registrada o esta vencida, <a href='/polizaResponsabilidads/create' target='_blank'>Registrar aquí</a>
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  @endif

                  <!--final item -->