@section('sidebar')
    <div id="sidebar_wrapper">
        <nav id="sidebar" class='animated bounceInDown bg-dark'>
            <ul>
                <li style="padding: 10px;">Welcome, {{ Auth::user() !== null ? Auth::user()->first_name : 'Guest' }}</li>
                @if (Auth::user() !== null && Auth::user()->role == 'admin')
                    <li><a href='/admin/users'><i class="fa fa-users"></i>&nbsp;Users</a></li>
                @endif
                <li class='sub-menu'><a href='#posts'>Posts<div class='fa fa-caret-down right'></div></a>
                    <ul>
                        <li><a href='/posts'>View All</a></li>
                        @if (Auth::user() !== null && (Auth::user()->role == 'admin' || Auth::user()->role == 'writer'))
                            <li><a href='/posts/add'>Add Post</a></li>
                        @endif
                    </ul>
                </li>
                <li>
                    @if (Auth::user() !== null)
                        <a id="logoutBtn" href='#'><i class="fa fa-sign-out"></i>&nbsp; Log Out</a>
                        <form id="logoutForm" method="POST" action="/auth/logout">
                            @csrf

                        </form>
                    @else
                        <a href='/auth/login'><i class="fa fa-sign-in"></i>&nbsp; Log In</a>
                    @endif
                </li>
            </ul>
        </nav>
    </div>
@show
