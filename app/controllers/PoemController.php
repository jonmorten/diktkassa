<?php

class PoemController extends BaseController
{

	protected $formRules = [
		'poem_title' => 'required',
		'poem_text' => 'required',
	];

	protected $formMessages = [
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

		$poemText = htmlentities(Input::get('poem_text'));
		$data = [
			'title' => htmlentities(Input::get('poem_title')),
			'text' => preg_replace('/\r\n|\r|\n/', '<br>', $poemText),
		];

		Mail::send('emails.poem', $data, function($message)
		{
			$message
				->subject('Dikt')
				->from($_ENV['poem_email'], 'Diktkassa')
				->to($_ENV['poem_email'], 'Diktkassa');
		});

		return Redirect::route('frontpage')->with('message', 'Oi - hva har hendt? <br> Jo: ditt dikt er sendt!');
	}

}
