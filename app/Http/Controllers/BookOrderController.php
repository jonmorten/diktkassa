<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Validator;

class BookOrderController extends Controller
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

	public function formSubmit(Request $request)
	{
		$validator = Validator::make(
			$request->all(),
			$this->formRules,
			$this->formMessages
		);

		$formFieldsInput = $request->only('name', 'phone', 'email', 'address', 'postal_area', 'zip', 'other');

		if ($validator->fails()) {
			return redirect()
				->route('bookOrderForm')
				->withInput($formFieldsInput)
				->withErrors($validator, 'bookOrderForm');
		}

		$request->session()->set('bookOrder', $formFieldsInput);

		return redirect()->route('bookOrderConfirm');
	}

	public function confirmSubmit(Request $request)
	{
		$session = $request->session();

		$bookOrder = $session->get('bookOrder', false);
		if (empty($bookOrder)) {
			return redirect()->route('bookOrderForm');
		}

		$action = $request->input('action');
		if ($action === 'cancel') {
			return redirect()
				->route('bookOrderForm')
				->withInput($bookOrder);
		}

		$bookOrder = array_map('htmlentities', $bookOrder);
		$bookOrder = array_map('nl2br', $bookOrder);
		$emailData = ['time' => date('Y.m.d H:i', time())] + $bookOrder;

		$customerName = $bookOrder['name'];
		$customerEmail = $bookOrder['email'];

		// Send mail to customer
		Mail::send('emails.bookOrder', $emailData, function($message) use ($customerName, $customerEmail)
		{
			$message
				->subject('Bekreftelse på din bestilling fra Diktkassa')
				->from($_ENV['order_email'], 'Diktkassa')
				->to($customerEmail, $customerName);
		});

		// Send mail to us
		Mail::send('emails.bookOrder', $emailData, function($message)
		{
			$message
				->subject('Bestilling')
				->from($_ENV['order_email'], 'Diktkassa')
				->to($_ENV['order_email'], 'Diktkassa');
		});

		$session->forget('bookOrder');

		return redirect()->route('frontpage')->with('message', 'Oi - hva har hendt? <br> Jo: din bestilling er sendt!');
	}

}
