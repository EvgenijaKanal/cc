<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class CurrencyController extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('currency/index');
		$this->load->helper('html');

	}

	public function list()
	{
		try {
			$this->load->library('currencyconverterapi');
			$list = $this->currencyconverterapi->getList();
		} catch (Exception $exception) {
			return $this->output
				->set_content_type('application/json')
				->set_status_header(400)
				->set_output(json_encode($exception->getMessage()));
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output($list);
	}

	public function convertAmount()
	{
		try{
			$amount = $this->input->post('amount');
			$baseCurrency= $this->input->post('baseCurrency');
			$targetCurrency = $this->input->post('targetCurrency');


			$this->load->library('currencyconverterapi');
			$rate = $this->currencyconverterapi->exchangeRate($amount, $baseCurrency, $targetCurrency);
		} catch (Exception $exception) {
			return $this->output
				->set_content_type('application/json')
				->set_status_header(400)
				->set_output(json_encode($exception->getMessage()));
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output($rate);
	}
}
