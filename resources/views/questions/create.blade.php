@extends ('templates.template')
@section('content');
<div class="container">
  <h1>Ask a Question</h1>
  <hr/>
  <form class="" action="{{ route('questions.store') }}" method="post">
    @include ('_includes._form',[
      'submitButtonText' => 'Submit Question',
      'question' => new LaraQA\Question
    ])
  </form>
</div>


@endsection;
