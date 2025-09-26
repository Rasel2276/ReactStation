import React, { useState } from "react";

function OrderList() {
  const [orders, setOrders] = useState([
    { id: 1, product: "Laptop", image: "https://via.placeholder.com/50", customer: "John Doe", quantity: 2, price: "$1200", stage: "Processing" },
    { id: 2, product: "Headphones", image: "https://via.placeholder.com/50", customer: "Jane Smith", quantity: 1, price: "$150", stage: "Processing" },
    { id: 3, product: "Shoes", image: "https://via.placeholder.com/50", customer: "Ali Khan", quantity: 3, price: "$240", stage: "Processing" },
  ]);

  const stages = ["Processing", "Packed", "Shipped", "Delivered"];

  const handleStageChange = (orderId, newStage) => {
    setOrders(prev =>
      prev.map(order =>
        order.id === orderId ? { ...order, stage: newStage } : order
      )
    );
  };

  return (
    <div style={{ overflowX: "auto" }}>
      <table style={{ width: "95%", borderCollapse: "collapse", backgroundColor: "#213247", color: "#cbdcea",margin:"20px" }}>
        <thead>
          <tr>
            <th style={thStyle}>Serial</th>
            <th style={thStyle}>Order ID</th>
            <th style={thStyle}>Image</th>
            <th style={thStyle}>Product</th>
            <th style={thStyle}>Customer</th>
            <th style={thStyle}>Quantity</th>
            <th style={thStyle}>Price</th>
            <th style={thStyle}>Stage</th>
          </tr>
        </thead>
        <tbody>
          {orders.map((order, index) => (
            <tr key={order.id} style={trStyle}>
              <td style={tdStyle}>{index + 1}</td>
              <td style={tdStyle}>{order.id}</td>
              <td style={tdStyle}>
                <img src={order.image} alt={order.product} style={{ width: "50px", height: "50px", borderRadius: "4px" }} />
              </td>
              <td style={tdStyle}>{order.product}</td>
              <td style={tdStyle}>{order.customer}</td>
              <td style={tdStyle}>{order.quantity}</td>
              <td style={tdStyle}>{order.price}</td>
              <td style={tdStyle}>
                <select
                  value={order.stage}
                  onChange={(e) => handleStageChange(order.id, e.target.value)}
                  style={selectStyle}
                >
                  {stages.map((s, i) => (
                    <option key={i} value={s}>{s}</option>
                  ))}
                </select>
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

export default OrderList;

