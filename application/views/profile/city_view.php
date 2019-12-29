<?php
defined('BASEPATH') OR exit('No direct script access allowed');

foreach ($cities as $city) {
  $districts[$city['city_no']]=$this->login_m->get_district_by_city($city['city_no']);
}

$selected_city=$this->login_m->get_city_by_district($this->session->userdata['district']);
$selected_district=$this->session->userdata['district'];

?>
<h2>Şehir değişikliği</h2>
<div class="content-form-page">
  <div class="row">
    <div class="col-md-7 col-sm-7">
      <form class="form-horizontal form-without-legend" role="form" method="post" action="<?php echo site_url('profile/update_district'); ?>">                    
        <div class="form-group">
          <select class="selectpicker col-lg-5 col-md-5 col-sm-5 col-xs-5" title="İl seçin..." data-live-search="true" name="city" id="city" onchange="configureDropDownLists(this,document.getElementById('district'))" required>
            <?php foreach ($cities as $city) { ?>
              <option value="<?php echo $city['city_no']; ?>" <?php if($city['city_no']==$selected_city) echo "selected"; ?>  > <?php echo $city['city_name']; ?> </option>
            <?php } ?>
          </select>
          <select class="selectpicker col-lg-5 col-md-5 col-sm-5 col-xs-5" title="İlçe seçin..." data-live-search="true" name="district" id="district" required>
            <?php foreach ($districts[$selected_city] as $district) { ?>
              <option value="<?php echo $district['district_no']; ?>" <?php if($district['district_no']==$selected_district) echo "selected"; ?> > <?php echo $district['district_name']; ?> </option>
            <?php } ?>
          </select>
        </div>
        <legend></legend>
        <div class="row">
          <div class="col-lg-3 col-md-offset-4 padding-left-0 padding-top-5">
            <button type="submit" class="btn btn-primary">Değiştir</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-4 col-sm-4 pull-right">
      <div class="form-info">
        <h2><em>Önemli</em> Hatırlatma</h2>
        <p>Potansiyel çalışma partnerleriniz yaşadığınız şehir olarak burada seçtiğiniz il ve ilçeyi görecek. Tatil veya iş gezisi gibi geçici durumlarda buradan <strong>kolayca</strong> şehrinizi değiştirebilir, sonra tekrar eskiye döndürebilirsiniz.</p>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function configureDropDownLists(ddl1,ddl2) {

    var cities = <?php echo json_encode($cities); ?>;
    var districts = <?php echo json_encode($districts); ?>;

    for (j = 0; j < cities.length; j++) {
      if(ddl1.value==(j+1)){

        var city = new Array();
        var city_no = new Array();
        $.each(districts[j+1], function (i, elem) {
            city.push(elem['district_name']); 
            city_no.push(elem['district_no']); 
        });

        ddl2.options.length = 0;
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