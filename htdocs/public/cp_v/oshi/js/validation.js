
// 定数定義
// 辞書
var character = [];
setArrSeimei();


// 入力フォーム部品の物理名と論理名
var arrParamName = {
	name			:'お名前',
	last_name		:'姓',
	first_name		:'名',
	last_name_kana	:'せい',
	first_name_kana	:'めい',
	tel				:'携帯番号下4桁',

	birth_year		:'生まれた年',
	birth_month		:'生まれた月',
	birth_day		:'生まれた日',
	birth_hour		:'生まれた時間',
	birth_min		:'生まれた分',
	sex				:'性別',
	blood_type		:'血液型',
	place_birth		:'出生地',
	birth_order		:'生まれ順',
	sign			:'星座',
	
	relationship	:'相手との関係',
	when_I_met		:'出会った時期'
};

// 文字数カウント表記
$(function(){
	$('input[type="text"]').each( function(i, elem) {
		if( $(elem).data('length') !== 'undefined' ) {
			var s = $(elem).val(),
				n = $.trim(s.replace(/\n/g, "")),
				c = n.length;
			$(elem).next('.count_num').html( c +"/" +$(elem).data('length') +"文字" );
		}
	});
	
	$('input[type="text"]').bind('keydown keyup keypress change',function(){
		if( $(this).data('length') !== 'undefined' ) {
			var s = $(this).val(),
				n = $.trim(s.replace(/\n/g, "")),
				c = n.length;
			$(this).next('.count_num').html( c +"/" +$(this).data('length') +"文字" );
		}
	});
	
    if($('#birth_year_other').val())
    {
        $('#birth_form_close_other').show();
    }
    if($('#name_other').val())
    {
        $('#name_form_close_other').show();
    }
    if($('#birth_year_self').val())
    {
        $('#birth_form_close_self').show();
    }
    if($('#name_self').val())
    {
        $('#name_form_close_self').show();
    }
	
	const registBirthEvent = ( birth_year, birth_month, birth_mday, form_close ) => 
    {
        birth_year.on('change keyup', function(e){
            // 9:Tab 16:Shift
            if(e.keyCode === 9 || e.keyCode === 16) return;
    
            if (birth_year.val().match(/^[0-9]{0}$/) && birth_month.val().match(/^[0-9]{0}$/) && birth_mday.val().match(/^[0-9]{0}$/)) {
                form_close.hide();
            }else{
                form_close.show();
            }
    
            if ($(this).val().match(/^[0-9]{4}$/)) {
                birth_month.focus();
            }
        });
    
        birth_year.on('change blur', function(){
            this.value = this.value.replace(/[^0-9]+/i,'');
        });
        birth_year.on('keyup', function(e){
            if(e.keyCode !== 13) return;
            this.value = this.value.replace(/[^0-9]+/i,'');
        });

        birth_month.on('change keyup', function(e){
            if(e.keyCode === 9 || e.keyCode === 16) return;
    
            if (birth_year.val().match(/^[0-9]{0}$/) && birth_month.val().match(/^[0-9]{0}$/) && birth_mday.val().match(/^[0-9]{0}$/)) {
                form_close.hide();
            }else{
                form_close.show();
            }
    
            if ($(this).val().match(/^[0-9]{2}$/) || $(this).val().match(/^[2-9]{1}$/)) {
                birth_mday.focus();
            }

            birth_month.focusout(function(e) {
                const value = $(this).val();
                if(value != 0){
                    if(numDigits(value)==1){
                        $(this).val( ('00' + value).slice( -2) );
                    }
                }
            });
        });
    
        birth_month.on('change blur', function(){
            this.value = this.value.replace(/[^0-9]+/i,'');
        });
        birth_month.on('keyup', function(e){
            if(e.keyCode !== 13) return;
            this.value = this.value.replace(/[^0-9]+/i,'');
        });

        birth_mday.on('change keyup', function(e){
            if(e.keyCode === 9 || e.keyCode === 16) return;
    
            if (birth_year.val().match(/^[0-9]{0}$/) && birth_month.val().match(/^[0-9]{0}$/) && birth_mday.val().match(/^[0-9]{0}$/)) {
                form_close.hide();
            }else{
                form_close.show();
            }
    
            birth_mday.focusout(function(e) {
                const value = $(this).val();
                if(value != 0){
                    if(numDigits(value)==1){
                        $(this).val( ('00' + value).slice( -2) );
                    }
                }
            });
        });
    
        birth_mday.on('change blur', function(){
            this.value = this.value.replace(/[^0-9]+/i,'');
        });
        birth_mday.on('keyup', function(e){
            if(e.keyCode !== 13) return;
            this.value = this.value.replace(/[^0-9]+/i,'');
        });
    }
	function numDigits(num){
		return num.toString().length;
	}

    const registNameEvent = (name, form_close) => 
    {
        name.on('change keyup', function(e){

            // 9:Tab 16:Shift
            if(e.keyCode === 9 || e.keyCode === 16) return;
    
            if (name.val().match(/^[0-9]{0}$/)) {
                form_close.hide();
            }else{
                form_close.show();
            }
        });
    }

    registBirthEvent(
        $('input[name=birth_year_other]'),
        $('input[name=birth_mon_other]'),
        $('input[name=birth_mday_other]'),
        $('#birth_form_close_other')
    );
    
    registBirthEvent(
        $('input[name=birth_year_self]'),
        $('input[name=birth_mon_self]'),
        $('input[name=birth_mday_self]'),
        $('#birth_form_close_self')
    );
    registNameEvent(
        $('input[name=name_other]'),
        $('#name_form_close_other')
    );
    registNameEvent(
        $('input[name=name_self]'),
        $('#name_form_close_self')
    );
    
});

/*生年月日入力フォームリセット*/
function reset_calenderForm( t ) {
    $('#birth_year_' +t).val("");
    $('#birth_mon_' +t).val("");
    $('#birth_mday_' +t).val("");
    $('#birth_form_close_' +t).hide();
    document.querySelector('#birth_year_' +t).focus();
}

/*名前入力フォームリセット*/
function reset_nameForm( t ) {
    $('#name_' +t).val("");
    $('#name_form_close_' +t).hide();
    document.querySelector('#name_' +t).focus();
    $('#name_' +t).next('.count_num').html("0/8文字");
}

/*
 *------------------------------------------------------------------------------
 * checkParams ( obj, useFlash )
 *	------------------------------------------------------------------------
 *	Information:	入力値をチェック
 *	Argument:	btn     : 押下されたボタンオブジェクト.
 *	Return:		Success: true, Failure: false
 *------------------------------------------------------------------------------
 */
function checkParams ( btn )
{
	var frm = $(btn).parents('form');
	var msg = "";
	
	
	// 初期設定
	$('[id^="err_"]').css({'opacity':0}).html("").hide();
	
	if( $('#name_other')[0] )			msg += checkTextName( frm, '#name_other' );
	if( $('#birth_year_other')[0] )		msg += checkText( frm, '#birth_year_other' );
	if( $('#sex_other')[0] )			msg += checkSelect( frm, '#sex_other' );
	
	if( $('#name_self')[0] )			msg += checkTextName( frm, '#name_self' );
	if( $('#birth_year_self')[0] )		msg += checkText( frm, '#birth_year_self' );
	if( $('#sex_self')[0] )				msg += checkSelect( frm, '#sex_self' );
	
	// 後処理
	if( msg == "" ) {
		return true;
	} 
	else {
		$('[id^="err_"]').css({'opacity':1}).show();
		console.log( msg );
		return false;
	}

}

/*
 *------------------------------------------------------------------------------
 * checkTextName ( frm, elem )
 *	------------------------------------------------------------------------
 *	Information:	テキストボックスが入力内容をチェックする.
 *	Argument:	elem     : 要素オブジェクト
 *	Return:		msg      警告メッセージ.
 *------------------------------------------------------------------------------
 */
function checkTextName( frm, elem ) {
	if ( ! elem )
		return '';
	if( $(elem).attr('type') != 'text' && $(elem).attr('type') != 'tel' ) return '';
	var err_txt = '';
	var t = $(elem).attr('name').indexOf('_other') !== -1 ?'相手' :'あなた';
	var k = $(elem).attr('name').replace('_other', '').replace('_self', '');
	var p = $(elem).attr('name').indexOf('_other') !== -1 ?'_other' :'';
	var es = '#err_' +elem.substring( 1 );
	
	// 未入力
	if( $(elem).val().length != 0 ) {
		if( ! checkParamOdoriji( 2, $(elem).val() ) ) {
			err_txt += ( t +'の' +arrParamName[k] +"の繰り返し文字の用法が正しくありません。\n" );
			$(es).html('繰り返し文字の用法が正しくありません');
		}
		if( ! checkSeimei( $(elem).val() ) ) {
			err_txt += ( t +'の' +arrParamName[k] +"に占断できない文字が入力されています。\n" );
			$(es).html('入力された文字は使用できません');
		}
		if( $(elem).data('length') !== 'undefined' ) {
			// data-length にて指定した長さ以内かチェック
			if( $(elem).val().length > $(elem).data('length') ) {
				err_txt += ( t +'の' +arrParamName[k] +'は' +$(elem).data('length') +"文字以内で入力してください。\n" );
				$(es).html($(elem).data('length') +'文字以内で入力してください');
			}
		}
	}
	return err_txt;
}

/*
 *------------------------------------------------------------------------------
 * checkTextNum ( frm, elem )
 *	------------------------------------------------------------------------
 *	Information:	テキストボックスが未入力かをチェックする.
 *	Argument:	elem     : 要素オブジェクト
 *	Return:		msg      警告メッセージ.
 *------------------------------------------------------------------------------
 */
function checkTextNum( frm, elem ) {
	if ( ! elem )
		return '';
	if( $(elem).attr('type') != 'text' && $(elem).attr('type') != 'tel' ) return '';
	var err_txt = '';
	var t = $(elem).attr('name').indexOf('_other') !== -1 ?'相手' :'あなた';
	var k = $(elem).attr('name').replace('_other', '').replace('_self', '');
	var p = $(elem).attr('name').indexOf('_other') !== -1 ?'_other' :'';
	var es = '#err_' +elem.substring( 1 );
	
	// 未入力
	if( $(elem).val().length == 0 ) {
		err_txt += ( t +"の" +arrParamName[k] +"が未入力です。\n" );
		$(es).html('入力してください');
	}
	return err_txt;
}
/*
 *------------------------------------------------------------------------------
 * checkText ( frm, elem )
 *	------------------------------------------------------------------------
 *	Information:	テキストボックスを入力チェックする.
 *	Argument:	elem     : 要素オブジェクト
 *	Return:		msg      警告メッセージ.
 *------------------------------------------------------------------------------
 */
function checkText( frm, elem ) {
	if ( ! elem )
		return '';
	if( $(elem).attr('type') != 'text' && $(elem).attr('type') != 'tel' ) return '';

	var err_txt = '';
	var t = $(elem).attr('name').indexOf('_other') !== -1 ?'相手' :'あなた';
	var k = $(elem).attr('name').replace('_other', '').replace('_self', '');
	var p = $(elem).attr('name').indexOf('_other') !== -1 ?'_other' :'_self';
	var es = '#err_' +elem.substring( 1 );
	
	// 未入力
	if( $(elem).val().length == 0 ) {
		err_txt += ( t +"の" +arrParamName[k] +"が未入力です。\n" );
		$(es).html('入力してください');
	}
	
	else {
	
		if( /\s+/.test($(elem).val()) ) {
			err_txt += ( t +'の' +arrParamName[k] +"に空白が入力されていますが使用できません。\n" );
			$(es).html('空白は使用できません');
		}
		
		// 長さ
		//if( chkEnd( $(elem).attr('name'), 'tel' ) ) {
		if( $(elem).attr('name').indexOf('tel') != -1 ) {
			if( $(elem).val().length != 4 ) {
				err_txt += ( t +'の' +arrParamName[k] +"は4桁を入力してください。\n" );
				$(es).html('半角4桁で入力してください');
			}
		} else if( $(elem).data('length') !== 'undefined' ) {
			// data-length にて指定した長さ以内かチェック
			if( $(elem).val().length > $(elem).data('length') ) {
				err_txt += ( t +'の' +arrParamName[k] +'は' +$(elem).data('length') +"文字以内で入力してください。\n" );
				$(es).html($(elem).data('length') +'文字以内で入力してください');
			}
		}
		
		// 生年月日
		//if( chkEnd( $(elem).attr('name'), 'birth_year' ) ) {
		if( $(elem).attr('name').indexOf('birth_year') != -1 ) {
			var y = $('#' +'birth_year' +p).val();
			var m = $('#' +'birth_mon' +p).val();
			var d = $('#' +'birth_mday' +p).val();
			
			if( ! checkDayExists( d, m, y ) ) {
				err_txt += ( t +"の生年月日に誤りがあります。\n" );
				$(es).html('入力内容に誤りがあります');
			}
			else if( ! checkParamBirthday( d, m, y ) ) {
				err_txt += ( t +"の生年月日が未来の日付になっています。\n" );
				$(es).html('未来の日付になっています');
			}
			else if( y < 1935 ) {
				err_txt += ( t +"の生年月日が1935より過去の日付になっています。\n" );
				$(es).html('1935年より過去は指定できません');
			}
		}
		
		// 携帯下四桁
		//else if( chkEnd( $(elem).attr('name'), 'tel' ) ) {
		else if( $(elem).attr('name').indexOf('tel') != -1 ) {
			if( ! $(elem).val().match( /^\d+$/ ) ) {
				err_txt += ( t +'の' +arrParamName[k] +"に半角数字以外の文字が入力されています。\n" );
				$(es).html('入力された文字は使用できません');
			}
		}
		// かな
		//else if( chkEnd( $(elem).attr('name'), 'kana' ) ) {
		else if( $(elem).attr('name').indexOf('kana') != -1 ) {
			if( $(elem).val().match( /[^ぁ-わを-ん]+/ ) ) {
				err_txt += ( t +'の' +arrParamName[k] +"にひらがな以外の文字が入力されています。\n" );
				$(es).html('ひらがなを入力してください');
			}
		}
		// 姓名
		// "1" 姓名繰り返し文字禁止
		// "2" 姓名繰り返しあり
		else {
			if( $(elem).data('type') !== 'undefined' && $(elem).data('type') == 2 ) {
				if( ! checkParamOdoriji( 2, $(elem).val() ) ) {
					err_txt += ( t +'の' +arrParamName[k] +"の繰り返し文字の用法が正しくありません。\n" );
					$(es).html('繰り返し文字の用法が正しくありません');
				}
			} else {
				if( ! checkParamOdoriji( 1, $(elem).val() ) ) {
					err_txt += ( t +'の' +arrParamName[k] +"に々などの繰り返し文字は使用できません。\n" );
					$(es).html('繰り返し文字の用法が正しくありません');
				}
			}
			if( ! checkSeimei( $(elem).val() ) ) {
				err_txt += ( t +'の' +arrParamName[k] +"に占断できない文字が入力されています。\n" );
				$(es).html('入力された文字は使用できません');
			}
		}
	
	}
	
	return err_txt;
}

/*
 *------------------------------------------------------------------------------
 * checkSelect ( frm, elem )
 *	------------------------------------------------------------------------
 *	Information:	セレクトボックスを入力チェックする.
 *	Argument:	elem     : 要素オブジェクト
 *	Return:		msg      警告メッセージ.
 *------------------------------------------------------------------------------
 */
function checkSelect( frm, elem ) {
	if ( ! elem )
		return '';
	
	// 生年月日テキスト対応
	//if( $(elem).attr('type') == 'tel' && chkEnd( elem, 'birth_year' ) ) return checkText( frm, elem );	
	if( $(elem).attr('type') == 'tel' && $(elem).attr('name').indexOf('birth_year') != -1  ) return checkText( frm, elem );	

	var err_txt = '';
	var t = $(elem).attr('name').indexOf('_other') !== -1 ?'相手' :'あなた';
	var k = $(elem).attr('name').replace('_other', '').replace('_self', '');
	var p = $(elem).attr('name').indexOf('_other') !== -1 ?'_other' :'';
	var es = '#err_' +elem.substring( 1 );
	
	// 生年月日
	//if( chkEnd( $(elem).attr('name'), 'birth_year' ) ) {
	if( $(elem).attr('name').indexOf('birth_year') != -1 ) {
		var y = $(frm).find('select[name="' +p +'birth_year"]').val();
		var m = $(frm).find('select[name="' +p +'birth_mon"]').val();
		var d = $(frm).find('select[name="' +p +'birth_mday"]').val();
		if( ! checkDayExists( d, m, y ) ) {
			err_txt += ( t +"の生年月日に誤りがあります。\n" );
			$(es).html('入力内容に誤りがあります');
		}
		else if( ! checkParamBirthday( d, m, y ) ) {
			err_txt += ( t +"の生年月日が未来の日付になっています。\n" );
			$(es).html('未来の日付になっています');
		}
	}
	// 出生時間
	//else if( chkEnd( $(elem).attr('name'), 'birth_hour' ) ) {
	else if( $(elem).attr('name').indexOf('birth_hour') != -1 ) {
		var h = $(frm).find('select[name="' +p +'birth_hour"]').val();
		var n = $(frm).find('select[name="' +p +'birth_min"]').val();
		if( h == '不明' && n != '不明' ){
			err_txt += ( t +"の出生時間を入力する際は「時間」は必須となります。\n" );
			$(es).html('時間を入力してください');
		}
	}
	// 性別、血液型、生まれ順、相手との関係、出会った時期
	//else if( chkEnd( $(elem).attr('name'), 'sex' )
	//	|| chkEnd( $(elem).attr('name'), 'blood_type' )
	//	|| chkEnd( $(elem).attr('name'), 'birth_order' )
	//	|| chkEnd( $(elem).attr('name'), 'sign' ) ) {
	else if( $(elem).attr('name').indexOf('sex') != -1
		|| $(elem).attr('name').indexOf('blood_type') != -1
		|| $(elem).attr('name').indexOf('birth_order') != -1
		|| $(elem).attr('name').indexOf('sign') != -1 ) {
		if( $(elem).val() == '' ){
			err_txt += ( t +'の' +arrParamName[k] +"を選択してください。\n" );
			$(es).html('選択してください');
		}
	} else if( chkEnd( $(elem).attr('name'), 'relationship' )
		|| chkEnd( $(elem).attr('name'), 'when_I_met' ) ) {
		if( $(elem).val() == '' ){
			err_txt += ( arrParamName[k] +"を選択してください。\n" );
			$(es).html('選択してください');
		}
	}
	
	return err_txt;
}
function chkEnd( str, pat ) {
	return ( str.lastIndexOf(pat) +pat.length === str.length ) && ( pat.length <= str.length );
}

/*
 *------------------------------------------------------------------------------
 * focusParamsTarget ( elem, msg )
 *	------------------------------------------------------------------------
 *	Information:	警告ダイアログ表示し、入力フィールドにフォーカスする.
 *	Argument:	elem     : 要素オブジェクト
 *				msg      警告メッセージ.:
 *	Return:		Success: true, Failure: false
 *------------------------------------------------------------------------------
 */
function focusParamsTarget ( elem, msg ) {
	if ( ! elem )
		return false;

	if ( msg && msg != '' )
		alert ( msg );
	// 警告のある入力フィールドにフォーカスする.
	$(elem).focus();
	scrollBy( 0, -100 );

	return false;
}

/*
 *------------------------------------------------------------------------------
 * setArrSeimei()
 *	------------------------------------------------------------------------
 *	Information:	辞書jsonを読み込む.
 *	Argument:	
 *	Return:		void
 *------------------------------------------------------------------------------
 */
function setArrSeimei() {
	$.ajax({
	    type: "GET",
	    url: "/cp_v/oshi-aisho_v/js/data/input_common.json",
	    dataType: "json", 
	    async: false
	}).then(
	    function (json) {
	        // 読み込み成功時の処理
	        character = json[0]["char"];
	        
	    },
	    function (jqXHR, textStatus, errorThrown) {
	        // 読み込み失敗時の処理
	        character = [];
	        console.log("読み込みに失敗しました");
	        console.log("jqXHR : " + jqXHR.status);
	        console.log("textStatus : " + textStatus);
	        console.log("errorThrown : " + errorThrown.message);
	    }
	);
}

/*
 *------------------------------------------------------------------------------
 * checkSeimei( val )
 *	------------------------------------------------------------------------
 *	Information:	非対応文字の入力チェック.
 *	Argument:	val  : 対象文字列
 *	Return:		Success: true, Failure: false
 *------------------------------------------------------------------------------
 */
function checkSeimei( val ) {
	for( i = 0; i < val.length; i++ ){
		var chkflg = false;
		var ch = val.substring(i, i+1);
		for( j = 0; j < character.length; j++ ){
			if( ch == character[j] ){
				chkflg = true;
				break;
			}
		}
		if( chkflg == false ){
			return false;
		}
	}
	return true;
}

/*
 *------------------------------------------------------------------------------
 * checkParamOdoriji ( val )
 *	------------------------------------------------------------------------
 *	Information:	踊り字チェック関数.
 *				用法が正しくない場合はfalseを返す
 *	Argument:	pattern: 1. 繰り返しなし　2. 繰り返しあり
 *				val  : 対象文字列
 *	Return:		Success: true, Failure: false
 *------------------------------------------------------------------------------
 */
function checkParamOdoriji ( pattern, val ) {
	if ( !val || val == '' )
		return false;

	var odoriji = "々〃ヽヾゝゞ";
	var ret = true;
	
	if( pattern == 2 ) {
		// 1.先頭に踊り字が来る場合
		// 2.踊り字が連続する場合
		var before = false;
		
		for (i = 0; i < val.length; i++) {
			oflag = odoriji.indexOf( val.substr( i, 1 ) ) != -1;
			if( oflag && ( i == 0 || before ) )
				ret = false;
			before = oflag;
		}
	} else {
		for (i = 0; i < val.length; i++) {
			if( odoriji.indexOf( val.substr( i, 1 ) ) != -1 )
				ret = false;
		}
	}
	
	return ret;
}

/*
 *------------------------------------------------------------------------------
 * checkDayExists ( mday, mon, year )
 *	------------------------------------------------------------------------
 *	Information:	日付の存在チェック.
 *	Argument	mday : 日 (1-31)
 *				mon  : 月 (1-12)
 *				year : 年 (year_default-2nnn)
 *	Return:		Success: true, Failure: false
 *------------------------------------------------------------------------------
 */
function checkDayExists( mday, mon, year ) {
	if ( ( ! year || ! mon || ! mday )
	  || ( year == 0 || year == '' ) 
	  || ( mon  == 0 || mon  == '' ) 
	  || ( mday == 0 || mday == '' ) 
	)
		return false;

	// 引数を数値に変換.
	year = new Number( year );
	mon  = new Number( mon );
	mday = new Number( mday );

	// 引数チェック.
	if ( ( ! mday || mday && ( mday < 1 || mday > 31 ) )
	  || ( ! mon  || mon  && ( mon  < 1 || mon  > 12 ) )
	  || ( ! year || year && ( year < 1900 ) )
	)
		return false;

	// 晦日配列初期化 (1月～12月)
	var mday_lasts	= new Array ( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );

	// 閏年チェック.
	if ( mon == 2 )
		if ( ( ( year % 4 == 0 ) && ( year % 100 != 0 ) ) || ( year % 400 == 0 ) )
			mday_lasts[( mon - 1 )]++;

	if ( mday_lasts[( mon - 1 )] < mday )
		return false;

	return true;
}

/*
 *------------------------------------------------------------------------------
 * checkParamBirthday ( mday, mon, year )
 *      ------------------------------------------------------------------------
 *      Information:    年月日入力フォーム値チェック.
 *                      入力/選択した値の日付が未来の日付になっていないかチェックする.
 *      Argument:       mday : 日
 *                      mon  : 月
 *                      year : 年
 *      Return:         Success: true, Failure: false
 *------------------------------------------------------------------------------
 */
function checkParamBirthday( mday, mon, year ) {
	var now = new Date();
	now.setHours(0);
	now.setMinutes(0);
	now.setSeconds(0);
	now.setMilliseconds(0);
	var chkday = new Date( year, mon -1, mday );

	if( now.getTime() < chkday.getTime() ){
		return false;
	}

	return true;
}

