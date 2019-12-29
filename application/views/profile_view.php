<div class="main">
      <div class="container">
        <!--
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('home') ?>">Anasayfa</a></li>
            <li><a href="javascript:;">Kullanıcı Menüsü</a></li>
            <li class="active">İstekler</li>
        </ul>
        -->
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-3">
            <ul id="sidebar" class="list-group margin-bottom-25 sidebar-menu">
              <li class="list-group-item clearfix"  ><a style="<?php if($option=='image') echo 'color:#44b1c1;' ?>" href="<?php echo site_url('profile/settings/image'); ?>"><i class="fa fa-angle-right"></i>Fotoğraf</a></li>
              
              <li class="list-group-item clearfix"><a style="<?php if($option=='info') echo 'color:#44b1c1;' ?>"  href="<?php echo site_url('profile/settings/info'); ?>"><i class="fa fa-angle-right"></i>Öğretim Tecrübesi</a></li>
              
              <li class="list-group-item clearfix"><a style="<?php if($option=='password') echo 'color:#44b1c1;' ?>" href="<?php echo site_url('profile/settings/password'); ?>"><i class="fa fa-angle-right"></i>Şifre Değişikliği</a></li>
              
              <li class="list-group-item clearfix"><a style="<?php if($option=='change_teach') echo 'color:#44b1c1;' ?>" href="<?php echo site_url('profile/settings/change_teach'); ?>"><i class="fa fa-angle-right"></i>Öğretebilecekleriniz</a></li>
              
              <li class="list-group-item clearfix"><a style="<?php if($option=='change_learn') echo 'color:#44b1c1;' ?>" href="<?php echo site_url('profile/settings/change_learn'); ?>"><i class="fa fa-angle-right"></i>Öğrenmek İstedikleriniz</a></li>
              
              <li class="list-group-item clearfix"><a style="<?php if($option=='city') echo 'color:#44b1c1;' ?>" href="<?php echo site_url('profile/settings/city'); ?>"><i class="fa fa-angle-right"></i>Şehir Bilgisi</a></li>

              <li class="list-group-item clearfix"><a style="<?php if($option=='freeze') echo 'color:#44b1c1;' ?>" href="<?php echo site_url('profile/settings/freeze'); ?>"><i class="fa fa-angle-right"></i>Hesabı Dondur</a></li>

              <li class="list-group-item clearfix"><a style="<?php if($option=='blocks') echo 'color:#44b1c1;' ?>" href="<?php echo site_url('profile/settings/blocks'); ?>"><i class="fa fa-angle-right"></i>Engellenenler</a></li>
            </ul>
          </div>
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-9">
            <?php if (isset($alert_text)){ ?>
            <div class="alert alert-<?php echo $alert_type; ?> alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><?php echo $alert_strong; ?></strong> <?php echo $alert_text; ?>
            </div>
            <?php } ?>
            <?php $this->load->view($view); ?>
          </div>
          <!-- END CONTENT -->

          <!-- SUGGESTION MODAL -->
          <div id="suggestionModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header" style="background-color: #44b1c1; color: white">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Ders Önerisi</h4>
                </div>
                <div class="modal-body">
                  <form class="form form-vertical" role="form" method="post" action="<?php echo site_url('profile/save_suggestion/').$this->uri->segment(3, 0); ?>">
                    <legend>Önerin, listeye ekleyelim</legend>
                    <div class="form-group">
                      <input class="form-control" type="text" name="suggestedLesson" placeholder="Ders ismini yazın...">
                    </div>
                    <div class="form-group">
                      <button class="form-control btn btn-default" type="submit">Öneriyi Gönder</button>
                    </div>
                    
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                </div>
              </div>

            </div>
          </div>
          <!-- END SUGGESTION MODAL -->

        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>
