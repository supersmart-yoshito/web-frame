<?

function smarty_modifier_idtoname($id) {

	$account = new AccountsModel() ;
	$rec = $account->findById($id) ;

	return $rec->getNickname() ;
}

