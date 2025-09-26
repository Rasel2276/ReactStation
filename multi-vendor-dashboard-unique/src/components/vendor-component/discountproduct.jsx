import React, { useState } from "react";

function DiscountProductManager() {
  // Sample products
  const [products] = useState([
    { id: 1, name: "Laptop", price: 1200, image: "https://via.placeholder.com/50" },
    { id: 2, name: "Headphones", price: 150, image: "https://via.placeholder.com/50" },
    { id: 3, name: "Shoes", price: 80, image: "https://via.placeholder.com/50" },
  ]);

  // Discount products state
  const [discounts, setDiscounts] = useState([]);

  // Selected product & discount price
  const [selectedProduct, setSelectedProduct] = useState("");
  const [discountPrice, setDiscountPrice] = useState("");

  const handleApplyDiscount = () => {
    if (!selectedProduct || !discountPrice) return;

    const product = products.find(p => p.id === parseInt(selectedProduct));
    if (!product) return;

    // Check if already in discounts
    const existing = discounts.find(d => d.id === product.id);
    if (existing) {
      setDiscounts(discounts.map(d => d.id === product.id ? { ...d, discountPrice } : d));
    } else {
      setDiscounts([...discounts, { ...product, discountPrice, status: "Active" }]);
    }

    setSelectedProduct("");
    setDiscountPrice("");
  };

  const handleDelete = (id) => {
    setDiscounts(discounts.filter(d => d.id !== id));
  };

  return (
    <div style={{ backgroundColor: "#213247", color: "#cbdcea", padding: "20px", borderRadius: "8px",margin:"20px" }}>
      
      {/* Apply Discount Section */}
      <div style={{ marginBottom: "20px", display: "flex", gap: "10px" }}>
        <select value={selectedProduct} onChange={e => setSelectedProduct(e.target.value)} style={inputStyle}>
          <option value="">Select Product</option>
          {products.map(p => (
            <option key={p.id} value={p.id}>{p.name} (${p.price})</option>
          ))}
        </select>

        <input
          type="number"
          placeholder="Discount Price"
          value={discountPrice}
          onChange={e => setDiscountPrice(e.target.value)}
          style={inputStyle}
        />

        <button onClick={handleApplyDiscount} style={applyButtonStyle}>Apply Discount</button>
      </div>

      {/* Discount Products Table */}
      <div style={{ overflowX: "auto" }}>
        <table style={{ width: "100%", borderCollapse: "collapse", backgroundColor: "#213247", color: "#cbdcea" }}>
          <thead>
            <tr>
              <th style={thStyle}>Serial</th>
              <th style={thStyle}>Image</th>
              <th style={thStyle}>Product Name</th>
              <th style={thStyle}>Original Price</th>
              <th style={thStyle}>Discount Price</th>
              <th style={thStyle}>Status</th>
              <th style={thStyle}>Action</th>
            </tr>
          </thead>
          <tbody>
            {discounts.map((prod, index) => (
              <tr key={prod.id} style={trStyle}>
                <td style={tdStyle}>{index + 1}</td>
                <td style={tdStyle}><img src={prod.image} alt={prod.name} style={{ width: "50px", height: "50px", borderRadius: "4px" }} /></td>
                <td style={tdStyle}>{prod.name}</td>
                <td style={tdStyle}>${prod.price}</td>
                <td style={tdStyle}>${prod.discountPrice}</td>
                <td style={{ ...tdStyle, color: "green", fontWeight: "bold" }}>{prod.status}</td>
                <td style={tdStyle}>
                  <button onClick={() => handleDelete(prod.id)} style={deleteButtonStyle}>Delete</button>
                </td>
              </tr>
            ))}
            {discounts.length === 0 && (
              <tr>
                <td colSpan="7" style={{ textAlign: "center", padding: "10px" }}>No discount products yet.</td>
              </tr>
            )}
          </tbody>
        </table>
      </div>

    </div>
  );
}

// Styles
const thStyle = { padding: "10px", borderBottom: "1px solid #444", textAlign: "left" };
const tdStyle = { padding: "10px", borderBottom: "1px solid #444" };
const trStyle = { transition: "background-color 0.2s" };
const inputStyle = { padding: "10px", borderRadius: "4px", border: "1px solid #444", backgroundColor: "#1f2a3d", color: "#cbdcea", flex: "1" };
const applyButtonStyle = { padding: "10px 15px", backgroundColor: "#4ade80", border: "none", borderRadius: "4px", cursor: "pointer", color: "#000", fontWeight: "bold" };
const deleteButtonStyle = { padding: "5px 10px", backgroundColor: "#f87171", color: "#fff", border: "none", borderRadius: "4px", cursor: "pointer" };

export default DiscountProductManager;
