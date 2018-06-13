<?php

namespace LaraQA\Http\Controllers;

use Illuminate\Http\Request;
use LaraQA\Answer;
use LaraQA\Question;
use Auth;
use Session;
use LaraQA\Notifications\NewAnswerSubmitted;
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
        Session::flash('success', 'Answer has been saved');
        // trigger notification..
        $question->user->notify(new NewAnswerSubmitted($question,$answer,Auth::user()->name));
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
        // get the answer
        $answer = Answer::findOrFail($id);
        $answer->content = $request->content;
        if(Auth::id() == $answer->user_id){
          $answer->save();
          Session::flash('success', 'Answer has been Updated');
        }else{
          Session::flash('not_success', 'You do not have permision to delete this answer');
        }
        // save the answer

        $qid = $answer->question_id;

        // return redirect
        return redirect()->route('questions.show',$qid);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find the answer
        $answer = Answer::findOrFail($id);

        $qid = $answer->question_id;
        if($answer->user_id == Auth::id()){
          $answer->delete();
          Session::flash('success','Answer has been deleted');
        }else{
          Session::flash('not_success','You do not have permision to delete this answer');
        }

        return redirect()->route('questions.show',$qid);

    }
}
