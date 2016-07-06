<?php echo $header; ?>
<?php echo $content_top; ?>
<div class="glob-wrap">
<div id="popapchik" class="popapchik">
	<div class="thanks"><span class="thanks-img"><img src="images/thanks-img.png" height="112" width="93" alt=""></span><p>СПАСИБО! <span>Ваш заказ принят</span></p></div>
</div>	
<!--start mini-price -->
<div class="mini-price" id="mini-price-link">



<?php if ($products){?>
<div class="mini-price">
	<div class="top">
		<h2><?php echo $text_header ?></h2>
	</div> 
<?php foreach ($products as $product) { ?>

<div class="container">
	<div  style="display:none" class="product-id"><?php echo $product['product_id']; ?></div> 
<div class="left" id="main-product-images<?php echo $product['product_id']; ?>" ></div>	
		<?php if ($product['thumb'] || $product['images']) { ?>
		<div class="left <?php echo $product['product_id']; ?>"  style="display:none;">
			<?php if ($product['thumb']) { ?>
			<a class="grouped_elements" data-fancybox-group="gallery<?php echo $product['product_id'];?>"  href="<?php echo $product['image_big'] ?>"  ><img src="<?php echo str_replace(" ", "%20",$product['thumb']); ?>" alt="<?php echo $product['name'] ?>" class="big"></a>
			<?php }?>
			<?php if ($product['images']) { ?>	
			<ul>
     <?php foreach ($product['images'] as $image) { ?>
				<li><a class="grouped_elements" data-fancybox-group="gallery<?php echo $product['product_id'];?>"  href="<?php echo str_replace(" ", "%20",$image['popup']); ?>"><img src="<?php echo str_replace(" ", "%20",$image['thumb']); ?>" alt="<?php echo str_replace(" ", "%20",$product['name']); ?>" class="small" ></a></li>
		<?php }?>
		<?php if ($product['video']) { ?>
				<li><a class="fancybox-media"  href="https://www.youtube.com/watch?v=<?php echo $product['video']?>"><div class="video"></div></a></li>
	<?php } ?>		

			
			</ul> 
			<?php }?>
		</div>
		<?php }?>
		<div class="middle">
			<h5 class="type"><?php echo $product['name']; ?></h5>
			<h4 class="model"><?php echo $product['model_1']; ?></h4>
			<p class="warranty"><?php echo $text_garanty ?></p>
			<!--<?php echo $product['related'][0]['price_1']; ?>-->
			<h3 class="price"><?php echo $product['price_1']; ?></h3>
			<input type="hidden" id="hidden_price<?php echo $product['product_id']; ?>" value ="<?php echo $product['price_1']; ?>">
			
			<?php if ($product['related']) { ?>
			
			<label for="mramor<?php echo $product['product_id']; ?>"> <?php echo $option['name'];?> </label>
			<select  class="mramor" name="mramor" id="mramor<?php echo $product['product_id']; ?>">
				<option value="<?php echo $product['product_id']; ?>" data-description="<?php echo $product['product_id']; ?>" data-imagesrc="images/white.png" ><?php echo $product['sku_1']; ?></option>
                <?php foreach ($product['related'] as $related) { ?>
                <option value="<?php echo $related['product_id']; ?>" data-description="<?php echo $product['product_id']; ?>"  data-imagesrc="images/<?php echo $related['color']; ?>.png"><?php echo $related['model_1']; ?>
                </option>
  
                <?php } ?>
			</select>

			<?php }?>
			<input type="text" name="price" class="test" placeholder="<?php echo $text_count;?>" onkeyup="changequq($(this));">	
		</div>              <?php foreach ($product['related'] as $related) { ?>
		              		<?php if ($related['thumb'] || $related['images']) { ?>
		<div class="left <?php echo $related['product_id']; ?>" style="display:none;">
			<?php if ($related['thumb']) { ?>
			<a class="grouped_elements" data-fancybox-group="gallery<?php echo $related['product_id'];?>"  href="<?php echo str_replace(" ", "%20",$related['image_big']); ?>"  ><img src="<?php echo str_replace(" ", "%20",$related['thumb']); ?>" alt="<?php echo $related['name'] ?>" class="big"></a>
			<?php }?>
			<?php if ($related['images']) { ?>	
			<ul>
     <?php foreach ($related['images'] as $image_rel) { ?>
				<li><a class="grouped_elements" data-fancybox-group="gallery<?php echo $related['product_id'];?>"  href="<?php echo str_replace(" ", "%20",$image_rel['popup']); ?>"><img src="<?php echo str_replace(" ", "%20",$image_rel['thumb']); ?>" alt="<?php echo $related['name'] ?>" class="small" ></a></li>
		<?php }?>		
				<?php if ($related['video']) {?>
								<li><a class="grouped_elements iframe fancybox-media" rel="" href="https://www.youtube.com/watch?v=<?php echo str_replace(" ", "%20",$related['video']);?>"><div class="video"></div></a></li>
			<?php } ?>

			
			</ul>
			<?php }?>
		</div>
		<?php }?>
		<?php }?>
		<div class="right">
		<?php if ($product['attribute_groups']) { ?>	
			<table>
	<?php foreach ($product['attribute_groups'] as $attribute_group) { ?>
                  <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                  <tr>
                    <td><?php echo $attribute['name']; ?></td>
                    <td><?php echo $attribute['text']; ?></td>
                  </tr>
                  <?php } ?>
    <?php } ?>
			</table>
	<?php } ?>		
			<button class="button_buy" data-id="<?php echo $product['product_id']; ?>"><?php echo $text_buy;?></button>
		</div>
	</div>
		<hr>
	<!-- Start popap --> 
	<div class="popap" id="<?php echo $product['product_id']; ?>">
		<form   class="popap-form" method="post">
			<input type="hidden" name="product_id" class="input_prod_id"  value="<?php echo $product['product_id']; ?>" />
			<input type="hidden" name="name" value="<?php echo $product['name']; ?>"/>
			<input type="hidden" name="quantity" value="1"/>
			<p class="popap-title"><?php echo $text_fuck;?></p>
			<input type="text" name="name" placeholder="<?php echo $text_name;?>">
			<input type="text" name="telephone" class="mask" placeholder="<?php echo $text_number;?>" data-error="<?php echo $text_data;?>">
			<input type="text" name="email" placeholder="E-mail">
			<?php if ($product['product_id']=='64'){ ?>
				<input class="input-submit " onclick="send_form_sale($(this));ga('send', 'event', 'button', 'click', 'product600')" type="submit" value="<?php echo $text_add;?>">
				<?php } elseif 	($product['product_id']=='62'){ ?>
				<input class="input-submit " onclick="send_form_sale($(this));ga('send', 'event', 'button', 'click', 'product400')" type="submit" value="<?php echo $text_add;?>">
				<?php } elseif 	($product['product_id']=='50'){ ?>
				<input class="input-submit " onclick="send_form_sale($(this));ga('send', 'event', 'button', 'click', 'product370')" type="submit" value="<?php echo $text_add;?>">
				<?php } elseif 	($product['product_id']=='52'){ ?>
				<input class="input-submit " onclick="send_form_sale($(this));ga('send', 'event', 'button', 'click', 'product450')" type="submit" value="<?php echo $text_add;?>">
				<?php } else { ?>
				<input class="input-submit " onclick="send_form_sale($(this))" type="submit" value="<?php echo $text_add;?>">
			<?php } ?>
		</form>
	</div>
	<!-- End popap -->	
<?php }?>	

</div>
<?php }?>
</div>
</div>
<div class='scroll_me'></div>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>
