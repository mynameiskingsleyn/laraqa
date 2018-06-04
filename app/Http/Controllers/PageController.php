<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Mail;
use App\Mail\ContactForm;
use Session;
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
  public function contact()
  {
    return view('pages.contact');
  }
  public function sendContact(Request $request)
  {
    $this->validate($request,
      ['name'=>'required',
       'email'=>'required|email',
       'subject' => 'required|min:3|max:100',
       'message'=>'required|min:10|max:500'
      ]);
      Mail::to('admin@example.com')->send(new ContactForm($request));
      Session::flash('success','Your email has been sent');
      return redirect()->route('contact');
  }

}



?>
