 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Postavke</h3>
              </div>
              <!--
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div> -->
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Postavke<small>korisnika</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <br />
                    <form id="postavke-korisnika" class="form-horizontal form-label-left">
                      <div class="form-group postavke-input">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Handle 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php echo form_input($postavke_handle); ?>
                        </div>
                      </div>

                      <div class="form-group postavke-input">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Trajanje termina 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php echo form_input($postavke_trajanje); ?>
                  
                        </div>
                      </div>

                      <div class="form-group postavke-input">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Automatsko prihvacanje
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php echo form_input($postavke_automatsko_prihvacanje); ?>
                        </div>
                      </div>

                      <div class="form-group postavke-input">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Dopusti van termina
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php echo form_input($postavke_dopusti_van_termina); ?>
                        </div>
                      </div>
                      <div class="ln_solid"></div> 




                      <div class="form-group postavke-input">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mail
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php echo form_input($postavke_obavjesti_mail); ?>
                        </div>
                      </div>
                      <div class="form-group postavke-input">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Facebook
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php echo form_input($postavke_obavjesti_face); ?>
                        </div>
                      </div>
                      <div class="form-group postavke-input">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Viber
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php echo form_input($postavke_obavjesti_viber); ?>
                        </div>
                      </div><div class="form-group postavke-input">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SMS
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php echo form_input($postavke_obavjesti_sms); ?>
                        </div>
                      </div>


                          
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-1 col-sm-6 col-xs-12 col-md-offset-5">
                          <button id="submit-postavke" type="submit" class="btn btn-default">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Dostupnost<small>termina</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Dodaj termin</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <br />
                    <form id="dostupnost_termina" data-parsley-validate class="form-horizontal form-label-left">


                          <div class="container">
                            <div class="col-md-2 postavke-switch">
                              <label>
                                Pon: <input  id="Mon" value="Mon" type="checkbox" <?php if(isset($dostupnost_mon)) echo "checked" ?> class="js-switch" name="cMon"/> 
                              </label>
                            </div>
                            <div class="col-md-10 col-sm-6 col-xs-12 hideRange <?php if(isset($dostupnost_mon)) echo "showRange" ?> animate">
                              <?php if(isset($dostupnost_mon)) echo form_input($dostupnost_mon); 
                               else echo '<input class="vrijeme_od_do" type="text" id="rangeMon" value="" name="rangeMon" />' ?>
                            </div>
                          </div>

                          <div class="container">
                            <div class="col-md-2 postavke-switch">
                              <label>
                                Uto: <input  id="Tue" value="Tue" type="checkbox" <?php if(isset($dostupnost_tue)) echo "checked" ?> class="js-switch" name="cTue"/> 
                              </label>
                            </div>
                            <div class="col-md-10 col-sm-6 col-xs-12 hideRange <?php if(isset($dostupnost_tue)) echo "showRange" ?> animate">
                              <?php if(isset($dostupnost_tue)) echo form_input($dostupnost_tue); 
                               else echo '<input class="vrijeme_od_do" type="text" id="rangeTue" value="" name="rangeTue" />' ?>
                            </div>
                          </div>



                          <div class="container">
                            <div class="col-md-2 postavke-switch">
                              <label>
                                Sri: <input  id="Wed" value="Wed" type="checkbox" <?php if(isset($dostupnost_wed)) echo "checked" ?> class="js-switch" name="cWed"/> 
                              </label>
                            </div>
                            <div class="col-md-10 col-sm-6 col-xs-12 hideRange <?php if(isset($dostupnost_wed)) echo "showRange" ?> animate">
                              <?php if(isset($dostupnost_wed)) echo form_input($dostupnost_wed); 
                               else echo '<input class="vrijeme_od_do" type="text" id="rangeWed" value="" name="rangeWed" />' ?>
                            </div>
                          </div>



                          <div class="container">
                            <div class="col-md-2 postavke-switch">
                              <label>
                                Čet: <input  id="Thu" value="Thu" type="checkbox" <?php if(isset($dostupnost_thu)) echo "checked" ?> class="js-switch" name="cThu"/> 
                              </label>
                            </div>
                            <div class="col-md-10 col-sm-6 col-xs-12 hideRange <?php if(isset($dostupnost_thu)) echo "showRange" ?> animate">
                              <?php if(isset($dostupnost_thu)) echo form_input($dostupnost_thu); 
                               else echo '<input class="vrijeme_od_do" type="text" id="rangeThu" value="" name="rangeThu" />' ?>
                            </div>
                          </div>

                          <div class="container">
                            <div class="col-md-2 postavke-switch">
                              <label>
                                Pet: <input  id="Fri" value="Fri" type="checkbox" <?php if(isset($dostupnost_fri)) echo "checked" ?> class="js-switch" name="cFri"/> 
                              </label>
                            </div>
                            <div class="col-md-10 col-sm-6 col-xs-12 hideRange <?php if(isset($dostupnost_fri)) echo "showRange" ?> animate">
                              <?php if(isset($dostupnost_fri)) echo form_input($dostupnost_fri); 
                               else echo '<input class="vrijeme_od_do" type="text" id="rangeFri" value="" name="rangeFri" />' ?>
                            </div>
                          </div>


                          <div class="container">
                            <div class="col-md-2 postavke-switch">
                              <label>
                                Sub: <input  id="Sat" value="Sat" type="checkbox" <?php if(isset($dostupnost_sat)) echo "checked" ?> class="js-switch" name="cSat"/> 
                              </label>
                            </div>
                            <div class="col-md-10 col-sm-6 col-xs-12 hideRange <?php if(isset($dostupnost_sat)) echo "showRange" ?> animate">
                              <?php if(isset($dostupnost_sat)) echo form_input($dostupnost_sat); 
                               else echo '<input class="vrijeme_od_do" type="text" id="rangeSat" value="" name="rangeSat" />' ?>
                            </div>
                          </div>


                          <div class="container">
                            <div class="col-md-2 postavke-switch">
                              <label>
                                Ned: <input  id="Sun" value="Sun" type="checkbox" <?php if(isset($dostupnost_sun)) echo "checked" ?> class="js-switch" name="cSun"/> 
                              </label>
                            </div>
                            <div class="col-md-10 col-sm-6 col-xs-12 hideRange <?php if(isset($dostupnost_sun)) echo "showRange" ?> animate">
                              <?php if(isset($dostupnost_sun)) echo form_input($dostupnost_sun); 
                               else echo '<input class="vrijeme_od_do" type="text" id="rangeSun" value="" name="rangeSun" />' ?>
                            </div>
                          </div>

                  


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-1 col-sm-6 col-xs-12 col-md-offset-5">
                          <button id="submit-dostupni-termini" type="submit" class="btn btn-default">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Povezi s<small>Facebookom</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <br />
                
                      <div class="container postavke-input">
                      

                        <div class="form-group">
                          <label class="col-sm-3 control-label">Token za povezivanje</label>

                          <div class="col-sm-9">
                            <div class="input-group">
                              <span class="input-group-btn">
                                  <button type="button" id="genToken" class="btn btn-primary">Generiraj Token</button>
                                            </span>
                              <input type="text" id="setToken" disabled="disabled" class="form-control">
                            </div>
            
                          </div>
                        </div>
                      </div>
                          

                  </div>
                </div>
              </div>
            </div>


