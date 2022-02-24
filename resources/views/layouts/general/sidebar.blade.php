@section('sidebar')
    <div id="sidebar_wrapper">
        <nav id="sidebar" class='animated bounceInDown bg-dark'>
            <ul>
                <li style="padding: 10px;">Welcome, </li>
                <li><a href='/admin/users'><i class="fa fa-users"></i>&nbsp;Users</a></li>
                <li class='sub-menu'><a href='#posts'>Posts<div class='fa fa-caret-down right'></div></a>
                    <ul>
                        <li><a href='/posts'>View All</a></li>
                        <li><a href='/posts/add'>Add Post</a></li>
                    </ul>
                </li>
                <li>
                    <a id="logoutBtn" href='#'><i class="fa fa-sign-out"></i>&nbsp; Logout</a>
                    <form id="logoutForm" method="POST" action="/auth/logout">
                        @csrf
                        
                    </form>
                </li>
            </ul>
        </nav>
    </div>
@show
