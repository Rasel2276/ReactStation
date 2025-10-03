import React, { useState } from "react";

function SellerPayment() {
  const [payments] = useState([
    { id: 1, seller: "Ali Store", email: "ali@shop.com", totalAmount: 1200, commission: 10, status: "Pending", date: "2025-09-26" },
    { id: 2, seller: "Ali Store", email: "ali@shop.com", totalAmount: 500, commission: 8, status: "Paid", date: "2025-09-25" },
    { id: 3, seller: "Sara Fashion", email: "sara@shop.com", totalAmount: 800, commission: 15, status: "Paid", date: "2025-09-25" },
    { id: 4, seller: "Ali Store", email: "ali@shop.com", totalAmount: 300, commission: 12, status: "Pending", date: "2025-09-24" },
  ]);

  const currentSeller = "Ali Store";

  const calculateSellerReceives = (amount, commission) => amount - (amount * commission) / 100;

  const sellerPayments = payments.filter(p => p.seller === currentSeller);
  const pendingPayments = sellerPayments.filter(p => p.status === "Pending");
  const paidPayments = sellerPayments.filter(p => p.status === "Paid");

  return (
    <div style={{ overflowX: "auto", margin: "20px" }}>
      <h2 style={{ color: "#cbdcea", textAlign: "center", marginBottom: "20px" }}>My Payments</h2>

      {/* Pending Payments */}
      {pendingPayments.length > 0 && (
        <div style={{ marginBottom: "30px" }}>
          <h3 style={{ color: "#cbdcea", marginBottom: "10px" }}>Pending Payments</h3>
          <table style={{ width: "100%", borderCollapse: "collapse", backgroundColor: "#213247", color: "#cbdcea" }}>
            <thead>
              <tr>
                <th style={thStyle}>#</th>
                <th style={thStyle}>Total Amount</th>
                <th style={thStyle}>Commission (%)</th>
                <th style={thStyle}>Amount Receives</th>
                <th style={thStyle}>Status</th>
                <th style={thStyle}>Date</th>
              </tr>
            </thead>
            <tbody>
              {pendingPayments.map((p, idx) => (
                <tr key={p.id} style={trStyle}>
                  <td style={tdStyle}>{idx + 1}</td>
                  <td style={tdStyle}>${p.totalAmount}</td>
                  <td style={tdStyle}>{p.commission}%</td>
                  <td style={{ ...tdStyle, fontWeight: "bold", color: "#4ade80" }}>
                    ${calculateSellerReceives(p.totalAmount, p.commission).toFixed(2)}
                  </td>
                  <td style={{ ...tdStyle, color: "orange", fontWeight: "bold" }}>{p.status}</td>
                  <td style={tdStyle}>{p.date}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      )}

      {/* Paid Payments */}
      {paidPayments.length > 0 && (
        <div>
          <h3 style={{ color: "#cbdcea", marginBottom: "10px" }}>Completed Payments</h3>
          <table style={{ width: "100%", borderCollapse: "collapse", backgroundColor: "#213247", color: "#cbdcea" }}>
            <thead>
              <tr>
                <th style={thStyle}>#</th>
                <th style={thStyle}>Total Amount</th>
                <th style={thStyle}>Commission (%)</th>
                <th style={thStyle}>Amount Receives</th>
                <th style={thStyle}>Status</th>
                <th style={thStyle}>Date</th>
              </tr>
            </thead>
            <tbody>
              {paidPayments.map((p, idx) => (
                <tr key={p.id} style={trStyle}>
                  <td style={tdStyle}>{idx + 1}</td>
                  <td style={tdStyle}>${p.totalAmount}</td>
                  <td style={tdStyle}>{p.commission}%</td>
                  <td style={{ ...tdStyle, fontWeight: "bold", color: "#4ade80" }}>
                    ${calculateSellerReceives(p.totalAmount, p.commission).toFixed(2)}
                  </td>
                  <td style={{ ...tdStyle, color: "green", fontWeight: "bold" }}>{p.status}</td>
                  <td style={tdStyle}>{p.date}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      )}

      {sellerPayments.length === 0 && (
        <p style={{ textAlign: "center", color: "#cbdcea" }}>No payment records found.</p>
      )}
    </div>
  );
}

// Styles
const thStyle = { padding: "10px", borderBottom: "1px solid #444", textAlign: "left" };
const tdStyle = { padding: "10px", borderBottom: "1px solid #444" };
const trStyle = { transition: "background-color 0.2s" };

export default SellerPayment;
