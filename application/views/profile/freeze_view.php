<?php $this->load->model('request_m'); $this_user=$this->session->userdata['user_id']; ?>
<h2>Hesabı dondurun</h2>
<div class="content-form-page">
  <div class="row">
    <div class="col-md-7 col-sm-7">
      <form class="form-horizontal" role="form" data-toggle="validator" method="post" action="<?php echo site_url('profile/freeze_user'); ?>">                    
        <legend>Aramızdan gitmenizi istemeyiz...</legend>
        <textarea style="width: 75%" name="freezeReason" placeholder="Metospher’den neden ayrılmak istediğinizi açıklamak ister misiniz?" rows="5" maxlength="255" required></textarea>
        <legend>Şifrenizi girmelisiniz</legend>
        <div class="form-group">
          <label for="inputPassword" class="col-lg-4 control-label">Şifre</label>
          <div class="col-lg-8">
            <input type="password" name="password" data-minlength="6" class="form-control" id="inputPassword"  required>
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-lg-4 control-label">Şifre tekrar</label>
          <div class="col-lg-8">
            <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Şifreler eşleşmiyor!"  required>
             <div class="help-block with-errors"></div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-5">
            <button type="submit" class="btn btn-primary">Kaydet</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-4 col-sm-4 pull-right">
      <div class="form-info">
        <h2>Önemli <em>Bilgi</em> </h2>
        <p>Hesabınızı dondurduğunuzda diğer insanların aramalarında görünmez, onlara çalışma arkadaşı önerisi olarak gösterilmez, çalışma isteği almazsınız. Tekrar aramıza dönmek için giriş yapmanız yeterli olacaktır.</p>

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