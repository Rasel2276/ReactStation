import React, { useState } from "react";

function PaymentRequestTable() {
  const [requests, setRequests] = useState([
    { id: 1, sellerId: "S001", sellerName: "Ali Store", email: "ali@shop.com", amount: "$500", status: "Pending", date: "2025-09-26" },
    { id: 2, sellerId: "S002", sellerName: "Sara Fashion", email: "sara@shop.com", amount: "$1200", status: "Pending", date: "2025-09-25" },
    { id: 3, sellerId: "S003", sellerName: "Rana Electronics", email: "rana@shop.com", amount: "$300", status: "Completed", date: "2025-09-24" },
  ]);

  const handleViewDetails = (request) => {
    alert(
      `Payment Request Details:\nSeller ID: ${request.sellerId}\nSeller Name: ${request.sellerName}\nEmail: ${request.email}\nAmount: ${request.amount}\nStatus: ${request.status}\nDate: ${request.date}`
    );
  };

  const handleMarkAsPaid = (id) => {
    setRequests((prevRequests) =>
      prevRequests.map((req) =>
        req.id === id ? { ...req, status: "Paid" } : req
      )
    );
  };

  return (
    <div style={{ overflowX: "auto" }}>
      <h2 style={{ marginLeft: "30px", color: "#cbdcea", textAlign: "center" }}>
        Payment Information
      </h2>
      <table
        style={{
          width: "95%",
          borderCollapse: "collapse",
          backgroundColor: "#213247",
          color: "#cbdcea",
          margin: "20px",
        }}
      >
        <thead>
          <tr>
            <th style={thStyle}>#</th>
            <th style={thStyle}>Seller ID</th>
            <th style={thStyle}>Seller Name</th>
            <th style={thStyle}>Email</th>
            <th style={thStyle}>Amount</th>
            <th style={thStyle}>Status</th>
            <th style={thStyle}>Date</th>
            <th style={thStyle}>Action</th>
          </tr>
        </thead>
        <tbody>
          {requests.map((request, index) => (
            <tr key={request.id} style={trStyle}>
              <td style={tdStyle}>{index + 1}</td>
              <td style={tdStyle}>{request.sellerId}</td>
              <td style={tdStyle}>{request.sellerName}</td>
              <td style={tdStyle}>{request.email}</td>
              <td style={tdStyle}>{request.amount}</td>
              <td
                style={{
                  ...tdStyle,
                  color:
                    request.status === "Pending"
                      ? "orange"
                      : request.status === "Paid"
                      ? "green"
                      : "gray",
                  fontWeight: "bold",
                }}
              >
                {request.status}
              </td>
              <td style={tdStyle}>{request.date}</td>
              <td style={tdStyle}>
                <button
                  onClick={() => handleViewDetails(request)}
                  style={viewButtonStyle}
                >
                  View Details
                </button>
                {request.status === "Pending" && (
                  <button
                    onClick={() => handleMarkAsPaid(request.id)}
                    style={paidButtonStyle}
                  >
                    Mark as Paid
                  </button>
                )}
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}

// Inline Styles
const thStyle = {
  padding: "10px",
  borderBottom: "1px solid #444",
  textAlign: "left",
};
const tdStyle = { padding: "10px", borderBottom: "1px solid #444" };
const trStyle = { transition: "background-color 0.2s" };
const viewButtonStyle = {
  padding: "5px 10px",
  marginRight: "5px",
  backgroundColor: "#4ade80",
  color: "#000",
  border: "none",
  borderRadius: "4px",
  cursor: "pointer",
};
const paidButtonStyle = {
  padding: "5px 10px",
  backgroundColor: "#3b82f6",
  color: "#fff",
  border: "none",
  borderRadius: "4px",
  cursor: "pointer",
};

export default PaymentRequestTable;
