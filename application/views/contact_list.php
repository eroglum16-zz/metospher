<!-- BEGIN TESTIMONIALS -->
<div class="row" style="margin-bottom: 30px;">
  <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
    <div class="testimonials-v1 testimonials-v1-another-color">
      <h2>İletişim Kutusuna Gelenler</h2>                
      <div id="myCarousel1" class="carousel slide">
        <!-- Carousel items -->
        <div class="carousel-inner">

          <?php $flag=false; foreach ($contacts as $contact) { ?>
          <div class="<?php if($flag==false){ echo 'active'; $flag=true; }?> item">
            <blockquote>
              <p><?php echo $contact['contact_text']; ?></p>
              <span><i><?php echo date("d.m.Y",strtotime($contact['contact_time'])); ?></i></span>
            </blockquote>
            <div class="carousel-info">
              <img onerror="this.src='<?php echo base_url(); ?>/assets/profiles/no-avatar.png'" class="pull-left" src="<?php echo base_url().'assets/profiles/'.$this->home_m->get_id_by_email($contact['contact_email']).'.jpg'; ?>" alt="">
              <div class="pull-left">
                <span class="testimonials-name"><?php echo $contact['contact_name']; ?></span>
                <span class="testimonials-post"><?php echo $contact['contact_email']; ?></span>
              </div>
            </div>
          </div>
          <?php } ?>

        </div>
        <!-- Carousel nav -->
        <a class="left-btn" href="#myCarousel1" data-slide="prev"></a>
        <a class="right-btn" href="#myCarousel1" data-slide="next"></a>
      </div>
    </div>
  </div>
</div>

<!-- END TESTIMONIALS -->  