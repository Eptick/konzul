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
                      <div class="container postavke-input">
                      
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

                    <br />
                    <form id="dostupnost_termina" data-parsley-validate class="form-horizontal form-label-left">
                        
                          <div class="container">
                            <div class="col-md-1 postavke-switch">
                              <label>
                                Pon: <input  id="Mon" value="Mon" type="checkbox" class="js-switch" name="cMon"/> 
                              </label>
                            </div>
                            <div class="col-md-11 col-sm-6 col-xs-12 hideRange animate">
                              <input class="vrijeme_od_do" type="text" id="rangeMon" value="" name="rangeMon" />
                            </div>
                          </div>

                          <div class="container">
                            <div class="col-md-1 postavke-switch">
                              <label>
                                Uto: <input id="Tue" value="Tue" type="checkbox" class="js-switch"  name="cTue"/> 
                              </label>
                            </div>
                            <div class="col-md-11 col-sm-6 col-xs-12 hideRange">
                              <input class="vrijeme_od_do" type="text" id="rangeTue" value="" name="rangeTue" />
                            </div>
                          </div>

                          <div class="container">
                            <div class="col-md-1 postavke-switch">
                              <label>
                                Sri: <input  id="Wed" value="Wed" type="checkbox" class="js-switch" name="cWed"  /> 
                              </label>
                            </div>
                            <div class="col-md-11 col-sm-6 col-xs-12 hideRange">
                              <input class="vrijeme_od_do" type="text" id="rangeWed" value="" name="rangeWed" />
                            </div>
                          </div>

                          <div class="container">
                            <div class="col-md-1 postavke-switch">
                              <label>
                                Čet: <input  id="Thu" value="Thu" type="checkbox" class="js-switch" name="cThu"  /> 
                              </label>
                            </div>
                            <div class="col-md-11 col-sm-6 col-xs-12 hideRange">
                              <input class="vrijeme_od_do" type="text" id="rangeThu" value="" name="rangeThu" />
                            </div>
                          </div>

                          <div class="container">
                            <div class="col-md-1 postavke-switch">
                              <label>
                                Pet: <input  id="Fri" value="Fri" type="checkbox" class="js-switch"   name="cFri"/> 
                              </label>
                            </div>
                            <div class="col-md-11 col-sm-6 col-xs-12 hideRange">
                              <input class="vrijeme_od_do" type="text" id="rangeFri" value="" name="rangeFri" />
                            </div>
                          </div>

                          <div class="container">
                            <div class="col-md-1 postavke-switch">
                              <label>
                                Sub: <input  id="Sat" value="Sat" type="checkbox" class="js-switch"  name="cSat" /> 
                              </label>
                            </div>
                            <div class="col-md-11 col-sm-6 col-xs-12 hideRange">
                              <input class="vrijeme_od_do" type="text" id="rangeSat" value="" name="rangeSat" />
                            </div>
                          </div>

                          <div class="container">
                            <div class="col-md-1 postavke-switch">
                              <label>
                                Ned: <input  id="Sun" value="Sun" type="checkbox" class="js-switch" name="cSun"  /> 
                              </label>
                            </div>
                            <div class="col-md-11 col-sm-6 col-xs-12 hideRange">
                              <input class="vrijeme_od_do" type="text" id="rangeSun" value="" name="rangeSun" />
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


