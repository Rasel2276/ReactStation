import React, { useState } from "react";

export default function SearchBar() {
  const [category, setCategory] = useState("All");

  return (
    <div className="search-bar">
      <select value={category} onChange={(e) => setCategory(e.target.value)}>
        <option>All</option>
        <option>Electronics</option>
        <option>Fashion</option>
        <option>Home</option>
      </select>
      <input type="text" placeholder="I'm shopping for..." />
      <button>Search</button>
    </div>
  );
}