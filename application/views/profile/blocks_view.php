<?php $this_user=$this->session->userdata['user_id']; 

$months=array();
$months[1]="Ocak";
$months[2]="Şubat";
$months[3]="Mart";
$months[4]="Nisan";
$months[5]="Mayıs";
$months[6]="Haziran";
$months[7]="Temmuz";
$months[8]="Ağustos";
$months[9]="Eylül";
$months[10]="Ekim";
$months[11]="Kasım";
$months[12]="Aralık";
 ?>
<h2>Engellenenler</h2>
<div class="content-form-page">
  <div class="row">
    <div class="col-md-7 col-sm-7">
      <div style="overflow: hidden; margin-top: 10px" class="recent-news margin-bottom-10">

        <?php if (empty($blocks)) { ?>
        
        <p>Kimseyi engellemediniz.</p>

        <?php } else { foreach ($blocks as $block) { ?>
        <div class="row margin-bottom-30">
          <div class="col-xs-3">
            <img class="img-responsive" alt="<?php echo $block['name']." ".$block['surname']; ?>" src="<?php echo base_url().'assets/profiles/'.$block['blocked'].'.jpg'; ?>" onerror="this.src='../../../assets/profiles/no-avatar.png'">                      
          </div>
          <div class="col-xs-9 recent-news-inner">
            <h3 style="margin-bottom: 5px"><a><?php echo $block['name']." ".$block['surname']; ?></a></h3>
            <span style="display: block; margin-bottom: 5px"><i><?php echo date("d", strtotime($block['block_time']))." ".$months[date("n", strtotime($block['block_time']))]." ".date("Y", strtotime($block['block_time'])); ?> </i> tarihinde engellediniz.</span>
            <span class="text-danger" style="cursor: pointer;" onclick="window.location.href='<?php echo site_url('profile/lift_block/').$block['block_id']; ?>'"><i class="fa fa-times"></i> Engeli kaldır</span>
          </div>                        
        </div>
        <?php } }?>

      </div>
    </div>
    <div class="col-md-4 col-sm-4 pull-right">
      <div class="form-info">
        <h2>Kısa <em>Bilgi</em> </h2>
        <p>Engellediğiniz kişileri aramalarda bulamaz, veya size önerdiğimiz kişiler arasında göremezsiniz. Bu kişilerle olan konuşmanız da engeli kaldırana kadar görünmez olur. Engeli kaldırırsanız konuşmanıza kaldığınız yerden devam edebilirsiniz.</p>

      </div>
    </div>
  </div>
</div>
