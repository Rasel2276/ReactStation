<h1>Welcome, Admin {{ auth('admin')->user()->name }}</h1>
<form method="POST" action="{{ route('admin.logout') }}">@csrf <button>Logout</button></form>
