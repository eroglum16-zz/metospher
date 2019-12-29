<?php
$months=array();
$months[1]="Ocak";
$months[2]="Şubat";
$months[3]="Mart";
$months[4]="Nisan";
$months[5]="Mayıs";
$months[6]="Haziran";
$months[7]="Temmuz";
$months[8]="Ağustos";
$months[9]="Eylül";
$months[10]="Ekim";
$months[11]="Kasım";
$months[12]="Aralık";
 ?>

<div class="main">
  <div class="container">
    <!--
    <ul class="breadcrumb">
        <li><a href="<?php echo site_url('home') ?>">Anasayfa</a></li>
        <li><a href="javascript:;">Kullanıcı Menüsü</a></li>
        <li class="active">İstekler</li>
    </ul>
    -->
    <div class="row margin-bottom-40">
      <!-- BEGIN CONTENT -->
      <div class="col-md-12 col-sm-12">
        <h2>Çalışma İstekleri</h2>
        <div class="content-page">
          <div class="row">
            <div class="col-md-3 col-sm-3" id="list">
              <ul style="margin-bottom: 20px" class="tabbable faq-tabbable">
                <li class="<?php if($person=='new') echo 'active' ?>"><a href="<?php echo site_url('request/chats/new'); ?>">Yeni istekler <?php if(count($requests)>0){ ?> <blink style="background-color: #2491a1" class="badge"><?php echo count($requests); ?></blink> <?php } ?> </a></li>
                
                <?php foreach ($accepted_requests as $a_r) { ?>
                  <li class="<?php if($person==$a_r['req_from']) echo 'active' ?>" ><a href="<?php echo site_url('request/chats/'.$a_r['req_from']); ?>" > <?php echo $a_r['name']." ".$a_r['surname']; ?> <?php $unseen=$this->request_m->get_unseen_number($a_r['req_id']); if($unseen>0){ ?> <span style="border-style: outset; padding: 2px;"> <?php echo $unseen; ?> </span> <?php } ?> </a></li>
                <?php }  ?>

                <?php foreach ($sent_accepted_requests as $sar) { ?>
                  <li class="<?php if($person==$sar['req_to']) echo 'active' ?>" ><a href="<?php echo site_url('request/chats/'.$sar['req_to']); ?>" > <?php echo $sar['name']." ".$sar['surname']; ?> <?php $unseen=$this->request_m->get_unseen_number($sar['req_id']); if($unseen>0){ ?> <span style="border-style: outset; padding: 2px;"> <?php echo $unseen; ?> </span> <?php } ?> </a></li>
                <?php }  ?>
                
              </ul>
            </div>
            <div class="col-md-9 col-sm-9">

              <?php if($person!='new'){ ?>

                  <div class="row">
                    <div class="col-md-6 col-md-offset-1 col-sm-6 col-sm-offset-1">
                        <div class="panel panel-info">
                            <div class="panel-heading" id="accordion">
                                <span class="fa fa-comment"></span> Konuşmanız <a class="tooltipster" title="Konuşma karşı taraftan da kaldırılacaktır" style="float: right;" href="<?php echo site_url('request/delete_message/').$person; ?>"> Konuşmayı bitir </a>
                            </div>
                        <div class="panel" id="collapseOne">
                            <div class="panel-body">
                                
                              <div id="msg_history" class="msg_history">
                                <?php if(count($messages)==0){ ?>
                                  <div style="width: 95%" class="alert alert-danger">
                                    Bu konuşmada henüz mesaj yok.
                                  </div>
                                <?php }?>
                                <?php foreach ($messages as $message) { if($message['msg_to']==$this->session->userdata['user_id']){ ?>
                                  <div class="incoming_msg">
                                    <div class="incoming_msg_img"> <img onerror="this.src='../../../assets/profiles/no-avatar.png'" src="<?php echo base_url().'assets/profiles/'.$message['msg_from'].'.jpg'; ?>" alt="<?php echo $person_info['name']." ".$person_info['surname']; ?>"> 
                                    </div>
                                    <div class="received_msg">
                                      <div onmouseover="document.getElementById('time<?php echo $message['msg_id']; ?>').style.visibility = 'visible'" onmouseout="document.getElementById('time<?php echo $message['msg_id']; ?>').style.visibility = 'hidden'" class="received_withd_msg">

                                        
                                        <p class="tooltipster" title="<?php echo date("G:i - d", strtotime($message['msg_time']))." ".$months[date("n", strtotime($message['msg_time']))]." ".date("Y", strtotime($message['msg_time'])); ?>  " > <?php echo $message['msg_text']; ?>   </p>
                                      </div>
                                    </div>
                                  </div>
                                <?php }else{ ?>
                                  <div class="outgoing_msg">
                                    <div class="sent_msg">
                                      <p class="tooltipster" title="<?php echo date("G:i - d", strtotime($message['msg_time']))." ".$months[date("n", strtotime($message['msg_time']))]." ".date("Y", strtotime($message['msg_time'])); ?> " onmouseover="document.getElementById('time<?php echo $message['msg_id']; ?>').style.visibility = 'visible'" onmouseout="document.getElementById('time<?php echo $message['msg_id']; ?>').style.visibility = 'hidden'" ><?php echo $message['msg_text']; ?>  </p>
                                    </div>
                                  </div>
                                <?php }}?>
                              </div>
                              <div class="type_msg" style="margin-top: 10px">
                                <div class="input_msg_write">
                                  <?php if($person_info['req_from']==$this->session->userdata['user_id']) $to=$person_info['req_to']; else $to=$person_info['req_from']; ?>
                                  <form method="post" action="<?php echo site_url('request/send_message/').$to.'/'.$person_info['req_id']; ?>">
                                  
                                  
                                  <textarea required style="width: 90%; resize: none;" type="text" name="msg_text" class="write_msg" placeholder="Mesaj" onkeydown="if (event.keyCode==13) document.getElementById('send-message').click();"></textarea>
                                  <button class="msg_send_btn fa fa-paper-plane-o" id="send-message" type="submit"><i aria-hidden="true"></i></button>

                                  </form>
                                </div>
                              </div>
      
                            </div>
                            
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1" style="margin-bottom: 30px">
                      <?php if($person_info['req_from']==$this->session->userdata['user_id']){ ?>

                        <div class="row">
                          
                          <div class="col-xs-8 col-xs-offset-2">
                            <img onerror="this.src='../../../assets/profiles/no-avatar.png'" class="img-responsive" alt="<?php echo $person_info['name']." ".$person_info['surname']; ?>"  src="<?php echo base_url().'assets/profiles/'.$person_info['req_to'].'.jpg'; ?>"> 
                          </div>
                          

                        
                        </div>
                      <div class="tooltipster row" data-tooltip-content="#tooltip_content" style="padding-left: 5%">
                        
                          <h2><?php echo $person_info['name']." ".$person_info['surname']; ?></h2>
                          <div class="tooltip_templates">
                            <span style="cursor: pointer;" data-toggle="modal" data-target="#reportModal" data-user="<?php echo $person_info['user_id']; ?>" id="tooltip_content" class="report-dialog">
                              Kullanıcıyı şikayet et
                            </span>
                          </div>
                          <ul class="blog-info">

                          <?php $age= date("Y")-date("Y",strtotime($person_info['birthdate'])); ?>
                          <li><i class="fa fa-calendar"></i> <?php echo $age." yaşında"; ?> </li>

                          <?php if($person_info['gender']==1) $fa_gender='female'; else $fa_gender='male'  ?>
                          <?php if($person_info['gender']==1) $gender='Kadın'; else $gender='Erkek'  ?>
                          <li><i class="fa fa-<?php echo $fa_gender ?>"></i> <?php echo $gender ?> </li>

                          <li style="margin-top: 10px;"><i class="fa fa-map-marker"></i> <?php echo $person_info['city_name']; ?> / <?php echo $person_info['district_name']; ?> </li>

                          <?php if(isset($person_info['institution'])){ ?> <li style="margin-top: 10px"><i class="fa fa-building"></i><?php echo $person_info['institution']; ?></li> <?php } ?>


                        </ul>
                        <ul class="blog-info">
                          <li><strong>Öğretebilecekleri: </strong><?php echo $this->request_m->get_teaches_by_id($person_info['req_to']); ?> </li>
                        </ul>
                        <ul class="blog-info">
                          <li><strong>Öğrenmek istedikleri: </strong><?php echo $this->request_m->get_learns_by_id($person_info['req_to']); ?></li>
                        </ul>
                        <a style="margin-right: 5%" data-toggle="modal" data-id="<?php echo $person_info['short_info']; ?>" data-name="<?php echo $person_info['name'].' '.$person_info['surname']; ?>" href="#info_modal" class="more info-dialog"> Öğretim Tecrübesi <i class="icon-angle-right"></i></a>

                        <a style="cursor: pointer;" data-toggle="modal" data-target="#reportModal" data-user="<?php echo $person_info['user_id']; ?>" id="mobile" class="report-dialog">
                          Kullanıcıyı şikayet et
                        </a>
                          

                        <script type="text/javascript">
                          if (screen.width<800) {$("#mobile").css("display","inline");}
                          else {$("#mobile").css("display","none");}
                        </script>
                        
                        
                      </div>

                      <?php }else{ ?>

                      <div class="row">
                          
                          <div class="col-xs-8 col-xs-offset-2">
                            <img onerror="this.src='../../../assets/profiles/no-avatar.png'" class="img-responsive" alt="<?php echo $person_info['name']." ".$person_info['surname']; ?>"  src="<?php echo base_url().'assets/profiles/'.$person_info['req_from'].'.jpg'; ?>"> 
                          </div>
                          

                        
                      </div>
                      <div class="tooltipster row" data-tooltip-content="#tooltip_content" style="padding-left: 5%">
                        
                          <h2> <?php echo $person_info['name']." ".$person_info['surname']; ?> </h2>

                          <div class="tooltip_templates hidden-for-mobile">
                            <span style="cursor: pointer;" data-toggle="modal" data-target="#reportModal" data-user="<?php echo $person_info['user_id']; ?>" id="tooltip_content" class="report-dialog">
                              Kullanıcıyı şikayet et
                            </span>
                          </div>

                          <ul class="blog-info">

                          <?php $age= date("Y")-date("Y",strtotime($person_info['birthdate'])); ?>
                          <li><i class="fa fa-calendar"></i> <?php echo $age." yaşında"; ?> </li>

                          <?php if($person_info['gender']==1) $fa_gender='female'; else $fa_gender='male'  ?>
                          <?php if($person_info['gender']==1) $gender='Kadın'; else $gender='Erkek'  ?>
                          <li><i class="fa fa-<?php echo $fa_gender ?>"></i> <?php echo $gender ?> </li>

                          <li style="margin-top: 10px;"><i class="fa fa-map-marker"></i> <?php echo $person_info['city_name']; ?> / <?php echo $person_info['district_name']; ?> </li>

                          <?php if(isset($person_info['institution'])){ ?> <li style="margin-top: 10px"><i class="fa fa-building"></i><?php echo $person_info['institution']; ?></li> <?php } ?>
                        </ul>
                        <ul class="blog-info">
                          <li><strong>Öğretebilecekleri: </strong><?php echo $this->request_m->get_teaches_by_id($person_info['req_from']); ?> </li>
                        </ul>
                        <ul class="blog-info">
                          <li><strong>Öğrenmek istedikleri: </strong><?php echo $this->request_m->get_learns_by_id($person_info['req_from']); ?></li>
                        </ul>
                        <a style="margin-right: 5%" data-toggle="modal" data-id="<?php echo $person_info['short_info']; ?>" data-name="<?php echo $person_info['name'].' '.$person_info['surname']; ?>" href="#info_modal" class="more info-dialog"> Öğretim Tecrübesi <i class="icon-angle-right"></i></a>

                        
                        <a style="cursor: pointer;" data-toggle="modal" data-target="#reportModal" data-user="<?php echo $person_info['user_id']; ?>" id="mobile" class="report-dialog">
                          Kullanıcıyı şikayet et
                        </a>
                          

                        <script type="text/javascript">
                          if (screen.width<800) {$("#mobile").css("display","inline");}
                          else {$("#mobile").css("display","none");}
                        </script>
                        
                        
                      </div>

                      <?php } ?>
                      
                    </div>
                  </div>

              <?php }else { ?>
                <?php if(count($requests)>0){ ?>
                  <div class="alert alert-info alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                  <strong>Sizinle çalışmak isteyenler var!</strong> Aşağıda size çalışma isteği göndermiş olan kişileri görmektesiniz. Konuşmaya başla diyerek kişiyle bir diyalog başlatabilir ve anlaşmaya varabilirsiniz.
                </div>
                <?php }else{ ?>
                  <div class="alert alert-danger alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                  <strong>Şimdilik teklif yok! </strong><a href="<?php echo site_url('home'); ?>">Anasayfa</a>'dan çalışma arkadaşı bulup teklif gönderebilirsiniz.
                </div>
                <?php } ?>


                <?php  foreach ($requests as $request) {  ?>

                   <?php $range = date_range(date("Y-m-d",strtotime($request['req_time'])), date("Y-m-d")); $daysPast=count($range)-1; if($daysPast==0) $label="Bugün gönderildi."; elseif($daysPast==1) $label="Dün gönderildi."; else $label=$daysPast." gün önce gönderildi."; ?>
                <div class="tooltipster row" title="<?php echo $label; ?>" >
                  <div class="col-md-4 col-sm-4">
                    <img onerror="this.src='../assets/profiles/no-avatar.png'" class="img-responsive" alt="Metospher Kullanıcısı"  src="<?php echo base_url().'assets/profiles/'.$request['req_from'].'.jpg'; ?>"> 
                  </div>
                  <div class="col-md-8 col-sm-8">
                    <h2><?php echo $request['name']." ".$request['surname'] ?></h2>
                    <ul class="blog-info">

                      <?php $age= date("Y")-date("Y",strtotime($request['birthdate'])); ?>
                      <li><i class="fa fa-calendar"></i> <?php echo $age." yaşında"; ?> </li>

                      <?php if($request['gender']==1) $fa_gender='female'; else $fa_gender='male'  ?>
                      <?php if($request['gender']==1) $gender='Kadın'; else $gender='Erkek'  ?>
                      <li><i class="fa fa-<?php echo $fa_gender ?>"></i> <?php echo $gender ?> </li>

                      <li style="margin-top: 10px;"><i class="fa fa-map-marker"></i> <?php echo $request['city_name']; ?> / <?php echo $request['district_name']; ?> </li>

                      <?php if(isset($person_info['institution'])){ ?> <li style="margin-top: 10px"><i class="fa fa-building"></i><?php echo $person_info['institution']; ?></li> <?php } ?>

                    </ul>
                    <ul class="blog-info">
                      <li><strong>Öğretebilecekleri: </strong><?php echo $this->request_m->get_teaches_by_id($request['req_from']); ?> </li>
                    </ul>
                    <ul class="blog-info">
                      <li><strong>Öğrenmek istedikleri: </strong><?php echo $this->request_m->get_learns_by_id($request['req_from']); ?></li>
                    </ul>
                    <a style="margin-right: 5%" data-toggle="modal" data-id="<?php echo $request['short_info']; ?>" data-name="<?php echo $request['name'].' '.$request['surname']; ?>" href="#info_modal" class="more info-dialog"> Öğretim Tecrübesi<i class="icon-angle-right"></i></a>
                    <button onclick="window.location.href='<?php echo site_url('request/accept_request/').$request['req_id'].'/'.$request['req_from']; ?>'" type="submit" class="btn btn-danger">Konuşmaya başla</button>

                    <ul class="blog-info">
                      <li><a href="<?php echo site_url('request/decline_request/').$request['req_id']; ?>"><i class="fa fa-thumbs-down"></i> Teklifi reddet</a></li>
                    </ul>                    
                  </div>
                </div>
              <hr class="blog-post-sep">

              <?php }   ?>

              <?php if(count($sent_requests)>0){ ?><h2><a style="cursor: pointer;" data-toggle="collapse" data-target="#sent-requests">Gönderdiğiniz istekler <span class="fa fa-chevron-down"></span></a> </h2><?php } ?>

              <div class="row collapse" id="sent-requests">
              <?php  foreach ($sent_requests as $request) {  ?>

                <?php $range = date_range(date("Y-m-d",strtotime($request['req_time'])), date("Y-m-d")); $daysPast=count($range)-1; if($daysPast==0) $label="Bugün gönderildi."; elseif($daysPast==1) $label="Dün gönderildi."; else $label=$daysPast." gün önce gönderildi."; ?>
                <div class="tooltipster row" title="<?php echo $label; ?>" style="margin-top: 30px">
                <div class="col-md-4 col-sm-4">
                  <img onerror="this.src='../assets/profiles/no-avatar.png'" class="img-responsive" alt="Kullanıcının profil fotoğrafı yok"  src="<?php echo base_url().'assets/profiles/'.$request['req_to'].'.jpg'; ?>"> 
                </div>
                <div class="col-md-8 col-sm-8">
                  <h2><?php echo $request['name']." ".$request['surname'] ?></h2>
                  <ul class="blog-info">

                    <?php $age= date("Y")-date("Y",strtotime($request['birthdate'])); ?>
                    <li><i class="fa fa-calendar"></i> <?php echo $age." yaşında"; ?> </li>

                    <?php if($request['gender']==1) $fa_gender='female'; else $fa_gender='male'  ?>
                    <?php if($request['gender']==1) $gender='Kadın'; else $gender='Erkek'  ?>
                    <li><i class="fa fa-<?php echo $fa_gender ?>"></i> <?php echo $gender ?> </li>

                    <li style="margin-top: 10px;"><i class="fa fa-map-marker"></i> <?php echo $request['city_name']; ?> / <?php echo $request['district_name']; ?> </li>

                    <?php if(isset($person_info['institution'])){ ?> <li style="margin-top: 10px"><i class="fa fa-building"></i><?php echo $person_info['institution']; ?></li> <?php } ?>
                    
                  </ul>
                  <ul class="blog-info">
                    <li><strong>Öğretebilecekleri: </strong><?php echo $this->request_m->get_teaches_by_id($request['req_to']); ?> </li>
                  </ul>
                  <ul class="blog-info">
                    <li><strong>Öğrenmek istedikleri: </strong><?php echo $this->request_m->get_learns_by_id($request['req_to']); ?></li>
                  </ul>

                  <ul class="blog-info">
                    <li><a href="<?php echo site_url('request/decline_request/').$request['req_id']; ?>"><i class="fa fa-trash"></i> İsteği geri çek</a></li>
                    <li><button disabled class="btn btn-danger">Cevap bekleniyor</button></li>
                  </ul>

                  
                  
                </div>
              </div>
              <hr class="blog-post-sep">

              <?php } echo "</div>"; } ?>

            </div>
          </div>
        </div>
      </div>
      <!-- END CONTENT -->

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
              <p style="font-family: comic sans ms; font-size: 1.2em;" id="infoText"></p>
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
        var element = document.getElementById("msg_history");
        element.scrollTop = element.scrollHeight;
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

      }(180)); // define here seconds
    </script>

    </div>
  </div>
</div>