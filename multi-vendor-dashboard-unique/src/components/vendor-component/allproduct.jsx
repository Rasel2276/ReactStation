import React, { useState } from "react";

function AllProducts() {
  const [products, setProducts] = useState([
    { id: 1, name: "Laptop", category: "Electronics", price: "$1200", stock: 10, image: "https://via.placeholder.com/50" },
    { id: 2, name: "Headphones", category: "Electronics", price: "$150", stock: 25, image: "https://via.placeholder.com/50" },
    { id: 3, name: "Shoes", category: "Fashion", price: "$80", stock: 50, image: "https://via.placeholder.com/50" },
  ]);

  const handleEdit = (id) => {
    alert(`Edit Product ID: ${id}`);
  };

  const handleDelete = (id) => {
    if (window.confirm("Are you sure to delete this product?")) {
      setProducts(products.filter(p => p.id !== id));
    }
  };

  return (
    <div style={{ overflowX: "auto" }}>
      <table style={{ width: "95%", borderCollapse: "collapse", backgroundColor: "#213247", color: "#cbdcea",margin:"20px" }}>
        <thead>
          <tr>
            <th style={thStyle}>#</th>
            <th style={thStyle}>Image</th>
            <th style={thStyle}>Product Name</th>
            <th style={thStyle}>Category</th>
            <th style={thStyle}>Price</th>
            <th style={thStyle}>Stock</th>
            <th style={thStyle}>Action</th>
          </tr>
        </thead>
        <tbody>
          {products.map((prod, index) => (
            <tr key={prod.id} style={trStyle}>
              <td style={tdStyle}>{index + 1}</td>
              <td style={tdStyle}><img src={prod.image} alt={prod.name} style={{ width: "50px", height: "50px", borderRadius: "4px" }} /></td>
              <td style={tdStyle}>{prod.name}</td>
              <td style={tdStyle}>{prod.category}</td>
              <td style={tdStyle}>{prod.price}</td>
              <td style={tdStyle}>{prod.stock}</td>
              <td style={tdStyle}>
                <button onClick={() => handleEdit(prod.id)} style={editButtonStyle}>Edit</button>
                <button onClick={() => handleDelete(prod.id)} style={deleteButtonStyle}>Delete</button>
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
const editButtonStyle = { padding: "5px 10px", marginRight: "5px", backgroundColor: "#4ade80", color: "#000", border: "none", borderRadius: "4px", cursor: "pointer" };
const deleteButtonStyle = { padding: "5px 10px", backgroundColor: "#f87171", color: "#fff", border: "none", borderRadius: "4px", cursor: "pointer" };

export default AllProducts;
