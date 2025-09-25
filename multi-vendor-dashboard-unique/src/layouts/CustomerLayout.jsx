import React from "react";
import { Outlet, Link } from "react-router-dom";
import { FaTachometerAlt, FaShoppingCart, FaUser } from "react-icons/fa";
import Header from "../components/Header";

export default function CustomerLayout() {
  return (
    <div className="layout">
      <aside className="sidebar customer">
        <h2>Customer Panel</h2>
        <nav>
          <Link to="/customer/dashboard"><FaTachometerAlt /> Dashboard</Link>
          <Link to="/customer/orders"><FaShoppingCart /> Orders</Link>
          <Link to="/customer/profile"><FaUser /> Profile</Link>
        </nav>
      </aside>
      <div className="main-content">
        <Header title="Customer Dashboard" />
        <Outlet />
      </div>
    </div>
  );
}
