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

	public function pageRandomPoem( $mode = 'random' )
	{
		switch ( $mode ) {
			case 'nyeste':
				$poem = PoemController::getLatestPoem();
				break;

			default:
				$poem = PoemController::getRandomPoem();
				break;
		}

		$data = [
			'poem' => $poem,
			'mode' => $mode,
		];

		return View::make('frame', array('poemCount' => PoemController::getPoemCount()))->nest('content', 'page/randomPoem', $data);
	}

}
