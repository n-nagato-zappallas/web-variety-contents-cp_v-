<?php

// カテゴリグループ対応 /////////////////////////////////////////////////////////////////////////////////////
		
		$free_menu   = array( 'oa_001' );
		$paid_menu   = array( 'oa_002' );
		$SmartyObj->assign( 'free_menu', getIndexData( $free_menu ) );
		$SmartyObj->assign( 'paid_menu', getIndexData( $paid_menu ) );
?>
