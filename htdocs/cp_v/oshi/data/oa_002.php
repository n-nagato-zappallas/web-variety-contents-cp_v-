<?php
/**
 * menu_id : oa_001
 * 推しとあなたの相性診断
 */



// 名前対応
if( isset($_REQUEST['name_other']) ) {
	if( $_REQUEST['name_other'] == '' ) {
		$other_name = '推し';
	} else {
		$other_name = $_REQUEST['name_other'].'さん';
	}
} else {
	$other_name = '推し';
}

if (isset($_REQUEST['name_self'])) {
	if( $_REQUEST['name_self'] == '' ) {
		$self_name = 'あなた';
	} else {
		$self_name = $_REQUEST['name_self'].'さん';
	}
} else {
	$self_name = 'あなた';
}

// メニュー情報
$menuData = array(
	'menu_id'			 => 'oa_002',
	'contents'			 => '',
	'img_name'			 => '',
	'teller_name'		 => '',
	'price'				 => '2000',
	'discount'			 => '0',
	'design_cd'			 => '99',
	'person'			 => '2',
	'category_name'		 => 'aisho',
	'release_date'		 => '20240430',
	'title'				 => '推しとあなたの相性診断',
	'caption'			 => 'キャプションダミー',
	'1_min_title'  => '恋人相性～推しとあなたが付き合ったら～',
	'2_min_title'  => '相性分析①（本文）',
	'3_min_title'  => '夜の相性～推しと極秘の一夜を共にしたら～',
	'4_min_title'  => '相性分析②（本文）',
	'5_min_title'  => '友達相性～推しと普通に出会っていたら～',
	'6_min_title'  => '相性分析③（本文）',
	'7_min_title'  => '嗜好相性～推しとあなたの好みは近しい？～',
	'8_min_title'  => '相性分析④（本文）',
	'9_min_title'  => 'ビジネス相性～推しと仕事を共にしたら～',
	'10_min_title' => '相性分析⑤（本文）',
	'11_min_title' => '結婚相性～推しと夫婦となり、家庭を築いたら～',
	'12_min_title' => '相性分析⑥（本文）',
	'13_min_title' => '前世での2人の繋がり',
	'14_min_title' => '現世での2人の繋がり',
	'15_min_title' => '来世での2人の繋がり',
	'16_min_title' => '連絡先を交換した2人。連絡頻度が高いのはどっち？	',
	'17_min_title' => '嫉妬しやすいのは推し？　それともあなた？	',
	'18_min_title' => '休日の予定や食べたいもの、どちらの意見が優先されがち？	',
	'19_min_title' => '推しは今、どんな気持ちでいる？	',
	'20_min_title' => '推しを今、悩ませているものは？	',
	'21_min_title' => $other_name . 'がもらって嬉しいプレゼント',
	'22_min_title' => $other_name . 'が言われると嬉しくなる言葉',
	'23_min_title' => $other_name . 'と' . $self_name . 'の共通ポイント',
);

// 小メニューロジック
$logic = 'a1';

// Next枠
$next = array( "oa_001");

$free = '';

?>