<?php $this_user=$this->session->userdata['user_id']; ?>
<h2>Profil Görünümünüz</h2>
<div class="content-form-page">
  <div class="row">
    <div class="col-md-7 col-sm-7">
      <div style="margin-bottom: 20px " class="profile-userpic">
        <img onerror="this.src='<?php echo base_url(); ?>/assets/profiles/no-avatar.png'" src="<?php echo base_url('assets/profiles/'). $this_user.".jpg"; ?>" class="img-responsive" alt="<?php echo $this->session->userdata['name']." ".$this->session->userdata['surname'] ?>">
      </div>
      <div class="profile-usertitle">
        <div class="profile-usertitle-name">

          <span id="show"> <?php echo $this->session->userdata['name']." ".$this->session->userdata['surname']; ?> 
          <a style="margin-left:5px; cursor: pointer;"  onclick="$('#show').css('display', 'none'); $('#edit').css('display', 'inline');"><i class="fa fa-pencil"></i></a> </span> 
          
          <span style="display: none;" id="edit">
            <form class="form-inline" action="<?php echo site_url('profile/update_name'); ?>" method="post" >
              <a class="form-control" style="cursor: pointer;" onclick="$('#edit').css('display', 'none'); $('#show').css('display', 'inline');"><i class="fa fa-chevron-left"></i></a>
              <input class="form-control" type="text" name="name" placeholder="İsim" required>
              <input class="form-control" type="text" name="surname" placeholder="Soyisim" required>
              <button class="form-control btn btn-primary" type="submit"><i class="fa fa-check"></i></button>
            </form>
          </span>

        </div>
        <ul class="blog-info">

          <?php $age= date("Y")-date("Y",strtotime($this->session->userdata['birthdate'])); ?>

          <li class="editable">
            <a style="cursor: pointer;"  onclick="$('.editable').css('display', 'none'); $('#edit-age').css('display', 'inline');">
              <i class="fa fa-calendar"></i>
            </a> 
            <?php echo $age." yaşında"; ?> 
          </li>

          <?php if($this->session->userdata['gender']==1) $fa_gender='female'; else $fa_gender='male'  ?>
          <?php if($this->session->userdata['gender']==1) $gender='Kadın'; else $gender='Erkek'  ?>
          
          <li class="editable">
            <a style="cursor: pointer;"  onclick="$('.editable').css('display', 'none'); $('#edit-gender').css('display', 'inline');">
              <i class="fa fa-<?php echo $fa_gender ?>"></i>
            </a>
            <?php echo $gender ?> 
          </li>

          <li class="editable">
            <i style="cursor: pointer;" onclick="window.location.href='<?php echo site_url('profile/settings/city'); ?>'" class="fa fa-map-marker"></i>
             <?php echo $this->profile_m->city_name_by_district($this->session->userdata['district']); ?> / <?php echo $this->profile_m->district_name_by_id($this->session->userdata['district']); ?> 
          </li>

          <?php if(isset($this->session->userdata['institution'])){ ?> 
            <li class="editable" style="margin-top: 10px;"> 
              <a style="cursor: pointer;"  onclick="$('.editable').css('display', 'none'); $('#edit-institution').css('display', 'inline');">
                <i class="fa fa-building"></i>
              </a>
              <?php echo $this->session->userdata['institution']; ?>
            </li> 
          <?php } ?>

          <span style="display: none;" id="edit-age">
            <form class="form-inline" action="<?php echo site_url('profile/update_birthdate'); ?>" method="post" >
              <a class="form-control" style="cursor: pointer;" onclick="$('#edit-age').css('display', 'none'); $('.editable').css('display', 'inline-block');"><i class="fa fa-chevron-left"></i></a>
              <div class="form-group">
                <select class="selectpicker col-lg-3 col-md-3 col-sm-3 col-xs-10" data-live-search="true" name="day" id="day" required>
                </select>
                <select class="selectpicker col-lg-4 col-md-3 col-sm-3 col-xs-10" data-live-search="true" name="month" id="month" required>
                </select>
                <select class="selectpicker col-lg-4 col-md-3 col-sm-3 col-xs-10 " data-live-search="true" name="year" id="year" required>
                </select>
              </div>
              <button class="form-control btn btn-primary" type="submit"><i class="fa fa-check"></i></button>
            </form>
          </span>

          <span style="display: none;" id="edit-gender">
            <form class="form-inline" action="<?php echo site_url('profile/update_gender'); ?>" method="post" >
              <a class="form-control" style="cursor: pointer;" onclick="$('#edit-gender').css('display', 'none'); $('.editable').css('display', 'inline-block');"><i class="fa fa-chevron-left"></i></a>
              <div class="radio radio-danger">
                <span>
                  <input type="radio" name="gender" id="woman" value="1" <?php if($this->session->userdata['gender']==1) echo "checked";  ?> > 
                  <label  for="woman">Kadın</label>
                </span>
              </div>
              <div style="margin-left: 20px; margin-right: 20px;" class="radio radio-primary">
                <span>
                  <input class="checkbox-primary" type="radio" name="gender" id="man" value="0" <?php if($this->session->userdata['gender']==0) echo "checked";  ?>> 
                  <label for="man" ">Erkek</label>
                </span>
              </div>
              <button class="form-control btn btn-primary" type="submit"><i class="fa fa-check"></i></button>
            </form>
          </span>

          <span style="display: none;" id="edit-institution">
            <form class="form-inline" action="<?php echo site_url('profile/update_institution'); ?>" method="post" >
              <a class="form-control" style="cursor: pointer;" onclick="$('#edit-institution').css('display', 'none'); $('.editable').css('display', 'inline-block');"><i class="fa fa-chevron-left"></i></a>
              <input class="form-control" type="text" name="institution" placeholder="Kurum, şirket veya okul ismi..." required>
              <button class="form-control btn btn-primary" type="submit"><i class="fa fa-check"></i></button>
            </form>
          </span>

      </ul>
      <ul class="blog-info">
        <li><strong style="cursor: pointer;" onclick="window.location.href='<?php echo site_url('profile/settings/change_teach'); ?>'" >Öğretebilecekleri: </strong><?php echo $this->request_m->get_teaches_by_id($this->session->userdata['user_id']); ?> </li>
      </ul>
      <ul class="blog-info">
        <li><strong style="cursor: pointer;" onclick="window.location.href='<?php echo site_url('profile/settings/change_learn'); ?>'" >Öğrenmek istedikleri: </strong><?php echo $this->request_m->get_learns_by_id($this->session->userdata['user_id']); ?></li>
      </ul>
      <a style="margin-right: 5%" data-toggle="modal" data-id="<?php echo $this->session->userdata['short_info']; ?>" data-name="<?php echo $this->session->userdata['name'].' '.$this->session->userdata['surname']; ?>" href="#info_modal" class="more info-dialog"> Öğretim Tecrübesi <i class="icon-angle-right"></i></a>
      </div>
    </div>
    <div class="col-md-4 col-sm-4 pull-right">
      <div class="form-info">
        <h2>Önemli <em>Bilgi</em> </h2>
        <p>Diğer insanlar anasayfalarındaki keşfet bölümünde ve diğer yerlerde sizi bu şekilde görecekler. Kaleme tıklayarak adınızı, takvime tıklayarak yaşınızı, insan figürüne tıklayarak cinsiyeti, binaya tıklayarak kurum bilginizi değiştirebilirsiniz. Diğer bilgileri veya şifrenizi güncellemek için <i onmouseover="$('#sidebar').css('background-color', '#ddd'); " onmouseout="$('#sidebar').css('background-color', 'rgba(244,244,244,0.5)'); ">soldaki menü</i>yü kullanabilirsiniz.</p>

      </div>
    </div>
  </div>
</div>

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
    
    if (shortInfo.length==0) {$(".modal-body #infoText").html( "Öğretim tecrübelerinizden bahsetmediniz. Bu teklif alma şansınızı azaltır. <a href='<?php echo site_url(); ?>/profile/settings/info'>Hemen şimdi bahsedin!</a>" );}
    else $(".modal-body #infoText").text( shortInfo );
    $(".modal-header #nameSurname").text( names );
  });
</script>