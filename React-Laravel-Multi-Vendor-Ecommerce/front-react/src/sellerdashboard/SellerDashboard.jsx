import { useLocation } from 'react-router-dom';
import LogoutButton from '../auth/LogoutButton';

export default function VendorDashboard() {
  const location = useLocation();
  const user = location.state?.user;

  return (
    <div style={{ padding: '20px' }}>
      <h1>Welcome, {user?.name || 'Vendor'}!</h1>
      <p>This is your Vendor Dashboard.</p>
      <LogoutButton />
    </div>
  );
}

