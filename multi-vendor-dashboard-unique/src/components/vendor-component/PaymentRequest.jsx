import React, { useState } from "react";

function PaymentRequest() {
  const [formData, setFormData] = useState({
    seller: "",
    email: "",
    amount: "",
  });

  const [successMessage, setSuccessMessage] = useState(""); // ✅ Success message state

  // handle input change
  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({ ...prev, [name]: value }));
  };

  // handle form submit
  const handleSubmit = (e) => {
    e.preventDefault();

    // Show success message
    setSuccessMessage("Payment request sent successfully!");

    // Clear message after 3 seconds
    setTimeout(() => setSuccessMessage(""), 3000);

    // Backend integration: POST request to Laravel API here

    // Clear form
    setFormData({ seller: "", email: "", amount: "" });
  };

  return (
    <div>
      <h2 style={{ textAlign: "center", color: "#cbdcea", margin: "20px 0" }}>Request Payment to Admin</h2>

      {/* Request Form */}
      <div style={{
        backgroundColor: "#213247",
        padding: "20px",
        borderRadius: "8px",
        maxWidth: "600px",
        margin: "20px auto",
        color: "#cbdcea"
      }}>
        <form onSubmit={handleSubmit} style={{ display: "flex", flexDirection: "column" }}>
          <input
            type="text"
            name="seller"
            placeholder="Seller Name"
            value={formData.seller}
            onChange={handleChange}
            style={inputStyle}
            required
          />
          <input
            type="email"
            name="email"
            placeholder="Seller Email"
            value={formData.email}
            onChange={handleChange}
            style={inputStyle}
            required
          />
          <input
            type="number"
            name="amount"
            placeholder="Amount"
            value={formData.amount}
            onChange={handleChange}
            style={inputStyle}
            required
          />
          <button type="submit" style={buttonStyle}>Send Request</button>
        </form>

        {/* ✅ Success Message */}
        {successMessage && (
          <p style={{
            color: "#4ade80",
            fontWeight: "bold",
            marginTop: "15px",
            textAlign: "center",
            transition: "opacity 0.5s"
          }}>
            {successMessage}
          </p>
        )}
      </div>
    </div>
  );
}

// Styles
const inputStyle = {
  padding: "10px",
  marginBottom: "15px",
  borderRadius: "4px",
  border: "1px solid #444",
  backgroundColor: "#1f2a3d",
  color: "#cbdcea",
};

const buttonStyle = {
  padding: "10px",
  backgroundColor: "#4ade80",
  color: "#000",
  border: "none",
  borderRadius: "4px",
  cursor: "pointer",
  fontWeight: "bold",
};

export default PaymentRequest;
