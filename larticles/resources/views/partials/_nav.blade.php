<div class="container example5">
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar5">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

      </div>
      <div id="navbar5" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-left">

          <li><a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
          <li><a class="nav-link {{ Request::is('straat') ? 'active' : '' || Request::is('street') ? 'active' : ''}}" href="{{ route('straat') }}">Straatnamen</a></li>
          <li><a class="nav-link {{ Request::is('personen') ? 'active' : '' }}" href="{{ route('personen') }}">Persoon</a></li>
          <li><a class="nav-link {{ Request::is('antwerpen') ? 'active' : '' }}" href="{{ route('antwerpen') }}">Antwerpen</a></li>
          <li><a class="nav-link {{ Request::is('gemeente') ? 'active' : '' }}" href="{{ route('gemeente') }}">Gemeente</a></li>
          <li><a class="" href="">About</a></li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
  </nav>

</div>