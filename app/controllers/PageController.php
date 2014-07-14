<?php

class PageController extends BaseController
{

	public function pageFrontpage()
	{
		return View::make('frame')->nest('content', 'page/frontpage');
	}

}
