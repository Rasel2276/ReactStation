@extends('seller.layouts.layout')
@section('seller_page_title')
    Create Store
@endsection
@section('seller_layout')
    
    <style>
      /* আপনার দেওয়া সমস্ত CSS স্টাইল এখানে থাকবে */
      * { margin: 0; padding: 0; box-sizing: border-box; font-family: "Poppins", sans-serif; }
      body { background-color: #f5f6fa; }
      .form-container { background: #fff; width: 90%; max-width: 800px; margin: 40px auto; padding: 25px 40px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: all 0.3s ease; }
      h2 { text-align: center; color: #333; margin-bottom: 25px; }
      form { display: flex; flex-direction: column; gap: 15px; }
      .form-row { display: flex; flex-direction: column; gap: 5px; }
      .form-row label { font-weight: 500; color: #444; }
      .form-row input[type="text"], .form-row input[type="email"], .form-row input[type="file"], .form-row textarea { padding: 10px; border: 1px solid #ccc; border-radius: 8px; font-size: 15px; outline: none; width: 100%; transition: all 0.3s; background-color: #fafafa; }
      .form-row input[type="file"] { cursor: pointer; }
      .form-row input:focus, .form-row textarea:focus { border-color: #3c91e6; box-shadow: 0 0 5px rgba(60,145,230,0.3); background-color: #fff; }
      textarea { resize: none; height: 100px; }
      .btn-submit { background-color: #3c91e6; color: white; padding: 12px; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; width: 100%; margin-top: 10px; transition: background 0.3s ease; }
      .btn-submit:hover { background-color: #2c76c3; }
      .error-message { color: #e3342f; font-size: 0.9em; margin-top: 3px; }
      @media (max-width: 600px) { .form-row { flex-direction: column; } }
    </style>
</head>
<body>

  {{-- Optional: Display session messages (success/error) --}}
  @if (session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border: 1px solid #c3e6cb; border-radius: 5px; text-align: center; max-width: 800px; margin: 20px auto;">
        {{ session('success') }}
    </div>
  @endif
  @if (session('error'))
    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 5px; text-align: center; max-width: 800px; margin: 20px auto;">
        {{ session('error') }}
    </div>
  @endif

  <div class="form-container">
    <h2>Create Your Store</h2>
    {{-- Form Action points to the POST route for store creation --}}
    <form action="{{ route('store.store') }}" method="POST" enctype="multipart/form-data">
        @csrf {{-- CSRF protection token --}}

      <div class="form-row">
        <label for="store_name">Store Name <span style="color: red;">*</span></label>
        <input type="text" id="store_name" name="store_name" placeholder="Enter your store name" value="{{ old('store_name') }}" required>
        @error('store_name')
            <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-row">
        <label for="store_email">Store Email</label>
        <input type="email" id="store_email" name="store_email" placeholder="Enter your store email" value="{{ old('store_email') }}">
        @error('store_email')
            <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-row">
        <label for="store_phone">Store Phone</label>
        <input type="text" id="store_phone" name="store_phone" placeholder="Enter your store phone" value="{{ old('store_phone') }}">
        @error('store_phone')
            <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-row">
        <label for="store_logo">Store Logo <span style="color: red;">*</span></label>
        <input type="file" id="store_logo" name="store_logo" accept="image/*" required>
        @error('store_logo')
            <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-row">
        <label for="store_banner">Store Banner</label>
        <input type="file" id="store_banner" name="store_banner" accept="image/*">
        @error('store_banner')
            <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-row">
        <label for="store_description">Store Description</label>
        <textarea id="store_description" name="store_description" placeholder="Write about your store...">{{ old('store_description') }}</textarea>
        @error('store_description')
            <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-row">
        <label for="store_address">Store Address</label>
        <textarea id="store_address" name="store_address" placeholder="Enter store address...">{{ old('store_address') }}</textarea>
        @error('store_address')
            <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit" class="btn-submit">Create Store</button>
    </form>
  </div>

</body>
@endsection