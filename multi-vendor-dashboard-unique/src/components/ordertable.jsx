import React, { useState } from "react";

function OrdersTable() {
  const [orders, setOrders] = useState([
    {
      id: 1,
      productName: "Laptop",
      image: "https://via.placeholder.com/50",
      location: "Warehouse A",
      price: "$1200",
      paymentStatus: "Paid",
      orderStatus: "Pending",
    },
    {
      id: 2,
      productName: "Headphones",
      image: "https://via.placeholder.com/50",
      location: "Warehouse B",
      price: "$150",
      paymentStatus: "Unpaid",
      orderStatus: "Completed",
    },
    {
      id: 3,
      productName: "Shoes",
      image: "https://via.placeholder.com/50",
      location: "Warehouse C",
      price: "$900",
      paymentStatus: "Paid",
      orderStatus: "Pending",
    },
  ]);

  const handleViewDetails = (order) => {
    alert(
      `Order Details:\nID: ${order.id}\nProduct: ${order.productName}\nLocation: ${order.location}\nPrice: ${order.price}\nPayment Status: ${order.paymentStatus}\nOrder Status: ${order.orderStatus}`
    );
  };

  const handleAction = (id, status) => {
    setOrders((prevOrders) =>
      prevOrders.map((order) =>
        order.id === id ? { ...order, orderStatus: status } : order
      )
    );
  };

  return (
    <div style={{ overflowX: "auto" }}>
      <h2 style={{ marginLeft: "30px", color: "#cbdcea", textAlign: "center" }}>
        Orders Management
      </h2>

      <table
        style={{
          width: "95%",
          borderCollapse: "collapse",
          backgroundColor: "#213247",
          color: "#cbdcea",
          margin: "20px auto",
        }}
      >
        <thead>
          <tr>
            <th style={thStyle}>Order ID</th>
            <th style={thStyle}>Product</th>
            <th style={thStyle}>Image</th>
            <th style={thStyle}>Location</th>
            <th style={thStyle}>Price</th>
            <th style={thStyle}>Payment Status</th>
            <th style={thStyle}>Order Status</th>
            <th style={thStyle}>Action</th>
            <th style={thStyle}>Order Confirmation</th>
          </tr>
        </thead>
        <tbody>
          {orders.map((order) => (
            <tr key={order.id} style={trStyle}>
              <td style={tdStyle}>{order.id}</td>
              <td style={tdStyle}>{order.productName}</td>
              <td style={tdStyle}>
                <img
                  src={order.image}
                  alt={order.productName}
                  style={{ width: "50px", height: "50px", borderRadius: "4px" }}
                />
              </td>
              <td style={tdStyle}>{order.location}</td>
              <td style={tdStyle}>{order.price}</td>
              <td style={tdStyle}>{order.paymentStatus}</td>
              <td style={tdStyle}>{order.orderStatus}</td>
              <td style={tdStyle}>
                <button onClick={() => handleViewDetails(order)} style={buttonStyle}>
                  View Details
                </button>
              </td>
              <td style={tdStyle}>
                <button
                  onClick={() => handleAction(order.id, "Confirmed")}
                  style={{ ...buttonStyle, backgroundColor: "#3b82f6", marginRight: "5px" }}
                >
                  Confirm
                </button>
                <button
                  onClick={() => handleAction(order.id, "Rejected")}
                  style={{ ...buttonStyle, backgroundColor: "#ef4444", color: "#fff" }}
                >
                  Reject
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
const thStyle = {
  padding: "10px",
  borderBottom: "1px solid #444",
  textAlign: "left",
};
const tdStyle = { padding: "10px", borderBottom: "1px solid #444" };
const trStyle = { transition: "background-color 0.2s", cursor: "default" };
const buttonStyle = {
  padding: "5px 10px",
  backgroundColor: "#4ade80",
  color: "#000",
  border: "none",
  borderRadius: "4px",
  cursor: "pointer",
};

export default OrdersTable;
