<?php

class Yandex {
	private $api_url = "https://translate.yandex.net/api/v1.5/tr.json/";
	private $api_key = "trnsl.1.1.20180529T060335Z.a6acd43b79b28c9e.4e45db507b95396fff7413d03c074cbe93a8dbab";
	function __construct(){
	}
	private function call($method){
		// Init curl function
		$crl = curl_init();
		// Set URL
		$url = $this->api_url.$method;
		//echo "Debug\t: url = ".$url."\n";
		// Set Curl Option
		curl_setopt($crl, CURLOPT_URL,$url); 				//Set API URL
		curl_setopt($crl, CURLOPT_CUSTOMREQUEST, 'GET'); 	//Set Method
		curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1); 		//Set curl to return the result
		// Get the responses
		$respon = json_decode(curl_exec($crl));
		return  $respon;
	}
	public function translate($lang,$text){
		// Format bahasa
		$bahasa = "";
		// Chek lang format
		if(preg_match("/-/",$lang)){
			// - Jika format en-id
			$bahasa = $lang;
		}else{
			// - Jika format autodetek menggunakan /trans en nama saya
			$detect = $this->detect($text);
			$bahasa = $detect."-".$lang;
		}
		// Get the responses
		$respon = $this->call("translate?lang=".$bahasa."&text=".$text."&key=".$this->api_key);
		$reply = "";
		// Check if responses is not empty
		if(isset($respon->code)){
			// Check respon code
			switch($respon->code){
				case 200:
					$reply = $respon->text[0];
					break;
				case 403:
					$reply = "Hari ini sudah banyak menerjemahkan, saya sudah lelah. Besok lagi ya ??";
					break;
				case 404:
					$reply = "Hari ini sudah banyak menerjemahkan, saya sudah lelah. Besok lagi ya ??";
					break;
				case 413:
					$reply = "Teks terlalu panjang, adek gak sanggup bang ??";
					break;
				case 422:
					$reply = "Teks tidak dapat diproses, adek gak sanggup bang ??";
					break;
				case 501:
					$reply = "Pilihan bahasa tidak diketahui, itu bahasa alien? ??";
					break;
				default:
					$reply = "Terjadi kesalahan menterjemahkan, mungkin saya mulai lelah ??";
			} // end switch
		}else{
			echo "Debug\t: Empty responses\n";
		}
		return $reply;
	}
	// Deteksi bahasa, jika tidak ditemukan, default adalah id - Indonesia
	public function detect($text){
		$respon = $this->call("detect?text=".$text."&key=".$this->api_key);
		$reply = "";
		// Jika merespon
		if(isset($respon->code)){
			if($respon->code == 200){
				$reply = $respon->lang;
			}else{
				$reply = "id";
			}
		}
		return $reply;
	}
	public function list_lang(){
		// Get the responses
		$respon = $this->call("getLangs?ui=id&key=".$this->api_key);
		// Variabel reply
		$reply = "";
		// Chek jika ada balasan
		if(isset($respon->langs)){
			// Chek jika balasan tidak kosong
			if(!empty($respon->langs)){
				// Fetch setiap objek, jadikan satu reply
				foreach($respon->langs as $key => $value){
					$reply .= $key." : ".$value."\n";
				}
			}
		}else{
			// Jika reply kosong
			$reply = "Maaf, saya sedang sibuk, coba lagi nanti ya.";
		}
		// Return the data
		return $reply;
	}
}
