<body class="login">
  <style>
  .alert {
    position: absolute !important;
    left: 100% !important;
    float:right !important;
  }
  input {
    float: left;
  }
  </style>
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <a class="hiddenanchor" id="forgot"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
           
              <h1>Login</h1>
              <div id="infoMessage"><?php echo $message;?></div>

              <?php echo form_open("users/login",array("merhod"=>"POST"));?>
              <div>
                <!-- <input type="text" class="form-control" placeholder="Username" required="" /> -->
                <?php echo form_input($identity_login);?>
              </div>
              <div>
                <!-- <input type="password" class="form-control" placeholder="Password" required="" /> -->
                <?php echo form_input($password_login);?> 
              </div>
              <div>
                <?php echo form_submit("Posalji","Posalji");?>
                <!-- <a class="btn btn-default submit" href="<?php echo base_url(); ?>dashboard">Log in</a> -->
                <a class="reset_pass" href="#forgot">Zaboravljena lozinka?</a>
              </div>
              <?php echo form_close(); ?>
              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Novi korisnik?
                  <a href="#signup" class="to_register"> Registriraj se </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-graduation-cap"></i> Konzul</h1>
                  <p>Natjecanje FOI Core, tim PeHPe, aplikacija Konzul</p>
                </div>
              </div>
          
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
          
              <h1>Registracija</h1>
              <div id="infoMessage"><?php if(!empty($reg_errors)) echo $reg_errors;?></div>
              <?php echo form_open("users/register",array("id"=>"form_registracija","novalidate"=>"novalidate"));?>
              <div class="item form-group clearfix">
                <?php echo form_input($first_name);  ?>
              </div>
              <div class="item form-group clearfix">
                <?php echo form_input($last_name);  ?>
              </div>
              <div class="item form-group clearfix">
                <?php echo form_input($identity);  ?>
              </div>
              <div class="item form-group clearfix">
                <?php echo form_input($email);  ?>
              </div>
              <div class="item form-group clearfix">
                <?php echo form_input($company);  ?>
              </div>
              <div class="item form-group clearfix">
                <?php echo form_input($phone);  ?>
              </div>
              <div class="item form-group clearfix">
                <?php echo form_input($password);  ?>
              </div>
              <div class="item form-group clearfix">
                <?php echo form_input($password_confirm);  ?>
              </div>
              <div>
              <?php echo form_submit("Posalji", "Posalji"); ?>
                <!--<a class="btn btn-default submit" href="index.html">Pošalji</a>-->
              </div>
              <?php echo form_close(); ?>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Postojeći korisnik ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-graduation-cap"></i> Konzul</h1>
                  <p>Natjecanje FOI Core, tim PeHPe, aplikacija Konzul</p>
                </div>
              </div>
              
          </section>
        </div>
        <!-- Kraj registracija -->

                                                        <!-- TODO Ovu klasu napisat CSS -->
        <div id="forgot" class="animate form forgot_form">
          <section class="login_content">
            <form>
              <h1>Resetiraj lozinku</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <h5> <i> ili </i> </h5>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                  <p class="change_link">Sjetili ste se lozinke ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-graduation-cap"></i> Konzul</h1>
                  <p>Natjecanje FOI Core, tim PeHPe, aplikacija Konzul</p>
                </div>
              </div>
            </form>
          </section>
        </div>




      </div>
    </div>
    <script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>vendors/nprogress/nprogress.js"></script>
    <!-- validator -->
    <script src="<?php echo base_url(); ?>vendors/validator/validator.js"></script>

    <script src="<?php echo base_url(); ?>js/validation.js"></script>

    <!-- Custom Theme Scripts -->
    <!-- <script src="../build/js/custom.min.js"></script> -->
  </body>