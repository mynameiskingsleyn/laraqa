<nav class="navbar navbar-inverse">
    <div class="container-fluid">
     <div class="navbar-header">
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"
       arial-expanded="false">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </button>
       <a class="navbar-brand" href="/">Laravel Answers</a>
     </div>
     <div class="collapse navbar-collapse" id="myNavbar">
       <ul class="nav navbar-nav">
         <li class="active"><a href="{{ route('index') }}">Home</a></li>
         <li><a href="{{ route('questions.index') }}">Recent</a></li>
         <li><a href="#">Popular</a></li>
       </ul>
       <ul class="nav navbar-nav navbar-right">
         <a href="{{ route('questions.create') }}" class="btn btn-primary" style="margin-top:5px;float:left;">Ask A Question</a>
         @guest
             <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
             <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
         @else
             <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                     {{ Auth::user()->name }} <span class="caret"></span>
                 </a>

                 <ul class="dropdown-menu">
                     <li>
                         <a href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                             Logout
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             {{ csrf_field() }}
                         </form>
                     </li>
                 </ul>
             </li>
         @endguest

       </ul>

     </div>
    </div>
</nav>
