import React from "react";
import { Routes, Route, Navigate } from "react-router-dom";
import AdminLayout from "./layouts/AdminLayout";
import VendorLayout from "./layouts/VendorLayout";
import CustomerLayout from "./layouts/CustomerLayout";
import AdminDashboard from "./pages/admin/AdminDashboard";
import VendorDashboard from "./pages/vendor/VendorDashboard";
import CustomerDashboard from "./pages/customer/CustomerDashboard";

export default function App() {
  return (
    <Routes>
      <Route path="/" element={<Navigate to="/admin/dashboard" replace />} />

      <Route path="/admin/*" element={<AdminLayout />}>
        <Route path="dashboard" element={<AdminDashboard />} />
      </Route>

      <Route path="/vendor/*" element={<VendorLayout />}>
        <Route path="dashboard" element={<VendorDashboard />} />
      </Route>

      <Route path="/customer/*" element={<CustomerLayout />}>
        <Route path="dashboard" element={<CustomerDashboard />} />
      </Route>

      <Route path="*" element={<div style={{padding:20}}>Page not found</div>} />
    </Routes>
  );
}
