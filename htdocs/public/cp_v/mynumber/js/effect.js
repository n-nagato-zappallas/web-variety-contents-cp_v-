/**
 * ページスクロール（第二階層）
 */

function pageScroll() {
    $('body,html').animate({ scrollTop : $('#base').offset().top }, 600, 'swing');
} 

/**
 * PC,SP切り分け
 */
$(document).ready(function(){
    var ua = navigator.userAgent;
    if( ua.match(/Android|iPhone|iPod|Mobile/) ) {
        $('.is_sp').show();
        $('.is_pc').remove();
    }
    else {
        $('.is_pc').show();
        $('.is_sp').remove();
    }
	
	//Topへ戻るボタン
	var pagetop = $('.pagetop');
	$(window).scroll(function () {
		if ($(this).scrollTop() > 500) {
			pagetop.fadeIn();
		} else {
			pagetop.fadeOut();
		}
	});
	pagetop.click(function () {
	$('body, html').animate({ scrollTop: 0 }, 500);
		return false;
	});
	
});

$(function(){
if ((navigator.userAgent.indexOf('iPhone') > 0 || navigator.userAgent.indexOf('iPad') > 0 || navigator.userAgent.indexOf('Android') > 0 || navigator.userAgent.indexOf('Mobile') > 0 ) && (window.screen.width < 640 || window.screen.height < 640)) {
	var portraitWidth,landscapeWidth;
	$(window).bind("load resize", function(){
		if(Math.abs(window.orientation) === 0){
			if(/Android/.test(window.navigator.userAgent)){
				if(!portraitWidth)portraitWidth=$(window).width();
			}else{
				portraitWidth=$(window).width();
			}
			$("html").css("zoom" , portraitWidth/375 );
		}else{
			if(/Android/.test(window.navigator.userAgent)){
				if(!landscapeWidth)landscapeWidth=$(window).width();
			}else{
				landscapeWidth=$(window).width();
			}
			$("html").css("zoom" , landscapeWidth/375 );
		}
	})
}
});
