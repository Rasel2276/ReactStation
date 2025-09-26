import React from "react";
import { Outlet, Link } from "react-router-dom";
import { FaTachometerAlt, FaPlusCircle, FaShoppingCart,FaTags,FaClipboardList,FaCreditCard,FaComment,FaRegComment,FaUser,FaSignOutAlt } from "react-icons/fa";
import Header from "../components/Header";

export default function VendorLayout() {
  return (
    <div className="layout">
      <aside className="sidebar vendor">
        <h2>Vendor Panel</h2>
        <nav className="navlink">
          <Link to="/vendor/dashboard" className="dashboard-link1"><FaTachometerAlt /> Dashboard</Link>
          <Link to="/vendor/products" className="dashboard-link"><FaPlusCircle /> Add Product</Link>
          <Link to="/vendor/orders" className="dashboard-link"><FaShoppingCart /> All Product</Link>
          <Link to="/vendor/orders" className="dashboard-link"><FaTags /> Discount Product</Link>
          <Link to="/vendor/orders" className="dashboard-link"><FaClipboardList /> Orders</Link>
          <Link to="/vendor/orders" className="dashboard-link"><FaCreditCard /> Payments</Link>
          <Link to="/vendor/orders" className="dashboard-link"><FaComment /> Chat Customer</Link>
          <Link to="/vendor/orders" className="dashboard-link"><FaRegComment /> Chat Support</Link>
          <Link to="/vendor/orders" className="dashboard-link"><FaUser /> Profile</Link>
          <Link to="/vendor/orders" className="dashboard-link"><FaSignOutAlt /> Logout</Link>
        </nav>
      </aside>
      <div className="main-content">
        <Header title="Vendor Dashboard" />
        <Outlet />
      </div>
    </div>
  );
}
