<?php

class PageController extends BaseController
{

	public function pageFrontpage()
	{
		$contentData = [
			'message' => Session::get('message', false),
			'poemTitle' => Session::get('poemTitle', false),
			'poemText' => Session::get('poemText', false),
		];
		$frameData = [
			'poemCount' => PoemController::getPoemCount(),
			'showBookBanner' => true,
			'showAboutUsText' => true,
		];
		return View::make('frame', $frameData)->nest('content', 'page/frontpage', $contentData);
	}

	public function pageRandomPoem($mode = 'alle')
	{
		switch ($mode) {
			case 'siste':
				$poem = PoemController::getRandomPoemLatest();
				break;

			case 'beste':
				$poem = PoemController::getRandomPoemHighestRated();
				break;

			default:
				$poem = PoemController::getRandomPoemAll();
				break;
		}

		$contentData = [
			'poem' => $poem,
			'mode' => $mode,
		];
		$frameData = [
			'poemCount' => PoemController::getPoemCount(),
			'showBookBanner' => true,
			'showAboutUsText' => true,
		];

		return View::make('frame', $frameData)->nest('content', 'page/randomPoem', $contentData);
	}

	public function pageBookOrderForm()
	{
		$contentData = [
			'bookOrder' => Session::get('bookOrder', false),
		];
		$frameData = [
			'poemCount' => PoemController::getPoemCount(),
		];

		return View::make('frame', $frameData)->nest('content', 'page/bookOrderForm', $contentData);
	}

	public function pageBookOrderConfirm()
	{
		$bookOrder = Session::get('bookOrder', false);
		if (empty($bookOrder)) {
			return Redirect::route('bookOrderForm');
		}
		$bookOrder = array_map('htmlentities', $bookOrder);
		$bookOrder = array_map('nl2br', $bookOrder);

		$contentData = [
			'bookOrder' => $bookOrder,
		];
		$frameData = [
			'poemCount' => PoemController::getPoemCount(),
		];
		return View::make('frame', $frameData)->nest('content', 'page/bookOrderConfirm', $contentData);
	}

	public function pageMusicStream($poem = false)
	{
		if ($poem) {
			$music = Music::where('urlalias', $poem)->firstOrFail();

			$poem = PoemController::getViewFriendlyPoem($music['poemid']);

			$music = '<a href="'.$music['songurl'].'" class="sc-player">'.$poem['title'].'</a>';
			$title = $poem['title'];
			$poem = $poem['text'];

			$contentData = [
				'music' => $music,
				'title' => $title,
				'poem' => $poem,
			];
			$frameData = [
				'poemCount' => PoemController::getPoemCount(),
			];
			return View::make('frame', $frameData)->nest('content', 'page/musicStream', $contentData);
		} else {
			$songs = Music::all();
			$contentData = [
				'songs' => $songs,
			];
			$frameData = [
				'poemCount' => PoemController::getPoemCount(),
			];
			return View::make('frame', $frameData)->nest('content', 'page/musicList', $contentData);
		}
	}

}
