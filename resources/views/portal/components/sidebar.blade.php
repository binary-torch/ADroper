<div class="sidebar" data-active-color="blue" data-background-color="black" data-image="@image(sidebar.jpg)">
    <div class="logo">
        <a href="{{ route('home') }}" class="simple-text">
            Binary Torch
        </a>
    </div>
    <div class="logo logo-mini">
        <a href="{{ route('home') }}" class="simple-text">
            BT
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="@yield('dashboard-active')">
                <a href="{{ route('portal.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            {{--<li class="@yield('workshops-active')">--}}
                {{--<a href="{{ route('portal.workshops') }}">--}}
                    {{--<i class="material-icons">work</i>--}}
                    {{--<p>Workshops</p>--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>
    </div>
</div>