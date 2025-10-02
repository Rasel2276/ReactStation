import React, { useState } from "react";

function OrderList() {
  const [orders, setOrders] = useState([
    { id: 1, product: "Laptop", image: "https://via.placeholder.com/50", customer: "John Doe", phone: "01711111111", address: "Dhaka, Bangladesh", quantity: 2, price: "$1200", stage: "Processing" },
    { id: 2, product: "Headphones", image: "https://via.placeholder.com/50", customer: "Jane Smith", phone: "01722222222", address: "Chittagong, Bangladesh", quantity: 1, price: "$150", stage: "Processing" },
    { id: 3, product: "Shoes", image: "https://via.placeholder.com/50", customer: "Ali Khan", phone: "01733333333", address: "Sylhet, Bangladesh", quantity: 3, price: "$240", stage: "Processing" },
  ]);

  const [searchId, setSearchId] = useState("");
  const [selectedOrder, setSelectedOrder] = useState(null);

  const stages = ["Processing", "On the way", "Wearhouse"];

  const handleStageChange = (orderId, newStage) => {
    setOrders(prev =>
      prev.map(order =>
        order.id === orderId ? { ...order, stage: newStage } : order
      )
    );
  };

  const filteredOrders = searchId
    ? orders.filter(order => order.id.toString() === searchId.trim())
    : orders;

  return (
    <div style={{ overflowX: "auto" }}>
      <h2 style={{ marginLeft: "30px", color: "#cbdcea", textAlign: "center" }}>
        Customer Orders
      </h2>

      {/* Search Section */}
      <div style={{ textAlign: "center", margin: "15px" }}>
        <input
          type="text"
          placeholder="Search by Order ID"
          value={searchId}
          onChange={(e) => setSearchId(e.target.value)}
          style={{
            padding: "8px",
            borderRadius: "4px",
            border: "1px solid #444",
            backgroundColor: "#1f2a3d",
            color: "#cbdcea",
            marginRight: "8px"
          }}
        />
        <button
          onClick={() => setSearchId("")}
          style={{
            padding: "8px 12px",
            borderRadius: "4px",
            border: "none",
            backgroundColor: "#2d4a7c",
            color: "#fff",
            cursor: "pointer"
          }}
        >
          Reset
        </button>
      </div>

      {/* Orders Table */}
      <table style={{ width: "95%", borderCollapse: "collapse", backgroundColor: "#213247", color: "#cbdcea", margin: "20px auto" }}>
        <thead>
          <tr>
            <th style={thStyle}>Order ID</th>
            <th style={thStyle}>Image</th>
            <th style={thStyle}>Product</th>
            <th style={thStyle}>Customer</th>
            <th style={thStyle}>Quantity</th>
            <th style={thStyle}>Price</th>
            <th style={thStyle}>Stage</th>
            <th style={thStyle}>Actions</th>
          </tr>
        </thead>
        <tbody>
          {filteredOrders.map((order) => (
            <tr key={order.id} style={trStyle}>
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
              <td style={tdStyle}>
                <button
                  onClick={() => setSelectedOrder(order)}
                  style={viewButtonStyle}
                >
                  View
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>

      {/* Modal for Order Details */}
      {selectedOrder && (
        <div style={modalOverlay}>
          <div style={modalContent}>
            <button
              onClick={() => setSelectedOrder(null)}
              style={closeButtonStyle}
            >
              X
            </button>
            <h3>Order Details</h3>
            <p><b>Order ID:</b> {selectedOrder.id}</p>
            <p><b>Product:</b> {selectedOrder.product}</p>
            <p><b>Customer:</b> {selectedOrder.customer}</p>
            <p><b>Phone:</b> {selectedOrder.phone}</p>
            <p><b>Address:</b> {selectedOrder.address}</p>
            <p><b>Quantity:</b> {selectedOrder.quantity}</p>
            <p><b>Price:</b> {selectedOrder.price}</p>
            <p><b>Stage:</b> {selectedOrder.stage}</p>
          </div>
        </div>
      )}
    </div>
  );
}

// Styles
const thStyle = { padding: "10px", borderBottom: "1px solid #444", textAlign: "left" };
const tdStyle = { padding: "10px", borderBottom: "1px solid #444" };
const trStyle = { transition: "background-color 0.2s" };
const selectStyle = { padding: "5px", borderRadius: "4px", border: "1px solid #444", backgroundColor: "#1f2a3d", color: "#cbdcea" };
const viewButtonStyle = { padding: "6px 12px", border: "none", borderRadius: "4px", backgroundColor: "#4caf50", color: "#fff", cursor: "pointer" };
const modalOverlay = { position: "fixed", top: 0, left: 0, width: "100vw", height: "100vh", backgroundColor: "rgba(0,0,0,0.6)", display: "flex", justifyContent: "center", alignItems: "center", zIndex: 1000 };
const modalContent = { backgroundColor: "#fff", padding: "20px", borderRadius: "8px", width: "400px", position: "relative", color: "#333" };
const closeButtonStyle = { position: "absolute", top: "10px", right: "10px", background: "red", color: "#fff", border: "none", borderRadius: "4px", cursor: "pointer", padding: "5px 10px" };

export default OrderList;
