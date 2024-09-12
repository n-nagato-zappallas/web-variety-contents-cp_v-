<!---

/*
 *------------------------------------------------------------------------------
 *
 *	Copyright:(C) cocoloni all rights reserved.
 *	fw7.0を元に、不要な関数を削除
 *
 *	Function reference:
 *	checkNavigator		( void )
 *	styleNavigator		( srcRootDir )
 *	getMenuNameByFile	( void )
 *	getMenuNameByQuery	( name )
 *	targetPage		( href, target)
 *	getOsName	( void )
 *	getBrowserName	( void )
 *
 *------------------------------------------------------------------------------
 */


// Global variables.
/*
 *  接続クライアントブラウザ情報.
 */
var osName	= navigator.platform;		// OS名取得.
var appCode	= navigator.appCodeName;	// ブラウザタイプ取得.
var appName	= navigator.appName;		// ブラウザ名取得.
var appVer	= navigator.appVersion;		// ブラウザバージョン取得.
var appAgent	= navigator.userAgent;		// ブラウザエージェント情報.
var appVersion	= null;				// ブラウザバージョン番号.


$(function(){
	
	/* class="swapImage"  */
	if( ! getSpFlag() ) {
		$('.swapImage').each(function(i) {
			var src = $(this).attr('src').replace("\.gif", "_over\.gif").replace("\.png", "_over\.png").replace("\.jpg", "_over\.jpg");
			$(this).wrap('<p style="background-image: url(' +src +'); display: inline-block;"></p>');
		});
	    $(document).on('mouseenter','.swapImage',function(){
	    	$(this).animate({'opacity':'0'}, 300);
	    });
	    $(document).on('mouseleave','.swapImage',function(){
	    	$(this).animate({'opacity':'1'}, 100);
	    });
    }

});

/*
 *------------------------------------------------------------------------------
 * checkNavigator ( void )
 *	------------------------------------------------------------------------
 *	Information:	ブラウザ対応チェック.
 *			* Win32 IE 6.0 以上 FireFox 2.0 以上 Safari 3以上 対応.
 *			* MacOS FireFox 2.0 以上 Safari 2以上 対応.
 *	Argument:	void
 *	Return:		対応可: true, 対応不可: false
 *------------------------------------------------------------------------------
 */

function checkNavigator ( )
{
	// facebook対応
	if( appAgent.indexOf( "FBAN" ) != -1 ) {
		return true;
	}

	var os	= getOsName ();

	var data = getBrowserName();
	var browserName = data[0];
	var appVer = data[1];

	//2016/08/17 iPhone WebView対応
	if ( os == "iPhone" && browserName == "Other" && !appVer) {
		//UAからAppleWebKitのバージョンを取得する
		s	= appAgent.toUpperCase( ).indexOf ( 'APPLEWEBKIT', 0 ) + 12 ;
		e	= appAgent.indexOf ( " ", s );
		appVer	= appAgent.substring ( s, e ) ;		//ブラウザバージョン情報の取得
		appVer = eval ( appVer.replace(/^([0-9]+)(\.[0-9]+)?.*/g, "$1$2") );
		if ( appVer >= 522.0 ){
			return true;
		}
	}

	//check OS Browser
	if ( os == "Win" && (browserName == "MSIE" || browserName == "RV"  ) && appVer >= 6.0 ){
		return true;
    }else if ( browserName == "FIREFOX" && appVer >= 2.0 ){
		return true;
	}else if ( browserName == "SAFARI" && appVer >= 522.0 ){
		return true;
	}else{
		return false;
	}
	return false;
}

/*
 *------------------------------------------------------------------------------
 * targetPage ( href, target)
 *	------------------------------------------------------------------------
 *	Information:	開いた別ウィンドウを最前面に表示する.
 *	Argument:	href		: 別ウィンドウ表示先URL.
 *				target	: 別ウィンドウターゲット先.
 *	Return:		Success: true, Failure: false
 *------------------------------------------------------------------------------
 */
function targetPage( obj ) 
{
	var href		= obj.href;
	var target		= obj.target;

	window.open( href, target ).focus();
	return false;
}

/*
 *------------------------------------------------------------------------------
 * getOsName ( void )
 *	------------------------------------------------------------------------
 *	Information:	OS名を取得してReturn.
 *	Argument:	void
 *	Return:		os：OS名
 *------------------------------------------------------------------------------
 */

function getOsName ( )
{
	var os	= null;

	if ( osName.toUpperCase( ).indexOf ( "WIN" ) >= 0 && osName.indexOf ( "3.1" ) <= 0 ){
		os	= "Win";
	}else if ( osName.toUpperCase( ).indexOf ( "MAC" ) >= 0 ){
		if ( osName.toUpperCase( ).indexOf ( "PC" ) >= 0 || osName.toUpperCase( ).indexOf ( "INTEL" ) >= 0 ){
		os	= "Mac";
		}
	}else if ( osName.indexOf( "iPhone" ) >= 0 || osName.indexOf( "iPad" ) >= 0){
        os = "iPhone";
    }else{
		os	= "Other";
	}

	return os;

}

/*
 *------------------------------------------------------------------------------
 * getBrowserName ( void )
 *	------------------------------------------------------------------------
 *	Information:	ブラウザ名とVer.を取得して配列でReturn.
 *	Argument:	void
 *	Return:		arr[0]：ブラウザ名	arr[1]：Ver.
 *------------------------------------------------------------------------------
 */

function getBrowserName ( )
{

	var browserName;		//ブラウザ名の取得
	var s, e ;	//検索位置取得
	var appVer;				//ブラウザバージョン取得

	if ( appAgent.toUpperCase( ).indexOf ( "OPERA" ) >= 0 ){
		browserName	= 'Other';
	}else if ( appAgent.toUpperCase( ).indexOf ( "SAFARI" ) >= 0 ){
		browserName	= 'APPLEWEBKIT';
		s	= appAgent.toUpperCase( ).indexOf ( browserName, 0 ) + browserName.length +1 ;
		e	= appAgent.indexOf ( " ", s );
		browserName	= 'SAFARI';
	}else if ( appAgent.toUpperCase( ).indexOf ( "FIREFOX" ) >= 0 ){
		browserName	= 'FIREFOX';
		s	= appAgent.toUpperCase( ).indexOf ( browserName, 0 ) + browserName.length +1 ;
		e	= appAgent.length ;
	}else if ( appAgent.toUpperCase( ).indexOf ( "MSIE" ) >= 0 ){
		browserName	= 'MSIE';
		s	= appAgent.toUpperCase( ).indexOf ( browserName, 0 ) + browserName.length +1 ;
		e	= appAgent.indexOf ( ";", s );
    }else if ( appAgent.toUpperCase( ).indexOf ( "TRIDENT" ) >= 0 ){
		browserName	= 'RV';
		s	= appAgent.toUpperCase( ).indexOf ( browserName, 0 ) + browserName.length +1 ;
        e	= appAgent.indexOf ( ")", s );
	}else{
		browserName	= 'Other';
	}

	//BrowserVer
	if ( browserName != "Other" ){
		appVer	= appAgent.substring ( s, e ) ;		//ブラウザバージョン情報の取得
		appVer = eval ( appVer.replace(/^([0-9]+)(\.[0-9]+)?.*/g, "$1$2") );
	}

	return [browserName,appVer];

}

/*------------------------------------------------------------------------------
 * getSpFlag ( void )
 *	------------------------------------------------------------------------
 *	Information:	ユーザがPCかSPか判別.
 *	Argument:	void
 *	Return:		boolean
 *------------------------------------------------------------------------------
 */
function getSpFlag() {
	let bool = ( appAgent.indexOf('iPhone') > 0 && appAgent.indexOf('iPad') == -1 ) 
			  || appAgent.indexOf('iPod') > 0 
			  || appAgent.indexOf('Android') > 0

	return bool;
}
/*------------------------------------------------------------------------------
 * setCSS ( href )
 *	------------------------------------------------------------------------
 *	Information:	HTMLにCSS行を追加.
 *	Argument:	href
 *	Return:		void
 *------------------------------------------------------------------------------
 */
function setCss( str ) {
	let css = document.createElement("link");
    css.setAttribute( "rel", "stylesheet" );
    css.setAttribute( "type", "text/css" );
    css.setAttribute( "href", str );
    document.getElementsByTagName("head")[0].appendChild(css);
    
    return 1;
}
/*------------------------------------------------------------------------------
 * setScript ( src )
 *	------------------------------------------------------------------------
 *	Information:	HTMLにscript行を追加.
 *	Argument:	src
 *	Return:		void
 *------------------------------------------------------------------------------
 */
function setScript( str ) {
    let script = document.createElement('script'); 
    script.src = str;
    script.type = "text/javascript";
    script.charset = "euc-jp";
    document.head.appendChild(script);
    
    return 1;
}

//--->
