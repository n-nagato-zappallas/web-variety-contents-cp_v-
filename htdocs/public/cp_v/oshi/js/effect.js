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

// ドーナツチャートの描画

var circle = document.getElementById('circle');
if (circle) {


function checkUA() {
	ret = true;
	var userAgent = window.navigator.userAgent.toLowerCase();
	var appVersion = window.navigator.appVersion.toLowerCase();
	if( userAgent.indexOf('msie') != -1
		&& appVersion.indexOf("msie 10.") == -1 )
			ret = false;
	return ret;
}

///* PC - SP ************************************** */
const isSP = navigator.userAgent.indexOf('iPhone') > 0 
		  || navigator.userAgent.indexOf('iPad') > 0 
		  || navigator.userAgent.indexOf('Android') > 0 
		  || navigator.userAgent.indexOf('Mobile') > 0 
		  || window.screen.width < 640 
		  || window.screen.height < 640;

var bool_2 = $('#circle').length;

	/**
	 * 描画処理
	 */
	var len = isSP ?180 :300;
	var canvas = document.getElementById('circle');
	var max = canvas.getAttribute('data-value');
	var ctx = '';
	var timer;
	var cnt = 0;
	// 初期表示
	var obj = document.getElementById('circle');
	if( $('#circle').length ) {
		obj.width = len;
	    obj.height = len;
		ctx = obj.getContext('2d');
	}

	function draw() {
	    cnt++;
	    var ang = cnt / 230;
	    // 内線描画
	    if( checkUA() ) {
	        ctx.clearRect( 0, 0, len, len );
	        ctx.beginPath();
	        ctx.lineWidth = 10;
	        ctx.strokeStyle = "#C75CBC";
			ctx.arc(len * 0.5, len * 0.5, (len * 0.4) + 13, Math.PI * 1.5, Math.PI * 1.5 + Math.PI * 2 * ang, false);
	        ctx.stroke();
			var diameter = ((len * 0.4) + 16) * 2;
	    }

	    // 数字描画
	    var per = Math.floor( ang *100 );
	    if( per > max ) per = max;
	    per = ( per.length == 1 ?'0' :'' ) +per;
	    $('#g1').removeClass().addClass('graph' +per.substr(0,1));
	    $('#g2').removeClass().addClass('graph' +per.substr(1,1));


	    // 描画終了判定
	    if( ang > max /100 )
	        clearInterval( timer );
	}
	/**
	 * ぱららすたーと
	 */
	let offsetCheck = function() {
		let st = $(window).scrollTop();
		
		// 固定コーナー
		$('.result_aisho').each( function(i, elem) {
			if ( !$(elem).hasClass('don_zap') && st > $(elem).offset().top -50 ) {
				$(elem).addClass('don_zap');
				doSpread( i, elem);
			}
		});
	}

	$( window ).scroll( offsetCheck );
	$('body').bind( 'touchmove', offsetCheck );

/*** /イベントの制御 ***/

	
	/**
	 * 
	 */
	function doSpread( i, elem){
		var g = '.result_aisho:eq('+i+') ';
		var mt = isSP ?160 :215;

		// 分類№1 相性
		if( $(g +'.chart')[0] ) {
			$(g +' div[class^="bg_waku"]').animate({ 'opacity':1 }, 600);
			timer = setInterval( draw, 10 );
		} 
	}


}



// 有料 ラダーチャート
var point_graph = document.getElementById('point_graph');
	if (point_graph) {


		// htmlタグのクラス名を取得
		const className = $('html').attr('class');
		/**
		 * animate非対応の物をアニメする
		 */
		$.fn.animate2 = function ( properties, duration, ease ) {
			ease = ease || 'ease';
			let $this = this;
			let cssOrig = { transition: $this.css('transition') };
			properties['transition'] = 'all ' + duration + 'ms ' + ease;
			$this.css( properties );
			setTimeout(function () {
				$this.css( cssOrig );
			}, duration);
		};
		//ページ内リンク
		$('a[href^=#]').click(function() {
			const speed = 400;
			let href= $(this).attr("href");
			let target = $(href == "#" || href == "" ? 'html' : href);
			const position = target.offset().top;
			$('body,html').animate({ scrollTop: position }, speed, 'swing');
			return false;
		});

		/* スクロール位置 */
		let timer;
		let cnt = 0;
		// let bool_1 = $('#graph_bdy')[0];
		let bool_2 = $('#point_graph')[0];
		// let bool_3 = $('#graph_bdy')[0];
		let offsetCheck = function() {
			// if ( bool_3 && $(window).scrollTop() > $('.graph_group .result_bg').offset().top -200 ) {
			// 	bool_3 = false;
			// 	$('.graph_group .result_bg .severalmenu').animate({'opacity':1});
			// }

			// 完全無料
			// if ( bool_2 && $(window).scrollTop() >= $('#result_double').offset().top +150 ) {
			if ( bool_2) {
				bool_2 = false;
				point_graph();
			}
			
			// TOPに戻る
			if( $(window).scrollTop() > 80 ) {
				$('.pagetop').fadeIn();
			} else {
				$('.pagetop').fadeOut();
			}
		}
		// $( window ).scroll( offsetCheck );
		// $('body').bind( 'touchmove', offsetCheck );
		offsetCheck();

		
		for( i=1; i<= 6; i++ ){
			$('#point_graph').append('<div id="c' +i +'"></div>');
		}
		if (className.includes('disp_pc')) {
			// 左上を頂点角60°とした二等辺三角形を描画
			var cc = $('#result_double')[0] ?'rgb(242, 6, 173)':'rgb(210, 170, 240)';
			$('#c1,#c2,#c3,#c4,#c5,#c6').css({ 
				'position': 'absolute', 
				'transform-origin': 'left top', 
				'width':  '177px', 
				'height': '195px', 
				'left':'375px', 
				'top': '375px', 
				'background-color': cc,
				'clip-path': 'polygon(0 0, 0% 0%, 0% 0%)', 
				'opacity':0
			});
		} else if (className.includes('disp_sp')) {
			// 左上を頂点角60°とした二等辺三角形を描画
			var cc = $('#result_double')[0] ?'rgb(242, 6, 173)':'rgb(210, 170, 240)';
			$('#c1,#c2,#c3,#c4,#c5,#c6').css({ 
				'position': 'absolute', 
				'transform-origin': 'left top', 
				'width':  '89px', 
				'height': '98px', 
				'left':'188px', 
				'top': '188px', 
				'background-color': cc,
				'clip-path': 'polygon(0 0, 0% 0%, 0% 0%)', 
				'opacity':0
			});
		}

		// 60°ずつ反時計回りに回転
		for( i=1; i<=6; i++ ) {
			$('#c'+i).css({ 'transform': 'rotate(' +( -120 +( 60 *(i-1) ) ) +'deg)' });
		}

		function point_graph(){	
			setTimeout(function(){ 
				let n = [ 0, 1, 1, 1, 1, 1, 1 ];
				for( i=1; i<=6; i++) {
					var aishoResult = parseInt($('.item_' + i).data('pos')); // data-pos 属性を直接取得して数値に変換する
					n[i] = parseInt(aishoResult);
				}
				// 六角形の中心を頂点とし、ポイントを2辺の長さとした三角形を６つ描画。
				// 三角形は60度ずつ時計回りに回転して配置。
				// ポリゴン最小値　'polygon(0 0,0% 10%,9.5% 5%)'
				for( i = 1; i <= 6; i++ ){
					let x = n[i] * 0.95;
					let y = x * 0.52631579;
					let z = n[i+1] ?n[i+1]:n[1];
					let path = 'polygon(0 0, 0% ' + z + '%, ' + x + '% ' + y + '%)';

					$('#c' +i).animate2({
						'clip-path': path, 'opacity': 0.6
					}, 1000);
				}
			}, 0);
		}
	}
});
