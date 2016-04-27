<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;

class PageController extends Controller
{

	public function pageFrontpage(Request $request)
	{
		$session = $request->session();
		$contentData = [
			'message' => $session->get('message', false),
			'poemTitle' => $session->get('poemTitle', false),
			'poemText' => $session->get('poemText', false),
		];
		$frameData = [
			'poemCount' => PoemController::getPoemCount(),
			'showBookBanner' => true,
			'showAboutUsText' => true,
		];
		return view('frame', $frameData)->nest('content', 'page/frontpage', $contentData);
	}

	public function pageRandomPoem(Request $request, $mode = 'alle')
	{
		switch ($mode) {
			case 'siste':
				$poem = PoemController::getRandomPoemLatest($request);
				break;

			case 'beste':
				$poem = PoemController::getRandomPoemHighestRated($request);
				break;

			default:
				$poem = PoemController::getRandomPoemAll($request);
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

		return view('frame', $frameData)->nest('content', 'page/randomPoem', $contentData);
	}

	public function pageBookOrderForm(Request $request)
	{
		$contentData = [
			'bookOrder' => $request->session()->get('bookOrder', false),
		];
		$frameData = [
			'poemCount' => PoemController::getPoemCount(),
		];

		return view('frame', $frameData)->nest('content', 'page/bookOrderForm', $contentData);
	}

	public function pageBookOrderConfirm(Request $request)
	{
		$bookOrder = $request->session()->get('bookOrder', false);
		if (empty($bookOrder)) {
			return redirect()->route('bookOrderForm');
		}
		$bookOrder = array_map('htmlentities', $bookOrder);
		$bookOrder = array_map('nl2br', $bookOrder);

		$contentData = [
			'bookOrder' => $bookOrder,
		];
		$frameData = [
			'poemCount' => PoemController::getPoemCount(),
		];
		return view('frame', $frameData)->nest('content', 'page/bookOrderConfirm', $contentData);
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
				'ogImage' => !empty($music['ogImage']) ? $music['ogImage'] : false,
			];
			return view('frame', $frameData)->nest('content', 'page/musicStream', $contentData);
		} else {
			$songs = Music::all();
			$contentData = [
				'songs' => $songs,
			];
			$frameData = [
				'poemCount' => PoemController::getPoemCount(),
			];
			return view('frame', $frameData)->nest('content', 'page/musicList', $contentData);
		}
	}

}
