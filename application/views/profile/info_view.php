<h2>Öğretim Tecrübesi</h2>
<div class="content-form-page">
  <div class="row">
    <div class="col-md-7 col-sm-9 col-xs-11">
      <!--
      <p>
        <?php echo $this->session->userdata['short_info']; ?>
      </p>
      -->

      <form class="form form-vertical col-lg-7 col-md-8 col-sm-9 col-xs-12" role="form" method="post" action="<?php echo site_url('profile/update_info'); ?>">
        <!-- <p class="text-danger"> Serfitikalarınızdan bahsedebilirsiniz: </p> -->

          <script>
            function countChar(val) {
              len = val.value.length;
              if (len >= 255) {
                val.value = val.value.substring(0, 255);
                $('#charNum').css('background-color','brown');
                $('#charNum').text(255 - len);
              } else {
                $('#charNum').text(255 - len);
                $('#charNum').css('background-color','#00baba'); 
              }
            };
          </script>

          <div class="form-group">
            <textarea class="form-control" id="infoText" name="info_text" style="width: 100%;"  rows="9" maxlength="256" onkeyup="countChar(this)"><?php echo $this->session->userdata['short_info']; ?></textarea>
          <div class="text-center" style="background-color: #00baba; color: white" id="charNum"><?php echo 255-mb_strlen($this->session->userdata['short_info']) ; ?></div>
          </div>
          <div class="form-group">
            <button class="form-control btn btn-primary" type="submit" >Kaydet</button>  
          </div>
          

      </form>
    </div>
    <div class="col-md-4 col-sm-4 pull-right">
      <div class="form-info">
        <h2><em>Önemli</em> Hatırlatma</h2>
        <p>Sisteme kaydolurken kendiniz hakkında yazdığınız kısa yazıyı görüntülüyorsunuz. Bu yazı, diğer insanların sizi çalışma partneri olarak seçmesinde önemli rol oynar.  Burada <i>eğitiminiz</i>, <i>kariyeriniz</i>, <i>serfitikalarınız</i> ve diğer <i>öğretim tecrübeleriniz</i> konusunda bilgi verebilirsiniz.</p>

      </div>
    </div>
  </div>
</div>