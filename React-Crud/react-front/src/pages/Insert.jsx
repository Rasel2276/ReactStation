import { useState, useEffect } from "react";
import api from "../api.js";
import { useNavigate, useLocation } from "react-router-dom";
import "../css/Insert.css";


function Insert() {
  const navigate = useNavigate();
  const location = useLocation();

  const [formData, setFormData] = useState({ name: "", age: "", gender: "male" });
  const [editId, setEditId] = useState(null);

  
  useEffect(() => {
    if (location.state && location.state.student) {
      const s = location.state.student;
      setFormData({ name: s.name, age: s.age, gender: s.gender });
      setEditId(s.id);
    }
  }, [location.state]);

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (editId === null) {
      await api.post("/students", formData);
    } else {
      await api.put(`/students/${editId}`, formData);
    }
    setFormData({ name: "", age: "", gender: "male" });
    setEditId(null);
    navigate("/show");
  };

  return (
    <div>
      <h2>{editId ? "Edit Student" : "Insert Student"}</h2>
      <form onSubmit={handleSubmit}>
        <input type="text" name="name" placeholder="Name" value={formData.name} onChange={handleChange} />
        <br />
        <input type="number" name="age" placeholder="Age" value={formData.age} onChange={handleChange} />
        <br />
        <select name="gender" value={formData.gender} onChange={handleChange}>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
        <br />
        <button type="submit">{editId ? "Update Student" : "Add Student"}</button>
      </form>
    </div>
  );
}

export default Insert;
