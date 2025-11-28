import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Login from './auth/Login';
import Registration from './auth/Registration';
import AdminDashboard from './admindashboard/AdminDashboard';
import SellerDashboard from './sellerdashboard/SellerDashboard';
import CustomerDashboard from './customerdashboard/CustomerDashboard';
import Dashboardlayout from './admindashboard/dashboardlayout';

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Login />} />
        <Route path="/register" element={<Registration />} />
        <Route path="/admin" element={<AdminDashboard />} />
        <Route path="/vendor" element={<SellerDashboard />} />
        <Route path="/customer" element={<CustomerDashboard />} />
        <Route path="/dashboard" element={<Dashboardlayout />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;

