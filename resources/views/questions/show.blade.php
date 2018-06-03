@extends('templates.template')
@section('title',$question->title)
@section('content')
  <div class="container">
    <h1> {{$question->title}}</h1>
    <p class="lead">
      {{$question->description}} <br>
      @if($question->user->id == $user_id)
        <a href="{{ route('questions.edit',$question->id)}}"><button>Edit</button></a>
      @endif
    </p>
    <p>
      Submitted By: {{ $question->user->name}} on {{ $question->created_at->diffForHumans() }}
    </p>

    <hr/>
    <!-- display all of the answers for the question -->
    @if($question->answers()->count() > 0)
      @foreach($question->answers as $answer)
        <div class="panel panel-default">
          <div class="panel-body">
            <p>
              {{ $answer->content }}
            </p>
            <h6>by: {{ $answer->user->name }} about {{ $answer->created_at->diffForHumans() }}</h6>
            @if($answer->user->id == $user_id)
              <a href="{{ route('answers.edit',$answer->id)}}"><button>Edit</button></a>
            @endif
          </div>
        </div>

      @endforeach
    @else
      <p>There are no answers to this question yet!</p>
    @endif
    <div class="well">
      <form class="" action="{{ route('answers.store') }}" method="post">
        {{ csrf_field()}}
        <h4>Submit your answer:</h4>
        <textarea class="form-control" name="content" rows="4" cols="4"></textarea>
        <input type="hidden" name="question_id" value="{{ $question->id }}">
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>

@endsection
