<?php

class BookFormController extends BaseController
{

	protected $formRules = [
		'user_name' => 'honeypot',
		'user_time' => 'required|honeytime:2',
		'name' => 'required',
		'address' => 'required',
		'postal_area' => 'required',
		'zip' => 'required',
	];

	protected $formMessages = [
		'honeypot' => 'Vi tror du er en robot',
		'user_time.honeytime' => 'Vi tror du er en robot',
		'name.required' => 'Må fylles ut',
		'address.required' => 'Må fylles ut',
		'postal_area.required' => 'Må fylles ut',
		'zip.required' => 'Må fylles ut',
	];

	public function formSubmit()
	{
		$validator = Validator::make(
			Input::all(),
			$this->formRules,
			$this->formMessages
		);

		if ($validator->fails()) {
			return Redirect::route('bookForm')
				->withInput(Input::only('name', 'address', 'postal_area', 'zip'))
				->withErrors($validator, 'bookForm');
		}

		$emailData = [
			'time' => date('Y.m.d H:i:s', time()),
			'name' => htmlentities(Input::get('name')),
			'address' => htmlentities(Input::get('address')),
			'postal_area' => htmlentities(Input::get('postal_area')),
			'zip' => htmlentities(Input::get('zip')),
		];
		Mail::send('emails.bookOrder', $emailData, function($message)
		{
			$message
				->subject('Bestilling')
				->from($_ENV['order_email'], 'Diktkassa')
				->to($_ENV['order_email'], 'Diktkassa');
		});

		return Redirect::route('frontpage')->with('message', 'Oi - hva har hendt? <br> Jo: din bestilling er sendt!');
	}

}
