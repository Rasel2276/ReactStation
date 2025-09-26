import React from "react";
import { Routes, Route, Navigate } from "react-router-dom";
import AdminLayout from "./layouts/AdminLayout";
import OrdersTable from "./components/ordertable";
import UserTable from "./components/seller";
import PaymentRequestTable from "./components/paymentrequest";
import SellerDeactivate from "./components/sellerdeactivate";
import SellerRequestTable from "./components/sellerrequest";
import ChatSeller from "./components/chatseller";
import VendorLayout from "./layouts/VendorLayout";
import AddProduct from "./components/vendor-component/addproduct";
import AllProducts from "./components/vendor-component/allproduct";
import DiscountProducts from "./components/vendor-component/discountproduct";
import OrderList from "./components/vendor-component/orderlist";
import SellerPayments from "./components/vendor-component/sellerpayment";
import ChatDashboard from "./components/vendor-component/chatcustomer";
import ChatSupport from "./components/vendor-component/chatsupport";
import SellerProfile from "./components/vendor-component/sellerprofile";
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
        <Route path="orders" element={<OrdersTable />} />
        <Route path="seller" element={<UserTable />} />
        <Route path="paymentrequest" element={<PaymentRequestTable />} />
        <Route path="sellerdeactivate" element={<SellerDeactivate />} />
        <Route path="sellerrequest" element={<SellerRequestTable />} />
        <Route path="chatseller" element={<ChatSeller />} />
      </Route>

      <Route path="/vendor/*" element={<VendorLayout />}>
        <Route path="dashboard" element={<VendorDashboard />} />
        <Route path="addproduct" element={<AddProduct />} />
        <Route path="allproduct" element={<AllProducts />} />
        <Route path="discountproduct" element={<DiscountProducts />} />
        <Route path="orderlist" element={<OrderList />} />
        <Route path="sellerpayment" element={<SellerPayments />} />
        <Route path="chatcustomer" element={<ChatDashboard />} />
        <Route path="chatsupport" element={<ChatSupport />} />
        <Route path="sellerprofile" element={<SellerProfile />} />
      </Route>

      <Route path="/customer/*" element={<CustomerLayout />}>
        <Route path="dashboard" element={<CustomerDashboard />} />
      </Route>

      <Route path="*" element={<div style={{padding:20}}>Page not found</div>} />
    </Routes>
  );
}
