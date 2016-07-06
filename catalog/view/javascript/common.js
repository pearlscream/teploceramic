// forms function
function add_data(){
	if($('input[name="email"]').val().length > 0 && $('input[name="telephone"]').val().length > 0)
	{
		$.ajax({
			url: 'index.php?route=module/forms/save',
			type: 'post',
			data: $('.form input, .form select, .form textarea').serialize(),
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

					showDialog('Ваша заявка была успешно отправлена!');
				}
			}
		});
	}
	else
	{
		if($('input[name="email"]').val().length <= 0)
			$('input[name="email"]').css('background','#ffcccc');
		if($('input[name="telephone"]').val().length <= 0)
		$('input[name="telephone"]').css('background','#ffcccc');

		showDialog('Ошибка! Заполните обязательные поля!');
	}
}


function showDialog(txt)
{
	
		$('.form-respond span').text(txt);
						$('#overlay').fadeIn(400, // сначала плавно показываем темную подложку
						  function(){ // после выполнения предъидущей анимации
							$('.form-respond') 
							  .css('display', 'block') // убираем у модального окна display: none;
							  .animate({opacity: 1, top: '50%'}, 200); // плавно прибавляем прозрачность одновременно со съезжанием вниз
						});

					  /* Закрытие модального окна, тут делаем то же самое но в обратном порядке */
					  $('.close-btn, #overlay').click( function(){ // ловим клик по крестику или подложке
						$('.form-respond')
						  .animate({opacity: 0, top: '45%'}, 200,  // плавно меняем прозрачность на 0 и одновременно двигаем окно вверх
							function(){ // после анимации
							  $(this).css('display', 'none'); // делаем ему display: none;
							  $('#overlay').fadeOut(400); // скрываем подложку
							}
						  );
					  });
}


$(document).ready(function() {
	// add_data
	$('.form input').on('keydown', function(e) {
		if (e.keyCode == 13) {
			add_data();
		}
	});

	$(".mask").mask("(999) 999-99-99");
	
	$( "input[name='name'], input[name='telephone']" ).keyup(function() {
			if ($(this).val() != '') 
				$(this).css('background-color','white'); 
			else 
				$(this).css('background-color','#ffcccc');
		})	
});
