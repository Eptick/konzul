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
                    <h2>Dostupnost<small>termina</small></h2>
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
                  <style>
                  .hideRange {
                   display: none;
                  }
                  .showRange 
                  {
                    display: block;
                  }
                  </style>
                    <br />
                    <!--- TODO SLATI PODATKE ZA SPREMANJE U BAZU -->
                    <form id="dostupnost_termina" data-parsley-validate class="form-horizontal form-label-left">
                        
                          <div class="container">
                            <div class="col-md-1">
                              <label>
                                Pon: <input  id="MON" value="MON" type="checkbox" class="js-switch" /> 
                              </label>
                            </div>
                            <div class="col-md-11 col-sm-6 col-xs-12 hideRange animate">
                              <input class="vrijeme_od_do" type="text" id="rangeMON" value="" name="rangeMON" />
                            </div>
                          </div>

                          <div class="container">
                            <div class="col-md-1">
                              <label>
                                Uto: <input id="TUE" value="TUE" type="checkbox" class="js-switch"  /> 
                              </label>
                            </div>
                            <div class="col-md-11 col-sm-6 col-xs-12 hideRange">
                              <input class="vrijeme_od_do" type="text" id="rangeTUE" value="" name="rangeTUE" />
                            </div>
                          </div>

                          <div class="container">
                            <div class="col-md-1">
                              <label>
                                Sri: <input  id="WED" value="WED" type="checkbox" class="js-switch"  /> 
                              </label>
                            </div>
                            <div class="col-md-11 col-sm-6 col-xs-12 hideRange">
                              <input class="vrijeme_od_do" type="text" id="rangeWED" value="" name="rangeWED" />
                            </div>
                          </div>

                          <div class="container">
                            <div class="col-md-1">
                              <label>
                                Čet: <input  id="THU" value="THU" type="checkbox" class="js-switch"  /> 
                              </label>
                            </div>
                            <div class="col-md-11 col-sm-6 col-xs-12 hideRange">
                              <input class="vrijeme_od_do" type="text" id="rangeTHU" value="" name="rangeTHU" />
                            </div>
                          </div>

                          <div class="container">
                            <div class="col-md-1">
                              <label>
                                Pet: <input  id="FRI" value="FRI" type="checkbox" class="js-switch"  /> 
                              </label>
                            </div>
                            <div class="col-md-11 col-sm-6 col-xs-12 hideRange">
                              <input class="vrijeme_od_do" type="text" id="rangeFRI" value="" name="rangeFRI" />
                            </div>
                          </div>

                          <div class="container">
                            <div class="col-md-1">
                              <label>
                                Sub: <input  id="SAT" value="SAT" type="checkbox" class="js-switch"  /> 
                              </label>
                            </div>
                            <div class="col-md-11 col-sm-6 col-xs-12 hideRange">
                              <input class="vrijeme_od_do" type="text" id="rangeSAT" value="" name="rangeSAT" />
                            </div>
                          </div>

                          <div class="container">
                            <div class="col-md-1">
                              <label>
                                Ned: <input  id="SUN" value="SUN" type="checkbox" class="js-switch"  /> 
                              </label>
                            </div>
                            <div class="col-md-11 col-sm-6 col-xs-12 hideRange">
                              <input class="vrijeme_od_do" type="text" id="rangeSUN" value="" name="rangeSUN" />
                            </div>
                          </div>


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" type="button">Cancel</button>
						               <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
