<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Currencyconverterapi
{
	private $url;
	private $apiKey;
	private $baseCurrency;

	public function __construct()
	{
		$this->url = 'https://free.currconv.com/api/v7/';
		$this->apiKey = '620e0419f58dba7d4b56';
		$this->baseCurrency = 'EUR';
	}

	private function connect($requestStr)
	{
		$url = $this->url . $requestStr . "apiKey=" . $this->apiKey;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);
		$httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		if ($httpStatus != 200) {
			$data = json_decode($response, true);
			throw new Exception(isset($data["error"]) ? $data['error'] : 'HTTP Error: ' . $httpStatus);
		}

		return $response;
	}

	public function getList($date = null)
	{
		$list = $this->connect("currencies?");

		return $list;
	}

	public function exchangeRate($amount, $baseCurrency, $targetCurrency)
	{
		$from_Currency = urlencode($baseCurrency);
		$to_Currency = urlencode($targetCurrency);
		$query = "{$from_Currency}_{$to_Currency}";

		$json = $this->connect("convert?q={$query}&compact=ultra&");

		$obj = json_decode($json, true);
		$val = floatval($obj["$query"]);

		$total = $val * $amount;

		return number_format($total, 2, '.', '');
	}

	public function historicalData($currencyList, $date)
	{
		$query = '';
		$comaFlag = count($currencyList) - 1;
		foreach ($currencyList as $index => $targetCurrency) {
			$targetCurrency = trim($targetCurrency);
			if(!preg_match_all("/\b[a-zA-Z]{3,}\b/", $targetCurrency))
			{
				throw new Exception(
					'The currency name can contain 3 letters and is separated from the next by a comma.'
				);
			}
			$query .= urlencode($this->baseCurrency). '_' .  urlencode($targetCurrency);
			$query .= $comaFlag > $index ? ',' : '&';
		}

		$json = $this->connect("convert?q={$query}compact=ultra&date={$date}&");
		$data = json_decode($json, true);

		$rates = array();
		foreach ($data as $currency => $rate) {
			$rates[][$currency] = $rate[$date];
		}

		return $rates;
	}
}
