<?php

function postData($path, $data){

		$URL = 'https://bot-line-multifunction.firebaseio.com/' . $path . '.json';

		$curl = curl_init();
		curl_setopt( $curl, CURLOPT_URL, $URL );
		curl_setopt( $curl, CURLOPT_CUSTOMERQUEST, "PUT" );
		curl_setopt( $curl, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		$response = curl_exec( $curl );
		curl_close( $curl );

}