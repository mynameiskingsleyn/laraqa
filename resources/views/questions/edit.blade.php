@extends ('templates.template')
@section('content');
<div class="container">
  <h1>Ask a Question</h1>
  <hr/>

  <form class="" action="{{ route('questions.update',$question->id) }}" method="POST">
      {{ method_field('PUT') }}
      @include ('_includes._form',[
        'submitButtonText' => 'Update Question'
      ])


  </form>

</div>


@endsection;
