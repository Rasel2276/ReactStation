import React, { useState } from "react";
import { FaBell } from "react-icons/fa";

export default function Header({ title }) {
  const [open, setOpen] = useState(false);
  return (
    <header className="header">
      <h1>{title}</h1>
      <div className="header-right">
        <FaBell style={{marginRight:'15px', cursor:'pointer'}}/>
        <div className="profile" onClick={() => setOpen(!open)}>
          <span>John Doe</span>
          {open && <div className="dropdown"><div>Settings</div><div>Logout</div></div>}
        </div>
      </div>
    </header>
  );
}
