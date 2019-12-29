
<div class="main">
  <div class="container">

    <div class="alert alert-success alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      <strong>Tebrikler!</strong> Sisteme başarıyla kaydoldunuz. Şimdi sıra vereceğiniz dersleri seçmekte.
    </div>

    <!--
    <ul class="breadcrumb">
        <li><a href="<?php echo site_url('home') ?>">Anasayfa</a></li>
        <li><a href="javascript:;">Kullanıcı Menüsü</a></li>
        <li class="active">İstekler</li>
    </ul>
    -->
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
      <!-- BEGIN CONTENT -->
      <div class="col-md-12 col-sm-12">
        <h1>Öğretebileceğiniz Dersleri Seçin</h1>
        <div class="content-page">

          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#search">Arama</a></li>
            <li><a data-toggle="tab" href="#cats">Kategoriler</a></li>
          </ul>

          

          <div class="tab-content">
            <div id="search" class="tab-pane fade in active">
              <form method="post" action="<?php echo site_url('register/save_teach'); ?>">
                <select name="lesson_search[]" class="selectpicker" data-live-search="true" title="Dersleri arayın..." multiple>

                  <?php foreach ($categories as $category) { ?>
                  <optgroup label="<?php echo $category['category_name'] ?>">
                    <?php foreach ($lessons as $lesson) { if($lesson['lesson_category']==$category['category_id']){ ?>
                      <option value="<?php echo $lesson['lesson_id']; ?>" ><?php echo $lesson['lesson_name']; ?></option>
                    <?php }} ?>
                  </optgroup> 
                  <?php } ?>

                </select>
                <button type="submit" class="btn btn-success">Sonraki adım</button>
              </form>
            </div>
            <div id="cats" class="tab-pane fade">
              <div class="filter-v1">
                <ul class="mix-filter">
                  <li data-filter="all" class="filter active">Tümü</li>
                  <?php foreach ($categories as $category) { ?>
                    <li data-filter="category_<?php echo $category['category_id'] ?>" class="filter"><?php echo $category['category_name'] ?></li>
                  <?php } ?>
                </ul>
                <form method="post" action="<?php echo site_url('register/save_teach'); ?>" role="form">
                  <?php foreach ($categories as $category) { ?>
                  <div class="row mix-grid thumbnails">
                    <legend class="mix category_<?php echo $category['category_id'];?>"><?php echo $category['category_name']; ?></legend>
                    <?php foreach ($lessons as $lesson) { if($lesson['lesson_category']==$category['category_id']){?>
                    <div class="col-md-3 col-sm-4" >
                      <div class="checkbox checkbox-info mix category_<?php echo $lesson['lesson_category'] ?> mix_all" style="display: inline; opacity: 1; color: #44b1c1;">
                        <input name="lesson_list[]" value="<?php echo $lesson['lesson_id'] ?>" type="checkbox" id="checkbox<?php echo $lesson['lesson_id'] ?>"> 
                        <label for="checkbox<?php echo $lesson['lesson_id'] ?>">
                          <?php echo $lesson['lesson_name'] ?>
                        </label>
                      </div> 
                    </div>
                    <?php  }} ?>
                  </div>
                  <?php } ?>
              </div>
              <hr>
              <button type="submit" class="btn btn-success">Sonraki adım</button>
                </form>
            </div>
          </div>
        </div>
      </div>
      <!-- END CONTENT -->
    </div>
    <!-- BEGIN SIDEBAR & CONTENT -->
  </div>
</div>
    