<?php

function getData($url, $data){

		$URL = 'https://www.samehadaku.tv';

		$curl = curl_init();
		curl_setopt( $curl, CURLOPT_URL, $URL );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		$response = curl_exec( $curl );
		curl_close( $curl );

}