<?php

/**
 * 共通基底関数とか
 */
require '/srv/www/php/htdocs/vendor/autoload.php';
require_once 'DB.php'; //Include Pear:DB

// ########## ここから定数/変数定義 ##########
date_default_timezone_set('Asia/Tokyo');

// $_REQUEST[ 'make' ]が空の場合は初期化　★開発用
if( !isset($_REQUEST[ 'make' ]) ) {
	$_REQUEST[ 'make' ] = '0';
}
// $_REQUEST[ 'cdn' ]が空の場合は初期化 ★開発用
if( !isset($_REQUEST[ 'cdn' ]) ) {
	$_REQUEST[ 'cdn' ] = '0';
}
// $_REQUEST[ 'device_mode' ]が空の場合は初期化 ★開発用
if( !isset($_REQUEST[ 'device_mode' ]) ) {
	$_REQUEST[ 'device_mode' ] = '0';
}
$device_mode = "";


// 本番フラグ
$real_flag = strpos( $_SERVER["HTTP_HOST"] .$_SERVER['REQUEST_URI'], 'web-dev' ) === false || $_REQUEST[ 'make' ] == '1';

// CDNフラグ
$cdn_flag = $_REQUEST[ 'cdn' ] != '0' && $_REQUEST[ 'cdn' ] != 'false';


define('USER',       'web_editor' );
define('PASS',       'rotide_bew' );
define('DBNAME',     'webadmin' );
if( $real_flag ) {
	// 本番
	define('DBSERVER', '172.24.3.219' );
	// define('DBSERVER', '172.24.240.230' ); //開発用
	define('FLS',      'http://10.0.7.130:8080/Uranai/Uranai' );
} else {
	// test
	define('DBSERVER',  '172.24.240.188' );
	define('FLS',       'http://172.24.4.9:8080/Uranai/Uranai' );
}


////////////////////////////////////////////////////////////
/**
 * 例外処理
 */

// 画面表示しない
//ini_set('display_errors', 'Off');
 
// エラー状況
$msg = '';

set_error_handler( 'my_error_handler', E_ERROR );
function my_error_handler ( $error_no, $error_msg, $error_file, $error_line, $error_vars ) {
	if (error_reporting() === 0) {
		return;
	}
	throw new ErrorException($error_msg, 0, $error_no, $error_file, $error_line);
}

set_exception_handler( 'my_exception_handler' );
function my_exception_handler ( $throwable ) {
	send_error_log($throwable);
}

register_shutdown_function( 'my_register_shutdown_function' );
function my_register_shutdown_function() {
	$e = error_get_last();
	if ( $e === null ) {
		return;
	} else if(
			$e['type'] == E_ERROR ||
			$e['type'] == E_PARSE ||
			$e['type'] == E_CORE_ERROR ||
			$e['type'] == E_COMPILE_ERROR ||
			$e['type'] == E_USER_ERROR ) {
		send_error_log( new ErrorException($error['message'], 0, 0, $error['file'], $error['line']) );
	}
}

function send_error_log($throwable) {
	
	$message = array(
		'text' => "<!channel> \n APIサーバエラー監視。\n ```\n" .$throwable->__toString() ."```\n",
	);
	$webhook_url = 'https://hooks.slack.com/services/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';
	$options = array(
		'http' => array(
			'method' => 'POST',
			'header' => 'Content-Type: application/json',
			'content' => json_encode( $message ),
		)
	);
	
	// $response = file_get_contents( $webhook_url, false, stream_context_create($options) );
}
////////////////////////////////////////////////////////////


//// Yahoo応答ヘッダーステータス
// ok    => 'YAHOO-CHARGE:  0\n',     # Successed HTML header.
// ng    => 'YAHOO-CHARGE: -1\n',     #    Failed HTML header.
// free  => 'YAHOO-CHARGE:  9\n'      #      Free HTML header.
$yahoo_charge_status = "9";


// 消費税
define('TAX',       1.1 );

// 入力パラメータ自分・相手用
$target = array( 'self', 'other' );

class SmartyCommon extends Smarty {
    public $project_path;

	//開発用 
	public function assign($key, $val = null, $nocache = false) { 
    	parent::assign( $key, $val );
    }
}

// ########## Controller関数 ##########
class baseInfo {
	private $data = array();
	
	public function set( $key, $val ) {
		$this->data[ $key ] = $val;
	}
	public function get( $key ) {
		$ret = '';
		if ( array_key_exists( $key, $this->data ) ) $ret = $this->data[ $key ];
		return $ret;
	}
	public function getData() {
		return $this->data;
	}
}
/**
 * 入力情報保持クラス
 */
class selfInfo extends baseInfo {
	function __construct() {
		foreach( array( 'event', 'contents', 'menu_id', 't', 'preview', 'release_date', 'isp', 'debug_date' ) as $key )
			// if( $_REQUEST[ $key ] )　//本番
			if (isset($_REQUEST[$key]) && $_REQUEST[$key] !== '') //★開発用
				$this->set( $key, $_REQUEST[ $key ] );
	}

	function init($user_keys) {
		global $target;
		if (!$user_keys || !is_array($user_keys)) {
			return;
		}
		// $device_modeがセットされていなかったら
		if ( !isset($device_mode) ) {
			$device_mode = '';
		}	
		foreach ($target as $param) {
			foreach ($user_keys as $key) {
				$requestKey = $key . '_' . $param;
				if (isset($_REQUEST[$requestKey])) {
					$val = rawurldecode($_REQUEST[$requestKey]);
					if ($key == 'sex') {
						$this->set('sex_name_' . $param, $val == '1' ? '男性' : '女性');
					}
	
					$this->set($key . '_' . $param, $val);
				}
			}
		}
	}
	
}

/**
 * メニュー情報保持クラス
 */
class menuInfo extends baseInfo {
	function __construct( $menu_id, $type ) {
		global $self;
		if( $menu_id ) {
			$this->init( $menu_id, $type );
		}
	}
	
	function init( $menu_id, $type ) {
		global $self, $msg;
		if ( is_readable( $self->get('event') .'/data/' .$menu_id .'.php' ) ) {
			include( $self->get('event') .'/data/' .$menu_id .'.php' );
			$this->set('menuData', $menuData);
			$this->set('logic', $logic);
			if( $type == 'result' ) {
				$this->set('text', $text);
				$this->set('next', $next);
			} else {
				$this->set('free', $free);
			}
		}
	}
}


// ########## ロジックサーバ関数 ##########
/**
 * ロジックサーバに接続
 * Argument:	$pkg    パッケージ名（ webteam ）
 * 				$logic  クラス名（ UechiUnion001 ）
 * 				$param  入力パラメータ
 * 				$type   結果要素のタグ名（ explanation, object ）
 * Return:		$result 結果を格納した１次連想配列
 */
function logicserver( $pkg = null, $logic = null, $param = null, $type = null ) {
    global $msg;
	$result = array();
	
	try{
		// 入力チェック
		if (empty($pkg)) {
			throw new Exception('パラメータエラー ：$pkg');
		}
		
		if (empty($logic)) {
			throw new Exception('パラメータエラー ：$logic');
		}
		
		if (empty($param)) {
			throw new Exception('パラメータエラー ：$param');
		}
		
		if ($type != 'explanation' && $type != 'object') {
			throw new Exception('パラメータエラー ：$type');
		}
		

		// ロジックサーバから結果取得
		$key = md5( 'webteam' .date( 'YmdHi' ) .'fortune' );
		$url = FLS ."?pkg=" .$pkg ."&logic=" .$logic .$param ."&user_name=webteam&key=" .$key;

		$xml = file_get_contents( $url );
		$obj = simplexml_load_string($xml);


		if (!$obj) {
			throw new Exception('xmlエラー ：XMLパース');
		}
		// resultタグ 結果コード判定
		checkResultCode( $obj->result );
		if ( !isset( $obj->content ) ) {
			throw new Exception('xmlエラー ：contntタグがない');
		}

		/** ここから先のタグ解析は結果XMLを見ながら要設定 **/
		// 'explanation'方式
		if ( $type == 'explanation' && isset( $obj->content->explanation ) ) {
			foreach( $obj->content->explanation as $explanation ) {
				$a = $explanation->attributes();
				$key = (string)$a["id"][0];
				$val = (string)$explanation;
				$result[$key] = $val;
			}
		}
		// 'object'方式
		else if ( $type == 'object' && isset( $obj->content->object ) ) {
			foreach( $obj->content->object as $object ) {
				$a = $object->attributes();
				$key = (string)$a["id"][0];
				$val = (string)$object;
				$result[$key] = $val;
			}
		} else {
			throw new Exception('xmlエラー ：戻り値なし');
		}
	} catch ( Exception $e ) {
		$msg .= "[警告] ロジックサーバ接続失敗。" .$e ."<br>\n";
		//SendMail( $msg, $pkg, $logic );
        send_error_log( new ErrorException( $msg, 0, 0, '', 0) );
	}
	return $result;
}

function checkResultCode( $result ) {
    global $msg;
    $txt = array( "不明", "不明" );
    
	switch( $result ){
		case "2000":
			$txt = array( "正常",			"正常終了。" );
			break;
		case "3001":
			$txt = array( "ロジック依存",	"ユーザーが存在しません。" );
			break;
		case "4000":
			$txt = array( "システム",		"パッケージ／ロジックが登録されていません。" );
			break;
		case "4100":
			$txt = array( "日付",			"暦上日ではありません。" );
			break;
		case "4101":
			$txt = array( "パラメータ",		"日付フォーマットが正しくありません。(例:19750318)" );
			break;
		case "4102":
			$txt = array( "パラメータ",		"血液型コードが指定されていません。" );
			break;
		case "4103":
			$txt = array( "パラメータ",		"血液型コードは数値でなければなりません。" );
			break;
		case "4104":
			$txt = array( "パラメータ",		"血液型コードが正しくありません。" );
			break;
		case "4105":
			$txt = array( "パラメータ",		"性別コードが指定されていません。" );
			break;
		case "4106":
			$txt = array( "パラメータ",		"性別コードは数値でなければなりません。" );
			break;
		case "4107":
			$txt = array( "パラメータ",		"性別コードが正しくありません。" );
			break;
		case "4108":
			$txt = array( "パラメータ",		"日付が指定されていません。" );
			break;
		case "4109":
			$txt = array( "パラメータ",		"星座コード(有効範囲:01～12)が正しくありません。" );
			break;
		case "4110":
			$txt = array( "パラメータ",		"生年月日が指定されていません。" );
			break;
		case "4111":
			$txt = array( "パラメータ",		"必須項目が指定されていません。" );
			break;
		case "4112":
			$txt = array( "パラメータ",		"数字以外の文字が含まれています。" );
			break;
		case "4113":
			$txt = array( "パラメータ",		"任意の数字が設定されていません。" );
			break;
		case "4114":
			$txt = array( "パラメータ",		"任意の数字が１文字ではありません。" );
			break;
		case "4115":
			$txt = array( "パラメータ",		"解答の結果が指定されていません。" );
			break;
	}
	if( $result != "2000" )
		$msg .= "<br>\n" .$result .":" .$txt[0] ."エラー<br>\n" .$txt[1] ."<br>\n";
}


// ########## DB関数 ##########
/**
 * select文発行
 */
function select( $query, $param = array() ) {
    return selectBase( dsn_info(), $query, $param );
}

/**
 * update, insert, delete文発行
 */
function edit( $query, $param = array()) {
    return editBase( dsn_info(), $query, $param,);
}

/**
 * DB接続情報
 */
function dsn_info() {
	$dsn = sprintf( "mysql:host=%s;dbname=%s;charset=ujis", DBSERVER, DBNAME );
	$info = [
		'dsn' => $dsn,
		'host' => DBSERVER,
		'dbname' => DBNAME,
		'username' => USER,
		'password' => PASS,
	];
	return $info;
}

/**
 * select文発行
 */
function selectBase( $info, $query, $param = array() ) {
    global $msg;
    $ret = array();
    $dbh = DB::connect( $info );
    $dbh->query( "SET NAMES utf8;" );
    $sth = $dbh->prepare( $query );
    $sth = $dbh->execute( $sth, $param );
    if( PEAR::isError( $sth ) ) {
        $msg .= "[警告] SQL実行時エラーが発生しました。" .$query ."<br>\n";
        $ret = array( array() );
        send_error_log( new ErrorException( $msg, 0, 0, '', 0) );
        
    } else
        while ( $data = $sth->fetchRow( DB_FETCHMODE_ASSOC ) )
            $ret[] = $data;
    $dbh->disconnect();
    return $ret;
}

/**
 * update, insert, delete文発行
 */
function editBase( $info, $query, $param = array()) {
	global $msg;
	try {
		$dbh = new PDO($info['dsn'], $info['username'], $info['password']);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbh->exec("SET NAMES utf8");

		$sth = $dbh->prepare($query);
		$sth->execute($param);
	} catch (PDOException $e) {
		$msg .= "[警告] SQL実行時エラーが発生しました。" . $e->getMessage() . "<br>\n";
		send_error_log(new ErrorException($msg, 0, 0, '', 0));
	} finally {
		if (isset($dbh)) {
			$dbh = null; // 接続を閉じる
		}
	}
}



// ########## 便利関数 ##########
/**
 * null対応
 */
function nvl( $val, $def = '' ) {
	return is_null( $val ) ?$def :$val;
}

/**
 * 文字列の文字コードを調べる
 */
function getCharacode( $str ) {
	foreach( array( 'UTF-8', 'EUC-JP', 'SJIS', 'ASCII', 'JIS' ) as $charcode )
		if( mb_convert_encoding( $str, $charcode, $charcode ) == $str )
			return $charcode;
	return null;
}

/**
 * 文字コード変換。 対象は文字列or配列。
 */
function ce( $str, $charcode, $from ) {
	if( !$from ) {
		$from = getCharacode( $str );
	}
	if( gettype($str) == 'array' ) {
		$ret = array();
		foreach ( $str as $key => $val ) {
			$ret[$key] = ce( $val, $charcode, $from );
		}
		return $ret;
	} else {
		if (is_string($str)) {
			return mb_convert_encoding( $str, $charcode, $from );
		} else {
			return $str;
		}
	}
}

/**
 * EUC-JPからUTF-8へと文字コード変換
 */
function toUtf8( $str ) {
	return ce( $str, 'UTF-8', 'EUC-JP' );
}

/**
 * UTF-8からEUC-JPへと文字コード変換
 */
function toEucjp( $str ) {
	return ce( $str, 'EUC-JP', 'UTF-8' );
}

/**
 * 日数の差分調査
 */
function date_diff_local( $a, $b ) {
	return abs( strtotime($a) -strtotime($b) ) / (60 * 60 * 24);
}


/**
 * 入力パラメータのチェックと形成
 */
function checkInputParam(){
	global $self, $msg, $target;
	// 未入力チェック
	$selfData = $self->getData();
	$err_cnt = 0;
	foreach ( $selfData as $key => $val ) {
		if( empty( $val ) ) {
			if( $key == 'sex_other' && $self->get('sex_self') )
				$self->set('sex_other', $self->get('sex_self') == '1' ?'2' :'1');
			// 名前は空白でもスキップ
			else if( strpos( $key, 'name_' ) !== false ) {
				continue;
			}
			else
				$msg .= ','.$key.'に値がセットされていません';
		}
	}
	
	// 個別チェックと形成
	foreach ( $target as $key => $val ){
		if( $self->get('name_last_' .$val) && $self->get('name_first_'.$val) )
			$self->set( 'name_'.$val, $self->get('name_last_'.$val) .$self->get('name_first_'.$val) );
		if( $self->get('birth_year_'.$val) && $self->get('birth_mon_'.$val) && $self->get('birth_mday_'.$val) ) {
			$y = sprintf( '%04d', $self->get('birth_year_'.$val) );
			$m = sprintf( '%02d', $self->get('birth_mon_'.$val) );
			$d = sprintf( '%02d', $self->get('birth_mday_'.$val) );
			if( !checkdate( $m, $d, $y ) ) {
				$msg .= ',birthday_'.$val.'が日付として正しくありません';
			} else if( $y.$m.$d < 19300101 ) {
				$msg .= ',birthday_'.$val.'が占断範囲外の日付です';
			} else {
				$self->set('birthday_'.$val, sprintf( '%04d-%02d-%02d', $y, $m, $d ));
			}
		}
	}

	return;
}

/**
 * 置き換え文字列対応
 */
function replace_name( $str ) {
	global $self, $msg, $target;
	$ret = str_replace( "[%NAME_SELF%]",  $self->get('name_self'), $str );
	if( $self->get('name_other') )
		$ret = str_replace( "[%NAME_OTHER%]", $self->get('name_other'), $ret );
	return $ret;
}

/**
 * ticket_id 作成
 */
function get_ticket_id() {
	// Generates the source string.
	// datetime + process id + random.
	$source  = sprintf( "%s%06d%06d", date("YmdHis"), getmypid(), mt_rand( 1, 65536 ) );
	$encrypt = hash_hmac( 'sha256', $source, false );
	
	return array( 'source' => $source, 'param' => $encrypt );
}

/**
 * SP判定
 */
function is_smartphone($ua = null) {
	if ( is_null($ua) ) {
		$ua = $_SERVER['HTTP_USER_AGENT'];
	}

	if ( preg_match('/iPhone|iPod|iPad|Android/ui', $ua) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * 地域コードから地名を取得する.
 */
function get_place_param( $logic_cd ) {
	$array_param = array(
		1	=>	 "不明",			2	=>	 "北海道（根室）",		3	=>	 "北海道（帯広）",	4	=>	 "北海道（稚内）",		5	=>	 "北海道（札幌）",
		6	=>	 "北海道（函館）",	7	=>	 "青森県（八戸）",		8	=>	 "青森県（青森）",	9	=>	 "岩手県（宮古）",		10	=>	 "岩手県（遠野）",
		11	=>	 "岩手県（盛岡）",	12	=>	 "秋田県（鹿角）",		13	=>	 "秋田県（秋田）",	14	=>	 "山形県（山形）",		15	=>	 "山形県（米沢）",
		16	=>	 "宮城県（気仙沼）",17	=>	 "宮城県（仙台）",		18	=>	 "福島県（いわき）",19	=>	 "福島県（福島）",		20	=>	 "茨城県（日立）",
		21	=>	 "茨城県（水戸）",	22	=>	 "茨城県（土浦）",		23	=>	 "茨城県（古河）",	24	=>	 "栃木県（那須塩原）",	25	=>	 "栃木県（宇都宮）",
		26	=>	 "群馬県（館林）",	27	=>	 "群馬県（前橋）",		28	=>	 "埼玉県（浦和）",	29	=>	 "埼玉県（大宮）",		30	=>	 "埼玉県（桶川）",
		31	=>	 "埼玉県（熊谷）",	32	=>	 "埼玉県（秩父）",		33	=>	 "千葉県（銚子）",	34	=>	 "千葉県（千葉）",		35	=>	 "千葉県（我孫子）",
		36	=>	 "千葉県（木更津）",37	=>	 "千葉県（館山）",		38	=>	 "東京都（23区）",	39	=>	 "東京都（八王子）",	40	=>	 "東京都（青梅）",
		41	=>	 "東京都（小笠原）",42	=>	 "神奈川県（横浜）",	43	=>	 "神奈川県（鎌倉）",44	=>	 "神奈川県（厚木）",	45	=>	 "神奈川県（小田原）",
		46	=>	 "山梨県（大月）",	47	=>	 "山梨県（甲府）",		48	=>	 "新潟県（新潟）",	49	=>	 "新潟県（糸魚川）",	50	=>	 "長野県（長野）",
		51	=>	 "長野県（塩尻）",	52	=>	 "富山県（富山）",		53	=>	 "石川県（輪島）",	54	=>	 "石川県（金沢）",		55	=>	 "福井県（福井）",
		56	=>	 "福井県（小浜）",	57	=>	 "静岡県（下田）",		58	=>	 "静岡県（静岡）",	59	=>	 "愛知県（知多）",		60	=>	 "愛知県（名古屋）",
		61	=>	 "岐阜県（中津川）",62	=>	 "岐阜県（岐阜）",		63	=>	 "京都府（京都）",	64	=>	 "京都府（綾部）",		65	=>	 "奈良県（奈良）",
		66	=>	 "和歌山県（新宮）",67	=>	 "和歌山県（和歌山）",	68	=>	 "三重県（津）",	69	=>	 "滋賀県（大津）",		70	=>	 "大阪府（枚方）",
		71	=>	 "大阪府（大阪）",	72	=>	 "兵庫県（神戸）",		73	=>	 "兵庫県（明石）",	74	=>	 "岡山県（岡山）",		75	=>	 "鳥取県（鳥取）",
		76	=>	 "広島県（広島）",	77	=>	 "島根県（松江）",		78	=>	 "山口県（岩国）",	79	=>	 "山口県（山口）",		80	=>	 "香川県（高松）",
		81	=>	 "徳島県（徳島）",	82	=>	 "愛媛県（四国中央）",	83	=>	 "愛媛県（松山）",	84	=>	 "高知県（高知）",		85	=>	 "福岡県（豊前）",
		86	=>	 "福岡県（福岡）",	87	=>	 "佐賀県（佐賀）",		88	=>	 "長崎県（長崎）",	89	=>	 "長崎県（五島）",		90	=>	 "大分県（大分）",
		91	=>	 "大分県（日田）",	92	=>	 "熊本県（熊本）",		93	=>	 "熊本県（天草）",	94	=>	 "宮崎県（宮崎）",		95	=>	 "宮崎県（えびの）",
		96	=>	 "鹿児島県（鹿児島）",97	=>	 "鹿児島県（奄美）",98	=>	 "沖縄県（沖縄）",	99	=>	 "沖縄県（宮古島）",	100	=>	 "沖縄県（石垣）",
	);
	return $array_param[ $logic_cd ];
}
/**
 * 地域コードを取得する.
 */
function get_place_cd_param( $logic_cd ) {
	$array_param = array(
		1	=> 300	,2	=> 617	,3	=> 616	,4	=> 615	,5	=> 614	,6	=> 613	,7	=> 612	,8	=> 611	,9	=> 610	,10	=> 609	,
		11	=> 608	,12	=> 607	,13	=> 606	,14	=> 605	,15	=> 604	,16	=> 603	,17	=> 602	,18	=> 601	,19	=> 600	,20	=> 525	,
		21	=> 524	,22	=> 523	,23	=> 522	,24	=> 521	,25	=> 520	,26	=> 519	,27	=> 518	,28	=> 517	,29	=> 516	,30	=> 515	,
		31	=> 514	,32	=> 513	,33	=> 512	,34	=> 511	,35	=> 510	,36	=> 509	,37	=> 508	,38	=> 507	,39	=> 506	,40	=> 505	,
		41	=> 504	,42	=> 503	,43	=> 502	,44	=> 501	,45	=> 500	,46	=> 416	,47	=> 415	,48	=> 414	,49	=> 413	,50	=> 412	,
		51	=> 411	,52	=> 410	,53	=> 409	,54	=> 408	,55	=> 407	,56	=> 406	,57	=> 405	,58	=> 404	,59	=> 403	,60	=> 402	,
		61	=> 401	,62	=> 400	,63	=> 310	,64	=> 309	,65	=> 308	,66	=> 307	,67	=> 306	,68	=> 305	,69	=> 304	,70	=> 303	,
		71	=> 302	,72	=> 301	,73	=> 300	,74	=> 210	,75	=> 209	,76	=> 208	,77	=> 207	,78	=> 206	,79	=> 205	,80	=> 204	,
		81	=> 203	,82	=> 202	,83	=> 201	,84	=> 200	,85	=> 115	,86	=> 114	,87	=> 113	,88	=> 112	,89	=> 111	,90	=> 110	,
		91	=> 109	,92	=> 108	,93	=> 107	,94	=> 106	,95	=> 105	,96	=> 104	,97	=> 103	,98	=> 102	,99	=> 101	,100	=> 100	
	);
	return $array_param[ $logic_cd ];
}

?>