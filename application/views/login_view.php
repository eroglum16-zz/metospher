<?php
defined('BASEPATH') OR exit('No direct script access allowed');

foreach ($cities as $city) {
  $districts[$city['city_no']]=$this->login_m->get_district_by_city($city['city_no']);
}

?>


<div class="main">



  <div class="container">

<!-- https://silviomoreto.github.io/bootstrap-select/examples/ -->

   	<div class="content-page">
        <div class="row margin-bottom-20">
          <?php if($reg_error!=false){ ?>
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong>Ops!</strong> Bu email daha önce alınmış gibi gözüküyor.
            </div>
          <?php }?>

          <?php if($login_error){ ?>
          <div class="alert alert-danger ?> alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>Ops! </strong> Girdiğiniz şifre veya email yanlış.
          </div>
          <?php } ?>

          <?php if($verification_sent){ ?>
          <div class="alert alert-success ?> alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>Hoşgeldiniz! </strong> Email adresinize onay linki gönderdik. Hesabınızı bu link ile aktifleştirebilirsiniz.
          </div>
          <?php } ?>

          <?php if($unregistered_email){ ?>
          <div class="alert alert-danger ?> alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>Ops! </strong>Şifre değişikliği talep ettiğiniz email üzerine kayıtlı bir hesap bulunamadı.
          </div>
          <?php } ?>

          <?php if($request_expired){ ?>
          <div class="alert alert-danger ?> alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>Ops! </strong>Şifre değişikliği talebi süre aşımına uğramış. Tekrar talepte bulunmak için <a data-toggle="tab" href="#forgot-password">tıklayın</a>.
          </div>
          <?php } ?>

          <?php if($temp_password_error){ ?>
          <div class="alert alert-danger ?> alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>Ops! </strong>Şifreniz güncellenirken bir hata oluştu. Geçici şifreyi doğru girdiğinizden emin olun.
          </div>
          <?php } ?>

          <?php if($password_request_sent){ ?>
          <div class="alert alert-success ?> alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>Aramıza dönebilirsiniz! </strong>Geçici bir şifre email adresinize gönderildi. Oradaki linke tıklayarak şifrenizi değiştirebilirsiniz.
          </div>
          <?php } ?>

          <?php if($user_not_active){ ?>
          <div class="alert alert-warning ?> alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>Son bir adım! </strong>Metospher topluluğuna katılmadan önce atmanız gereken son adım email hesabınıza giderek size gönderdiğimiz aktivasyon linkine tıklamak.
          </div>
          <?php } ?>

          <?php if($account_frozen){ ?>
          <div class="alert alert-warning ?> alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>Hoşçakalın! </strong>Hesabınızı dondurdunuz. Aramıza dönmeniz için sabırsızlıkla bekliyor olacağız.
          </div>
          <?php } ?>

          

          <div class="col-md-6 col-sm-6">
            <div class="tab-content">
              <div id="home" class="tab-pane fade in active">
                <form class="form-horizontal" method="post" action="<?php echo site_url('login/register'); ?>" role="form">
                  <fieldset>
                    <legend>Bir hesap oluşturun  </legend>
                    <div class="form-group">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <input maxlength="36" type="text" class="form-control" name="name" placeholder="Adınız" required>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <input maxlength="36" type="text" class="form-control" name="surname" placeholder="Soyadınız" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <input maxlength="255" type="email" class="form-control" name="email"  placeholder="Email adresiniz" required>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <input maxlength="36" type="password" class="form-control" name="password" placeholder="Yeni şifre" required>
                      </div>
                    </div>
                  </fieldset>
                  <fieldset>
                    <legend>Bilgileriniz</legend>
                    <div class="form-group">
                      <label for="day" class="col-lg-3 col-md-3 col-sm-12 col-xs-12">Doğum Tarihi <span class="require">*</span></label>
                      <div class="col-lg-9 col-xs-12">
                        <select class="selectpicker col-lg-3 col-md-3 col-sm-3 col-xs-10" data-live-search="true" name="day" id="day" required>
                        </select>
                        <select class="selectpicker col-lg-5 col-md-3 col-sm-3 col-xs-10" data-live-search="true" name="month" id="month" required>
                        </select>
                        <select class="selectpicker col-lg-3 col-md-3 col-sm-3 col-xs-10 " data-live-search="true" name="year" id="year" required>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Cinsiyet <span class="require">*</span></label>
                      <div class="col-lg-2 col-md-2 col-lg-offset-1 col-sm-3 col-xs-5 col-xs-offset-1 radio radio-danger">
                        <span>
                          <input type="radio" name="gender" id="woman" value="1" checked> 
                          <label  for="woman">Kadın</label>
                        </span>
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 radio radio-primary">
                        <span>
                          <input class="checkbox-primary" type="radio" name="gender" id="man" value="0"> 
                          <label for="man" ">Erkek</label>
                        </span>
                      </div>
                    </div>
                    <!--
                    <div class="form-group">
                      <label for="phone" class="col-lg-3 col-md-3 col-sm-6 col-xs-7 control-label">Cep numaranız<span class="require">*</span></label>
                      <div class="col-lg-4 col-lg-offset-1  col-sm-6 col-xs-7">
                        <input type="text" class="form-control" name="phone" id="phone" data-inputmask="'mask' : '(999) 999-9999'" required>
                      </div>
                    </div>
                  -->
                    <div class="form-group">
                      <label for="city" id="cityLabel" class="col-lg-3 col-md-3 col-sm-12 col-xs-12">Yaşadığınız yer<span class="require">*</span></label>
                      <div class="col-lg-9 col-xs-12">
                        <select required class="selectpicker col-lg-5 col-md-5 col-sm-5 col-xs-5" title="İl seçin..." data-live-search="true" name="city" id="city" onchange="configureDropDownLists(this,document.getElementById('district'))" required>
                          <?php foreach ($cities as $city) { ?>
                            <option value="<?php echo $city['city_no']; ?>" <?php if($city['city_no']==34) echo "selected"; ?>  > <?php echo $city['city_name']; ?> </option>
                          <?php } ?>
                        </select>
                        <select required class="selectpicker col-lg-5 col-md-5 col-sm-5 col-xs-5" title="İlçe seçin..." data-live-search="true" name="district" id="district" required>
                          <?php foreach ($districts[34] as $district) { ?>
                            <option value="<?php echo $district['district_no']; ?>" <?php if($district['district_name']=="Beşiktaş") echo "selected"; ?> > <?php echo $district['district_name']; ?> </option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <script type="text/javascript">
                      function configureDropDownLists(ddl1,ddl2) {

                        var cities = <?php echo json_encode($cities); ?>;
                        var districts = <?php echo json_encode($districts); ?>;

                        for (j = 0; j < cities.length; j++) {
                          if(ddl1.value==(j+1)){

                            var city = new Array();
                            var city_no = new Array();
                            $.each(districts[j+1], function (i, elem) {
                                city.push(elem['district_name']); 
                                city_no.push(elem['district_no']); 
                            });

                            ddl2.options.length = 0;
                            for (i = 0; i < city.length; i++) {
                                createOption(ddl2, city[i], city_no[i]);
                            }
                            $('#district').selectpicker('refresh');
                          }
                        }
                      }

                      function createOption(ddl, text, value) {
                          var opt = document.createElement('option');
                          opt.value = value;
                          opt.text = text;
                          ddl.options.add(opt);
                      }
                  </script>

                    

                  </fieldset>
                  <fieldset>
                    <legend>Hükümler ve Koşullar</legend>
                    <div class="col-lg-8 col-md-8" style="margin-bottom: 10px;">
                      Kaydol düğmesine tıklayarak,<a style="cursor: pointer;" data-toggle="modal" data-target="#termsModal">Hükümler ve koşullarımızı</a> kabul etmiş olursunuz.
                    </div>
                    <div class="col-lg-4 col-md-4">
                      <button type="submit" class="btn btn-danger btn-block btn-lg">Kaydol</button>
                    </div>
                  </fieldset>
                </form>
              </div>
              <div style="margin-top: 15%; margin-bottom:15%;" id="forgot-password" class="tab-pane fade">
                <h1>Şifrenizi mi unuttunuz?</h1>
                <div class="content-form-page">
                  <div class="row">
                    <div class="col-md-5 col-sm-5">
                      <div style="margin-bottom: 10px; margin-top: 15px;" class="row">
                        <a data-toggle="tab" href="#home"> <i class="fa fa-chevron-left"></i> Kayıt formu</a>
                      </div>
                      <form class="form-horizontal form-without-legend" role="form" action="<?php echo site_url('login/send_temp_password'); ?>" method="post">                    
                        <div class="form-group">
                          
                            <input name="email-forgot" type="email" placeholder="Email adresiniz" class="form-control" id="email">
                          
                        </div>
                        <div class="row">
                          <div class=" padding-left-0 padding-top-5">
                            <button type="submit" class="btn btn-primary btn-block">Şifre Gönder</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-6 col-sm-6 pull-right">
                      <div class="form-info">
                        <h2><em>Önemli</em> Bilgi</h2>
                        <p>Sitemize kaydolduğunuz email adresini girin. Gönder tuşuna basarak yeni bir şifre alın ve güvenliğiniz için bu şifreyi değiştirin.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>

          <div class="col-md-6 col-sm-6">
            

              <img src="<?php echo base_url('assets/pages/img/pics/society6.jpg'); ?>">

          </div>

        </div>  


        

      <!-- BEGIN STEPS -->
      <div class="row margin-bottom-40 front-steps-wrapper front-steps-count-3">
        <div class="col-md-4 col-sm-4 front-step-col">
          <div class="front-step front-step1">
            <h2>Üye olun</h2>
            <p>İsim, email ve diğer bilgilerinizi doldurarak üye olun. Daha kolay bulunabilir hale gelin.</p>
          </div>
        </div>
        <div class="col-md-4 col-sm-4 front-step-col">
          <div class="front-step front-step2">
            <h2>Ders eklemelerinizi yapın</h2>
            <p>Öğrenmek istediğiniz ve öğretebileceğiniz dersleri kaydederek profil görünümünüzü tamamlayın.</p>
          </div>
        </div>
        <div class="col-md-4 col-sm-4 front-step-col">
          <div class="front-step front-step3">
            <h2>Sizi buluşturalım</h2>
            <p>Seçtiğiniz şehirde öğrenmek ve öğretmek istediğiniz derslerle eşleşen kişileri sizinle buluşturalım.</p>
          </div>
        </div>
      </div>
      <!-- END STEPS -->
    </div>
  </div>
</div>
    
