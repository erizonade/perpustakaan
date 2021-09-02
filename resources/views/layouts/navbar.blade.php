<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Perpustakaan</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item {{ !empty($activeTab) && $activeTab == 'data-dashboard' ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/admin/') }}">Home <span class="sr-only">(current)</span></a>
        </li>
        @switch(Session::get('user')['role'])
            @case('A')
              <li class="nav-item {{ !empty($activeTab) && $activeTab == 'data-creator_book' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/admin/creator_book') }}">Creator Books</a>
              </li>
              </li>
              <li class="nav-item {{ !empty($activeTab) && $activeTab == 'data-book' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/admin/book') }}">Books</a>
              </li>
              </li>
              <li class="nav-item {{ !empty($activeTab) && $activeTab == 'data-user' ? 'active' : '' }}">
                <a class="nav-link" href="{{  url('/admin/user') }}">Users</a>
              </li>
                @break
            @case('G')
                
                @break
            @default
                
        @endswitch
        
      </ul>
        <ul class="navbar-nav my-2 my-lg-0">
          <li class="nav-item {{ !empty($activeTab) && $activeTab == 'data-profil' ? 'active' : '' }}">
            <a  class="nav-link" href="{{ url('/profil') }}">Profil</a>
          </li>
          <li class="nav-item">
            <a  class="nav-link" href="{{ url('/logout') }}">Logout</a>
          </li>
      </ul>
    </div>
</nav>