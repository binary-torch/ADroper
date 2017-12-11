<!-- navbar -->
<nav class="navbar navbar-static-top {{ isset($theme) ?  $theme : "" }} navbar-absolute navbar-transparent" style="box-shadow: none;">
    <div class="container"
         data-aos="fade-in"
         data-aos-duration="600"
         data-aos-once="true">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"><span><img height="100%" src="@image(logo.svg)" alt="binary torch logo"></span></a>

        </div>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="#" class="btn btn-simple btn-compact">
                        How to use?
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(auth()->check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle btn {{ isset($theme) ?  "" : "btn-white" }}" data-toggle="dropdown">{{ auth()->user()->name }} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('portal.index') }}">
                                    <i class="material-icons">important_devices</i>
                                    Portal
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">
                                    <i class="material-icons">power_settings_new</i>
                                    Logout
                                </a>
                                <form id="logout-form"
                                      action="{{ route('logout') }}"
                                      method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="{{ route('portal.index') }}" class="btn btn-outline {{ isset($theme) ?  "btn-rose" : "btn-white" }} btn-compact">
                            Student Portal
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<!-- end navbar -->