<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=480,initial-scale=0.66666">
<meta name="format-detection" content="telephone=no">
<link rel="shortcut icon" href="/images/favicon.ico" />
<title><?php echo $title; ?></title>
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php /*if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php }*/ ?>

<link href="catalog/view/theme/teploceramic/css/style.css" rel="stylesheet" >
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>


<script> 
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

 
<?php echo $google_analytics; ?>

  ga('create', 'UA-63758840-1', 'auto');
  ga('send', 'pageview');

</script>
<script>!function(){function a(){var a=0==window.orientation?window.screen.width:window.screen.height;return navigator.userAgent.indexOf("Android")>=0&&window.devicePixelRatio&&(a=Math.min(window.innerWidth,window.outerWidth),a/=window.devicePixelRatio),a}if("undefined"!==typeof window.orientation){{var b=a(),c=480,d=navigator.userAgent.toLowerCase();d.indexOf("android")>-1}if(b<=c)if(navigator.userAgent.match(/iPhone/i)||navigator.userAgent.match(/iPod/i)){var f=b/c;document.write('<meta name="viewport" content="width=480, initial-scale='+f+'">')}else document.write('<meta name="viewport" content="width=480"/>');else 0==window.orientation||180==window.orientation?(document.write('<meta name="viewport" content="width=device-width,initial-scale=1">'),document.write('<meta name="viewport" content="width=device-width,max-scale=1">')):(document.write('<meta name="viewport" content="width=device-height,initial-scale=1">'),document.write('<meta name="viewport" content="width=device-height,max-scale=1">'))}}();
</script>


</head>

<body>
	<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter30730868 = new Ya.Metrika({id:30730868,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/30730868" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
   
	<div class="menu">
		<div class="super-menu-wrapp">
		
			<div class="logo"><a href="#0">
      <?php if($text_language == 'Rus'){
        echo '<img src="catalog/view/theme/teploceramic/images/logo.jpg" height="39" width="289" alt="">';
      }elseif($text_language == 'Ukr'){
        echo '<img src="catalog/view/theme/teploceramic/images/logo.jpg" height="39" width="289" alt="">';
      }else{
        echo '<img src="catalog/view/theme/teploceramic/images/logo.jpg" height="39" width="289" alt="">';
      }?>
      </a>
      <div class="tel"><span class='for_first_tel'><br></span><span class='more_cont fr' >Еще контакты ▼ <br></span><span class='more_cont sd' >Скрыть ▲<br></span><span class="for_second_tel"></span></div>
      </div>

			<ul class="nav-wrap">
				<li>
					<a class="magic-btn" href="#0"><span></span><span></span><span></span><span></span></a>
					<ul class="nav">
						<li><a href="#grushevsky"><?php echo $text_menu1; ?></a></li>
						<li><a href="#raschet-linkk"><?php echo $text_menu2; ?></a></li>
						<li><a href="#mini-price-link"><?php echo $text_menu3; ?></a></li>
						<li><a href="#reviews-link"><?php echo $text_menu4; ?></a></li>
						<li><a href="#action-green-block-link"><?php echo $text_menu5; ?></a></li>
						<li><a href="#footer-block-link"><?php echo $text_menu6; ?></a></li>
						<li><a href="#footer-block-link"><?php echo $text_menu7; ?></a></li>
            <li class='for_lang'></li>
              
					</ul>
          <?php echo $language; ?> 
				</li>
			</ul>

		</div>
            
	</div><!-- menu -->
