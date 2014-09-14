<?php

class PageController extends BaseController
{

	public function pageFrontpage()
	{
		$data = [
			'message' => Session::get('message', false),
			'poemTitle' => Session::get('poemTitle', false),
			'poemText' => Session::get('poemText', false),
		];
		return View::make('frame', array('poemCount' => PoemController::getPoemCount()))->nest('content', 'page/frontpage', $data);
	}

	public function pageRandomPoem($mode = 'alle')
	{
		switch ($mode) {
			case 'nyeste':
				$poem = PoemController::getRandomPoemLatest();
				break;

			case 'beste':
				$poem = PoemController::getRandomPoemHighestRated();
				break;

			default:
				$poem = PoemController::getRandomPoemAll();
				break;
		}

		$data = [
			'poem' => $poem,
			'mode' => $mode,
		];

		return View::make('frame', array('poemCount' => PoemController::getPoemCount()))->nest('content', 'page/randomPoem', $data);
	}

}
