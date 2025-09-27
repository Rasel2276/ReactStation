import React, { useState } from "react";

function AddProduct() {
  const [product, setProduct] = useState({
    name: "",
    category: "",
    price: "",
    stock: "",
    description: "",
    image: null,
  });

  const handleChange = (e) => {
    const { name, value, files } = e.target;
    if (name === "image") {
      setProduct({ ...product, image: files[0] });
    } else {
      setProduct({ ...product, [name]: value });
    }
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log("Product Data:", product);
    alert("Product submitted (Check console)");
    // Backend integration: send product to PHP API here
  };

  return (
    <div style={{ backgroundColor: "#213247", color: "#cbdcea", padding: "20px", borderRadius: "8px", maxWidth: "600px", margin: "20px auto" }}>
      <h2 style={{ marginBottom: "20px",textAlign: "center" }}>Add Product</h2>
      <form onSubmit={handleSubmit} style={{ display: "flex", flexDirection: "column" }}>
        <input
          type="text"
          name="name"
          placeholder="Product Name"
          value={product.name}
          onChange={handleChange}
          style={inputStyle}
          required
        />
        <input
          type="text"
          name="category"
          placeholder="Category"
          value={product.category}
          onChange={handleChange}
          style={inputStyle}
          required
        />
        <input
          type="number"
          name="price"
          placeholder="Price"
          value={product.price}
          onChange={handleChange}
          style={inputStyle}
          required
        />
        <input
          type="number"
          name="stock"
          placeholder="Stock Quantity"
          value={product.stock}
          onChange={handleChange}
          style={inputStyle}
          required
        />
        <textarea
          name="description"
          placeholder="Description"
          value={product.description}
          onChange={handleChange}
          style={{ ...inputStyle, height: "100px" }}
          required
        ></textarea>
        <input
          type="file"
          name="image"
          onChange={handleChange}
          style={{ marginBottom: "15px" }}
          required
        />
        <button type="submit" style={buttonStyle}>Add Product</button>
      </form>
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

export default AddProduct;
