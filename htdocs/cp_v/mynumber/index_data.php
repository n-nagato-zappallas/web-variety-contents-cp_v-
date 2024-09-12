<?php

// カテゴリグループ対応 /////////////////////////////////////////////////////////////////////////////////////
		
		$free_menu   = array( 'no_001' );
		$paid_menu   = array( 'no_002' );
		$SmartyObj->assign( 'free_menu', getIndexData( $free_menu ) );
		$SmartyObj->assign( 'paid_menu', getIndexData( $paid_menu ) );
?>
