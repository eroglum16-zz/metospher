<h2>Şifre değişikliği</h2>
<div class="content-form-page">
  <div class="row">
    <div class="col-md-7 col-sm-7">
      <form class="form-horizontal form-without-legend" role="form" data-toggle="validator" method="post" action="<?php echo site_url('profile/update_password'); ?>">                    
        <div class="form-group">
          <label for="old-password" class="col-lg-4 control-label">Eski şifre</label>
          <div class="col-lg-8">
            <input autofocus type="password" name="old_password" class="form-control" id="old-password" required>
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
            <button type="submit" class="btn btn-primary">Kaydet</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-4 col-sm-4 pull-right">
      <div class="form-info">
        <h2><em>Önemli</em> Hatırlatma</h2>
        <p>Şifreniz, kolayca unutmayacağınız ama aynı zamanda kolayca tahmin edilemeyecek bir şey olmalıdır. Eğer şifrenizi unutursanız giriş formundaki <i>şifremi unuttum</i> linkini tıklayıp email adresinize yeni bir şifre alabilirsiniz.</p>

      </div>
    </div>
  </div>
</div>