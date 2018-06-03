<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use Auth;
class AnswersController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validate
        $this->validate($request, [
          'content'=>"required|min:10|max:1000",
          'question_id' => "required|integer"
        ]);
        // save to database
        $answer = new Answer();
        $answer->content = $request->content;
        $answer->user()->associate(Auth::id());
        //$answer->question_id = $request->question_id;
        $question = Question::findOrFail($request->question_id);
        $result = $question->answers()->save($answer);
        return redirect()->route('questions.show',$question->id);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $answer = Answer::findOrFail($id);
        return view('answers.edit')->with('answer',$answer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
          'content'=>"required|min:10|max:1000",
        ]);
        //
        $answer = Answer::findOrFail($id);
        $answer->content = $request->content;
        $answer->update();
        $question = Question::findOrFail($answer->question_id);
      //  var_dump($question); die();
        //return redirect()->route('questions.show',$question); */
        return redirect()->route('questions.index');
        //return back()->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
