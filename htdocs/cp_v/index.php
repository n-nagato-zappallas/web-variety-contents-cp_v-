<?php
/**
 * 開発環境
 * http://web-fortune51-dev.ura.pga.jp/cp_v/oshi-aisho_v/
 * 本番環境
 * https://honkaku-uranai.jp/cp_v/oshi-aisho_v/
 */

require_once 'function.php';
// 入力情報保持クラス
$self = new selfInfo;
$menu_id = $self->get('menu_id');

// プレビューモード
$preview = $self->get('preview') == 'on';

if (strpos($_SERVER["HTTP_HOST"], 'web-dev') !== false && strpos($self->get('t'), 'result') !== false && strpos($self->get('t'), 'question') !== false) {
    $preview = true;
}

// Template初期化
$SmartyObj =  new SmartyCommon( $self->get('event') ."/" );

// ########## Smarty関数 ##########
$first_uri = explode( '/', $_SERVER['REQUEST_URI'] );
$project_path = $first_uri[1] .'/'. $self->get('event') ."/";
$tmp_char = 'UTF-8';


define('SMARTY_RESOURCE_CHAR_SET', $tmp_char);
define('SMARTY_TEMPLATE_DIR', '/srv/www/php/templates/');
define('SMARTY_TEMPLATE_C_DIR', '/srv/www/php/templates_c/');
require_once(SMARTY_DIR .'Smarty.class.php');
if (is_callable('mb_internal_encoding')) {
	mb_internal_encoding(SMARTY_RESOURCE_CHAR_SET);
}

//変数定義
$SmartyObj->template_dir = SMARTY_TEMPLATE_DIR . $project_path;
$SmartyObj->compile_dir = SMARTY_TEMPLATE_C_DIR . $project_path;
$SmartyObj->plugins_dir = SMARTY_DIR . 'plugins/';
$SmartyObj->caching = false;


// コントローラ起動
if ( is_readable( $self->get('event') .'/' .'controller.php' ) ) {
	include( $self->get('event') .'/' .'controller.php' );
}

// 入力情報を画面セット
$selfData = $self->getData();

foreach( $selfData as $key => $val ) {
	$SmartyObj->assign( $key, $val );

}

if( strlen( $msg ) > 0 ) {
	$SmartyObj->assign( 'msg', $msg );
	$yahoo_charge_status = '-1';
	if( $device_mode == "sp" ) {
		$self->set('page', 'error_sp');
	} else {
		$self->set('page', 'error');
	}
	$SmartyObj->assign( 'error_msg', 'エラーが発生しました。<br>しばらく時間をおいて再度お試しください。' );
}

//結果を出力
if( $self->get('isp') == 70 ) {
	header( 'YAHOO-CHARGE: ' .$yahoo_charge_status .'\n' );
} else if( $self->get('isp') == 40 ) {
	header( 'X-NIFTY-Billing: OK\n' );
} else {
	header( 'YAHOO-CHARGE: ' .$yahoo_charge_status .'\n' );
}

$SmartyObj->display( $self->get('page') .'.tpl' );


?>

