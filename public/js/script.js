"use strict";

//sidebar navigation close method.
var closeNavigate = function () {
    $('.overlay').hide();
    $('.sidebar').removeClass('opened');
    $('body').removeClass('fixed');
}

//sidebar navigation close method.
var openNavigate = function () {
    if ($(window).width() < 760)
        $('body').addClass('fixed');
    $('.overlay').show();
    $('.sidebar').addClass('opened');
}

//creating mobile menu from header menu
var createMobileMenu = function () {
    var newMenu = '<ul class="sidebar-menu">';
    var menuContent = $('[data-show-menu-on-mobile]').html();
    menuContent = menuContent.replace(/<div class="header-submenu">/g, "");
    menuContent = menuContent.replace(/<\/div>/g, "");
    newMenu = newMenu + menuContent + '</ul>';
    $('#mobileMenu').prepend(newMenu);

    $('#mobileMenu li a').each(function () {
        var t = $(this).text().trim();

        if ($(this).find('i').length) {
            $(this).html('<span class="menu-label">' + t.slice(0, -1) + '</span><span class="multimenu-icon"><i class="material-icons">&#xE313;</i></span>')
        }
        else
            $(this).html('<span class="menu-label">' + t + '</span>');
    });


}


var scrollPos = 0, scrollTime;
//show or hide header with scroll position.
var showHideHeader = function (e) {
    clearTimeout(scrollTime);

    var currentScroll = $(this).scrollTop();

    if (currentScroll < 60) {
        $('header').removeClass('hide');
    } else {
        if (currentScroll <= scrollPos) {
            // $('header').removeClass('hide');
            $('.header-top').removeClass('hide');
        }
        else {
            $('header').addClass('hide');
            $('.header-top').addClass('hide');
            $('.search-bar').removeClass('active');
        }
    }

    scrollTime = setTimeout(function () {
        scrollPos = $(window).scrollTop();
    }, 100);
}

//add material wave effect to element
var addWaveEffect = function (self, e) {
    // var wave = '.wave-effect',
    //     btnWidth = self.outerWidth(),
    //     x = e.offsetX,
    //     y = e.offsetY;
    //
    // self.prepend('<span class="wave-effect"></span>')
    //
    // $(wave).css({'top': y, 'left': x}).animate({
    //   opacity: '0',
    //   width: btnWidth * 2,
    //   height: btnWidth * 2
    // }, 500, function () {
    //   self.find(wave).remove()
    // })
}

//making sidebars fix to screen top.
var setStickySidebar = function () {
    //if window screen < 960 sidebar hiding.
    // if (window.outerWidth > 960) {
    //     var sidebar = $('.sidebar_inner');
    //     var sidebarHeight = sidebar.outerHeight();
    //     var windowHeight = $(window).height();
    //     var wrapperTopPos = $('.main-content').position().top;
    //     var scrollTop = $(this).scrollTop();
    //
    //     if ((sidebarHeight + 30) < windowHeight) {
    //         if ((scrollTop + 30) > wrapperTopPos)
    //             sidebar.css({'position': 'fixed', 'top': 30});
    //         else
    //             sidebar.css({'position': 'absolute', 'top': 0});
    //     }
    //     else {
    //         if (scrollTop > (wrapperTopPos + 30 + sidebarHeight - windowHeight))
    //             sidebar.css({'position': 'fixed', 'top': -(sidebarHeight + 30 - windowHeight)});
    //         else
    //             sidebar.css({'position': 'absolute', 'top': 0});
    //
    //     }
    //
    //     if ($('.article-left-box-inner').length) {
    //
    //         var leftSidebar = $('.article-left-box-inner');
    //         var leftSidebarH = leftSidebar.outerHeight();
    //         var endOfTheArticlePos = $('#endOfTheArticle').offset().top;
    //
    //         if ((scrollTop + 30) > wrapperTopPos) {
    //             if ((scrollTop + leftSidebarH + 80) > endOfTheArticlePos)
    //                 leftSidebar.css({'position': 'absolute', 'top': 'auto', 'bottom': 10});
    //             else
    //                 leftSidebar.css({'position': 'fixed', 'top': 70, 'bottom': 'auto'});
    //         }
    //         else
    //             leftSidebar.css({'position': 'absolute', 'top': 0, 'bottom': 'auto'});
    //
    //
    //     }
    // }
}


/*detail page parallax effect script */
var makeParallax = function () {
    var scrollTop = $(this).scrollTop();
    if (scrollTop < 300)
        $('.parallax-box .parallax-image').css({'transform': 'translate3d(0px, ' + (scrollTop / 2) + 'px, 0px)'});

    var opacity = 1;
    if (scrollTop > 10 && scrollTop < 50)
        opacity = 0.9;
    else if (scrollTop >= 50 && scrollTop < 100)
        opacity = 0.8;
    else if (scrollTop >= 100 && scrollTop < 150)
        opacity = 0.7;
    else if (scrollTop >= 150 && scrollTop < 200)
        opacity = 0.6;
    else if (scrollTop >= 200 && scrollTop < 250)
        opacity = 0.5;
    else if (scrollTop >= 250 && scrollTop < 300)
        opacity = 0.4;
    else if (scrollTop >= 300 && scrollTop < 350)
        opacity = 0.3;
    else if (scrollTop >= 350 && scrollTop < 400)
        opacity = 0.2;
    else if (scrollTop >= 400)
        opacity = 0;

    $('.parallax-box .post-overlay-inner').css({'opacity': opacity});
}


//Browser is IE check
var GetIEVersion = function () {
    var sAgent = window.navigator.userAgent;
    var Idx = sAgent.indexOf("MSIE");

    // If IE, return version number.
    if (Idx > 0)
        return parseInt(sAgent.substring(Idx + 5, sAgent.indexOf(".", Idx)));
    // If IE 11 then look for Updated user agent string.
    else if (!!navigator.userAgent.match(/Trident\/7\./))
        return 11;
    else
        return 0; //It is not IE
}


$(document).ready(function () {

    //initialize zebra tooltip plugin.
    new $.Zebra_Tooltips($('[data-zebra-tooltip]'), {
        'animation_speed': 50,
        'animation_offset': 10,
        'hide_delay': 0,
        'show_delay': 0
    });

    //first creating mobile menu for mobile screen sizes
    createMobileMenu();

    //first show header submenus
    // $('.header-submenu').show();

    //close sidebar panel, clicked overlay and close sidebar button.
    $('.overlay, .sidebar-toggle-button').on('click', function () {
        closeNavigate();
    });

    //sidebar menu click event. open when clicked.
    $('.toggle-sidebar').on('click', function () {
        openNavigate();
    });

    //search panel toggler
    $('.search-toggle').on('click', function (e) {
        e.preventDefault();
        $('.search-bar').toggleClass('active');
        if ($('.search-bar').hasClass('active')) {
            $('.search-input').focus();
        }
    });

    //playerlist height setting. for internet explorer
    if (GetIEVersion() > 0) {
        $('.playerlist').height($('.player-box').outerHeight());
        $('.timeline-item').each(function () {
            var rightH = $(this).find('.timeline-right').outerHeight();
            $(this).find('.timeline-left-wrapper').height(rightH);
        });
    }

    $('.submenu-toggle').on('mouseenter', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('.header-submenu').removeClass('active');
        $(this).next('.header-submenu').addClass('active').show();
    });

    $('.header-submenu').on('mouseleave', function (e) {
        $(this).removeClass('active').hide();
    });

    $('.sidebar-menu > li > a').on('click', function (e) {
        var firstSubMenu = $(this).parent().find('ul:first');
        var that = $(this);
        if (firstSubMenu.length) {
            e.stopPropagation();
            e.preventDefault();
            that.parent().parent().find('li').removeClass('active');
            if (firstSubMenu.css('display') == 'block')
                that.parent().removeClass('active');
            else
                that.parent().addClass('active');

            firstSubMenu.slideToggle(100);

        }
    });

    $('.article-left-box').css('height', $('.article-inner').outerHeight())

    setStickySidebar.call($(window));

    makeParallax.call($(window));

    $('.material-button').on('click', function (e) {
        $('.material-button').not($(this)).next('.header-submenu').hide();
        // addWaveEffect($(this), e);
        $(this).next('.header-submenu').toggleClass('active');
    });

    $(document).on('click', function (event) {
        //close submenu on anywhere
        var clickover = $(event.target);
        var _opened = $(".header-submenu").hasClass("active");
        if (_opened === true && !clickover.hasClass("submenu-toggle")) {
            $(".header-submenu").removeClass('active');
        }

        //close searchbar on click anywhere
        if (clickover.parents('.search-bar').length < 1 && !clickover.hasClass("search-bar") && !clickover.parent().hasClass("search-toggle") && !clickover.hasClass("search-toggle")) {
            $('.search-bar').removeClass('active');
        }
    });

    //sidebar boxed posts scripts
    $('.team-link').on('mouseover', function (e) {
        $(this).addClass('service-img-hover');
        $(this).find('.team-more').addClass('team-more-hover');
    });

    $('.team-link').on('mouseleave', function (e) {
        $(this).removeClass('service-img-hover');
        $(this).find('.team-more').removeClass('team-more-hover');
    });

    //trigger scrollable elements actions
    $(window).on('scroll', function () {
        showHideHeader.call(this);
        setStickySidebar.call(this);
        makeParallax.call(this);
    });

    //sidebar boxed posts scripts
    $('.w-boxed-post ul li').on('mouseover', function (e) {
        $(this).parent().find('li').removeClass();
    });

    $('.w-boxed-post ul li').on('mouseleave', function (e) {
        $(this).addClass('active');
    });

    //article share emoticons action
    $('.article-emoticons>li').on('mouseover', function (e) {
        $(this).parent().addClass('active');
    });
    $('.article-emoticons>li').on('mouseleave', function (e) {
        $(this).parent().removeClass('active');
    });


});


/*live event triggers*/
/*open popup modal from data attribute*/
$(document).on('click', '[data-modal]', function (e) {
    e.preventDefault();
    $('.m-modal-box').hide();
    var modalId = $(this).attr('data-modal');
    $('#' + modalId).show();
});
/*close popup modal clicked close button*/
$(document).on('click', '.m-modal-close, .m-modal-overlay', function (e) {
    $(this).parents('.m-modal-box').hide();
});

// $('#product-slideshow').lightSlider({
//     gallery:true,
//     item:1,
//     loop:true,
//     thumbItem:9,
//     slideMargin:0,
//     enableDrag: true,
//     currentPagerPosition:'left',
//     vThumbWidth:50,
// });

//Owl carousel initializing
// $('#postCarousel').owlCarousel({
//   loop: true,
//   dots: true,
//   nav: true,
//   navText: ['<span><i class="material-icons">&#xE314;</i></span>', '<span><i class="material-icons">&#xE315;</i></span>'],
//   items: 1,
//   margin: 20
// });

//Owl carousel initializing
// $('.map-slideshow').owlCarousel({
//     loop: true,
//     dots: true,
//     items: 1,
//     margin: 20,
//     autoplay: true
// })

// $('.act-carousel').owlCarousel({
//     centerMode: true,
//     loop: true,
//     dots: true,
//     margin: 10,
//     nav: true,
//     navText: ['<span><i class="material-icons">&#xE314;</i></span>', '<span><i class="material-icons">&#xE315;</i></span>'],
//     items: 3,
//     responsive: {
//         0: {
//             items: 1,
//         },
//         600: {
//             items: 2,
//         },
//         1000: {
//             items: 3,
//         }
//     }
// })

// $('.act-carousel').owlCarousel();

var path_info = window.location.href;
$('.menu-link1').each(function () {
    var href = $(this).attr('href');
    // $('.menu-link1').removeClass('menu-active');
    if (path_info == href) {
        $(this).addClass('menu-active');
    }
})

//widget carousel initialize
// $('#widgetCarousel').owlCarousel({
//     dots: true,
//     nav: false,
//     items: 1
// })

//widget carousel initialize
// $('#myCarousel1').owlCarousel({
//     dots: true,
//     nav: false,
//     items: 1
// })
function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
$(function () {

    // $("#input_username").keyup(function () {
    //     var val = $(this).val();
    //     $("#input_email").val(val);
    // })
    $("#click_reg").click(function () {

        var ret = grecaptcha.getResponse();
        if (!ret) {
            alert("Cần check vào ô I'm  not robot");
            return;
        }

        // var fullname = $("#input_fullname").val();
        var username = $("#input_username").val();
        var password1 = $("#input_password").val();
        var password2 = $("#input_password2").val();
        var email = $("#input_email").val();

        var handphone = $("#input_handphone").val();

//            if(fullname.length < 3){
//                alert("Họ tên không hợp lệ (Tối thiểu 3 ký tự)");
//                return;
//            }
//         console.log(username);

        if (username.length < 6) {
            alert("Username phải có độ dài nhỏ nhất là 6 ký tự");
            $("#input_username").focus();
            return;
        }

        if (handphone.length < 10) {
            alert("Password phải có độ dài nhỏ nhất là 10 ký tự");
            $("#input_handphone").focus();
            return;
        }

        if (!validateEmail(email)) {
            alert("Email chưa đúng định dạng");
            $("#input_email").focus();
            return;
        }

        if (password1.length < 6) {
            alert("Password phải có độ dài nhỏ nhất là 6 ký tự");
            $("#input_password").focus();
            return;
        }
        if (password2.length < 6) {
            alert("Password nhập lại phải có độ dài nhỏ nhất là 6 ký tự");
            $("#input_password2").focus();
            return;
        }
        // if (email.length < 7) {
        //     alert("Email không hợp lệ?");
        //     $("#input_email").focus();
        //     return;
        // }

        if (password1 != password2) {
            alert("Mật khẩu không trùng nhau?");
            return;
        }



        $("#waitting_icon").show();
        $.post("/a_p_i/public-common/registration",
            {
                // fullname: fullname,
                username: username,
                password1: password1,
                password2: password2,
                email: email,
                handphone: handphone,
                captcha: grecaptcha.getResponse()
            },
            function (data, status) {
                $("#waitting_icon").hide();
                if (!ClassApi.checkReturnApi(data)) {
                    grecaptcha.reset();
                    return;
                }
                showDialogCommon("Confirm: " + data.payload);
            })
    })
})

$(document).ready(function () {

    $('.add-to-cart').each(function () {
        $(this).click(function () {
            event.preventDefault();
            var product_id = $(this).attr('data-id');
            $.ajax({
                url: window.location.href,
                method: 'POST',
                data: {
                    product_id: product_id,
                    is_ajax: true,
                },
                success: function (data) {
                    $('.ajax-message').html('Thêm sản phẩm vào giỏ thành công').addClass('ajax-message-active');

                    setTimeout(function () {
                        $('.ajax-message').removeClass('ajax-message-active');
                    }, 3000);
                    var cart_total = $('.cart-amount').text();
                    cart_total = parseInt(cart_total);
                    cart_total++;
                    $('.cart-amount').text(cart_total);
                    $('.cart-amount-mobile').text(cart_total);
                }
            })
        })
    })

    // $( '#my-slider' ).sliderPro({
    //     fullScreen: true,
    //     arrows: true,
    //     buttons: false,
    //     autoplay: false,
    //     thumbnailWidth: 50,
    //     thumbnailHeight: 50,
    //     width: 960,
    //     height: 350,
    // });
    //
    // $( '.product-slider').sliderPro({
    //     fullScreen: true,
    //     arrows: true,
    //     buttons: false,
    //     autoplay: false,
    //     thumbnailWidth: 50,
    //     thumbnailHeight: 50,
    //     width: '100%',
    //     // width: 960,
    //     // height: 350,
    // });

    // $( '.banner-slider').sliderPro({
    //     arrows: true,
    //     buttons: false,
    //     autoplay: true,
    //     width: '100%',
    //     // width: 960,
    //     height: 450,
    // });

    // $(".custom-slideshow").owlCarousel({
    //     dots: false,
    //     nav: false,
    //     loop: false,
    //     auto: true,
    //     margin: 40,
    //     autoplay: true,
    //     autoplayTimeout: 3500,
    //     responsive: {
    //         0: {
    //             items: 1
    //         },
    //         600: {
    //             items: 3
    //         },
    //         1000: {
    //             items: 4
    //         }
    //     }
    //     // prevHtml: 'Prev',
    //     // nextHtml: 'Next',
    // });

    // $( '.act-wrap .sp-slide .sp-image' ).click(function(){
    //     if( ! $('.act-wrap .slider-pro').hasClass('sp-swiping') ) {
    //         $( '.act-wrap .sp-full-screen-button' ).trigger( 'click' );
    //     }
    // });
    //
    // $( '.act-wrap.gallery .sp-slide' ).click(function(){
    //     if( ! $('.act-wrap .slider-pro').hasClass('sp-swiping') ) {
    //         $( '.act-wrap .sp-full-screen-button' ).trigger( 'click' );
    //     }
    // });
    //
    // $( '.image-wrap' ).click(function(){
    //     var file_id = $(this).attr('file-id');
    //     $('.sp-slide[file-id='+ file_id +']').click();
    // });


    // var i = 0;
    // var txt = $('#text-effect').attr('data-content');
    // var speed = 150;
    //
    // function typeWriter() {
    //     if (!txt) {
    //         return;
    //     }
    //     if (i < txt.length) {
    //         document.getElementById("text-effect").innerHTML += txt.charAt(i);
    //         i++;
    //         setTimeout(typeWriter, speed);
    //     }
    // }
    //
    // typeWriter();
    //show more text
    // $('.container').not('.item-static').find(".detail-description").showMore({
    //     // minheight: 1550, // measured in px
    //     // buttontxtmore: 'Đọc thêm',
    //     // buttontxtless: 'Rút gọn',
    //     // buttoncss: 'read-more',
    //     // animationspeed: 500
    // });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $('.scrollup').click(function () {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });


    $('.detail-content-wrap img').click(function () {
        // If no parent is link, click to show full image
        if(!$(this).parents('a').length) {
            var src = $(this).attr('src');
            if (src) {
                window.open(window.location.origin + src);
            }
        };

    })

    $('.click-scroll-service').click(function () {
        $('.header-submenu').hide();
        $(this).next('.header-submenu').show();
        $('html, body').animate({
            scrollTop: $(".service-info").offset().top
        }, 1000);
    });

    // $('.iframe-link').click(function () {
    //     console.log("Dsads");
    //     location.href = $(this).find('iframe').attr('src');
    // })

    $('[data-toggle="tooltip"]').tooltip();

    // $('.swipebox').swipebox();

    $('.form-search select').change(function () {
        // $('.form-search').submit();
    })

    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };

    var search = getUrlParameter('search');
    var page = getUrlParameter('page');
    if (search || page) {
        $([document.documentElement, document.body]).animate({
            scrollTop: $(".form-search").offset().top - 200
        }, 200);
    }

});
