import React, { useState } from "react";

function SellerDeactivate() {
  const [sellers, setSellers] = useState([
    { id: 1, name: "Ali", email: "ali@shop.com", shop: "Ali Store", status: "Active" },
    { id: 2, name: "Sara", email: "sara@shop.com", shop: "Sara Fashion", status: "Inactive" },
    { id: 3, name: "Rana", email: "rana@shop.com", shop: "Rana Electronics", status: "Active" },
  ]);

  const handleToggleStatus = (id) => {
    setSellers((prev) =>
      prev.map((seller) =>
        seller.id === id
          ? { ...seller, status: seller.status === "Active" ? "Deactivated" : "Active" }
          : seller
      )
    );
  };

  return (
    <div style={{ overflowX: "auto" }}>
      <h2 style={{ marginLeft: "30px", color: "#cbdcea" }}>Seller Management</h2>
      <table style={{ width: "95%", borderCollapse: "collapse", backgroundColor: "#213247", color: "#cbdcea",margin:"20px" }}>
        <thead>
          <tr>
            <th style={thStyle}>Serial</th>
            <th style={thStyle}>Name</th>
            <th style={thStyle}>Email</th>
            <th style={thStyle}>Shop Name</th>
            <th style={thStyle}>Status</th>
            <th style={thStyle}>Action</th>
          </tr>
        </thead>
        <tbody>
          {sellers.map((seller, index) => (
            <tr key={seller.id} style={trStyle}>
              <td style={tdStyle}>{index + 1}</td>
              <td style={tdStyle}>{seller.name}</td>
              <td style={tdStyle}>{seller.email}</td>
              <td style={tdStyle}>{seller.shop}</td>
              <td style={{ ...tdStyle, color: seller.status === "Active" ? "green" : seller.status === "Deactivated" ? "red" : "orange", fontWeight: "bold" }}>
                {seller.status}
              </td>
              <td style={tdStyle}>
                <button
                  onClick={() => handleToggleStatus(seller.id)}
                  style={buttonStyle}
                >
                  {seller.status === "Active" ? "Deactivate" : "Activate"}
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
const buttonStyle = { padding: "5px 10px", backgroundColor: "#f87171", color: "#fff", border: "none", borderRadius: "4px", cursor: "pointer" };

export default SellerDeactivate;
