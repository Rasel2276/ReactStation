@extends('admin.layouts.layout')
@section('admin_page_title')
Manage - Admin Panel
@endsection
@section('admin_layout')

<style>
  * { box-sizing:border-box; margin:0; padding:0; font-family:'Poppins', sans-serif; }
  body { background:#f4f6fb; }
  .container { width:100%; max-width:1200px; background:#fff; border-radius:12px; box-shadow:0 6px 18px rgba(0,0,0,0.1); padding:30px; }
  h1 { text-align:center; margin-bottom:25px; font-size:28px; color:#111827; }
  table { width:100%; border-collapse:collapse; min-width:800px; }
  th, td { border:1px solid #e5e7eb; padding:12px; text-align:center; font-size:15px; }
  th { background:#f9fafb; color:#374151; text-transform:uppercase; letter-spacing:0.5px; }
  tr:nth-child(even) { background:#f3f4f6; }
  tr:hover { background:#e0f2fe; }
  button { padding:6px 12px; border:none; border-radius:6px; cursor:pointer; color:#fff; transition:0.2s; }
  .approve { background:#22c55e; }
  .approve:hover { background:#15803d; }
  .deactivate { background:#ef4444; }
  .deactivate:hover { background:#991b1b; }
  .active-status { background:#dcfce7; color:#166534; padding:4px 10px; border-radius:6px; display:inline-block; }
  .inactive-status { background:#fee2e2; color:#991b1b; padding:4px 10px; border-radius:6px; display:inline-block; }
</style>
</head>
<body>

<div class="container">
  <h1>User Management</h1>
  <table id="userTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>

<script>
let users = [
  {id:1, name:"Alice", email:"alice@example.com", role:"Customer", status:"active"},
  {id:2, name:"Bob", email:"bob@example.com", role:"Vendor", status:"pending"},
  {id:3, name:"Charlie", email:"charlie@example.com", role:"Customer", status:"inactive"},
  {id:4, name:"David", email:"david@example.com", role:"Vendor", status:"active"},
];

function loadTable() {
  const tbody = document.querySelector("#userTable tbody");
  tbody.innerHTML = "";
  users.forEach((user, index) => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${user.id}</td>
      <td>${user.name}</td>
      <td>${user.email}</td>
      <td>${user.role}</td>
      <td>
        <span class="${user.status === 'active' ? 'active-status' : user.status==='inactive'?'inactive-status':'pending-status'}">
          ${user.status.charAt(0).toUpperCase() + user.status.slice(1)}
        </span>
      </td>
      <td>
        ${user.role==='Vendor' && user.status==='pending' ? `<button class="approve" onclick="approveVendor(${index})">Approve</button>` : ''}
        <button class="deactivate" onclick="toggleActive(${index})">
          ${user.status==='active' ? 'Deactivate' : 'Activate'}
        </button>
      </td>
    `;
    tbody.appendChild(tr);
  });
}

function approveVendor(index) {
  users[index].status = 'active';
  alert(`✅ Vendor ${users[index].name} approved`);
  loadTable();
}

function toggleActive(index) {
  if(users[index].status==='active'){
    users[index].status='inactive';
    alert(`❌ User ${users[index].name} deactivated`);
  } else {
    users[index].status='active';
    alert(`✅ User ${users[index].name} activated`);
  }
  loadTable();
}

loadTable();
</script>

</body>


@endsection