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
		$SmartyObj->assign( 'uri_path',			'/cp_v/oshi-aisho_v' );
		$SmartyObj->assign( 'img_path',			'/cp_v/oshi-aisho_v' );
		$SmartyObj->assign( 'special_title',	'推しとあなたの相性診断' );
		$SmartyObj->assign( 'meta_keywords',	'推し,推し活,相性,相性占い,リアコ,無料占い' );
		$SmartyObj->assign( 'meta_description',	'【無料で占えます】推しを好きになったのは必然だった……!?　これは【推しとあなた】の真面目な相性診断◆お互いの持つ性質から2人の結びつき、前世～来世での繋がりまで2人の相性をとことん深掘りしてみませんか？' );
		$SmartyObj->assign( 'sns_description',	'【無料で占えます】推しを好きになったのは必然だった……!?　これは【推しとあなた】の真面目な相性診断◆お互いの持つ性質から2人の結びつき、前世～来世での繋がりまで2人の相性をとことん深掘りしてみませんか？' );
		$SmartyObj->assign( 'special_period',	'推しとあなたの相性診断_special_period' );
	} else {
		$SmartyObj->assign( 'uri_path',			'/cp_v/oshi-aisho_v' );
		$SmartyObj->assign( 'img_path',			'/cp_v/oshi-aisho_v' );
		$SmartyObj->assign( 'special_title',	'推しとあなたの相性診断' );
		$SmartyObj->assign( 'meta_keywords',	'推し,推し活,相性,相性占い,リアコ,無料占い' );
		$SmartyObj->assign( 'meta_description',	'【無料で占えます】推しを好きになったのは必然だった……!?　これは【推しとあなた】の真面目な相性診断◆お互いの持つ性質から2人の結びつき、前世～来世での繋がりまで2人の相性をとことん深掘りしてみませんか？' );
		$SmartyObj->assign( 'sns_description',	'【無料で占えます】推しを好きになったのは必然だった……!?　これは【推しとあなた】の真面目な相性診断◆お互いの持つ性質から2人の結びつき、前世～来世での繋がりまで2人の相性をとことん深掘りしてみませんか？' );
		$SmartyObj->assign( 'special_period',	'推しとあなたの相性診断_special_period' );
	}
}


// menuデータから_min_titleを配列に格納
$menuData = [];
if (is_readable($self->get('event') . '/data/' . $self->get('menu_id') . '.php')) {
    include($self->get('event') . '/data/' . $self->get('menu_id') . '.php');
    // _min_titleで終わるキーをフィルタリングし、その数を取得
    $min_title_keys = array_filter(array_keys($menuData), function($key) {
        return substr($key, -10) === '_min_title';
    });

    $maxIndex = count($min_title_keys);
}

// $cdn_flag = true;
$cdn_flag = false; //★開発用

if( $cdn_flag && ( $self->get('isp') == 11 ) ) {
	// $img_path = 'https://lw6nr4oyej.user-space.cdn.idcfcloud.net/cp_v/oshi';
	$img_path = '/cp_v/oshi';
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
 * 【input / question / result】
 */
else if ( is_readable( $self->get('event') .'/data/' .$self->get('menu_id') .'.php' ) ) {

	// 入力値
	$user_keys	= array( 'name', 'birth_year', 'birth_mon', 'birth_mday',  'sex');
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
		$self->set('name2_other', '推し' );
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
	}
	

	if( !$now || !is_numeric ( $now ) || strlen( $now ) != 8 ) {
		$now = date("Ymd");
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

	//設問ページフラグ
	$question_flag = strpos( $self->get('t'), 'question' ) !== false;

	// 一部無料結果ページフラグ
	// $free_flag = strpos( $self->get('t'), 'result_free' ) !== false;

	$SmartyObj->assign( 'free_flag', $allfree_flag );
	$SmartyObj->assign( 'result_flag', $result_flag );
	$SmartyObj->assign( 'question_flag', $question_flag );	
	
	// メニュー情報をテンプレートにセット
	$min_title = array();
	$type = [];
	$count = 0;
	$maxCount = 0;
	$tmp_type = [];

	// $menuData から 'min_title' の連続した数からtmp_typeを作成
	foreach ($menuData as $key => $value) {
		if (strpos($key, 'min_title') !== false) {
			$count++;
			$maxCount = max($maxCount, $count);
		} else {
			$count = 0;
		}
	}

	for ($i = 1; $i <= $maxCount; $i++) {
		$tmp_type[] = $i;
	}
	shuffle($tmp_type);
	foreach( $menuData as $key => $val ) {
		if ( $key == 'title' ) { $SmartyObj->assign( 'menu_title', $val );}
		if ( $key == 'menu_id' ) { $SmartyObj->assign( 'menu_id', $val );}
		if ( $key == 'category_name' ) { $SmartyObj->assign( 'category_name', $val );}
		if ( $key == 'price' ) { $SmartyObj->assign( 'menu_price', $val );}
		if( strpos( $key, 'min_title' ) !== false  ) {
			$arr_mt = explode( "_", $key );
			$type[$arr_mt[0]] = $tmp_type[ $arr_mt[0] -1 ];
			$min_title[ $arr_mt[0] ] = $allfree_flag ?$val[ $type[ $arr_mt[0] ] ] :$val;
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
	$SmartyObj->assign( 'menu_min_title_type', $type );	

	// ロジック情報
	if( $result_flag ) {
		require_once 'logic.php';
	}
	// 【完全無料メニュー】結果ページ
	if( $allfree_flag ) {
		// 入力チェック
		checkInputParam();

		// ロジック結果を取得
		require_once 'logic.php';

		// $logic_cd = get_logic_cd( $menuData['contents'] );

		// 27宿基本性格
		$base = get_base_info_allfree();
		// 無料結果データ
		if (isset($base) && !empty($base)){
			// 結果テキスト
			$result_menu = [];
			$result_menu[1] = get_logic_result('result_001_01', $base['logic_27constellations_other']); // 小メニュー1 推しの基本性格（サマリ）
			$result_menu[2] = get_logic_result('result_001_02', $base['logic_27constellations_other']); // 小メニュー2 推しの基本性格（本文）
			$result_menu[3] = get_logic_result('result_001_03', $base['logic_27constellations_self']); // 小メニュー3 あなたの基本性格（サマリ）
			$result_menu[4] = get_logic_result('result_001_04', $base['logic_27constellations_self']); // 小メニュー4 あなたの基本性格（本文）
			$result_menu[5] = get_logic_result('result_001_05', $base['logic_hihou_self_other']); // 小メニュー5 あなたと推しの基本相性（サマリ）
			$result_menu[6] = get_logic_result('result_001_06', $base['logic_hihou_self_other']); // 小メニュー6 あなたと推しの基本相性（本文）
			$result_menu[7] = get_logic_result('result_001_07', $base['logic_hihou_self_other']); // 小メニュー7 あなたと推しの基本相性（結果）
			$SmartyObj->assign('result_menu', $result_menu);
			$SmartyObj->assign( 'base_id_self', $base['logic_27constellations_self'] );
			$SmartyObj->assign( 'base_id_other', $base['logic_27constellations_other'] );
			if (isset($base['logic_27constellations_self'])) {
				$base_alt_self = get_logic_result('character_base_data', $base['logic_27constellations_self']);
				$SmartyObj->assign( 'base_alt_self', $base_alt_self );
			}
			if (isset($base['logic_27constellations_other'])) {
				$base_alt_other = get_logic_result('character_base_data', $base['logic_27constellations_other']);
				$SmartyObj->assign( 'base_alt_other', $base_alt_other );
			}
			// 自分→相手の三九の秘法(相性×距離) 27pt
			$SmartyObj->assign( 'logic_hihou_self_other', $base['logic_hihou_self_other'] );
			if (isset($base['logic_hihou_self_other'])) {
				$compatibility_value = get_logic_result('base_sanku', $base['logic_hihou_self_other']);
				$tens_digit = floor($compatibility_value / 10);  // 10の位
				$ones_digit = $compatibility_value % 10;         // 1の位
				$SmartyObj->assign( 'number', $compatibility_value );
				$SmartyObj->assign( 'tens_digit', $tens_digit );
				$SmartyObj->assign( 'ones_digit', $ones_digit );
			}
		}


		if( isset( $next ) ) {
			$result_list = array();
			
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
						if( $key == 'discount' && $self->get('isp') == 40 ) continue;
						$data[$key] = $val;
					}
				}
				$data['menu_min_title'] = $min_title;
				$next_free = $next_data->get('free');
				$result_list[] = $data;
				
			}
			if (isset($base) && !empty($base)){
				// 結果テキスト 有料
				$result_menu[1] = get_logic_result('result_002_01', $base['logic_aisho_self_other']); // // 相性分析①（サマリ）有料
				$result_menu[2] = get_logic_result('result_002_02', $base['logic_aisho_self_other']); // 相性分析①（本文）有料
				$result_menu[3] = get_logic_result('result_002_03', $base['logic_aisho_self_other']); // // 相性分析②（サマリ）有料
				$result_menu[4] = get_logic_result('result_002_04', $base['logic_aisho_self_other']); // 相性分析②（本文）有料
				$result_menu[5] = get_logic_result('result_002_05', $base['logic_aisho_self_other']); // // 相性分析③（サマリ）有料
				$result_menu[6] = get_logic_result('result_002_06', $base['logic_aisho_self_other']); // 相性分析③（本文）有料
				$result_menu[7] = get_logic_result('result_002_07', $base['logic_aisho_self_other']); // // 相性分析④（サマリ）有料
				$result_menu[8] = get_logic_result('result_002_08', $base['logic_aisho_self_other']); // 相性分析④（本文）有料
				$result_menu[9] = get_logic_result('result_002_09', $base['logic_aisho_self_other']); // // 相性分析⑤（サマリ）有料
				$result_menu[10] = get_logic_result('result_002_10', $base['logic_aisho_self_other']); // 相性分析⑤（本文）有料
				$result_menu[11] = get_logic_result('result_002_11', $base['logic_aisho_self_other']); // // 相性分析⑥（サマリ）有料
				$result_menu[12] = get_logic_result('result_002_12', $base['logic_aisho_self_other']); // 相性分析⑥（本文）有料
	
	
				// 相性物語
				$result_menu[13] = get_logic_result('result_002_13', $base['logic_aisho_self_other']); // 相性分析⑥（本文）有料
				$result_menu[14] = get_logic_result('result_002_14', $base['logic_aisho_self_other']); // 相性分析⑥（本文）有料
				$result_menu[15] = get_logic_result('result_002_15', $base['logic_aisho_self_other']); // 相性分析⑥（本文）有料
				
				// ラブバランス
				$result_menu[16] = get_logic_result('result_002_16', $base['logic_hihou_self_other']); // パワーバランステキスト 16
				$result_menu['ratio_16'] = get_logic_result('result_002_16_ratio', $base['logic_hihou_self_other']); // パワーバランス比率 16

				$result_menu[17] = get_logic_result('result_002_17', $base['logic_hihou_self_other']); // パワーバランステキスト 17
				$result_menu['ratio_17'] = get_logic_result('result_002_17_ratio', $base['logic_hihou_self_other']); // パワーバランス比率 17
	
				$result_menu[18] = get_logic_result('result_002_18', $base['logic_hihou_self_other']); // パワーバランス 18
				$result_menu['ratio_18'] = get_logic_result('result_002_18_ratio', $base['logic_hihou_self_other']); // パワーバランス比率 18
	
				// ポイント
				$result_menu[21] = get_logic_result('result_002_21', $base['logic_hihou_self_other']); // 喜ぶポイント（プレゼント） 21
				$result_menu[22] = get_logic_result('result_002_22', $base['logic_hihou_self_other']); // 喜ぶポイント（言葉） 22
				$result_menu[23] = get_logic_result('result_002_23', $base['logic_hihou_self_other']); // 共通ポイント 23
	
				// 自分→相手の三九の秘法 11pt
				if (isset($base['logic_aisho_self_other']) && isset($base_sanku_aisho_11[$base['logic_aisho_self_other']])) {
					$SmartyObj->assign( 'logic_aisho_self_other', $base['logic_aisho_self_other'] );
					$aisho_love = get_logic_result('base_sanku_aisho_11', $base['logic_aisho_self_other'], 'aisho_love_point');
					$aisho_night = get_logic_result('base_sanku_aisho_11', $base['logic_aisho_self_other'], 'aisho_night_point');
					$aisho_friend = get_logic_result('base_sanku_aisho_11', $base['logic_aisho_self_other'], 'aisho_friend_point');
					$aisho_hobby = get_logic_result('base_sanku_aisho_11', $base['logic_aisho_self_other'], 'aisho_hobby_point');
					$aisho_business = get_logic_result('base_sanku_aisho_11', $base['logic_aisho_self_other'], 'aisho_business_point');
					$aisho_marriage = get_logic_result('base_sanku_aisho_11', $base['logic_aisho_self_other'], 'aisho_marriage_point');
					$SmartyObj->assign( 'aisho_love', $aisho_love );
					$SmartyObj->assign( 'aisho_night', $aisho_night );
					$SmartyObj->assign( 'aisho_friend', $aisho_friend );
					$SmartyObj->assign( 'aisho_hobby', $aisho_hobby );
					$SmartyObj->assign( 'aisho_business', $aisho_business );
					$SmartyObj->assign( 'aisho_marriage', $aisho_marriage );
				}	
			}
			if (isset($result_menu_002)){
				$result_list['result'] = $result_menu_002;
			}
			$SmartyObj->assign( 'result_list', $result_list );
			
		}
	
	}

	// 【通常メニュー】結果ページ
	else if( $result_flag ) {

		// 入力チェック
		checkInputParam();

		// ロジック結果を取得
		require_once 'logic.php';		
		
		// 27宿基本性格
		$base = get_base_info_allfree();
			if (isset($base) && !empty($base)){
			// 結果テキスト 有料
			$result_menu = [];
			$result_menu[1] = get_logic_result('result_002_01', $base['logic_aisho_self_other']); // // 相性分析①（サマリ）有料
			$result_menu[2] = get_logic_result('result_002_02', $base['logic_aisho_self_other']); // 相性分析①（本文）有料
			$result_menu[3] = get_logic_result('result_002_03', $base['logic_aisho_self_other']); // // 相性分析②（サマリ）有料
			$result_menu[4] = get_logic_result('result_002_04', $base['logic_aisho_self_other']); // 相性分析②（本文）有料
			$result_menu[5] = get_logic_result('result_002_05', $base['logic_aisho_self_other']); // // 相性分析③（サマリ）有料
			$result_menu[6] = get_logic_result('result_002_06', $base['logic_aisho_self_other']); // 相性分析③（本文）有料
			$result_menu[7] = get_logic_result('result_002_07', $base['logic_aisho_self_other']); // // 相性分析④（サマリ）有料
			$result_menu[8] = get_logic_result('result_002_08', $base['logic_aisho_self_other']); // 相性分析④（本文）有料
			$result_menu[9] = get_logic_result('result_002_09', $base['logic_aisho_self_other']); // // 相性分析⑤（サマリ）有料
			$result_menu[10] = get_logic_result('result_002_10', $base['logic_aisho_self_other']); // 相性分析⑤（本文）有料
			$result_menu[11] = get_logic_result('result_002_11', $base['logic_aisho_self_other']); // // 相性分析⑥（サマリ）有料
			$result_menu[12] = get_logic_result('result_002_12', $base['logic_aisho_self_other']); // 相性分析⑥（本文）有料


			// 相性物語
			$result_menu[13] = get_logic_result('result_002_13', $base['logic_aisho_self_other']); // 相性分析⑥（本文）有料
			$result_menu[14] = get_logic_result('result_002_14', $base['logic_aisho_self_other']); // 相性分析⑥（本文）有料
			$result_menu[15] = get_logic_result('result_002_15', $base['logic_aisho_self_other']); // 相性分析⑥（本文）有料
			
			// ラブバランス
			$result_menu[16] = get_logic_result('result_002_16', $base['logic_27constellations_other']); // パワーバランステキスト 16
			$result_menu['ratio_16'] = get_logic_result('result_002_16_ratio', $base['logic_27constellations_other']); // パワーバランス比率 16
			$result_menu[17] = get_logic_result('result_002_17', $base['logic_27constellations_other']); // パワーバランステキスト 17
			$result_menu['ratio_17'] = get_logic_result('result_002_17_ratio', $base['logic_27constellations_other']); // パワーバランス比率 17
			$result_menu[18] = get_logic_result('result_002_18', $base['logic_27constellations_other']); // パワーバランス 18
			$result_menu['ratio_18'] = get_logic_result('result_002_18_ratio', $base['logic_27constellations_other']); // パワーバランス比率 18

			// ポイント
			$result_menu[21] = get_logic_result('result_002_21', $base['logic_27constellations_other']); // 喜ぶポイント（プレゼント） 21
			$result_menu[22] = get_logic_result('result_002_22', $base['logic_27constellations_other']); // 喜ぶポイント（言葉） 22
			$result_menu[23] = get_logic_result('result_002_23', $base['logic_hihou_self_other']); // 共通ポイント 23

			$SmartyObj->assign('result_menu', $result_menu);

			$SmartyObj->assign( 'base_id_self', $base['logic_27constellations_self'] );
			$SmartyObj->assign( 'base_id_other', $base['logic_27constellations_other'] );
			if (isset($base['logic_27constellations_self'])) {
				$base_alt_self = get_logic_result('character_base_data', $base['logic_27constellations_self']);
				$SmartyObj->assign( 'base_alt_self', $base_alt_self );
			}
			if (isset($base['logic_27constellations_other'])) {
				$base_alt_other = get_logic_result('character_base_data', $base['logic_27constellations_other']);
				$SmartyObj->assign( 'base_alt_other', $base_alt_other );
			}

			// 自分→相手の三九の秘法(相性×距離) 27pt
			$SmartyObj->assign( 'logic_hihou_self_other', $base['logic_hihou_self_other'] );
			if (isset($base['logic_hihou_self_other'])) {
				$compatibility_value = get_logic_result('base_sanku', $base['logic_hihou_self_other']);
				$tens_digit = floor($compatibility_value / 10);  // 10の位
				$ones_digit = $compatibility_value % 10;         // 1の位
				$SmartyObj->assign( 'number', $compatibility_value );
				$SmartyObj->assign( 'tens_digit', $tens_digit );
				$SmartyObj->assign( 'ones_digit', $ones_digit );
			}

			// 自分→相手の三九の秘法 11pt
			if (isset($base['logic_aisho_self_other'])) {
				$SmartyObj->assign( 'logic_aisho_self_other', $base['logic_aisho_self_other'] );
				$aisho_love = get_logic_result('base_sanku_aisho_11', $base['logic_aisho_self_other'], 'aisho_love_point');
				$aisho_night = get_logic_result('base_sanku_aisho_11', $base['logic_aisho_self_other'], 'aisho_night_point');
				$aisho_friend = get_logic_result('base_sanku_aisho_11', $base['logic_aisho_self_other'], 'aisho_friend_point');
				$aisho_hobby = get_logic_result('base_sanku_aisho_11', $base['logic_aisho_self_other'], 'aisho_hobby_point');
				$aisho_business = get_logic_result('base_sanku_aisho_11', $base['logic_aisho_self_other'], 'aisho_business_point');
				$aisho_marriage = get_logic_result('base_sanku_aisho_11', $base['logic_aisho_self_other'], 'aisho_marriage_point');
				$SmartyObj->assign( 'aisho_love', $aisho_love );
				$SmartyObj->assign( 'aisho_night', $aisho_night );
				$SmartyObj->assign( 'aisho_friend', $aisho_friend );
				$SmartyObj->assign( 'aisho_hobby', $aisho_hobby );
				$SmartyObj->assign( 'aisho_business', $aisho_business );
				$SmartyObj->assign( 'aisho_marriage', $aisho_marriage );
			}	
		}

		// タロット
		$tarot = get_tarot_data();
		// 設問結果
		$question_result = get_question_data();
    	$SmartyObj->assign( 'q_1',  substr($_REQUEST['q_1'], -1) );
		$SmartyObj->assign( 'q_2',  substr($_REQUEST['q_2'], -1) );
		$SmartyObj->assign( 'q_3',  substr($_REQUEST['q_3'], -1) );

		$result_number = $question_result['result'];
		$tarot['tarot_data_19']['card_text'] = get_logic_result('tarot_text1', $tarot['tarot_data_19']['card_number'], $result_number);
		$tarot['tarot_data_20']['card_text'] = get_logic_result('tarot_text2', $tarot['tarot_data_20']['card_number'], $result_number);
		// ★開発用
		$tarot['dev_answer'] = $question_result['question_answer'];
		$tarot['dev_text_number'] = $result_number;

		$SmartyObj->assign( 'tarot', $tarot );

		if( isset( $next ) ) {
			$free_list = array();
			
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
						if( $key == 'discount' && $self->get('isp') == 40 ) continue;
						$data[$key] = $val;
					}
				}
				$data['menu_min_title'] = $min_title;
				$free_list[] = $data;
				
			}
			// 結果テキスト
			$result_menu_001 = [];
			$result_menu_001[1] = get_logic_result('result_001_01', $base['logic_27constellations_other']); // 小メニュー1 推しの基本性格（サマリ）
			$result_menu_001[2] = get_logic_result('result_001_02', $base['logic_27constellations_other']); // 小メニュー2 推しの基本性格（本文）
			$result_menu_001[3] = get_logic_result('result_001_03', $base['logic_27constellations_self']); // 小メニュー3 あなたの基本性格（サマリ）
			$result_menu_001[4] = get_logic_result('result_001_04', $base['logic_27constellations_self']); // 小メニュー4 あなたの基本性格（本文）
			$result_menu_001[5] = get_logic_result('result_001_05', $base['logic_hihou_self_other']); // 小メニュー5 あなたと推しの基本相性（サマリ）
			$result_menu_001[6] = get_logic_result('result_001_06', $base['logic_hihou_self_other']); // 小メニュー6 あなたと推しの基本相性（本文）
			$result_menu_001[7] = get_logic_result('result_001_07', $base['logic_hihou_self_other']); // 小メニュー7 あなたと推しの基本相性（結果）
			$free_list['result_001'] = $result_menu_001;
			$SmartyObj->assign( 'free_list', $free_list );
		}
	}
}

?>
