import { BrowserRouter, Routes, Route } from 'react-router-dom';
import ProtectedRoute from "./ProtectedRoute";
import Login from './auth/Login';
import Registration from './auth/Registration';
import AdminDashboard from './admindashboard/AdminDashboard';
import SellerDashboard from './sellerdashboard/SellerDashboard';
import CustomerDashboard from './customerdashboard/CustomerDashboard';

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Login />} />
        <Route path="/register" element={<Registration />} />

        {/* Protected Routes with role */}
        <Route
          path="/admin"
          element={
            <ProtectedRoute role="admin">
              <AdminDashboard />
            </ProtectedRoute>
          }
        />
        <Route
          path="/vendor"
          element={
            <ProtectedRoute role="vendor">
              <SellerDashboard />
            </ProtectedRoute>
          }
        />
        <Route
          path="/customer"
          element={
            <ProtectedRoute role="customer">
              <CustomerDashboard />
            </ProtectedRoute>
          }
        />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
