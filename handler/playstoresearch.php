<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function playstore($query, $userId){
	
	include_once('api/playStoreApi.php');
	$class_init = new PlayStoreApi;
	if ($query == null){
		$result = new TextMessageBuilder("~Playstore App Search Engine~\n\nCara menggunakan: .playstore [app]\nContoh: .playstore whatsapp\n\nSilahkan dicoba~ :v");
	} else {
		
		$search_query = $query;
		$sort = 'Popularity';
		$price = 'All';
		$safe_search = 'Off';

	/* WITHOUT PAGINATION PARAMERTER */
	
		$searchStore = $class_init->searchStore($search_query,$sort,$price,$safe_search);

	/* PAGINATION PARAMETER */
	// You can easily add the page numbers to paginate the result
	//$page = 2;
	//$searchStore = $class_init->searchStore($search_query,$sort,$price,$safe_search,$page);

		if($searchStore !== 0)
		{
			print_r($searchStore);
			$result = new TextMessageBuilder("Result of " . $query . ":\nSort by: " . $sort . "\nPrice: " . $price . "\nSafe Search: " . $safe_search . "\n\nResult:\n\n" . $searchStore);
		}

		}

	return $result;

}