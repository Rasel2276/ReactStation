import { BrowserRouter, Routes, Route } from 'react-router-dom';
import ProtectedRoute from "./ProtectedRoute";
import Login from './auth/Login';
import Registration from './auth/Registration';
import AdminDashboard from './admindashboard/AdminDashboard';
import SellerDashboard from './sellerdashboard/SellerDashboard';
import CustomerDashboard from './customerdashboard/CustomerDashboard';
import Home from './admindashboard/layoutcomponents/Home';
import AddProduct from './admindashboard/adminpages/AddProduct';

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
        >
        {/* Admin dashboard home page */}
        <Route index element={<Home />} />

        {/* Other pages inside admin */}
        <Route path="/admin/addporduct" element={<AddProduct />} />

       </Route>

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
