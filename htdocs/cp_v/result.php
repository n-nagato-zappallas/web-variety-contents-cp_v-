<?php
/**
 * 楽天、Nifty、本格館用の結果表示用
 *
 * 開発環境
 *   http://web-dev.ura.pga.jp:8080/yspecial/result.php
 * 本番環境
 *   https://web-portal-api.zappallas.com/yspecial/result.php
 */
require_once 'function.php';


/**/
// 入力情報保持クラス
$self = new selfInfo;

$db = 'userinfo_' .$self->get('isp');

// 楽天用処理
if( $self->get('isp') == 10 ) {

	foreach( array( 'sid', 'statusId', 'openId' ) as $key )
		if( $_REQUEST[ $key ] )
			$self->set( $key, $_REQUEST[ $key ] );


	$sql = "SELECT ticket_id, site_id, isp_id, isp_sid FROM userinfo.user_ticket_table WHERE ticket_id = ? ";
	$res = select( $sql, array( $self->get('sid') ) );
	$status = $res[0] && $res[0]['isp_sid'] ?2 :1;

	if( $status == 1 ) {
		edit( "UPDATE userinfo.user_ticket_table SET isp_sid = ? WHERE ticket_id = ? ", array( $self->get('sid'), $self->get('sid') ) );
	}
	$user_id = $self->get( 'openId' ) ?base64_decode( $self->get( 'openId' ) ) :'unknown';
	edit( "UPDATE " .$db .".user_info_settlement_tbl SET user_id = ?, settlement_status = 2 WHERE sid = ? ", array( $user_id, $self->get('sid') ) );


	// check_isp_status //
	$uri = sprintf ( "%saction=%s&openId=%s&statusId=%s&cardId=%s&serviceId=%s&accessKey=%s",
		"https://manager.checkout.gl.rakuten.co.jp/mgrc/papi/confirm/1.0/",
		'OPENSTATUS',
		$self->get( 'openId' ),
		$self->get( 'statusId' ),
		$self->get( 'sid' ),
		'1000001079',
		'ec72af878c4a1f8112d3'
	);
	$res = file_get_contents( $uri );
	$xml = simplexml_load_string( $res );
	$xml_status = $xml->status;
	$xml_cartId = $xml->carts->cart->cartId;
	$xml_itemId = $xml->carts->cart->itemsInfo->item->itemId;
	if( $xml_status != 0 || strlen( $xml_cartId ) == 0 || strlen( $xml_itemId ) == 0 )
		return;

}

// Nifty用処理
else if( $self->get('isp') == 40 ) {

	foreach( array( 'sid', 'nif_menukey' ) as $key )
		if( $_REQUEST[ $key ] )
			$self->set( $key, $_REQUEST[ $key ] );
	
	if( is_smartphone() ) {
		$device_mode = "sp";
	}
	header( 'X-NIFTY-Billing: OK\n' );
}


// load_session
$sql = "SELECT file_data FROM " .$db .".user_ticket_table" .( $device_mode =="sp" ?'_sp' :'' ) ." WHERE ticket_id = ? ";
$res = select( $sql, array($self->get('sid')) );

echo $res[0]["file_data"];

?>
