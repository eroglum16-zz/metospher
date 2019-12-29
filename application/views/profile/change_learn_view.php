<?php
   
  $color[0]='success';
  $color[1]="info";
  $color[2]="warning";
  $color[3]="danger";

 ?>

 

<h2>Öğrenmek istediğiniz dersler</h2>
<div class="content-form-page">

  <div class="row" style="margin-bottom: 30px">
    <ul class="list-group col-lg-7 col-md-7 ">
      <?php if(empty($my_learns)){ ?>
        <li class="list-group-item list-group-item-danger; ?>" style="font-weight: bold;"> Ders eklemediniz </li>
      <?php } ?>

      <?php $count=0; foreach ($my_learns as $my_learn) { ?>
      <li class="list-group-item list-group-item-<?php echo $color[$count%4]; ?>" style="font-weight: bold;"> <?php echo $my_learn['lesson_name']; ?> </li>
      <?php $count++; } ?>
    </ul>
    <button class="btn btn-default" data-toggle="collapse" data-target="#update">Güncelle</button>
  </div>

  <div class="row collapse" id="update">

    <?php if(!empty($my_learns)){ ?>
    <div class="row" style="margin-bottom: 40px">
      <h1>Öncekileri silin</h1>
      <div>
        <form method="post" action="<?php echo site_url('profile/delete_my_learn'); ?>">
          <select  name="lessons_to_delete[]" class="selectpicker" data-live-search="true" title="Seçtikleriniz..." multiple>
            <?php foreach ($categories as $category) { ?>
            <optgroup label="<?php echo $category['category_name'] ?>">
              <?php foreach ($my_learns as $my_learn) { if($my_learn['lesson_category']==$category['category_id']){?>
                <option value="<?php echo $my_learn['lesson']; ?>"  > <?php echo $my_learn['lesson_name']; ?></option>
              <?php }} ?>
            </optgroup> 
            <?php } ?>
          </select>
          <button type="submit" class="btn btn-danger">Sil</button>
        </form>
      </div>
    </div>
    <?php } ?>

    <div class="row">
      <h1>Yeni ekleyin</h1>
      <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#search">Arama</a></li>
              <li><a data-toggle="tab" href="#cats">Kategoriler</a></li>
            </ul>

            

            <div class="tab-content">

              <!-- Search Tab -->
              <div id="search" class="tab-pane fade in active">
                <form method="post" action="<?php echo site_url('register/save_learn/change'); ?>">
                  <select name="lesson_search[]" class="selectpicker" data-live-search="true" title="Dersleri arayın..." multiple>
                    <?php foreach ($categories as $category) { ?>
                    <optgroup label="<?php echo $category['category_name'] ?>">
                      <?php foreach ($lessons as $lesson) { if($lesson['lesson_category']==$category['category_id']){?>
                        <option value="<?php echo $lesson['lesson_id']; ?>" ><?php echo $lesson['lesson_name']; ?></option>
                      <?php }} ?>
                    </optgroup>
                    <?php } ?>
                  </select>
                  <button type="submit" class="btn btn-success">Ekle</button>
                </form>
              </div>

              <!-- Categories Tab -->
              <div id="cats" class="tab-pane fade">
                <div class="filter-v1">
                  <ul class="mix-filter">
                    <li data-filter="all" class="filter active">Tümü</li>
                    <?php foreach ($categories as $category) { ?>
                      <li data-filter="category_<?php echo $category['category_id'] ?>" class="filter"><?php echo $category['category_name'] ?></li>
                    <?php } ?>
                  </ul>
                  <form method="post" action="<?php echo site_url('register/save_learn/change'); ?>" role="form">
                    <?php foreach ($categories as $category) { ?>
                    <div class="row mix-grid thumbnails">
                      <legend class="mix category_<?php echo $category['category_id'];?>"><?php echo $category['category_name']; ?></legend>
                      <?php foreach ($lessons as $lesson) { if($lesson['lesson_category']==$category['category_id']){ ?>
                      <div class="col-md-3 col-sm-4" >
                        <div class="checkbox checkbox-info mix category_<?php echo $lesson['lesson_category'] ?> mix_all" style="display: inline; opacity: 1; color: #44b1c1">
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
                <button type="submit" class="btn btn-success">Ekle</button>
                  </form>
              </div>

            </div>
    </div>

    <?php if (!isset($alert_text)){ ?>
     <div style="margin-top: 30px;" class="alert alert-warning alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      <strong>Aradığınızı bulamadınız mı?</strong> Öğrenmek istediğiniz ders listemizde yoksa lütfen bizi <a style="cursor: pointer;" data-toggle="modal" data-target="#suggestionModal">bilgilendirin</a>.
    </div>
    <?php } ?>    

  </div>

  
</div>