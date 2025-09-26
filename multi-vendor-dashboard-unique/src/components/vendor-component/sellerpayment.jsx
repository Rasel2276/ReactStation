import React, { useState } from "react";

function SellerPayment() {
  const [payments, setPayments] = useState([
    { id: 1, seller: "Ali Store", email: "ali@shop.com", totalAmount: 1200, commission: 10, status: "Pending", date: "2025-09-26" },
    { id: 2, seller: "Sara Fashion", email: "sara@shop.com", totalAmount: 800, commission: 15, status: "Paid", date: "2025-09-25" },
    { id: 3, seller: "Rana Electronics", email: "rana@shop.com", totalAmount: 450, commission: 12, status: "Pending", date: "2025-09-24" },
  ]);

  // Seller Receives = Total - Commission
  const calculateSellerReceives = (amount, commission) => {
    return amount - (amount * commission) / 100;
  };

  const handleStatusChange = (id, newStatus) => {
    setPayments(prev =>
      prev.map(p => (p.id === id ? { ...p, status: newStatus } : p))
    );
  };

  return (
    <div style={{ overflowX: "auto" }}>
      <table style={{ width: "95%", borderCollapse: "collapse", backgroundColor: "#213247", color: "#cbdcea",margin:"20px" }}>
        <thead>
          <tr>
            <th style={thStyle}>#</th>
            <th style={thStyle}>Seller</th>
            <th style={thStyle}>Email</th>
            <th style={thStyle}>Total Amount</th>
            <th style={thStyle}>Commission (%)</th>
            <th style={thStyle}>Seller Receives</th>
            <th style={thStyle}>Status</th>
            <th style={thStyle}>Date</th>
            <th style={thStyle}>Action</th>
          </tr>
        </thead>
        <tbody>
          {payments.map((p, index) => (
            <tr key={p.id} style={trStyle}>
              <td style={tdStyle}>{index + 1}</td>
              <td style={tdStyle}>{p.seller}</td>
              <td style={tdStyle}>{p.email}</td>
              <td style={tdStyle}>${p.totalAmount}</td>
              <td style={tdStyle}>{p.commission}%</td>
              <td style={{ ...tdStyle, fontWeight: "bold", color: "#4ade80" }}>
                ${calculateSellerReceives(p.totalAmount, p.commission).toFixed(2)}
              </td>
              <td style={{ ...tdStyle, color: p.status === "Paid" ? "green" : "orange", fontWeight: "bold" }}>
                {p.status}
              </td>
              <td style={tdStyle}>{p.date}</td>
              <td style={tdStyle}>
                {p.status === "Pending" && (
                  <select
                    value={p.status}
                    onChange={(e) => handleStatusChange(p.id, e.target.value)}
                    style={selectStyle}
                  >
                    <option value="Pending">Pending</option>
                    <option value="Paid">Paid</option>
                  </select>
                )}
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}

// Styles
const thStyle = { padding: "10px", borderBottom: "1px solid #444", textAlign: "left" };
const tdStyle = { padding: "10px", borderBottom: "1px solid #444" };
const trStyle = { transition: "background-color 0.2s" };
const selectStyle = { padding: "5px", borderRadius: "4px", border: "1px solid #444", backgroundColor: "#1f2a3d", color: "#cbdcea" };

export default SellerPayment;
