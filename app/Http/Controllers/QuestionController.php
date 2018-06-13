<?php

namespace LaraQA\Http\Controllers;

use Illuminate\Http\Request;
use LaraQA\Question;
use Auth;
use Session;
class QuestionController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //listing of our questions..
        // go to the model and get a group of record.
          $questions = Question::OrderBy('id','desc')->paginate(5);
        // return view and pass a group of records
          return view('questions.index')->with('questions',$questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the form data..
        $this->validate($request,[
          'title' => 'required|max:255|min:5',
          'description'=> 'max:2000'
        ]);
        // process the data and submit.
        $question = new Question();
        $question->title = $request->title;
        $question->description = $request->description;
        $question->user()->associate(Auth::id());

        // if success redirect..
        if($question->save()){
          return redirect()->route('questions.show',$question->id);
        }else{
          return redirect()->route('questions.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Use the model to get one record from the data base..
        $question = Question::findOrFail($id);
         //$answers = $question->answers();

         $user_id = Auth::id();
        // show the view and pass the question to the view...
        return view('questions.show')->with(['question'=>$question,'user_id'=>$user_id]);

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
        $question = Question::findOrFail($id);
        if($question->user->id != Auth::id()){
          return abort(404,"Permision not allowed");
        }
        return view('questions.edit')->with('question',$question);
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
        // Validate the database
      //  return redirect()->route('questions.index');
       $this->validate($request,[
          'title' => 'required|max:255',
          'description' =>'required'
        ]);

        // save the data to the database
         $question = Question::findOrFail($id);
         $question->title = $request->title;
         $question->description = $request->description;
      /*   if($question->user->id != Auth::id()){
           return abort(403);
         }
*/
         $question->save();
        // set flash data with success message
        Session::flash('success','Question updated');

        // redirect with flash data to question.show.

        return redirect()->route('questions.show',$question->id);
        //return redirect()->route('questions.index');
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
