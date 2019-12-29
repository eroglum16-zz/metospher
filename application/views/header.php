


<?php


if ($this->session->has_userdata('logged_in')) {    
  if ($this->session->userdata['logged_in']) {
    $request_number=count($this->request_m->get_requests());
    $request_number+=$this->request_m->get_unseen_number();
  }
}

 ?>

<!DOCTYPE html>
<!--
Template: Metronic Frontend Freebie - Responsive HTML Template Based On Twitter Bootstrap 3.3.4
Version: 1.0.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase Premium Metronic Admin Theme: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>

    <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-127065648-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-127065648-1');
  </script>
  
  <meta charset="utf-8">
  <title>Metospher <?php if(isset($title))echo $title; ?></title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta name="description" content="Öğrenmenin, öğretmenin, dostluklar kurmanın ve değişmenin keyfine varmak için sizi de 'değişim dünyamız'da görmekten mutluluk duyarız." >

  <meta name="keywords" content="metospher, metospher eğitim topluluğu, eğitim topluluğu, ücretsiz ders, bedava ders , ücretsiz kurs, internetten eğitim, ucuz kurs,  özel ders, yetenek paylaşımı, öğretmen, eğitimde değişim , yabancı dil, değişim dünyası, ingilizce eğitimi " >

  <meta content="Metospher" name="author">

  <meta property="og:site_name" content="Metospher">
  <meta property="og:title" content="Metospher ile bir şeyler öğrenmenin tam zamanı!">
  <meta property="og:description" content="Öğrenmenin, öğretmenin, dostluklar kurmanın ve değişmenin keyfine varmak için sizi de 'değişim dünyamız'da görmekten mutluluk duyarız.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="http://metospher.com/metospher-icon.png"><!-- link to image for socio -->
  <meta property="og:url" content="<?php echo site_url(); ?>">

  <meta name="twitter:title" content="Metospher">
  <meta name="twitter:description" content="Metospher ile bir şeyler öğrenmenin tam zamanı!">
  <meta name="twitter:image" content="http://metospher.com/metospher-icon.png">

  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <script>
       (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-3629822876766364",
            enable_page_level_ads: true
       });
  </script>

  <style type="text/css">
    .class{
      margin-left: auto; 
      margin-right: auto; 
      display: block;
    }

    .profile-userpic img {
      float: none;
      margin: 0 auto;
      width: 50%;
      height: 50%;
      -webkit-border-radius: 50% !important;
      -moz-border-radius: 50% !important;
      border-radius: 45% !important;
    }

    .profile-usertitle {
      text-align: center;
      margin-top: 20px;
    }

    .profile-usertitle-name {
      color: #5a7391;
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 7px;
    }

    .footer-last-content .contact-info{
    padding-top:10px; 
    }
    .footer-last-content .contact-info p{
        margin-bottom:3px;
    }
    .footer-last-content .contact-info p i{
        font-size:13px;
        margin-right:10px;
    }
    .tooltip_templates { display: none; }

    @media screen and (max-width: 800px){
      .hidden-for-mobile{
        display: none;
        visibility: hidden;
      }
    }


  </style>
  

  <!-- Fonts START -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
  <!-- Fonts END -->

  <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/corporate/img/logos/metospher-favicon.png'); ?>"/>
  

  <!-- Global styles START -->          
  <link href=<?php echo base_url("assets/plugins/font-awesome/css/font-awesome.min.css"); ?> rel="stylesheet">
  <link href=<?php echo base_url("assets/plugins/bootstrap/css/bootstrap.min.css"); ?> rel="stylesheet">
  <link href=<?php echo base_url("assets/plugins/bootstrap-select/css/bootstrap-select.min.css"); ?> rel="stylesheet">
  
  <!-- Global styles END --> 
   
  

  <!-- Theme styles START -->
  <link href=<?php echo base_url("assets/pages/css/components.css"); ?> rel="stylesheet">
  <link href=<?php echo base_url("assets/pages/css/portfolio.css"); ?> rel="stylesheet"> 
  <link href=<?php echo base_url("assets/corporate/css/style.css"); ?> rel="stylesheet">
  <link href=<?php echo base_url("assets/corporate/css/style-responsive.css"); ?> rel="stylesheet">
  <link href=<?php echo base_url("assets/corporate/css/themes/turquoise.css"); ?> rel="stylesheet" id="style-color">
  <link href=<?php echo base_url("assets/corporate/css/custom.css"); ?> rel="stylesheet">
  <link href=<?php echo base_url("assets/corporate/css/talk.css"); ?> rel="stylesheet">
  <!-- Theme styles END -->

  <link href=<?php echo base_url("assets/plugins/bootstrap-imageupload/css/img-upload.css"); ?> rel="stylesheet">
  <link href=<?php echo base_url("assets/plugins/tooltipster/css/tooltipster.bundle.css"); ?> rel="stylesheet">
  <link href=<?php echo base_url("assets/plugins/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-borderless.min.css"); ?> rel="stylesheet">

  <link href=<?php echo base_url("assets/plugins/typeahead/css/typeahead.css"); ?> rel="stylesheet">
  <link href=<?php echo base_url("assets/plugins/bootstrap-checkbox/awesome-bootstrap-checkbox.css"); ?> rel="stylesheet">

  <script src=<?php echo base_url("assets/plugins/jquery.min.js"); ?> type="text/javascript"></script>



  

  

  

</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="corporate">

  

    <!-- BEGIN STYLE CUSTOMIZER 
    <div class="color-panel hidden-sm">
      <div class="color-mode-icons icon-color"></div>
      <div class="color-mode-icons icon-color-close"></div>
      <div class="color-mode">
        <p>TEMA RENGİ</p>
        <ul class="inline">
          <li class="color-red current color-default" data-style="red"></li>
          <li class="color-blue " data-style="blue"></li>
          <li class="color-green" data-style="green"></li>
          <li class="color-orange" data-style="orange"></li>
          <li class="color-gray" data-style="gray"></li>
          <li class="color-turquoise " data-style="turquoise"></li>
        </ul>
      </div>
    </div>
    END BEGIN STYLE CUSTOMIZER --> 

    <!-- BEGIN TOP BAR -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->
                <?php if($this->session->has_userdata('logged_in') && $this->session->userdata['logged_in']==true){?>
                <div class="col-md-6 col-sm-8 col-xs-9 additional-shop-info">
                    <ul class="list-unstyled list-inline">
                        <li style="cursor: pointer;" onclick="window.location.href='<?php echo site_url('profile'); ?>'" ><span style="font-weight: bold;"><?php echo  $this->session->userdata['name']." ".$this->session->userdata['surname']; ?></span></li>
                    </ul>
                </div>
                <?php } else{  ?>
                <div class="col-md-2 col-sm-2 additional-shop-info"></div>
                <?php } ?>
                <!-- END TOP BAR LEFT PART -->
                <!-- BEGIN TOP BAR MENU -->
                
                  <?php if($this->session->has_userdata('logged_in') && $this->session->userdata['logged_in']==true){ ?>
                    <div class="col-md-6 col-sm-4 col-xs-3 additional-nav">
                    

                      <ul class="list-unstyled list-inline pull-right">

                          
                        
                          <li>
                            <div class="dropdown">

                              <a href="<?php echo site_url('login/logout') ?>">Çıkış <i class="fa fa-sign-out"></i></a>

                            </div>
                         </li> 
                        
                      </ul>
                  
                    </div>

                  <?php } else{ ?>
                    <div class="col-md-6 col-sm-8 col-xs-12 additional-nav">
                  
                      <ul class="list-unstyled list-inline pull-right">

                        <form method="post" action="<?php echo site_url('login/check_user'); ?>" role="form">
                        <li style="margin-right: 2%" class="col-lg-5 col-md-5 col-sm-5 col-xs-5"><input class="form-control" name="email" type="email" value="<?php if(isset($email))echo $email; ?>" placeholder="Email"></li>
                        <li style="margin-right: 2%" class="col-lg-5 col-md-5 col-sm-5 col-xs-4"><input class="form-control" name="password" type="password" placeholder="Şifre"></li>
                        <li style="margin-right: 2%" class="col-lg-1 col-md-1 col-sm-1 col-xs-2"><button class="btn btn-primary" type="submit">Giriş yap</button></li>
                        </form>

                        </ul>
                  
                    </div>
                    <div style="padding-top: 0.5em; padding-left: 2em" class="col-md-3 col-sm-1 col-xs-12 ">
                  
                      <?php if($active=='home'){ ?>
                        <a data-toggle="tab" href="#forgot-password">Şifremi unuttum</a>
                      <?php }?>
                        
                          
                        
                  
                    </div>
                  <?php } ?>
                        
                    
                <!-- END TOP BAR MENU -->
            </div>
        </div>   
    </div>
    <!-- END TOP BAR -->
    <!-- BEGIN HEADER --> 
    <div class="header">
      <div class="container">
        <a class="site-logo" style="margin-right: 32px; padding-top: 11px; padding-bottom: 11px;" href="<?php echo site_url(); ?>"><img style="max-width: 245px; max-height: 50px;" width="245" height="50" src="<?php echo base_url("assets/corporate/img/logos/metospher-logo.png"); ?>"  alt="Sprachlehrer Logo"></a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i><?php if(isset($request_number)&&$request_number>0){?> <blink style="background-color: #44b1c1" class="badge"><?php echo $request_number; ?></blink> <?php } ?></a>

        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation pull-right font-transform-inherit">
          <ul>
            <li class="dropdown <?php if($active=='home') echo 'active'; ?>">
              <a class="dropdown-toggle" href="<?php echo site_url('home'); ?>">
                <span class="fa fa-home"></span>
                
              </a>
              <!--
              <ul class="dropdown-menu">
                <li><a href="index.html">Home Default</a></li>
                <li class="active"><a href="index-header-fix.html">Home with Header Fixed</a></li>
                <li><a href="index-without-topbar.html">Home without Top Bar</a></li>
              </ul>
            </li>
            -->
           

            <?php if($this->session->has_userdata('logged_in') && $this->session->userdata['logged_in']){ ?>

            <li class="dropdown <?php if($active=='profile') echo 'active'; ?>"" role="presentation"><a class="dropdown-toggle" role="menuitem" tabindex="-1" href="<?php echo site_url('profile'); ?>">Profil <i class="fa fa-user"></i></a></li>

            <li class="dropdown <?php if($active=='request') echo 'active'; ?>"" role="presentation"><a class="dropdown-toggle" role="menuitem" tabindex="-1" href="<?php echo site_url('request'); ?>">İstekler <?php if($request_number>0){?> <blink style="background-color: #44b1c1" class="badge"><?php echo $request_number; ?></blink> <?php }else{ ?> <i class="fa fa-envelope"></i> <?php } ?> </a></li>
            
            
            <?php } ?>

             <li class="dropdown <?php if($active=='about') echo 'active'; ?>">
              <a href="<?php echo site_url('about'); ?>"" class="dropdown-toggle"  >
                Ne yapıyoruz <span class="fa fa-question"></span> 
                
              </a>
                
              <!--  
              <ul class="dropdown-menu">
                <li><a href="page-about.html">About Us</a></li>
                <li><a href="page-services.html">Services</a></li>
                <li><a href="page-prices.html">Prices</a></li>
                <li><a href="page-faq.html">FAQ</a></li>
                <li><a href="page-gallery.html">Gallery</a></li>
                <li><a href="page-search-result.html">Search Result</a></li>
                <li><a href="page-404.html">404</a></li>
                <li><a href="page-500.html">500</a></li>
                <li><a href="page-login.html">Login Page</a></li>
                <li><a href="page-forgotton-password.html">Forget Password</a></li>
                <li><a href="page-reg-page.html">Signup Page</a></li>
                <li><a href="page-careers.html">Careers</a></li>
                <li><a href="page-site-map.html">Site Map</a></li>
                <li><a href="page-contacts.html">Contact</a></li>                
              </ul>
            -->
            </li>

           
            <?php if($this->session->has_userdata('logged_in') && $this->session->userdata['logged_in']){ ?>
            <!-- BEGIN TOP SEARCH -->
            <li class="menu-search">
              <span class="sep"></span>
              <i onmouseout ="$('#search-input').focus();" class="fa fa-search search-btn"></i>
              <div  class="search-box">
                <form action="<?php echo site_url('home/search'); ?>" method="get">
                  <div id="the-basics" class="input-group">
                    <input autofocus id="search-input" class="typeahead form-control" name="user" type="text" placeholder="Kullanıcı arayın...">
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit">Ara</button>
                    </span>
                  </div>

                </form>
              </div> 
            </li>

            <script src=<?php echo base_url("assets/plugins/typeahead/typeahead.bundle.js"); ?> type="text/javascript"></script>

            <script type="text/javascript">
              var substringMatcher = function(strs) {
                return function findMatches(q, cb) {
                  var matches, substringRegex;

                  // an array that will be populated with substring matches
                  matches = [];

                  // regex used to determine if a string contains the substring `q`
                  substrRegex = new RegExp(q, 'i');

                  // iterate through the pool of strings and for any string that
                  // contains the substring `q`, add it to the `matches` array
                  $.each(strs, function(i, str) {
                    if (substrRegex.test(str)) {
                      matches.push(str);
                    }
                  });

                  cb(matches);
                };
              };

              
              

              <?php $usernames=$this->request_m->get_all_usernames(); ?>
              var users =  <?php echo json_encode($usernames); ?> ;

              $('#the-basics .typeahead').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
              },
              {
                name: 'users',
                source: substringMatcher(users)
              });
            </script>

            <?php } ?>

            
            <!-- END TOP SEARCH -->
          </ul>
        </div>
        <!-- END NAVIGATION -->
      </div>
    </div>
    <!-- Header END -->
