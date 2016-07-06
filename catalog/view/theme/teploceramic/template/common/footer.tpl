<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src='catalog/view/theme/teploceramic/js/jquery.mCustomScrollbar.js'></script>
<script src="catalog/view/theme/teploceramic/js/jquery.mousewheel-3.0.4.pack.js" type="text/javascript"></script>
<script>
        //slider diagrama
    (function($){ 
        $(window).load(function(){
            $(".div").mCustomScrollbar({
              theme:"dark",
              axis:"x"
            });
        });
    })(jQuery); 
//end_s diagrama
</script>
<script>
   
</script>
<script src="catalog/view/theme/teploceramic/js/script.js" type="text/javascript"></script>
<script src="catalog/view/theme/teploceramic/js/mini-price.js" type="text/javascript"></script>
<script src="catalog/view/theme/teploceramic/js/jquery.fancybox.js" type="text/javascript"></script>
<script src="catalog/view/theme/teploceramic/js/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="catalog/view/theme/teploceramic/js/jquery.fancybox-buttons.js" type="text/javascript"></script>
<script src="catalog/view/theme/teploceramic/js/jquery.fancybox-media.js" type="text/javascript"></script>
<script src="catalog/view/theme/teploceramic/js/jquery.fancybox-thumbs.js" type="text/javascript"></script>

<script src="catalog/view/theme/teploceramic/js/swiper.min.js" type="text/javascript"></script>
<script src='catalog/view/theme/teploceramic/js/jquery.maskedinput.min.js'></script>
<script src="catalog/view/theme/teploceramic/js/lightbox.js" type="text/javascript"></script>
<script src="catalog/view/theme/teploceramic/js/jquery.knob.min.js" type="text/javascript"></script>
<script src="catalog/view/theme/teploceramic/js/jquery.easing-1.3.pack.js" type="text/javascript"></script>

<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<script src="catalog/view/theme/teploceramic/js/elementQuery.min.js" type="text/javascript"></script>
<script src="catalog/view/theme/teploceramic/js/jquery.validate.min.js" type="text/javascript"></script>

<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->
<link href="catalog/view/theme/teploceramic/css/lightbox.css" rel="stylesheet" property="stylesheet">
<link href="catalog/view/theme/teploceramic/css/specific.css" rel="stylesheet" property="stylesheet">
<link href="catalog/view/theme/teploceramic/css/swiper.min.css" rel="stylesheet" property="stylesheet">
<link rel="stylesheet" href="catalog/view/theme/teploceramic/css/jquery.fancybox.css" property="stylesheet">
<link href="catalog/view/theme/teploceramic/css/jquery.fancybox.css" rel="stylesheet" property="stylesheet">
<link href="catalog/view/theme/teploceramic/css/jquery.fancybox-buttons.css" rel="stylesheet" property="stylesheet">
<link href="catalog/view/theme/teploceramic/css/jquery.fancybox-thumbs.css" rel="stylesheet" property="stylesheet">
      <script>

</script>
<script >
<?php foreach ($products as $product) { ?>
			
               $('#mramor<?php echo $product['product_id']; ?>').ddslick({

    onSelected: function(selectedData){
    var description =selectedData['selectedData']['description']; 
    var id =selectedData['selectedData']['value']; 
    $('#'+description+' .input_prod_id').val(selectedData['selectedData']['value']);
    $('#main-product-images'+description).html($('.'+id).html());
      $("a.grouped_elements").fancybox({
    'transitionIn'  : 'elastic',
    'transitionOut' : 'elastic',
    'speedIn'   : 600,  
    'speedOut'    : 200, 
    'overlayShow' : true,
      helpers : {
      overlay : {
                locked : false
      }
    }
  });
        $('.fancybox-media').fancybox({
    openEffect  : 'none',
    closeEffect : 'none',
    helpers : {
      media : {},
      overlay : {
                locked : false
      }
    }
  });
    }   
  });
	

<?php }?>
$('#mramor74 .dd-options li:nth-child(2)').remove();
  </script>


</body>

</html> 