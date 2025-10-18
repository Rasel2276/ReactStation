<h1>Welcome, Vendor {{ auth('vendor')->user()->name }}</h1>
<form method="POST" action="{{ route('admin.logout') }}">@csrf <button>Logout</button></form>
