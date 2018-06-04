@extends('templates.template')

@section('content')
@include('_includes.messages')
<div class="container">
    <h1>Contact us</h1>
    <form class="" action="{{ route('contact') }}" method="post">
      {{ csrf_field() }}
      <!-- name of the sender -->
      <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" value="" class="form-control">
      </div>
      <!-- email of the sender -->
      <div class="form-group">
        <label for="name">Email</label>
        <input type="email" name="email" value="" class="form-control">
      </div>
      <!-- subject -->
      <div class="form-group">
        <label for="name">Subject</label>
        <input type="text" name="subject" value="" class="form-control">
      </div>
      <!-- message of the email -->
      <div class="form-group">
        <label for="name">Message</label>
        <textarea type="text" name="message" value="" class="form-control"> </textarea>
      </div>
      <input type="submit" class="btn btn-success lg-block" name="submit" value="Send Email">
    </form>
</div>
@endsection
