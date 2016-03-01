<?php

class HomeController extends AppController {


	public function showWelcome()
	{
		return View::make('hello');
	}

	/**
	 * @return mixed
     */
	public function getPostTypes()
	{
		return PostType::all();
	}

	public function getAllTags($keyword)
	{
		return Tag::where('name', 'LIKE', $keyword.'%')->get();
	}

}
