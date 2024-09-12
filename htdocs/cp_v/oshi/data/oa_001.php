<?php
/**
 * menu_id : oa_001
 * 推しとあなたの相性診断
 */

// メニュー情報
$menuData = array(
	'menu_id'			 => 'oa_001',
	'contents'			 => 'free',
	'img_name'			 => '',
	'teller_name'		 => '',
	'price'				 => '0',
	'discount'			 => '0',
	'design_cd'			 => '99',
	'person'			 => '2',
	'category_name'		 => 'aisho',
	'release_date'		 => '20240430',
	'title'				 => '推しとあなたの相性診断',
	'caption'			 => 'キャプションダミー',
	'1_min_title'  => '推し/あなたの基本性質',
	'2_min_title'  => '推しの基本性格（本文）',
	'3_min_title'  => 'あなたの基本性格（サマリ）',
	'4_min_title'  => 'あなたの基本性格（本文）',
	'5_min_title'  => '推しとあなたの基本相性',
	'6_min_title'  => '推しとあなたの基本相性（本文）',
	'7_min_title'  => '診断結果サマリ',	
);
// 小メニューロジック
$logic = 'a1';

// Next枠
$next = array( "oa_002");


// 結果テキスト
$text = '';

// 一部見せテキスト
$free = '';
?>