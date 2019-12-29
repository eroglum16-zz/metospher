<h2>Fotoğraf</h2>
<div class="content-form-page">
  <div class="row">
    <div class="col-md-7 col-sm-7">

      <div style="margin-bottom: 20px " class="profile-userpic">
        <img  onerror="this.src='<?php echo base_url(); ?>/assets/profiles/no-avatar.png'" src="<?php echo base_url('assets/profiles/'). $this->session->userdata['user_id'].".jpg"; ?>" class="img-responsive" alt="<?php echo $this->session->userdata['name']." ".$this->session->userdata['surname'] ?>">
      </div>
      <div class="profile-usertitle">
        <div class="profile-usertitle-name">
          <?php echo $this->session->userdata['name']." ".$this->session->userdata['surname']; ?> 
        </div>
      </div>

      
      
      <?php echo form_open_multipart(site_url('register/upload_photo/change'),array('class'=>'hidden-for-mobile'));?>
        <div class="form-group">
            <div class=" img-upload">
                <div class=" img-file-tab">
                    <div>

                        <span class="btn btn-default btn-file img-select-btn">
                            <span>Yeni fotoğraf seçin...</span>
                            <input type="file" name="userfile">
                        </span>
                        <span class="btn btn-danger img-remove-btn">Sil</span>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </form>
    </div>
    <div class="col-md-4 col-sm-4 pull-right">
      <div class="form-info">
        <h2><em>Önemli</em> Hatırlatma</h2>
        <p>Yeni fotoğraf seçin düğmesini kullanarak bir fotoğraf yükleyin. Yüklediğiniz fotoğraf alt tarafta belirecektir. Fotoğrafın boyutu en fazla <strong>2 MB</strong> olabilir. Lütfen sadece <i>jpg</i> ve <i>png</i> formatında fotoğraflar yükleyin. <strong>Mobil cihazlardan yükleme yapılamaz!</strong> </p>

      </div>
    </div>
  </div>
</div>