@extends('admin.layouts.layout')
@section('admin_page_title')
Payment - Admin Panel
@endsection
@section('admin_layout')

<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
  }

  body {
    background: #f4f6fb;
    
  }

  .container {
    width: 100%;
    max-width: 600px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    padding: 30px;
  }

  h1 {
    text-align: center;
    color: #111827;
    margin-bottom: 25px;
    font-size: 24px;
  }

  .method-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .method {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 15px;
    background: #f9fafb;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    font-weight: 500;
    color: #111827;
    transition: background 0.2s;
  }

  .method:hover {
    background: #f3f4f6;
  }

  .toggle {
    width: 45px;
    height: 25px;
    background: #d1d5db;
    border-radius: 25px;
    position: relative;
    cursor: pointer;
    transition: 0.3s;
  }

  .toggle::before {
    content: '';
    position: absolute;
    top: 2px;
    left: 3px;
    width: 21px;
    height: 21px;
    border-radius: 50%;
    background: #fff;
    transition: 0.3s;
  }

  .active {
    background: #22c55e;
  }

  .active::before {
    left: 21px;
  }
</style>
</head>
<body>

<div class="container">
  <h1>Payment Methods Management</h1>
  <div class="method-list" id="methodList"></div>
</div>

<script>
  // Payment methods with active status
  const methods = [
    { name: "bKash", active: true },
    { name: "Nagad", active: true },
    { name: "Bank Transfer", active: true },
    { name: "PayPal", active: false },
    { name: "Stripe", active: false },
  ];

  function loadMethods() {
    const list = document.getElementById("methodList");
    list.innerHTML = "";
    methods.forEach((method, index) => {
      const div = document.createElement("div");
      div.classList.add("method");
      div.innerHTML = `
        <span>${method.name}</span>
        <div class="toggle ${method.active ? 'active' : ''}" onclick="toggleMethod(${index}, this)"></div>
      `;
      list.appendChild(div);
    });
  }

  function toggleMethod(index, el) {
    methods[index].active = !methods[index].active;
    el.classList.toggle("active");
    alert(`${methods[index].name} is now ${methods[index].active ? 'Enabled' : 'Disabled'}`);
  }

  loadMethods();
</script>

</body>



@endsection