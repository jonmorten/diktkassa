<?php

class BookOrderController extends BaseController
{

	protected $formRules = [
		'user_name' => 'honeypot',
		'user_time' => 'required|honeytime:1',
		'name' => 'required',
		'phone' => 'required',
		'email' => 'required|email',
		'address' => 'required',
		'postal_area' => 'required',
		'zip' => 'required|digits:4',
	];

	protected $formMessages = [
		'honeypot' => 'Vi tror du er en robot',
		'user_time.honeytime' => 'Vi tror du er en robot',
		'required' => 'Må fylles ut',
		'email' => 'Må være en e-postadresse',
		'zip.digits' => 'Må være fire siffer',
	];

	public function formSubmit()
	{
		$validator = Validator::make(
			Input::all(),
			$this->formRules,
			$this->formMessages
		);

		$formFieldsInput = Input::only('name', 'phone', 'email', 'address', 'postal_area', 'zip', 'other');

		if ($validator->fails()) {
			return Redirect::route('bookOrderForm')
				->withInput($formFieldsInput)
				->withErrors($validator, 'bookOrderForm');
		}

		Session::set('bookOrder', $formFieldsInput);

		return Redirect::route('bookOrderConfirm');
	}

	public function confirmSubmit()
	{
		$bookOrder = Session::get('bookOrder', false);
		if (empty($bookOrder)) {
			return Redirect::route('bookOrderForm');
		}

		$action = Input::get('action');
		if ($action === 'cancel') {
			return Redirect::route('bookOrderForm')
				->withInput($bookOrder);
		}

		$bookOrder = array_map('htmlentities', $bookOrder);
		$bookOrder = array_map('nl2br', $bookOrder);
		$emailData = ['time' => date('Y.m.d H:i:s', time())] + $bookOrder;

		Mail::send('emails.bookOrder', $emailData, function($message)
		{
			$message
				->subject('Bestilling')
				->from($_ENV['order_email'], 'Diktkassa')
				->to($_ENV['order_email'], 'Diktkassa');
		});

		Session::forget('bookOrder');

		return Redirect::route('frontpage')->with('message', 'Oi - hva har hendt? <br> Jo: din bestilling er sendt!');
	}

}
