<!doctype html>
<html>
<body>
<h2>Admin Login</h2>
<form method="POST" action="{{ route('admin.login') }}">
  @csrf
  <input name="email" value="{{ old('email') }}" placeholder="Email" required>
  <input name="password" type="password" placeholder="Password" required>
  <label><input type="checkbox" name="remember"> Remember</label>
  <button type="submit">Login</button>
</form>
@if($errors->any()) <div>{{ $errors->first() }}</div> @endif
</body>
</html>
