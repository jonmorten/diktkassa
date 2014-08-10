<?php

class PoemController extends BaseController
{

	public function formSubmit()
	{
		$poemTitle = Input::get('poem_title', '');
		$poemText = Input::get('poem_text', '');

		if ( (boolean) $poemTitle && (boolean) $poemText ) {
			$data = [
				'title' => htmlentities($poemTitle),
				'text' => preg_replace('/\r\n|\r|\n/', '<br>', htmlentities($poemText)),
			];

			Mail::send('emails.poem', $data, function($message)
			{
				$message
					->subject('Dikt')
					->from($_ENV['poem_email'], 'Diktkassa')
					->to($_ENV['poem_email'], 'Diktkassa');
			});

			return Redirect::route('frontpage')->with('message', 'Oi! <br> Hva har hendt? <br> Jo! <br> Ditt dikt er sendt');
		}

		return Redirect::route('frontpage')->withInput(Input::only('poem_title', 'poem_text'));
	}

}
