import React from "react";
import { Outlet, Link } from "react-router-dom";
import { FaTachometerAlt, FaBox, FaShoppingCart } from "react-icons/fa";
import Header from "../components/Header";

export default function VendorLayout() {
  return (
    <div className="layout">
      <aside className="sidebar vendor">
        <h2>Vendor Panel</h2>
        <nav>
          <Link to="/vendor/dashboard"><FaTachometerAlt /> Dashboard</Link>
          <Link to="/vendor/products"><FaBox /> My Products</Link>
          <Link to="/vendor/orders"><FaShoppingCart /> Orders</Link>
        </nav>
      </aside>
      <div className="main-content">
        <Header title="Vendor Dashboard" />
        <Outlet />
      </div>
    </div>
  );
}
