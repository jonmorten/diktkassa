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
		return View::make('frame')->nest('content', 'page/frontpage', $data);
	}

}
