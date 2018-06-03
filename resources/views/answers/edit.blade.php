@extends('templates.template')
@section('title','edit')
@section('content')
<div class="well">
  <form class="" action="{{ route('answers.update',$answer->id) }}" method="put">
    {{ csrf_field() }}
    <input class = "form-control" type="text" name="content" value="{{ $answer->content}}">
    <button type="submit" name="button" class="btn btn-success">Save</button>
  </form>
</div>


@endsection
