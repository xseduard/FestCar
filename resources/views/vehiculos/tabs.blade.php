
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs"> 

              <li class=""><a href="#documentos" data-toggle="tab" aria-expanded="true">Documentos</a></li>

              <li class="active"><a href="#simul_gastos" data-toggle="tab" aria-expanded="true">Simulador de gastos</a></li>

              <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Ajustes</a></li>

            </ul>
            <div class="tab-content">             

              <!-- /.tab-pane -->
              <div class="tab-pane" id="documentos">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  
                 @include('vehiculos.show-soat')
                 @include('vehiculos.show-tecnicomecanica')
                 @include('vehiculos.show-tarjetaoperacion')
                 @include('vehiculos.show-polizaresponsabilidad')
                 
                  <li>                  
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->
               <!-- /.tab-pane -->
              <div class="tab-pane active" id="simul_gastos">
                <!-- The timeline -->   
                
                @include('vehiculos.show-simulador')  
               

              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->


        