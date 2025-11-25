import { useLocation } from 'react-router-dom';
import LogoutButton from '../auth/LogoutButton';

export default function AdminDashboard() {
  const location = useLocation();
  const user = location.state?.user; // <-- state থেকে user নাও

  return (
    <div style={{ padding: '20px' }}>
      <h1>Welcome, {user?.name || 'Admin'}!</h1>
      <p>This is your Admin Dashboard.</p>
      <LogoutButton />
    </div>
  );
}


