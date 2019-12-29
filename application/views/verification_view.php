<div class="main">
  <div class="container">
    <div class="alert alert-success alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      <strong>Tebrikler!</strong> Sisteme başarıyla kaydoldunuz. Şimdi email adresinize gönderilen doğrulama kodunu girerek üyeliğinizi doğrulamalısınız.
    </div>
    <ul class="breadcrumb">
        <li class="active">Doğrulama</li>
        <li >Öğretebileceklerim</li>
        <li ><a href="">Öğreneceklerim</a></li>
        <li ><a href="">Profil</a></li>
    </ul>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row" style="margin-bottom: 10em">
      <!-- BEGIN CONTENT -->
      <div class="col-md-12 col-sm-12">
        <h1>Doğrulama Kodu</h1>
        <div class="content-page">

          
            <form class="form-inline" method="post" action="<?php echo site_url('register/check_code'); ?>">
              <div class="form-group">
                <input class="form-control" type="text" name="code">
                <button type="submit" class="btn btn-success">Doğrula</button>
              </div>
            </form>

          
        </div>
      </div>
      <!-- END CONTENT -->
    </div>
    <!-- BEGIN SIDEBAR & CONTENT -->
  </div>
</div>
    