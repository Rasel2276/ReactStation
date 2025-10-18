<!doctype html>
<html>
<body>
<h2>Vendor Register</h2>
<form method="POST" action="{{ route('vendor.register') }}">
  @csrf
  <input name="name" value="{{ old('name') }}" placeholder="Name" required>
  <input name="email" value="{{ old('email') }}" placeholder="Email" required>
  <input name="company_name" value="{{ old('company_name') }}" placeholder="Company (optional)">
  <input name="password" type="password" placeholder="Password" required>
  <input name="password_confirmation" type="password" placeholder="Confirm Password" required>
  <button type="submit">Register</button>
</form>
@if($errors->any()) <div>{{ $errors->first() }}</div> @endif
</body>
</html>
