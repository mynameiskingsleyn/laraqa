@extends('templates.template')
@section('title','edit')
@section('content')
<div class="well">
  <form class="" action="/answers/{{ $answer->id }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">
    <input class = "form-control" type="text" name="content" value="{{ $answer->content}}">
    <button type="submit" name="button" class="btn btn-success">Save</button>
  </form>
</div>


@endsection
