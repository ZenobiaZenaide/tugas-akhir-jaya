<ul class="account-nav">
    <li><a href="{{ route('user.orders')}}" class="menu-link menu-link_us-s">Orders</a></li>
    <form method="POST" action="{{route('logout')}}" id="logout-form">
        <li>
            @csrf
            <a href="{{ route('logout') }}" class="menu-link menu-link_us-s" onclick="
             event.preventDefault();document.getElementById('logout-form').submit();
             ">Logout
            </a>
        </li>
    </form>
  </ul>
