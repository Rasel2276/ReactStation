import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './ProductCRUD.css';


const API_URL = 'http://127.0.0.1:8000/api/products';

export default function ProductCRUD() {
  const [products, setProducts] = useState([]);
  const [form, setForm] = useState({ name: '', price: '', quantity: '' });
  const [editId, setEditId] = useState(null);

  const fetchProducts = async () => {
    try {
      const res = await axios.get(API_URL);
      setProducts(res.data);
    } catch (err) {
      console.log(err);
    }
  };

  useEffect(() => { fetchProducts(); }, []);

  const handleChange = e => setForm({ ...form, [e.target.name]: e.target.value });

  const handleSubmit = async e => {
    e.preventDefault();
    try {
      if(editId){
        await axios.put(`${API_URL}/${editId}`, form);
        setEditId(null);
      } else {
        await axios.post(API_URL, form);
      }
      setForm({ name: '', price: '', quantity: '' });
      fetchProducts();
    } catch(err) {
      console.log(err.response ? err.response.data : err);
    }
  };

  const handleEdit = (p) => {
    setForm({ name: p.name, price: p.price, quantity: p.quantity });
    setEditId(p.id);
  };

  const handleDelete = async id => {
    try {
      await axios.delete(`${API_URL}/${id}`);
      fetchProducts();
    } catch(err) {
      console.log(err.response ? err.response.data : err);
    }
  };

  return (
    <div className="container">
  <h2>Products CRUD</h2>
  <form onSubmit={handleSubmit}>
    <input name="name" value={form.name} onChange={handleChange} placeholder="Name" required />
    <input name="price" type="number" value={form.price} onChange={handleChange} placeholder="Price" required />
    <input name="quantity" type="number" value={form.quantity} onChange={handleChange} placeholder="Quantity" required />
    <button type="submit">{editId ? 'Update' : 'Add'}</button>
  </form>

  <table>
    <thead>
      <tr><th>ID</th><th>Name</th><th>Price</th><th>Quantity</th><th>Actions</th></tr>
    </thead>
    <tbody>
      {products.map(p => (
        <tr key={p.id}>
          <td>{p.id}</td>
          <td>{p.name}</td>
          <td>{p.price}</td>
          <td>{p.quantity}</td>
          <td>
            <button onClick={() => handleEdit(p)}>Edit</button>
            <button onClick={() => handleDelete(p.id)}>Delete</button>
          </td>
        </tr>
      ))}
    </tbody>
  </table>
</div>

  );
}
