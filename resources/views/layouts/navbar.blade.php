<nav class="navbar  navbar-expand-sm navbar-dark bg-dark orange">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Shortener</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse  d-flex justify-content-end" id="navbarCollapse">
      <ul class="navbar-nav ">
        
        @guest
        <li class="nav-item"> <a class="nav-link" href="{{route('login')}}">Login</a></li>
        <li class="nav-item"> <a class="nav-link" href="{{route('register')}}">Register</a></li>
        @endguest
        
        @auth
        <li class="nav-item"> <a class="nav-link" href="/">{{ auth()->user()->name}}</a></li>
        <li class="nav-item"> <a onclick="document.getElementById('logout').submit()" class="nav-link" href="#">Logout</a></li>
        <form id="logout" action="{{route('logout')}}" method="post">
          @csrf
        </form>
         @endauth
        
      </ul>
    </div>
  </div>
</nav>