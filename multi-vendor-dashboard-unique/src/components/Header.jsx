import React, { useState } from "react";
import { FaBell } from "react-icons/fa";

export default function Header({ title }) {
  const [open, setOpen] = useState(false);
  const [search, setSearch] = useState("");

  return (
    <header className="admin-header">
      <div className="header-left">
        {/* <h1>{title}</h1> */}
        {/* Search Input */}
        <input
          type="text"
          placeholder="Search..."
          value={search}
          onChange={(e) => setSearch(e.target.value)}
          style={{
            marginLeft: "15px",
            padding: "10px 10px",
            borderRadius: "5px",
            border: "1px solid #ccc",
            margin: "10px",
            background: "none",
          }}
        />
      </div>

      <div className="header-right">
        <FaBell style={{ marginRight: "15px", cursor: "pointer" }} />
        <div className="profile" onClick={() => setOpen(!open)}>
          <span>John Doe</span>
          {open && (
            <div className="dropdown">
              <div>Settings</div>
              <div>Logout</div>
            </div>
          )}
        </div>
      </div>
    </header>
  );
}

