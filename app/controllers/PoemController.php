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

	protected static function getViewFriendlyPoem($poemId)
	{
		$poem = Poem::find($poemId);
		$poem['text'] = preg_replace('/\r\n|\r|\n/', '<br>', $poem['text']);
		return $poem;
	}

	protected static function getRandomPoem($randomMode, array $poemIds)
	{
		//	To avoid getting the same poems repeatedly, store the last viewed
		//	poems in session and exclude them from the random pool.
		$sessionPoemTrailKey = 'last_viewed_poem_ids_' . $randomMode;
		$viewedPoemTrailLength = min(20, max(0, count($poemIds) - 1));
		$lastViewedPoemIds = array_slice(Session::get($sessionPoemTrailKey, []), 0, $viewedPoemTrailLength);
		$randomPoemIdsPool = array_values(array_diff($poemIds, $lastViewedPoemIds));
		$randomPoemPoolIndex = mt_rand(0,max(0, count($randomPoemIdsPool) - 1));
		$randomPoemId = $randomPoemIdsPool[$randomPoemPoolIndex];
		array_unshift($lastViewedPoemIds, $randomPoemId);
		Session::set($sessionPoemTrailKey, $lastViewedPoemIds);

		return self::getViewFriendlyPoem($randomPoemId);
	}

	public static function getRandomPoemAll()
	{
		$poemTableName = with(new Poem)->getTable();
		$allPoemIds = DB
			::table($poemTableName)
			->lists('id');
		return self::getRandomPoem('all', $allPoemIds);
	}

	public static function getRandomPoemLatest()
	{
		$poemTableName = with(new Poem)->getTable();
		$poemIds = DB
			::table($poemTableName)
			->orderBy('created_at', 'desc')
			->take(10)
			->lists('id');
		return self::getRandomPoem('latest', $poemIds);
	}

	public static function getPoemCount()
	{
		return Poem::count();
	}

}
