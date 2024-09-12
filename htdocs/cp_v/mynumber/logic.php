<?php
// ***************************/
// 九星:ロジックサーバ　SougenUnion004
//     a1 : logic_honmei_self : 本命星・自分	[ 1- 9 ]
//     b1 : logic_year_self   : 年運  ・自分	[ 1- 9 ]
//     b2 : logic_year_other  : 年運  ・相手	[ 1- 9 ]
//     c1 : logic_month_self  : 月運  ・自分	[ 1- 9 ]
//     c2 : logic_month_other : 月運  ・相手	[ 1- 9 ]
// ***************************/
function get_SougenUnion004() {
	global $self;
	$logic_cd = array();
	
	$param = '&menu_id=bs0000a&sex_self=2&fortune_date=' .$self->get('now')
			.'&birth_self=' .sprintf( '%04d%02d%02d', $self->get('birth_year_self'), $self->get('birth_mon_self'), $self->get('birth_mday_self') );
	if( $self->get('birth_year_other') && $self->get('birth_mon_other') && $self->get('birth_mday_other') ){
		$param .= '&birth_other=' .sprintf( '%04d%02d%02d', $self->get('birth_year_other'), $self->get('birth_mon_other'), $self->get('birth_mday_other') );
	}
	
	$result = logicserver( 'webteam', 'SougenUnion004', $param, 'explanation' );
	
	$logic_cd['a1'] = $result['logic_honmei_self'];
	$logic_cd['b1']   = $result['logic_year_self'];
	$logic_cd['c1']  = $result['logic_month_self'];
	if( $self->get('birth_year_other') ) {
		$logic_cd['b2']  = $result['logic_year_other'];
		$logic_cd['c2'] = $result['logic_month_other'];
	}
	
	return $logic_cd;
}

?>
