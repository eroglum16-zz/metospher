<!-- TERMS AND CONDITIONS -->
<div id="termsModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #44b1c1; color: white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Metospher - Hükümler ve Koşullar</h4>
      </div>
      <div class="modal-body">
        <?php $this->load->view('terms_view'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
      </div>
    </div>

  </div>
</div>
<!-- END TERMS AND CONDITIONS -->

<!-- REPORT OTHER USERS -->
<div id="reportModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #44b1c1; color: white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Şikayet Kutusu</h4>
      </div>
      <div class="modal-body">
        <form class="form" role="form" id="reportForm" method="post" action="<?php echo site_url('home/report_user/'); ?>">
          <textarea class="form-control" style="margin-bottom: 20px" placeholder="Lütfen şikayet sebebinizi buraya yazın..." name="ct_text" rows="5" maxlength="255" required></textarea>
          <div class="checkbox checkbox-info form-group" style="margin-bottom: 20px">
            <input name="block" value="1" type="checkbox" id="blockCheck"> 
            <label for="blockCheck">
              Bu kullanıcıyı engellemek istiyorum
            </label>
          </div> 
          <button class="btn btn-primary form-control">Gönder</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
      </div>
    </div>

  </div>
</div>
<!-- END REPORT OTHER USERS -->

<script type="text/javascript">
  $(document).on("click", ".report-dialog", function () {
    var user = $(this).data('user');
    
    var frm = document.getElementById('reportForm') || null;
      if(frm) {
         frm.action += user;
      }
    
  });
</script>

<!-- BEGIN PRE-FOOTER -->
    <div class="pre-footer">
      <div class="container">
        <div class="row">
          <!-- BEGIN BOTTOM ABOUT BLOCK -->
          <div class="col-md-5 col-sm-12 pre-footer-col">
            <h2 style="margin-bottom: : 30px">İletişim Bilgileri</h2>

            <div class="contact-info">
              <div class="footer-last-content">
                <p><i style="margin-right: 5px" class="fa fa-map-marker"></i>İstanbul / Beşiktaş</p>
                <p><i style="margin-right: 5px" class="fa fa-mobile"></i>+90 (537) 846 05 71</p>
                <p><i style="margin-right: 5px" class="fa fa-envelope"></i> <a href="mailto: contact@metospher.com">contact@metospher.com</a></p>
              </div>
            </div>
                                    

            
          </div>
          <!-- END BOTTOM ABOUT BLOCK -->

          <!-- BEGIN BOTTOM CONTACTS -->
          <div class="col-md-offset-2 col-md-4 col-sm-12 pre-footer-col">
            
                  <h2>Hızlı İletişim</h2>
                  
                  <!-- BEGIN FORM-->
                  <form action="<?php echo site_url('login/save_contact'); ?>" role="form" method="post">
                    <?php if(!$this->session->has_userdata('email')){ ?>
                    <div class="form-group">
                      <label for="contacts-name">İsim</label>
                      <input name="contacts_name" class="form-control" id="contacts-name">
                    </div>
                    <div class="form-group">
                      <label for="contacts-email">Email</label>
                      <input name="contacts_email" type="email" class="form-control" id="contacts-email">
                    </div>
                    <?php } ?>
                    <div class="form-group">
                      <label for="contacts-message">Mesaj</label>
                      <textarea name="contacts_message" class="form-control" rows="5" id="contacts-message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary "><i class="icon-ok"></i>Gönder</button>
                    
                  </form>
                  <!-- END FORM-->
                
          </div>
          <!-- END BOTTOM CONTACTS -->

        </div>
      </div>
    </div>
    <!-- END PRE-FOOTER -->

    <!-- BEGIN FOOTER -->
    <div class="footer">
      <div class="container">
        <div class="row">
          <!-- BEGIN COPYRIGHT -->
          <div class="col-md-4 col-sm-4 padding-top-10">
            <?php echo date("Y"); ?> © Metospher. Tüm hakları saklıdır. <a style="cursor: pointer;" data-toggle="modal" data-target="#termsModal">Hükümler ve Koşullar</a>
          </div>
          <!-- END COPYRIGHT -->
          <!-- BEGIN PAYMENTS -->
          <div class="col-md-4 col-sm-4">
            <ul class="social-footer list-unstyled list-inline pull-right">
              <li><a target="_blank" href="https://m.facebook.com/Metospher-507477293012635/"><i class="fa fa-facebook"></i></a></li>
              <li><a target="_blank" href="https://www.linkedin.com/in/metospher-education-society-473340172"><i class="fa fa-linkedin"></i></a></li>
              <li><a target="_blank" href="https://twitter.com/metospher"><i class="fa fa-twitter"></i></a></li>
              <li><a target="_blank" href="https://www.instagram.com/metospher"><i class="fa fa-instagram"></i></a></li>
            </ul>  
          </div>
          <!-- END PAYMENTS -->
          <!-- BEGIN POWERED 
          <div class="col-md-4 col-sm-4 text-right">
            <p class="powered">Powered by: <a href="http://www.keenthemes.com/">KeenThemes.com</a></p>
          </div>
          END POWERED -->
        </div>
      </div>
    </div>
    <!-- END FOOTER -->

    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="assets/plugins/respond.min.js"></script>
    <![endif]-->

    
    
    
    
    
    
    
    

    <script src=<?php echo base_url("assets/plugins/bootstrap/js/bootstrap.min.js"); ?> type="text/javascript"></script>
    <script src=<?php echo base_url("assets/plugins/bootstrap-select/js/bootstrap-select.js"); ?> type="text/javascript"></script>
    <script src=<?php echo base_url("assets/plugins/bootstrap-select/js/i18n/defaults-tr_TR.js"); ?> type="text/javascript"></script>
    <script src=<?php echo base_url("assets/corporate/scripts/back-to-top.js"); ?> type="text/javascript"></script>

    <!-- Birthday Picker  -->
    <script src=<?php echo base_url("assets/plugins/bootstrap-birthday/dobpicker.js"); ?> type="text/javascript"></script>

    <script src=<?php echo base_url("assets/plugins/tooltipster/js/tooltipster.bundle.min.js"); ?> type="text/javascript"></script>

    <script src=<?php echo base_url("assets/plugins/tooltipster/js/tooltipster.bundle.min.js"); ?> type="text/javascript"></script>

    <script src=<?php echo base_url("assets/plugins/jquery-migrate.min.js"); ?> type="text/javascript"></script>

    

    


    
    <script type="text/javascript">
      $(document).ready(function(){
        $.dobPicker({
          // Selectopr IDs
          daySelector: '#day',
          monthSelector: '#month',
          yearSelector: '#year',

          // Default option values
          dayDefault: 'Gün',
          monthDefault: 'Ay',
          yearDefault: 'Yıl',

          // Minimum age
          minimumAge: 12,

          // Maximum age
          maximumAge: 80
        });
      });
    </script>

    <script>
        $(document).ready(function() {
            $('.tooltipster').tooltipster({
                theme: 'tooltipster-borderless',
                interactive: true,
            });
        });
    </script>
    
    
    
    <!-- END CORE PLUGINS -->

    

    <script src=<?php echo base_url("assets/corporate/scripts/layout.js"); ?> type="text/javascript"></script>

    <script src=<?php echo base_url("assets/plugins/bootstrap-validator/validator.js"); ?> type="text/javascript"></script>

    
    
    

    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();
            /*    
            Layout.initOWL();
            Layout.initTwitter(); */
            if (screen.width>800) {Layout.initFixHeaderWithPreHeader();}  /* Switch On Header Fixing (only if you have pre-header) */
            Layout.initNavScrolling();
        });
    </script>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            Portfolio.init();
        });
    </script>

    <!-- jquery.inputmask -->
    <script src=<?php echo base_url("assets/plugins/bootstrap-inputmask/jquery.inputmask.bundle.js"); ?> type="text/javascript"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        $(":input").inputmask();
        or
        Inputmask().mask(document.querySelectorAll("input"));
      });
    </script>

    <script src=<?php echo base_url("assets/plugins/bootstrap-imageupload/js/img-upload.js"); ?> type="text/javascript"></script>

    <script src=<?php echo base_url("assets/plugins/dropzone/dropzone.js"); ?> type="text/javascript"></script>

    <script>
      $('.img-upload').imgUpload({
        allowedFormats: [ 'jpg','png','jpeg','JPG' ],
        maxFileSizeKb: 6144
      });
    </script>




    


    <script src=<?php echo base_url("assets/pages/scripts/portfolio.js"); ?> type="text/javascript"></script>

    <script src=<?php echo base_url("assets/plugins/jquery-mixitup/jquery.mixitup.min.js"); ?> type="text/javascript"></script>

    
        
</body>
<!-- END BODY -->
</html>