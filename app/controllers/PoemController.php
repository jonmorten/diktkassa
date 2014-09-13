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

	public static function getRandomPoem()
	{
		//	To avoid getting the same poems repeatedly, store the last viewed
		//	poems in session and exclude them from the random pool.
		$poemTableName = with(new Poem)->getTable();
		$allPoemIds = DB::table($poemTableName)->lists('id');
		$viewedPoemTrailLength = min(20, max(0, count($allPoemIds) - 1));
		$lastViewedPoemIds = array_slice(Session::get('last_viewed_poem_ids', []), 0, $viewedPoemTrailLength);
		$randomPoemIdsPool = array_values(array_diff($allPoemIds, $lastViewedPoemIds));
		$randomPoemPoolIndex = mt_rand(0,max(0, count($randomPoemIdsPool) - 1));
		$randomPoemId = $randomPoemIdsPool[$randomPoemPoolIndex];
		array_unshift($lastViewedPoemIds, $randomPoemId);
		Session::set('last_viewed_poem_ids', $lastViewedPoemIds);

		$randomPoem = Poem::find($randomPoemId);
		$randomPoem['text'] = preg_replace('/\r\n|\r|\n/', '<br>', $randomPoem['text']);
		return $randomPoem;
	}

	public static function getLatestPoem()
	{
		$poems = Poem::orderBy('created_at', 'dec')->take(10)->get();
		foreach ($poems as $poem) {
			$allPoemIds[] = $poem->id;
		}
		$lastViewedPoemIds = Session::get('last_viewed_latest_poem_ids', []);
		if ( sizeof($lastViewedPoemIds) > 9 ) {
			Session::set('last_viewed_latest_poem_ids', []);
			$lastViewedPoemIds = [];
		}
		$randomPoemIdsPool = array_diff($allPoemIds, $lastViewedPoemIds);
		$randomPoemPoolIndex = array_rand($randomPoemIdsPool);
		$randomPoemId = $randomPoemIdsPool[$randomPoemPoolIndex];
		array_unshift($lastViewedPoemIds, $randomPoemId);
		if ( empty($lastViewedPoemIds) ) {
			$lastViewedPoemIds = array($randomPoemId);
		}
		Session::set('last_viewed_latest_poem_ids', $lastViewedPoemIds);

		$randomPoem = Poem::find($randomPoemId);
		$randomPoem['text'] = preg_replace('/\r\n|\r|\n/', '<br>', $randomPoem['text']);
		return $randomPoem;
	}

	public static function getPoemCount()
	{
		return Poem::count();
	}

}
