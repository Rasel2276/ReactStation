import React from "react";

function UserTable() {
  const users = [
    {
      id: 1,
      image: "https://via.placeholder.com/50",
      email: "john@example.com",
      paymentStatus: "Paid",
      division: "Dhaka",
      district: "Dhaka",
    },
    {
      id: 2,
      image: "https://via.placeholder.com/50",
      email: "jane@example.com",
      paymentStatus: "Unpaid",
      division: "Chattogram",
      district: "Chattogram",
    },
    {
      id: 3,
      image: "https://via.placeholder.com/50",
      email: "ali@example.com",
      paymentStatus: "Paid",
      division: "Rajshahi",
      district: "Bogra",
    },
  ];

  const handleViewDetails = (user) => {
    alert(
      `User Details:\nEmail: ${user.email}\nPayment Status: ${user.paymentStatus}\nDivision: ${user.division}\nDistrict: ${user.district}`
    );
  };

  return (
    <div style={{ overflowX: "auto" }}>
      <h2 style={{ marginLeft: "30px", color: "#cbdcea",textAlign: "center" }}>Seller Information</h2>
      <table style={{ width: "95%", borderCollapse: "collapse", backgroundColor: "#213247", color: "#cbdcea",margin:"20px" }}>
        <thead>
          <tr>
            <th style={thStyle}>#</th>
            <th style={thStyle}>Image</th>
            <th style={thStyle}>Email</th>
            <th style={thStyle}>Payment Status</th>
            <th style={thStyle}>Division</th>
            <th style={thStyle}>District</th>
            <th style={thStyle}>Action</th>
          </tr>
        </thead>
        <tbody>
          {users.map((user, index) => (
            <tr key={user.id} style={trStyle}>
              <td style={tdStyle}>{index + 1}</td>
              <td style={tdStyle}>
                <img src={user.image} alt="user" style={{ width: "50px", borderRadius: "5px" }} />
              </td>
              <td style={tdStyle}>{user.email}</td>
              <td style={tdStyle}>{user.paymentStatus}</td>
              <td style={tdStyle}>{user.division}</td>
              <td style={tdStyle}>{user.district}</td>
              <td style={tdStyle}>
                <button onClick={() => handleViewDetails(user)} style={buttonStyle}>
                  View Details
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}

// Inline Styles
const thStyle = { padding: "10px", borderBottom: "1px solid #444", textAlign: "left" };
const tdStyle = { padding: "10px", borderBottom: "1px solid #444" };
const trStyle = { transition: "background-color 0.2s" };
const buttonStyle = { padding: "5px 10px", backgroundColor: "#4ade80", color: "#000", border: "none", borderRadius: "4px", cursor: "pointer" };

export default UserTable;
