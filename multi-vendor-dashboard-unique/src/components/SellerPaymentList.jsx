import React, { useState, useEffect } from "react";

export default function SellerPaymentList() {
  const [payments, setPayments] = useState(() => {
    try {
      return JSON.parse(localStorage.getItem("payments_v1")) || [
        { id: 1, sellerId: "S001", sellerName: "Ali Store", email: "ali@shop.com", totalAmount: 1200, commission: 10, status: "Paid", date: "2025-09-26" },
        { id: 2, sellerId: "S002", sellerName: "Sara Fashion", email: "sara@shop.com", totalAmount: 800, commission: 15, status: "Paid", date: "2025-09-25" },
        { id: 3, sellerId: "S003", sellerName: "Rana Electronics", email: "rana@shop.com", totalAmount: 450, commission: 12, status: "Pending", date: "2025-09-24" },
      ];
    } catch (e) {
      return [];
    }
  });

  useEffect(() => {
    localStorage.setItem("payments_v1", JSON.stringify(payments));
  }, [payments]);

  // Seller Receives = Total - Commission
  const calculateSellerReceives = (total, commission) => total - (total * commission) / 100;

  // Only Paid payments
  const paidPayments = payments.filter(p => p.status === "Paid");

  return (
    <div style={{ margin: "20px", overflowX: "auto" }}>
      <h2 style={{ color: "#cbdcea", textAlign: "center", marginBottom: "20px" }}>Completed Payments</h2>

      {paidPayments.length > 0 ? (
        <table style={{ width: "100%", borderCollapse: "collapse", backgroundColor: "#213247", color: "#cbdcea" }}>
          <thead>
            <tr>
              <th style={thStyle}>#</th>
              <th style={thStyle}>Seller ID</th>
              <th style={thStyle}>Seller Name</th>
              <th style={thStyle}>Email</th>
              <th style={thStyle}>Total Amount</th>
              <th style={thStyle}>Commission</th>
              <th style={thStyle}>Amount After Commission</th>
              <th style={thStyle}>Status</th>
              <th style={thStyle}>Date</th>
            </tr>
          </thead>
          <tbody>
            {paidPayments.map((p, idx) => {
              const received = calculateSellerReceives(p.totalAmount, p.commission);
              return (
                <tr key={p.id} style={trStyle}>
                  <td style={tdStyle}>{idx + 1}</td>
                  <td style={tdStyle}>{p.sellerId}</td>
                  <td style={tdStyle}>{p.sellerName}</td>
                  <td style={tdStyle}>{p.email}</td>
                  <td style={tdStyle}>${p.totalAmount}</td>
                  <td style={tdStyle}>${((p.totalAmount * p.commission) / 100).toFixed(2)} ({p.commission}%)</td>
                  <td style={{ ...tdStyle, fontWeight: "bold", color: "#4ade80" }}>${received.toFixed(2)}</td>
                  <td style={{ ...tdStyle, color: "green", fontWeight: "bold" }}>{p.status}</td>
                  <td style={tdStyle}>{p.date}</td>
                </tr>
              );
            })}
          </tbody>
        </table>
      ) : (
        <p style={{ textAlign: "center", color: "#cbdcea" }}>No completed payments found.</p>
      )}
    </div>
  );
}

// Styles
const thStyle = { padding: "10px", borderBottom: "1px solid #444", textAlign: "left" };
const tdStyle = { padding: "10px", borderBottom: "1px solid #444" };
const trStyle = { transition: "background-color 0.2s" };
