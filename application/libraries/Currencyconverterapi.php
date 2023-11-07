<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Currencyconverterapi
{
	private $url;
	private $apiKey;

	public function __construct(){
		$this->url = 'https://free.currconv.com/api/v7/';
		$this->apiKey = '620e0419f58dba7d4b56';
	}

	public function connect($requestStr) {
		$url = $this->url . $requestStr . "apiKey=" . $this->apiKey;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);
		$httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		if ($httpStatus != 200) {
			$data = json_decode($response, true);
			throw new Exception(isset($data["error"]) ? $data['error'] : 'HTTP Error: ' . $httpStatus );
		}

		return $response;
	}
	public function getList($date = null){
		$list = $this->connect("currencies?");

		return $list;


		/*$apikey = '620e0419f58dba7d4b56оо';
		$json = file_get_contents("https://free.currconv.com/api/v7/currencies?apiKey={$apikey}");
		$obj = json_decode($json, true);
		if (isset($obj["error"])){
			throw new Exception('Произошла ошибка в библиотеке');
		}
		return $json;*/
	}
	public function exchangeRate($amount, $baseCurrency, $targetCurrency){
		//https://free.currconv.com/api/v7/convert?q=RUB_EUR,GEL_EUR&compact=ultra&date=2022-11-11&apiKey=620e0419f58dba7d4b56
		//$apikey = '620e0419f58dba7d4b56';

			$from_Currency = urlencode($baseCurrency);
			$to_Currency = urlencode($targetCurrency);
			$query =  "{$from_Currency}_{$to_Currency}";

			// change to the free URL if you're using the free version
			$json = $this->connect("convert?q={$query}&compact=ultra&");
			//$json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$this->apiKey}");

			$obj = json_decode($json, true);
			$val = floatval($obj["$query"]);


			$total = $val * $amount;
			return number_format($total, 2, '.', '');
	}
}
