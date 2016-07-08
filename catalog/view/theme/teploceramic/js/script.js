function initialize() {
    if ($('html').attr('lang') == 'cz') {
        var lat = 50.1042854;
        var lng = 14.3976649;

    } else {
        var lat = 50.494195;
        var lng = 30.466129;
    }
    // 
    var mapCanvas = document.getElementById('map-canvas');
    var mapOptions = {
        center: new google.maps.LatLng(lat, lng),
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false
    }
    var map = new google.maps.Map(mapCanvas, mapOptions);
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat, lng),
        map: map,
        title: "Hello World!"
    });
}
google.maps.event.addDomListener(window, 'load', initialize);
google.maps.event.addDomListener(window, 'resize', initialize);

(function () {
    if (typeof(window.orientation) !== 'undefined') {
        function getDeviceWidth() {

            var deviceWidth = window.orientation == 0 ? window.screen.width : window.screen.height;
            if (navigator.userAgent.indexOf('Android') >= 0 && window.devicePixelRatio) {
                deviceWidth = Math.min(window.innerWidth, window.outerWidth);
                deviceWidth = deviceWidth / window.devicePixelRatio;
            }

            return deviceWidth;
        }

        var deviceWidth = getDeviceWidth();
        var maxWidth = 480;
        var ua = navigator.userAgent.toLowerCase();
        var isAndroid = ua.indexOf("android") > -1;

        if (deviceWidth <= maxWidth) {

            if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
                var scale = deviceWidth / maxWidth;
                document.write('<meta name="viewport" content="width=' + 480 + ', initial-scale=' + scale + '">');
            } else {
                document.write('<meta name="viewport" content="width=480"/>');
            }
        } else {
            if (window.orientation == 0 || window.orientation == 180) {
                document.write('<meta name="viewport" content="width=device-width,initial-scale=1">');
                document.write('<meta name="viewport" content="width=device-width,max-scale=1">');
            } else {

                document.write('<meta name="viewport" content="width=device-height,initial-scale=1">');
                document.write('<meta name="viewport" content="width=device-height,max-scale=1">');
            }
        }
    }

})();


//left slide elem  
$(document).ready(function () {
    $('.nav-wrap').click(function () {
        $(this).toggleClass('active');
    });


});
$(document).click(function (event) {
    if (($(event.target).closest(".nav-wrap").length) || ($(event.target).closest(".nav").length)) return;

    $('.nav-wrap').removeClass('active');
    event.stopPropagation();
});


$(document).ready(function () {


    var a = 1;

    if ($(window).width() >= 900) {
        $(".slideleft1 p").addClass('p_bottom');
        window.onscroll = function () {
            var scrolled = window.pageYOffset || document.documentElement.scrollTop;
            if (scrolled > 2850 && a) {

                a = 0;
                $(".dial").knob();
                $({animatedVal: 0}).animate({animatedVal: 21}, {
                    duration: 2000,
                    easing: "swing",
                    step: function () {
                        $(".dial").val(Math.ceil(this.animatedVal)).trigger("change");
                    }
                });

                $(".dial1").knob();
                $({animatedVal: 0}).animate({animatedVal: 50}, {
                    duration: 2000,
                    easing: "swing",
                    step: function () {
                        $(".dial1").val(Math.ceil(this.animatedVal)).trigger("change");
                    }
                });

                $(".dial2").knob();
                $({animatedVal: 0}).animate({animatedVal: 63}, {
                    duration: 2000,
                    easing: "swing",
                    step: function () {
                        $(".dial2").val(Math.ceil(this.animatedVal)).trigger("change");

                    }
                });

                $(".dial3").knob();
                $({animatedVal: 0}).animate({animatedVal: 75}, {
                    duration: 2000,
                    easing: "swing",
                    step: function () {
                        $(".dial3").val(Math.ceil(this.animatedVal)).trigger("change");

                    }
                });

                $(".dial4").knob();
                $({animatedVal: 0}).animate({animatedVal: 85}, {
                    duration: 2000,
                    easing: "swing",
                    step: function () {
                        $(".dial4").val(Math.ceil(this.animatedVal)).trigger("change");

                    }
                });
            }


            if (scrolled > 4500) {

                function second_passed() {
                    $('.left_part1').animate({"opacity": "1"}, 1200);
                    $('.right_part1').animate({"opacity": "1"}, 1200);
                }

                $(".left_part").animate({"left": "50%", "opacity": "1"}, 1200);
                $(".left_part1").animate({"left": "50%"});
                $(".right_part").animate({"right": "50%", "opacity": "1"}, 1200);
                $(".right_part1").animate({"right": "50%"});
                setTimeout(second_passed, 800);


            }

            if (scrolled > 9700) {


                $(".slideleft2 p").addClass('p_bottom');
                $(".slideleft3 p").addClass('p_bottom');
                $(".slideleft4 p").addClass('p_bottom');
                function line() {
                    $(".lineqq").addClass('myline');
                    $(".myline").animate({"opacity": "1"});
                }

                function slideleft2() {

                    $(".slideleft2").animate({"opacity": "1"}).animate({"margin-left": "200px"});
                }

                function slideleft3() {

                    $(".slideleft3").animate({"opacity": "1"}).animate({"margin-left": "400px"});
                }

                function slideleft4() {

                    $(".slideleft4").animate({"opacity": "1"}).animate({"margin-left": "600px"});
                }

                setTimeout(line, 2100);
                setTimeout(slideleft2, 500);
                setTimeout(slideleft3, 1000);
                setTimeout(slideleft4, 1500);

            }
        }
    } else {

        $(".cont").css('padding-left', '20%');
        $(".slideleft1 p").addClass('p_left');
        window.onscroll = function () {
            var scrolled = window.pageYOffset || document.documentElement.scrollTop;
            if (scrolled > 13000) {
                $("div.how_work").css("height", "700px");

                $(".slideleft2 p").addClass('p_left');
                $(".slideleft3 p").addClass('p_left');
                $(".slideleft4 p").addClass('p_left');
                function line1() {

                    $(".myline1").animate({"opacity": "1"});
                }

                function slideleft21() {
                    $(".slideleft2").animate({"opacity": "1"}).animate({"margin-top": "150px"});
                }

                function slideleft31() {
                    $(".slideleft3").animate({"opacity": "1"}).animate({"margin-top": "300px"});
                }

                function slideleft41() {

                    $(".slideleft4").animate({"opacity": "1"}).animate({"margin-top": "450px"});
                }

                setTimeout(line1, 2100);
                setTimeout(slideleft21, 500);
                setTimeout(slideleft31, 1000);
                setTimeout(slideleft41, 1500);
            }
            if (scrolled > 6200) {
                $('.cont_parts').addClass('zoom_out');

                $('.how_it_works').addClass('how_out');

                function second_passed() {
                    $('.left_part1').animate({"opacity": "1"}, 1200);
                    $('.right_part1').animate({"opacity": "1"}, 1200);
                }

                $(".left_part").animate({"left": "50%", "opacity": "1"}, 1200);
                $(".left_part1").animate({"left": "50%"});
                $(".right_part").animate({"right": "50%", "opacity": "1"}, 1200);
                $(".right_part1").animate({"right": "50%"});
                setTimeout(second_passed, 1000);
            }

            if (scrolled > 3900 && a) {
                a = 0;
                $(".dial").knob();
                $({animatedVal: 0}).animate({animatedVal: 21}, {
                    duration: 2000,
                    easing: "swing",
                    step: function () {
                        $(".dial").val(Math.ceil(this.animatedVal)).trigger("change");
                    }
                });

                $(".dial1").knob();
                $({animatedVal: 0}).animate({animatedVal: 50}, {
                    duration: 2000,
                    easing: "swing",
                    step: function () {
                        $(".dial1").val(Math.ceil(this.animatedVal)).trigger("change");
                    }
                });

                $(".dial2").knob();
                $({animatedVal: 0}).animate({animatedVal: 63}, {
                    duration: 2000,
                    easing: "swing",
                    step: function () {
                        $(".dial2").val(Math.ceil(this.animatedVal)).trigger("change");

                    }
                });

                $(".dial3").knob();
                $({animatedVal: 0}).animate({animatedVal: 75}, {
                    duration: 2000,
                    easing: "swing",
                    step: function () {
                        $(".dial3").val(Math.ceil(this.animatedVal)).trigger("change");

                    }
                });

                $(".dial4").knob();
                $({animatedVal: 0}).animate({animatedVal: 85}, {
                    duration: 2000,
                    easing: "swing",
                    step: function () {
                        $(".dial4").val(Math.ceil(this.animatedVal)).trigger("change");

                    }
                });


            }
        }
    }

});
//end 


/*$('#language a').on('click', function(e) {
 e.preventDefault();

 $('#language input[name=\'code\']').attr('value', $(this).attr('href'));

 $('#language').submit();
 });
 $(document).on('click', '.for_lang a ', function(e) {
 e.preventDefault();

 $('#language input[name=\'code\']').attr('value', $(this).attr('href'));

 $('#language').submit();
 });*/

var lg = $('.btn-link span').html();
var lg_1;
var lg_2;
var lg_3;
var lg_4;
if (lg == 'Ukr') {
    lg_1 = 'ДНІ';
    lg_2 = 'ГОД';
    lg_3 = 'ХВ';
    lg_4 = 'СЕК';
    $('.price').append(' грн');
    $('.right_part1').addClass('rp_ua');
    var icon = ' грн';
    var price_calc = 1095;
    $('#popapchik p').html('ДЯКУЄМО <span>за замовлення!</span>');
} else if (lg == 'Rus') {
    lg_1 = 'ДНИ';
    lg_2 = 'ЧАСЫ';
    lg_3 = 'МИН';
    lg_4 = 'СЕК.';
    $('.price').append(' грн');
    $('.main-desc').addClass('ru_bug');
    $('.right_part1').addClass('rp_ru');
    var icon = ' грн';
    var price_calc = 1095;
} else if (lg == 'Eng') {
    lg_1 = 'DAYS';
    lg_2 = 'HOU';
    lg_3 = 'MIN';
    lg_4 = 'SEC';
    $('.right_part1').addClass('rp_en');
    $('.main-title').addClass('en_bug');
    $('.price').append(' €');
    var icon = ' €';
    var price_calc = 110;
    $('.Oplata .left-block p:nth-child(4) span ').addClass('new_back_1');
    $('.Oplata .left-block p:nth-child(5) span ').addClass('new_back_2');
    $('.Oplata .left-block p:nth-child(6) span ').addClass('new_back_3');
    $('.discount .right-block input[type="submit"]').addClass('for_en_button');
    $('.calculator input[type="submit"] ').addClass('calc_en');
    $('.footer-block .footer-form input[type="submit"] ').addClass('for_en_button');
    // $('.footer-block .footer-bottom-title ').addClass('bug_1');
    $('.saving .bottom-block ').addClass('bug_2');
    $('#table tbody tr:nth-child(3) td:nth-child(2)').html('').append('<img src="images/price3.png">');
    $('#table tbody tr:nth-child(3) td:nth-child(3)').html('').append('<img src="images/price2.png">');
    $('#table tbody tr:nth-child(3) td:nth-child(4)').html('').append('<img src="images/price2.png">');
    $('#table tbody tr:nth-child(3) td:nth-child(5)').html('').append('<img src="images/price1.png">');
    $('#table tbody tr:nth-child(3) td:nth-child(6)').html('').append('<img src="images/price4.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(2)').html('').append('<img src="images/price3.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(3)').html('').append('<img src="images/price1.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(4)').html('').append('<img src="images/price2.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(5)').html('').append('<img src="images/price4.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(6)').html('').append('<img src="images/price1.png">');
} else if (lg == 'Deu') {
    var icon = ' €';
    var price_calc = 110;
    lg_1 = 'TAGE';
    lg_2 = 'UHR';
    lg_3 = 'MIN';
    lg_4 = 'SEC';
    $('.right_part1').addClass('rp_de');
    $('.price').append(' €');
    $('.Oplata .left-block p:nth-child(4) span ').addClass('new_back_1');
    $('.Oplata .left-block p:nth-child(5) span ').addClass('new_back_2');
    $('.Oplata .left-block p:nth-child(6) span ').addClass('new_back_3');
    $('.saving .bottom-block p:nth-child(2)').addClass('bl_deu');
    $('.saving .bottom-block p:first-child ').addClass('block_deu');
    $('.calculator input[type="submit"] ').addClass('calc_deu');
    $('.action-green-block .main-title').addClass('bug_4');
    $('.saving .bottom-block ').addClass('bug_2');
    $('#table tbody tr:nth-child(3) td:nth-child(2)').html('').append('<img src="images/price3.png">');
    $('#table tbody tr:nth-child(3) td:nth-child(3)').html('').append('<img src="images/price2.png">');
    $('#table tbody tr:nth-child(3) td:nth-child(4)').html('').append('<img src="images/price2.png">');
    $('#table tbody tr:nth-child(3) td:nth-child(5)').html('').append('<img src="images/price1.png">');
    $('#table tbody tr:nth-child(3) td:nth-child(6)').html('').append('<img src="images/price4.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(2)').html('').append('<img src="images/price3.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(3)').html('').append('<img src="images/price1.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(4)').html('').append('<img src="images/price2.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(5)').html('').append('<img src="images/price4.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(6)').html('').append('<img src="images/price1.png">');
} else if (lg == 'Fre') {
    var icon = ' €';
    var price_calc = 110;
    lg_1 = 'JOURS';
    lg_2 = 'HOR';
    lg_3 = 'MIN';
    lg_4 = 'SEC';
    $('.price').append(' €');
    $('.Oplata .left-block p:nth-child(4) span ').addClass('new_back_1');
    $('.Oplata .left-block p:nth-child(5) span ').addClass('new_back_2');
    $('.Oplata .left-block p:nth-child(6) span ').addClass('new_back_3');
    $('#table tbody tr:nth-child(3) td:nth-child(2)').html('').append('<img src="images/price3.png">');
    $('#table tbody tr:nth-child(3) td:nth-child(3)').html('').append('<img src="images/price2.png">');
    $('#table tbody tr:nth-child(3) td:nth-child(4)').html('').append('<img src="images/price2.png">');
    $('#table tbody tr:nth-child(3) td:nth-child(5)').html('').append('<img src="images/price1.png">');
    $('#table tbody tr:nth-child(3) td:nth-child(6)').html('').append('<img src="images/price4.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(2)').html('').append('<img src="images/price3.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(3)').html('').append('<img src="images/price1.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(4)').html('').append('<img src="images/price2.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(5)').html('').append('<img src="images/price4.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(6)').html('').append('<img src="images/price1.png">');
} else if (lg == 'Cze') {
    lg_1 = 'DAYS';
    lg_2 = 'HOU';
    lg_3 = 'MIN';
    lg_4 = 'SEC';
    $('.price').append(' Kč');
    var icon = ' Kč';
    var price_calc = 110;
    $('.footer-tel').last().after('<div class="pt20"><p class="afooter-tel">Výhradní zastoupení pro Českou republiku společnost Vigour International</p><p class="afooter-tel">Adresa: Teronská 813/31, Praha 6</p></div>');
    $('.right_part1').addClass('rp_cz');
    $('.footer-block .footer-form input[type="submit"]').addClass('cze_bug');
    $('.discount .right-block input[type="submit"]').addClass('cze_bug');
    $('.action-green-block .main-desc ').addClass('cze_bug1');
    $('#table tbody tr:nth-child(3) td:nth-child(2)').html('').append('<img src="images/price3.png">');
    $('#table tbody tr:nth-child(3) td:nth-child(3)').html('').append('<img src="images/price2.png">');
    $('#table tbody tr:nth-child(3) td:nth-child(4)').html('').append('<img src="images/price2.png">');
    $('#table tbody tr:nth-child(3) td:nth-child(5)').html('').append('<img src="images/price1.png">');
    $('#table tbody tr:nth-child(3) td:nth-child(6)').html('').append('<img src="images/price4.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(2)').html('').append('<img src="images/price3.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(3)').html('').append('<img src="images/price1.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(4)').html('').append('<img src="images/price2.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(5)').html('').append('<img src="images/price4.png">');
    $('#table tbody tr:nth-child(4) td:nth-child(6)').html('').append('<img src="images/price1.png">');
}


function CountdownTimer(elm, tl, mes) {
    this.initialize.apply(this, arguments);
}
CountdownTimer.prototype = {
    initialize: function (elm, tl, mes) {
        this.elem = document.getElementById(elm);
        this.tl = tl;
        this.mes = mes;
    }, countDown: function () {
        var timer = '';
        var today = new Date();
        var day = Math.floor((this.tl - today) / (24 * 60 * 60 * 1000));
        var hour = Math.floor(((this.tl - today) % (24 * 60 * 60 * 1000)) / (60 * 60 * 1000));
        var min = Math.floor(((this.tl - today) % (24 * 60 * 60 * 1000)) / (60 * 1000)) % 60;
        var sec = Math.floor(((this.tl - today) % (24 * 60 * 60 * 1000)) / 1000) % 60 % 60;
        var me = this;

        if (( this.tl - today ) > 0) {
            timer += '<span class="number-wrapper"><div class="line"></div><div class="caption">' + lg_1 + '</div><span class="number day">' + day + '</span></span>';
            timer += '<span class="number-wrapper"><div class="line"></div><div class="caption">' + lg_2 + '</div><span class="number hour">' + hour + '</span></span>';
            timer += '<span class="number-wrapper"><div class="line"></div><div class="caption">' + lg_3 + '</div><span class="number min">' + this.addZero(min) + '</span></span><span class="number-wrapper"><div class="line"></div><div class="caption">' + lg_4 + '</div><span class="number sec">' + this.addZero(sec) + '</span></span>';
            this.elem.innerHTML = timer;
            tid = setTimeout(function () {
                me.countDown();
            }, 10);
        } else {
            this.elem.innerHTML = this.mes;
            $('#CDT2').addClass('action_end');
            $('#CDT').addClass('action_end');
            return;
        }
    }, addZero: function (num) {
        return ('0' + num).slice(-2);
    }
}

function CDT() {

    // Set countdown limit
    var tl = new Date($('#CDT').data('datetime'));
//console.log($('#CDT').attr('data-datetime'));
//console.log($('#CDT2').attr('data-datetime'));

    // You can add time's up message here
    var timer = new CountdownTimer('CDT', tl, '<span class="number-wrapper"><div class="line"></div><span class="number end">' + $('#CDT').data('endtext') + '</span></span>');
    var timer2 = new CountdownTimer('CDT2', tl, '<span class="number-wrapper"><div class="line"></div><span class="number end">' + $('#CDT2').data('endtext') + '</span></span>');
    timer2.countDown();
    timer.countDown();
}

window.onload = function () {
    CDT();
}
$(document).ready(function () {
    var $sliders = $('.Certificate-slider-cont .Certificate-slide').length;
    var number;

    $(window).resize(function () {
        slidesPerView();
        swiper.params.slidesPerView = number;
    });

    function slidesPerView() {
        number = 3;
        if (($(window).width() >= 791) && ($(window).width() < 1010)) {
            number = 2;
        } else if (($(window).width() >= 300) && ($(window).width() < 790)) {
            number = 1;
        }
        ;
    }

    slidesPerView();

    var swiper123 = new Swiper('.swiper-container', {
        slidesPerView: number,
        paginationClickable: true,
        loop: false,
        spaceBetween: 30
    });

    elements = [];

    for (var i = $('.nav li a').length - 1; i >= 0; i--) {
        scroll_els = $('.nav li a').eq(i).attr('href');
        elements[i] = scroll_els;
        //console.log(scroll_els);
    }
    ;

    add_class_active();

});


function add_class_active() {
    $('.nav li a').removeClass('Current_block');
    for (var i = elements.length - 1; i >= 0; i--) {
        if ($(elements[i]).length != 0) {
            var scroll = $(window).scrollTop();
            var el_off_set = $(elements[i]).offset().top - $('.block_fixed').height();
            var el_hight = $(elements[i]).height();
            var top_off_set = el_hight + el_off_set;

            if ((scroll >= el_off_set) && (scroll < top_off_set)) {
                $('a[href$="' + elements[i] + '"]').addClass('Current_block');
            }

        }
    }
    ;
}


$(window).scroll(function () {
    add_class_active();
});

function animateBlocks() {
    $('.secont-block').prepend($('.secont-block img').last())
    $('.secont-block img').first().animate({'bottom': '120px', 'left': '182px'}, 500);
    $('.secont-block img').first().next().animate({'bottom': '88px', 'left': '150px'}, 500);
    $('.secont-block img').first().next().next().animate({'bottom': '57px', 'left': '116px'}, 500);
    $('.secont-block img').first().next().next().next().animate({'bottom': '24px', 'left': '85px'}, 500);
    $('.secont-block img').first().next().next().next().next().animate({'bottom': '-6px', 'left': '48px'}, 500);
}

$(document).ready(function () {

});

setInterval(animateBlocks, 3000);

$(document).ready(function () {
    $('.installation .panel').mouseover(function () {
        $('.panel-point-hover').css('display', 'block');
    })

    $('.installation .panel').mouseout(function () {
        $('.panel-point-hover').css('display', 'none');
    })
    $('.panel-point-hover').click(function () {
        var div = $('.panel');
        if (div.height() == 145) {
            div.height(1050);
            $('.panel-point-hover').css({
                '-webkit-transform': 'rotate(180deg)',
                '-moz-transform': 'rotate(180deg)',
                '-ms-transform': 'rotate(180deg)',
                '-o-transform': 'rotate(180deg)',
                'transform': 'rotate(180deg)',
                'top': '970px'
            })
        }
        else {
            div.height(145);
            $('.panel-point-hover').css({
                '-webkit-transform': 'rotate(0deg)',
                '-moz-transform': 'rotate(0deg)',
                '-ms-transform': 'rotate(0deg)',
                '-o-transform': 'rotate(0deg)',
                'transform': 'rotate(0deg)',
                'top': '15px'
            })
        }
    });

    $('a[href^="#"]').click(function () {
        elementClick = $(this).attr("href");
        destination = $(elementClick).offset().top - $('.menu').height();
        if (true) {
            $('body,html').animate({scrollTop: destination}, 1100);
        } else {
            $('html').animate({scrollTop: destination}, 1100);
        }
        $('.nav-wrap').removeClass('active');
        return false;
    });


    /* Apply fancybox to multiple items */


    $('mramor').ddslick({

        onSelected: function (selectedData) {
            var description = selectedData['selectedData']['description'];
            var id = selectedData['selectedData']['value'];
            $('#' + description + ' #product_id').val(selectedData['selectedData']['value']);
            $('#main-product-images' + description).html($('.' + id).html());
            $(".grouped_elements").fancybox({
                openEffect: 'none',
                closeEffect: 'none',
                helpers: {
                    media: {},
                    overlay: {
                        locked: false
                    }
                }
            });

        }
    });
    $('#mramor1').ddslick({
        onSelected: function (selectedData) {
            //callback function: do something with selectedData;
        }
    });
});

// forms function


function send_form_from_main(formname) {
    var date = new Date();
    var curr_date = date.getDate();
    var curr_month = date.getMonth() + 1;
    var curr_year = date.getFullYear();
    var curr_hours = date.getHours();
    var curr_minutes = date.getMinutes();
    date = curr_year + "-" + curr_month + "-" + curr_date + " " + curr_hours + ":" + curr_minutes;
    ga('send', 'event', 'button', 'click', $('#' + formname).find('input[name="form_id"]').val());
    var name_error = $('#' + formname).find('input[name="name"]').attr('data-error');
    var phone_error = $('#' + formname).find('input[name="telephone"]').attr('data-error');
    var email = $('#' + formname).find('input[name="email"]').attr('data-error');
    $('#' + formname).validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            telephone: {
                required: true,
                minlength: 5
            },
            email: {
                required: true,
                email: true
            },
        },
        messages: {
            name: name_error,
            telephone: phone_error,
            email: email
        },
        submitHandler: function (form) {
            $.ajax({
                url: 'index.php?route=module/forms/save',
                type: 'post',
                data: $('#' + formname + ' input, #' + formname + ' select, #' + formname + ' textarea').serialize() + '&date=' + date,
                dataType: 'json',
                success: function (json) {
                    console.log($('#' + formname + ' input, #' + formname + ' select, #' + formname + ' textarea').serialize());
                    // $('#popapchik').html(' <div class="thanks"><span class="thanks-img"><img src="images/thanks-img.png" height="112" width="93" alt=""></span><p>СПАСИБО! <span>Ваш заказ принят</span></p></div>');
                    // $.fancybox({
                    // 'href':'#popapchik',
                    // 'transitionIn'  : 'elastic',
                    // 'transitionOut' : 'elastic',
                    // 'width':300,
                    // 'height':300,
                    // 'speedIn'   : 600, 
                    // 'speedOut'    : 200, 
                    // 'overlayShow' : true
                    // });

                    $.fancybox({
                        fitToView: false,
                        width: 450,
                        height: 270,
                        autoSize: false,
                        closeBtn: false,
                        closeClick: true,
                        openEffect: 'elastic',
                        closeEffect: 'elastic',
                        padding: 0,
                        helpers: {
                            title: {
                                type: 'inside'
                            },
                            overlay: {
                                locked: false
                            }
                        },
                        'href': '#popapchik'
                    });
                }
            });
        }
    });

}
$(document).ready(function () {
    // add_data
    $(".mask").mask("(999) 999-99-99");
    $('.form_data input').on('keydown', function (e) {
        if (e.keyCode == 13) {
            add_data();
        }
    });

    $('.button_buy').click(function (e) {
        e.preventDefault();
        ga('send', 'event', 'button', 'click', 'product-' + $(this).attr('data-id'));
        var modal = $(this).attr('data-id');
        $('#' + modal).show(400).click(function (e) {
            $(this).hide(400);
        });
        $('#' + modal + ' > *').click(function (e) {
            e.stopPropagation();
        });
    });
});

function cost_calk() {
    var val = parseInt($('#cost_val').val());
    var mod_370 = Math.round(val * 50 / 370);
    var sum_pover_370 = mod_370 * 370;
    var sum_cost_370 = mod_370 * price_calc;

    /* var mod_500 = Math.round(val*50/430);
     var sum_pover_500 = mod_370*430;
     var sum_cost_500=mod_370*1495;*/

    $('.mod_370 td:nth-child(2)').html(mod_370);
    $('.mod_370 td:nth-child(3)').html(sum_pover_370);
    $('.mod_370 td:nth-child(4)').html(sum_cost_370);

    /* $('.mod_500 td:nth-child(2)').html(mod_500) ;
     $('.mod_500 td:nth-child(3)').html(sum_pover_500) ;
     $('.mod_500 td:nth-child(4)').html(sum_cost_500) ;*/

}
function send_form_sale(el) {
    el.parent().validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            telephone: {
                required: true,
                minlength: 5
            },
        },
        messages: {
            name: "Имя обязательно для заполнения!",
            telephone: "Номер телефона обязателен для заполнения!",
        },
        submitHandler: function (form) {
            $.ajax({
                url: 'index.php?route=checkout/checkout2/save',
                method: 'get',
                data: el.parent().serialize(),
                success: function (response) {
                    var lg = $('.btn-link span').html();
                    if (lg == 'Ukr') {
                        el.parent().html(' <div class="thanks"><span class="thanks-img"><img src="images/thanks-img.png" height="112" width="93" alt=""></span><p>ДЯКУЄМО <span>за замовлення!</span></p></div>');
                    } else {
                        el.parent().html(' <div class="thanks"><span class="thanks-img"><img src="images/thanks-img.png" height="112" width="93" alt=""></span><p>СПАСИБО! <span>Ваш заказ принят</span></p></div>');
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }
    });

}

function changequq(el) {
    var id = el.parent().parent().find('.product-id').html();
    var price = el.parent().find('.price').html();
    var hidden_price = el.parent().find('#hidden_price' + id).val();
    var price_format = parseFloat(price.replace(/[^0-9\.\,]/g, ''));
    var quantity = el.val();


    if (quantity !== "0" && quantity !== "") {
        el.parent().find('.price').html(price_format * quantity + icon); //+ " грн"
        $('#' + id).find('input[name="quantity"]').val(quantity);
    } else {
        el.parent().find('.price').html(hidden_price);
        $('#' + id).find('input[name="quantity"]').val("1");
    }
}
//smoke
function stopSmoke() {
    $(document).ready(function () {
        $('#smoke-container').remove();
    });

}
function startSmoke() {
    $(document).ready(function () {
        $('.action-green-block').append('<div id="smoke-container">');
    });
    var smokeContainer = document.getElementById('smoke-container');
    document.addEventListener('mousemove', function (e) {
        console.log('moved', e);
        smokeContainer.style.top = (e.y - 250) + 'px';
        smokeContainer.style.left = (e.x - 240) + 'px';
    });


    function createSmoke(n) {
        return function () {
            var smoke = document.createElement('div');
            smoke.className = "smoke-" + n;
            smokeContainer.appendChild(smoke);
        };
    }

    setInterval(createSmoke(2), 1000);
    setInterval(createSmoke(1), 2000);
    setInterval(createSmoke(2), 3000);
    setInterval(createSmoke(1), 4000);
    setInterval(createSmoke(2), 5000);
    setInterval(createSmoke(1), 6000);
}

$(document).ready(function () {





//    setTimeout($('.scroll_me').addClass('show_scroll' , 1000);
//    setTimeout($('.scroll_me').removeClass('show_scroll' , 1000);

    $('.scroll_me').click(function () {
        window.scrollBy(0, 700);
    });


    $('.dropdown-menu li a:first-child').clone().appendTo(".for_lang");
});


var no_active_delay = 2; // Количество секунд простоя мыши, при котором пользователь считается неактивным
var now_no_active = 0; // Текущее количество секунд простоя мыши
setInterval("now_no_active++;", 1000); // Каждую секунду увеличиваем количество секунд простоя мыши
setInterval("updateChat()", 1000); // Запускаем функцию updateChat() через определённый интервал
document.onmousemove = activeUser; // Ставим обработчик на движение курсора мыши
function activeUser() {
    now_no_active = 0; // Обнуляем счётчик простоя секунд
}
function updateChat() {
    if (now_no_active >= no_active_delay) { // Проверяем не превышен ли "предел активности" пользователя
        $(document).ready(function () {
            $('.scroll_me').animate({"opacity": "0"}, 500);
        });
        //alert("Пользователь не активен"); // В реальности стоит убрать, а здесь дано как доказательство того, что всё работает

        return;
    } else {
        $(document).ready(function () {
            $('.scroll_me').animate({"opacity": "0.5"});
        });
    }
    /* Обновляем чат */
}
$(document).ready(function () {
    // $('.logo').append('<div class="tel"><a href="#" class=\'more_cont\' onclick="console.log(\'123\')">123</a></div>');
    $('.number_1').clone().prependTo('.for_first_tel');
    $('.number_2').clone().prependTo('.for_second_tel');
    $('.more_cont').click(function () {
        var display;
        $('.fr').toggleClass('ok');
        $('.sd').toggleClass('sh');

        $('.for_second_tel').toggle(display);
        if (display === true) {

            $(".for_second_tel").show();
            $('.fr').addClass('123');

        } else if (display === false) {

            $(".for_second_tel").hide();

        }
    });


});


