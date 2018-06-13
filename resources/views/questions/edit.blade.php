@extends ('templates.template')
@section('content');
<div class="container">
  <h1>Ask a Question</h1>
  <hr/>

  <form class="" action="{{ route('questions.update',$question->id) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <div class="form-group">
          <label for="title">Question</label>
          <input type="text" name="title" id="title" value="{{$question->title}}" class="form-control">
      </div>
      <div class="form-group">
          <label for="description">More information</label>
          <textarea name="description" id="description" class="form-control">{{trim($question->description)}}
          </textarea>
      </div>
      <input type="submit" class="btn btn-success" value="Update Question">


  </form>

</div>


@endsection;
