<?php

/**
 * 特集ごとのコントローラー
 * 
 *  [%oshi%]/controller.php			簡単なサイトの場合はBLはここに書いてしまおう
 *              └ logic.php			占断ロジック関連
 *              └ index_data.php		indexページの情報＆処理
 *              └ data/[%menu_id%].php	メニュー単位の情報
 */
if ( is_readable( $self->get('event') .'/this_function.php' ) ) {
	require_once( $self->get('event') .'/this_function.php' );
}

// 公開日付
if( !$self->get('release_date') ) {
	$now_date = date('Ymd') >= 20240418 ?date('Ymd') :'20240418';
	$self->set('release_date', $now_date);
}

// 変数セット
$SmartyObj->assign( 'preview',			$preview );
$SmartyObj->assign( 'charset',			$tmp_char );
$SmartyObj->assign( 'release_date',		$self->get('release_date') );

if( $self->get('isp') == 11 ) {
	if( $real_flag ) {
		$SmartyObj->assign( 'uri_path',			'/cp_v/mynumber-one_v' );
		$SmartyObj->assign( 'img_path',			'/cp_v/mynumber-one_v' );
	} else {
		$SmartyObj->assign( 'uri_path',			'/cp_v/mynumber-one_v' );
		$SmartyObj->assign( 'img_path',			'/cp_v/mynumber-one_v' );
	}
	$SmartyObj->assign( 'special_title',	'琉球風水志シウマの占いマイナンバー' );
	$SmartyObj->assign( 'meta_keywords',	'シウマ,占いマイナンバー,数字,突然ですが占ってもいいですか？,無料占い' );
	$SmartyObj->assign( 'meta_description',	'【無料で占えます】あなたの意外な正体がわかる?!　TV番組『突然ですが占ってもいいですか？』で注目！“シウマの占いマイナンバー”であなたのことをとことん深堀り！　恋愛傾向・対人運・才能・あなたにとってのキーパーソンなど、占いマイナンバーから見える「あなたの運や傾向」を徹底鑑定！' );
	$SmartyObj->assign( 'sns_description',	'【無料で占えます】あなたの意外な正体がわかる?!　TV番組『突然ですが占ってもいいですか？』で注目！“シウマの占いマイナンバー”であなたのことをとことん深堀り！　恋愛傾向・対人運・才能・あなたにとってのキーパーソンなど、占いマイナンバーから見える「あなたの運や傾向」を徹底鑑定！' );
	$SmartyObj->assign( 'special_period',	'シウマの占いマイナンバー_special_period' );
}


// $cdn_flag = true;
$cdn_flag = false; //★開発用

if( $cdn_flag && ( $self->get('isp') == 11 ) ) {
	// $img_path = 'https://lw6nr4oyej.user-space.cdn.idcfcloud.net/cp_v/oshi';
	$img_path = '/cp_v/mynumber-one_v';
	$SmartyObj->assign( 'img_path',			$img_path );
}

// テンプレートパス作成
$page = $self->get('t');
$self->set( 'page', $page );

// リコメンド情報。
if ( is_readable( $self->get('event') .'/index_data.php' ) ) {
	include( $self->get('event') .'/index_data.php' );
}

/**
 * 【index】
 */
if( strpos( $self->get('t'), 'index' ) !== false ) {
	// indexページフラグ
	$index_flag = strpos( $self->get('t'), 'index' ) !== false;
	$SmartyObj->assign( 'index_flag', $index_flag );
}

/**
 * 【input / result】
 */
else if ( is_readable( $self->get('event') .'/data/' .$self->get('menu_id') .'.php' ) ) {

	// 入力値
	$user_keys	= array( 'name', 'birth_year', 'birth_mon', 'birth_mday');
	$self->init( $user_keys );

	// 名前対応
	if( $self->get('name_self') == '' ) {
		$self->set('name2_self', 'あなた' );
	} else {
		$ns = $self->get('name_self');
		$ns = str_replace( "&amp;",  "&", $ns );
		$self->set('name2_self', $ns .'さん' );
	}
	if( $self->get('name_other') == '' ) {
		$self->set('name2_other', 'あの人' );
	} else {
		$no = $self->get('name_other');
		$no = str_replace( "&amp;",  "&", $no );
		$self->set('name2_other', $no .'さん' );
	}
	$SmartyObj->assign( 'name2_self',  $self->get('name2_self') );
	$SmartyObj->assign( 'name2_other', $self->get('name2_other') );

	// 【メニュー情報設定】
	include( $self->get('event') .'/data/' .$self->get('menu_id') .'.php' );
	
	if( !$self->get('contents') && $menuData['contents'] ) {
		$self->set('contents', $menuData['contents']);
	}
	if( $menuData['person'] == 1 ) {
		unset( $target[1] );
	}

	// $_REQUEST[ 'now' ]が空の場合、現在日時を取得
	if ( !isset($_REQUEST[ 'now' ]) ) {
		$now = date("Ymd");
	} else {
		$now = str_replace( "-", "", nvl($_REQUEST[ 'now' ]) );
		if( !$now || !is_numeric ( $now ) || strlen( $now ) != 8 ) {
			$now = date("Ymd");
		}
	}
	
	$self->set( 'now',       $now );
	$self->set( 'year_now',  substr($now, 0, 4) );
	$self->set( 'month_now', substr($now, 4, 2) );
	$self->set( 'mday_now',  substr($now, 6, 2) );
	$SmartyObj->assign( 'now',       $now );
	$SmartyObj->assign( 'year_now',  substr($now, 0, 4) );
	$SmartyObj->assign( 'month_now', substr($now, 4, 2) );
	$SmartyObj->assign( 'mday_now',  substr($now, 6, 2) );

	// 完全無料結果フラグ
	$allfree_flag = $menuData['contents'] == 'free' || $self->get('contents') == 'free';
	// 結果ページフラグ
	$result_flag = strpos( $self->get('t'), 'result' ) !== false;

	$SmartyObj->assign( 'free_flag', $allfree_flag );
	$SmartyObj->assign( 'result_flag', $result_flag );
	
	// メニュー情報をテンプレートにセット
	$min_title = array();
	foreach( $menuData as $key => $val ) {
		if ( $key == 'title' ) { $SmartyObj->assign( 'menu_title', $val );}
		if ( $key == 'menu_id' ) { $SmartyObj->assign( 'menu_id', $val );}
		if ( $key == 'category_name' ) { $SmartyObj->assign( 'category_name', $val );}
		if ( $key == 'price' ) { $SmartyObj->assign( 'menu_price', $val );}
		if( strpos( $key, 'min_title' ) !== false  ) {
			$arr_mt = explode( "_", $key );
			$min_title[ $arr_mt[0] ] = $val;
		} else if( $key == 'price' ) {
			if( $self->get('isp') == 10 || $self->get('isp') == 11 ) {
				$SmartyObj->assign( 'menu_' .$key, number_format( $val *1.1 ) .'円（税込）' );
			} else
				$SmartyObj->assign( 'menu_' .$key, $val );
		} else {
			$SmartyObj->assign( 'menu_' .$key, $val );
		}
	}

	$SmartyObj->assign( 'menu_min_title', $min_title );

	// 結果ページ
	// ロジック情報
	if( $result_flag ) {
		require_once 'logic.php';
		// 入力チェック
		checkInputParam();
		
		$logic_cd = get_SougenUnion004();
		$SmartyObj->assign( 'base_id_self', $logic_cd['a1'] );
		
		// 【完全無料メニュー】
		if( $allfree_flag ) {
			
			$result_menu = [];
			$result_text = $text;
			for( $i = 0; $i < count( $result_text ); $i++ ) {
				$result_menu[ $i +1 ] = $result_text[$i][ $logic_cd[ $logic[$i] ] ];
			}
			
			$SmartyObj->assign('result_menu', $result_menu);
			
		}

		// 【通常メニュー】結果ページ
		else {
			
			$result_menu = [];
			$result_text = $text;
			for( $i = 0; $i < count( $result_text ); $i++ ) {
				$result_menu[ $i +1 ] = $result_text[$i][ $logic_cd[ $logic[$i] ] ];
			}
			
			$SmartyObj->assign('result_menu', $result_menu);
			
		}
		
		
		
		if( isset( $next ) ) {
			
			$next_list = array();
			
			foreach( $next as $next_id ) {
				
				$next_data =  new menuInfo( $next_id, 'next' );
				$next_menuData = $next_data->get('menuData');
				// Next メニュー情報
				$data = array( 'menu_id' => $menu_id );
				$min_title = array();
				foreach( $next_menuData as $key => $val ) {
					if( strpos( $key, 'min_title' ) !== false  ) {
						$arr_mt = explode( "_", $key );
						$min_title[ $arr_mt[0] ] = $val;
					} else if( $key == 'price' ) {
						if( $self->get('isp') == 10 || $self->get('isp') == 11 ) {
							$data[$key] = number_format( $val *1.1 ) .'円（税込）';
						} else
							$data[$key] = $val;
					} else {
						$data[$key] = $val;
					}
				}
				$data['menu_min_title'] = $min_title;
				// Next 結果テキスト
				$next_free = $next_data->get('free');
				$next_logic = $next_data->get('logic');
				$result_menu2 = [];
				for( $i = 0; $i < count( $next_free ); $i++ ) {
					$result_menu2[ $i +1 ] = $next_free[$i][ $logic_cd[ $next_logic[$i] ] ];
				}
				$data['result_menu'] = $result_menu2;
				
				$next_list[] = $data;
				
			}
			
			/*echo '<pre>';
			var_dump($next_list);
			echo '</pre>';
			exit();
			*/
			$SmartyObj->assign( 'next_list', $next_list );
			
		}
		
	}
}

?>
