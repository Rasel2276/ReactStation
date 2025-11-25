import { useNavigate } from 'react-router-dom';


export default function LogoutButton() {
  const navigate = useNavigate();

  const handleLogout = () => {
    // যদি session/localStorage ব্যবহার করো, clear করো এখানে
    // localStorage.removeItem('user');
    navigate('/'); // Login page এ redirect
  };

  return (
    <button
      onClick={handleLogout}
      style={{
        padding: '8px 16px',
        border: 'none',
        borderRadius: '6px',
        backgroundColor: '#f44336',
        color: '#fff',
        cursor: 'pointer',
        marginTop: '20px'
      }}
    >
      Logout
    </button>
  );
}
