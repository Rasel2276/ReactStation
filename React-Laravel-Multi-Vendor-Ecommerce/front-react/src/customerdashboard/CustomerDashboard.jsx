import { useLocation } from 'react-router-dom';
import LogoutButton from '../auth/LogoutButton';

export default function CustomerDashboard() {
  const location = useLocation();
  const user = location.state?.user;

  return (
    <div style={{ padding: '20px' }}>
      <h1>Welcome, {user?.name || 'Customer'}!</h1>
      <p>This is your Customer Dashboard.</p>
      <LogoutButton />
    </div>
  );
}

