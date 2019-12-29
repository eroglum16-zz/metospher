<div class="main">
  <div class="container">
    <div class="alert alert-<?php echo $alert_type; ?> alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      <strong><?php echo $alert_strong; ?></strong> <?php echo $alert_text; ?>
    </div>
    <!--
    <ul class="breadcrumb">
        <li><a href="<?php echo site_url('home') ?>">Anasayfa</a></li>
        <li><a href="javascript:;">Kullanıcı Menüsü</a></li>
        <li class="active">İstekler</li>
    </ul>
    -->
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
      <!-- BEGIN CONTENT -->
      <div class="col-md-12 col-sm-12">
        <h2>Fotoğraf Ekleyin</h2>
        
        <div class="content-page">
          <div class="row front-team">
                <ul class="list-unstyled">
                  <li class="col-lg-3 col-md-4 col-sm-6">
                    <p> <span><i class="fa fa-check"></i></span> <span class="hidden-for-mobile">Maksimum 2MB büyüklüğünde bir fotoğraf yükleyin.</span> <span id="mobile"></span></p>
                    <script type="text/javascript">
                      if (screen.width<800) {$('#mobile').text('Fotoğraf yüklemek için bilgisayarınızı kullanabilirsiniz.');}
                    </script>
                    <div class="thumbnail hidden-for-mobile">
                      
                      <?php echo form_open_multipart(site_url('register/upload_photo'));?>
                      <div class="form-group">
                          <div class="img-upload">
                              <div class="img-file-tab">
                                  <div>
                                      <span class="btn btn-default btn-file img-select-btn">
                                          <span>Fotoğrafınızı seçin...</span>
                                          <input type="file" name="userfile">
                                      </span>
                                      <span class="btn btn-danger img-remove-btn">Sil</span>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
            
                    <h2>
                      Kurum Ekleyin
                    </h2>
                    <p> <span><i class="fa fa-check"></i></span> Kurum belirtmek isterseniz bu alanı kullanabilirsiniz. </i></p>
                    <div class="form-group">
                      <input class="form-control" type="text" name="institution" maxlength="255" placeholder="Kurum, şirket veya okul ismi...">
                    </div>

                      <h2>
                        Bilgi Ekleyin
                        
                      </h2>

                      <p> <span><i class="fa fa-check"></i></span> Öğretim tecrübelerinizden ve serfitikalarınızdan burda bahsedebilirsiniz: </p>

                      <script>
                        function countChar(val) {
                          var len = val.value.length;
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

                      <textarea style="width: 100%" name="info" placeholder="Bu yazı, diğer insanların sizi çalışma partneri olarak seçmesinde önemli rol oynar.  Burada eğitiminiz, kariyeriniz, serfitikalarınız ve diğer öğretim tecrübeleriniz konusunda bilgi verebilirsiniz." rows="9" maxlength="256" onkeyup="countChar(this)"></textarea>
                      <div class="text-center" style="background-color: #00baba; color: white" id="charNum">255</div>
                    </div>
                  </li>
                </ul>            
              </div>
          
          
          <hr>
          <button type="submit" class="btn btn-success">Bitir</button>
          </form>
        </div>
      </div>
      <!-- END CONTENT -->
    </div>
    <!-- BEGIN SIDEBAR & CONTENT -->
  </div>
</div>
    