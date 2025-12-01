// AddProduct.jsx (React + CSS in one file)
import React, { useState, useEffect } from 'react';

export default function AddProduct() {
  const [name, setName] = useState('');
  const [price, setPrice] = useState('');
  const [category, setCategory] = useState('');
  const [quantity, setQuantity] = useState('');
  const [success, setSuccess] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();

    if (!name || !price || !category || !quantity) {
      setSuccess('❌ All fields are required');
      return;
    }

    setSuccess('✔ Product Added Successfully');
    setName('');
    setPrice('');
    setCategory('');
    setQuantity('');
  };

  // Inject CSS when component loads
  useEffect(() => {
    const style = document.createElement('style');
    style.innerHTML = `
      .product-container {
        max-width: 450px;
        margin: 40px auto;
        padding: 25px;
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        font-family: 'Poppins', sans-serif;
      }
      .title {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 18px;
        text-align: center;
        color: #333;
      }
      .product-form {
        display: flex;
        flex-direction: column;
        gap: 12px;
      }
      .input {
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 10px;
        font-size: 15px;
        transition: 0.3s;
      }
      .input:focus {
        border-color: #6a5af9;
        box-shadow: 0 0 4px rgba(106, 90, 249, 0.4);
        outline: none;
      }
      .btn {
        padding: 12px;
        background: #6a5af9;
        border: none;
        color: white;
        border-radius: 10px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 8px;
        transition: 0.3s;
      }
      .btn:hover {
        background: #5948e7;
      }
      .message {
        margin-top: 15px;
        text-align: center;
        font-size: 15px;
        font-weight: 500;
        color: #2c7c2f;
      }
    `;
    document.head.appendChild(style);

    return () => document.head.removeChild(style);
  }, []);

  return (
    <div className="product-container">
      <h2 className="title">Add Product</h2>
      <form className="product-form" onSubmit={handleSubmit}>
        <input
          type="text"
          className="input"
          placeholder="Product Name"
          value={name}
          onChange={(e) => setName(e.target.value)}
        />

        <input
          type="number"
          className="input"
          placeholder="Price"
          value={price}
          onChange={(e) => setPrice(e.target.value)}
        />

        <input
          type="text"
          className="input"
          placeholder="Category"
          value={category}
          onChange={(e) => setCategory(e.target.value)}
        />

        <input
          type="number"
          className="input"
          placeholder="Quantity"
          value={quantity}
          onChange={(e) => setQuantity(e.target.value)}
        />

        <button className="btn">Add Product</button>
      </form>

      {success && <p className="message">{success}</p>}
    </div>
  );
}
