<?php

class PoemController extends BaseController
{

	protected $formRules = [
		'user_name' => 'honeypot',
		'user_time' => 'required|honeytime:2',
		'poem_title' => 'required',
		'poem_text' => 'required',
	];

	protected $formMessages = [
		'honeypot' => 'Vi tror du er en robot',
		'user_time.honeytime' => 'Vi tror du er en robot',
		'poem_title.required' => 'Diktet må ha en tittel',
		'poem_text.required' => 'Diktet må ha en tekst',
	];

	public function formSubmit()
	{
		$validator = Validator::make(
			Input::all(),
			$this->formRules,
			$this->formMessages
		);

		if ($validator->fails()) {
			return Redirect::route('frontpage')
				->withInput(Input::only('poem_title', 'poem_text'))
				->withErrors($validator, 'poem');
		}

		$poemTitle = htmlentities(Input::get('poem_title'));
		$poemText = htmlentities(Input::get('poem_text'));

		$poem = new Poem();
		$poem->title = $poemTitle;
		$poem->text = $poemText;
		$poem->save();

		$emailData = [
			'title' => $poemTitle,
			'text' => preg_replace('/\r\n|\r|\n/', '<br>', $poemText),
		];
		Mail::send('emails.poem', $emailData, function($message)
		{
			$message
				->subject('Dikt')
				->from($_ENV['poem_email'], 'Diktkassa')
				->to($_ENV['poem_email'], 'Diktkassa');
		});

		return Redirect::route('frontpage')->with('message', 'Oi - hva har hendt? <br> Jo: ditt dikt er sendt!');
	}

}
