import React from "react";
import { Outlet, Link } from "react-router-dom";
import { FaTachometerAlt, FaPlusCircle, FaShoppingCart,FaTags,FaClipboardList,FaCreditCard,FaComment,FaRegComment,FaUser,FaSignOutAlt } from "react-icons/fa";
import Header from "../components/Header";
import RM from '../image/RM.png';

export default function VendorLayout() {
  return (
    <div className="layout">
      <aside className="sidebar vendor">
        <img src={RM} alt="logo" style={{ width: '150px', height: 'auto',display: 'block', margin: '0 auto' }} />
        <h2 style={{textAlign: "center",color:"#Fff" }}>Vendor Panel</h2>
        <nav className="navlink">
          <Link to="/vendor/dashboard" className="dashboard-link1"><FaTachometerAlt /> Dashboard</Link>
          <Link to="/vendor/addproduct"><FaPlusCircle /> Add Product</Link>
          <Link to="/vendor/allproduct"><FaShoppingCart /> All Product</Link>
          <Link to="/vendor/discountproduct"><FaTags /> Discount Product</Link>
          <Link to="/vendor/orderlist"><FaClipboardList /> Orders</Link>
          <Link to="/vendor/sellerpayment"><FaCreditCard /> Payments</Link>
          <Link to="/vendor/chatcustomer"><FaComment /> Chat Customer</Link>
          <Link to="/vendor/chatsupport"><FaRegComment /> Chat Support</Link>
          <Link to="/vendor/sellerprofile"><FaUser /> Profile</Link>
          <Link to="/vendor/orders"><FaSignOutAlt /> Logout</Link>
        </nav>
      </aside>
      <div className="main-content">
        <Header title="Vendor Dashboard" />
        <Outlet />
      </div>
    </div>
  );
}
