import React from "react";
import { Outlet, Link } from "react-router-dom";
import { FaTachometerAlt, FaUsers, FaBox } from "react-icons/fa";
import Header from "../components/Header";

export default function AdminLayout() {
  return (
    <div className="layout">
      <aside className="sidebar">
        <h2>Admin Panel</h2>
        <nav>
          <Link to="/admin/dashboard"><FaTachometerAlt /> Dashboard</Link>
          <Link to="/admin/vendors"><FaUsers /> Vendors</Link>
          <Link to="/admin/products"><FaBox /> Products</Link>
        </nav>
      </aside>
      <div className="main-content">
        <Header title="Admin Dashboard" />
        <Outlet />
      </div>
    </div>
  );
}
