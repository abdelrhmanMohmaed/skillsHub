<div class="container">

    <div class="navbar-header">
        <!-- Logo -->
        <div class="navbar-brand">
            <a class="logo" href="{{ url('/') }}">
                <img src="{{ asset('web/img/logo.png') }}" alt="logo">
            </a>
        </div>
        <!-- /Logo -->

        <!-- Mobile toggle -->
        <button class="navbar-toggle">

            <span></span>
        </button>
        <!-- /Mobile toggle -->
    </div>

    <!-- Navigation -->
    <!-- Navigation --> 
    <nav class="navbar-collapse px-4 collapse" id="navbarSupportedContent" style="">
                      
        <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <ul class="main-menu nav navbar-nav navbar-right">
            <li class=""><a href="{{ url('/') }}">@lang('web.home')</a></li>
            <li class="" class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                    aria-expanded="false">@lang('web.cats') <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    @foreach ($cats as $cat)
                        <li class=""><a href="{{ url("categories/show/{$cat->id}") }}">
                                {{ $cat->name() }}
                            </a></li>
                    @endforeach
                </ul>
            </li>
            <li class=""><a href="{{ url('/contact') }}">@lang('web.contact')</a></li>
            @guest
                <li class=""><a href="{{ url('login') }}">@lang('web.signin')</a></li>
                <li class=""><a href="{{ url('register') }}">@lang('web.signup')</a></li>
            @endguest

            @auth
                <li class=""><a id="logout-link" href="#">@lang('web.signout')</a></li>

                @if (Auth::user()->role->name == 'student')
                    <li class=""><a href="{{ url('profile') }}">@lang('web.profile')</a></li>
                @else
                    <li class=""><a href="{{ url('/dashboard') }}">@lang('web.dashboard')</a></li>
                @endif

            @endauth
            @if (App::getLocale() == 'ar')
                <li class=""><a href="{{ url('lang/set/en') }}">EN</a></li>
            @else
                <li class=""><a href="{{ url('lang/set/ar') }}">ع</a></li>
            @endif

        </ul>
    </nav>
    <!-- /Navigation -->

    <!-- /Navigation -->

</div>
@section('scripts')

   
@endsection
