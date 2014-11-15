<?php

class DashboardController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = DB::table('users')
			->select(DB::raw('count(questions.id) as question_count, count(answers.id) as answer_count, users.id, users.fullname, users.credits'))
			->leftJoin('questions', 'questions.asker_id', '=', 'users.id')
			->leftJoin('answers', 'answers.question_id', '=', 'questions.id')
			->where('users.id', Auth::user()->id)
			->groupBy('users.id')
			->groupBy('users.fullname')
			->groupBy('users.credits')
			->first();
		
		return View::make('dashboard.index')->withUser( $user );
	}

	// Like index(), but for Expert
	public function expertIndex()
	{
		// Get expert's expertise
		$expert = Expert::where('user_id', '=', Auth::id())
			->select('id', 'category_id')
			->first();
		;

		// Get question that need his expertise
		$questions = DB::table('questions')
			->select(DB::raw('count(answers.id) as answer_count, questions.id, questions.question, questions.category_id, categories.category_name, answers.updated_at as answer_updated_at'))
			->join('categories', 'categories.id', '=', 'questions.category_id')
			->leftJoin('answers', 'answers.question_id', '=', 'questions.id')
			
			->where('questions.published', 1)
			->where('category_id', '=', $expert->category_id)
			->orWhere('specific_expert_id', '=', $expert->id)

			->orderBy('questions.updated_at', 'desc')
			->groupBy('questions.id')
			->groupBy('questions.question')
			->groupBy('questions.category_id')
			->groupBy('categories.category_alias')
			->groupBy('categories.category_name')
			->groupBy('answers.updated_at')
			->get();
		
		return View::make('dashboard.expert.index')
			->withUser( Auth::user() )
			->with('questions', $questions)
		;
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


}
