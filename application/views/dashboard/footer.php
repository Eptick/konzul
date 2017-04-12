
        <!-- footer content -->
        <footer>
          <div class="pull-right">
           Natjecanje FOI Core, tim PeHPe, aplikacija Konzul
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->

      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>build/js/custom.min.js"></script>
    	
	<!-- Page specific js -->
    <?php
    foreach($script as $link){
        echo '
		<script src="'.base_url().$link.'"></script>
		';
    }
    ?>
    
  </body>
</html>