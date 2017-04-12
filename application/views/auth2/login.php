<body class="login">
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
                <?php echo form_input($identity);?>
              </div>
              <div>
                <!-- <input type="password" class="form-control" placeholder="Password" required="" /> -->
                <?php echo form_input($password);?> 
              </div>
              <div>
                <?php echo form_submit("submit","submit");?>
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
            <form>
              <h1>Kreiraj račun</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Pošalji</a>
              </div>

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
            </form>
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
  </body>