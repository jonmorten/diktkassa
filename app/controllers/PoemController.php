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
		$poemRating = $randomPoem['rating'];
		$randomPoem['rating_markup_class_value'] = str_replace('.', '-', round($poemRating * 2) / 2);
		$randomPoem['rating_markup_display_value'] = str_replace('.', ',', round($poemRating * 2) / 2);
		$randomPoem['text'] = preg_replace('/\r\n|\r|\n/', '<br>', $randomPoem['text']);
		return $randomPoem;
	}

	public static function getPoemCount()
	{
		return Poem::count();
	}

	/**
	 * @param  numeric $poemId
	 * @param  string $fingerprint
	 * @return object
	 */
	public static function jsonGetPoemRateInfo($poemId = '', $fingerprint = '')
	{
		$poemId = Input::get('id', $poemId);
		$fingerprint = Input::get('fingerprint', $fingerprint);

		$url = '';
		$fingerprintIsUsed = false;
		$rating = null;
		if (ctype_digit($poemId) && trim($fingerprint) !== '') {
			$url = URL::route('jsonPostPoemRate', [], false);
			$fingerprintIsUsed = self::isFingerprintUsed($poemId, $fingerprint);
			if ($fingerprintIsUsed) {
				$rating = PoemRating
					::where('fingerprint', '=', $fingerprint)
					->where('poem_id', '=', $poemId)
					->first()
					->rating;
			}
		}
		return Response::json([
			'url' => $url,
			'has_rated' => $fingerprintIsUsed,
			'rating' => $rating,
		]);
	}

	/**
	 * @param  numeric $poemId
	 * @param  string $fingerprint
	 * @param  numeric $rating
	 * @return object
	 */
	public static function jsonPostPoemRate(
		$poemId = '',
		$fingerprint = '',
		$rating = ''
	)
	{
		$poemId = Input::get('id', $poemId);
		$fingerprint = Input::get('fingerprint', $fingerprint);
		$rating = Input::get('rating', $rating);

		$error = [];
		$success = [];

		if (
			ctype_digit($poemId)
			&& trim($fingerprint) !== ''
			&& is_numeric($rating)
		) {
			if (self::isFingerprintUsed($poemId, $fingerprint)) {
				$success[] = 'Poem rating was updated.';
				$poemRating = PoemRating
					::where('fingerprint', '=', $fingerprint)
					->where('poem_id', '=', $poemId)
					->first();
			} else {
				$success[] = 'Poem was rated.';
				$poemRating = new PoemRating();
				$poemRating->fingerprint = $fingerprint;
				$poemRating->poem_id = $poemId;
			}
			$poemRating->rating = $rating;
			$poemRating->save();
			$rating = self::updatePoemRating($poemId);
			$rating = str_replace('.', ',', floor($rating * 2) / 2);
		} else {
			$error[] = 'Invalid input.';
		}

		return Response::json([
			'error' => $error,
			'success' => $success,
			'rating' => $rating,
		]);
	}

	/**
	 * @param  numeric $poemId
	 * @param  string $fingerprint
	 * @return boolean
	 */
	protected static function isFingerprintUsed($poemId, $fingerprint)
	{
		$poemMatch = PoemRating
			::where('fingerprint', '=', $fingerprint)
			->where('poem_id', '=', $poemId)
			->count();
		return 0 !== $poemMatch;
	}

	/**
	 * @param  integer $poemId
	 * @return float
	 */
	protected static function updatePoemRating($poemId)
	{
		$rating = PoemRating
			::where('poem_id', '=', $poemId)
			->avg('rating');
		$poem = Poem
			::where('id', '=', $poemId)
			->first();
		$poem->rating = $rating;
		$poem->save();
		return $rating;
	}

}
