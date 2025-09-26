import React from "react";

function PaymentRequestTable() {
  const requests = [
    { id: 1, amount: "$500", status: "Pending", date: "2025-09-26" },
    { id: 2, amount: "$1200", status: "Completed", date: "2025-09-25" },
    { id: 3, amount: "$300", status: "Pending", date: "2025-09-24" },
  ];

  const handleViewDetails = (request) => {
    alert(
      `Payment Request Details:\nAmount: ${request.amount}\nStatus: ${request.status}\nDate: ${request.date}`
    );
  };

  return (
    <div style={{ overflowX: "auto" }}>
      <table style={{ width: "95%", borderCollapse: "collapse", backgroundColor: "#213247", color: "#cbdcea",margin:"20px" }}>
        <thead>
          <tr>
            <th style={thStyle}>#</th>
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
              <td style={tdStyle}>{request.amount}</td>
              <td style={{ ...tdStyle, color: request.status === "Pending" ? "orange" : "green", fontWeight: "bold" }}>
                {request.status}
              </td>
              <td style={tdStyle}>{request.date}</td>
              <td style={tdStyle}>
                <button onClick={() => handleViewDetails(request)} style={buttonStyle}>
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

export default PaymentRequestTable;
