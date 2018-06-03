@extends('templates.template')
@section('content')
  <div class="container">
    <h1>{{ $user->name }}'s Profile</h1>
    <p>See what {{ $user->name }} has been upto</p>
    <hr>
    <div class="row">
      <div class="col-md-6">
        <h3>Questions</h3>
        @foreach($user->questions as $question)
          <div class="panel panel-default">
            <div class="panel-body">
              <h4> {{ $question->title }}</h4>
              <p>{{ $question->description }}</p>
            </div>
            <div class="panel-footer">
              <a href="{{ route('questions.show',$question->id) }}" class="btn btn-link">View Question</a>
            </div>
          </div>

        @endforeach
      </div>
      <div class="col-md-6">
        <h3>Answers</h3>
        @php($i = 0)
        @foreach($user->answers as $answer)
          @php($i++)
          <div class="panel panel-default">
            <div class="panel-heading">
              {{ $answer->question->title }}
            </div>
            <div class="panel-body">
              <h4> Answer {{ $i }}</h4>
              <p>{{ $answer->content }}</p>
            </div>
            <div class="panel-footer">
              <a href="{{ route('questions.show',$answer->question->id) }}" class="btn btn-link">View Question answered</a>
            </div>
          </div>

        @endforeach
      </div>

    </div>
  </div>

@endsection
