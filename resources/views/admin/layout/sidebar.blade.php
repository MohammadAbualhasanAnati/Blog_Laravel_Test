@section('sidebar')
    <div id="sidebar_wrapper">
        <nav id="sidebar" class='animated bounceInDown bg-dark'>
            <ul>
                <li style="padding: 10px;">Welcome, </li>
                <li><a href='/admin/users'>Users</a></li>
                <li class='sub-menu'><a href='#posts'>Posts<div class='fa fa-caret-down right'></div></a>
                    <ul>
                        <li><a href='/posts'>All</a></li>
                        <li><a href='/posts/publish'>publish</a></li>
                    </ul>
                </li>
                <li>
                    <a id="logoutBtn" href='#logout'>Logout</a>
                    <form id="logoutForm" method="POST" action="/logout"></form>
                </li>
            </ul>
        </nav>
    </div>
@show
