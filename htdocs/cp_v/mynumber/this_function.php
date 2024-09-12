<?php
/**
 * 年運用。リリース日を迎えたもの全て表示
 */
function getIndexData( $arr = array() ) {
	global $self;
	$release_date = $self->get('release_date');
	$ret = array();
	foreach( $arr as $menu_id ) {
		$tmp =  new menuInfo( $menu_id, '' );
		$row = $tmp->get('menuData');
		if( $row['release_date'] > $release_date ) continue;
		$data = array( 'menu_id' => $menu_id );
		$min_title = array();
		foreach( $row as $key => $val ) {
			if( $key == 'release_date' && date_diff_local( $release_date, $val ) <= 30 )
				$data['new'] = '1';
			if( strpos( $key, 'min_title' ) !== false  ) {
				$arr_mt = explode( "_", $key );
				$min_title[ $arr_mt[0] ] = $val;
			} else if( strpos( $key, 'price' ) !== false ) {
				if( $self->get('isp') == 10 || $self->get('isp') == 11 ) {
					$data[$key] = number_format( $val *1.1 ) .'円（税込）';
				} else
					$data[$key] = $val;
			} else {
				$data[$key] = $val;
			}
		}
		$data['menu_min_title'] = $min_title;
		$ret[] = $data;
	}
	return $ret;
}

/**
 * 月運用。指定リリース日以外のメニューは表示しない
 */
// function getIndexData2( $arr = array(), $release_date ) {
// 	global $self;
// 	$ret = array();
// 	foreach( $arr as $menu_id ) {
// 		$tmp =  new menuInfo( $menu_id, '' );
// 		$row = $tmp->get('menuData');
// 		if( $row['release_date'] != $release_date ) continue;
// 		$data = array( 'menu_id' => $menu_id );
// 		$min_title = array();
// 		foreach( $row as $key => $val ) {
// 			if( strpos( $key, 'min_title' ) !== false  ) {
// 				$arr_mt = explode( "_", $key );
// 				$min_title[ $arr_mt[0] ] = $val;
// 			} else if( strpos( $key, 'price' ) !== false ) {
// 				if( $self->get('isp') == 10 || $self->get('isp') == 11 ) {
// 					$data[$key] = number_format( $val *1.1 ) .'円（税込）';
// 				} else
// 					$data[$key] = $val;
// 			} else {
// 				$data[$key] = $val;
// 			}
// 		}
// 		$data['menu_min_title'] = $min_title;
// 		$ret[] = $data;
// 	}
// 	return $ret;
// }

/**
 * その他の年運。
 */
// function getIndexData3( $arr = array() ) {
// 	global $self, $YearData1;
// 	$release_date = $self->get('release_date');
// 	$ret = array();
// 	foreach( $arr as $menu_id => $row ) {
// 		if( $menu_id == $self->get('menu_id') ) continue;
// 		if( $row['release_date'] > $release_date ) continue;
// 		if( $self->get('isp') != 70 && strpos( $row['contents_id'], 'zap' ) === false ) continue;
		
// 		// 本格館 219:ko5003a, 903:tt5005a, 309:ot3208a, 501:nt5003a, 901:ri4203a はリリース日が異なる
// 		if( $self->get('isp') == 11 ) {
// 			if( ( $menu_id == 219 || $menu_id == 903 || $menu_id == 309 || $menu_id == 501 ) && 20220109 > $release_date ) continue;
// 			if( $menu_id == 901 && 20220123 > $release_date ) continue;
// 		}
		
// 		$data = array( 'menu_id' => $menu_id );
// 		$data = array( 'charano' => $menu_id );
// 		foreach( $row as $key => $val ) {
			
// 			if( $key == 'release_date' && date_diff_local( $release_date, $val ) <= 30 ) {
// 				$data['new'] = '1';
// 			}
// 			if( $self->get('isp') == 10 ) {
// 				if( strpos( $key, 'price' ) !== false ) {
// 					$data[$key] = number_format( $val *1.1 ) .'円（税込）';
// 				} else if( $key == 'menu_url' ) {
// 					$data[$key] = str_replace( 'charge-fortune.yahoo.co.jp/zap/', 'lovefortune.zappallas.com/rakuten/', $val );
// 				 }else
// 					$data[$key] = $val;
// 			} else if( $self->get('isp') == 11 ) {
// 				if( strpos( $key, 'price' ) !== false ) {
// 					$data[$key] = number_format( $val *1.1 ) .'円（税込）';
// 				} else if( $key == 'menu_url' ) {
// 					$data[$key] = str_replace( 'charge-fortune.yahoo.co.jp/zap/', 'honkaku-uranai.jp/cp_zap/', $val );
// 				 }else
// 					$data[$key] = $val;
// 			} else {
// 				$data[$key] = $val;
// 			}
// 		}
// 		$ret[] = $data;
// 	}
// 	return $ret;
// }


?>
