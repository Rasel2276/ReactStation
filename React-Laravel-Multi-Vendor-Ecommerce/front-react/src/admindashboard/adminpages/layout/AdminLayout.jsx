import React, { useState } from "react";
import Header from "../../layoutcomponents/Header";
import Sidebar from "../../layoutcomponents/Sidebar";

export default function AdminLayout({ children }) {
  const [openSidebar, setOpenSidebar] = useState(true);

  const toggleSidebar = () => {
    setOpenSidebar(!openSidebar);
  };

  return (
    <div className="admin-layout">

      {/* HEADER */}
      <Header OpenSidebar={toggleSidebar} />

      <div className="admin-body" style={{ display: "flex" }}>

        {/* SIDEBAR */}
        <Sidebar openSidebarToggle={openSidebar} user={{ name: "Admin" }} />

        {/* MAIN CONTENT AREA */}
        <main style={{ flex: 1, padding: "20px" }}>
          {children}
        </main>

      </div>

    </div>
  );
}
