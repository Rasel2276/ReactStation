<h1>Welcome, Customer {{ auth('customer')->user()->name }}</h1>
<form method="POST" action="{{ route('admin.logout') }}">@csrf <button>Logout</button></form>
