<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>


<div class="main">



  <div class="container">

<!-- https://silviomoreto.github.io/bootstrap-select/examples/ -->

   	<div class="content-page">
        <div class="row margin-bottom-20">
          

          <div class="col-md-6 col-sm-6">

            <div class="row" style="margin-top: 15%;">
              <div class="col-md-7 col-sm-7">
                <form class="form-horizontal form-without-legend" role="form" data-toggle="validator" method="post" action="<?php echo site_url('login/update_temp_password/').$user_id; ?>">                    
                        <div class="form-group">
                          <label for="old-password" class="col-lg-4 control-label">Geçici şifre</label>
                          <div class="col-lg-8">
                            <input autofocus type="text" name="temp_password" class="form-control" id="old-password" value="<?php echo $hash; ?>" required>
                          </div>
                        </div>
                        <legend></legend>
                        <div class="form-group">
                          <label for="inputPassword" class="col-lg-4 control-label">Yeni şifre</label>
                          <div class="col-lg-8">
                            <input type="password" name="new_password" data-minlength="6" class="form-control" id="inputPassword"  required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="email" class="col-lg-4 control-label">Yeni şifre tekrar</label>
                          <div class="col-lg-8">
                            <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Şifreler eşleşmiyor!"  required>
                             <div class="help-block with-errors"></div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-5">
                            <button type="submit" class="btn btn-primary btn-block">Kaydet</button>
                          </div>
                        </div>
                      </form>
              </div>
              <div class="col-md-4 col-sm-4 pull-right">
                <div class="form-info">
                  <h2><em>Önemli</em> Hatırlatma</h2>
                  <p>Geçici şifreniz sisteme giriş yapmak için kullanılamaz. Bu şifreyi burada değiştirmelisiniz. Bu şifrenin talebinizden itibaren <strong>24 saat</strong> geçerliliği vardır.</p>

                </div>
              </div>
            </div>
            
            
            
          </div>

          <div class="col-md-6 col-sm-6">
            <!-- BEGIN SERVICE BLOCKS -->               
              <div class="row margin-bottom-20">
                <div class="col-md-6 col-sm-6">
                  <div class="service-box-v1">
                      <div><i class="fa fa-language color-grey"></i></div>
                      <h2>Yabancı Dil</h2>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="service-box-v1">
                    <div><i class="fa fa-book color-grey"></i></div>
                    <h2>Ders</h2>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="service-box-v1">
                      <div><i class="fa fa-desktop color-grey"></i></div>
                      <h2>Bilgisayar</h2>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="service-box-v1">
                      <div><i class="fa fa-car color-grey"></i></div>
                      <h2>Sürüş</h2>
                   </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="service-box-v1">
                    <div><i class="fa fa-music color-grey"></i></div>
                    <h2>Müzik</h2>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="service-box-v1">
                      <div><i class="fa fa-bars color-grey"></i></div>
                      <h2>Diğer</h2>
                  </div>
                </div>
              </div>
          </div>

        </div>  


        

      <!-- BEGIN STEPS -->
      <div class="row margin-bottom-40 front-steps-wrapper front-steps-count-3">
        <div class="col-md-4 col-sm-4 front-step-col">
          <div class="front-step front-step1">
            <h2>Üye olun</h2>
            <p>Neler öğretebileceğinizi ve diğer bilgilerinizi doldurarak üye olun. Daha kolay bulunabilir hale gelin.</p>
          </div>
        </div>
        <div class="col-md-4 col-sm-4 front-step-col">
          <div class="front-step front-step2">
            <h2>Aktivasyon yapın</h2>
            <p>Sağ üstten hesabınızı aktifleştirerek sizin için bulduğumuz partnerlerin bilgilerine ulaşın.</p>
          </div>
        </div>
        <div class="col-md-4 col-sm-4 front-step-col">
          <div class="front-step front-step3">
            <h2>Sizi buluşturalım</h2>
            <p>Seçtiğiniz şehirde öğrenmek ve öğretmek istediğiniz derslerle eşleşen kişileri size sunalım.</p>
          </div>
        </div>
      </div>
      <!-- END STEPS -->

      
    </div>

</div>
   

    
</div>


    
