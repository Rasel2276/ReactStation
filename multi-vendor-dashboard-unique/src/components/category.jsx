import React, { useState, useEffect } from "react";
import { Plus, Edit, Trash } from "lucide-react";

// CategorySetter.jsx
// Tailwind-based React component in form format with background #213247 and text color #cbdcea

export default function CategorySetter() {
  const [name, setName] = useState("");
  const [color, setColor] = useState("#10b981");
  const [icon, setIcon] = useState("");
  const [description, setDescription] = useState("");
  const [categories, setCategories] = useState(() => {
    try {
      return JSON.parse(localStorage.getItem("categories_v1")) || [];
    } catch (e) {
      return [];
    }
  });

  const [editingId, setEditingId] = useState(null);

  useEffect(() => {
    localStorage.setItem("categories_v1", JSON.stringify(categories));
  }, [categories]);

  function resetForm() {
    setName("");
    setColor("#10b981");
    setIcon("");
    setDescription("");
    setEditingId(null);
  }

  function handleAddOrUpdate(e) {
    e.preventDefault();
    if (!name.trim()) return alert("Category name lagbe (required)");

    if (editingId) {
      setCategories(prev => prev.map(c => c.id === editingId ? { ...c, name, color, icon, description } : c));
    } else {
      const newCat = { id: Date.now().toString(), name: name.trim(), color, icon: icon.trim(), description: description.trim() };
      setCategories(prev => [newCat, ...prev]);
    }

    resetForm();
  }

  function handleEdit(cat) {
    setEditingId(cat.id);
    setName(cat.name);
    setColor(cat.color || "#10b981");
    setIcon(cat.icon || "");
    setDescription(cat.description || "");
    window.scrollTo({ top: 0, behavior: "smooth" });
  }

  function handleDelete(id) {
    if (!confirm("Are you sure you want to delete this category?")) return;
    setCategories(prev => prev.filter(c => c.id !== id));
  }

  return (
    <div style={{ margin: "20px" }}>
      <h2 style={{ color: "#cbdcea", textAlign: "center", marginBottom: "10px" }}>Category Manager</h2>
      <div style={{ backgroundColor: "#213247", color: "#cbdcea", padding: "20px", borderRadius: "8px" }}>
        <form onSubmit={handleAddOrUpdate} style={{ display: "flex", flexDirection: "column", gap: "15px" }}>
          <input
            type="text"
            placeholder="Category Name"
            value={name}
            onChange={e => setName(e.target.value)}
            style={{ padding: "10px", borderRadius: "4px", border: "1px solid #444", backgroundColor: "#1f2a3d", color: "#cbdcea" }}
          />
          <textarea
            placeholder="Description"
            value={description}
            onChange={e => setDescription(e.target.value)}
            style={{ padding: "10px", borderRadius: "4px", border: "1px solid #444", backgroundColor: "#1f2a3d", color: "#cbdcea", resize: "none", height: "80px" }}
          />
          <input
            type="text"
            placeholder="Icon (emoji or class)"
            value={icon}
            onChange={e => setIcon(e.target.value)}
            style={{ padding: "10px", borderRadius: "4px", border: "1px solid #444", backgroundColor: "#1f2a3d", color: "#cbdcea" }}
          />
          <input
            type="color"
            value={color}
            onChange={e => setColor(e.target.value)}
            style={{ width: "60px", height: "35px", border: "none", cursor: "pointer" }}
          />
          <div style={{ display: "flex", gap: "10px" }}>
            <button type="submit" style={{ padding: "10px 15px", backgroundColor: "#4ade80", border: "none", borderRadius: "4px", cursor: "pointer", fontWeight: "bold" }}>
              {editingId ? "Update Category" : "Add Category"}
            </button>
            <button type="button" onClick={resetForm} style={{ padding: "10px 15px", backgroundColor: "#f87171", border: "none", borderRadius: "4px", cursor: "pointer", color: "#fff", fontWeight: "bold" }}>
              Reset
            </button>
          </div>
        </form>

        {/* Categories List */}
        <div style={{ marginTop: "30px" }}>
          {categories.length === 0 ? (
            <div style={{ textAlign: "center" }}>No categories yet.</div>
          ) : (
            <ul style={{ display: "flex", flexDirection: "column", gap: "10px" }}>
              {categories.map((cat) => (
                <li key={cat.id} style={{ display: "flex", justifyContent: "space-between", alignItems: "center", padding: "10px", border: "1px solid #444", borderRadius: "4px" }}>
                  <div style={{ display: "flex", alignItems: "center", gap: "10px" }}>
                    <span style={{ width: "35px", height: "35px", display: "flex", justifyContent: "center", alignItems: "center", backgroundColor: `${cat.color}22`, color: cat.color, borderRadius: "4px", fontWeight: "bold" }}>{cat.icon || cat.name.charAt(0).toUpperCase()}</span>
                    <div>
                      <div>{cat.name}</div>
                      <div style={{ fontSize: "12px", opacity: 0.8 }}>{cat.description}</div>
                    </div>
                  </div>
                  <div style={{ display: "flex", gap: "5px" }}>
                    <button onClick={() => handleEdit(cat)} style={{ padding: "5px 10px", backgroundColor: "#4ade80", border: "none", borderRadius: "4px", cursor: "pointer", fontWeight: "bold" }}>Edit</button>
                    <button onClick={() => handleDelete(cat.id)} style={{ padding: "5px 10px", backgroundColor: "#f87171", border: "none", borderRadius: "4px", cursor: "pointer", fontWeight: "bold", color: "#fff" }}>Delete</button>
                  </div>
                </li>
              ))}
            </ul>
          )}
        </div>
      </div>
    </div>
  );
}
