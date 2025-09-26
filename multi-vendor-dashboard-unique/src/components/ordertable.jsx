
import React from "react";

function OrdersTable() {
  const orders = [
    { id: 1, price: "$1200", paymentStatus: "Paid", orderStatus: "Pending" },
    { id: 2, price: "$150", paymentStatus: "Unpaid", orderStatus: "Completed" },
    { id: 3, price: "$900", paymentStatus: "Paid", orderStatus: "Pending" },
  ];

  const handleViewDetails = (order) => {
    alert(`Order Details:\nID: ${order.id}\nPrice: ${order.price}\nPayment Status: ${order.paymentStatus}\nOrder Status: ${order.orderStatus}`);
  };

  return (
    <div style={{ overflowX: "auto" }}>
      <table style={{ width: "90%", borderCollapse: "collapse", backgroundColor: "#213247", color: "#cbdcea",margin:"20px 30px" }}>
        <thead>
          <tr>
            <th style={thStyle}>Order ID</th>
            <th style={thStyle}>Price</th>
            <th style={thStyle}>Payment Status</th>
            <th style={thStyle}>Order Status</th>
            <th style={thStyle}>Action</th>
          </tr>
        </thead>
        <tbody>
          {orders.map((order) => (
            <tr key={order.id} style={trStyle}>
              <td style={tdStyle}>{order.id}</td>
              <td style={tdStyle}>{order.price}</td>
              <td style={tdStyle}>{order.paymentStatus}</td>
              <td style={tdStyle}>{order.orderStatus}</td>
              <td style={tdStyle}>
                <button
                  onClick={() => handleViewDetails(order)}
                  style={buttonStyle}
                >
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
const trStyle = { transition: "background-color 0.2s", cursor: "default" };
const buttonStyle = { padding: "5px 10px", backgroundColor: "#4ade80", color: "#000", border: "none", borderRadius: "4px", cursor: "pointer" };

export default OrdersTable;
