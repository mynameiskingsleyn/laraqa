@extends ('templates.template')
@section('content');
<div class="container">
  <h1>Ask a Question</h1>
  <hr/>

  <form class="" action="{{ route('questions.store') }}" method="post">
      {{csrf_field()}}
      <div class="form-group">
          <label for="title">Question</label>
          <input type="text" name="title" id="title" value="" class="form-control">
      </div>
      <div class="form-group">
          <label for="description">More information</label>
          <textarea name="description" id="description" value="" class="form-control"></textarea>
      </div>
      <input type="submit" class="btn btn-success" value="Submit Question">


  </form>

</div>


@endsection;
