import React, { useState } from "react";

function AllProducts() {
  const [products, setProducts] = useState([
    {
      id: 1,
      code: "P1001",
      name: "Laptop",
      category: "Electronics",
      price: "$1200",
      stock: 10,
      description: "High performance laptop",
      image: "https://via.placeholder.com/50",
    },
    {
      id: 2,
      code: "P1002",
      name: "Headphones",
      category: "Electronics",
      price: "$150",
      stock: 25,
      description: "Noise cancelling headphones",
      image: "https://via.placeholder.com/50",
    },
    {
      id: 3,
      code: "P1003",
      name: "Shoes",
      category: "Fashion",
      price: "$80",
      stock: 50,
      description: "Comfortable running shoes",
      image: "https://via.placeholder.com/50",
    },
  ]);

  const handleEdit = (id) => {
    alert(`Edit Product ID: ${id}`);
  };

  const handleDelete = (id) => {
    if (window.confirm("Are you sure to delete this product?")) {
      setProducts(products.filter((p) => p.id !== id));
    }
  };

  const handleView = (product) => {
    alert(`
    Product Details:
    --------------------
    Code: ${product.code}
    Name: ${product.name}
    Category: ${product.category}
    Price: ${product.price}
    Stock: ${product.stock}
    Description: ${product.description}
    Image: ${product.image}
    `);
  };

  return (
    <div style={{ overflowX: "auto" }}>
      <h2
        style={{
          marginLeft: "30px",
          color: "#cbdcea",
          textAlign: "center",
        }}
      >
        All Added Products
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
            <th style={thStyle}>Product Code</th>
            <th style={thStyle}>Image</th>
            <th style={thStyle}>Product Name</th>
            <th style={thStyle}>Category</th>
            <th style={thStyle}>Price</th>
            <th style={thStyle}>Stock</th>
            <th style={thStyle}>Action</th>
          </tr>
        </thead>
        <tbody>
          {products.map((prod) => (
            <tr key={prod.id} style={trStyle}>
              <td style={tdStyle}>{prod.code}</td>
              <td style={tdStyle}>
                <img
                  src={prod.image}
                  alt={prod.name}
                  style={{ width: "50px", height: "50px", borderRadius: "4px" }}
                />
              </td>
              <td style={tdStyle}>{prod.name}</td>
              <td style={tdStyle}>{prod.category}</td>
              <td style={tdStyle}>{prod.price}</td>
              <td style={tdStyle}>{prod.stock}</td>
              <td style={tdStyle}>
                <button
                  onClick={() => handleEdit(prod.id)}
                  style={editButtonStyle}
                >
                  Edit
                </button>
                <button
                  onClick={() => handleDelete(prod.id)}
                  style={deleteButtonStyle}
                >
                  Delete
                </button>
                <button
                  onClick={() => handleView(prod)}
                  style={viewButtonStyle}
                >
                  View
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
const trStyle = { transition: "background-color 0.2s" };
const editButtonStyle = {
  padding: "5px 10px",
  marginRight: "5px",
  backgroundColor: "#4ade80",
  color: "#000",
  border: "none",
  borderRadius: "4px",
  cursor: "pointer",
};
const deleteButtonStyle = {
  padding: "5px 10px",
  marginRight: "5px",
  backgroundColor: "#f87171",
  color: "#fff",
  border: "none",
  borderRadius: "4px",
  cursor: "pointer",
};
const viewButtonStyle = {
  padding: "5px 10px",
  backgroundColor: "#60a5fa",
  color: "#fff",
  border: "none",
  borderRadius: "4px",
  cursor: "pointer",
};

export default AllProducts;
