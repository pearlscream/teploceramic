<div class="form_data">
	<h3><?php echo $input_title; ?></h3>
	<input id="name" placeholder="name" name="name" class="form-control">
	<input id="email" placeholder="email" name="email" class="form-control">
	<input id="telephone" placeholder="telephone" name="telephone" class="form-control">
	<input type="text" readonly value="get product" id="form_id" placeholder="form_id" name="form_id" class="form-control">
	<input type="text" readonly value="Our SUPERPRODUCT" id="product_name" placeholder="product_name" name="add[product_name]" class="form-control">
	<input type="text" readonly value="100500" id="product_price" placeholder="product_price" name="add[product_price]" class="form-control">
	<input type="text" readonly value="1" id="quantity" placeholder="quantity" name="add[quantity]" class="form-control">
	<input type="text" readonly value="Super Option (you can not buy without)" id="option_name" placeholder="option_name" name="add[option_name]" class="form-control">

	<input type="submit" value="<?php echo $button_submit; ?>" class="btn btn-default" id="forms" onclick="add_data();">
<script>
// forms function
function add_data(){
	$.ajax({
		url: 'index.php?route=module/forms/save',
		type: 'post',
		data: $('.form_data input, .form_data select, .form_data textarea').serialize(),
		dataType: 'json',
		beforeSend: function() {
			$('#forms').addClass('sending');
		},
		success: function(json) {

			$('#forms').removeClass('sending');

			if (json['redirect']) {
				location = json['redirect'];
			}

			if (json['success']) {
				$('input[name="email-news"]').removeClass('invalid');
				$('#forms').addClass('ok');
				$('#content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				$('html, body').animate({ scrollTop: 0 }, 'slow');
			}
		}
	});
}
$(document).ready(function() {
	// add_data
	$('.form_data input').on('keydown', function(e) {
		if (e.keyCode == 13) {
			add_data();
		}
	});
});
</script>
</div>