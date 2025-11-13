@extends('customer.layouts.layout')
@section('admin_page_title')
Customer Dashboard
@endsection
@section('customer_layout')

<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
  }
  body {
    background: #f4f6fb;
    color: #333;
  }
  .container {
    max-width: 700px;
    margin: 10px auto;
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
  }
  h1 {
    text-align: center;
    margin-bottom: 25px;
    color: #111827;
    font-size: 26px;
  }
  .profile-pic {
    text-align: center;
    margin-bottom: 20px;
  }
  .profile-pic img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 3px solid #2563eb;
    object-fit: cover;
  }
  .edit-btn {
    margin-top: 8px;
    background: #2563eb;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 6px 12px;
    cursor: pointer;
    font-size: 14px;
  }
  label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
  }
  input, textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-bottom: 15px;
    font-size: 15px;
  }
  textarea {
    resize: none;
  }
  .btn-save {
    width: 100%;
    background: #2563eb;
    color: #fff;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
  }
  .btn-save:hover {
    opacity: 0.9;
  }
  .info-box {
    background: #f9fafb;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 15px;
  }
</style>
</head>
<body>

<div class="container">
  <h1>Customer Profile</h1>

  <div class="profile-pic">
    <img id="profileImg" src="https://via.placeholder.com/120" alt="Profile Picture">
    <br>
    <button class="edit-btn" onclick="changePic()">Change Photo</button>
    <input type="file" id="fileInput" accept="image/*" style="display:none;" onchange="previewImage(event)">
  </div>

  <div class="info-box">
    <label for="name">Full Name</label>
    <input type="text" id="name" value="Md. Rasel Hossain">

    <label for="email">Email</label>
    <input type="email" id="email" value="rasel@example.com">

    <label for="phone">Phone</label>
    <input type="text" id="phone" value="+8801712345678">

    <label for="address">Address</label>
    <textarea id="address" rows="3">Dhaka, Bangladesh</textarea>

    <label for="password">Change Password</label>
    <input type="password" id="password" placeholder="Enter new password">
  </div>

  <button class="btn-save" onclick="saveProfile()">Save Changes</button>
</div>

<script>
function changePic() {
  document.getElementById('fileInput').click();
}

function previewImage(event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = e => {
      document.getElementById('profileImg').src = e.target.result;
    };
    reader.readAsDataURL(file);
  }
}

function saveProfile() {
  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const phone = document.getElementById('phone').value.trim();
  const address = document.getElementById('address').value.trim();

  if (!name || !email || !phone || !address) {
    alert("⚠️ Please fill all fields properly.");
    return;
  }

  alert(`✅ Profile Updated Successfully!\n\nName: ${name}\nEmail: ${email}\nPhone: ${phone}`);
  
  // Laravel Integration Later:
  // axios.post('/customer/profile/update', { name, email, phone, address });
}
</script>

</body>

@endsection