import React, { useState } from "react";
import { Routes, Route } from "react-router-dom";

// Layouts
import AdminLayout from "./layouts/AdminLayout";
import VendorLayout from "./layouts/VendorLayout";
import CustomerLayout from "./layouts/CustomerLayout";

// Admin components
import OrdersTable from "./components/ordertable";
import SellerPaymentList from "./components/SellerPaymentList";
import UserTable from "./components/seller";
import PaymentRequestTable from "./components/paymentrequest";
import SellerDeactivate from "./components/sellerdeactivate";
import SellerRequestTable from "./components/sellerrequest";
import ChatSeller from "./components/chatseller";

// Vendor components
import AddProduct from "./components/vendor-component/addproduct";
import AllProducts from "./components/vendor-component/allproduct";
import DiscountProducts from "./components/vendor-component/discountproduct";
import OrderList from "./components/vendor-component/orderlist";
import SellerPayments from "./components/vendor-component/sellerpayment";
import PaymentRequest from "./components/vendor-component/PaymentRequest";

import ChatDashboard from "./components/vendor-component/chatcustomer";
import ChatSupport from "./components/vendor-component/chatsupport";
import SellerProfile from "./components/vendor-component/sellerprofile";

// Dashboards
import AdminDashboard from "./pages/admin/AdminDashboard";
import VendorDashboard from "./pages/vendor/VendorDashboard";
import CustomerDashboard from "./pages/customer/CustomerDashboard";

//  HomePage 
import HomePage from "./ui-component/ui-pages/Homepage";
import Shop from "./ui-component/ui-pages/shop";

//  Authentication forms 
import RegistrationForm from "./ui-component/authentication/RegistrationForm";
import LoginForm from "./ui-component/authentication/LoginForm";
//  Footer
import Footer from "./ui-component/Header/footer";

export default function App() {
  const [showRegisterForm, setShowRegisterForm] = useState(false);
  const [showLoginForm, setShowLoginForm] = useState(false);

  return (
    <>
    <div className="app">
      <main className="content">
      <Routes>
        {/* Default homepage */}
        <Route
          path="/"
          element={
            <HomePage
              onRegisterClick={() => setShowRegisterForm(true)}
              onLoginClick={() => setShowLoginForm(true)}
            />
          }
        />
        <Route path="/shop" element={<Shop/>} />
          

        {/* Admin routes */}
        <Route path="/admin/*" element={<AdminLayout />}>
          <Route path="dashboard" element={<AdminDashboard />} />
          <Route path="orders" element={<OrdersTable />} />
          <Route path="sellerpaymentlist" element={<SellerPaymentList />} />
          <Route path="seller" element={<UserTable />} />
          <Route path="paymentrequest" element={<PaymentRequestTable />} />
          <Route path="sellerdeactivate" element={<SellerDeactivate />} />
          <Route path="sellerrequest" element={<SellerRequestTable />} />
          <Route path="chatseller" element={<ChatSeller />} />
        </Route>

        {/* Vendor routes */}
        <Route path="/vendor/*" element={<VendorLayout />}>
          <Route path="dashboard" element={<VendorDashboard />} />
          <Route path="addproduct" element={<AddProduct />} />
          <Route path="allproduct" element={<AllProducts />} />
          <Route path="discountproduct" element={<DiscountProducts />} />
          <Route path="orderlist" element={<OrderList />} />
          <Route path="sellerpayment" element={<SellerPayments />} />
          <Route path="paymentrequest" element={<PaymentRequest />} />
          <Route path="chatcustomer" element={<ChatDashboard />} />
          <Route path="chatsupport" element={<ChatSupport />} />
          <Route path="sellerprofile" element={<SellerProfile />} />
        </Route>

        {/* Customer routes */}
        <Route path="/customer/*" element={<CustomerLayout />}>
          <Route path="dashboard" element={<CustomerDashboard />} />
        </Route>

        {/* 404 fallback */}
        <Route
          path="*"
          element={<div style={{ padding: 20 }}>Page not found</div>}
        />
      </Routes>

      {/* Registration form modal */}
      {showRegisterForm && (
        <RegistrationForm onClose={() => setShowRegisterForm(false)} />
      )}

      {/* Login form modal */}
      {showLoginForm && (
        <LoginForm onClose={() => setShowLoginForm(false)} />
      )}
      </main>
      <Footer></Footer>
      </div>
    </>
  );
}
