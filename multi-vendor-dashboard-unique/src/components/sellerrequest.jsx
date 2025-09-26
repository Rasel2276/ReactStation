import React, { useState } from "react";

function SellerRequestTable() {
  const [requests, setRequests] = useState([
    { id: 1, name: "Ali", email: "ali@shop.com", shop: "Ali Store", status: "Pending" },
    { id: 2, name: "Sara", email: "sara@shop.com", shop: "Sara Fashion", status: "Pending" },
    { id: 3, name: "Rana", email: "rana@shop.com", shop: "Rana Electronics", status: "Pending" },
  ]);

  const handleAccept = (id) => {
    setRequests((prev) =>
      prev.map((req) =>
        req.id === id ? { ...req, status: "Accepted" } : req
      )
    );
  };

  const handleReject = (id) => {
    setRequests((prev) =>
      prev.map((req) =>
        req.id === id ? { ...req, status: "Rejected" } : req
      )
    );
  };

  return (
    <div style={{ overflowX: "auto" }}>
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
          {requests.map((req, index) => (
            <tr key={req.id} style={trStyle}>
              <td style={tdStyle}>{index + 1}</td>
              <td style={tdStyle}>{req.name}</td>
              <td style={tdStyle}>{req.email}</td>
              <td style={tdStyle}>{req.shop}</td>
              <td style={{ ...tdStyle, color: req.status === "Pending" ? "orange" : req.status === "Accepted" ? "green" : "red", fontWeight: "bold" }}>
                {req.status}
              </td>
              <td style={tdStyle}>
                {req.status === "Pending" && (
                  <>
                    <button onClick={() => handleAccept(req.id)} style={acceptButtonStyle}>Accept</button>
                    <button onClick={() => handleReject(req.id)} style={rejectButtonStyle}>Reject</button>
                  </>
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
const thStyle = { padding: "10px", borderBottom: "1px solid #444", textAlign: "left" };
const tdStyle = { padding: "10px", borderBottom: "1px solid #444" };
const trStyle = { transition: "background-color 0.2s" };
const acceptButtonStyle = { padding: "5px 10px", marginRight: "5px", backgroundColor: "#4ade80", color: "#000", border: "none", borderRadius: "4px", cursor: "pointer" };
const rejectButtonStyle = { padding: "5px 10px", backgroundColor: "#f87171", color: "#fff", border: "none", borderRadius: "4px", cursor: "pointer" };

export default SellerRequestTable;
