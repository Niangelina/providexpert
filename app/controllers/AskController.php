<?php

class AskController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// if user has not logged in
		if ( !Auth::check() )
		{			
			return Redirect::to("/login");
		}

		$arr_categories = Category::all();

		return View::make('ask.index')->withCategories( $arr_categories );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	// function to ask questions according to category
	public function ask_question( $category )
	{
		// if user has not logged in
		if ( !Auth::check() )
		{			
			return Redirect::to("/login");
		}

		$arr_category = Category::where('category_alias', $category)->first();
		$category_id = $arr_category->id;
		$arr_experts = Expert::where('category_id', $category_id)->get();

		$experts = array();
		$experts["0"] = "All Experts";

		foreach( $arr_experts as $expert )
		{
			$experts[$expert->id] = $expert->expert_name . ' ( '. ( $expert->expertises ) .' )';
		}

		return View::make('ask.question')->withCategory($arr_category)->withExperts($experts);
	}

	// function to show questions list of currently logged-in user
	public function question_list()
	{
		// if user has not logged in
		if ( !Auth::check() )
		{			
			return Redirect::to("/login");
		}

		return View::make('ask.list');
	}

	// function to show answer of a question ( in the form of ID )
	public function show_answer( $id )
	{
		// if user has not logged in
		if ( !Auth::check() )
		{			
			return Redirect::to("/login");
		}
		
		return View::make('ask.answer');
	}

}
