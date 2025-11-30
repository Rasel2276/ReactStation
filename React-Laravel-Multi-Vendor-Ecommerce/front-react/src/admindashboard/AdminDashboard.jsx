import { useState, useEffect } from 'react';
import './Style.css';
import Header from './layoutcomponents/Header.jsx';
import Sidebar from './layoutcomponents/Sidebar.jsx';
import Home from './layoutcomponents/Home.jsx';

function AdminDashboard() {
  const [openSidebarToggle, setOpenSidebarToggle] = useState(true);
  const [user, setUser] = useState({ name: 'Admin' });

  const toggleSidebar = () => {
    setOpenSidebarToggle(!openSidebarToggle);
  };

  useEffect(() => {
    // localStorage theke user info fetch
    const storedUser = JSON.parse(localStorage.getItem("user"));
    if (storedUser) {
      setUser(storedUser);
    }
  }, []);

  return (
    <div className='grid-container'>
      <Header OpenSidebar={toggleSidebar} user={user} />
      <Sidebar openSidebarToggle={openSidebarToggle} user={user} />
      <Home user={user} />
    </div>
  );
}

export default AdminDashboard;
