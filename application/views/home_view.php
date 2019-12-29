<?php
defined('BASEPATH') OR exit('No direct script access allowed');

foreach ($cities as $city) {
  $districts[$city['city_no']]=$this->login_m->get_district_by_city($city['city_no']);
}

$match_number=count($matches);
$page_population=10;
$page_number=$match_number/$page_population;

$registration_date=strtotime($this->session->userdata['reg_date']);

if($registration_date < strtotime("2 days ago"))$experienced_user = true; else $experienced_user=false;



?>

<div class="main">   

  <div class="container">
       		
          <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            
            <div class="content-page">

              <div class="row margin-bottom-30">
                <!-- BEGIN INFO BLOCK --> 
                
                <h2 style="margin-bottom: 30px" class="no-top-space text-center">Haydi keşfedelim!</h2>
                <?php if(!$experienced_user){ ?>
                <!-- BEGIN SERVICE BOX -->   
                <div class="row service-box margin-bottom-40 hidden-for-mobile">
                  <div class="col-md-4 col-sm-4">
                    <div class="service-box-heading">
                      <em><i class="fa fa-pencil-square-o blue"></i></em>
                      <span>Kaydınız tamamlandı</span>
                    </div>
                    <p>Sisteme başarıyle kaydoldunuz. Size daha iyi hizmet verebilmemiz için lütfen fotoğrafınızı yüklediğinizden, kendinizle ilgili özet bir yazı yazdığınızdan ve ders seçimi yaptığınızdan emin olun.</p>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="service-box-heading">
                      <em><i class="fa fa-check red"></i></em>
                      <span>Aktivasyonunuz yapıldı</span>
                    </div>
                    <p>Size uygun çalışma arkadaşları bulmamız için gerekli olan aktivasyonu yaptınız. Şimdi sıra seçeneklerinizi keşfetmekte. Metosfer, size en uygun kişileri sizin için sıralar.</p>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="service-box-heading">
                      <em><i class="fa fa-globe green"></i></em>
                      <span>Şimdi keşif zamanı!</span>
                    </div>
                    <p>Aşağıda öğrenmek istediklerinizi öğretebilecek, öğretebileceklerinizi öğrenmek isteyen, yaşadığınız yere yakın kişileri bulabilirsiniz.</p>
                  </div>
                </div>
                <!-- END SERVICE BOX -->
                <?php }elseif($this->session->has_userdata('after_frozen')){ ?>
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Tekrar hoşgeldiniz!</strong> Sizi tekrar aramızda görmek çok güzel. Vakit kaybetmeden çalışma arkadaşlarınızı bulun.
                  </div>
                <?php } ?>
              </div>

              <hr>

              <?php if(isset($alert_type)){ ?>
                <div class="alert alert-<?php echo $alert_type; ?> alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                  <strong><?php echo $alert_strong; ?></strong> <?php echo $alert_text; ?>
                </div>
              <?php } ?>

              <?php if(!$experienced_user){ ?>
              <h2 class="hidden-for-mobile">Sizin için bulduklarımız</h2>
              <br>
              <?php } ?>

              <div class="row">
                <!-- BEGIN LEFT SIDEBAR -->

                

                <div style="margin-bottom: 30px;" class="col-md-9 col-sm-9 col-xs-12 blog-posts">

                  
                  

                  <div class="tab-content">
                    
                      <?php if(empty($matches)==false&& is_array($matches)){ $counter=0;
                              foreach ($matches as $match) {
                                if($counter%$page_population==0){ ?>
                                  <div id="page<?php echo $counter/$page_population+1; ?>" class="tab-pane fade <?php if($counter==0)echo'in active' ?> ">
                      <?php } ?>

                        <div class="row">
                          <div class="col-md-4 col-sm-4">
                            <img onerror="this.src='<?php echo base_url(); ?>/assets/profiles/no-avatar.png'" class="img-responsive" alt="<?php echo $match['user_info']['name']." ".$match['user_info']['surname'] ?>"  src="<?php echo base_url().'assets/profiles/'.$match['user_info']['user_id'].'.jpg'; ?>"> 
                          </div>
                          <div class="col-md-8 col-sm-8">
                            <h2 ><?php echo $match['user_info']['name']." ".$match['user_info']['surname'] ?></h2>
                            
                            <ul class="blog-info">

                              <?php $age= date("Y")-date("Y",strtotime($match['user_info']['birthdate'])); ?>
                              <li><i class="fa fa-calendar"></i> <?php echo $age; ?> yaşında</li>

                              <?php if($match['user_info']['gender']==1) $fa_gender='female'; else $fa_gender='male'  ?>
                              <?php if($match['user_info']['gender']==1) $gender='Kadın'; else $gender='Erkek'  ?>
                              <li><i class="fa fa-<?php echo $fa_gender; ?>"></i> <?php echo $gender; ?> </li>

                              <li><i class="fa fa-map-marker"></i> <?php echo $match['user_info']['city_name']; ?> / <?php echo $match['user_info']['district_name']; ?> </li>

                              <?php if(isset($match['user_info']['institution'])){ ?> <li style="margin-top: 10px"><i class="fa fa-building"></i><?php echo $match['user_info']['institution']; ?></li> <?php } ?>
                            </ul>
                            <ul class="blog-info">
                              <li><strong>Öğretebilecekleri: </strong><i><?php if(isset($match['teaches_me'])) foreach ($match['teaches_me'] as $teach) echo $teach." , ";  ?></i> <?php $count=0; foreach ($match['teaches'] as $teach){ echo $teach; if(next($match['teaches'])) echo " , "; else $count++; if($count==1) echo " , ";  } ?> </li>
                            </ul>
                            <ul class="blog-info">
                              <li><strong>Öğrenmek istedikleri: </strong><i><?php if(isset($match['learns_from_me'])) foreach ($match['learns_from_me'] as $learn) echo $learn." , ";  ?></i> <?php foreach ($match['learns'] as $learn){echo $learn; if(next($match['learns'])) echo " , ";};  ?></li>
                            </ul>
                            <a style="margin-right: 5%" data-toggle="modal" data-id="<?php echo $match['user_info']['short_info']; ?>" data-name="<?php echo $match['user_info']['name'].' '.$match['user_info']['surname']; ?>" href="#info_modal" class="more info-dialog"> Öğretim Tecrübesi <i class="icon-angle-right"></i></a>
                            <?php if (is_array($already_requested)) {
                              if (in_array($match['user_info']['user_id'], $already_requested)) { ?>
                                
                                <button onclick="window.location.href='<?php echo site_url('request/chats/').$match['user_info']['user_id']; ?>'" type="submit" class="btn btn-primary">Ders isteği mevcut</button>

                              <?php }else{ ?>

                                <button onclick="window.location.href='<?php echo site_url('request/send_request/').$match['user_info']['user_id']; ?>'" type="submit" class="btn btn-danger">Ders isteği gönder</button>

                              <?php } 
                            }  else{ 
                              if ($match['user_info']['user_id']==$already_requested) {?>

                                <button disabled type="submit" class="btn btn-primary">Ders isteği mevcut</button>

                              <?php }else{ ?>

                                <button onclick="window.location.href='<?php echo site_url('request/send_request/').$match['user_info']['user_id']; ?>'" type="submit" class="btn btn-danger">Ders isteği gönder</button>

                              <?php }
                            } ?>
                          </div>
                        </div>
                        <hr class="blog-post-sep">

                      <?php 
                            if(($counter+1)%$page_population==0||($counter+1)==$match_number){ ?>
                              </div>
                              <?php } $counter++;  ?>

                      <?php      } }else { ?>
                        <div class="alert alert-warning alert-dismissible fade in" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <strong>Eşleşme bulunamadı!</strong> <?php echo $not_found; if(isset($search_page)&&$search_page==false){ ?>  Derslerinizi güncellemek ister misiniz: <a href="<?php echo site_url('profile/settings/change_teach'); ?>"> güncelle <?php } ?></a>
                        </div>
                      <?php } ?>
                    
                    

                    
                  </div>
                  <ul class="pagination" >
                    <li><a href="javascript:;">Sayfalar:</a></li>
                    <li class="active"><a style="cursor: pointer;" data-toggle="tab" href="#page1">1</a></li>
                    <?php for ($i=1; $i <$page_number ; $i++) { ?>
                      <li><a data-toggle="tab" href="#page<?php echo $i+1; ?>"><?php echo $i+1; ?></a></li>
                    <?php } ?>
                  </ul>
                  <ul class="pagination" id="top" >
                    <li><a href="#top">Yukarı <i class="fa fa-chevron-up"></i></a></li>
                  </ul>
                  
                  <script type="text/javascript">
                    $('#top').click(function(e){
                      var $target = $('html,body');
                      $target.animate({scrollTop: $target.height()}, 500);
                    });
                  </script>

                                 
                </div>
                <!-- END LEFT SIDEBAR -->

                <!-- BEGIN RIGHT SIDEBAR -->            
                <div class="col-md-3 col-sm-3 col-xs-12 blog-sidebar">
                  <!-- CATEGORIES START -->
                  <h2 class="no-top-space">Öğrenecekleriniz</h2>
                  <ul class="nav sidebar-categories margin-bottom-40">
                    <li <?php if($selected_lesson=='all') echo 'class="active"'; ?> ><a href="<?php echo site_url('home/options/').$selected_city.'/'.$selected_district.'/all' ?>">Tüm derslerim </a></li>
                    <?php foreach ($mylearns as $mylearn) { ?>

                      <li <?php if($selected_lesson==$mylearn['lesson']) echo 'class="active"'; ?>  ><a href="<?php echo site_url('home/options/').$selected_city.'/'.$selected_district.'/'.$mylearn['lesson']; ?>"><?php echo $mylearn['lesson_name']; ?> </a></li>

                    <?php } ?>

                    
                  </ul>
                  <!-- CATEGORIES END -->

                  <!-- BEGIN CITY -->                            
                  <h2>Şehir</h2>
                  <div class="margin-bottom-10">
                    
                    
                    <form class="form-vertical" method="post" action="<?php echo site_url('home/options/'.$selected_city.'/'.$selected_district.'/'.$selected_lesson); ?>" role="form">
  
                      <select data-size="8" class="selectpicker form-group" title="İl seçin..." data-live-search="true" name="city" id="city" onchange="configureDropDownLists(this,document.getElementById('district'))" required>
                        <option <?php if($selected_city=="not_matters") echo "selected";?> value="not_matters">Fark etmez</option>
                        <?php foreach ($cities as $city) { ?>
                          <option value="<?php echo $city['city_no']; ?>" <?php if($city['city_no']==$selected_city) echo "selected"; ?>  > <?php echo $city['city_name']; ?> </option>
                        <?php } ?>
                      </select>
                      <select data-size="8" class="selectpicker form-group" title="İlçe seçin..." data-live-search="true" name="district" id="district" required>
                        <option <?php if($selected_district=="not_matters") echo "selected";?> value="not_matters">Fark etmez</option>
                        <?php foreach ($districts[$selected_city] as $district) { ?>
                          <option value="<?php echo $district['district_no']; ?>" <?php if($district['district_no']==$selected_district) echo "selected";?> > <?php echo $district['district_name']; ?> </option>
                        <?php } ?>
                      </select>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary form-group">Değiştir</button>
                      </div>
                      
                    
                    </form>
                  </div>
                  <!-- END CITY -->
                  <script type="text/javascript">
                    function configureDropDownLists(ddl1,ddl2) {

                      var cities = <?php echo json_encode($cities); ?>;
                      var districts = <?php echo json_encode($districts); ?>;

                      if (ddl1.value=="not_matters") {
                        ddl2.options.length = 0;
                        createOption(ddl2,"Fark etmez","not_matters");
                        $('#district').selectpicker('refresh');
                      }

                      for (j = 0; j < cities.length; j++) {
                        if(ddl1.value==(j+1)){

                          var city = new Array();
                          var city_no = new Array();
                          $.each(districts[j+1], function (i, elem) {
                              city.push(elem['district_name']); 
                              city_no.push(elem['district_no']); 
                          });

                          ddl2.options.length = 0;
                          createOption(ddl2,"Fark etmez","not_matters");
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

                </div>
                <!-- END RIGHT SIDEBAR -->            
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

        <!-- Modal -->
        <div class="modal fade" id="info_modal" style="margin-top: 15%" role="dialog">
          <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="font-weight: bold; color: #00baba; font-family: qaranta" id="nameSurname" class="modal-title">Ad Soyad</h4>
              </div>
              <div class="modal-body">
                <p style="font-family: comic sans ms; font-size: 1.2em; overflow: auto;" id="infoText"></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-danger"  data-dismiss="modal">Kapat</button>
              </div>
            </div>
          </div><
        </div>

        <script type="text/javascript">
          $(document).on("click", ".info-dialog", function () {
            var shortInfo = $(this).data('id');
            var names=$(this).data('name');
            
            if (shortInfo.length==0) {$(".modal-body #infoText").text( "Bu kullanıcı öğretim tecrübelerinden bahsetmemiş." );}
            else $(".modal-body #infoText").text( shortInfo );
            $(".modal-header #nameSurname").text( names );
          });
        </script>


        <script type="text/javascript">
          (function(seconds) {
              var refresh,       
                  intvrefresh = function() {
                      clearInterval(refresh);
                      refresh = setTimeout(function() {
                         location.href = location.href;
                      }, seconds * 1000);
                  };

              $(document).on('keypress click', function() { intvrefresh() });
              intvrefresh();

          }(1500)); // define here seconds
        </script>

    </div>

</div>