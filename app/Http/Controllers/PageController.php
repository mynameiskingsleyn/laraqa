<?php
namespace App\Http\Controllers;
use App\User;
class PageController extends Controller
{
  public function index(){
    return view("pages.index");

  }
  public function about(){
    return "About us Page";
  }
  public function profile($id){
    // get the user info..
    $user = User::with(['questions','answers','answer.question'])->findOrFail($id);
    return view('pages.profile')->with('user',$user);
  }

}



?>
